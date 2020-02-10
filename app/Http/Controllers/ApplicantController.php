<?php

namespace App\Http\Controllers;

use App\Applicant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\User;

class ApplicantController extends Controller
{

    public function index(Request $request)
    {
        $date = date('Y-m-d');
        $user = auth()->user()->user_id;
        $q = strtoupper(str_replace(' ', '', $request->wf_no));
        $sql = "SELECT * FROM `tbl_port_update` WHERE date(`recFrmHCI_time`) = '$date'  AND recFrmHCI_by = '$user'";
        $total = DB::select($sql);


        $service = DB::table('tbl_ivac_services')
            ->get();

        $total_count = count($total);
        return view('search.search', ['q' => $q, 'total' => $total_count, 'services'=> $service]);

    }


    public function search(Request $request)
    {

        $q = strtoupper(str_replace(' ', '', $_POST['my_wf_no']));
        $type = $_POST['type'];
        $data['qq1'] = $q; // Put in hidden field

        $qq2 = strtoupper(str_replace(' ', '', $_POST['rss']));

        //dd($q);

        if (!empty($q) && !empty($type)) {

            // $data['result'] = DB::table('tbl_port_update')->select('passport', 'sticker', 'contact', 'serial_no')->where('passport', $q)->orderBy('rec_cen_time', 'desc')->first();
            //  return response()->json($data);

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
                    ->where('recFrmHCI_by', '=', NULL)
                    ->orderBy('rec_cen_time', 'desc')->first();
                return response()->json($data);
            }

        } else {
            $data['contact'] = "No Data Found";
            $data['name'] = "No Data Found";
            $data['sticker'] = "No Data Found";
            $data['stNo'] = "No Data Found";
            echo json_encode($data);
        }

        //return view('search.search', ['q'=>$q]);


    }


    public function store(Request $request)
    {
        $passport = $_POST['wf_no'];
        $contact = $request->contact;
        $id = $request->id;
        $StType = $_POST['StType'];
        //$total_count = -1;

        if (!empty($passport) && !empty($contact) && !empty($StType)) {
            for ($i = 0; $i < count($passport); $i++) {
                DB::table('tbl_port_update')
                    ->where('serial_no', $id[$i])
                    ->where('passport', $passport[$i])
                    ->update(['status' => 2, 'recFrmHCI_time' => now(), 'contact' => $contact[$i], 'sticker' => $StType[$i], 'recFrmHCI_by' => auth()->user()->user_id]);
                //$total_count++;
            }
        }

//        elseif(empty($contact) || empty($StType)){
//            foreach ($passport as $pass) {
//
//
//                DB::table('tbl_port_update')
//                    ->where('passport', $pass)
//                    ->update(['status' => 2, 'recFrmHCI_time' => now(), 'recFrmHCI_by' => auth()->user()->name]);
//
//

//
//            }
//
//
//        }


//        dd($total_count);
//        $dateTime = Carbon::parse($request->recFrmHCI_time);

//        $applicantId->recFrmHCI_time = now();
//
//        $applicantId->recFrmHCI_by = auth()->user()->name;
//        $applicantId->status = 2;
//        $applicantId->save();
        return redirect('/search');


    }
}
