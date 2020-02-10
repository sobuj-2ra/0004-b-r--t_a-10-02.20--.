<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Excel;
use Input;
use Session;
use Auth;
use PDOException;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('appointment.import');
    }

    function multiexplode($delimiters, $string)
    {

        $ready = str_replace($delimiters, $delimiters[0], $string);
        $launch = explode($delimiters[0], $ready);
        return $launch;
    }


    public function import(Request $request)
    {
        set_time_limit(120);
        $total_data = '';
        $message = '';
        $importD = $request->date;
        $importDate = date('Y-m-d', strtotime($importD));
        $contents = file_get_contents($request->file('import_file'));

        $str_arr = $this->multiexplode(array("BGDD!", "BGDR!", "BGDC!", "BGDK!", "BGDS!"), $contents);
        $dataChunk = array();
        for ($i = 0; $i < sizeof($str_arr); $i++) {

            $str = explode("!", $str_arr[$i]);
            if (sizeof($str) >= 117) {
                $Applicant_Name = $str[15] . ' ' . $str[14];
                $p_address = $str[27] . ' ' . $str[28]. ' ' . $str[29];
                array_push($dataChunk, ['WebFile_no' => $str[0], 'Reg_Date' => $str[1], 'Passport' => $str[2], 'Applicant_name' => $Applicant_Name, 'Contact' => $str[31], 'Visa_Type' => $str[68], 'DataImport_By' => Auth::user()->user_id, 'DataImport_Date' => $importDate, 'date_of_issue' => $str[3], 'expiry_date' => $str[5], 'p_address' => $p_address, 'mothers_name' => $str[38], 'date_of_birth' => $str[17], 'gender' => $str[16]]);
            }

        }

        $rankings = [];
        foreach ($dataChunk as $result) {
            $rankings[] = implode(', ', ['"' . $result['WebFile_no'] . '"', '"' . $result['Reg_Date'] . '"', '"' . $result['Passport'] . '"', '"' . $result['Applicant_name'] . '"', '"' . $result['Contact'] . '"', '"' . $result['Visa_Type'] . '"', '"' . $result['DataImport_By'] . '"', '"' . $result['DataImport_Date'] . '"', '"' . $result['date_of_issue'] . '"', '"' . $result['expiry_date'] . '"', '"' . $result['p_address'] . '"', '"' . $result['mothers_name'] . '"', '"' . $result['date_of_birth'] . '"', '"' . $result['gender'] . '"']);
        }

        //$rankings = Collection::make($rankings);
        $rankings = collect($rankings);
        $rankings->chunk(500)->each(function($ch) {
            $rankingString = '';
            foreach ($ch as $ranking) {
                $rankingString .= '(' . $ranking . '), ';
            }

            $rankingString = rtrim($rankingString, ", ");

            try {
                DB::insert("INSERT INTO tbl_appointmentlist (`WebFile_no`, `Reg_Date`, `Passport`, `Applicant_name`, `Contact`, `Visa_Type`, `DataImport_By`, `DataImport_Date`, `date_of_issue`, `expiry_date`, `p_address`, `mothers_name`, `date_of_birth`, `gender`) VALUES $rankingString ON DUPLICATE KEY UPDATE `WebFile_no`= VALUES(`WebFile_no`),`Reg_Date`= VALUES(`Reg_Date`),`Passport`= VALUES(`Passport`),`Applicant_name`= VALUES(`Applicant_name`),`Contact`= VALUES(`Contact`),`Visa_Type`= VALUES(`Visa_Type`),`DataImport_By`= VALUES(`DataImport_By`),`DataImport_Date`= VALUES(`DataImport_Date`),`gender`= VALUES(`gender`)");

            } catch (PDOException $e) {
                $message = "Data Already Inserted !";
                return redirect("/import-appointment")->with("success", "$message");
            }
        });
        $message = 'Total '.sizeof($dataChunk).' Data Inserted Successfully !';
        return redirect("/import-appointment")->with("success", "$message");
        //exit();







//        $j=0;
//        $k = 0;
//        foreach ($dataChunk as $c){
//            $count_status = DB::statement("insert into tbl_appointmentlist (`Applicant_name`,`Appointment_Date`,`DataImport_By`,`DataImport_Date`,`Passport`,`Presence_Status`,`Reg_Date`,`WebFile_no`,`Contact`,`Visa_Type`,`RejectCause`,`RejectBy`,`RejectTime`) values ('$c[Applicant_name]','','$c[DataImport_By]','$c[DataImport_Date]','$c[Passport]','','$c[Reg_Date]','$c[WebFile_no]','$c[Contact]','$c[Visa_Type]','','','')on duplicate key update  `Applicant_name`='$c[Applicant_name]',`Appointment_Date`='',`DataImport_By`='$c[DataImport_By]',`DataImport_Date`='$c[DataImport_Date]',`Passport`='$c[Passport]',`Presence_Status`='',`Reg_Date`='$c[Reg_Date]',`WebFile_no`='$c[WebFile_no]',`Contact`='$c[Contact]',`Visa_Type`='$c[Visa_Type]',`RejectCause`='',`RejectBy`='',`RejectTime`=''");
//            if ($count_status == 1){
//                $j++;
//            }else if ($count_status == 0){
//                $k++;
//            }
//        }
//        $message="Inserted = $j, And Already Exist = $k";
//        return redirect("/import-appointment")->with("success", "$message");

//        $chaunk_data = collect($dataChunk);
//        $chunks = $chaunk_data->chunk(100);
//
//        foreach ($chunks as $chunk)
//        {
//            try {
//            DB::table('tbl_appointmentlist')->insert($chunk->toArray());
//            } catch (PDOException $e) {
//                print_r('duplicate');
//                $message = "Data Already Inserted !";
//                return redirect("/import-appointment")->with("success", "$message");
//            }
//        }
//
////        $j = 0;
////        $k = 0;
////        foreach ($dataChunk as $c) {
////            $count_status = DB::affectingStatement("insert into tbl_appointmentlist (`Applicant_name`,`Appointment_Date`,`DataImport_By`,`DataImport_Date`,`Passport`,`Presence_Status`,`Reg_Date`,`WebFile_no`,`Contact`,`Visa_Type`,`RejectCause`,`RejectBy`,`RejectTime`) values ('$c[Applicant_name]','','$c[DataImport_By]','$c[DataImport_Date]','$c[Passport]','','$c[Reg_Date]','$c[WebFile_no]','$c[Contact]','$c[Visa_Type]','','','')on duplicate key update  `Applicant_name`='$c[Applicant_name]',`Appointment_Date`='',`DataImport_By`='$c[DataImport_By]',`DataImport_Date`='$c[DataImport_Date]',`Passport`='$c[Passport]',`Presence_Status`='',`Reg_Date`='$c[Reg_Date]',`WebFile_no`='$c[WebFile_no]',`Contact`='$c[Contact]',`Visa_Type`='$c[Visa_Type]',`RejectCause`='',`RejectBy`='',`RejectTime`=''");
////            if ($count_status == 1) {
////                $j++;
////            } else if ($count_status == 0) {
////                $k++;
////            }
////        }
//        $message = 'Total '.sizeof($dataChunk).' Data Inserted Successfully !';
//        return redirect("/import-appointment")->with("success", "$message");
    }

    public function insertImportData($WebFile_no, $Reg_date, $Passprt, $Applicant_Name, $Mobile, $Visa_type, $importDate)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public
    function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public
    function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        //
    }
}
