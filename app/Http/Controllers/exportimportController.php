<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Post;
use DB;
use Excel;
use Illuminate\Http\Request;
use Input;
use Session;

class exportimportController extends Controller
{

    public function export()
    {

        $portinfo = DB::table('tbl_port_update')->orderByRaw('serial_no DESC')->get();
        return view('exportimport.export', ['portinfo' => $portinfo]);
    }

    public function excel(Request $request)
    {
        //echo $now = date('Y-m-d H:i:s');exit;
        //echo $timestamp = time();
        $date = date('Y-m-d', strtotime($request->dateinput));



//        $port_update_data = DB::table('tbl_port_update')->whereDate(date('rec_cen_time'), $request->dateinput)->get()->toArray();
        $port_update_data = DB::select("SELECT * FROM `tbl_port_update` WHERE date(`rec_cen_time`) = '$date'");

        $port_array[] = array('applicant_name', 'designation', 'passport', 'center', 'visa_no', 'visa_type', 'contact', 'rec_cen_time', 'rec_cen_by', 'sent2hci_time', 'sent2hci_by', 'recFrmHCI_time', 'recFrmHCI_by', 'del2app_time', 'status', 'uploadTime', 'region', 'Remarks', 'Fee', 'OldPort', 'NewPort', 'area', 'mode', 'sticker', 'ServiceType', 'arrivalDate', 'departureDate', 'MasterPP', 'approve_status', 'approve_by', 'approve_date');

        foreach ($port_update_data as $val) {
            $port_array[] = array(
                'applicant_name' => $val->applicant_name,
                'designation' => $val->designation,
                'passport' => $val->passport,
                'center' => $val->center,
                'visa_no' => $val->visa_no,
                'visa_type' => $val->visa_type,
                'contact' => $val->contact,
                'rec_cen_time' => $val->rec_cen_time,
                'rec_cen_by' => $val->rec_cen_by,
                'sent2hci_time' => $val->sent2hci_time,
                'sent2hci_by' => $val->sent2hci_by,
                'recFrmHCI_time' => $val->recFrmHCI_time,
                'recFrmHCI_by' => $val->recFrmHCI_by,
                'del2app_time' => $val->del2app_time,
                'status' => $val->status,
                'uploadTime' => $val->uploadTime,
                'region' => $val->region,
                'Remarks' => $val->Remarks,
                'Fee' => $val->Fee,
                'OldPort' => $val->OldPort,
                'NewPort' => $val->NewPort,
                'area' => $val->area,
                'mode' => $val->mode,
                'sticker' => $val->sticker,
                'ServiceType' => $val->ServiceType,
                'arrivalDate' => $val->arrivalDate,
                'departureDate' => $val->departureDate,
                'MasterPP' => $val->MasterPP,
                'approve_status' => $val->approve_status,
                'approve_by' => $val->approve_by,
                'approve_date' => $val->approve_date
            );
        }

        Excel::create($date . '_portexport', function ($excel) use ($port_array) {

            $excel->setTitle('R.A.P / P.A.P Data');
            $excel->sheet('Table Data', function ($sheet) use ($port_array) {
                $sheet->fromArray($port_array, null, 'A1', false, false);

            });

        })->download('txt');

    }

    public function import()
    {

        return view('exportimport.import');
    }


    public function importExcel(Request $request)
    {

        $total_data =' ';
        $message    =' ';


        if($request->hasFile('import_file')){

            Excel::load($request->file('import_file')->getRealPath(), function ($reader) use (&$total_data, &$message) {

                $csb_data     = $reader->toArray();

                $total_data   = count($csb_data);

                $val          = array();

                $one_col_data = array_column($csb_data, 'passport');

                foreach ($one_col_data as $col_data) {

                    $val[]="'".$col_data."'";
                }
                $passport_list=array_unique($val);
                $updata=implode(",",$passport_list);

                $sql="select `active` from `tbl_port_update` where `passport` in ($updata) and active=1";

                $result=DB::select($sql);


                DB::statement("update `tbl_port_update` set active =0 WHERE `passport` IN ($updata)");

                $i = 0;
                $j = 0;
                $k = 0;
                foreach ($reader->toArray() as $key => $row) {

                    $data['applicant_name']  = $row['applicant_name'];
                    $data['designation']     = $row['designation'];
                    $data['passport']        = $row['passport'];
                    $data['center']          = $row['center'];
                    $data['visa_no']         = $row['visa_no'];
                    $data['visa_type']       = $row['visa_type'];
                    $data['contact']         = $row['contact'];
                    $data['rec_cen_time']  	 = $row['rec_cen_time'];
                    $data['rec_cen_by']      = $row['rec_cen_by'];
                    $data['sent2hci_time']   = $row['sent2hci_time'];

                    $data['sent2hci_by']     = $row['sent2hci_by'];
                    $data['recFrmHCI_time']  = $row['recfrmhci_time'];
                    $data['recFrmHCI_by']    = $row['recfrmhci_by'];
                    $data['del2app_time']    = $row['del2app_time'];
                    $data['status']          = $row['status'];
                    $data['uploadTime']      = $row['uploadtime'];
                    $data['region']          = $row['region'];
                    $data['Remarks']         = $row['remarks'];
                    $data['Fee']             = $row['fee'];
                    $data['OldPort']         = $row['oldport'];
                    $data['NewPort']         = $row['newport'];
                    $data['area']            = $row['area'];
                    $data['mode']            = $row['mode'];
                    $data['sticker']         = $row['sticker'];
                    $data['ServiceType']     = $row['servicetype'];
                    $data['arrivalDate']     = $row['arrivaldate'];
                    $data['departureDate']   = $row['departuredate'];
                    $data['MasterPP']        = $row['masterpp'];
                    $data['approve_status']  = 'Pending';
                    $data['active'] 		 = 1;
                    $data['approve_by']      = $row['approve_by'];
                    $data['approve_date']    = $row['approve_date'];

                    if(!empty($data)) {
                        $f = DB::affectingStatement("insert into tbl_port_update (`applicant_name`,`designation`,`passport`,`center`,`visa_no`,`visa_type`,
`contact`,`rec_cen_time`,`rec_cen_by`,`status`,`region`,`Remarks`,`Fee`,`OldPort`,`NewPort`,`area`,`mode`,`sticker`,`ServiceType`,`arrivalDate`,`departureDate`,`MasterPP`,`approve_status`,`active`) values ('$row[applicant_name]',
'$row[designation]','$row[passport]','$row[center]','$row[visa_no]','$row[visa_type]','$row[contact]','$row[rec_cen_time]','$row[rec_cen_by]','$row[status]','$row[region]','$row[remarks]','$row[fee]','$row[oldport]','$row[newport]', '$row[area]','$row[mode]','$row[sticker]','$row[servicetype]','$row[arrivaldate]','$row[departuredate]','$row[masterpp]','Pending',1)  on duplicate key update  `applicant_name`='$row[applicant_name]',`designation`='$row[designation]',`passport`='$row[passport]',`center`='$row[center]',`visa_no`='$row[visa_no]',`visa_type`='$row[visa_type]',`contact`='$row[contact]',`rec_cen_time`='$row[rec_cen_time]',`rec_cen_by`='$row[rec_cen_by]',`status`='$row[status]',`region`='$row[region]',`Remarks`='$row[remarks]',`Fee`='$row[fee]',`OldPort`='$row[oldport]',`NewPort`='$row[newport]',`area`='$row[area]',`mode`='$row[mode]',`sticker`='$row[sticker]',`ServiceType`='$row[servicetype]',`arrivalDate`='$row[arrivaldate]',`departureDate`='$row[departuredate]',`MasterPP`='$row[masterpp]',`approve_status`='Pending', `active`=1");

                        if ($f == 1){
                            $i++;
                        }else if($f == 2){
                            $j ++;

                        }else if($f == 0){
                            $k++;
                        }
                        $message="Total Passport = $total_data, Inserted = $i, And Already Exist = $j";
                    }
                }

            });
        }
        return redirect("import/data")->with("success", "$message");
    }

//    public function importExcel(Request $request)
//    {
//
//        $total_data = ' ';
//        $message = ' ';
//
//        if ($request->hasFile('import_file')) {
//
//            Excel::load($request->file('import_file')->getRealPath(), function ($reader) use (&$total_data, &$message) {
//
//                $csb_data = $reader->toArray();
//
//                $total_data = count($csb_data);
//                $val = array();
//
//                $one_col_data = array_column($csb_data, 'passport');
//
//                $i = 0;
//                $j = 0;
//
//                foreach ($one_col_data as $col_data) {
//
//                    $val[] = "'" . $col_data . "'";
//                }
//                $passport_list = array_unique($val);
//                $updata = implode(",", $passport_list);
//
//                foreach ($reader->toArray() as $key => $row) {
//                    //echo $row['visa_no'];
//                    $query_visa = DB::table('tbl_port_update')
//                        ->where('passport', '=', $row['passport'])
//                        ->where('visa_no', '=', $row['visa_no'])
//                        ->where('rec_cen_time', '=', $row['rec_cen_time'])
//                        ->where('MasterPP', '=', $row['masterpp'])
//                        ->where('active', 1)
//                        ->first();
//                    if (isset($query_visa) && !empty($query_visa)) {
//                        $i = $i + 1;
//                    } else {
//                        $j = $j + 1;
//                        DB::statement("insert into tbl_port_update (`applicant_name`,`designation`,`passport`,`center`,`visa_no`,`visa_type`,
//`contact`,`rec_cen_time`,`rec_cen_by`,`status`,`region`,`Remarks`,`Fee`,`OldPort`,`NewPort`,`area`,`mode`,`sticker`,`ServiceType`,`arrivalDate`,`departureDate`,`MasterPP`,`approve_status`,`active`) values ('$row[applicant_name]',
//'$row[designation]','$row[passport]','$row[center]','$row[visa_no]','$row[visa_type]','$row[contact]','$row[rec_cen_time]','$row[rec_cen_by]','$row[status]','$row[region]','$row[remarks]','$row[fee]','$row[oldport]','$row[newport]', '$row[area]','$row[mode]','$row[sticker]','$row[servicetype]','$row[arrivaldate]','$row[departuredate]','$row[masterpp]','Pending',1)");
//
//                    }
//                    $message = "Total Passport = $total_data . Inserted = $j AND Already Exist = $i ";
//                }
//
//            });
//        }
//        return redirect("import/data")->with("success", "$message");
//    }


}
