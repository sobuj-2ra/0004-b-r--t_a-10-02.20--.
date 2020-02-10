<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Excel;
use Input;
use Session;
use Number_to_string;

class DollarEndorsementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = array();
        $data['center_name'] = Auth::user()->sbi_branch_name;
        $data['serviceFee'] = DB::table('tbl_ivac_services')
            ->where('Service', 'Dollar Endorsement')
            ->First();
        $data['currencyName'] = DB::table('tbl_currency_rate')
            ->where('reg_date', date('Y-m-d'))
            ->where('currency_name', 'USD')
            ->orderBy('id', 'DESC')
            ->first();
        $data['refers'] = DB::table('tbl_dollarendorsement_reference')
            ->where('center', Auth::user()->center_name)
            ->orderBy('id', 'ASC')
            ->get();
        $data['commission_per_passport'] = DB::table('tbl_commission')
            ->where('ivac_service', '=','Dollar Endorsement')
            ->orderBy('id', 'desc')
            ->first();


        $now = date('Y-m-d');

        $data['counts'] = DB::select("select COUNT(id) as c_count from `tbl_dollar_endorsement` where date(created_date)= '$now'");
        $data['balance'] = DB::select("select SUM(t_amount) as sum_bdt from `tbl_dollar_endorsement` where date(created_date)= '$now'");
        $data['travel_card'] = DB::select("select SUM(f_currency) as sum_f_currency from `tbl_dollar_endorsement` where date(created_date)= '$now'");
        $data['commission'] = DB::select("select SUM(commission) as sum_commission from `tbl_dollar_endorsement` where date(created_date)= '$now'");
        $data['service_charge'] = DB::select("select SUM(s_charge) as sum_s_charge from `tbl_dollar_endorsement` where date(created_date)= '$now'");
        return view('dollar.dollarEndorsement', $data);
    }

    public function index2($id)
    {

        $data = array();
        $data['center_name'] = Auth::user()->sbi_branch_name;
        $data['serviceFee'] = DB::table('tbl_ivac_services')
            ->where('Service', 'Dollar Endorsement')
            ->First();
        $data['currencyName'] = DB::table('tbl_currency_rate')
            ->where('reg_date', date('Y-m-d'))
            ->orderBy('id', 'DESC')
            ->first();
        $data['print_data'] = $single_row = DB::table('tbl_dollar_endorsement')
            ->where('id', $id)
            ->orderBy('id', 'DESC')
            ->first();
        if (isset($single_row->branch_name) && !empty($single_row->branch_name)){
        $data['branch_address'] = DB::table('tbl_sbi_branch')
            ->where('branch_name', '=', $single_row->branch_name)
            ->orderBy('id', 'DESC')
            ->First();
            }
        if (isset($single_row) && !empty($single_row)) {
            $data['amount'] = $this->convert_number_to_words($single_row->f_currency);
        } else {
            $data['amount'] = '';
        }

        $now = date('Y-m-d');

        return view('dollar.tm_form_print', $data);
    }

    public function edit_print($id)
    {
        $data = array();
        $data['center_name'] = Auth::user()->sbi_branch_name;
        $data['serviceFee'] = DB::table('tbl_ivac_services')
            ->where('Service', 'Dollar Endorsement')
            ->First();
        $data['currencyName'] = DB::table('tbl_currency_rate')
            ->where('reg_date', date('Y-m-d'))
            ->orderBy('id', 'DESC')
            ->first();
        $data['print_data'] = $single_row = DB::table('tbl_dollar_endorsement')
            ->where('id', $id)
            ->orderBy('id', 'DESC')
            ->first();
        if (isset($single_row->branch_name) && !empty($single_row->branch_name)){
            $data['branch_address'] = DB::table('tbl_sbi_branch')
                ->where('branch_name', '=', $single_row->branch_name)
                ->orderBy('id', 'DESC')
                ->First();
        }
        if (isset($single_row) && !empty($single_row)) {
            $data['amount'] = $this->convert_number_to_words($single_row->f_currency);
        } else {
            $data['amount'] = '';
        }

        $now = date('Y-m-d');

        return view('dollar.tm_edit_print', $data);
    }


    public function search_dollar_rate()
    {
        $keyword = $_GET['keyword'];
        $data = DB::table('tbl_currency_rate')->where('currency_name', $keyword)->first();
        return response()->json($data);
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (isset($request->employment_type) && !empty($request->employment_type)) {
            $employment_type = implode(",", $request->employment_type);
        } else {
            $employment_type = '';
        }
        if (isset($request->p_name) && !empty($request->p_name)) {
            $p_name = implode(",", $request->p_name);
        } else {
            $p_name = '';
        }
        if (isset($request->s_name) && !empty($request->s_name)) {
            $s_name = implode(",", $request->s_name);
        } else {
            $s_name = '';
        }
        if (isset($request->s_e_name) && !empty($request->s_e_name)) {
            $s_e_name = implode(",", $request->s_e_name);
        } else {
            $s_e_name = '';
        }
        if (isset($request->travel_type) && !empty($request->travel_type)) {
            $travel_type = implode(",", $request->travel_type);
        } else {
            $travel_type = '';
        }
        if (isset($request->sbl_banker_account_nature) && !empty($request->sbl_banker_account_nature)) {
            $sbl_banker_account_nature = implode(",", $request->sbl_banker_account_nature);
        } else {
            $sbl_banker_account_nature = '';
        }

        if (isset($request->created_date) && !empty($request->created_date)) {
            $create_at = date('Y-m-d', strtotime($request->created_date));
        } else {
            $create_at = date('Y-m-d', strtotime($request->created_date));
        }
        if (isset($request->a_birth) && !empty($request->a_birth)) {
            $birth = date('Y-m-d', strtotime($request->a_birth));
        } else {
            $birth = '';
        }
        if (isset($request->date_of_issue) && !empty($request->date_of_issue)) {
            $date_of_issue = date('Y-m-d', strtotime($request->date_of_issue));
        } else {
            $date_of_issue = '';
        }
        if (isset($request->expire_date) && !empty($request->expire_date)) {
            $expire_date = date('Y-m-d', strtotime($request->expire_date));
        } else {
            $expire_date = '';
        }
        if (isset($request->travel_date) && !empty($request->travel_date)) {
            $travel_date = date('Y-m-d', strtotime($request->travel_date));
        } else {
            $travel_date = '';
        }
        if (isset($request->sbl_account_type) && !empty($request->sbl_account_type)) {
            $sbl_account_type = implode(",", $request->sbl_account_type);
        } else {
            $sbl_account_type = '';
        }
        if (isset($request->gender) && !empty($request->gender)) {
            $gender = $request->gender;
        } else {
            $gender = '';
        }
        $pass = strtoupper(str_replace(' ', '', $request->passport_no));
        $center = DB::table('tbl_center_info')
            ->orderBy('centerinfo_id', 'DESC')
            ->first();
        $today = date('Y-m-d');
        $checking_reg = DB::select("SELECT * FROM `tbl_dollar_endorsement` WHERE `serial_number` = '$request->serial_number' AND date(created_date) = '$today' ");
        if (isset($checking_reg) && !empty($checking_reg)){
            Session::flash('message', 'Today This Registration Number Already Exist!');
            Session::flash('alert-class', 'btn-danger');
            return redirect("/dollar_endorsement");
        }
        $checking = DB::select("SELECT * FROM `tbl_dollar_endorsement` WHERE `passport_no` = '$pass' AND date(created_date) = '$today' ");
        if (isset($checking) && !empty($checking)){
            Session::flash('message', 'Today This Passport Already Exist!');
            Session::flash('alert-class', 'btn-danger');
            return redirect("/dollar_endorsement");
        }else{
            $arrData = array(
                'serial_number' => $request->serial_number,
                'c_rate' => $request->c_rate,
                'branch_name' => $request->branch_name,
                'branch_code' => $request->branch_code,
                'c_type' => $request->c_type,
                'f_currency' => $request->f_currency,
                'commission' => $request->commission,
                'amount_bdt' => $request->amount_bdt,
                's_charge' => $request->s_charge,
                't_amount' => $request->t_amount,
                'urn' => $request->urn,
                'digit' => $request->digit,
                'a_name' => $request->a_name,
                'current_address' => $request->current_address,
                'a_phone' => (int)$request->a_phone,
                'a_mobile' => (int)$request->a_mobile,
                'a_email' => $request->a_email,
                'gender' => $gender,
                'a_maiden_name' => $request->a_maiden_name,
                'a_birth' => $birth,
                'passport_no' => $pass,
                'place_of_issue' => $request->place_of_issue,
                'date_of_issue' => $date_of_issue,
                'expire_date' => $expire_date,
                'a_nid' => $request->a_nid,
                'e_name' => $request->e_name,
                'e_relation' => $request->e_relation,
                'e_phone' => (int)$request->e_phone,
                'e_address' => $request->e_address,
                'e_permanent_address' => $request->e_permanent_address,
                'e_city' => $request->e_city,
                'e_pin' => $request->e_pin,
                'e_phone1' => (int)$request->e_phone1,
                'e_phone2' => (int)$request->e_phone2,
                'e_address_2' => $request->e_address_2,
                'e_city_2' => $request->e_city_2,
                'e_pin_2' => $request->e_pin_2,
                'e_phone_3' => (int)$request->e_phone_3,
                'e_phone_extn' => (int)$request->e_phone_extn,
                'cash_amount' => $request->cash_amount,
                'cheque_amount' => $request->cheque_amount,
                'sbl_ca_account_no' => $request->sbl_ca_account_no,
                'sbl_ca_amount' => $request->sbl_ca_amount,
                'employment_type' => $employment_type,
                'p_name' => $p_name,
                's_name' => $s_name,
                's_company' => $request->s_company,
                's_designation' => $request->s_designation,
                's_years' => $request->s_years,
                's_e_name' => $s_e_name,
                's_e_designation' => $request->s_e_designation,
                's_e_years' => $request->s_e_years,
                's_e_invest' => $request->s_e_invest,
                's_e_previous_business' => $request->s_e_previous_business,
                's_e_annual_turnover' => $request->s_e_annual_turnover,
                's_e_income' => $request->s_e_income,
                'sbl_status' => $request->sbl_status,
                'sbl_years' => $request->sbl_years,
                'sbl_customer_no' => $request->sbl_customer_no,
                'sbl_branch' => $request->sbl_branch,
                'sbl_nature_account' => $request->sbl_nature_account,
                'sbl_account_type' => $sbl_account_type,
                'sbl_banker_name' => $request->sbl_banker_name,
                'sbl_banker_branch' => $request->sbl_banker_branch,
                'sbl_banker_city' => $request->sbl_banker_city,
                'sbl_banker_pin' => $request->sbl_banker_pin,
                'sbl_banker_account_no' => $request->sbl_banker_account_no,
                'sbl_banker_account_nature' => $sbl_banker_account_nature,
                'travel_country' => $request->travel_country,
                'travel_date' => $travel_date,
                'travel_type' => $travel_type,
                'travel_total_days' => $request->travel_total_days,
                'status' => 1,
                'center' => Auth::user()->center_name,
                'created_date' => date('Y-m-d H:i:s'),
                'created_by' => Auth::user()->user_id,
                'refer_id' => $request->refer_id
            );
            DB::table('tbl_dollar_endorsement')->insert($arrData);
            $id = DB::getPdo()->lastInsertId();

            return redirect("/dollar_endorsement/$id");
        }

        //var_dump($id); exit();
    }

    public function printData($id)
    {
        $data = array();
        $data['id'] = $id;
        $data['serviceFee'] = DB::table('tbl_ivac_services')
            ->where('Service', 'Dollar Endorsement')
            ->First();
        $data['print_data'] =$imgData= DB::table('tbl_dollar_endorsement')
            ->where('id', $id)
            ->First();
        $data['currencyName'] = DB::table('tbl_currency_rate')
            ->get();
        $data['image'] = DB::table('tbl_sbi_branch')
            ->where('branch_name', $imgData->branch_name)
            ->orderBy('id', 'desc')
            ->first();

        return view('dollar.dollarEndorsement_print', $data);
    }


    public function reprint(Request $request)
    {
        $data = array();
        $search_input = $request->input('q');
        if (isset($search_input) && !empty($search_input)) {
            $passport = strtoupper(str_replace(' ', '', $search_input));
            $data['print_data'] =$imgData= $single_row = DB::table('tbl_dollar_endorsement')
                ->where('passport_no', $passport)
                ->orderBy('id', 'DESC')
                ->First();
            $data['image'] = DB::table('tbl_sbi_branch')
                ->where('branch_name', $imgData->branch_name)
                ->orderBy('id', 'desc')
                ->first();
            if (isset($single_row->branch_name) && !empty($single_row->branch_name)){
                $data['branch_address'] = DB::table('tbl_sbi_branch')
                    ->where('branch_name', '=', $single_row->branch_name)
                    ->orderBy('id', 'DESC')
                    ->First();
                $data['account_inter'] = DB::table('tbl_account_type')
                    ->where('sbi_branch', '=', $single_row->branch_name)
                    ->where('account_name', '=', 'INTER BRANCH USD A/C')
                    ->orderBy('id', 'DESC')
                    ->First();
                $data['account_pooling'] = DB::table('tbl_account_type')
                    ->where('sbi_branch', '=', $single_row->branch_name)
                    ->where('account_name', '=', 'POOLING A/C')
                    ->orderBy('id', 'DESC')
                    ->First();
                $data['account_expense'] = DB::table('tbl_account_type')
                    ->where('sbi_branch', '=', $single_row->branch_name)
                    ->where('account_name', '=', 'EXPENSES & CHARGES ON PREPAID CARD')
                    ->orderBy('id', 'DESC')
                    ->First();
            }else{
                $data['account_expense'] = "";
                $data['account_pooling'] = "";
                $data['account_inter'] ="";
            }



            if (isset($single_row) && !empty($single_row)) {
                $data['amount'] = $this->convert_number_to_words($single_row->f_currency);
            } else {
                $data['amount'] = '';
            }
            if (isset($single_row->branch_name) && !empty($single_row->branch_name)) {
                $data['address'] = DB::table('tbl_sbi_branch')
                    ->where('branch_name', 'like', '%' . $single_row->branch_name . '%')
                    ->First();
                if (empty($data['address'])) {
                    $data['address'] = "";
                }
            }
        } else {
            $data['print_data'] = '';
        }


        return view('dollar.reprint', $data);
    }

    public function reprintData($id)
    {
        $data = array();
        $data['id'] = $id;
        $data['serviceFee'] = DB::table('tbl_ivac_services')
            ->where('Service', 'Dollar Endorsement')
            ->First();
        $data['print_data'] =$imgData= $single_row = DB::table('tbl_dollar_endorsement')
            ->where('id', $id)
            ->orderBy('id', 'desc')
            ->First();
        $data['image'] = DB::table('tbl_sbi_branch')
            ->where('branch_name', $imgData->branch_name)
            ->orderBy('id', 'desc')
            ->first();

        if (isset($single_row->branch_name) && !empty($single_row->branch_name)){
            $data['account_inter'] = DB::table('tbl_account_type')
                ->where('sbi_branch', '=', $single_row->branch_name)
                ->where('account_name', '=', 'INTER BRANCH USD A/C')
                ->orderBy('id', 'DESC')
                ->First();
            $data['account_pooling'] = DB::table('tbl_account_type')
                ->where('sbi_branch', '=', $single_row->branch_name)
                ->where('account_name', '=', 'POOLING A/C')
                ->orderBy('id', 'DESC')
                ->First();
            $data['account_expense'] = DB::table('tbl_account_type')
                ->where('sbi_branch', '=', $single_row->branch_name)
                ->where('account_name', '=', 'EXPENSES & CHARGES ON PREPAID CARD')
                ->orderBy('id', 'DESC')
                ->First();
        }else{
            $data['account_inter'] = "";
            $data['account_pooling'] = "";
            $data['account_expense'] = "";
        }


        $data['currencyName'] = DB::table('tbl_currency_rate')
            ->get();

        return view('dollar.reprint_dollarEndorsement_print', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $data = array();
        if (isset($_POST['submit'])) {

            $passport = strtoupper(str_replace(' ', '', $_POST['passport']));
            $data['editData'] = DB::table('tbl_dollar_endorsement')
                ->where('passport_no', $passport)
                ->orderBy('id', 'DESC')
                ->First();

            $data['refers'] = DB::table('tbl_dollarendorsement_reference')
                ->where('center', Auth::user()->center_name)
                ->orderBy('id', 'ASC')
                ->get();
            $data['commission_per_passport'] = DB::table('tbl_commission')
                ->where('ivac_service', '=','Dollar Endorsement')
                ->orderBy('id', 'desc')
                ->first();
        }

        return view('dollar.dollar_endorsement_edit', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $c_rate = DB::table('tbl_dollar_endorsement')
            ->where('id', $id)
            ->First();
        if ($c_rate->c_rate != $request->c_rate) {
            $arrEdit = array(
                'dollar_id' => $id,
                'previous_dollar_rate' => $c_rate->c_rate,
                'previous_total_amount' => $c_rate->t_amount,
                'new_dollar_rate' => $request->c_rate,
                'new_total_amount' => $request->t_amount,
                'edit_by' => Auth::user()->user_id,
                'edit_date' => date('Y-m-d H:i:s')
            );
            DB::table('tbl_dollar_endorsement_edit_log')->insert($arrEdit);

        }

        if (isset($request->employment_type) && !empty($request->employment_type)) {
            $employment_type = implode(",", $request->employment_type);
        } else {
            $employment_type = '';
        }
        if (isset($request->p_name) && !empty($request->p_name)) {
            $p_name = implode(",", $request->p_name);
        } else {
            $p_name = '';
        }
        if (isset($request->s_name) && !empty($request->s_name)) {
            $s_name = implode(",", $request->s_name);
        } else {
            $s_name = '';
        }
        if (isset($request->s_e_name) && !empty($request->s_e_name)) {
            $s_e_name = implode(",", $request->s_e_name);
        } else {
            $s_e_name = '';
        }
        if (isset($request->travel_type) && !empty($request->travel_type)) {
            $travel_type = implode(",", $request->travel_type);
        } else {
            $travel_type = '';
        }
        if (isset($request->sbl_banker_account_nature) && !empty($request->sbl_banker_account_nature)) {
            $sbl_banker_account_nature = implode(",", $request->sbl_banker_account_nature);
        } else {
            $sbl_banker_account_nature = '';
        }

        if (isset($request->created_date) && !empty($request->created_date)) {
            $create_at = date('Y-m-d', strtotime($request->created_date));
        } else {
            $create_at = $request->created_date;
        }
        if (isset($request->a_birth) && !empty($request->a_birth)) {
            $birth = date('Y-m-d', strtotime($request->a_birth));
        } else {
            $birth = '';
        }
        if (isset($request->date_of_issue) && !empty($request->date_of_issue)) {
            $date_of_issue = date('Y-m-d', strtotime($request->date_of_issue));
        } else {
            $date_of_issue = '';
        }
        if (isset($request->expire_date) && !empty($request->expire_date)) {
            $expire_date = date('Y-m-d', strtotime($request->expire_date));
        } else {
            $expire_date = '';
        }
        if (isset($request->travel_date) && !empty($request->travel_date)) {
            $travel_date = date('Y-m-d', strtotime($request->travel_date));
        } else {
            $travel_date = '';
        }
        if (isset($request->sbl_account_type) && !empty($request->sbl_account_type)) {
            $sbl_account_type = implode(",", $request->sbl_account_type);
        } else {
            $sbl_account_type = '';
        }
        if (isset($request->gender) && !empty($request->gender)) {
            $gender = $request->gender;
        } else {
            $gender = '';
        }
        $center = DB::table('tbl_center_info')
            ->orderBy('centerinfo_id', 'DESC')
            ->first();
        $arrData = array(
            'serial_number' => $request->serial_number,
            'c_rate' => $request->c_rate,
            'branch_name' => $request->branch_name,
            'branch_code' => $request->branch_code,
            'c_type' => $request->c_type,
            'f_currency' => $request->f_currency,
            'commission' => $request->commission,
            'amount_bdt' => $request->amount_bdt,
            's_charge' => $request->s_charge,
            't_amount' => $request->t_amount,
            'urn' => $request->urn,
            'digit' => $request->digit,
            'a_name' => $request->a_name,
            'current_address' => $request->current_address,
            'a_phone' => (int)$request->a_phone,
            'a_mobile' => (int)$request->a_mobile,
            'a_email' => $request->a_email,
            'gender' => $gender,
            'a_maiden_name' => $request->a_maiden_name,
            'a_birth' => $birth,
            'passport_no' => strtoupper(str_replace(' ', '', $request->passport_no)),
            'place_of_issue' => $request->place_of_issue,
            'date_of_issue' => $date_of_issue,
            'expire_date' => $expire_date,
            'a_nid' => $request->a_nid,
            'e_name' => $request->e_name,
            'e_relation' => $request->e_relation,
            'e_phone' => (int)$request->e_phone,
            'e_address' => $request->e_address,
            'e_permanent_address' => $request->e_permanent_address,
            'e_city' => $request->e_city,
            'e_pin' => $request->e_pin,
            'e_phone1' => (int)$request->e_phone1,
            'e_phone2' => (int)$request->e_phone2,
            'e_address_2' => $request->e_address_2,
            'e_city_2' => $request->e_city_2,
            'e_pin_2' => $request->e_pin_2,
            'e_phone_3' => (int)$request->e_phone_3,
            'e_phone_extn' => (int)$request->e_phone_extn,
            'cash_amount' => $request->cash_amount,
            'cheque_amount' => $request->cheque_amount,
            'sbl_ca_account_no' => $request->sbl_ca_account_no,
            'sbl_ca_amount' => $request->sbl_ca_amount,
            'employment_type' => $employment_type,
            'p_name' => $p_name,
            's_name' => $s_name,
            's_company' => $request->s_company,
            's_designation' => $request->s_designation,
            's_years' => $request->s_years,
            's_e_name' => $s_e_name,
            's_e_designation' => $request->s_e_designation,
            's_e_years' => $request->s_e_years,
            's_e_invest' => $request->s_e_invest,
            's_e_previous_business' => $request->s_e_previous_business,
            's_e_annual_turnover' => $request->s_e_annual_turnover,
            's_e_income' => $request->s_e_income,
            'sbl_status' => $request->sbl_status,
            'sbl_years' => $request->sbl_years,
            'sbl_customer_no' => $request->sbl_customer_no,
            'sbl_branch' => $request->sbl_branch,
            'sbl_nature_account' => $request->sbl_nature_account,
            'sbl_account_type' => $sbl_account_type,
            'sbl_banker_name' => $request->sbl_banker_name,
            'sbl_banker_branch' => $request->sbl_banker_branch,
            'sbl_banker_city' => $request->sbl_banker_city,
            'sbl_banker_pin' => $request->sbl_banker_pin,
            'sbl_banker_account_no' => $request->sbl_banker_account_no,
            'sbl_banker_account_nature' => $sbl_banker_account_nature,
            'travel_country' => $request->travel_country,
            'travel_date' => $travel_date,
            'travel_type' => $travel_type,
            'travel_total_days' => $request->travel_total_days,
            'status' => 1,
            'center' => Auth::user()->center_name,
            'updated_date' => date('Y-m-d'),
            'updated_by' => Auth::user()->user_id,
            'refer_id' => $request->refer_id
        );
        DB::table('tbl_dollar_endorsement')
            ->where('id', $id)
            ->update($arrData);
        //$id = DB::getPdo()->lastInsertId();

        return redirect("/dollar_endorsement_edit/$id");
    }

    public function edit_printData($id)
    {
        $data = array();
        $data['id'] = $id;
        $data['serviceFee'] = DB::table('tbl_ivac_services')
            ->where('Service', 'Dollar Endorsement')
            ->First();
        $data['print_data'] =$imgData= DB::table('tbl_dollar_endorsement')
            ->where('id', $id)
            ->First();
        $data['image'] = DB::table('tbl_sbi_branch')
            ->where('branch_name', $imgData->branch_name)
            ->orderBy('id', 'desc')
            ->first();
        $data['currencyName'] = DB::table('tbl_currency_rate')
            ->get();

        return view('dollar.dollarEndorsement_edit_print', $data);
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
            $data['deleteDatas'] = DB::table('tbl_dollar_endorsement')
                ->where('passport_no', $passport)
                ->orderBy('id', 'DESC')
                ->get();
        }
        return view('dollar.delete', $data);
    }

    public function destroy($id)
    {
        $get_data = DB::table('tbl_dollar_endorsement')->where('id', $id)->first();
        $data = $get_data->serial_number.';'.$get_data->c_rate.';'.$get_data->f_currency.';'.$get_data->amount_bdt.';'.$get_data->s_charge.';'.$get_data->t_amount.';'.$get_data->a_name.';'.$get_data->current_address.';'.$get_data->a_mobile.';'.$get_data->gender.';'.$get_data->digit.';'.$get_data->passport_no;

        $delete = DB::table('tbl_dollar_endorsement')->where('id', $id)->delete();
        if ($delete) {
            DB::table('tbl_delete_log')->insert(
                ['delete_id' => $id,
                    'type' => 3,
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
        return redirect('/delete-dollar');
    }

    public function search_passport_appointment()
    {
        $keyword = strtoupper(str_replace(' ', '', $_GET['keyword']));

        $data = DB::table('tbl_appointmentserved')
            ->where('Passport', $keyword)
            ->orderBy('app_sl', 'DESC')
            ->first();
        return response()->json($data);
    }


    public function details_report()
    {
        $data = array();
        $data['details'] = DB::select('select created_by from `tbl_dollar_endorsement` group by `created_by`');

        return view('dollar.details_report', $data);
    }

    public function summary_report()
    {
        $data = array();
        $data['details'] = DB::select('select created_by from `tbl_dollar_endorsement` group by `created_by`');

        return view('dollar.summary_report', $data);
    }

    public function search_details_report(Request $request)
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
        $d = date('Y-m', strtotime($to));
        $dd = date('d', strtotime($to));
        $t = $dd + 1;
        $ddd = $d . '-' . $t;
        if ($user_id == 'all') {
            $data['print_data'] = DB::select("SELECT * FROM `tbl_dollar_endorsement` WHERE date(created_date) >= '$from' AND date(created_date) <= '$to'");
        } else {
            $data['print_data'] = DB::select("SELECT * FROM `tbl_dollar_endorsement` WHERE `created_by` = '$user_id' AND date(created_date) >= '$from' AND date(created_date) <= '$to'");
        }
        return view('dollar.dollar_details_reports_print', $data);

    }

    public function search_summary_report(Request $request)
    {
        $data = array();
        $user_id = $request->input('user_id');
        $from_date = $request->input('from_date');
        $from_date = date('Y-m-d', strtotime($from_date));
        $to_date = $request->input('to_date');
        $to_date = date('Y-m-d', strtotime($to_date));
        $data['formDate'] = $from_date;
        $data['toDate'] = $to_date;
        $data['user_id'] = Auth::user()->user_id;

        if ($user_id == 'all') {
            //$data['print_data'] = DB::select("SELECT * FROM `tbl_dollar_endorsement` WHERE `created_date` >= date('$from_date') AND `created_date` <= date('$to_date')");
            $data['print_data'] = DB::select("SELECT SUM(`f_currency`) as dollar,SUM(`amount_bdt`) as bdt,SUM(`s_charge`) as charge,SUM(`t_amount`) as total,SUM(`commission`) as comm, count(*) as count_row, `created_date`,`created_by` FROM tbl_dollar_endorsement WHERE date(created_date) >='$from_date' AND date(created_date) <= '$to_date' GROUP BY date(created_date)");
        } else {
            $data['print_data'] = DB::select("SELECT SUM(`f_currency`) as dollar,SUM(`amount_bdt`) as bdt,SUM(`s_charge`) as charge,SUM(`t_amount`) as total,SUM(`commission`) as comm, count(*) as count_row, `created_date`,`created_by` FROM tbl_dollar_endorsement WHERE created_by='$user_id' AND date(created_date) >= '$from_date' AND date(created_date) <= '$to_date' GROUP BY date(created_date)");
        }
        return view('dollar.dollar_summary_reports_print', $data);
    }


    public function excel_page()
    {

        return view('dollar.dollar_summary_export');
    }

    public function excel(Request $request)
    {
        $date = date('Y-m-d', strtotime($request->dateinput));

        $port_update_data = DB::table('tbl_dollar_endorsement')->whereDate('created_date', $date)->get()->toArray();

        $port_array[] = array('SL No', 'Product Name', 'URN', 'Last 4 digits of Card Number', 'Amount', 'Fees', 'Login Id', 'Customer Name', 'DOB',
            'Address', 'Customer Mobile', 'Customer Email', 'City', 'Journal Number', 'Passport', 'Visiting Country',
            'Passport Expiry', 'Passport Issued date', 'Passport Issued Place', 'Passport Renewal date', 'Passport Previous Number');

        $i = 0;
        foreach ($port_update_data as $val) {
            $i++;
            if ($val->a_birth != 0000 - 00 - 00) {
                $dob = date('d-m-Y', strtotime($val->a_birth));
            } else {
                $dob = '';
            }
            if ($val->expire_date != 0000 - 00 - 00) {
                $expiry = date('d-m-Y', strtotime($val->expire_date));
            } else {
                $expiry = '';
            }
            if ($val->date_of_issue != 0000 - 00 - 00) {
                $issue = date('d-m-Y', strtotime($val->date_of_issue));
            } else {
                $issue = '';
            }

            $port_array[] = array(
                'SL No' => $i,
                'Product Name' => 'SBI EMV TRAVEL CARD',
                'URN' => $val->urn,
                'Last 4 digits of Card Number' => $val->digit,
                'Amount' => $val->f_currency,
                'Fees' => '0',
                'Login Id' => $val->created_by,
                'Customer Name' => $val->a_name,
                'DOB' => $dob,
                'Address' => $val->current_address,
                'Customer Mobile' => $val->a_mobile,
                'Customer Email' => $val->a_email,
                'City' => $val->e_city,
                'Journal Number' => '0',
                'Passport' => $val->passport_no,
                'Visiting Country' => $val->travel_country,
                'Passport Expiry' => $expiry,
                'Passport Issued date' => $issue,
                'Passport Issued Place' => $val->place_of_issue,
                'Passport Renewal date' => '',
                'Passport Previous Number' => ''
            );
        }

        Excel::create($date . '_dollarEndorsement', function ($excel) use ($port_array) {

            $excel->setTitle('Dollar Endorsement Data');
            $excel->sheet('Table Data', function ($sheet) use ($port_array) {
                $sheet->fromArray($port_array, null, 'A1', false, false);

            });

        })->download('csv');

    }

    public function transaction_voucher(Request $request)
    {
        $data = array();
        $search_input = $request->input('q');
        if (isset($search_input) && !empty($search_input)) {
            $passport = strtoupper(str_replace(' ', '', $search_input));
            $data['print_data'] = $single_row = DB::table('tbl_dollar_endorsement')
                ->where('passport_no', $passport)
                ->orderBy('id', 'DESC')
                ->First();
            //$data['amount'] = $this->convert_number_to_words($single_row->t_amount);

        } else {
            $data['print_data'] = '';
        }
        return view('dollar.transaction_voucher', $data);

    }

    public function transaction_voucher_print($id)
    {
        $data['print_data'] = $single_row = DB::table('tbl_dollar_endorsement')
            ->where('id', $id)
            ->First();
        if(isset($single_row->branch_name) && !empty($single_row->branch_name)){
            $data['account_inter'] = DB::table('tbl_account_type')
                ->where('sbi_branch', '=', "$single_row->branch_name")
                ->where('account_name', '=', 'INTER BRANCH USD A/C')
                ->orderBy('id', 'DESC')
                ->First();
            $data['account_pooling'] = DB::table('tbl_account_type')
                ->where('sbi_branch', '=', "$single_row->branch_name")
                ->where('account_name', '=', 'POOLING A/C')
                ->orderBy('id', 'DESC')
                ->First();
            $data['account_expense'] = DB::table('tbl_account_type')
                ->where('sbi_branch', '=', "$single_row->branch_name")
                ->where('account_name', '=', 'EXPENSES & CHARGES ON PREPAID CARD')
                ->orderBy('id', 'DESC')
                ->First();
            $data['image'] = DB::table('tbl_sbi_branch')
                ->where('branch_name', $single_row->branch_name)
                ->orderBy('id', 'desc')
                ->first();
        }else{
            $data['account_inter'] = '';
            $data['account_pooling'] = '';
            $data['account_expense'] = '';
        }


        //var_dump($data['account_expense']);
        return view('dollar.transaction_voucher_print', $data);
    }

    public function transaction_voucher_edit_print($id)
    {
        $data['print_data'] = $single_row = DB::table('tbl_dollar_endorsement')
            ->where('id', $id)
            ->orderBy('id', 'DESC')
            ->First();
        if (isset( $single_row->branch_name) && !empty($single_row->branch_name)){
            $data['image'] = DB::table('tbl_sbi_branch')
                ->where('branch_name', $single_row->branch_name)
                ->orderBy('id', 'desc')
                ->first();
            $data['account_inter'] = DB::table('tbl_account_type')
                ->where('sbi_branch', '=', "$single_row->branch_name")
                ->where('account_name', '=', 'INTER BRANCH USD A/C')
                ->orderBy('id', 'DESC')
                ->First();
            $data['account_pooling'] = DB::table('tbl_account_type')
                ->where('sbi_branch', '=', "$single_row->branch_name")
                ->where('account_name', '=', 'POOLING A/C')
                ->orderBy('id', 'DESC')
                ->First();
            $data['account_expense'] = DB::table('tbl_account_type')
                ->where('sbi_branch', '=', "$single_row->branch_name")
                ->where('account_name', '=', 'EXPENSES & CHARGES ON PREPAID CARD')
                ->orderBy('id', 'DESC')
                ->First();
        }else{
            $data['account_inter'] = '';
            $data['account_pooling'] = '';
            $data['account_expense'] = '';
        }

        return view('dollar.transaction_voucher_edit_print', $data);
    }


    public function tm_form(Request $request)
    {
        $data = array();
        $search_input = $request->input('q');
        if (isset($search_input) && !empty($search_input)) {
            $passport = strtoupper(str_replace(' ', '', $search_input));
            $data['print_data'] = $single_row = DB::table('tbl_dollar_endorsement')
                ->where('passport_no', $passport)
                ->orderBy('id', 'DESC')
                ->First();
            if (isset($single_row) && !empty($single_row)) {
                $data['amount'] = $this->convert_number_to_words($single_row->f_currency);
            } else {
                $data['amount'] = '';
            }


        } else {
            $data['print_data'] = '';
        }
        return view('dollar.tm_form', $data);
    }

    public function tm_form_print($id)
    {
        $data['print_data'] = $single_row = DB::table('tbl_dollar_endorsement')
            ->where('id', $id)
            ->orderBy('id', 'DESC')
            ->First();
        $data['amount'] = $this->convert_number_to_words($single_row->f_currency);
        return view('dollar.tm_form_print', $data);
    }

    public function enquiry(Request $request)
    {
        $data = array();
        $search_input = $request->input('q');
        $entity = $request->input('entity');
        if (isset($search_input) && !empty($search_input)) {
            if ($entity == 'passport') {
                $passport = strtoupper(str_replace(' ', '', $search_input));
                $data['print_data'] = $single_row = DB::table('tbl_dollar_endorsement')
                    ->where('passport_no', $passport)
                    ->orderBy('id', 'DESC')
                    ->get();
                $data['first_entity'] = $entity;

            } elseif ($entity == 'name') {
                $data['print_data'] = $single_row = DB::table('tbl_dollar_endorsement')
                    ->where('a_name', 'like', '%' . $search_input . '%')
                    ->orderBy('id', 'DESC')
                    ->get();
                $data['first_entity'] = $entity;
            } elseif ($entity == 'travel_card') {
                $data['print_data'] = $single_row = DB::table('tbl_dollar_endorsement')
                    ->where('digit', $search_input)
                    ->orderBy('id', 'DESC')
                    ->get();
                $data['first_entity'] = $entity;
            }
        } else {
            $data['print_data'] = '';
        }
        return view('dollar.enquiry_dollar', $data);
    }

    public function receive_voucher($id)
    {
        $data['print_data'] = $single_row = DB::table('tbl_dollar_endorsement')
            ->where('id', $id)
            ->orderBy('id', 'DESC')
            ->First();
        if (isset($single_row->branch_name) && !empty($single_row->branch_name)) {
            $data['address'] = DB::table('tbl_sbi_branch')
                ->where('branch_name', 'like', '%' . $single_row->branch_name . '%')
                ->First();
            if (empty($data['address'])) {
                $data['address'] = "";
            }
        }

        //$data['amount'] = $this->convert_number_to_words($single_row->f_currency);

        return view('dollar.receive_voucher', $data);
    }

    public function edit_receive_voucher($id)
    {
        $data['print_data'] = $single_row = DB::table('tbl_dollar_endorsement')
            ->where('id', $id)
            ->orderBy('id', 'DESC')
            ->First();
        if (isset($single_row->branch_name) && !empty($single_row->branch_name)) {
            $data['address'] = DB::table('tbl_sbi_branch')
                ->where('branch_name', 'like', '%' . $single_row->branch_name . '%')
                ->First();
            if (empty($data['address'])) {
                $data['address'] = "";
            }
        }

        //$data['amount'] = $this->convert_number_to_words($single_row->f_currency);

        return view('dollar.edit_receive_voucher', $data);
    }

    public function reprint_receive_voucher()
    {
        $data = array();
        if (isset($_POST['q']) && !empty($_POST['q'])) {
            $search_input = $_POST['q'];
            if (isset($search_input) && !empty($search_input)) {
                $passport = strtoupper(str_replace(' ', '', $search_input));
                $data['print_data'] = $single_row = DB::table('tbl_dollar_endorsement')
                    ->where('passport_no', $passport)
                    ->orderBy('id', 'DESC')
                    ->First();
            } else {
                $data['print_data'] = '';
            }
            if (isset($single_row->branch_name) && !empty($single_row->branch_name)) {
                $data['address'] = DB::table('tbl_sbi_branch')
                    ->where('branch_name', 'like', '%' . $single_row->branch_name . '%')
                    ->First();
                if (empty($data['address'])) {
                    $data['address'] = "";
                }
            }
        }


        return view('dollar.reprint_receive_voucher', $data);
    }

    public function reference_by()
    {
        $data = array();
        $data['center'] = Auth::user()->center_name;
        $data['refers'] = DB::table('tbl_dollarEndorsement_reference')
            ->where('center', Auth::user()->center_name)
            ->get();

        return view('dollar.dollar_reference_by', $data);
    }

    public function reference_by_store(Request $request)
    {
        $center = DB::table('tbl_center_info')
            ->first();
        $check = DB::select("SELECT * FROM `tbl_dollarendorsement_reference` WHERE `refer_id` = '$request->refer_id' AND `center` = '$center->center_name'");

        if (isset($check) && !empty($check)) {
            Session::flash('message', 'Refer ID can not be duplicated !');
            Session::flash('alert-class', 'btn-danger');
        } else {
            $data = array(
                'name' => $request->name,
                'refer_id' => $request->refer_id,
                'designation' => $request->designation,
                'ivac_id' => $request->ivac_id,
                'center' => $request->center,
                'created_at' => date('Y-m-d H:i:s'),
            );
            $inserted = DB::table('tbl_dollarEndorsement_reference')->insert($data);
            if ($inserted) {
                Session::flash('message', 'Successfully Stored Data !');
                Session::flash('alert-class', 'btn-info');
            } else {
                Session::flash('message', 'Fail to Stored Data !');
                Session::flash('alert-class', 'btn-danger');
            }
        }

        return redirect('/dollarendorsement-reference-by');
    }

    public function edit_referrer_page($id){
        $data = array();
        $data['center'] = DB::table('tbl_center_info')
            ->first();
        $data['refer'] = DB::table('tbl_dollarendorsement_reference')
            ->where('id', $id)
            ->first();
        return view('dollar.dollar_reference_edit', $data);
    }

    public function reference_update(Request $request){
        $data = array(
            'name' => $request->name,
            'refer_id' => $request->refer_id,
            'ivac_id' => $request->ivac_id,
            'designation' => $request->designation,
            'updated_at' => date('Y-m-d H:i:s')
        );
        $updated = DB::table('tbl_dollarendorsement_reference')
            ->where('id', $request->id)
            ->update($data);
        if ($updated) {
            Session::flash('message', 'Successfully Updated Data !');
            Session::flash('alert-class', 'btn-info');
        } else {
            Session::flash('message', 'Fail to Updated Data !');
            Session::flash('alert-class', 'btn-danger');
        }
        return redirect('/dollarendorsement-reference-by');
    }

    public function reference_delete($id)
    {
        $deleted = DB::table('tbl_dollarEndorsement_reference')
            ->where('id', $id)
            ->Delete();
        if ($deleted) {
            Session::flash('message', 'Successfully Deleted Data !');
            Session::flash('alert-class', 'btn-info');
        } else {
            Session::flash('message', 'Fail to Deleted Data !');
            Session::flash('alert-class', 'btn-danger');
        }
        return redirect('/dollarendorsement-reference-by');
    }

    public function referred_details()
    {
        $data = array();
        $center = DB::table('tbl_center_info')
            ->first();
        $data['refers'] = DB::table('tbl_dollarEndorsement_reference')
            //->where('center', $center->center_name)
            ->where('center','=', Auth::user()->center_name)
            ->get();

        return view('dollar.referred_details', $data);
    }

    public function referred_details_report(Request $request)
    {
        $data = array();
        $refer_id = $request->input('refer_id');
        $from_date = $request->input('from_date');
        $from = date('Y-m-d', strtotime($from_date));
        $to_date = $request->input('to_date');
        $to = date('Y-m-d', strtotime($to_date));
        $data['formDate'] = $from;
        $data['toDate'] = $to;
        $data['refer_id'] = $refer_id;

        if ($refer_id == 'all') {
            $data['print_data'] = DB::select("SELECT * FROM `tbl_dollar_endorsement` WHERE date(created_date) >= '$from' AND date(created_date) <= '$to'");
        } else {
            $data['print_data'] = DB::select("SELECT * FROM `tbl_dollar_endorsement` WHERE `refer_id` = '$refer_id' AND date(created_date) >= '$from' AND date(created_date) <= '$to'");
        }
        return view('dollar.dollar_referred_reports_print', $data);
    }

    public function referred_summary()
    {
        $data = array();
        $center = DB::table('tbl_center_info')
            ->first();
        $data['refers'] = DB::table('tbl_dollarEndorsement_reference')
            ->where('center','=', Auth::user()->center_name)
            ->get();

        return view('dollar.referred_summary', $data);
    }

    public function referred_summary_report(Request $request)
    {


        $data = array();
        $refer_id = $request->input('refer_id');
        $from_date = $request->input('from_date');
        $from = date('Y-m-d', strtotime($from_date));
        $to_date = $request->input('to_date');
        $to = date('Y-m-d', strtotime($to_date));
        $data['formDate'] = $from;
        $data['toDate'] = $to;
        $data['refer_id'] = $refer_id;



        return view('dollar.dollar_referred_summary_reports_print', $data);

    }

    public function search_referred_id(){
        $keyword = $_GET['keyword'];
        $data = DB::table('tbl_dollarendorsement_reference')->where('name', 'like', $keyword.'%')->get();
        return response()->json($data);
    }




//    converter

    public static function convert_number_to_words($number)
    {

        $hyphen = ' ';
        $conjunction = ' and ';
        $separator = ' ';
        $negative = 'negative ';
        $decimal = ' point ';
        $dictionary = array(
            0 => 'Zero',
            1 => 'One',
            2 => 'Two',
            3 => 'Three',
            4 => 'Four',
            5 => 'Five',
            6 => 'Six',
            7 => 'Seven',
            8 => 'Eight',
            9 => 'Nine',
            10 => 'Ten',
            11 => 'Eleven',
            12 => 'Twelve',
            13 => 'Thirteen',
            14 => 'Fourteen',
            15 => 'Fifteen',
            16 => 'Sixteen',
            17 => 'Seventeen',
            18 => 'Eighteen',
            19 => 'Nineteen',
            20 => 'Twenty',
            30 => 'Thirty',
            40 => 'Fourty',
            50 => 'Fifty',
            60 => 'Sixty',
            70 => 'Seventy',
            80 => 'Eighty',
            90 => 'Ninety',
            100 => 'Hundred',
            1000 => 'Thousand',
            1000000 => 'Million',
            1000000000 => 'Billion',
            1000000000000 => 'Trillion',
            1000000000000000 => 'Quadrillion',
            1000000000000000000 => 'Quintillion'
        );

        if (!is_numeric($number)) {
            return false;
        }

        if (($number >= 0 && (int)$number < 0) || (int)$number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
                'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
                E_USER_WARNING
            );
            return false;
        }

        if ($number < 0) {
            return $negative . Self::convert_number_to_words(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens = ((int)($number / 10)) * 10;
                $units = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . Self::convert_number_to_words($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int)($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = Self::convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= Self::convert_number_to_words($remainder);
                }
                break;
        }

        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string)$fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }

        return $string;
    }

}
