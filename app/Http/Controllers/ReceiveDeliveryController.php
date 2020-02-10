<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Auth;

class ReceiveDeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $d = date('Y-m-d');
        $user_id =auth()->user()->user_id;
        $count = DB::select("SELECT COUNT(del2app_by) AS t_count FROM `tbl_port_update` WHERE date(`del2app_time`) = '$d' AND `del2app_by` = '$user_id' AND `ServiceType`='R.A.P./P.A.P.'");
        return view('del2app.del_to_app_search', ['count'=>$count]);
    }

    public function rappap_ready_center(){
        $d = date('Y-m-d');
        $user_id =auth()->user()->user_id;
        $count = DB::select("SELECT COUNT(ready_cen_by) AS t_count FROM `tbl_port_update` WHERE date(`ready_cen_time`) = '$d' AND `ready_cen_by` = '$user_id' AND `ServiceType`='R.A.P./P.A.P.'");
        return view('ready_center.ready_center_search', ['count'=>$count]);
    }

    public function port_del_to_app(){
        $d = date('Y-m-d');
        $user_id =auth()->user()->user_id;
        $count = DB::select("SELECT COUNT(del2app_by) AS t_count FROM `tbl_port_update` WHERE date(`del2app_time`) = '$d' AND `del2app_by` = '$user_id' AND `ServiceType`='Port Endorsement'");
        return view('del2app.del_to_app_search_port', ['count'=>$count]);
    }

    public function port_ready_center(){
        $d = date('Y-m-d');
        $user_id =auth()->user()->user_id;
        $count = DB::select("SELECT COUNT(ready_cen_by) AS t_count FROM `tbl_port_update` WHERE date(`ready_cen_time`) = '$d' AND `ready_cen_by` = '$user_id' AND `ServiceType`='Port Endorsement'");
        return view('ready_center.ready_center_search_port', ['count'=>$count]);
    }

    public function foreign_del_to_app(){
        $d = date('Y-m-d');
        $user_id =auth()->user()->user_id;
        $count = DB::select("SELECT COUNT(del2appby) AS t_count FROM `tbl_fp_served` WHERE date(`del2apptime`) = '$d' AND `del2appby` = '$user_id'");
        return view('del2app.del_to_app_search_foreign', ['count'=>$count]);
    }

    public function foreign_ready_center(){
        $d = date('Y-m-d');
        $user_id =auth()->user()->user_id;
        $count = DB::select("SELECT COUNT(readycenterby) AS t_count FROM `tbl_fp_served` WHERE date(`readycentertime`) = '$d' AND `readycenterby` = '$user_id'");
        return view('ready_center.ready_center_search_foreign', ['count'=>$count]);
    }

    public function search(Request $request)
    {

        $q = strtoupper(str_replace(' ', '', $_POST['my_wf_no']));
        $type = $_POST['type'];
        $data['qq1'] = $q; // Put in hidden field
        $qq2 = strtoupper(str_replace(' ', '', $_POST['rss']));

        if (!empty($q) && !empty($type)) {
            if ($type == 'Foreign Passport'){
                if ($q == $qq2) {
                    $data['flg'] = 0;
                    $data['message'] = "Already Search by this Passport !";
                    return response()->json($data);
                } else {
                    $data['flg'] = 1;
                    $data['result'] = DB::table('tbl_fp_served')
                        ->select('passport', 'strk_no', 'contact', 'id')
                        ->where('passport', $q)
                        ->orderBy('id', 'desc')->first();
                    return response()->json($data);
                }
            }else{
                if ($q == $qq2) {
                    $data['flg'] = 0;
                    $data['message'] = "Already Search by this Passport !";
                    return response()->json($data);
                } else {
                    $data['flg'] = 1;
                    $data['result'] = DB::table('tbl_port_update')
                        ->select('passport', 'sticker', 'contact', 'serial_no')
                        ->where('passport', $q)
                        ->where('ServiceType', $type)
                        ->orderBy('serial_no', 'desc')->first();
                    return response()->json($data);
                }
            }


        } else {
            $data['contact'] = "No Data Found";
            $data['name'] = "No Data Found";
            $data['sticker'] = "No Data Found";
            $data['stNo'] = "No Data Found";
            echo json_encode($data);
        }


    }

    public function search_ready_center(Request $request)
    {

        $q = strtoupper(str_replace(' ', '', $_POST['my_wf_no']));
        $type = $_POST['type'];
        $data['qq1'] = $q; // Put in hidden field
        $qq2 = strtoupper(str_replace(' ', '', $_POST['rss']));

        if (!empty($q) && !empty($type)) {
            if ($type == 'Foreign Passport'){
                if ($q == $qq2) {
                    $data['flg'] = 0;
                    $data['message'] = "Already Search by this Passport !";
                    return response()->json($data);
                } else {
                    $data['flg'] = 1;
                    $data['result'] = DB::table('tbl_fp_served')
                        ->select('passport', 'strk_no', 'contact', 'id')
                        ->where('passport', $q)
                        ->orderBy('id', 'desc')->first();
                    return response()->json($data);
                }
            }else{
                if ($q == $qq2) {
                    $data['flg'] = 0;
                    $data['message'] = "Already Search by this Passport !";
                    return response()->json($data);
                } else {
                    $data['flg'] = 1;
                    $data['result'] = DB::table('tbl_port_update')
                        ->select('passport', 'sticker', 'contact', 'serial_no')
                        ->where('passport', $q)
                        ->where('ServiceType', $type)
                        ->orderBy('serial_no', 'desc')->first();
                    return response()->json($data);
                }
            }


        } else {
            $data['contact'] = "No Data Found";
            $data['name'] = "No Data Found";
            $data['sticker'] = "No Data Found";
            $data['stNo'] = "No Data Found";
            echo json_encode($data);
        }


    }

    public function store(Request $request)
    {
        $passport = $_POST['wf_no'];
        $id = $request->id;
        $gd_number = $request->gd_number;
        $arr_queue = array();
       // $filter_array = array_unique(array_filter($passport));
        $filter=array_keys(array_flip($passport));
        $filter_array = array_filter($filter);
        $success_count = 0;
        $fail_count = 0;
        if (!empty($filter_array) && isset($filter_array) && !empty($id) && isset($id)) {

            for ($i = 0; $i < count($filter_array); $i++) {
                echo $filter_array[$i];

                if ($id[$i] != NULL) {
                    if ($request->service_type == 'Foreign Passport'){
                        DB::table('tbl_fp_served')
                            ->where('id', $id[$i])
                            ->where('passport', $filter_array[$i])
                            ->update(['status' => 2, 'del2apptime' => now(), 'del2appby' => auth()->user()->user_id, 'delremark'=>$gd_number[$i]]);
                        $success_count++;
                    }else{
                        DB::table('tbl_port_update')
                            ->where('serial_no', $id[$i])
                            ->where('passport', $filter_array[$i])
                            ->update(['status' => 2, 'del2app_time' => now(), 'del2app_by' => auth()->user()->user_id, 'delRemarks'=>$gd_number[$i]]);
                        $success_count++;
                    }


                } else {

                    array_push($arr_queue, $filter_array[$i]);
                    $dataArr = array(
                        'passport' => $filter_array[$i],
                        'del_by' => auth()->user()->user_id,
                        'del_time' => now(),
                        'service_type' => $request->service_type,
                    );
                    $inserted = DB::table('tbl_del_ready')->insert($dataArr);
                    $fail_count++;
                }


            }
        }

        Session::flash('message', 'Successfully Added = '.$success_count.' & Fail to Add = '.$fail_count);
        if ($fail_count >0){
            Session::flash('passport_no', $arr_queue);
        }

        Session::flash('alert-class', 'btn-info');

        if ($request->service_type == 'R.A.P./P.A.P.'){
            return redirect('/delivery_to_app');
        }else if ($request->service_type == 'Port Endorsement'){
            return redirect('/port-delivery-to-app');
        }else if ($request->service_type == 'Foreign Passport'){
            return redirect('/foreign-delivery-to-app');
        }

    }


    public function store_ready_center(Request $request){
        $passport = $_POST['wf_no'];
        $id = $request->id;
        $arr_queue = array();
        // $filter_array = array_unique(array_filter($passport));
        $filter=array_keys(array_flip($passport));
        $filter_array = array_filter($filter);
        $success_count = 0;
        $fail_count = 0;
        if (!empty($filter_array) && isset($filter_array) && !empty($id) && isset($id)) {

            for ($i = 0; $i < count($filter_array); $i++) {
                echo $filter_array[$i];

                if ($id[$i] != NULL) {
                    if ($request->service_type == 'Foreign Passport'){
                        DB::table('tbl_fp_served')
                            ->where('id', $id[$i])
                            ->where('passport', $filter_array[$i])
                            ->update(['status' => 2, 'readycentertime' => now(), 'readycenterby' => auth()->user()->user_id]);
                        $success_count++;
                    }else{
                        DB::table('tbl_port_update')
                            ->where('serial_no', $id[$i])
                            ->where('passport', $filter_array[$i])
                            ->update(['status' => 2, 'ready_cen_time' => now(), 'ready_cen_by' => auth()->user()->user_id]);
                        $success_count++;
                    }


                } else {

                    array_push($arr_queue, $filter_array[$i]);
                    $dataArr = array(
                        'passport' => $filter_array[$i],
                        'del/ready' => auth()->user()->user_id,
                        'del_time' => now(),
                        'service_type' => $request->service_type,
                    );
                    $inserted = DB::table('tbl_del_ready')->insert($dataArr);
                    $fail_count++;
                }


            }
        }

        Session::flash('message', 'Successfully Added = '.$success_count.' & Fail to Add = '.$fail_count);
        if ($fail_count >0){
            Session::flash('passport_no', $arr_queue);
        }

        Session::flash('alert-class', 'btn-info');

        if ($request->service_type == 'R.A.P./P.A.P.'){
            return redirect('/rappap-ready-center');
        }else if ($request->service_type == 'Port Endorsement'){
            return redirect('/port-ready-center');
        }else if ($request->service_type == 'Foreign Passport'){
            return redirect('/foreign-ready-center');
        }
    }

    public function foreign_details()
    {
        $data = array();
        $data['details'] = DB::select('select del2appby from `tbl_fp_served` WHERE del2appby IS NOT NULL group by `del2appby`');
        return view('del2app.details_foreign', $data);
    }

    public function foreign_details_search(Request $request){
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
            $data['print_data'] = DB::select("SELECT * FROM `tbl_fp_served` WHERE date(del2apptime) >= '$from' AND date(del2apptime) <= '$to'");
        } else {
            $data['print_data'] = DB::select("SELECT * FROM `tbl_fp_served` WHERE `del2appby` = '$user_id' AND date(del2apptime) >= '$from' AND date(del2apptime) <= '$to'");
        }
        return view('del2app.details_reports_print_foreign', $data);
    }

    public function foreign_summary(){
        $data = array();
        $data['details'] = DB::select('select del2appby from `tbl_fp_served` WHERE del2appby IS NOT NULL group by `del2appby`');
        return view('del2app.summary_foreign', $data);
    }

    public function foreign_summary_search(Request $request){
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
            $data['print_data'] = DB::select("SELECT count(*) as count_row, `del2appby`,`del2apptime` FROM tbl_fp_served WHERE date(del2apptime) >='$from' AND date(del2apptime) <= '$to' GROUP BY date(del2apptime)");
        } else {
            $data['print_data'] = DB::select("SELECT count(*) as count_row, `del2appby`,`del2apptime` FROM tbl_fp_served WHERE del2appby='$user_id' AND date(del2apptime) >= '$from' AND date(del2apptime) <= '$to' GROUP BY date(del2apptime)");
        }
        return view('del2app.summary_reports_print_foreign', $data);
    }

    public function port_details()
    {
        $data = array();
        $data['details'] = DB::select("select del2app_by from `tbl_port_update` WHERE del2app_by IS NOT NULL AND `ServiceType` = 'Port Endorsement' group by `del2app_by`");
        return view('del2app.details_port', $data);
    }

    public function port_details_search(Request $request){
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
            $data['print_data'] = DB::select("SELECT * FROM `tbl_port_update` WHERE `ServiceType`='Port Endorsement' AND date(del2app_time) >= '$from' AND date(del2app_time) <= '$to'");
        } else {
            $data['print_data'] = DB::select("SELECT * FROM `tbl_port_update` WHERE `ServiceType`='Port Endorsement' AND `del2app_by` = '$user_id' AND date(del2app_time) >= '$from' AND date(del2app_time) <= '$to'");
        }
        return view('del2app.details_reports_print_port', $data);
    }

    public function port_summary(){
        $data = array();
        $data['details'] = DB::select("select del2app_by from `tbl_port_update` WHERE del2app_by IS NOT NULL AND `ServiceType` = 'Port Endorsement' group by `del2app_by`");
        return view('del2app.summary_port', $data);
    }

    public function port_summary_search(Request $request){
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
            $data['print_data'] = DB::select("SELECT count(*) as count_row, `del2app_by`,`del2app_time` FROM tbl_port_update WHERE `ServiceType` = 'Port Endorsement' AND date(del2app_time) >='$from' AND date(del2app_time) <= '$to' GROUP BY date(del2app_time)");
        } else {
            $data['print_data'] = DB::select("SELECT count(*) as count_row, `del2app_by`,`del2app_time` FROM tbl_port_update WHERE `ServiceType` = 'Port Endorsement' AND del2app_by='$user_id' AND date(del2app_time) >= '$from' AND date(del2app_time) <= '$to' GROUP BY date(del2app_time)");
        }
        return view('del2app.summary_reports_print_port', $data);
    }

    public function rappap_details(){
        $data = array();
        $data['details'] = DB::select("select del2app_by from `tbl_port_update` WHERE `ServiceType` = 'R.A.P./P.A.P.' AND del2app_by IS NOT NULL group by `del2app_by`");
        return view('del2app.details_rappap', $data);
    }

    public function rappap_details_search(Request $request){
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
            $data['print_data'] = DB::select("SELECT * FROM `tbl_port_update` WHERE `ServiceType`='R.A.P./P.A.P.' AND date(del2app_time) >= '$from' AND date(del2app_time) <= '$to'");
        } else {
            $data['print_data'] = DB::select("SELECT * FROM `tbl_port_update` WHERE `ServiceType`='R.A.P./P.A.P.' AND `del2app_by` = '$user_id' AND date(del2app_time) >= '$from' AND date(del2app_time) <= '$to'");
        }
        return view('del2app.details_reports_print_rappap', $data);
    }

    public function rappap_summary(){
        $data = array();
        $data['details'] = DB::select("select del2app_by from `tbl_port_update` WHERE del2app_by IS NOT NULL AND `ServiceType` = 'R.A.P./P.A.P.' group by `del2app_by`");
        return view('del2app.summary_rappap', $data);
    }

    public function rappap_summary_search(Request $request){
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
            $data['print_data'] = DB::select("SELECT count(*) as count_row, `del2app_by`,`del2app_time` FROM tbl_port_update WHERE `ServiceType` = 'R.A.P./P.A.P.' AND date(del2app_time) >='$from' AND date(del2app_time) <= '$to' GROUP BY date(del2app_time)");
        } else {
            $data['print_data'] = DB::select("SELECT count(*) as count_row, `del2app_by`,`del2app_time` FROM tbl_port_update WHERE `ServiceType` = 'R.A.P./P.A.P.' AND del2app_by='$user_id' AND date(del2app_time) >= '$from' AND date(del2app_time) <= '$to' GROUP BY date(del2app_time)");
        }
        return view('del2app.summary_reports_print_rappap', $data);
    }


    public function foreign_ready_center_details(){
        $data = array();
        $data['details'] = DB::select('select readycenterby from `tbl_fp_served` WHERE readycenterby IS NOT NULL group by `readycenterby`');
        return view('ready_center.details_foreign', $data);
    }

    public function foreign_ready_center_details_search(Request $request){
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
            $data['print_data'] = DB::select("SELECT * FROM `tbl_fp_served` WHERE date(readycentertime) >= '$from' AND date(readycentertime) <= '$to'");
        } else {
            $data['print_data'] = DB::select("SELECT * FROM `tbl_fp_served` WHERE `readycenterby` = '$user_id' AND date(readycentertime) >= '$from' AND date(readycentertime) <= '$to'");
        }
        return view('ready_center.details_reports_print_foreign', $data);
    }

    public function foreign_ready_center_summary(){
        $data = array();
        $data['details'] = DB::select('select readycenterby from `tbl_fp_served` WHERE readycenterby IS NOT NULL group by `readycenterby`');
        return view('ready_center.summary_foreign', $data);
    }

    public function foreign_ready_center_summary_search(Request $request){
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
            $data['print_data'] = DB::select("SELECT count(*) as count_row, `readycenterby`,`readycentertime` FROM tbl_fp_served WHERE date(readycentertime) >='$from' AND date(readycentertime) <= '$to' GROUP BY date(readycentertime)");
        } else {
            $data['print_data'] = DB::select("SELECT count(*) as count_row, `readycenterby`,`readycentertime` FROM tbl_fp_served WHERE readycenterby='$user_id' AND date(readycentertime) >= '$from' AND date(readycentertime) <= '$to' GROUP BY date(readycentertime)");
        }
        return view('ready_center.summary_reports_print_foreign', $data);
    }


    public function port_ready_center_details(){
        $data = array();
        $data['details'] = DB::select("select `ready_cen_by` from `tbl_port_update` WHERE `ready_cen_by` IS NOT NULL AND `ServiceType` = 'Port Endorsement' group by `ready_cen_by`");
        return view('ready_center.details_port', $data);
    }

    public function port_ready_center_summary(){
        $data = array();
        $data['details'] = DB::select("select `ready_cen_by` from `tbl_port_update` WHERE `ready_cen_by` IS NOT NULL AND `ServiceType` = 'Port Endorsement' group by `ready_cen_by`");
        return view('ready_center.summary_port', $data);
    }

    public function port_ready_center_summary_search(Request $request){
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
            $data['print_data'] = DB::select("SELECT count(*) as count_row, `ready_cen_by`,`ready_cen_time` FROM tbl_port_update WHERE `ServiceType` = 'Port Endorsement' AND date(ready_cen_time) >='$from' AND date(ready_cen_time) <= '$to' GROUP BY date(ready_cen_time)");
        } else {
            $data['print_data'] = DB::select("SELECT count(*) as count_row, `ready_cen_by`,`ready_cen_time` FROM tbl_port_update WHERE `ServiceType` = 'Port Endorsement' AND ready_cen_by='$user_id' AND date(ready_cen_time) >= '$from' AND date(ready_cen_time) <= '$to' GROUP BY date(ready_cen_time)");
        }
        return view('ready_center.summary_reports_print_port', $data);
    }

    public function port_ready_center_details_search(Request $request){
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
            $data['print_data'] = DB::select("SELECT * FROM `tbl_port_update` WHERE `ServiceType`='Port Endorsement' AND date(ready_cen_time) >= '$from' AND date(ready_cen_time) <= '$to'");
        } else {
            $data['print_data'] = DB::select("SELECT * FROM `tbl_port_update` WHERE `ServiceType`='Port Endorsement' AND `ready_cen_by` = '$user_id' AND date(ready_cen_time) >= '$from' AND date(ready_cen_time) <= '$to'");
        }
        return view('ready_center.details_reports_print_port', $data);
    }

    public function rappap_ready_center_details(){
        $data = array();
        $data['details'] = DB::select("select ready_cen_by from `tbl_port_update` WHERE `ServiceType` = 'R.A.P./P.A.P.' AND ready_cen_by IS NOT NULL group by `ready_cen_by`");
        return view('ready_center.details_rappap', $data);
    }

    public function rappap_ready_center_summary(){
        $data = array();
        $data['details'] = DB::select("select ready_cen_by from `tbl_port_update` WHERE `ServiceType` = 'R.A.P./P.A.P.' AND ready_cen_by IS NOT NULL group by `ready_cen_by`");
        return view('ready_center.summary_rappap', $data);
    }

    public function rappap_ready_center_details_search(Request $request){
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
            $data['print_data'] = DB::select("SELECT * FROM `tbl_port_update` WHERE `ServiceType`='R.A.P./P.A.P.' AND date(ready_cen_time) >= '$from' AND date(ready_cen_time) <= '$to'");
        } else {
            $data['print_data'] = DB::select("SELECT * FROM `tbl_port_update` WHERE `ServiceType`='R.A.P./P.A.P.' AND `ready_cen_by` = '$user_id' AND date(ready_cen_time) >= '$from' AND date(ready_cen_time) <= '$to'");
        }
        return view('ready_center.details_reports_print_rappap', $data);
    }

    public function rappap_ready_center_summary_search(Request $request){
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
            $data['print_data'] = DB::select("SELECT count(*) as count_row, `ready_cen_by`,`ready_cen_time` FROM tbl_port_update WHERE `ServiceType` = 'R.A.P./P.A.P.' AND date(ready_cen_time) >='$from' AND date(ready_cen_time) <= '$to' GROUP BY date(ready_cen_time)");
        } else {
            $data['print_data'] = DB::select("SELECT count(*) as count_row, `ready_cen_by`,`ready_cen_time` FROM tbl_port_update WHERE `ServiceType` = 'R.A.P./P.A.P.' AND ready_cen_by='$user_id' AND date(ready_cen_time) >= '$from' AND date(ready_cen_time) <= '$to' GROUP BY date(ready_cen_time)");
        }
        return view('ready_center.summary_reports_print_rappap', $data);
    }

    public function delete_foreign_del_to_app(){
        $data = array();
        if (isset($_POST['submit'])) {
            $passport = strtoupper(str_replace(' ', '', $_POST['passport']));
            $type = $_POST['type'];
            $data['type'] = $type;
            if ($type == 'readyCenter'){
                $data['deleteDatas'] = DB::table('tbl_fp_served')
                    ->where('passport', $passport)
                    ->whereNotNull('readycenterby')
                    ->orderBy('id', 'DESC')
                    ->get();
            }elseif ($type == 'del2app'){
                $data['deleteDatas'] = DB::table('tbl_fp_served')
                    ->where('passport', $passport)
                    ->whereNotNull('del2appby')
                    ->orderBy('id', 'DESC')
                    ->get();
            }


        }
        return view('del2app.delete_foreign', $data);
    }

    public function delete_foreign_del_to_app_action($type, $id){
        $get_data = DB::table('tbl_fp_served')->where('id', $id)->orderBy('id', 'desc')->first();
        if ($type == 'del2app'){
            $data = $get_data->passport.';'.$get_data->gratis_status.';'.$get_data->strk_no.';'.$get_data->receive_no.';'.$get_data->app_name.';'.$get_data->contact.';'.$get_data->web_file_no.';'.$get_data->center.';'.$get_data->remarks.';'.$get_data->del2appby.';'.$get_data->del2apptime.';'.$type.';Foreign Passport';
            $arrData = array(
                'del2appby' => NULL,
                'del2apptime' => NULL,
                'status' => 1
            );
            $updated = DB::table('tbl_fp_served')
                ->where('id', $id)
                ->update($arrData);
        }elseif ($type == 'readyCenter'){
            $data = $get_data->passport.';'.$get_data->gratis_status.';'.$get_data->strk_no.';'.$get_data->receive_no.';'.$get_data->app_name.';'.$get_data->contact.';'.$get_data->web_file_no.';'.$get_data->center.';'.$get_data->remarks.';'.$get_data->readycenterby.';'.$get_data->readycentertime.';'.$type.';Foreign Passport';
            $arrData = array(
                'readycenterby' => NULL,
                'readycentertime' => NULL,
                'status' => 1
            );
            $updated = DB::table('tbl_fp_served')
                ->where('id', $id)
                ->update($arrData);
        }




        if ($updated) {
            DB::table('tbl_delete_log')->insert(
                ['delete_id' => $id,
                    'type' => 5,
                    'delete_data' => $data,
                    'delete_by' => Auth::user()->user_id,
                    'delete_date' => date('Y-m-d H:i:s'),
                ]);
        }
        if ($updated) {
            Session::flash('message', 'Successfully Deleted Data !');
            Session::flash('alert-class', 'btn-info');
        } else {
            Session::flash('message', 'Fail to Deleted Data !');
            Session::flash('alert-class', 'btn-danger');
        }
        return redirect('/delete-del-app-foreign');
    }

    public function delete_port_del_to_app(){
        $data = array();
        if (isset($_POST['submit'])) {
            $passport = strtoupper(str_replace(' ', '', $_POST['passport']));
            $type = $_POST['type'];
            $data['type'] = $type;
            if ($type == 'readyCenter'){
                $data['deleteDatas'] = DB::table('tbl_port_update')
                    ->where('passport', $passport)
                    ->where('ServiceType', 'Port Endorsement')
                    ->whereNotNull('ready_cen_by')
                    ->orderBy('serial_no', 'DESC')
                    ->get();
            }elseif ($type == 'del2app'){
                $data['deleteDatas'] = DB::table('tbl_port_update')
                    ->where('passport', $passport)
                    ->where('ServiceType', 'Port Endorsement')
                    ->whereNotNull('del2app_by')
                    ->orderBy('serial_no', 'DESC')
                    ->get();
            }


        }
        return view('del2app.delete_port', $data);
    }

    public function delete_port_del_to_app_action($type, $id){
        $get_data = DB::table('tbl_port_update')->where('serial_no', $id)->first();
        if ($type == 'del2app'){
            $data = $get_data->passport.';'.$get_data->applicant_name.';'.$get_data->visa_no.';'.$get_data->rec_cen_time.';'.$get_data->visa_type.';'.$get_data->contact.';'.$get_data->MasterPP.';'.$get_data->applicant_name.';'.$get_data->center.';'.$type.';Port Endorsement';
            $arrData = array(
                'del2app_by' => NULL,
                'del2app_time' => NULL,
                'status' => 1
            );
            $updated = DB::table('tbl_port_update')
                ->where('serial_no', $id)
                ->update($arrData);
        }elseif ($type == 'readyCenter'){
            $data = $get_data->passport.';'.$get_data->applicant_name.';'.$get_data->visa_no.';'.$get_data->rec_cen_time.';'.$get_data->visa_type.';'.$get_data->contact.';'.$get_data->MasterPP.';'.$get_data->applicant_name.';'.$get_data->center.';'.$type.';Port Endorsement';
            $arrData = array(
                'ready_cen_by' => NULL,
                'ready_cen_time' => NULL,
                'status' => 1
            );
            $updated = DB::table('tbl_port_update')
                ->where('serial_no', $id)
                ->update($arrData);
        }

        if ($updated) {
            DB::table('tbl_delete_log')->insert(
                ['delete_id' => $id,
                    'type' => 5,
                    'delete_data' => $data,
                    'delete_by' => Auth::user()->user_id,
                    'delete_date' => date('Y-m-d H:i:s'),
                ]);
        }
        if ($updated) {
            Session::flash('message', 'Successfully Deleted Data !');
            Session::flash('alert-class', 'btn-info');
        } else {
            Session::flash('message', 'Fail to Deleted Data !');
            Session::flash('alert-class', 'btn-danger');
        }
        return redirect('/delete-del-ready-port');
    }

    public function delete_rappap_del_to_app(){
        $data = array();
        if (isset($_POST['submit'])) {
            $passport = strtoupper(str_replace(' ', '', $_POST['passport']));
            $type = $_POST['type'];
            $data['type'] = $type;
            if ($type == 'readyCenter'){
                $data['deleteDatas'] = DB::table('tbl_port_update')
                    ->where('passport', $passport)
                    ->where('ServiceType', 'R.A.P./P.A.P.')
                    ->whereNotNull('ready_cen_by')
                    ->orderBy('serial_no', 'DESC')
                    ->get();
            }elseif ($type == 'del2app'){
                $data['deleteDatas'] = DB::table('tbl_port_update')
                    ->where('passport', $passport)
                    ->where('ServiceType', 'R.A.P./P.A.P.')
                    ->whereNotNull('del2app_by')
                    ->orderBy('serial_no', 'DESC')
                    ->get();
            }


        }
        return view('del2app.delete_rappap', $data);
    }

    public function delete_rappap_del_to_app_action($type, $id){
        $get_data = DB::table('tbl_port_update')->where('serial_no', $id)->first();
        if ($type == 'del2app'){
            $data = $get_data->passport.';'.$get_data->applicant_name.';'.$get_data->visa_no.';'.$get_data->rec_cen_time.';'.$get_data->visa_type.';'.$get_data->contact.';'.$get_data->MasterPP.';'.$get_data->applicant_name.';'.$get_data->center.';'.$type.';R.A.P./P.A.P.';
            $arrData = array(
                'del2app_by' => NULL,
                'del2app_time' => NULL,
                'status' => 1
            );
            $updated = DB::table('tbl_port_update')
                ->where('serial_no', $id)
                ->update($arrData);
        }elseif ($type == 'readyCenter'){
            $data = $get_data->passport.';'.$get_data->applicant_name.';'.$get_data->visa_no.';'.$get_data->rec_cen_time.';'.$get_data->visa_type.';'.$get_data->contact.';'.$get_data->MasterPP.';'.$get_data->applicant_name.';'.$get_data->center.';'.$type.';R.A.P./P.A.P.';
            $arrData = array(
                'ready_cen_by' => NULL,
                'ready_cen_time' => NULL,
                'status' => 1
            );
            $updated = DB::table('tbl_port_update')
                ->where('serial_no', $id)
                ->update($arrData);
        }

        if ($updated) {
            DB::table('tbl_delete_log')->insert(
                ['delete_id' => $id,
                    'type' => 5,
                    'delete_data' => $data,
                    'delete_by' => Auth::user()->user_id,
                    'delete_date' => date('Y-m-d H:i:s'),
                ]);
        }
        if ($updated) {
            Session::flash('message', 'Successfully Deleted Data !');
            Session::flash('alert-class', 'btn-info');
        } else {
            Session::flash('message', 'Fail to Deleted Data !');
            Session::flash('alert-class', 'btn-danger');
        }
        return redirect('/delete-del-ready-rappap');
    }




}
