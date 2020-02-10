<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Input;
use App\Post;
use DB;
use Session;
use Excel;

class exportimportController extends Controller
{

public function export()
    {
       //$portinfo   = DB::table('tbl_port_update')->select('applicant_name')->get();
    	$portinfo   = DB::table('tbl_port_update')->orderByRaw('serial_no DESC')->get();
       return view('exportimport.export',['portinfo' => $portinfo]);
    }

public function excel(Request $request)
    {
		//echo $now = date('Y-m-d H:i:s');exit;
		//echo $timestamp = time(); 
		$date=$request->dateinput;

    	$port_update_data = DB::table('tbl_port_update')->whereDate('rec_cen_time', $request->dateinput)->get()->toArray();
  

    	$port_array[] = array('applicant_name','designation','passport','center','visa_no','visa_type','contact','rec_cen_time','rec_cen_by','sent2hci_time','sent2hci_by','recFrmHCI_time','recFrmHCI_by','del2app_time','status','uploadTime','region','Remarks','Fee','OldPort','NewPort','area','mode','sticker','ServiceType','arrivalDate','departureDate','MasterPP','approve_status','approve_by','approve_date');

    	foreach($port_update_data as $val){
         $port_array[]= array(
			'applicant_name'=>$val->applicant_name,
			'designation'   =>$val->designation,
			'passport'      =>$val->passport,
			'center'        =>$val->center,
			'visa_no'       =>$val->visa_no,
			'visa_type'     =>$val->visa_type,
			'contact'       =>$val->contact,
			'rec_cen_time'  =>$val->rec_cen_time,
			'rec_cen_by'    =>$val->rec_cen_by,
			'sent2hci_time' =>$val->sent2hci_time,
			'sent2hci_by'   =>$val->sent2hci_by,
			'recFrmHCI_time'=>$val->recFrmHCI_time,
			'recFrmHCI_by'  =>$val->recFrmHCI_by,
			'del2app_time'  =>$val->del2app_time,
			'status'        =>$val->status,
			'uploadTime'    =>$val->uploadTime,
			'region'        =>$val->region,
			'Remarks'       =>$val->Remarks,
			'Fee'           =>$val->Fee,
			'OldPort'       =>$val->OldPort,
			'NewPort'       =>$val->NewPort,
			'area'          =>$val->area,
			'mode'          =>$val->mode,
			'sticker'       =>$val->sticker,
			'ServiceType'   =>$val->ServiceType,
			'arrivalDate'   =>$val->arrivalDate,
			'departureDate' =>$val->departureDate,
			'MasterPP'      =>$val->MasterPP,
			'approve_status'=>$val->approve_status,
			'approve_by'    =>$val->approve_by,
			'approve_date'  =>$val->approve_date
         );
    	}

    	Excel::create($date.'_portexport', function($excel) use ( $port_array){

	    	$excel->setTitle('R.A.P / P.A.P Data');
	    	$excel->sheet('Table Data', function($sheet) use ($port_array){
			$sheet->fromArray($port_array, null, 'A1', false, false);

       });

    })->download('txt');
}

    public function import(){

    	return view('exportimport.import');
    }

     public function importExcel(Request $request)
       {
        if($request->hasFile('import_file')){
            Excel::load($request->file('import_file')->getRealPath(), function ($reader) {

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
					$data['approve_by']      = $row['approve_by'];
					$data['approve_date']    = $row['approve_date'];

                    if(!empty($data)) {
                        DB::table('tbl_port_update')->insert($data);
                    }
                }
            });
        }

        
 return redirect('import/data')->with('success', 'Your file successfully has imported in database!!!');

       // return back();
    }
}
