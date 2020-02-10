<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = date('Y-m-d');
        $data = array();
        $data['rate'] = DB::table('tbl_currency_rate')
            ->orderBy('id', 'DESC')
            ->limit(30)
            ->get();

        return view('currency.add_currency', $data);
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

        $arrData = array(
            'currency_name'        => $request->currency,
            'currency_rate'        => $request->rate,
            'reg_date'        => date('Y-m-d'),
            'reg_by'        => Auth::user()->user_id
        );
        DB::table('tbl_currency_rate')->insert($arrData);
        return redirect('/currency')->with('message','Successfully Data Inserted');
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
        $data['rate'] = DB::table('tbl_currency_rate')
            ->where('id', $id)
            ->first();

        return view('currency.edit_currency', $data);
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
        $rate = $request->input('rate');

        $updated = DB::table('tbl_currency_rate')
            ->where('id', $id)
            ->update([
                'currency_rate' => $rate,
                'updated_date' => date('Y-m-d H:i:s')
            ]);
        return redirect('/currency')->with('message','Successfully Updated Data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = DB::table('tbl_currency_rate')
            ->where('id', $id)
            ->delete();
        return redirect('/currency')->with('message','Successfully Deleted Data');
    }
}
