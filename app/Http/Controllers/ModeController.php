<?php

namespace App\Http\Controllers;
//namespace \Illuminate\Database\QueryException;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\User;
use Session;

class ModeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();
        $data['mode_names'] = DB::table('tbl_transport_mode')
            ->orderBy('serial_no', 'desc')
            ->get();
        return view('mode.mode', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->input('mode_name');

        $check = DB::table('tbl_transport_mode')
            ->whereRaw('LOWER(`mode`) like ?', ['%' . strtolower($name) . '%'])
            ->whereRaw('UPPER(`mode`) like ?', ['%' . strtolower($name) . '%'])
            ->first();
        if ($check) {
            Session::flash('message', 'Already Added Data !');
            Session::flash('alert-class', 'btn-danger');

        } else {
            $inserted = DB::table('tbl_transport_mode')->insert([
                'mode' => $name,
                'entry_time' => date('Y-m-d H:i:s'),
            ]);
            if ($inserted) {
                Session::flash('message', 'Successfully Deleted Data !');
                Session::flash('alert-class', 'btn-info');
            } else {
                Session::flash('message', 'Fail to Delete Data !');
                Session::flash('alert-class', 'btn-danger');
            }
        }


        return redirect('/mode');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit_data = DB::table('tbl_transport_mode')->where('serial_no', $id)->first();

        return view('mode.edit_mode', ['edit_data' => $edit_data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->input('id');
        $port_name = $request->input('mode_name');

        $updated = DB::table('tbl_transport_mode')
            ->where('serial_no', $id)
            ->update([
                'mode' => $port_name,
                'entry_time' => date('Y-m-d H:i:s'),
            ]);

        if ($updated) {
            Session::flash('message', 'Successfully Updated Data !');
            Session::flash('alert-class', 'btn-info');
        } else {
            Session::flash('message', 'Fail to Update Data !');
            Session::flash('alert-class', 'btn-danger');
        }

        return redirect('/mode');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = DB::table('tbl_transport_mode')
            ->where('serial_no', $id)
            ->delete();

        if ($data) {
            Session::flash('message', 'Successfully Deleted Data !');
            Session::flash('alert-class', 'btn-info');
        } else {
            Session::flash('message', 'Fail to Delete Data !');
            Session::flash('alert-class', 'btn-danger');
        }
        return redirect('/mode');
    }
}
