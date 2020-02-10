<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tbl_setup;
use App\Tbl_center_info;
use App\Tbl_service;
use App\Tbl_floor;
use App\FloorTokenQueue;
use App\FloorTokenHistory;
use App\Tbl_counter;
use App\Tbl_callCounter;
use App\Tbl_service_log;
use Session;
use Auth;
use DB;

class ManageSettingController extends Controller
{
    public function centerSetupCreate(){
      $centerDataArr = Tbl_setup::all();
      foreach ($centerDataArr as $item)
      {
        if($item->item_name == 'ServerName')
        {
          $data['serverName'] = $item->item_value;
        }

        if($item->item_name == 'Comport')
        {
          $data['Comport'] = $item->item_value;
        }

        if($item->item_name == 'DBQT')
        {
          $data['dbqt'] = $item->item_value;
        }

        if($item->item_name == 'CenterName')
        {
          $data['centerName'] = $item->item_value;
        }

        if($item->item_name == 'BackupMIN')
        {
          $data['BackupMIN'] = $item->item_value;
        }

        if($item->item_name == 'UploadMIN')
        {
          $data['UploadMIN'] = $item->item_value;
        }

        if($item->item_name == 'Barcode')
        {
          $data['Barcode'] = $item->item_value;
        }

        if($item->item_name == 'payment_api')
        {
          $data['payment_api'] = $item->item_value;
        }

        if($item->item_name == 'debug')
        {
          $data['debug'] = $item->item_value;
        }
        if($item->item_name == 'audio_floor')
        {
          $data['audio_floor'] = $item->item_value;
        }
        if($item->item_name == 'UploadSize')
        {
          $data['UploadSize'] = $item->item_value;
        }



      }

      $data['centerAll'] = Tbl_center_info::all();

      return view('master_setting.center_setup.center_setup', $data);
    }

    public function centerSetupUpdate(Request $request){

        $setupData = Tbl_setup::all();
        foreach ($setupData as $value) {
          foreach ($request->all() as  $index=>$item) {
            if($value->item_name == $index){
              $data = Tbl_setup::where('sl',$value->sl)->where('item_name', $value->item_name)->update([
                "item_value"=>$item
              ]);
            }
          }
        }

        return redirect()->back()->with(['statusMsg'=>'Data Update Successfully']);
    }


    public function queueSetupCreate(){
      $data['allServices'] = Tbl_service::all();
      return view('master_setting.queue_setup.queue_setup', $data);
    }

  public function queueSetupStore(Request $request)
  {
    $if_exist = Tbl_service::where('svc_number',$request->svc_number)->count();
    if($if_exist){
        return redirect()->back()->with(['msg'=>'This Service Number Aleady Exist','status'=>'warning']);
    }
    else{
      $curDateTime = Date('Y-m-d H:i:s');
      $user_id = Auth::user()->user_id;
      $is_save = Tbl_service::create([
        'svc_number'=>$request->svc_number,
        'svc_name'=> $request->svc_name,
        'entrydate'=>$curDateTime,
        'entryby'=>$user_id,
        'qty'=>$request->token_qty,
        'defCon'=>$request->default_qty,
        'status'=>$request->active_status,
      ]);

      if($is_save){
        return redirect()->back()->with(['msg'=>'Data Inserted Successfully','status'=>'success']);
      }
      else{
        return redirect()->back()->with(['msg'=>'Data Couldn\'t Insert','status'=>'danger']);
      }
    }
  }

  public function queueSetupEdit($id){
    $ServiceData = Tbl_service::find($id);
    //return $ServiceData;
    if($ServiceData){
      return view('master_setting.queue_setup.queue_setup_edit',compact('ServiceData'));
    }
    else{
      return redirect()->back()->with(['msg'=>'Data Couldn\'t Found','status'=>'warning']);
    }
  }
  public function queueSetupUpdate(Request $request){
    $id = $request->update_id;
    $user_id = Auth::user()->user_id;
    $is_update = Tbl_service::find($id)->update([
      'svc_number'=>$request->svc_number,
      'svc_name'=> $request->svc_name,
      'entryby'=>$user_id,
      'qty'=>$request->token_qty,
      'defCon'=>$request->default_qty,
      'status'=>$request->active_status,
    ]);
    if($is_update){
      return redirect('/setting/queue-setup/create')->with(['msg'=>'Data Updated Successfully','status'=>'success']);
    }
    else{
      return redirect('/setting/queue-setup/create')->back()->with(['msg'=>'Data Couldn\'t Update','status'=>'danger']);
    }
  }
  public function queueSetupDestroy($id){
    $is_delete = Tbl_service::find($id)->delete();
    if($is_delete){
      return redirect('/setting/queue-setup/create')->with(['msg'=>'Data Updated Successfully','status'=>'success']);
    }
    else{
      return redirect('/setting/queue-setup/create')->back()->with(['msg'=>'Data Couldn\'t Update','status'=>'danger']);
    }
  }


///// ADMIN OPERATION /////


  public function manageQueue(){
    $allFloor = Tbl_floor::all();
    $allService = Tbl_service::all();
    return view('admin_operation.manage_queue',compact(['allFloor','allService']));
  }
  public function deletePendingToken(Request $request){
       $curDate = Date('Y-m-d');
       $pendinToken = FloorTokenQueue::whereDate('token_date',$curDate)
           ->where('token_service_no',$request->service_id)
           ->where('floor_id',$request->floor_id)
           ->delete();
       if($pendinToken){
         return response()->json(['msg'=>'Data Deleted Successfully','status'=>'yes']);
       }
       else{
           $data_C = FloorTokenQueue::whereDate('token_date',$curDate)
               ->where('token_service_no',$request->service_id)
               ->where('floor_id',$request->floor_id)
               ->count();
           if($data_C > 0){
               return response()->json(['msg'=>'Data Couldn\'t Delete','status'=>'no']);
           }
           else{
               return response()->json(['msg'=>'Data Not Found','status'=>'notFound']);
           }
       }


  }

  public function deleteHistoryToken(Request $request){
       $curDate = Date('Y-m-d');
       $pendinToken = FloorTokenHistory::whereDate('token_date',$curDate)
           ->where('token_svc',$request->service_id)
           ->where('floor_id',$request->floor_id)
           ->delete();
       if($pendinToken){
         return response()->json(['msg'=>'Data Deleted Successfully','status'=>'yes']);
       }
       else{
           $data_C = FloorTokenHistory::whereDate('token_date',$curDate)
               ->where('token_svc',$request->service_id)
               ->where('floor_id',$request->floor_id)
               ->count();
           if($data_C > 0){
               return response()->json(['msg'=>'Data Couldn\'t Delete','status'=>'no']);
           }
           else{
               return response()->json(['msg'=>'Data Not Found','status'=>'notFound']);
           }
       }


  }

  public function SetIssueToken(Request $request){
       $curDate = Date('Y-m-d');
       $curDateTime = Date('Y-m-d H:i:s');
       $pendinToken = FloorTokenHistory::whereDate('token_date',$curDate)
           ->where('token_svc',$request->service_id)
           ->where('floor_id',1)
           ->delete();
      $history = new FloorTokenHistory;
      $history->token_svc = $request->service_id;
      $history->floor_id = 1;
      $history->token = $request->issue_token_id;
      $history->token_date = $curDateTime;
      $history->token_type = '1';
      $is_save = $history->save();

       if($is_save){
         return response()->json(['msg'=>'Data Set Successfully','status'=>'yes']);
       }
       else{
           return response()->json(['msg'=>'Data Couldn\'t Set','status'=>'no']);
       }

  }

  public function CreateTokenNumber(Request $request){
      $create_token_id = $request->create_token_id;
      $service_id = $request->service_id;

      for ($i = 1;$i <= $create_token_id; $i++){
          DB::select('CALL IssueTokenWaitF("'.$service_id.'","1")');
      }


      return response()->json(['msg'=>'Token Create Successfully','status'=>'yes']);

  }


    public function counterSetupCreate(){
      $data['allCounter'] = Tbl_counter::all();
      $data['allFloor'] = Tbl_floor::all();
      $data['allService'] = Tbl_service::all();
      return view('master_setting.counter_setup.counter_setup', $data);
    }

  public function counterSetupStore(Request $r)
  {
      $user_id = Auth::user()->user_id;
      $service_name = implode($r->service_name,',');

     $if_exist = Tbl_counter::where('counter_no',$r->counter_no)->where('floor_id',$r->floor_no)->count();

     if($if_exist < 1){
        $is_save = Tbl_counter::create([
            'hostname'=>$r->host_name,
            'counter_no'=>$r->counter_no,
            'ip'=>$r->counter_ip,
            'floor_id'=>$r->floor_no,
            'entryby'=>$user_id,
            'permission'=>$user_id,
            'svc_name'=>$service_name,
        ]);
        

          if($is_save){
            return redirect()->back()->with(['msg'=>'Data Inserted Successfully','status'=>'success']);
          }
          else{
            return redirect()->back()->with(['msg'=>'Data Couldn\'t Insert','status'=>'danger']);
          }
     }
     else{
      return redirect()->back()->with(['msg'=>'This Counter No Already Exist','status'=>'danger']);
     }
   
  }

  public function counterSetupEdit($id){
    $data['allFloor'] = Tbl_floor::all();
    $data['allService'] = Tbl_service::all();
    $data['CounterData'] = $CounterData = Tbl_counter::find($id);
    
    $data['oldSvc'] = explode(',',$CounterData->svc_name);

    if($CounterData){
      return view('master_setting.counter_setup.counter_setup_edit',$data);
    }
    else{
      return redirect()->with(['msg'=>'Data Couldn\'t Found','status'=>'warning']);
    }
  }

  public function counterSetupUpdate(Request $r){
      $user_id = Auth::user()->user_id;
      $service_name = implode($r->service_name,',');

      $is_update = Tbl_counter::find($r->update_id)->update([
          'hostname'=>$r->host_name,
            'counter_no'=>$r->counter_no,
            'ip'=>$r->counter_ip,
            'floor_id'=>$r->floor_no,
            'entryby'=>$user_id,
            'permission'=>$user_id,
            'svc_name'=>$service_name,
      ]);

      if($is_update){
        return redirect('/setting/counter-setup/create')->with(['msg'=>'Data Updated Successfully','status'=>'success']);
      }
      else{
        return redirect('/setting/counter-setup/create')->with(['msg'=>'Data Couldn\'t Update','status'=>'danger']);
      }


  }
  public function counterSetupDestroy($id){
    $is_delete = Tbl_counter::find($id)->delete();
    if($is_delete){
      return redirect('/setting/counter-setup/create')->with(['msg'=>'Data Updated Successfully','status'=>'success']);
    }
    else{
      return redirect('/setting/counter-setup/create')->with(['msg'=>'Data Couldn\'t Update','status'=>'danger']);
    }
  }


  public function queueStatus(){
    $allService = Tbl_service::all();
    $activeToken = Tbl_callCounter::all();
    return view('admin_operation.queue_status',compact('allService','activeToken'));
  }
  public function searchTokenInfo(Request $r){
    $token_info = Tbl_service_log::whereDate('tissuetime',Date('Y-m-d'))->where('tokenno',$r->token_no)->get();
    if(count($token_info) > 0){
      return response()->json(['token_info'=>$token_info,'status'=>1]);
    }
    else{
      return response()->json(['status'=>0]);
    }
  }



}
