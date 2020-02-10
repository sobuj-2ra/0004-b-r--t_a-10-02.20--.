<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Session;

class Services extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();
        $data['services'] = DB::table('tbl_ivac_services')
            ->orderBy('sl', 'desc')
            ->get();
        return view('service.service', $data);
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
        $check = DB::table('tbl_ivac_services')
            ->where('Service', 'like', '%'.$request->services)
            ->first();
        if (isset($check)){
            Session::flash('message', 'Service Name Already exist !');
            Session::flash('alert-class', 'btn-danger');
        }else{
            $arrData = array(
                'Service'        => $request->services,
                'slip_copy'        => $request->slip_copy,
                'Svc_Fee'        => $request->Svc_fee,
                'LeadTime'        => $request->LeadTime,
                'SavedBy'        =>Auth::user()->user_id,
                'SaveTime'        => date('Y-m-d H:i:s'),
                'Status'        => 'ON'
            );
            DB::table('tbl_ivac_services')->insert($arrData);
            $id = DB::getPdo()->lastInsertId();

            if ($id){
                Session::flash('message', 'Successfully Added Data !');
                Session::flash('alert-class', 'btn-info');
            }else{
                Session::flash('message', 'Fail to Added Data !');
                Session::flash('alert-class', 'btn-danger');
            }
        }

        return redirect("/services");
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
        $edit_data = DB::table('tbl_ivac_services')->where('sl', $id)->first();

        return view('service.edit_service', ['edit_data'=>$edit_data]);
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
        $id = $request->input('sl');
        $services = $request->input('services');
        $slip_copy = $request->input('slip_copy');
        $Svc_fee = $request->input('Svc_fee');
        $LeadTime = $request->input('LeadTime');
        $updated = DB::table('tbl_ivac_services')
            ->where('sl', $id)
            ->update([
                'Service' => $services,
                'slip_copy' => $slip_copy,
                'Svc_Fee' => $Svc_fee,
                'LeadTime' => $LeadTime,
                'SavedBy' =>Auth::user()->user_id,
                'SaveTime'=> date('Y-m-d H:i:s'),
                'Status'=> 'ON'
            ]);

        if ($updated){
            Session::flash('message', 'Successfully Updated Data !');
            Session::flash('alert-class', 'btn-info');
        }else{
            Session::flash('message', 'Fail to Update Data !');
            Session::flash('alert-class', 'btn-danger');
        }
        return redirect('/services');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = DB::table('tbl_ivac_services')
            ->where('sl', $id)
            ->delete();

        if ($data){
            Session::flash('message', 'Successfully Deleted Data !');
            Session::flash('alert-class', 'btn-info');
        }else{
            Session::flash('message', 'Fail to Delete Data !');
            Session::flash('alert-class', 'btn-danger');
        }
        return redirect('/services');
    }
}
