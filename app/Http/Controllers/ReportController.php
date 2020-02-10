<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
use DB;

class ReportController extends Controller
{
    /**
    * @return Port update report form page view function
    **/
    public function port_update_report_view_page()
    {

        //$data['page_title'] = 'PORT UPDATE REPORT';
        //$data['main_content'] = view('report.port_update_report');
        return view('report.port_update_report');
    }

    /**
    * @return Port update report result
    **/
    public function port_update_report_result(Request $request)
    {
        // Call authCheck Function
        $this->authCheck();
        $approved_status = $request->approved_status;
        $form_date = $request->form_date;
        $to_date = $request->to_date;
        //echo $approved_status.'=>'.$form_date.'=>'.$to_date;
        if($approved_status == 'all'){

            $data['page_title'] = 'PORT UPDATE REPORT RESULT';
            $data['main_content'] = view('report.port_update_report_result_all');
            return view('master')->with($data);

        }elseif ($approved_status == 'Approved') {

            $data['page_title'] = 'PORT UPDATE REPORT RESULT';
            $data['main_content'] = view('report.port_update_report_result_approved');
            return view('master')->with($data);
             
        }elseif ($approved_status == 'Rejected') {

            $data['page_title'] = 'PORT UPDATE REPORT RESULT';
            $data['main_content'] = view('report.port_update_report_result_reject');
            return view('master')->with($data);

        }elseif ($approved_status == 'Pending') {

            $data['page_title'] = 'PORT UPDATE REPORT RESULT';
            $data['main_content'] = view('report.port_update_report_result_pending');
            return view('master')->with($data);
                       
        }

    }


    /**
    * @return Receive summary report view page
    **/
    public function receive_summary_report_view_page()
    {
         // Call authCheck Function

          $center_name = DB::table('tbl_center_info')->select('center_name')->get();
      return view('report.receive_summary_report',['center_name'=> $center_name]);
        
        
    }

    /**
    * @return receive_summary_report_result
    **/
    public function receive_summary_report_result(Request $request)
    {
        $serviceType = $request->service_status;
        $ser_type = str_replace("/","-",$request->service_status);
        $from_date = date('Y-m-d', strtotime($request->from_date));
        $to_date = date('Y-m-d', strtotime($request->to_date));

        if($serviceType == 'R.A.P./P.A.P.')
        {
            $page_title = 'R.A.P./P.A.P. RECEIVE SUMMARY REPORT';
            $data = DB::select("SELECT count(*) as count_row, `rec_cen_time` FROM tbl_port_update WHERE date(rec_cen_time) >='$from_date' AND date(rec_cen_time) <= '$to_date' and `ServiceType` = '$serviceType' GROUP BY date(rec_cen_time)");

            return view('report.R_A_P_P_A_P_receive_summary_report', ['form_date' => $from_date,'to_date'=> $to_date, 'serviceType'=>$ser_type, 'page_title'=>$page_title, 'p_data'=>$data]);
        }
    }

    // Check AuthCHeck
    public function authCheck()
    {
        $admin_id = Session::get('admin_id');
        if($admin_id)
        {
            return;
        } else{
            return Redirect::to('/')->send();
        }
    }


}
