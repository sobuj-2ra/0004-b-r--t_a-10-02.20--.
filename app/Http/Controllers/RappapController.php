<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\rappapModel;
use Auth;
use Session;

class RappapController extends Controller
{
    public function index($st, $stf, $stt,$printid){

        if($st==1)
        {
            $a="";
        }
        else
            $a=$st;

        if($stf==2)
        {
            $b="";
        }
        else
            $b=$stf;
        if($stt==3)
        {
            $c="";
        }
        else
            $c= $stt;


        //$c=$stt;
        $routes      = DB::table('tbl_route')->select('route_id', 'route_name')->where('service_type', 'R.A.P./P.A.P.')->orWhere('service_type', 'all')->orderBy('route_id', 'desc')->get(); //Entry Port / Exit Port
        $port        = DB::table('tbl_port_names')->select('port_id', 'port_name')->where('service_type', 'R.A.P./P.A.P.')->get(); // Area
        $mode        = DB::table('tbl_transport_mode')->select('serial_no', 'mode')->get(); // Mode query
        //Fee
        $fee         = DB::table('tbl_ivac_services')->select('Svc_Fee')->where('Service', 'R.A.P./P.A.P.')->get();
        //Sticker name
        $sticker     = DB::table('tbl_sticker_mapping')->select('id', 'sticker')->get();
        //Visa Type
        $visatype    = DB::table('tbl_visa_type')->select('visa_type_id', 'visa_type')->get();
        //Designation
        $designation = DB::table('tbl_designation')->select('designation')->get();
        //Center Name
        $center_name = DB::table('tbl_center_info')->select('center_name','region')->where('center_name', Auth::user()->center_name)->get();


        return view('rappap.rappapadd', ['routes' => $routes,'port' => $port,
            'sticker' => $sticker,'visatype' => $visatype, 'designation'=>$designation, 'mode'=>$mode, 'fee'=>$fee, 'center_name'=> $center_name, 'stype'=>$a, 'sfrom'=>$b, 'sto'=>$c, 'printid'=>$printid]);
    }

    public function index2($st, $stf, $stt,$printid){

        if($st==1)
        {
            $a="";
        }
        else
            $a=$st;

        if($stf==2)
        {
            $b="";
        }
        else
            $b=$stf;
        if($stt==3)
        {
            $c="";
        }
        else
            $c= $stt;


        //$c=$stt;
        $routes      = DB::table('tbl_route')->select('route_id', 'route_name')->where('service_type', 'R.A.P./P.A.P.')->orWhere('service_type', 'all')->orderBy('route_id', 'desc')->get(); //Entry Port / Exit Port
        $port        = DB::table('tbl_port_names')->select('port_id', 'port_name')->where('service_type', 'R.A.P./P.A.P.')->get(); // Area
        $mode        = DB::table('tbl_transport_mode')->select('serial_no', 'mode')->get(); // Mode query
        //Fee
        $fee         = DB::table('tbl_ivac_services')->select('Svc_Fee')->where('Service', 'R.A.P./P.A.P.')->get();
        //Sticker name
        $sticker     = DB::table('tbl_sticker_mapping')->select('id', 'sticker')->get();
        //Visa Type
        $visatype    = DB::table('tbl_visa_type')->select('visa_type_id', 'visa_type')->get();
        //Designation
        $designation = DB::table('tbl_designation')->select('designation')->get();
        //Center Name
        $center_name = DB::table('tbl_center_info')->select('center_name','region')->where('center_name', Auth::user()->center_name)->get();


        return view('rappapadd', ['routes' => $routes,'port' => $port,
            'sticker' => $sticker,'visatype' => $visatype, 'designation'=>$designation, 'mode'=>$mode, 'fee'=>$fee, 'center_name'=> $center_name, 'stype'=>$a, 'sfrom'=>$b, 'sto'=>$c, 'printid'=>$printid]);
    }

    public function save(Request $request){

        // var_dump(explode(" ",$request->port)); exit();
        //***************************************//
        // Creating Model Object
        //***************************************//
        $data             = new rappapModel;
        //***************************************//

        //***************************************//
        // Taking Field Value Start
        //***************************************//

        /*Array variable declraing for strore value*/

        $sticker_type     = $request->stickerType;

        $sticker_from     = $request->stickerfrom;

        $sticker_to       = $request->stickerto;

        $passportdataSet  = [];
        $visadataSet      = [];
        $stickerdataSet   = [];
        $feedataSet       = [];
        $applicantdataSet = [];
        $designationSet   = [];
        $visatypedataSet  = [];
        $contactdataSet   = [];

        $stickerType       = $request->stickerType;

        $now = date('Y-m-d H:i:s');

        /*Taking value for multifield*/

        $pn=$request->passportNo;
        $vn=$request->visa_no;
        $sn=$request->stickerNo;
        $fe=$request->fee;
        $ac=$request->applicant_name;
        $dd=$request->designation;
        $vt=$request->visaType;
        $ct=$request->contactNo;

        $m =$request->master_passport;

        /*Storing value for passport*/
        foreach ($pn  as $value) {
            $passportdataSet[]= [
                'passport'  => $value
            ];
        }

        /*Storing value for visa no*/
        foreach ($vn  as $value) {
            $visadataSet[]= [
                'visa_no'  => $value

            ];
        }

        /*Storing value for sticker no*/
        foreach ($sn  as $value) {
            $stickerdataSet[]= [
                'sticker_no'  => $value
            ];
        }

        /*Storing value for fee*/
        foreach ($fe  as $value) {
            $feedataSet[]= [
                'fee_no'  => $value
            ];
        }

        /*Storing value for applicant*/
        foreach ($ac as $value) {
            $applicantdataSet[]= [
                'applicant_name'  => $value
            ];
        }

        /*Storing value for designation*/
        foreach ($dd as $value) {
            $designationSet[]= [
                'designation'  => $value
            ];
        }


        /*Storing value for visa type*/
        foreach ($vt as $value) {
            $visatypedataSet[]= [
                'visa_type'  => $value
            ];
        }

        /*Storing value for contact no*/
        foreach ($ct as $value) {
            $contactdataSet[]= [
                'contact_no'  => (int)$value
            ];
        }

        $temp=array();
        $user=Auth::user()->user_id;

        $mpass=str_replace(' ','', $request->mpassport);

        foreach($passportdataSet as $key=>$value)
        {

            $temp[$key]['ServiceType']    = 'R.A.P./P.A.P.';

            $temp[$key]['OldPort']        = $request->route;
            $temp[$key]['NewPort']        = $request->exit_port;

            $temp[$key]['arrivalDate']    = $request->arrivalDate;
            $temp[$key]['departureDate']  = $request->derpartureDate;
            $temp[$key]['center']         = $request->center_name;
            $temp[$key]['region']         = $request->region;
            $temp[$key]['passport']       = strtoupper(str_replace(' ','', $value['passport']));
            $temp[$key]['visa_no']        = $visadataSet[$key]['visa_no'];
            $temp[$key]['sticker']        = $stickerType.$stickerdataSet[$key]['sticker_no'];
            $temp[$key]['Fee']            = $feedataSet[$key]['fee_no'];
            $temp[$key]['applicant_name'] = $applicantdataSet[$key]['applicant_name'];
            $temp[$key]['designation']    = $designationSet[$key]['designation'];
            $temp[$key]['visa_type']      = $visatypedataSet[$key]['visa_type'];
            $temp[$key]['contact']        = $contactdataSet[$key]['contact_no'];
            $temp[$key]['Remarks']        = $request->reMarks;
            $temp[$key]['MasterPP']       = strtoupper($mpass);
            $temp[$key]['rec_cen_time']   = $now;
            $temp[$key]['uploadTime']     = $now;
            $temp[$key]['ServiceType']    = 'R.A.P./P.A.P.';
            $temp[$key]['rec_cen_by']     = $user;
            $temp[$key]['area']           = $request->port;
            $temp[$key]['mode']           = $request->mode;
            $temp[$key]['approve_status'] = 'Pending';
            $temp[$key]['status']         = 1;
            $temp[$key]['active']         = 1;
            $temp[$key]['created_at']         = date('Y-m-d H:i:s');
        }

        $temp = array_map('array_filter', $temp);
        $temp = array_filter($temp);

        array_pop($temp); //Removing last empty array
        // print_r($temp);

        $serialID= DB::table('tbl_port_update')->insert($temp);

        $id = DB::getPdo()->lastInsertId();
        if (isset($id) && !empty($id)){
            $c_date = date('Y-m-d');
            $tdd = $this->delivery_date($c_date);
            $updated = DB::table('tbl_port_update')
                ->where('serial_no', $id)
                ->update([
                    'tdd' => $tdd
                ]);
        }

        return redirect("/rap/pap/$sticker_type/$sticker_from/$sticker_to/$id")->with('message','Application form has submitted Successfully');
    }

    public static function index2Print($a, $b, $c, $id)
    {

        if($id!=='m'){

            $master_passport = "SELECT MasterPP FROM tbl_port_update WHERE serial_no=$id";

            $mp              = DB::select($master_passport);
            $mp_name         = $mp[0]->MasterPP;

            $sql_common      = "Select serial_no,applicant_name, passport, contact,OldPort,NewPort,sticker,Fee,visa_type,visa_no,area,mode,center_name, center_web,center_info, del_time  FROM tbl_port_update,tbl_center_info WHERE MasterPP='$mp_name' AND tbl_port_update.center=tbl_center_info.center_name";

            $print_details   = DB::select($sql_common);

        }
        return $mp;
    }


    public function viewreport(){

        $services  = DB::table('tbl_ivac_services')->select('sl', 'Service')->get();
        //Center Name
        $center_name = DB::table('tbl_center_info')->select('center_name')->get();
        //Receive By
        $receive_by = DB::table('tbl_port_update')->select('rec_cen_by')->distinct('rec_cen_by')->get();

        return view('rappap.rappap_report_form',['services'=>$services,'center_name'=> $center_name,'receive_by'=> $receive_by, 'stype'=>'1','sfrom'=>'2','sto'=>'3']);
    }

    public function report_detail(Request $request)
    {
        $ServiceType   =  $request->service_name;
        $ser_type = str_replace("/","-",$ServiceType);

        $centerName    =  $request->center_name;
        $receiveBy = $user_id =  $request->receive_by;
        $fromDate      =  $request->from_date;
        $toDate        =  $request->to_date;

        $fromDate = $fromDate;
        $fromDate = date("Y-m-d", strtotime($fromDate));

        $toDate = $toDate;
        $toDate = date("Y-m-d", strtotime($toDate));

        $sql = "SELECT * FROM tbl_port_update";
        $con1= " WHERE ServiceType='$ServiceType'";
        $con2= " AND cast(rec_cen_time as date) BETWEEN '$fromDate' AND '$toDate'";

        if(($receiveBy=='all') &&  ($centerName=='all'))
        {
            $sql_common  = $sql.$con1.$con2;
        }
        else if(($receiveBy=='all') &&  ($centerName!=='all'))
        {
            $con3=" AND center ='$centerName'";
            $sql_common  = $sql.$con1.$con2.$con3;
        }
        else if(($receiveBy!=='all') &&  ($centerName=='all'))
        {
            $con4        =" AND rec_cen_by = '$receiveBy'";

            $sql_common  = $sql.$con1.$con2.$con4;
        }
        else if(($receiveBy!=='all') &&  ($centerName!=='all'))
        {
            $con4=" AND center = '$centerName'";
            $con5=" AND rec_cen_by = '$receiveBy'";

            $sql_common= $sql.$con1.$con2.$con4.$con5;
        }
        else{

            $sql_common    = $sql.$con1.$con2;
        }
        $rappap_receive_detail = DB::select($sql_common);

        return view('rappap.rappapdetail', ['rappap_detail' => $rappap_receive_detail, 'ServiceType'=>$ser_type,'centerName'=>$centerName,'fromdate'=>$fromDate,'todate'=>$toDate,'user_id'=>$user_id]);
    }

    // summary Report Start

    public function receive_summary(){
        //Center Name
        $center_name = DB::table('tbl_center_info')->select('center_name')->get();
        return view('rappap.receive_summary_form',['center_name'=> $center_name]);
    }

    public function receive_summary_view(Request $request)
    {
        $ServiceType   =  $request->service_name;

        $centerName    =  $request->center_name;
        $fromDate      =  $request->from_date;
        $toDate        =  $request->to_date;


//SELECT DISTINCT date( `rec_cen_time`), `rec_cen_by` FROM `tbl_port_update` WHERE `rec_cen_by`='Admin' AND date(rec_cen_time) BETWEEN '2019-01-19' AND '2019-01-19'


        $sql = "SELECT DISTINCT date(`rec_cen_time`) as rd, `rec_cen_by` FROM tbl_port_update WHERE `ServiceType` = 'R.A.P./P.A.P.' ";
        $con1= " AND center='$centerName'";
        $con2= " AND date(rec_cen_time) BETWEEN '$fromDate' AND '$toDate'";
        $con3= " AND date(rec_cen_time) BETWEEN '$fromDate' AND '$toDate'";
        // $con4= " ";

        if($centerName=='all')
        {
            $sql_common  = $sql.$con3;
        }
        else
            $sql_common    = $sql.$con1.$con2;


        //echo  $sql_common ;exit;
        // echo $sql_common; exit;
        $rappap_receive_summary = DB::select($sql_common);
        //print_r($rappap_receive_summary); exit;

//print_r($tmp);



        return view('rappap.rappap_summary_view', ['rappap_receive_summary' => $rappap_receive_summary, 'fromdate'=>$fromDate,'todate'=>$toDate]);
    }
    // summary Report End

    //Approved detail and report

    public function approveview(Request $request){


        return view('rappap.approveview');
    }


    public function approvedetail(Request $request){


        $approve_status=  $request->approve_status;
        $approveBy     =  $request->approve_by;
        // echo $receiveBy ;
        //exit;
        $fromDate      =  date('Y-m-d', strtotime($request->from_date));
        $toDate        =  date('Y-m-d', strtotime($request->to_date));

        $sql = " SELECT * FROM tbl_port_update ";
        $con1= " WHERE approve_by ='$approveBy'";
        $con2= " AND date(approve_date) BETWEEN '$fromDate' AND '$toDate'";
        $con3= " WHERE date(approve_date) BETWEEN '$fromDate' AND '$toDate'";
        $con4= " AND approve_status='$approve_status'";

        if(($approveBy=='all') &&  ($approve_status=='all'))
        {
            $sql_common  = $sql.$con3;
        }
        else if(($approveBy=='all') &&  ($approve_status!=='all'))
        {

            if($approve_status=='Pending')
            {

                $con3=" WHERE approve_status ='$approve_status'";
                $con5 =" AND  date(approve_date) BETWEEN '$fromDate' AND '$toDate'";
                $sql_common  = $sql.$con3.$con5;
            }
            else if(($approve_status=='Approved') || ($approve_status=='Rejected'))
            {


                $con3 =" WHERE approve_status ='$approve_status'";
                $con5 =" AND  date(approve_date) BETWEEN '$fromDate' AND '$toDate'";
                $sql_common  = $sql.$con3.$con5;
            }

        }
        else if(($approveBy!=='all') &&  ($approve_status=='all'))
        {


            $con6=" WHERE approve_by  = '$approveBy'";
            $con5 =" AND  date(approve_date) BETWEEN '$fromDate' AND '$toDate'";
            $sql_common  = $sql.$con6.$con5;

        }
        else if(($approveBy!=='all') &&  ($approve_status!=='all'))
        {
            $con4=" WHERE approve_status = '$approve_status'";
            $con5=" AND approve_by  = '$approveBy'";

            $sql_common= $sql.$con4.$con5;
        }
        else

            $sql_common    = $sql.$con1.$con2;

        $rappap_approve_detail = DB::select($sql_common);

        return view('rappap.approvedetail' , ['details'=>$rappap_approve_detail, 'approveBy'=>$approveBy,'approve_status'=>$approve_status,  'fromDate'=>$fromDate,'toDate'=>$toDate ]);
    }

    public static  function mpcount($d)
    {
        echo $d;
    }

    /**********************
    Edit Rap/Pap
     ***********************/
    public function edit($request,$flg){

        $routes      = DB::table('tbl_route')->select('route_id', 'route_name')->get(); //Entry Port / Exit Port
        $port        = DB::table('tbl_port_names')->select('port_id', 'port_name')->where('service_type', 'R.A.P./P.A.P.')->get(); // Area
        $mode        = DB::table('tbl_transport_mode')->select('serial_no', 'mode')->get(); // Mode query
        //Fee
        $fee         = DB::table('tbl_ivac_services')->select('Svc_Fee')->where('Service', 'R.A.P./P.A.P.')->get();
        //Sticker name
        $sticker     = DB::table('tbl_sticker_mapping')->select('id', 'sticker')->get();
        //Visa Type
        $visatype    = DB::table('tbl_visa_type')->select('visa_type_id', 'visa_type')->get();
        //Designation
        $designation = DB::table('tbl_designation')->select('designation')->get();
        //Center Name
        $center_name = DB::table('tbl_center_info')->select('center_name','region')->get();

        return view('rappap.edit',['passport'=>$request,'flg'=>$flg,'routes' => $routes,'port' => $port,
            'sticker' => $sticker,'visatype' => $visatype, 'designation'=>$designation, 'mode'=>$mode, 'fee'=>$fee, 'center_name'=> $center_name]);
    }

    /*********************
    Edit Action Start
     *********************/
    public function edit_action(Request $request){

        echo $flag_condition = "passport_view";
        $q = strtoupper(str_replace(' ', '', $request->PassportNo));
        echo $PassportNo= strtoupper($q);
        return redirect("/rap/pap/edit/$PassportNo/$flag_condition");
    }
    /*******************
    Edit Action End
     ******************/


    /***************************
    Edit Information Save Start
     ****************************/

    public function edit_save(Request $request){

        $mpass          = $request->mpass;



        $mpassport      = $request->mpassport; //Edit value

        if($mpassport)
            $mpass  = $mpassport ;

        /*********************************/

        $passportdataSet  = [];
        $visadataSet      = [];
        $stickerdataSet   = [];
        $feedataSet       = [];
        $applicantdataSet = [];
        $designationSet   = [];
        $visatypedataSet  = [];
        $contactdataSet   = [];

        $passportNo     = $request->passportNo;


        $entryport      = implode(',',$request->eport);

        $areaport       = implode(' ',$request->areaport);

        $exitport       = implode(',', $request->exitport);

        $mode           = implode(',', $request->mode_val);

        $arrivalDate    = $request->arrivalDate;

        $derpartureDate = $request->derpartureDate;

        $visa_no        = $request->visa_no;
        $id_serial        = $request->id_serial_no;

        $stickerNo      = $request->stickerNo;

        $fee            = $request->fee;

        $applicant_name = $request->applicant_name;

        $designation    = $request->designation;

        $visaType       = $request->visaType;

        $contactNo      = $request->contactNo;

        $remarks        = $request->remarks;
        $center         = $request->centerName;

        $region         = $request->region;




        /*Storing value for visa no*/

        foreach ($visa_no as $value) {
            $visadataSet[]= [
                'visa_no'  => $value

            ];
        }
        // id
        $time = DB::table('tbl_port_update')->where('serial_no', $id_serial)->first();
        if (isset($time) && !empty($time)){
            $time_rec = $time->rec_cen_time;
        }else{
            $time_rec = date('Y-m-d H:i:s');
        }

        foreach ($stickerNo  as $value) {
            $stickerdataSet[]= [
                'sticker_no'  => $value
            ];
        }


        /*Storing value for fee*/

        foreach ($fee  as $value) {
            $feedataSet[]= [
                'fee_no'  => $value
            ];

        }

        /*Storing value for applicant*/

        foreach ($applicant_name as $value) {
            $applicantdataSet[]= [
                'applicant_name'  => $value
            ];
        }


        /*Storing value for designation*/

        foreach ($designation as $value) {
            $designationSet[]= [
                'designation'  => $value
            ];
        }



        /*Storing value for visa type*/

        foreach ($visaType as $value) {
            $visatypedataSet[]= [
                'visa_type'  => $value
            ];
        }

        /*Storing value for contact no*/

        foreach ($contactNo as $value) {
            $contactdataSet[]= [
                'contact_no'  => (int)$value
            ];
        }


        foreach ($passportNo  as $value)
        {
            $passportdataSet[]= [
                'passport'  => $value
            ];
        }


//print_r($passportdataSet);

        $user=Auth::user()->user_id;
        $now = date('Y-m-d H:i:s');

        foreach($passportdataSet as $key => $row)
        {

            $passport=strtoupper(str_replace(' ','', $passportdataSet[$key]['passport']));

            $contct= $contactdataSet[$key]['contact_no'];

            $applicnt=$applicantdataSet[$key]['applicant_name'];

            $visaNo=$visadataSet[$key]['visa_no'];

            $design=$designationSet[$key]['designation'];

            $visa_type=$visatypedataSet[$key]['visa_type'];

            $sticker = $stickerdataSet[$key]['sticker_no'];

            $fee=$feedataSet[$key]['fee_no'];

            if(!empty($passport) &&  !empty($contct) &&  !empty($applicnt) &&  !empty($visaNo) &&  !empty($design) &&  !empty($visa_type) &&  !empty($sticker)  &&  !empty($fee)){

                DB::statement("insert into tbl_port_update (`applicant_name`,`arrivalDate`,`departureDate`,`passport`,`designation`,`visa_no`,`visa_type` ,`contact`,`Fee`,`MasterPP`,`OldPort`,`NewPort`,`area`,`mode`,`Remarks`,`approve_status`,`sticker`,`ServiceType`,`center`,`region`,`rec_cen_time`,`rec_cen_by`,`uploadTime`,`status`) values ('$applicnt','$arrivalDate','$derpartureDate','$passport','$design','$visaNo','$visa_type','$contct','$fee','$mpass','$entryport','$exitport ','$areaport','$mode','$remarks','Pending','$sticker','R.A.P./P.A.P.','$center','$region','$time_rec','$user','$now',1) on duplicate key update `applicant_name`='$applicnt',`arrivalDate`='$arrivalDate',`departureDate`='$derpartureDate',`passport`='$passport', `designation`='$design',`visa_no`='$visaNo',`visa_type`='$visa_type',`contact`='$contct',`Fee`='$fee',`MasterPP`='$mpass',`OldPort`='$entryport',`NewPort`='$exitport ',`area`='$areaport',`mode`='$mode',`Remarks`='$remarks', `approve_status`='Pending', `sticker`='$sticker',`ServiceType`='R.A.P./P.A.P.',`center`='$center',`region`='$region',`rec_cen_time`='$time_rec',`rec_cen_by`='$user',`uploadTime`='$now',`status`=1");


            }else
                $message="Field cannot be Empty";

        }
        $message="Application form updated Successfully";
        return redirect("/rap/pap/edit/$mpass/update")->with('message', $message);
    }

    /***************************
    Edit Information Save End
     ***************************/

    /**********************************
    Delete Passport Information start
     **********************************/
//    public function delete_rappap($id,$mpass){
//
//        DB::table('tbl_port_update')->where('serial_no', '=', $id)->delete();
//
//        return redirect("/rap/pap/edit/$mpass/delete")->with('message','Passport Deleted Successfully');
//
//    }
    /*******************************
    Delete Passport Information End
     ********************************/


    /***************************
    Edit Information View Start
     ***************************/

    public static function edit_info($PassNo){

        $PassportNo = strtoupper($PassNo);
        $data=array();

        if ($PassportNo) {

            $masterpp = DB::select("select MasterPP from tbl_port_update where passport='$PassportNo' AND approve_status='Pending'");

            if (!empty($masterpp)) {
                $mp = $masterpp[0]->MasterPP;
                if(!empty($mp)){
                    $data['passport_info_common'] =DB::select("select serial_no,Remarks,OldPort, NewPort, area, mode, arrivalDate, departureDate,sticker from tbl_port_update where MasterPP='$mp' AND approve_status='Pending'");


                    $data['passport_info'] = DB::select("select serial_no,applicant_name, passport, visa_no, sticker, Fee, MasterPP, visa_type, contact, designation from tbl_port_update where MasterPP='$mp' AND approve_status='Pending'");
                }
            }

            else
            {
                if(!empty($mp)){
                    $data['passport_info_common'] ==DB::select("select serial_no,Remarks,OldPort, NewPort, area, mode, arrivalDate, departureDate,sticker from tbl_port_update where MasterPP='$mp' AND approve_status='Pending'");

                    $data['passport_info'] = DB::select("select serial_no,applicant_name, passport, visa_no, sticker, Fee, MasterPP, visa_type, contact, designation from tbl_port_update where MasterPP='$PassportNo' AND approve_status='Pending'");
                }
            }

        }
        else
            $data ="";

        return $data;
    }



    /**************************
    @ Slip Print Start
     ***************************/
    public static function slip_print($id)
    {
//        $service = DB::table('tbl_ivac_services')
//            ->where('Service', 'R.A.P./P.A.P.')
//            ->orderBy('sl', 'desc')
//            ->first();

        if($id!=='m'){

            $master_passport = "SELECT MasterPP FROM tbl_port_update WHERE serial_no=$id";

            $mp              = DB::select($master_passport);
            $mp_name         = $mp[0]->MasterPP;

            $sql_common      = "Select serial_no,applicant_name, passport, contact,OldPort,NewPort,sticker,Fee,visa_type,visa_no,area,mode,center_name, center_web,center_info, del_time,tdd  FROM tbl_port_update,tbl_center_info WHERE MasterPP='$mp_name' AND tbl_port_update.center=tbl_center_info.center_name";

            $print_details   = DB::select($sql_common);

        }
        else
        {
            $print_details ="";
        }
        return $print_details;
    }

    /****************************
    @ Delivery Date Calculation
     *****************************/

    public static function delivery_date($c_date)
    {

        $reciveDate  = $c_date;

        /*Taking Lead Time*/
        $sql         = "SELECT LeadTime FROM  tbl_ivac_services WHERE   Service ='R.A.P./P.A.P.'";
        $LeadTime    = DB::select($sql);

        /*Taking Holidays List*/
        $sql_holiday = "SELECT date(date) as dt FROM  tbl_holiday";
        $hday        = DB::select($sql_holiday);

        $leadDate    = $LeadTime[0]->LeadTime;

        $tmp=array();
        $temdt=array();
        $x = 1;

        foreach($hday as $val){
            $tmp[]= $val->dt;
        }

        while($x <=  $leadDate) {

            $temdt[]= date('Y-m-d', strtotime($reciveDate. " + $x day"));
            $newdat=array();
//Sprint_r($temdt);

            foreach ($temdt as $value) {

                if(in_array($value, $tmp)){
                    $newdat[]=$value;
                }
            }
            $x++;
        }

        $hcount=count($newdat);

        $cnt=($leadDate+$hcount);

        $newDate=date('Y-m-d', strtotime($reciveDate . " + $cnt day"));

        return $newDate;

    }

    /*************************
    @ Total Receive Form Count
     **************************/

    public static function total_receive(){

        $username    = Auth::user()->user_id;
        $reciveDate  = date('Y-m-d');

        $sql         = "SELECT count(passport) as total 
   FROM         tbl_port_update WHERE date(rec_cen_time) ='$reciveDate' AND rec_cen_by ='$username'";
        $execute     = DB::select($sql);
        $total=$execute[0]->total;
        return $total;
    }

    /******************************************
    @ Duplicate Visa no Check By AJAX Action
     ******************************************/

    public function check_visano_duplicate(Request $request){

        $input_value= $request->input_value;

        $exist_visa    = DB::table('tbl_port_update')->select('visa_no')->where('visa_no',$input_value)->get();
        if(!empty($exist_visa) && !empty($input_value))
        {
            $exist_visa_val = $exist_visa[0]->visa_no;

            if($exist_visa_val==$input_value)
            {
                $value['flg']=1;
                $value['existVal']=$exist_visa_val;
            }

        }
        else if(empty($exist_visa) && !empty($input_value))
        {
            $value['flg']=2;
        }
        else if(empty($exist_visa) || empty($input_value))
        {
            $value['flg']=2;
        }

        return json_encode($value);

    }

    public function delete_page(){
        $data = array();
        if (isset($_POST['submit'])){
            $passport = strtoupper(str_replace(' ','', $_POST['passport']));
            $data['deleteDatas'] = DB::table('tbl_port_update')
                ->where('passport', $passport)
                ->orderBy('serial_no', 'DESC')
                ->get();
        }
        return view('rappap.delete', $data);
    }

    public function delete($id){
        $get_data = DB::table('tbl_port_update')->where('serial_no', $id)->first();
        $data = $get_data->applicant_name.';'.$get_data->passport.';'.$get_data->center.';'.$get_data->visa_no.';'.$get_data->visa_type.';'.$get_data->contact.';'.$get_data->rec_cen_time.';'.$get_data->MasterPP;
        $delete = DB::table('tbl_port_update')->where('serial_no', $id)->delete();
        if ($delete){
            DB::table('tbl_delete_log')->insert(
                ['delete_id' => $id,
                    'type' => 1,
                    'delete_data' => $data,
                    'delete_by' => Auth::user()->user_id,
                    'delete_date' => date('Y-m-d H:i:s'),
                ]);
        }
        if (isset($delete) && !empty($delete)){
            Session::flash('message', 'Successfully Deleted Data !');
            Session::flash('alert-class', 'btn-info');
        }else{
            Session::flash('message', 'Fail to Deleted Data !');
            Session::flash('alert-class', 'btn-danger');
        }
        return redirect('/delete-rappap');
    }



}


