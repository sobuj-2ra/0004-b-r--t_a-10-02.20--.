<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\User;
use Session;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();
        $data['port_names'] = DB::table('tbl_port_names')
            ->orderBy('port_id', 'desc')
            ->get();
        return view('area.area', $data);
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
        $check = DB::table('tbl_port_names')
            ->whereRaw('LOWER(`port_name`) like ?', ['%' . strtolower($name) . '%'])
            ->whereRaw('UPPER(`port_name`) like ?', ['%' . strtolower($name) . '%'])
            ->first();
        if ($check) {
            Session::flash('message', 'Already Added Data !');
            Session::flash('alert-class', 'btn-danger');

        } else {
            $inserted = DB::table('tbl_port_names')->insert(
                ['port_name' => $name,
                    'save_time' => date('Y-m-d H:i:s'),
                    'service_type' => $service_type,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);

            if ($inserted){
                Session::flash('message', 'Successfully Added Data !');
                Session::flash('alert-class', 'btn-info');
            }else{
                Session::flash('message', 'Fail to Added Data !');
                Session::flash('alert-class', 'btn-danger');
            }
        }

        return redirect('/area');
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
        $edit_data = DB::table('tbl_port_names')->where('port_id', $id)->first();

        return view('area.edit_area', ['edit_data'=>$edit_data]);
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
        $updated = DB::table('tbl_port_names')
            ->where('port_id', $id)
            ->update([
                'port_name' => $port_name,
                'service_type' => $service_type,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

        if ($updated){
            Session::flash('message', 'Successfully Updated Data !');
            Session::flash('alert-class', 'btn-info');
        }else{
            Session::flash('message', 'Fail to Update Data !');
            Session::flash('alert-class', 'btn-danger');
        }
        return redirect('/area');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = DB::table('tbl_port_names')
            ->where('port_id', $id)
            ->delete();

        if ($data){
            Session::flash('message', 'Successfully Deleted Data !');
            Session::flash('alert-class', 'btn-info');
        }else{
            Session::flash('message', 'Fail to Delete Data !');
            Session::flash('alert-class', 'btn-danger');
        }
        return redirect('/area');
    }
}
