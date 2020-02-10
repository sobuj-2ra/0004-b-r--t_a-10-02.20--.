<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\User;
use Session;

class StickerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['stickers'] = DB::table('tbl_sticker_mapping')
            ->orderBy('id', 'desc')
            ->get();
        $data['centers'] = DB::table('tbl_center_info')
            //->where('center_name', Auth::user()->center_name)
            ->orderBy('centerinfo_id', 'desc')
            ->get();
        return view('sticker.add_sticker', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sticker = $request->input('sticker');
        $center = $request->input('center');
        $region = $request->input('region');
        $remarks = $request->input('remarks');

        $inserted = DB::table('tbl_sticker_mapping')->insert(
            ['sticker' => $sticker,
             'center' => $center,
             'region' => $region,
             'remarks' => $remarks,
             'created_time' => date('Y-m-d H:i:s'),
             'created_by' => auth()->user()->name
            ]);

        if ($inserted){
            Session::flash('message', 'Successfully Added Data !');
            Session::flash('alert-class', 'btn-info');
        }else{
            Session::flash('message', 'Fail to Added Data !');
            Session::flash('alert-class', 'btn-danger');
        }

        return redirect('/sticker');
    }


    public function sticker_view(){
        $data = array();
        $data['stickers'] = DB::table('tbl_sticker_mapping')
            ->orderBy('id', 'desc')
            ->get();
        return view('sticker.view_sticker', $data);
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
        $sticker_data = DB::table('tbl_sticker_mapping')->where('id', $id)->first();

        return view('sticker.edit_sticker', ['sticker_data'=>$sticker_data]);
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
        $sticker = $request->input('sticker');
        $center = $request->input('center');
        $region = $request->input('region');
        $remarks = $request->input('remarks');
        $updated = DB::table('tbl_sticker_mapping')
            ->where('id', $id)
            ->update([
                'sticker' => $sticker,
                'center' => $center,
                'region' => $region,
                'remarks' => $remarks
            ]);

        if ($updated){
            Session::flash('message', 'Successfully Updated Data !');
            Session::flash('alert-class', 'btn-info');
        }else{
            Session::flash('message', 'Fail to Update Data !');
            Session::flash('alert-class', 'btn-danger');
        }
        return redirect('/sticker');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = DB::table('tbl_sticker_mapping')
            ->where('id', $id)
            ->delete();

        if ($data){
            Session::flash('message', 'Successfully Deleted Data !');
            Session::flash('alert-class', 'btn-info');
        }else{
            Session::flash('message', 'Fail to Delete Data !');
            Session::flash('alert-class', 'btn-danger');
        }
        return redirect('/sticker');
    }

    public function search_center(){
        $keyword = $_GET['keyword'];
        $data = DB::table('tbl_center_info')->where('region', $keyword)->get();
        return response()->json($data);
    }

}
