<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
use DB;

class ReportsController extends Controller
{
    /**
    * @return Port update report form page view function
    **/
    public function port_update_report_view_page()
    {
        // echo "jjd";
        // exit();
        // Call authCheck Function
        // $this->authCheck();
        $data['page_title'] = 'PORT UPDATE REPORT';
//        $data['main_content'] = view('report.port_update_report');
        return view('report.port_update_report');
//        return view('master')->with($data);
    }

    /**
    * @return Port update report result
    **/
    public function port_update_report_result(Request $request)
    {
        // Call authCheck Function
        // $this->authCheck();


        $approved_status = $request->approved_status;
        $form_date = $request->from_date;
        $to_date = $request->to_date;
        if($approved_status == 'all'){

            //$data['page_title'] = 'PORT UPDATE REPORT RESULT';
           // $data['main_content'] = view('report.port_update_report_result_all');
            return view('report.port_update_report_result_all');

        }elseif ($approved_status == 'Approved') {

            // $data['page_title'] = 'PORT UPDATE REPORT RESULT';
            // $data['main_content'] = view('report.port_update_report_result_approved');
            return view('report.port_update_report_result_approved');
             
        }elseif ($approved_status == 'Rejected') {

            // $data['page_title'] = 'PORT UPDATE REPORT RESULT';
            // $data['main_content'] = view('report.port_update_report_result_reject');
            return view('report.port_update_report_result_reject');

        }elseif ($approved_status == 'Pending') {

            // $data['page_title'] = 'PORT UPDATE REPORT RESULT';
            // $data['main_content'] = view('report.port_update_report_result_pending');
            return view('report.port_update_report_result_pending');
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
