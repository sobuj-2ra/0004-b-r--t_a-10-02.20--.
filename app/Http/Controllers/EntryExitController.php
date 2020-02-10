<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\User;
use Session;

class EntryExitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();
        $data['port_names'] = DB::table('tbl_route')
            ->orderBy('route_id', 'desc')
            ->get();
        $data['ivac_services'] = DB::table('tbl_ivac_services')
            ->orderBy('sl', 'asc')
            ->get();
        return view('entry_exit_port.entry_exit_port', $data);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name =  $request->input('port_name');
        $service_type =  $request->input('service_type');

        $check = DB::table('tbl_route')
            ->whereRaw('LOWER(`route_name`) like ?', ['%' . strtolower($name) . '%'])
            ->whereRaw('UPPER(`route_name`) like ?', ['%' . strtolower($name) . '%'])
            ->first();
        if ($check) {
            Session::flash('message', 'Already Added Data !');
            Session::flash('alert-class', 'btn-danger');

        } else {
            $inserted = DB::table('tbl_route')->insert(
                [
                    'route_name' => $name,
                    'service_type' => $service_type,
                ]);

            if ($inserted) {
                Session::flash('message', 'Successfully Added Data !');
                Session::flash('alert-class', 'btn-info');
            } else {
                Session::flash('message', 'Fail to Added Data !');
                Session::flash('alert-class', 'btn-danger');
            }
        }
        return redirect('/entry-exit-port');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit_data = DB::table('tbl_route')->where('route_id', $id)->first();

        return view('entry_exit_port.edit_entry_exit_port', ['edit_data'=>$edit_data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->input('id');
        $port_name = $request->input('port_name');
        $service_type = $request->input('service_type');
        $updated = DB::table('tbl_route')
            ->where('route_id', $id)
            ->update([
                'route_name' => $port_name,
                'service_type' => $service_type,
            ]);

        if ($updated){
            Session::flash('message', 'Successfully Updated Data !');
            Session::flash('alert-class', 'btn-info');
        }else{
            Session::flash('message', 'Fail to Update Data !');
            Session::flash('alert-class', 'btn-danger');
        }
        return redirect('/entry-exit-port');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = DB::table('tbl_route')
            ->where('route_id', $id)
            ->delete();

        if ($data){
            Session::flash('message', 'Successfully Deleted Data !');
            Session::flash('alert-class', 'btn-info');
        }else{
            Session::flash('message', 'Fail to Delete Data !');
            Session::flash('alert-class', 'btn-danger');
        }
        return redirect('/entry-exit-port');
    }
}
