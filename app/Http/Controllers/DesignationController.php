<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\designationModel;

class DesignationController extends Controller
{
    function _construct()
    {

    }

    public function add()
    {
        $data = array();
        $data['designations'] = DB::table('tbl_designation')
            ->orderBy('id', 'desc')
            ->get();

    	return view('designation.add_designation', $data);
    }

     public function save(Request $request)
    {

 	$data = new designationModel;

    $data->designation = $request->yourDesignation;

     $data->save();

        return redirect('/designation/add')->with('message','Successfully Data Inserted');
    	
    }

    public function edit_designation($id){
        $designation_data = DB::table('tbl_designation')->where('id', $id)->first();
        //var_dump($designation_data);
        return view('designation.edit_designation', ['designation_data'=>$designation_data]);
    }

    public function update_designation(Request $request){
        $id = $request->input('id');
        $designation = $request->input('designation');
        $data = DB::table('tbl_designation')
            ->where('id', $id)
            ->update([
                'designation' => $designation,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        return redirect('/designation/add')->with('message','Successfully Updated Data');

    }

    public function delete_designation($id){
        $data = DB::table('tbl_designation')
            ->where('id', $id)
            ->delete();
        return redirect('/designation/add')->with('message','Successfully Deleted Data');
    }


}
