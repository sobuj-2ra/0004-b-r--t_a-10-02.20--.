<?php

namespace App\Http\Controllers;
use App\CenterInfo;
use App\Tbl_fail_ready_del;
use App\User;
use Illuminate\Support\Facades\Redirect;
use App\Tbl_appointmentlist;
use App\Tbl_appointmentserved;
use App\Tbl_correctionfee;
use App\Tbl_counter;
use App\Tbl_ivac_service;
use App\Tbl_rejectcause;
use App\Tbl_setup;
use App\Tbl_sticker;
use App\Tbl_center_info;
use App\Tbl_visa_type;
use App\Tbl_visacheck;
use App\Tbl_del_operation;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Auth;
use App\Tbl_service;
use App\Tbl_service_log;
use Illuminate\Support\Facades\Session;

class CounterController extends Controller
{
    public function index(){
        // $webfile = 'BGDDVE0F4dfd919';
        // $webfileData = Tbl_appointmentlist::where('WebFile_no',$webfile)
        //         ->where('Presence_Status', 'PENDING')
        //         ->First();
        // return $webfileData;
        // return response()->json(['sad'=>$webfileData,'sfasd'=>'fsasd']);

        $hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);

        // $hostname = gethostname();
        $ip = getHostByName(getHostName());


        $counter = Tbl_counter::where('hostname',$hostname)->first();


        if($counter){
            $datas['counter_no'] = $counter->counter_no;
            $datas['floor_id'] = $counter->floor_id;
            $datas['counter_services'] = explode(',',$counter->svc_name);
        }


        $datas['user_id'] = Auth::user()->user_id;
        //$datas['stickers'] = Tbl_sticker::all();
        //$datas['visa_types'] = Tbl_visa_type::all();
        $datas['center_name'] = Tbl_center_info::where('active',1)->first();
        //$datas['ivac_svc_fee'] = Tbl_ivac_service::where('Service', 'Regular Passport')->first();

        //$datas['tdd_list'] = Tbl_visa_type::all();

//        return redirect('readyat-center');
        return view('counter.countercall',$datas);
    }


    public function getData(Request $request){

        $svc_name_data = $request->svc_name;
        if($request->svc_name2 != null){
            $svc_name_data = $request->svc_name2;
        }

        $svc_nos = DB::select('CALL getServiceIdByName("'.$svc_name_data.'")');
        $svc_no = $svc_nos[0]->svc_number;

        $data['regulars'] = DB::select('CALL getRegularToken("'.$svc_no.'")');
        $data['waitings'] = DB::select('CALL getWaitingToken("'.$svc_no.'")');
        $data['recalls'] = DB::select('CALL getRecallToken("'.$svc_no.'")');

        return $data;
    }


    public function getTokenRegular(Request $request){
        $user_id = Auth::user()->user_id;
        $svc_nos = DB::select('CALL getServiceIdByName("'.$request->svc_name.'")');
        $svc_no = $svc_nos[0]->svc_number;

        if($request->token_type == 1){
            $token_res = DB::select('CALL CallTokenF("'.$user_id.'","'.$request->counter_id.'","'.$svc_no.'","'.$request->floor_id.'","'.$request->token_type.'"," ")');
        }
        else{
            $token_res = DB::select('CALL CallTokenF("'.$user_id.'","'.$request->counter_id.'","'.$svc_no.'","'.$request->floor_id.'","'.$request->token_type.'","'.$request->tkn_no.'")');
        }

        return response()->json(['token_res'=>$token_res]);
    }

    public function TokenSentWaiting(Request $request){

        $svc_nos = DB::select('CALL getServiceIdByName("'.$request->service_type.'")');
        $svc_no = $svc_nos[0]->svc_number;
        DB::select('CALL SetWait("'.$request->token.'","'.$request->type.'","'.$svc_no.'","'.$request->floor_id.'")');
        return response()->json(['send'=>'send']);

    }
    public function TokenSentRecall(Request $request){

        $svc_nos = DB::select('CALL getServiceIdByName("'.$request->service_type.'")');
        $svc_no = $svc_nos[0]->svc_number;
        DB::select('CALL SetWait("'.$request->token.'","'.$request->type.'","'.$svc_no.'","'.$request->floor_id.'")');
        return response()->json(['send'=>'send']);

    }

    public function getAppListByWebfile(Request $request){

        $userId = Auth::user()->user_id;
        $webfile = $request->webfile;
        $webfileData = Tbl_appointmentlist::where('WebFile_no',$webfile)
                ->where('Presence_Status', 'PENDING')
                ->first();

        $checkBy = $request->checkBy;
        if($checkBy == 'web'){
            $SSL_check_By =  $request->webfile;
        }
        else{
            $SSL_check_By =  $request->checkBy;
        }

            if($webfileData != ''){
                $get_api = Tbl_setup::where('item_name', 'payment_api')->first();
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$get_api->item_value.'/?webfile='.$SSL_check_By.'&user='.$userId.'&save='.$request->save.'');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                $ssldata = curl_exec($ch);

                $sslArr = explode(',',$ssldata);
                $onlinePay = $sslArr[0];
                if($onlinePay == 'Yes'){
                    $paytype = ['<option value=""></option>\',<option value="Cash/Manual">Cash/Manual</option>','<option value="ONLINE" selected>ONLINE</option>','<option value="WAIVE">WAIVE</option>'];
                }
                else{
                    $paytype = ['<option value=""></option>\',<option value="Cash/Manual">Cash/Manual</option>','<option value="ONLINE">ONLINE</option>','<option value="WAIVE">WAIVE</option>'];
                }

            }
            else{
                $ssldata = ['','','','','',''];
                $paytype = [];
            }

        return response()->json(['webfileData'=>$webfileData,'sllData'=>$ssldata,'paytype'=>$paytype]);
    }

    public function ValidStickerCheck(Request $request){
        // $request->validStkr;
        $curDate = Date('Y-m-d');
        $StkCheck = Tbl_appointmentserved::whereDate('Service_Date',$curDate)
                            ->where('Sticker_type',$request->validStikerType)
                            ->where('RoundSticker', $request->validSticker)
                            ->get();
        if(count($StkCheck) > 0)
        {
            return response()->json(['validStatus'=>'No','stikerNum'=>$request->validSticker]);
        }
        else
        {
            return response()->json(['validStatus'=>'Yes']);
        }
    }

    public function getDataOnload(Request $request){
        $rejectCause = Tbl_rejectcause::all();
        $correctionFee = Tbl_correctionfee::select('Correction')->get();
        $corFee = Tbl_ivac_service::select('corrFee','Service')->where('Service','Regular Passport')->first();
        $userId = Auth::user()->user_id;
        $total_save = Tbl_appointmentserved::where('service_by',$userId)
            ->whereDate('Service_Date', Date('Y-m-d'))
            ->get();
        $total_save = Count($total_save);

        $rejectedData = Tbl_appointmentlist::where('Presence_Status','REJECTED')
            ->where('RejectBy',$userId)
            ->whereDate('RejectTime', Date('Y-m-d'))
            ->get();

        $rejectCount = count($rejectedData);

        return response()->json(['rejectCause'=>$rejectCause,'correctionFee'=>$correctionFee,'total_save'=>$total_save,'corFee'=>$corFee,'rejectCount'=>$rejectCount]);
    }
    public function getDataOnloadEditPass(){
        $correction = Tbl_correctionfee::select('Correction')->get();
        $corFee = Tbl_ivac_service::select('corrFee','Service')->where('Service','Regular Passport')->first();

        return response()->json(['correction'=>$correction, 'corFee'=>$corFee]);
    }




    public function readAtCenter(){
        return view('counter.readyat_center');
    }

    public function OnloadReadyatCenterData(Request $request){
        $user_id = Auth::user()->user_id;
        $curDate = Date('Y-m-d');


        $total_fail_data = Tbl_fail_ready_del::where('del_by',$user_id)
            ->where('DelRed','ReadyCenter')
            ->whereDate('del_time', $curDate)
            ->get();
        $total_fail_data = count($total_fail_data);

        $total_save = Tbl_appointmentserved::whereDate('ReadyCentertime', $curDate)
            ->where('ReadyCenterby',$user_id)
            ->get();
        $total_save = count($total_save);
        return response()->json(['total_fail'=>$total_fail_data,'total_save'=>$total_save]);
    }


    public function readAtCenterStoreData(Request $request){
        $datas = $request->all();
        $user_id = Auth::user()->user_id;
        $curDate = Date('Y-m-d H:i:s');
        $selDate = strtotime($datas['selected_date']);
        $selectedDate = Date('Y-m-d',$selDate);
        $arrTemp = [];
        $succArr = [];
        $rejectArr = [];



        foreach($request->passport as $index=>$row)
        {
            $arrTemp[$index]['passport'] = $datas['passport'][$index];
            $arrTemp[$index]['remark'] = $datas['remark'][$index];
        }



        foreach($arrTemp as $i=>$item)
        {
            $is_update = Tbl_appointmentserved::where('Passport',$item['passport'])->orderby('Service_Date','DESC')->take(1)->update([
                'ReadyCenterby' => $user_id,
                'ReadyCentertime' => $selectedDate,
                'status' => '2',
                'UpdateTime'=> $curDate,
            ]);
            if($is_update)
            {
                $succArr[$i]['password'] = $item['passport'];
                $succArr[$i]['remark'] = $item['remark'];
            }
            else
            {
                $rejectArr[$i]['passport'] = $item['passport'];
                $rejectArr[$i]['remark'] = $item['remark'];
            }
        }
        foreach ($rejectArr as $reItem){
            Tbl_fail_ready_del::create([
                    'passport' =>  $reItem['passport'],
                    'del_by' =>  $user_id,
                    'del_time' =>  $selectedDate,
                    'DelRed' => 'ReadyCenter',
                    'DelRemark' => $reItem['remark'],
                ]);
        }



        $total_fail_data = Tbl_fail_ready_del::where('del_by',$user_id)
            ->where('DelRed','ReadyCenter')
            ->whereDate('del_time', $curDate)
            ->get();
        $total_fail_data = count($total_fail_data);

        $total_save = Tbl_appointmentserved::whereDate('ReadyCentertime', $curDate)
                    ->where('ReadyCenterby',$user_id)
                    ->get();
        $total_save = count($total_save);
        $recent_saved = count($succArr);
        $recent_failed = count($rejectArr);

        return response()->json(['reject'=>$rejectArr,'total_save'=>$total_save,'total_fail'=>$total_fail_data,'rec_save'=>$recent_saved,'rec_fail'=>$recent_failed]);
    }


    public function DeliveryCenter(){
        return view('counter.delivery_center');
    }

    public function OnloadDeliveryCenter(Request $request){
        $user_id = Auth::user()->user_id;
        $curDate = Date('Y-m-d');

        $total_fail_data = Tbl_fail_ready_del::where('del_by',$user_id)
            ->where('DelRed','Delivery')
            ->whereDate('del_time', $curDate)
            ->get();
        $total_fail_data = count($total_fail_data);

        $total_save = Tbl_appointmentserved::whereDate('DelFinaltime', $curDate)
            ->where('DelFinalBy',$user_id)
            ->get();
        $total_save = count($total_save);
        return response()->json(['total_fail'=>$total_fail_data,'total_save'=>$total_save]);
    }

    public function deliveryCenterStoreData(Request $request){
        $datas = $request->all();
        $user_id = Auth::user()->user_id;
        $curDate = Date('Y-m-d H:i:s');
        $curTime = Date('H:i:s');
        $selDateR = $datas['selected_date'].$curTime;
        $selDate = strtotime($selDateR);
        $selectedDate = Date('Y-m-d',$selDate);
        $selectedDateTime = Date('Y-m-d H:i:s',$selDate);
        $arrTemp = [];
        $succArr = [];
        $rejectArr = [];



        foreach($request->passport as $index=>$row)
        {
            $arrTemp[$index]['passport'] = $datas['passport'][$index];
            $arrTemp[$index]['remark'] = $datas['remark'][$index];
        }



        foreach($arrTemp as $i=>$item)
        {
            $is_update = Tbl_appointmentserved::where('Passport',$item['passport'])->orderby('Service_Date','DESC')->take(1)->update([
                'DelFinalBy' => $user_id,
                'DelFinaltime' => $selectedDateTime,
                'DelRemark' => $item['remark'],
                'status' => '2'
            ]);
            if($is_update)
            {
                $succArr[$i]['password'] = $item['passport'];
                $succArr[$i]['remark'] = $item['remark'];
            }
            else
            {
                $rejectArr[$i]['passport'] = $item['passport'];
                $rejectArr[$i]['remark'] = $item['remark'];
            }
        }
        foreach ($rejectArr as $reItem){
            Tbl_fail_ready_del::create([
                'passport' =>  $reItem['passport'],
                'del_by' =>  $user_id,
                'del_time' =>  $selectedDateTime,
                'DelRed' => 'Delivery',
                'DelRemark' => $reItem['remark'],
            ]);
        }



        $total_fail_data = Tbl_fail_ready_del::where('del_by',$user_id)
            ->where('DelRed','Delivery')
            ->whereDate('del_time', $selectedDate)
            ->get();
        $total_fail_data = count($total_fail_data);

        $total_save = Tbl_appointmentserved::whereDate('DelFinaltime', $selectedDate)
            ->where('DelFinalBy',$user_id)
            ->get();
        $total_save = count($total_save);
        $recent_saved = count($succArr);
        $recent_failed = count($rejectArr);

        return response()->json(['reject'=>$rejectArr,'total_save'=>$total_save,'total_fail'=>$total_fail_data,'rec_save'=>$recent_saved,'rec_fail'=>$recent_failed]);
    }























    public function EditViewPassportReceive(){
        return view('counter.edit_pass_receive_center');

    }


    public function EditPassportReceive(Request $request){

        $wenfile_no = $request->webfile_no;
        $datas['readyEditData'] = $getData_App = Tbl_appointmentserved::where('WebFile_no',$wenfile_no)->first();
        $datas['visaTypeData'] = Tbl_visa_type::all();
        $datas['allUsers'] = User::all();
        $datas['allSticker'] = Tbl_sticker::all();
        $datas['allCenter'] = CenterInfo::all();


        return view('counter.edit_pass_receive_center', $datas);
    }
    public function getTddEditPassRec(Request $request){
        $visaType = Tbl_visa_type::select('tdd')->where('visa_type',$request->visa_type)->first();
        return response()->json(['visa_type'=>$visaType]);
    }

    public function EditPassportReceiveUpdate(Request $request){


        $curDateTime = Date('Y-m-d H:i:s');
        $userId = Auth::user()->user_id;
        $oldData = Tbl_appointmentserved::where('WebFile_no',$request->WebFile_no)->first();
        // return $oldData;

        $chengArr = [];
        if($oldData->Applicant_name != $request->Applicant_name){
            array_push($chengArr, $oldData->Applicant_name);
        }
        if($oldData->Visa_type != $request->Visa_type){
            array_push($chengArr, $oldData->Visa_type);
        }
        if($oldData->Contact != $request->Contact){
            array_push($chengArr, $oldData->Contact);
        }
        if($oldData->OldPassQty != $request->OldPassQty){
            array_push($chengArr, $oldData->OldPassQty);
        }
        if($oldData->Sticker_type != $request->Sticker_type){
            array_push($chengArr, $oldData->Sticker_type);
        }
        if($oldData->RoundSticker != $request->RoundSticker){
            array_push($chengArr, $oldData->RoundSticker);
        }

        $chengArrF = implode($chengArr,',');


        Tbl_del_operation::create([
            'webfile'=>$oldData->WebFile_no,
            'old_data'=>$chengArrF,
            'action_by'=>$userId,
            'action_time'=>$curDateTime,
            'remark'=>'Receive/Edit',
            'service_type'=>'Regular Passport',
        ]);

        $app_serve = Tbl_appointmentserved::where('WebFile_no','=',$request->WebFile_no)->update([
            'Applicant_name'=> $request->Applicant_name,
            'WebFile_no'=> $request->WebFile_no,
            'Passport'=> $request->Passport,
            'Visa_type'=> $request->Visa_type,
            'Sticker_type'=> $request->Sticker_type,
            'RoundSticker'=> $request->RoundSticker,
            'OldPassQty'=> $request->OldPassQty,
            'appx_Del_Date'=> $request->appx_Del_Date,
            'status'=> '1',
            'UpdateTime'=>$curDateTime
        ]);

        if($app_serve){



            return redirect('/edit-receive-passport')->with(['message'=>'Data Update Successfully','msgType'=>'alert-info']);
        }
        else{
            return redirect('/edit-receive-passport')->with(['message'=>'Data Could not Update','msgType'=>'alert-warning']);
        }
    }

    public function EditPassportReceiveDestroy($webNo){
        $userId = Auth::user()->user_id;
        $curDateTime = Date('Y-m-d H:i:s');
        Tbl_del_operation::create([
            'webfile'=>$webNo,
            'old_data'=>$webNo,
            'action_by'=>$userId,
            'action_time'=>$curDateTime,
            'remark'=>'Receive/Delete',
            'service_type'=>'Regular Passport',
        ]);

        $is_delete = Tbl_appointmentserved::where('WebFile_no','=',$webNo)->delete();

        if($is_delete){
            Tbl_appointmentlist::where('WebFile_no',$webNo)->update(['Presence_Status'=>'PENDING']);
            return redirect('/edit-receive-passport')->with(['message'=>'Data Deleted Successfully','msgType'=>'alert-info']);
        }
        else{
            return redirect('/edit-receive-passport')->with(['message'=>'Data Couldn\'t Deleted','msgType'=>'alert-warning']);
        }
    }






    public function EditViewReadyCenter(){
        return view('counter.edit_readyat_center');
    }
    public function EditReadyCenter(Request $request){
        $passportNo = $request->PassportNo;
        $passDate = strtotime($request->passDate);
        $passDate = Date('Y-m-d',$passDate);

        $readyData = Tbl_appointmentserved::where('Passport',$passportNo)
            ->whereDate('ReadyCenterTime', $passDate)
            ->whereNotNull('ReadyCenterby')
            ->orderby('Service_Date', 'DESC')
            ->first();
        if($readyData){
            $datas['readyEditData'] = $readyData;
        }
        else{
            $datas['status'] = 'No Data Found';
        }


        return view('counter.edit_readyat_center',$datas);
    }


    public function EditReadyCenterDestroy($webfile){

        $userId = Auth::user()->user_id;
        $curDateTime = Date('Y-m-d H:i:s');
        $oldData = Tbl_appointmentserved::where('WebFile_no',$webfile)->first();
        Tbl_del_operation::create([
            'webfile'=>$webfile,
            'old_data'=>$oldData->ReadyCentertime.','.$oldData->ReadyCenterby,
            'action_by'=>$userId,
            'action_time'=>$curDateTime,
            'remark'=>'ReadyCenter',
            'service_type'=>'Regular Passport',
        ]);

        $is_delete = Tbl_appointmentserved::where('WebFile_no','=',$webfile)->update([
            'ReadyCenterby'=>null,
            'ReadyCentertime'=>null,
            'UpdateTime'=>Date('Y-m-d H:i:s'),
            'status'=>'2',
        ]);

        if($is_delete){
            return redirect('/ready-at-center-edit')->with(['message'=>'Data Delete Successfully','msgType'=>'alert-info']);
        }
        else{
            return redirect('/ready-at-center-edit')->with(['message'=>'Data Could not Delete','msgType'=>'alert-warning']);
        }
    }





    public function EditViewDeliveryCenter(){
        return view('counter.edit_delivery_center');
    }
    public function EditDeliveryCenter(Request $request){
        $passportNo = $request->PassportNo;
        $passDate = strtotime($request->passDate);
        $passDate = Date('Y-m-d',$passDate);
        $DelData = Tbl_appointmentserved::where('Passport',$passportNo)
            ->whereDate('DelFinaltime', $passDate)
            ->whereNotNull('DelFinalBy')
            ->orderby('Service_Date', 'DESC')
            ->first();



        if($DelData){
            $datas['readyEditData'] = $DelData;

        }
        else{
            $datas['status'] = 'No Data Found';
        }

        return view('counter.edit_delivery_center',$datas);
    }

//    public function EditDeliveryCenterUpdate(Request $request){
////        $id = $request->WebFile_no;
//        $is_update = Tbl_appointmentserved::where('WebFile_no','=',$request->webfile)->update([
//            'DelFinalby'=>$request->DelFinalBy,
//            'DelFinaltime'=>Date('Y-m-d', strtotime($request->DelFinaltime))
//        ]);
//
//        if($is_update){
//            return redirect('/edit-delivery-center')->with(['message'=>'Data Update Successfully','msgType'=>'alert-info']);
//        }
//        else{
//            return redirect('/edit-delivery-center')->with(['message'=>'Data Could not Update','msgType'=>'alert-warning']);
//        }
//
//    }

    public function EditDeliveryCenterDestroy($webfile){
        $userId = Auth::user()->user_id;
        $curDateTime = Date('Y-m-d H:i:s');
        $oldData = Tbl_appointmentserved::where('WebFile_no',$webfile)->first();
        Tbl_del_operation::create([
            'webfile'=>$webfile,
            'old_data'=>$oldData->DelFinaltime.','.$oldData->DelFinalBy,
            'action_by'=>$userId,
            'action_time'=>$curDateTime,
            'remark'=>'DeliveryCenter',
            'service_type'=>'Regular Passport',
        ]);
        $is_delete = Tbl_appointmentserved::where('WebFile_no','=',$webfile)->update([
            'DelFinalby'=>null,
            'DelFinaltime'=>null,
            'UpdateTime'=>Date('Y-m-d H:i:s'),
            'status'=>'2',
        ]);

        if($is_delete){
            return redirect('/edit-delivery-center')->with(['message'=>'Data Delete Successfully','msgType'=>'alert-info']);
        }
        else{
            return redirect('/edit-delivery-center')->with(['message'=>'Data Couldn\'t Delete','msgType'=>'alert-warning']);
        }
    }













    public function PassReceiveSummReport(Request $request){
        return view('counter.pass_receive_summ_report');
    }

    public function GetPassReceiveSummReport(Request $request){
        $from = strtotime($request->from_date);
        $to = strtotime($request->to_date);
        $fromDate = Date('Y-m-d 00:00:00',$from);
        $toDate = Date('Y-m-d 23:59:59',$to);
        $user_id = Auth::user()->user_id;

        $datas['getData_list'] = DB::table('tbl_appointmentserved')
                ->whereBetween('Service_Date',[$fromDate,$toDate])
                ->where('service_by', $user_id)
                ->select([DB::raw('count(WebFile_no) as webfile_count'), DB::raw('DATE(Service_Date) as date_count')])
                ->groupBy('date_count')
                ->orderBy('date_count')
                ->get();

        $datas['fromDate'] = $request->from_date;
        $datas['toDate'] = $request->to_date;


        return view('counter.pass_receive_summ_report',$datas);
    }

    public function PassReceiveDetailsReport(Request $request){
        return view('counter.pass_receive_details_report');
    }

    public function GetPassReceiveDetailsReport(Request $request){
        $user_id = Auth::user()->user_id;
        $from = strtotime($request->from_date);
        $to = strtotime($request->to_date);
        $fromDate = Date('Y-m-d 00:00:00',$from);
        $toDate = Date('Y-m-d 23:59:59',$to);

        $datas['getData_list'] = Tbl_appointmentserved::whereBetween('Service_Date',[$fromDate,$toDate])
                ->where('service_by', $user_id)
                ->orderBy('Service_Date')
                ->get();
        $datas['fromDate'] = $request->from_date;
        $datas['toDate'] = $request->to_date;


        return view('counter.pass_receive_details_report',$datas);
    }






    public function ReadyCenterSummReport(Request $request){
        return view('counter.readyat_center_summ_report');
    }

    public function GetReadyCenterSummReport(Request $request){
        $user_id = Auth::user()->user_id;
        $from = strtotime($request->from_date);
        $to = strtotime($request->to_date);
        $fromDate = Date('Y-m-d 00:00:00',$from);
        $toDate = Date('Y-m-d 23:59:59',$to);

        $datas['getData_list'] = DB::table('tbl_appointmentserved')
                ->whereNotNull('ReadyCenterby')
                ->where('ReadyCenterby', $user_id)
                ->whereBetween('ReadyCentertime',[$fromDate,$toDate])
                ->select([DB::raw('count(WebFile_no) as webfile_count'), DB::raw('DATE(ReadyCentertime) as date_count')])
                ->groupBy('date_count')
                ->orderBy('date_count')
                ->get();

        $datas['getDelData_list'] = DB::table('tbl_fail_ready_del')
                ->where('del_by', $user_id)
                ->where('DelRed', 'ReadyCenter')
                ->whereBetween('del_time',[$fromDate,$toDate])
                ->select([DB::raw('count(id) as id_count'), DB::raw('DATE(del_time) as del_date_count')])
                ->groupBy('del_date_count')
                ->orderBy('del_time')
                ->get();

        $datas['fromDate'] = $request->from_date;
        $datas['toDate'] = $request->to_date;


        return view('counter.readyat_center_summ_report',$datas);
    }




    public function ReadyCenterDetailsReport(Request $request){
        return view('counter.readyat_center_details_report');
    }

    public function GetReadyCenterDetailsReport(Request $request){
        $user_id = Auth::user()->user_id;
        $from = strtotime($request->from_date);
        $to = strtotime($request->to_date);
        $fromDate = Date('Y-m-d 00:00:00',$from);
        $toDate = Date('Y-m-d 23:59:59',$to);

        $datas['getData_list'] = DB::table('tbl_appointmentserved')
                ->whereNotNull('ReadyCenterby')
                ->where('ReadyCenterby',$user_id)
                ->whereBetween('ReadyCentertime',[$fromDate,$toDate])
                ->orderBy('ReadyCentertime')
                ->get();

        $datas['fromDate'] = $request->from_date;
        $datas['toDate'] = $request->to_date;


        return view('counter.readyat_center_details_report',$datas);
    }




    public function ReadyCenterFailedDetailsReport(Request $request){
        return view('counter.readyat_center_failed_details_report');
    }

    public function GetReadyCenterFailedDetailsReport(Request $request){
        $user_id = Auth::user()->user_id;
        $from = strtotime($request->from_date);
        $to = strtotime($request->to_date);
        $fromDate = Date('Y-m-d 00:00:00',$from);
        $toDate = Date('Y-m-d 23:59:59',$to);

        $datas['getData_list'] = DB::table('tbl_fail_ready_del')
            ->where('DelRed','ReadyCenter')
            ->where('del_by',$user_id)
            ->whereBetween('del_time',[$fromDate,$toDate])
            ->orderBy('del_time')
            ->get();

        $datas['fromDate'] = $request->from_date;
        $datas['toDate'] = $request->to_date;


        return view('counter.readyat_center_failed_details_report',$datas);
    }








    public function DeliveryCenterSummReport(Request $request){
        return view('counter.delivery_center_summ_report');
    }

    public function GetDeliveryCenterSummReport(Request $request){
        $user_id = Auth::user()->user_id;
        $from = strtotime($request->from_date);
        $to = strtotime($request->to_date);
        $fromDate = Date('Y-m-d 00:00:00',$from);
        $toDate = Date('Y-m-d 23:59:59',$to);

        $datas['getData_list'] = DB::table('tbl_appointmentserved')
                ->whereNotNull('DelFinalBy')
                ->where('DelFinalBy',$user_id)
                ->whereBetween('DelFinaltime',[$fromDate,$toDate])
                ->select([DB::raw('count(WebFile_no) as webfile_count'), DB::raw('DATE(DelFinaltime) as date_count')])
                ->groupBy('date_count')
                ->orderBy('date_count')
                ->get();

        $datas['getDelData_list'] = DB::table('tbl_fail_ready_del')
            ->where('del_by', $user_id)
            ->where('DelRed', 'Delivery')
            ->whereBetween('del_time',[$fromDate,$toDate])
            ->select([DB::raw('count(id) as id_count'), DB::raw('DATE(del_time) as del_date_count')])
            ->groupBy('del_date_count')
            ->orderBy('del_time')
            ->get();

        $datas['fromDate'] = $request->from_date;
        $datas['toDate'] = $request->to_date;


        return view('counter.delivery_center_summ_report',$datas);
    }


    public function DeliveryCenterDetailsReport(Request $request){
        return view('counter.delivery_center_details_report');
    }

    public function GetDeliveryCenterDetailsReport(Request $request){
        $user_id = Auth::user()->user_id;
        $from = strtotime($request->from_date);
        $to = strtotime($request->to_date);
        $fromDate = Date('Y-m-d 00:00:00',$from);
        $toDate = Date('Y-m-d 23:59:59',$to);

        $datas['getData_list'] = DB::table('tbl_appointmentserved')
                ->whereNotNull('DelFinalBy')
                ->where('DelFinalBy',$user_id)
                ->whereBetween('DelFinaltime',[$fromDate,$toDate])
                ->orderBy('DelFinaltime')
                ->get();

        $datas['fromDate'] = $request->from_date;
        $datas['toDate'] = $request->to_date;


        return view('counter.delivery_center_details_report',$datas);
    }



    public function DeliveryCenterFailedDetailsReport(Request $request){
        return view('counter.delivery_center_failed_details_report');
    }

    public function GetDeliveryCenterFailedDetailsReport(Request $request){
        $user_id = Auth::user()->user_id;
        $from = strtotime($request->from_date);
        $to = strtotime($request->to_date);
        $fromDate = Date('Y-m-d 00:00:00',$from);
        $toDate = Date('Y-m-d 23:59:59',$to);

        $datas['getData_list'] = DB::table('tbl_fail_ready_del')
            ->where('DelRed','Delivery')
            ->where('del_by',$user_id)
            ->whereBetween('del_time',[$fromDate,$toDate])
            ->orderBy('del_time')
            ->get();

        $datas['fromDate'] = $request->from_date;
        $datas['toDate'] = $request->to_date;


        return view('counter.delivery_center_failed_details_report',$datas);
    }



    //// BRTC ///

    public function CounterReceiveDetailsReport(){
      $user_id = Auth::user()->user_id;
      $center_type = Auth::user()->center_type;
      $allUsers =  User::select('user_id','id','name','center_type')->get();
      $allUserArr = [];
      foreach($allUsers as $i=>$user){
          if($user_id == 'Admin'){
              array_push($allUserArr,$user->user_id);
          }
          else{
              if($user->user_id != 'Admin'){
                    if($center_type == 'HQ'){
                        array_push($allUserArr,$user->user_id);
                    }
                    else{
                        if($user->center_type != 'HQ'){
                            if($user->user_id  == $user_id){
                                array_push($allUserArr,$user->user_id);
                            }
                        }
                    }
              }
          }
      }
        //return $allUserArr;
      $data['allUserArr'] = $allUserArr;
      $data['allServices'] = Tbl_service::select('id','svc_name','svc_number')->get();
      return view('counter.report.receive_details_report',$data);
    }

    public function CounterReceiveDetailsReportView(Request $request){
      $fromDate = Date('Y-m-d 00:00:00', strtotime($request->from_date));
      $data['toDate'] = $toDate = Date('Y-m-d 23:59:59', strtotime($request->to_date));
      $user_id = $request->user_id;
      $service = $request->service;
      if($user_id == 'all' && $service == 'all'){
        $data['service_logs'] = $service_logs = Tbl_service_log::whereBetween('tissuetime',[$fromDate,$toDate])->get();
        $avgData = collect($service_logs);
        $data['avg'] = $avgData->avg('waiting');
        $data['min'] = $avgData->min('waiting');
        $data['max'] = $avgData->max('waiting');

        $data['avg_s'] = $avgData->avg('service');
        $data['min_s'] = $avgData->min('service');
        $data['max_s'] = $avgData->max('service');
      }
      else if($user_id != 'all' && $service == 'all'){
        $data['service_logs'] = $service_logs = Tbl_service_log::whereBetween('tissuetime',[$fromDate,$toDate])->where('servedby',$user_id)->get();
        $avgData = collect($service_logs);
        $data['avg'] = $avgData->avg('waiting');
        $data['min'] = $avgData->min('waiting');
        $data['max'] = $avgData->max('waiting');

        $data['avg_s'] = $avgData->avg('service');
        $data['min_s'] = $avgData->min('service');
        $data['max_s'] = $avgData->max('service');
      }
      else if($user_id == 'all' && $service != 'all'){
        $data['service_logs'] = $service_logs = Tbl_service_log::whereBetween('tissuetime',[$fromDate,$toDate])->where('servicetype',$service)->get();
        $avgData = collect($service_logs);
        $data['avg'] = $avgData->avg('waiting');
        $data['min'] = $avgData->min('waiting');
        $data['max'] = $avgData->max('waiting');

        $data['avg_s'] = $avgData->avg('service');
        $data['min_s'] = $avgData->min('service');
        $data['max_s'] = $avgData->max('service');
      }
      else{
        $data['service_logs'] = $service_logs = Tbl_service_log::whereBetween('tissuetime',[$fromDate,$toDate])->where('servedby',$user_id)->where('servicetype',$service)->get();
        $avgData = collect($service_logs);
        $data['avg'] = $avgData->avg('waiting');
        $data['min'] = $avgData->min('waiting');
        $data['max'] = $avgData->max('waiting');

        $data['avg_s'] = $avgData->avg('service');
        $data['min_s'] = $avgData->min('service');
        $data['max_s'] = $avgData->max('service');
      }

      $data['fromDate'] = $request->from_date;
      $data['toDate'] = $request->to_date;
      //return $request->all();
      return view('counter.report.receive_details_report',$data);
    }

    public function CounterReceiveSummaryReport(){
      $user_id = Auth::user()->user_id;
      $center_type = Auth::user()->center_type;
      $allUsers =  User::select('user_id','id','name','center_type')->get();
      $allUserArr = [];
      foreach($allUsers as $i=>$user){
          if($user_id == 'Admin'){
              array_push($allUserArr,$user->user_id);
          }
          else{
              if($user->user_id != 'Admin'){
                    if($center_type == 'HQ'){
                        array_push($allUserArr,$user->user_id);
                    }
                    else{
                        if($user->center_type != 'HQ'){
                            if($user->user_id  == $user_id){
                                array_push($allUserArr,$user->user_id);
                            }
                        }
                    }
              }
          }
      }
        //return $allUserArr;
        $data['allUserArr'] = $allUserArr;
      $data['allServices'] = Tbl_service::select('id','svc_name','svc_number')->get();
      return view('counter.report.receive_summary_report',$data);
    }

    public function CounterReceiveSumaryReportView(Request $request){
      $fromDate = Date('Y-m-d 00:00:00', strtotime($request->from_date));
      $data['toDate'] = $toDate = Date('Y-m-d 23:59:59', strtotime($request->to_date));
      $type = $request->type;

      if($type == '1'){
        $data['service_logs'] = $service_logs = Tbl_service_log::whereBetween('tissuetime',[$fromDate,$toDate])->get();
        $collectData = collect($service_logs);
        $servedby = $collectData->groupBy('servedby');
          $user_id = Auth::user()->user_id;
          $center_type = Auth::user()->center_type;
          $allUsers =  User::select('user_id','id','name','center_type')->get();
          $allUserArr = [];
          foreach($allUsers as $i=>$user){
              if($user_id == 'Admin'){
                  array_push($allUserArr,$user->user_id);
              }
              else{
                  if($user->user_id != 'Admin'){
                        if($center_type == 'HQ'){
                            array_push($allUserArr,$user->user_id);
                        }
                        else{
                            if($user->center_type != 'HQ'){
                                if($user->user_id  == $user_id){
                                    array_push($allUserArr,$user->user_id);
                                }
                            }
                        }
                  }
              }
          }

          $allUser = $allUserArr;

        $UserArr = [];
        foreach ($allUser as $i=> $itemU) {
          $st_c = $collectData->where('servedby',$itemU)->count();
          $UserArr[$i]['u_c'] = $st_c;
          $UserArr[$i]['servedby'] = $itemU;
        }
        $data['UserArr'] = $UserArr;
        $data['fromDate'] = $request->from_date;
        $data['toDate'] = $request->to_date;
        $data['reportType'] = 'Users';
        return view('counter.report.receive_summary_report',$data);
      }
      if($type == '2'){
        $user_id = Auth::user()->user_id;
        $center_type = Auth::user()->center_type;
        if($center_type == 'HQ' || $center_type == 'Admin'){
            $data['wiseMsg'] = 'All';
        }
        else{
            $data['wiseMsg'] = $user_id ;
        }
        if($user_id == 'Admin' || $center_type == 'HQ'){
            $data['service_logs'] = $service_logs = Tbl_service_log::whereBetween('tissuetime',[$fromDate,$toDate])->get();
        }
        else{
            $data['service_logs'] = $service_logs = Tbl_service_log::whereBetween('tissuetime',[$fromDate,$toDate])
                                            ->where('servedby',$user_id)
                                            ->get();

        }
        $collectData = collect($service_logs);
        $serviceItem = Tbl_service::all();

        $serviceTypeArr = [];
        foreach ($serviceItem as $i=> $item){
          $st_c = $collectData->where('servicetype',$item->svc_name)->where('ststart','<>','')->count();
          $serviceTypeArr[$i]['st_c'] = $st_c;
          $serviceTypeArr[$i]['servicetype'] = $item->svc_name;
        }
        $data['serviceTypeArr'] = $serviceTypeArr;
        $data['fromDate'] = $request->from_date;
        $data['toDate'] = $request->to_date;
        $data['reportType'] = 'Service';
        return view('counter.report.receive_summary_report',$data);
      }
      if($type == '3'){
        $data['service_logs'] = $service_logs = Tbl_service_log::whereBetween('tissuetime',[$fromDate,$toDate])->get();
        $collectData = collect($service_logs);
        $serviceItem = Tbl_service::all();

        $serviceTypeArr = [];
        foreach ($serviceItem as $i=> $item){
          $st_c = $collectData->where('servicetype',$item->svc_name)->count();
          $serviceTypeArr[$i]['st_c'] = $st_c;
          $serviceTypeArr[$i]['servicetype'] = $item->svc_name;
        }
        $data['serviceTypeArr'] = $serviceTypeArr;
        $data['fromDate'] = $request->from_date;
        $data['toDate'] = $request->to_date;
        $data['reportType'] = 'Services';
        return view('counter.report.receive_summary_report',$data);
      }
    }

    public function CounterUserWiseSummaryReport(){
      $user_id = Auth::user()->user_id;
      $center_type = Auth::user()->center_type;
      $allUsers =  User::select('user_id','id','name','center_type')->get();
      $allUserArr = [];
      foreach($allUsers as $i=>$user){
          if($user_id == 'Admin'){
              array_push($allUserArr,$user->user_id);
          }
          else{
              if($user->user_id != 'Admin'){
                    if($center_type == 'HQ'){
                        array_push($allUserArr,$user->user_id);
                    }
                    else{
                        if($user->center_type != 'HQ'){
                            if($user->user_id  == $user_id){
                                array_push($allUserArr,$user->user_id);
                            }
                        }
                    }
              }
          }
      }
        //return $allUserArr;
        $data['allUserArr'] = $allUserArr;
      return view('counter.report.receive_userwise_summary_report',$data);
    }

    public function CounterUserWiseSumaryReportView(Request $request){
      $fromDate = Date('Y-m-d 00:00:00', strtotime($request->from_date));
      $toDate = Date('Y-m-d 23:59:59', strtotime($request->to_date));
      $data['user_id'] = $user_id = $request->user_id;
      $data['userWiseData'] = Tbl_service_log::select('tissuetime')->whereBetween('tissuetime',[$fromDate,$toDate])
                                ->where('servedby',$user_id)
                                ->groupBy(DB::raw('Date(tissuetime)'))
                                ->get();

      $data['fromDate'] = Date('Y-m-d', strtotime($request->from_date));
      $data['toDate'] = Date('Y-m-d', strtotime($request->to_date));
      return view('counter.report.receive_userwise_summary_report',$data);

    }

    public function PlayTokenAgain(Request $request){
      //$request
      $svc_name_data = $request->svc_name;
      $svc_nos = DB::select('CALL getServiceIdByName("'.$svc_name_data.'")');
      $svc_no = $svc_nos[0]->svc_number;


      DB::table('play_queue')->insert([
        'floor'=>$request->floor_id,
        'token_number'=>$request->token,
        'token_counter'=>$request->counter_id,
        'svc'=>$svc_no,
      ]);
    }



}
