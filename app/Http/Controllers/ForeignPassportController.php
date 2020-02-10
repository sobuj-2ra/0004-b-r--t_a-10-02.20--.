<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Excel;
use Input;
use Session;


class ForeignPassportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();
        $data['sticker'] = DB::table('tbl_sticker_mapping')
            ->get();
        $data['visa_type'] = DB::table('tbl_visa_type')
            ->get();
        $data['duration'] = DB::table('tbl_duration')
            ->get();
        $data['entry_type'] = DB::table('tbl_entry_type')
            ->get();
        $data['book_no'] = DB::table('tbl_money_receive')
            ->where('center_name', Auth::user()->center_name)
            ->orderBy('id', 'desc')
            ->first();
        return view('foreign.receive_foreign_passport', $data);
    }

    public function after_submit($stkr, $form, $to, $id)
    {
        $data = array();
        $data['sticker'] = DB::table('tbl_sticker_mapping')
            ->get();
        $data['visa_type'] = DB::table('tbl_visa_type')
            ->get();
        $data['duration'] = DB::table('tbl_duration')
            ->get();
        $data['entry_type'] = DB::table('tbl_entry_type')
            ->get();
        $data['book_no'] = DB::table('tbl_money_receive')
            ->where('center_name', Auth::user()->center_name)
            ->orderBy('id', 'desc')
            ->first();

        //$stk = explode("-", $stkr);
        $data['strks'] = $stkr;
        $data['form'] = $form;
        $data['to'] = $to;
        $data['id'] = $id;
        return view('foreign.receive_foreign_passport', $data);
    }


    public function money_receive_book()
    {
        $data = array();
        $data['center'] = Auth::user()->center_name;
        $data['get_data'] = DB::table('tbl_money_receive')
            ->where('center_name', Auth::user()->center_name)
            ->get();
        return view('foreign.money_receive_book', $data);
    }

    public function money_receive_book_store(Request $request)
    {
        $book_no = $request->book_no;
        $get_check = DB::table('tbl_money_receive')
            ->where('book_no', $book_no)
            ->where('center_name', Auth::user()->center_name)
            ->first();
        if ($get_check) {
            Session::flash('message', 'Book No Already Exist!');
            Session::flash('alert-class', 'btn-danger');
            return redirect("/money-receive-book");
        } else {
            $arrData = array(
                'center_name' => $request->center_name,
                'book_no' => $request->book_no,
                'start_no' => $request->start_no,
                'end_no' => $request->end_no,
                'created_date' => date('Y-m-d H:i:s'),
                'created_by' => Auth::user()->user_id
            );
            DB::table('tbl_money_receive')->insert($arrData);
            $id = DB::getPdo()->lastInsertId();
            if ($id) {
                Session::flash('message', 'Successfully Added Data !');
                Session::flash('alert-class', 'btn-info');
            } else {
                Session::flash('message', 'Fail to Added Data !');
                Session::flash('alert-class', 'btn-danger');
            }
            return redirect("/money-receive-book");
        }
    }


    public function edit_money_receive($id)
    {
        $data = array();
        $data['get_data'] = DB::table('tbl_money_receive')
            ->where('id', $id)
            ->first();
        $data['visa_type'] = DB::table('tbl_visa_type')
            ->get();
        return view('foreign.edit_money_receive_book', $data);
    }

    public function update_money_receive(Request $request)
    {
        $book_no = $request->book_no;
        $get_check = DB::table('tbl_money_receive')
            ->where('book_no', $book_no)
            ->where('center_name', Auth::user()->center_name)
            ->whereNotIn('id', [$request->id])
            ->first();
        if ($get_check) {
            Session::flash('message', 'Book No Already Exist!');
            Session::flash('alert-class', 'btn-danger');
            return redirect("edit_money_receive/$request->id");
        } else {
            $arrData = array(
                'book_no' => $request->book_no,
                'start_no' => $request->start_no,
                'end_no' => $request->end_no,
                'updated_date' => date('Y-m-d H:i:s'),
                'created_by' => Auth::user()->user_id
            );
            $updated = DB::table('tbl_money_receive')
                ->where('id', $request->id)
                ->update($arrData);
            if ($updated) {
                Session::flash('message', 'Successfully Updated Data !');
                Session::flash('alert-class', 'btn-info');
            } else {
                Session::flash('message', 'Fail to Updated Data !');
                Session::flash('alert-class', 'btn-danger');
            }
            return redirect("/money-receive-book");
        }
    }

    public function delete_money_receive($id)
    {
        $delete = DB::table('tbl_money_receive')->where('id', $id)->delete();
        if ($delete) {
            Session::flash('message', 'Successfully Deleted Data !');
            Session::flash('alert-class', 'btn-info');
        } else {
            Session::flash('message', 'Fail to Deleted Data !');
            Session::flash('alert-class', 'btn-danger');
        }
        return redirect("/money-receive-book");
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = array();
        $today = date('Y-m-d');
        $c_row = $request->count_row;


        $strk_no = array();
        $strk_number = array();
        $passport = array();
        $name = array();
        $contact = array();
        $web = array();
        $nationality = array();
        $date_of_checking = array();
        $duration = array();
        $entry = array();
        $visa = array();
        $visa_fee = array();
        $fax_fee = array();
        $icwf_fee = array();
        $app_fee = array();
        $total_fee = array();
        $quantity = array();

        $form = $request->strk_form;
        $to = $request->strk_to;
        $pass = $request->passport;
        $s_no = $request->strk_no;
        $s_number = $request->strk_number;
        $app_names = $request->app_name;
        $contacts = $request->contact;
        $web_file_nos = $request->web_file_no;
        $nationalitys = $request->nationality;
        $date_of_checkings = $request->date_of_checking;
        $durations = $request->duration;
        $entry_types = $request->entry_type;
        $visa_types = $request->visa_type;
        $visa_fees = $request->visa_fee;
        $fax_trans_charges = $request->fax_trans_charge;
        $icwfs = $request->icwf;
        $visa_app_charges = $request->visa_app_charge;
        $total_amounts = $request->total_amount;
        $old_passport_qtys = $request->old_passport_qty;


        foreach ($pass as $value) {
            $pas = strtoupper(str_replace(' ', '', $value));
            $checking = DB::select("SELECT * FROM `tbl_fp_served` WHERE `passport` = '$pas' AND date(created_date) = '$today' ");
            if (isset($checking) && !empty($checking)) {
                Session::flash('message', 'Today This Passport Already Exist !');
                Session::flash('alert-class', 'btn-danger');
                return redirect("/foreign-passport-receive");
            } else {
                $passport[] = [
                    'passport' => $pas
                ];
            }

        }
        for ($i = 1; $i <= $c_row; $i++) {
            if ($i == 1) {
                $gratise[] = ['gratise' => $request->gratis_status1];
            } elseif ($i == 2) {
                $gratise[] = ['gratise' => $request->gratis_status2];
            } elseif ($i == 3) {
                $gratise[] = ['gratise' => $request->gratis_status3];
            } elseif ($i == 4) {
                $gratise[] = ['gratise' => $request->gratis_status4];
            } elseif ($i == 5) {
                $gratise[] = ['gratise' => $request->gratis_status5];
            }
        }
        foreach ($s_no as $value) {
            $strk_no[] = [
                'strk_no' => $value
            ];
        }
        foreach ($s_number as $value) {
            $strk_number[] = [
                '$strk_number' => $value
            ];
        }
        foreach ($app_names as $value) {
            $name[] = [
                'name' => $value
            ];
        }
        foreach ($contacts as $value) {
            $contact[] = [
                'contact' => $value
            ];
        }
        foreach ($web_file_nos as $value) {
            $web[] = [
                'web' => strtoupper(str_replace(' ', '', $value))
            ];
            $webs = strtoupper(str_replace(' ', '', $value));
            $checking = DB::select("SELECT * FROM `tbl_fp_served` WHERE `web_file_no` = '$webs'");
            if (isset($checking) && !empty($checking)) {
                Session::flash('message', ' This Web File Number Already Exist !');
                Session::flash('alert-class', 'btn-danger');
                return redirect("/foreign-passport-receive");
            }
//            $data[] = [
//                'barcode_data' => app('App\Http\Controllers\BarcodeController')->index($webs)
//            ];

        }
        foreach ($nationalitys as $value) {
            $nationality[] = [
                'nationality' => strtoupper($value)
            ];
        }
        foreach ($date_of_checkings as $value) {
            $date_of_checking[] = [
                'date_of_checking' => date('Y-m-d', strtotime($value))
            ];
        }
        foreach ($durations as $value) {
            $duration[] = [
                'duration' => $value,
            ];
        }
        foreach ($entry_types as $value) {
            $entry[] = [
                'entry_type' => $value,
            ];
        }
        foreach ($visa_types as $value) {

            $visa[] = [
                'visa_type' => $value,
            ];
        }
        $i = 1;
        $lead_time = array();
        $d_date = array();
        foreach ($visa as $v) {
            array_push($lead_time, $this->delivery_date($today, $v['visa_type']));
        }
        foreach ($lead_time as $item) {
            $d_date[] = [
                'tdd' => $item,
            ];
        }

        foreach ($visa_fees as $value) {
            if ($value == 0 || $value == "NULL") {
                $visa_fee[] = [
                    'visa_fee' => "NULL",
                ];
            } else {
                $visa_fee[] = [
                    'visa_fee' => $value,
                ];
            }


        }
        foreach ($fax_trans_charges as $value) {
            if ($value == 0 || $value == "NULL") {
                $fax_fee[] = [
                    'fax_fee' => "NULL",
                ];
            } else {
                $fax_fee[] = [
                    'fax_fee' => $value,
                ];
            }

        }
        foreach ($icwfs as $value) {
            if ($value == 0 || $value == "NULL") {
                $icwf_fee[] = [
                    'icwf_fee' => "NULL",
                ];
            } else {
                $icwf_fee[] = [
                    'icwf_fee' => $value,
                ];
            }

        }
        foreach ($visa_app_charges as $value) {
            if ($value == 0 || $value == "NULL") {
                $app_fee[] = [
                    'app_fee' => "NULL",
                ];
            } else {
                $app_fee[] = [
                    'app_fee' => $value,
                ];
            }

        }
        foreach ($total_amounts as $value) {
            if ($value == 0) {
                $total_fee[] = [
                    'total_fee' => 0,
                ];
            } else {
                $total_fee[] = [
                    'total_fee' => $value,
                ];
            }

        }
        foreach ($old_passport_qtys as $value) {
            if ($value != 0) {
                $quantity[] = [
                    'quantity' => $value,
                ];
            } else if ($value == 0) {
                $quantity[] = [
                    'quantity' => " ",
                ];
            }
        }
        $center_name = DB::table('tbl_center_info')->select('center_name','region')->where('center_name', Auth::user()->center_name)->first();

        $rupee = DB::table('tbl_currency_rate')
            ->where('currency_name', 'RUPEE')
            ->orderBy('id', 'desc')
            ->first();
        $rupee_r = 1 / $rupee->currency_rate;
        $temp = array();
        foreach ($passport as $key => $values) {
            $temp[$key]['passport'] = $values['passport'];
            $temp[$key]['gratis_status'] = $gratise[$key]['gratise'];
            if (isset($strk_no[$key]['strk_no']) && !empty($strk_no[$key]['strk_no'])) {
                $temp[$key]['strk_no'] = $strk_no[$key]['strk_no'] . '-' . $strk_number[$key]['$strk_number'];
            } else {
                $temp[$key]['strk_no'] = $strk_number[$key]['$strk_number'];
            }


            $temp[$key]['app_name'] = $name[$key]['name'];
            $temp[$key]['contact'] = $contact[$key]['contact'];
            $temp[$key]['web_file_no'] = $web[$key]['web'];
            $temp[$key]['nationality'] = $nationality[$key]['nationality'];
            $temp[$key]['date_of_checking'] = $date_of_checking[$key]['date_of_checking'];
            $temp[$key]['remarks'] = $duration[$key]['duration'] . '/' . $entry[$key]['entry_type'] . '/' . $visa[$key]['visa_type'];
            $temp[$key]['visa_type'] = $visa[$key]['visa_type'];
            $temp[$key]['visa_fee'] = $visa_fee[$key]['visa_fee'];
            $temp[$key]['fax_trans_charge'] = $fax_fee[$key]['fax_fee'];
            $temp[$key]['icwf'] = $icwf_fee[$key]['icwf_fee'];
            $temp[$key]['visa_app_charge'] = $app_fee[$key]['app_fee'];
            if ($total_fee[$key]['total_fee'] != 0) {
                $temp[$key]['total_amount'] = $total_fee[$key]['total_fee'];
                $temp[$key]['total_rupee'] = $rupee_r * $total_fee[$key]['total_fee'];
            } else if ($total_fee[$key]['total_fee'] == 0 || $total_fee[$key]['total_fee'] == '0') {
                $temp[$key]['total_amount'] = " ";
                $temp[$key]['total_rupee'] = " ";
            }

            $temp[$key]['receive_no'] = $request->receive_no;
            $temp[$key]['book_no'] = $request->book_no;


            $temp[$key]['rupee_rate'] = $rupee_r;
            $temp[$key]['receiving_date'] = date('Y-m-d H:i:s');
            $temp[$key]['center'] = Auth::user()->center_name;
            $temp[$key]['region'] = $center_name->region;
            $temp[$key]['created_date'] = date('Y-m-d H:i:s');
            $temp[$key]['rec_cen_time'] = date('Y-m-d H:i:s');
            $temp[$key]['created_by'] = Auth::user()->user_id;
            $temp[$key]['rec_cen_by'] = Auth::user()->user_id;
            //$temp[$key]['tdd']    = $value['passport'];
            $temp[$key]['old_passport_qty'] = $quantity[$key]['quantity'];


            $temp[$key]['status'] = 1;
            $temp[$key]['active'] = 1;
            $temp[$key]['tdd'] = $d_date[$key]['tdd'];
        }

        $temp = array_map('array_filter', $temp);

        $temp = array_filter($temp);

        DB::table('tbl_fp_served')->insert($temp);
        $id = DB::getPdo()->lastInsertId();

        $grt = DB::table('tbl_fp_served')
            ->where('id', $id)
            ->first();
        if ($grt->gratis_status == 'yes') {
            return redirect("foreign-passport-slip-copy-gratise/$c_row/$id");
        } else {
            return redirect("foreign-passport-slip-copy/$s_no[0]/$form/$to/$c_row/$id");
        }


    }

    public function foreign_passport_slip_copy($strk = '', $from = '', $to = '', $c_row, $id)
    {
        $data = array();
        $data['strk'] = $strk;
        $data['from'] = $from;
        $data['to'] = $to;
        $data['id'] = $id;
        $data['val'] = $s_data = DB::table('tbl_fp_served')
            ->where('id', $id)
            ->first();
        $data['service'] = DB::table('tbl_ivac_services')
            ->where('Service', 'Foreign Passport')
            ->first();
        $data['center'] = DB::table('tbl_center_info')
            ->where('center_name', $s_data->center)
            ->first();
        $data['c_row'] = $c_row;
        $data['id'] = $id;

        return view('foreign.slip_print', $data);
    }

    public function foreign_passport_slip_copy_gratise($c_row, $id)
    {
        $data = array();
        $data['id'] = $id;
        $data['val'] = $s_data = DB::table('tbl_fp_served')
            ->where('id', $id)
            ->first();
        $data['service'] = DB::table('tbl_ivac_services')
            ->where('Service', 'Foreign Passport')
            ->first();
        $data['center'] = DB::table('tbl_center_info')
            ->where('center_name', $s_data->center)
            ->first();
        $data['visa_type'] = DB::table('tbl_visa_type')
            ->get();
        $data['duration'] = DB::table('tbl_duration')
            ->get();
        $data['entry_type'] = DB::table('tbl_entry_type')
            ->get();
        $data['c_row'] = $c_row;
        $data['id'] = $id;

        return view('foreign.slip_print', $data);
    }

    public function search_sticker_number()
    {
        if (isset($_GET['name']) && !empty($_GET['name'])) {
            $number = $_GET['numb'];
            $name = $_GET['name'];
            $strk = $name . '-' . $number;
            $d = date('Y-m-d');

            $data = DB::select("SELECT * FROM `tbl_fp_served` WHERE date(created_date) = '$d' AND strk_no = '$strk'");
            return response()->json($data);
        } else {
            $number = $_GET['numb'];
            //$name = $_GET['name'];
            //$strk = $name . '-' . $number;
            $d = date('Y-m-d');

            $data = DB::select("SELECT * FROM `tbl_fp_served` WHERE date(created_date) = '$d' AND strk_no = '$number'");
            return response()->json($data);
        }

    }

    public function search_receive_number()
    {
        $receive_no = $_GET['receive_no'];
        $book_no = $_GET['book_no'];
        $center = Auth::user()->center_name;

        $data = DB::select("SELECT * FROM `tbl_fp_served` WHERE book_no = '$book_no' AND receive_no = '$receive_no' AND center = '$center'");
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit_receive_foreign_passport()
    {
        $data = array();
        if (isset($_POST['submit'])) {
            $passport = strtoupper(str_replace(' ', '', $_POST['passport']));
            $data['editData'] = DB::table('tbl_fp_served')
                ->where('passport', $passport)
                ->orderBy('id', 'DESC')
                ->First();
            if (isset($data['editData']) && !empty($data['editData'])) {
                $data['sticker'] = DB::table('tbl_sticker_mapping')
                    ->get();
                $data['book_no'] = DB::table('tbl_money_receive')
                    ->where('center_name', Auth::user()->center_name)
                    ->orderBy('id', 'desc')
                    ->first();

                $data['duration'] = DB::table('tbl_duration')
                    ->get();
                $data['entry_type'] = DB::table('tbl_entry_type')
                    ->get();
                $data['visa_type'] = DB::table('tbl_visa_type')
                    ->get();
                $data['remarks'] = explode("/", $data['editData']->remarks);
            } else {
                $data['messages'] = '<h4 align="center">No Passport Match</h4>';
            }


        }

        return view('foreign.edit_receive_foreign_passport', $data);
    }

    public function update_foreign_passport(Request $request)
    {
        $gratis_status = $request->gratis_status;
        $remarks = $request->duration . '/' . $request->entry_type . '/' . $request->visa_type;
        $strk = $request->strk_number;
        $rupee = $request->rupee;
        $total_rupee = $rupee * $request->total_amount;
        $book_no = $request->book_no;

        if ($gratis_status == 'yes') {
            $arrData = array(
                'passport' => strtoupper(str_replace(' ', '', $request->passport)),
                'gratis_status' => $request->gratis_status,
                'strk_no' => $strk,
                'app_name' => $request->app_name,
                'contact' => (int)$request->contact,
                'web_file_no' => strtoupper(str_replace(' ', '', $request->web_file_no)),
                'nationality' => strtoupper($request->nationality),
                'date_of_checking' => date('Y-m-d', strtotime($request->date_of_checking)),
                'remarks' => $remarks,
                'updated_date' => date('Y-m-d H:i:s'),
                'updated_by' => Auth::user()->user_id,
                'old_passport_qty' => $request->old_passport_qty,
                'visa_fee' => $request->visa_fee,
                'fax_trans_charge' => $request->fax_trans_charge,
                'icwf' => $request->icwf,
                'visa_app_charge' => $request->visa_app_charge,
                'total_amount' => $request->total_amount,
                'total_rupee' => $total_rupee,
                'receive_no' => $request->receive_no,
                'book_no' => $book_no,
            );
            $updated = DB::table('tbl_FP_served')
                ->where('id', $request->id)
                ->update($arrData);
            if ($updated) {
                Session::flash('message', 'Successfully Updated Data !');
                Session::flash('alert-class', 'btn-info');
            } else {
                Session::flash('message', 'Fail to Updated Data !');
                Session::flash('alert-class', 'btn-danger');
            }
            return redirect("edit-foreign-passport-slip-copy-gratise/$request->id");
        } else {



            $arrData = array(
                'passport' => strtoupper(str_replace(' ', '', $request->passport)),
                'gratis_status' => $request->gratis_status,
                'receive_no' => $request->receive_no,
                'book_no' => $book_no,
                'app_name' => $request->app_name,
                'contact' => (int)$request->contact,
                'web_file_no' => strtoupper(str_replace(' ', '', $request->web_file_no)),
                'nationality' => strtoupper($request->nationality),
                'date_of_checking' => date('Y-m-d', strtotime($request->date_of_checking)),
                'remarks' => $remarks,
                'updated_date' => date('Y-m-d H:i:s'),
                'updated_by' => Auth::user()->user_id,
                'strk_no' => $strk,
                'visa_fee' => $request->visa_fee,
                'fax_trans_charge' => $request->fax_trans_charge,
                'icwf' => $request->icwf,
                'visa_app_charge' => $request->visa_app_charge,
                'total_amount' => $request->total_amount,
                'total_rupee' => $total_rupee,
                'old_passport_qty' => $request->old_passport_qty
            );
            $up = DB::table('tbl_FP_served')
                ->where('id', $request->id)
                ->update($arrData);
            if ($up) {
                Session::flash('message', 'Successfully Updated Data !');
                Session::flash('alert-class', 'btn-info');
            } else {
                Session::flash('message', 'Fail to Updated Data !');
                Session::flash('alert-class', 'btn-danger');
            }
            return redirect("edit-foreign-passport-slip-copy-gratise/$request->id");

        }
    }

    public function edit_foreign_passport_slip_copy_gratise($id)
    {
        $data = array();
        $data['id'] = $id;
        $data['val'] = $s_data = DB::table('tbl_fp_served')
            ->where('id', $id)
            ->first();
        $data['service'] = DB::table('tbl_ivac_services')
            ->where('Service', 'Foreign Passport')
            ->first();
        $data['center'] = DB::table('tbl_center_info')
            ->where('center_name', $s_data->center)
            ->first();

        return view('foreign.edit_slip_copy', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function delete_page()
    {
        $data = array();
        if (isset($_POST['submit'])) {
            $passport = strtoupper(str_replace(' ', '', $_POST['passport']));
            $data['deleteDatas'] = DB::table('tbl_fp_served')
                ->where('passport', $passport)
                ->orderBy('id', 'DESC')
                ->get();
        }
        return view('foreign.delete', $data);
    }

    public function destroy($id)
    {
        $get_data = DB::table('tbl_fp_served')->where('id', $id)->first();
        $data = $get_data->passport.';'.$get_data->gratis_status.';'.$get_data->strk_no.';'.$get_data->receive_no.';'.$get_data->app_name.';'.$get_data->contact.';'.$get_data->web_file_no.';'.$get_data->center.';'.$get_data->remarks;
        $delete = DB::table('tbl_fp_served')->where('id', $id)->delete();
        if ($delete) {
            DB::table('tbl_delete_log')->insert(
                ['delete_id' => $id,
                    'type' => 4,
                    'delete_data' => $data,
                    'delete_by' => Auth::user()->user_id,
                    'delete_date' => date('Y-m-d H:i:s'),
                ]);
        }
        if ($delete) {
            Session::flash('message', 'Successfully Deleted Data !');
            Session::flash('alert-class', 'btn-info');
        } else {
            Session::flash('message', 'Fail to Deleted Data !');
            Session::flash('alert-class', 'btn-danger');
        }
        return redirect('/delete-foreign-passport');
    }

    public function reprint()
    {
        $data = array();
        if (isset($_POST['submit'])) {
            $passport = strtoupper(str_replace(' ', '', $_POST['passport']));
            $data['deleteData'] = $s_data = DB::table('tbl_fp_served')
                ->where('passport', $passport)
                ->orderBy('id', 'DESC')
                ->first();
            $data['service'] = DB::table('tbl_ivac_services')
                ->where('Service', 'Foreign Passport')
                ->first();
            $data['center'] = DB::table('tbl_center_info')
                ->where('center_name', $s_data->center)
                ->first();
        }
        return view('foreign.reprint', $data);
    }

//    report

    public function visa_fee_collection_report()
    {
        return view('foreign.visa_fee_collection_report_view');
    }

    public function foreign_visa_fee_collection_report_search(Request $request)
    {
        $data = array();
        $from_date = $request->input('from_date');
        $from = date('Y-m-d', strtotime($from_date));
        $to_date = $request->input('to_date');
        $to = date('Y-m-d', strtotime($to_date));
        $data['formDate'] = $from;
        $data['toDate'] = $to;
        $data['c_name'] = Auth::user()->center_name;

        $data['center'] = DB::table('tbl_center_info')
            ->where('center_name', Auth::user()->center_name)
            ->orderBy('centerinfo_id', 'desc')
            ->first();
        $data['print_data'] = DB::select("SELECT * FROM `tbl_fp_served` WHERE date(created_date) >= '$from' AND date(created_date) <= '$to'");
        //$data['receipt'] = $receipt = DB::select("SELECT * FROM `tbl_fp_served` WHERE date(created_date) >= '$from' AND date(created_date) <= '$to' GROUP BY book_no");
        $data['receipt'] = $receipt = DB::select("SELECT book_no, MIN(`receive_no`) AS mini, MAX(`receive_no`) AS maxi FROM `tbl_fp_served` WHERE `book_no` IS NOT NULL AND `receive_no` IS NOT NULL AND date(created_date) >= '$from' AND date(created_date) <= '$to' GROUP BY book_no");
//var_dump($data['receipt']);
//exit();


        return view('foreign.visa_fee_collection_report_print', $data);
    }

    public function foreign_details_report()
    {
        $data = array();
        $data['details'] = DB::select('select created_by from `tbl_fp_served` group by `created_by`');
        return view('foreign.foreign_details_reports', $data);
    }

    public function foreign_details_report_search(Request $request)
    {
        $data = array();
        $user_id = $request->input('user_id');
        $from_date = $request->input('from_date');
        $from = date('Y-m-d', strtotime($from_date));
        $to_date = $request->input('to_date');
        $to = date('Y-m-d', strtotime($to_date));
        $data['formDate'] = $from;
        $data['toDate'] = $to;
        $data['user_id'] = $user_id;

        if ($user_id == 'all') {
            $data['print_data'] = DB::select("SELECT * FROM `tbl_fp_served` WHERE date(created_date) >= '$from' AND date(created_date) <= '$to'");
        } else {
            $data['print_data'] = DB::select("SELECT * FROM `tbl_fp_served` WHERE `created_by` = '$user_id' AND date(created_date) >= '$from' AND date(created_date) <= '$to'");
        }
        return view('foreign.foreign_details_reports_print', $data);
    }

    public function foreign_summary()
    {
        $data = array();
        $data['details'] = DB::select('select created_by from `tbl_fp_served` group by `created_by`');

        return view('foreign.summary_report', $data);
    }

    public function foreign_summary_report_search(Request $request)
    {
        $data = array();
        $user_id = $request->input('user_id');
        $from_date = $request->input('from_date');
        $from = date('Y-m-d', strtotime($from_date));
        $to_date = $request->input('to_date');
        $to = date('Y-m-d', strtotime($to_date));
        $data['formDate'] = $from;
        $data['toDate'] = $to;
        $data['user_id'] = $user_id;
        if ($user_id == 'all') {
            //$data['print_data'] = DB::select("SELECT * FROM `tbl_dollar_endorsement` WHERE `created_date` >= date('$from_date') AND `created_date` <= date('$to_date')");
            $data['print_data'] = DB::select("SELECT count(*) as count_row, `created_date`,`created_by` FROM tbl_fp_served WHERE date(created_date) >='$from' AND date(created_date) <= '$to' GROUP BY date(created_date)");
        } else {
            $data['print_data'] = DB::select("SELECT count(*) as count_row, `created_date`,`created_by` FROM tbl_fp_served WHERE created_by='$user_id' AND date(created_date) >= '$from' AND date(created_date) <= '$to' GROUP BY date(created_date)");
        }
        return view('foreign.foreign_summary_reports_print', $data);
    }

    public static function delivery_date($r_date, $value)
    {

        $reciveDate = $r_date;

        /*Taking Lead Time*/
        $sql = "SELECT days FROM  tbl_visa_type WHERE   visa_type ='$value'";
        $LeadTime = DB::select($sql);

        /*Taking Holidays List*/
        $sql_holiday = "SELECT date(date) as dt FROM  tbl_holiday";
        $hday = DB::select($sql_holiday);

        $leadDate = $LeadTime[0]->days;

        $tmp = array();
        $temdt = array();
        $x = 1;

        foreach ($hday as $val) {
            $tmp[] = $val->dt;
        }

        while ($x <= $leadDate) {

            $temdt[] = date('Y-m-d', strtotime($reciveDate . " + $x day"));
            $newdat = array();
//Sprint_r($temdt);

            foreach ($temdt as $value) {

                if (in_array($value, $tmp)) {
                    $newdat[] = $value;
                }
            }
            $x++;
        }

        $hcount = count($newdat);

        $cnt = ($leadDate + $hcount);

        $newDate = date('Y-m-d', strtotime($reciveDate . " + $cnt day"));

        return $newDate;

    }


}
