<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\User;
use Session;

class HolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();;
        $data['holidays'] = DB::table('tbl_holiday')->orderBy('hday_id', 'desc')->limit(60)->get();
        return view('holiday.add_holiday', $data);
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
        $h_date = date('Y-m-d', strtotime($request->input('date')));
        $description = $request->input('description');

        $inserted = DB::table('tbl_holiday')->insert(
            [   'date' => $h_date,
                'description' => $description,
                'entry_date' => date('Y-m-d H:i:s')
            ]);

        if ($inserted){
            Session::flash('message', 'Successfully Added Data !');
            Session::flash('alert-class', 'btn-info');
        }else{
            Session::flash('message', 'Fail to Added Data !');
            Session::flash('alert-class', 'btn-danger');
        }

        return redirect('/add-holiday');
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
        $data = array();
        $data['h_date'] = DB::table('tbl_holiday')->where('hday_id', $id)->first();
        return view('holiday.edit', $data);
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
        $h_date = date('Y-m-d', strtotime($request->input('date')));
        $description = $request->input('description');
        $updated = DB::table('tbl_holiday')
            ->where('hday_id', $id)
            ->update([
                'date' => $h_date,
                'description' => $description
            ]);

        if ($updated){
            Session::flash('message', 'Successfully Updated Data !');
            Session::flash('alert-class', 'btn-info');
        }else{
            Session::flash('message', 'Fail to Update Data !');
            Session::flash('alert-class', 'btn-danger');
        }
        return redirect('/add-holiday');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = DB::table('tbl_holiday')
            ->where('hday_id', $id)
            ->delete();

        if ($data){
            Session::flash('message', 'Successfully Deleted Data !');
            Session::flash('alert-class', 'btn-info');
        }else{
            Session::flash('message', 'Fail to Delete Data !');
            Session::flash('alert-class', 'btn-danger');
        }
        return redirect('/add-holiday');
    }
}
