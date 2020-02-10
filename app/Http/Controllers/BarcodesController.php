<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use peal\barcodegenerator\Server\BarCodeServer;

class BarcodesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($data)
    {
        try {

            $barcode = new BarCodeServer("BarCode");

            $barcontent = $barcode->barcodeFactory("BarCode")
                ->renderBarcode(
                    $filepath ='',
                    $text=$data,
                    $size='50',
                    $orientation="horizontal",
                    $code_type="code128", // code_type : code128,code39,code128b,code128a,code25,codabar
                    $print=true,
                    $sizefactor=1.5
                );
            return $barcontent;
        } catch(\Exception $e) {
            return $e->getMessage();
        }
    }

    public static function barcodes($data)
    {
        try {
            $barcode = new BarCodeServer("BarCode");

            $barcontent = $barcode->barcodeFactory("BarCode")
                ->renderBarcode(
                    $filepath ='',
                    $text=$data,
                    $size='50',
                    $orientation="horizontal",
                    $code_type="code128", // code_type : code128,code39,code128b,code128a,code25,codabar
                    $print=true,
                    $sizefactor=2
                );
            return $barcontent;
        } catch(\Exception $e) {
            return $e->getMessage();
        }
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
