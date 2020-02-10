<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\User;
use Session;

class VisaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();
        $data['visa_names'] = DB::table('tbl_visa_type')
            ->orderBy('visa_type_id', 'desc')
            ->get();
        return view('visa.add_visa', $data);
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
        $visa_type =  $request->input('visa_type');
        $symbol =  $request->input('symbol');
        $days =  $request->input('days');

        $check = DB::table('tbl_visa_type')
            ->whereRaw('LOWER(`visa_type`) like ?', ['%' . strtolower($visa_type) . '%'])
            ->whereRaw('UPPER(`visa_type`) like ?', ['%' . strtolower($visa_type) . '%'])
            ->first();
        if ($check) {
            Session::flash('message', 'Already Added Visa Type !');
            Session::flash('alert-class', 'btn-danger');

        } else {
            $inserted = DB::table('tbl_visa_type')->insert(
                [   'visa_type' => $visa_type,
                    'symbol'    => $symbol,
                    'days'      => $days
                ]);

            if ($inserted){
                Session::flash('message', 'Successfully Added Data !');
                Session::flash('alert-class', 'btn-info');
            }else{
                Session::flash('message', 'Fail to Added Data !');
                Session::flash('alert-class', 'btn-danger');
            }
        }

        return redirect('/visa');
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
        $edit_data = DB::table('tbl_visa_type')->where('visa_type_id', $id)->first();

        return view('visa.edit_visa', ['edit_data'=>$edit_data]);
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
        $visa_type = $request->input('visa_type');
        $symbol = $request->input('symbol');
        $days = $request->input('days');
        $updated = DB::table('tbl_visa_type')
            ->where('visa_type_id', $id)
            ->update([
                'visa_type' => $visa_type,
                'symbol' => $symbol,
                'days' => $days
            ]);

        if ($updated){
            Session::flash('message', 'Successfully Updated Data !');
            Session::flash('alert-class', 'btn-info');
        }else{
            Session::flash('message', 'Fail to Update Data !');
            Session::flash('alert-class', 'btn-danger');
        }
        return redirect('visa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = DB::table('tbl_visa_type')
            ->where('visa_type_id', $id)
            ->delete();

        if ($data){
            Session::flash('message', 'Successfully Deleted Data !');
            Session::flash('alert-class', 'btn-info');
        }else{
            Session::flash('message', 'Fail to Delete Data !');
            Session::flash('alert-class', 'btn-danger');
        }
        return redirect('visa   ');
    }
}
