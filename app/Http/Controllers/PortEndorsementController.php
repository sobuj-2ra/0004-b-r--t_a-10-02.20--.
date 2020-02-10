<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\portEndorsementModel;
use Auth;
use Illuminate\Support\Facades\Input;
use App\User;
use Session;


class PortEndorsementController extends Controller
{
    public function index($st, $stf, $stt, $vt)
    {
        if ($st == 1) {
            $a = "";
        } else
            $a = $st;

        if ($stf == 2) {
            $b = "";
        } else
            $b = $stf;

        if ($stt == 3) {
            $c = "";
        } else
            $c = $stt;

        if ($vt == 4) {
            $d = "";
        } else
            $d = $vt;

        //$this->authCheck();
        //$data['page_title'] = 'Additional Service Receiver';
        //$data['main_content'] = view('portendorsement.portendorsement');
        //return view('master')->with($data);
        $user = Auth::user()->name;
        $routes = DB::table('tbl_route')->select('route_id', 'route_name')->get();
        //$transport = DB::table('tbl_transport_mode')->select('serial_no','mode')->get();
        $sticker = DB::table('tbl_sticker_mapping')->select('id', 'sticker')->get();
        $visatype = DB::table('tbl_visa_type')->select('visa_type_id', 'visa_type')->get();
        $fee = DB::table('tbl_ivac_services')->select('Svc_Fee')->where('Service', 'Port Endorsement')->first();

        $return_data = DB::table('tbl_port_update')->select('serial_no', 'applicant_name', 'passport', 'visa_no', 'contact', 'Remarks', 'Fee', 'OldPort', 'NewPort', 'sticker', 'ServiceType', 'visa_type')->where('rec_cen_by', $user)->orderBy('uploadTime', 'desc')->first();

        $center_name = DB::table('tbl_center_info')->select('center_name', 'region', 'center_info', 'center_phone', 'del_time')->where('center_name', Auth::user()->center_name)->get();

        // if you need to pass other data to view, put it in data[]
        // e.g., $data['username'] = Auth::user()->username;

        /*if (Session::has('passport')) {
            $passport['passport'] = Session::get('passport');
            var_dump($passport['passport']);
            exit();
        }*/
        //var_dump($user);
        //exit();


        return view('portendorsement.portendorsement', ['routes' => $routes, 'sticker' => $sticker, 'visatype' => $visatype, 'fee' => $fee, 'center_name' => $center_name, 'return_data' => $return_data, 'stype' => $a, 'sfrom' => $b, 'sto' => $c, 'vt' => $d]);
    }


    public function save(Request $req)
    {
        $pass = $req->input("passport");
        $today = date('Y-m-d');
        $check = DB::select("SELECT * FROM `tbl_port_update` WHERE `passport` = '$pass' AND date(rec_cen_time) = '$today' AND ServiceType = 'Port Endorsement' ORDER BY serial_no DESC");
        if (isset($check) && !empty($check)) {
            Session::flash('message', 'This Passport Number Already Exist Today !');
            Session::flash('alert-class', 'btn-danger');
            return redirect('/portendorsement/1/2/3/4');
        } else {
            $serviceType = $req->input("serviceType");
            $sticker_type = $req->input("sticker_type");
            $passport = $pass;
            $visa_no = $req->input("visa_no");
            $visa_type = $req->input("visa_type");
            $center = Auth::user()->center_name;
            $region = $req->input("region");
            $fee = $req->input("fee");
            $name = $req->input("name");
            $sticker_no = $req->input("sticker_no");
            $sticker_from = $req->input("sticker_no_from");
            $sticker_to = $req->input("sticker_no_to");
            $contactNo = $req->input("contactNo");
            $remarks = $req->input("remarks");
            $old_port = $req->input("current_port");
            $new_port = $req->input("require_port");
            $sticker = $sticker_type . $sticker_no;
            $user = Auth::user()->user_id;
            //$now = date('Y-m-d H:i:s');
            //var_dump($old_port);
            //exit();
            $oldPort = implode(',', $old_port);
            $newPort = implode(',', $new_port);

            $passport = str_replace(' ', '', $passport);


            $data = array(
                'applicant_name' => $name,
                'passport' => strtoupper(str_replace(' ', '', $passport)),
                'visa_no' => $visa_no,
                'visa_type' => $visa_type,
                'contact' => (int)$contactNo,
                'rec_cen_by' => $user,
                'center' => $center,
                'region' => $region,
                'uploadTime' => date('Y-m-d H:i:s'),
                'rec_cen_time' => date('Y-m-d H:i:s'),
                'Remarks' => $remarks,
                'Fee' => $fee,
                'OldPort' => $oldPort,
                'NewPort' => $newPort,
                'sticker' => $sticker,
                'ServiceType' => $serviceType,
                'created_at' => date('Y-m-d H:i:s'),
                'active' => 1,
                'status' => 1
            );


            DB::table('tbl_port_update')->insert($data);
            $id = DB::getPdo()->lastInsertId();

            if (isset($id) && !empty($id)) {
                $c_date = date('Y-m-d');
                $tdd = $this->delivery_date($c_date);
                $updated = DB::table('tbl_port_update')
                    ->where('serial_no', $id)
                    ->update([
                        'tdd' => $tdd
                    ]);
            }
            if ($data) {
                Session::flash('message', 'Successfully Inserted Data !');
                Session::flash('alert-class', 'btn-info');
                //Session::flash('value',$passport);
            } else {
                Session::flash('message', 'Fail to Delete Data !');
                Session::flash('alert-class', 'btn-danger');
            }

            return redirect('/portendorsement/' . $sticker_type . '/' . $sticker_from . '/' . $sticker_to . '/' . $visa_type . '/' . $id);

        }


    }


    public function update(Request $req)

    {

        $serviceType = $req->input("serviceType");
        $passport = $req->input("passport");
        $visa_no = $req->input("visa_no");
        $visa_type = $req->input("visa_type");
        $fee = $req->input("fee");
        $name = $req->input("name");
        $sticker = $req->input("sticker");
        $contactNo = $req->input("contactNo");
        $remarks = $req->input("remarks");
        $old_port = $req->input("current_port");
        $new_port = $req->input("require_port");
        $id = $req->input("serial_number");

        $oldPort = implode(',', $old_port);
        $newPort = implode(',', $new_port);

        $passport = str_replace(' ', '', $passport);

        $updated = DB::table('tbl_port_update')
            ->where('serial_no', $id)
            ->update([
                'applicant_name' => $name,
                'passport' => strtoupper(str_replace(' ', '', $passport)),
                'visa_no' => $visa_no,
                'visa_type' => $visa_type,
                'contact' => (int)$contactNo,
                'uploadTime' => date('Y-m-d H:i:s'),
                'rec_cen_time' => date('Y-m-d H:i:s'),
                'Remarks' => $remarks,
                'Fee' => $fee,
                'OldPort' => $oldPort,
                'NewPort' => $newPort,
                'sticker' => $sticker,
                'ServiceType' => $serviceType,
                'updated_at' => date('Y-m-d H:i:s')
            ]);


        if ($updated) {
            Session::flash('message', 'Successfully Updated Data !');
            Session::flash('alert-class', 'btn-info');
        } else {
            Session::flash('message', 'Fail to Update Data !');
            Session::flash('alert-class', 'btn-danger');
        }
        return redirect("/edit-port-endorsement-print/$id");
    }

    public function edit_view($id)
    {
        $data = DB::table('tbl_port_update')
            ->where('serial_no', $id)
            ->first();

        $routes = DB::table('tbl_route')->select('route_id', 'route_name')->get();

        $sticker = DB::table('tbl_sticker_mapping')->select('id', 'sticker')->get();
        $visatype = DB::table('tbl_visa_type')->select('visa_type_id', 'visa_type')->get();
        $fee = DB::table('tbl_ivac_services')->select('Svc_Fee')->where('Service', 'Port Endorsement')->first();
        /*$return_data = DB::table('tbl_port_update')->select('serial_no','applicant_name','passport','visa_no','contact','Remarks','Fee','OldPort','NewPort','sticker','ServiceType','visa_type')->orderBy('uploadTime','desc')->first();*/

        return view('portendorsement.portendorsement_edit', ['routes' => $routes, 'sticker' => $sticker, 'visatype' => $visatype, 'fee' => $fee, 'data' => $data]);
    }


    public static function total_receive()
    {

        $username = Auth::user()->name;
        $reciveDate = date('Y-m-d');

        $sql = "SELECT count(passport) as total 
   FROM         tbl_port_update WHERE date(rec_cen_time) ='$reciveDate' AND rec_cen_by ='$username'";
        $execute = DB::select($sql);
        $total = $execute[0]->total;
        return $total;
    }


    /*Slip Print Start*/
    public static function printData($st, $stf, $stt, $vt, $id)
    {
        $data = array();
        $user = Auth::user()->name;
        $data['id'] = $id;
        $sql_common = "Select serial_no,applicant_name, passport, contact,OldPort,NewPort,sticker,Fee,visa_type,visa_no,center_name, center_web,center_info,center_phone,del_time,tdd  FROM tbl_port_update,tbl_center_info WHERE serial_no= '$id' AND tbl_port_update.center=tbl_center_info.center_name";


        $data['routes'] = DB::table('tbl_route')->select('route_id', 'route_name')->get();
        $data['sticker'] = DB::table('tbl_sticker_mapping')->select('id', 'sticker')->get();
        $data['visatype'] = DB::table('tbl_visa_type')->select('visa_type_id', 'visa_type')->get();
        $data['fee'] = DB::table('tbl_ivac_services')->select('*')->where('Service', 'Port Endorsement')->first();
        $data['return_data'] = DB::table('tbl_port_update')->select('serial_no', 'applicant_name', 'passport', 'visa_no', 'contact', 'Remarks', 'Fee', 'OldPort', 'NewPort', 'sticker', 'ServiceType', 'visa_type')->where('rec_cen_by', $user)->orderBy('uploadTime', 'desc')->first();
        $data['center_name'] = DB::table('tbl_center_info')->select('center_name', 'region', 'center_info', 'center_phone', 'del_time')->get();
        $data['print_details'] = DB::select($sql_common);
        $data['form'] = $stf;
        $data['to'] = $stt;
        $data['type'] = $st;

        return view('portendorsement.portendorsement_print', $data);
    }

    public function port_search_sticker_numbers()
    {
        $number = $_GET['numb'];
        $name = $_GET['name'];
        $strk = $name . $number;
        $d = date('Y-m-d');

        $data = DB::select("SELECT * FROM `tbl_port_update` WHERE date(created_at) = '$d' AND sticker = '$strk' AND ServiceType='Port Endorsement'");
        return response()->json($data);
    }

    public static function edit_printData($id)
    {
        $data = array();
        $user = Auth::user()->name;
        $data['id'] = $id;
        $sql_common = "Select serial_no,applicant_name, passport, contact,OldPort,NewPort,sticker,Fee,visa_type,visa_no,center_name, center_web,center_info,center_phone,del_time,tdd  FROM tbl_port_update,tbl_center_info WHERE serial_no= '$id' AND tbl_port_update.center=tbl_center_info.center_name";


        $data['routes'] = DB::table('tbl_route')->select('route_id', 'route_name')->get();
        $data['sticker'] = DB::table('tbl_sticker_mapping')->select('id', 'sticker')->get();
        $data['visatype'] = DB::table('tbl_visa_type')->select('visa_type_id', 'visa_type')->get();
        $data['fee'] = DB::table('tbl_ivac_services')->select('*')->where('Service', 'Port Endorsement')->first();
        $data['return_data'] = DB::table('tbl_port_update')->select('serial_no', 'applicant_name', 'passport', 'visa_no', 'contact', 'Remarks', 'Fee', 'OldPort', 'NewPort', 'sticker', 'ServiceType', 'visa_type')->where('rec_cen_by', $user)->orderBy('uploadTime', 'desc')->first();
        $data['center_name'] = DB::table('tbl_center_info')->select('center_name', 'region', 'center_info', 'center_phone', 'del_time')->get();
        $data['print_details'] = DB::select($sql_common);

        return view('portendorsement.edit_slip_print', $data);
    }

    public static function delivery_date($c_date)
    {
        $reciveDate = $c_date;

        /*Taking Lead Time*/
        $sql = "SELECT LeadTime FROM  tbl_ivac_services WHERE   Service ='Port Endorsement'";
        $LeadTime = DB::select($sql);

        /*Taking Holidays List*/
        $sql_holiday = "SELECT date(date) as dt FROM  tbl_holiday";
        $hday = DB::select($sql_holiday);

        $leadDate = $LeadTime[0]->LeadTime;

        $tmp = array();
        $temdt = array();
        $x = 1;

        foreach ($hday as $val) {
            $tmp[] = $val->dt;
        }

        while ($x <= $leadDate) {
            $temdt[] = date('Y-m-d', strtotime($reciveDate . " + $x day"));
            $newdat = array();

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


    public function reprint()
    {
        $data = array();
        if (isset($_POST['submit'])) {
            $passport = strtoupper(str_replace(' ', '', $_POST['passport']));
            $data['reprint'] = $s_data = DB::table('tbl_port_update')
                ->where('passport', $passport)
                ->where('ServiceType', 'Port Endorsement')
                ->orderBy('serial_no', 'DESC')
                ->first();
            if (isset($s_data->center) && !empty($s_data->center)) {
                $data['center_name'] = DB::table('tbl_center_info')
                    ->where('center_name', $s_data->center)
                    ->first();
                $data['fee'] = DB::table('tbl_ivac_services')
                    ->select('Svc_Fee', 'slip_copy')
                    ->where('Service', 'Port Endorsement')
                    ->first();
            }


        }
        return view('portendorsement.reprint', $data);

    }

    public function details_report()
    {
        $data = array();
        $data['details'] = DB::select("select rec_cen_by from `tbl_port_update` WHERE ServiceType = 'Port Endorsement' group by `rec_cen_by`");
        return view('portendorsement.port_details', $data);
    }

    public function port_details_report_search(Request $request)
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
        $data['ServiceType'] = 'Port-Endorsement';

        if ($user_id == 'all') {
            $data['print_data'] = DB::select("SELECT * FROM `tbl_port_update` WHERE ServiceType = 'Port Endorsement' AND date(rec_cen_time) >= '$from' AND date(rec_cen_time) <= '$to'");
        } else {
            $data['print_data'] = DB::select("SELECT * FROM `tbl_port_update` WHERE ServiceType = 'Port Endorsement' AND `rec_cen_by` = '$user_id' AND date(rec_cen_time) >= '$from' AND date(rec_cen_time) <= '$to'");
        }
        return view('portendorsement.port_details_reports_print', $data);
    }

    public function summary_report()
    {
        $data = array();
        $data['details'] = DB::select("select rec_cen_by from `tbl_port_update` WHERE ServiceType = 'Port Endorsement' group by `rec_cen_by`");
        return view('portendorsement.port_summary', $data);
    }

    public function port_summary_report_search(Request $request)
    {
        $user_id = $request->user_id;
        $from_date = date('Y-m-d', strtotime($request->from_date));
        $to_date = date('Y-m-d', strtotime($request->to_date));
        if ($user_id == 'all') {
            $data = DB::select("SELECT count(*) as count_row, `rec_cen_time` FROM tbl_port_update WHERE date(rec_cen_time) >='$from_date' AND date(rec_cen_time) <= '$to_date' and `ServiceType` = 'Port Endorsement' GROUP BY date(rec_cen_time)");
        } else {
            $data = DB::select("SELECT count(*) as count_row, `rec_cen_time` FROM tbl_port_update WHERE `rec_cen_by` = '$user_id' AND date(rec_cen_time) >='$from_date' AND date(rec_cen_time) <= '$to_date' and `ServiceType` = 'Port Endorsement' GROUP BY date(rec_cen_time)");
        }


        return view('portendorsement.summary_report_print', ['form_date' => $from_date, 'to_date' => $to_date, 'serviceType' => 'Port-Endorsement', 'p_data' => $data, 'user_id' => $user_id]);
    }


    public function edit_port_endorsement()
    {

        if (isset($_POST['submit'])) {
            $passport = strtoupper(str_replace(' ', '', $_POST['passport']));
            $data = DB::table('tbl_port_update')
                ->where('passport', $passport)
                ->where('ServiceType', 'Port Endorsement')
                ->orderBy('serial_no', 'desc')
                ->first();


            if (isset($data) && !empty($data)) {
                $routes = DB::table('tbl_route')->select('route_id', 'route_name')->get();

                $sticker = DB::table('tbl_sticker_mapping')->select('id', 'sticker')->get();
                $visatype = DB::table('tbl_visa_type')->select('visa_type_id', 'visa_type')->get();
                $fee = DB::table('tbl_ivac_services')->select('Svc_Fee')->where('Service', 'Port Endorsement')->first();

                return view('portendorsement.portendorsement_edit', ['routes' => $routes, 'sticker' => $sticker, 'visatype' => $visatype, 'fee' => $fee, 'data' => $data]);
            } else {
                $d = array();
                $data['messages'] = '<h4 align="center">No Passport Match</h4>';
                return view('portendorsement.edit_port_endorsement', $d);
            }


        }
        return view('portendorsement.edit_port_endorsement');

    }

    public function destroy_view()
    {
        $data = array();
        if (isset($_POST['submit'])) {
            $passport = strtoupper(str_replace(' ', '', $_POST['passport']));
            $data['delete_data'] = DB::table('tbl_port_update')
                ->where('passport', $passport)
                ->where('ServiceType', 'Port Endorsement')
                ->orderBy('serial_no', 'desc')
                ->get();

        }
        return view('portendorsement.delete', $data);
    }

    public function destroy($id)
    {
        $get_data = DB::table('tbl_port_update')->where('serial_no', $id)->first();
        $data = $get_data->applicant_name.';'.$get_data->passport.';'.$get_data->center.';'.$get_data->visa_no.';'.$get_data->visa_type.';'.$get_data->contact.';'.$get_data->rec_cen_time.';'.$get_data->MasterPP;
        $delete = DB::table('tbl_port_update')
            ->where('serial_no', $id)
            ->delete();
        if ($delete) {
            DB::table('tbl_delete_log')->insert(
                ['delete_id' => $id,
                    'type' => 2,
                    'delete_data' => $data,
                    'delete_by' => Auth::user()->user_id,
                    'delete_date' => date('Y-m-d H:i:s'),
                ]);
        }
        if ($delete) {
            Session::flash('message', 'Successfully Deleted Data !');
            Session::flash('alert-class', 'btn-info');
        } else {
            Session::flash('message', 'Fail to Delete Data !');
            Session::flash('alert-class', 'btn-danger');
        }
        return redirect('delete_portendorsement');
    }


}