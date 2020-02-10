<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\User;
use Session;

class CenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();
        $data['centers'] = DB::table('tbl_center_type')->get();

            $data['names'] = DB::table('tbl_center_info')->get();

        return view('center.add_center', $data);
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
        $center_type = $request->input('center_type');
        $center_name = $request->input('center_name');
        $region = $request->input('region');
        $del_time = $request->del_time_start.'-'.$request->del_time_end;

        $inserted = DB::table('tbl_center_info')->insert(
            [   'center_name' => $center_name,
                'center_type' => $center_type,
                'region' => $region,
                'center_phone' => $request->center_phone,
                'center_fax' => $request->center_fax,
                'center_web' => $request->center_web,
                'del_time' => $del_time,
                'center_info' => $request->center_info,
                'created_at' => date('Y-m-d H:i:s')
            ]);

        if ($inserted){
            Session::flash('message', 'Successfully Added Data !');
            Session::flash('alert-class', 'btn-info');
        }else{
            Session::flash('message', 'Fail to Added Data !');
            Session::flash('alert-class', 'btn-danger');
        }

        return redirect('/center-add');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $data = array();
        $data['centers'] = DB::table('tbl_center_info')
            ->get();
        return view('center.center_list', $data);
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
        $data['centers'] = DB::table('tbl_center_type')->get();
        $data['names'] = DB::table('tbl_center_info')->where('centerinfo_id', $id)->first();
        return view('center.edit', $data);
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
        $name = $request->input('center_name');
        $center_typee = $request->input('center_type');
        $region = $request->input('region');
        $del_time = $request->del_time_start.'-'.$request->del_time_end;
        $updated = DB::table('tbl_center_info')
            ->where('centerinfo_id', $id)
            ->update([
                'center_name' => $name,
                'center_type' => $center_typee,
                'region' => $region,
                'center_phone' => $request->center_phone,
                'center_fax' => $request->center_fax,
                'center_web' => $request->center_web,
                'del_time' => $del_time,
                'center_info' => $request->center_info,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

        if ($updated){
            Session::flash('message', 'Successfully Updated Data !');
            Session::flash('alert-class', 'btn-info');
        }else{
            Session::flash('message', 'Fail to Update Data !');
            Session::flash('alert-class', 'btn-danger');
        }
        return redirect('/center-add');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = DB::table('tbl_center_info')
            ->where('centerinfo_id', $id)
            ->delete();

        if ($data){
            Session::flash('message', 'Successfully Deleted Data !');
            Session::flash('alert-class', 'btn-info');
        }else{
            Session::flash('message', 'Fail to Delete Data !');
            Session::flash('alert-class', 'btn-danger');
        }
        return redirect('/center-add');
    }

//    start center type
    public function center_type_add(){
        $data = array();
        $data['centers'] = DB::table('tbl_center_type')->get();
        return view('center.add_center_type', $data);
    }

    public function store_center_type(Request $request){
        $center_type = $request->input('center_type');

        $inserted = DB::table('tbl_center_type')->insert(
            [   'center_type' => $center_type,
                'created_at' => date('Y-m-d H:i:s')
            ]);

        if ($inserted){
            Session::flash('message', 'Successfully Added Data !');
            Session::flash('alert-class', 'btn-info');
        }else{
            Session::flash('message', 'Fail to Added Data !');
            Session::flash('alert-class', 'btn-danger');
        }
        return redirect('/center-type-add');
    }

    public function edit_center_type($id){
        $data = array();
        $data['centers'] = DB::table('tbl_center_type')->where('id', $id)->first();
        return view('center.edit_center_type', $data);
    }

    public function update_center_type(Request $request){
        $id = $request->input('id');
        $center_typee = $request->input('center_type');
        $updated = DB::table('tbl_center_type')
            ->where('id', $id)
            ->update([
                'center_type' => $center_typee,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

        if ($updated){
            Session::flash('message', 'Successfully Updated Data !');
            Session::flash('alert-class', 'btn-info');
        }else{
            Session::flash('message', 'Fail to Update Data !');
            Session::flash('alert-class', 'btn-danger');
        }
        return redirect('/center-type-add');
    }

    public function destroy_center_type($id){
        $data = DB::table('tbl_center_type')
            ->where('id', $id)
            ->delete();

        if ($data){
            Session::flash('message', 'Successfully Deleted Data !');
            Session::flash('alert-class', 'btn-info');
        }else{
            Session::flash('message', 'Fail to Delete Data !');
            Session::flash('alert-class', 'btn-danger');
        }
        return redirect('/center-type-add');
    }

//   start duration
    public function add_duration(){
        $data = array();
        $data['durations'] = DB::table('tbl_duration')->orderBy('id', 'desc')->get();
        return view('duration.add_duration', $data);
    }

    public function duration_store(Request $request){
        $duration = strtoupper(str_replace(' ', '', $request->input('duration')));
        $check = DB::table('tbl_duration')
            ->where('duration', $duration)
            ->first();
        if (isset($check) && !empty($check)){
            Session::flash('message', 'This Duration Already Exist!');
            Session::flash('alert-class', 'danger');

        }else{
            $inserted = DB::table('tbl_duration')->insert(
                [   'duration' => $duration,
                    'created_date' => date('Y-m-d H:i:s'),
                    'created_by' => auth()->user()->user_id
                ]);

            if ($inserted){
                Session::flash('message', 'Successfully Added Data !');
                Session::flash('alert-class', 'info');
            }else{
                Session::flash('message', 'Fail to Added Data !');
                Session::flash('alert-class', 'danger');
            }
        }


        return redirect('/add-duration');
    }

    public function duration_edit($id){
        $data = array();
        $data['duration'] = DB::table('tbl_duration')->where('id', $id)->first();
        return view('duration.edit_duration', $data);
    }

    public function duration_update(Request $request){
        $id = $request->input('id');
        $duration = strtoupper(str_replace(' ', '', $request->input('duration')));
        $updated = DB::table('tbl_duration')
            ->where('id', $id)
            ->update([
                'duration' => $duration,
                'updated_date' => date('Y-m-d H:i:s'),
                'updated_by' => auth()->user()->user_id,
            ]);

        if ($updated){
            Session::flash('message', 'Successfully Updated Data !');
            Session::flash('alert-class', 'info');
        }else{
            Session::flash('message', 'Fail to Update Data !');
            Session::flash('alert-class', 'danger');
        }
        return redirect('/add-duration');
    }

    public function duration_delete($id){
        $data = DB::table('tbl_duration')
            ->where('id', $id)
            ->delete();

        if ($data){
            Session::flash('message', 'Successfully Deleted Data !');
            Session::flash('alert-class', 'info');
        }else{
            Session::flash('message', 'Fail to Delete Data !');
            Session::flash('alert-class', 'danger');
        }
        return redirect('/add-duration');
    }


//    entry type

    public function add_entry_type(){
        $data = array();
        $data['entry_types'] = DB::table('tbl_entry_type')->orderBy('id', 'desc')->get();
        return view('entry_type.add_entry', $data);
    }

    public function entry_store(Request $request){
        $entry_type = strtoupper(str_replace(' ', '', $request->input('entry_type')));
        $check = DB::table('tbl_entry_type')
            ->where('entry_type', $entry_type)
            ->first();
        if (isset($check) && !empty($check)){
            Session::flash('message', 'This Entry Type Already Exist!');
            Session::flash('alert-class', 'danger');

        }else{
            $inserted = DB::table('tbl_entry_type')->insert(
                [   'entry_type' => $entry_type,
                    'created_date' => date('Y-m-d H:i:s'),
                    'created_by' => auth()->user()->user_id
                ]);

            if ($inserted){
                Session::flash('message', 'Successfully Added Data !');
                Session::flash('alert-class', 'info');
            }else{
                Session::flash('message', 'Fail to Added Data !');
                Session::flash('alert-class', 'danger');
            }
        }


        return redirect('/add-entry-type');
    }

    public function entry_edit($id){
        $data = array();
        $data['entry'] = DB::table('tbl_entry_type')->where('id', $id)->first();
        return view('entry_type.edit_entry', $data);
    }

    public function entry_update(Request $request){
        $id = $request->input('id');
        $entry_type = strtoupper(str_replace(' ', '', $request->input('entry_type')));
        $updated = DB::table('tbl_entry_type')
            ->where('id', $id)
            ->update([
                'entry_type' => $entry_type,
                'updated_date' => date('Y-m-d H:i:s'),
                'updated_by' => auth()->user()->user_id,
            ]);

        if ($updated){
            Session::flash('message', 'Successfully Updated Data !');
            Session::flash('alert-class', 'info');
        }else{
            Session::flash('message', 'Fail to Update Data !');
            Session::flash('alert-class', 'danger');
        }
        return redirect('/add-entry-type');
    }

    public function entry_delete($id){
        $data = DB::table('tbl_entry_type')
            ->where('id', $id)
            ->delete();

        if ($data){
            Session::flash('message', 'Successfully Deleted Data !');
            Session::flash('alert-class', 'info');
        }else{
            Session::flash('message', 'Fail to Delete Data !');
            Session::flash('alert-class', 'danger');
        }
        return redirect('/add-entry-type');
    }




}
