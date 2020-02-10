<?php

namespace App\Http\Controllers;

use App\Applicant;
use Carbon\Carbon;
use DateTime;
use NumberFormatter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class PrintController extends Controller
{

    public static function convert_number_to_words($number)
    {

        $hyphen = '-';
        $conjunction = ' and ';
        $separator = ', ';
        $negative = 'negative ';
        $decimal = ' point ';
        $dictionary = array(
            0 => 'zero',
            1 => 'one',
            2 => 'two',
            3 => 'three',
            4 => 'four',
            5 => 'five',
            6 => 'six',
            7 => 'seven',
            8 => 'eight',
            9 => 'nine',
            10 => 'ten',
            11 => 'eleven',
            12 => 'twelve',
            13 => 'thirteen',
            14 => 'fourteen',
            15 => 'fifteen',
            16 => 'sixteen',
            17 => 'seventeen',
            18 => 'eighteen',
            19 => 'nineteen',
            20 => 'twenty',
            30 => 'thirty',
            40 => 'forty',
            50 => 'fifty',
            60 => 'sixty',
            70 => 'seventy',
            80 => 'eighty',
            90 => 'ninety',
            100 => 'hundred',
            1000 => 'thousand',
            1000000 => 'million',
            1000000000 => 'billion',
            1000000000000 => 'trillion',
            1000000000000000 => 'quadrillion',
            1000000000000000000 => 'quintillion',


        );

        if (!is_numeric($number)) {
            return false;
        }

        if (($number >= 0 && (int)$number < 0) || (int)$number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
                'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
                E_USER_WARNING
            );
            return false;
        }

        if ($number < 0) {
            return $negative . Self::convert_number_to_words(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens = ((int)($number / 10)) * 10;
                $units = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . Self::convert_number_to_words($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int)($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = Self::convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= Self::convert_number_to_words($remainder);
                }
                break;
        }

        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string)$fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }

        return $string;
    }


    public function index(Request $request)
    {


        $search_input = $request->input('q');
        $q = strtoupper(str_replace(' ', '', $search_input));


        $todayDate = strtotime(date('Y-m-d'));
        $currentDate = date('j F Y', $todayDate);

        $authorities = DB::table('tbl_authority')->select('id', 'name', 'designation')->get();

        $count = DB::table('tbl_port_update')->where('approve_status', '=', 'Approved')->whereDate('approve_date', Carbon::today())->count('approve_status');
        if (!empty($q)) {

            $masterpp = DB::select("select MasterPP from tbl_port_update where passport='$q' AND approve_status='Pending'  AND  active = 1");

            if (!empty($masterpp)) {
                $mp = $masterpp[0]->MasterPP;
                $users = DB::select("select * from tbl_port_update where MasterPP='$mp' AND approve_status='Pending'  AND  active = 1");

            } else
                $users = Applicant::where('MasterPP', $q)->where('approve_status', 'Pending')->where('active', 1)->get();

        } else
            $users = "";


        $address = Applicant::select(['serial_no', 'OldPort', 'NewPort', 'arrivalDate', 'departureDate', 'MasterPP'])->where('MasterPP', '=', $q)->orderBy('arrivalDate', 'DES')->first();


        $applicant = Applicant::select(array('arrivalDate', 'departureDate', 'MasterPP', 'passport'))->where('MasterPP', '=', $q)->orderBy('arrivalDate', 'DES')->first();


        $mydate = strtotime($address['arrivalDate']);
        $arrived = date('j F', $mydate);

        $mydate2 = strtotime($address['departureDate']);
        $departure = date('j F Y', $mydate2);

        $datetime1 = new DateTime($applicant['arrivalDate']);

        $datetime2 = new DateTime($applicant['departureDate']);
        $interval = $datetime1->diff($datetime2);
        $days = $interval->format('%a');//now do whatever you like with $days

        $new = $days + 1;
        $word = PrintController::convert_number_to_words($new);
        $id = DB::table('tbl_authority')->select('id')->first();
        $name = DB::table('tbl_authority')->select('id', 'name', 'designation')->get();


        return view('print.print', ['name' => $name, 'id' => $id, 'authorities' => $authorities, 'users' => $users, 'days' => $days, 'word' => $word, 'address' => $address, 'currentDate' => $currentDate, 'arrived' => $arrived, 'departure' => $departure, 'count' => $count, 'squery' => $q]);

    }


    public function store(Request $request)
    {

        // $this->validate($request,[]);

        // $posted_data = $_POST;
        // $acceptData = array();
        // $rejectData = array();
        // foreach ($posted_data as $key => $value) {
        //     if ($value != 0) {
        //         array_push($acceptData, $value);
        //     }
        //     if ($value == 0) {
        //         $rejectValue = str_replace("accept", "", $key);
        //         if ($rejectValue != 0) {
        //             array_push($rejectData, $rejectValue);
        //         }
        //     }
        // }

        // $q = $request->input('accept');
        // $q =  str_replace(' ','', $request->masterpass);


        $name = $request->name;
        $desi = $request->desi;

        $q = $request->masterpass;



        $all = $request->allval; //All Values

        $chkval = $request->accept; //Check Values


        if(count($all)>0 && ($chkval==''))
        {

            foreach ($all as $id) {


                // echo $id;
                DB::table('tbl_port_update')
                    ->where('serial_no', $id)
                    ->update(['approve_status' => 'Rejected', 'approve_by' => $name, 'approve_date' => now(), 'entry_by' => auth()->user()->name]);
                //  echo  DB::statement("Select * from `tbl_port_update` where `serial_no`= 3 ");



            }
            return redirect('/print')->with('message', 'All passport rejected');



        }
        else
        {


            if (empty($chkval)) {
                $filter_uncheck = $all;
            } else
                $filter_uncheck = array_diff($all, $chkval); //UnCheck Values

            //Taking approve author name

            //Updating Check Values
            // echo  count($chkval); exit;

            //   if (!empty($chkval)) {
            # code...

            foreach ($chkval as $id) {
                DB::table('tbl_port_update')
                    ->where('serial_no', $id)
                    ->update(['approve_status' => 'Approved', 'approve_by' => $name, 'approve_date' => now(), 'entry_by' => auth()->user()->name]);
            }
            // }


            //Updating UnCheck Values

//                 if (!empty($all)) {


            foreach ($filter_uncheck as $id) {
                DB::table('tbl_port_update')
                    ->where('serial_no', $id)
                    ->update(['approve_status' => 'Rejected', 'approve_by' => $name, 'approve_date' => now(), 'entry_by' => auth()->user()->name]);
            }

        }

        $todayDate = strtotime(date('Y-m-d'));
        $currentDate = date('j F Y', $todayDate);


        $payrolls = Applicant::where("serial_no", $request->input('accept'))->get();

        foreach ($payrolls as $payrolls) {

            $dateTime = Carbon::parse($request->recFrmHCI_time);

            $payrolls->approve_date = $dateTime->format('Y-m-d H:i:s');
            $payrolls->approve_by = auth()->user()->name;
            $payrolls->save();
        }


        $count = DB::table('tbl_port_update')->whereDate('approve_date', Carbon::today())->where('approve_status', '=', 'Approved')->distinct('MasterPP')->count('MasterPP');

//            $users = Applicant::where('MasterPP', $q)->where('passport', '=', $q)->where('approve_status', 'pending')->get();
        $users = Applicant::whereIn('serial_no', $chkval)->get();


        $address = Applicant::select(['area', 'OldPort', 'NewPort', 'mode', 'arrivalDate', 'departureDate', 'MasterPP'])->where('MasterPP', '=', $q)->orderBy('arrivalDate', 'DES')->first();

        $applicant = Applicant::select(array('arrivalDate', 'departureDate', 'MasterPP', 'passport'))->where('MasterPP', '=', $q)->orderBy('arrivalDate', 'DES')->first();


        $date = DB::table('tbl_port_update')->select('arrivalDate', 'departureDate', 'area', 'OldPort', 'NewPort', 'mode')->where('passport', $q)->get();

        $mydate = strtotime($date[0]->arrivalDate);

        $arrived = date('j F', $mydate);

        $mydate2 = strtotime($date[0]->departureDate);
        $departure = date('j F Y', $mydate2);

        $datetime1 = new DateTime($date[0]->arrivalDate);

        $datetime2 = new DateTime($date[0]->departureDate);
        $interval = $datetime1->diff($datetime2);
        $days = $interval->format('%a');//now do whatever you like with $days

        $new = $days + 1;
        $word = PrintController::convert_number_to_words($new);

        return view('print.printfinal', ['name' => $name, 'desi' => $desi, 'users' => $users, 'days' => $days, 'word' => $word, 'address' => $address, 'currentDate' => $currentDate, 'arrived' => $arrived, 'departure' => $departure, 'area' => $date[0]->area, 'OldPort' => $date[0]->OldPort, 'NewPort' => $date[0]->NewPort, 'mode' => $date[0]->mode, 'count' => $count]);


    }


    public function edit(Request $request)
    {


        $search_input = $request->input('q');
        $q = strtoupper(str_replace(' ', '', $search_input));

        $todayDate = strtotime(date('Y-m-d'));
        $currentDate = date('j F Y', $todayDate);

        $authorities = DB::table('tbl_authority')->select('id', 'name', 'designation')->get();

        $count = DB::table('tbl_port_update')->where('approve_status', '=', 'Approved')->whereDate('approve_date', Carbon::today())->count('approve_status');
        if (!empty($q)) {

            $masterpp = DB::select("select MasterPP from tbl_port_update where passport='$q' AND approve_status !='Pending'  AND  active = 1");

            if (!empty($masterpp)) {
                $mp = $masterpp[0]->MasterPP;
                $users = DB::select("select * from tbl_port_update where MasterPP='$mp' AND approve_status !='Pending'  AND  active = 1");

            } else
                $users = Applicant::where('MasterPP', $q)->where('active', 1)->where('approve_status', '!=', 'Pending')->get();

        } else
            $users = "";
//            $users = DB::table("select * from tbl_port_update where approve_status='Pending'  AND  active = '1' AND MasterPP=(select MasterPP from tbl_port_update where passport='$q')");

// dd($request->name);
        $id = DB::table('tbl_authority')->select('id')->first();
        $name = DB::table('tbl_authority')->select('id', 'name', 'designation')->get();
        if (!empty($q)) {
            $name1 = DB::table('tbl_port_update')->select('approve_by')->where('passport', $q)->get();
            $UserName = $name1[0]->approve_by;
        } else
            $UserName = "";


        return view('print.edit', ['name' => $name, 'UserName' => $UserName, 'id' => $id, 'authorities' => $authorities, 'users' => $users, 'squery' => $q, 'count' => $count]);

    }

    public function update(Request $request)
    {


        switch ($request->input('action')) {
            case 'save':
                //  $chkval=array();
                /*Taking all value from list*/

                $Name = $request->k;
                $userName = DB::table('tbl_authority')->select('name')->where('id', $Name)->get();
                $name = $userName[0]->name;


                $all = $request->allval; //All Values

                $chkval = $request->accept; //Check Values


                if(count($all)>0 && ($chkval==''))
                {

                    foreach ($all as $id) {


                        // echo $id;
                        DB::table('tbl_port_update')
                            ->where('serial_no', $id)
                            ->update(['approve_status' => 'Rejected', 'approve_by' => $name, 'approve_date' => now(), 'entry_by' => auth()->user()->name]);
                        //  echo  DB::statement("Select * from `tbl_port_update` where `serial_no`= 3 ");



                    }
                    return redirect('/edit')->with('message', 'All passport rejected');
                    ;



                }
                else
                {


                    if (empty($chkval)) {
                        $filter_uncheck = $all;
                    } else
                        $filter_uncheck = array_diff($all, $chkval); //UnCheck Values

                    //Taking approve author name

                    //Updating Check Values
                    // echo  count($chkval); exit;

                    //   if (!empty($chkval)) {
                    # code...

                    foreach ($chkval as $id) {
                        DB::table('tbl_port_update')
                            ->where('serial_no', $id)
                            ->update(['approve_status' => 'Approved', 'approve_by' => $name, 'approve_date' => now(), 'entry_by' => auth()->user()->name]);
                    }
                    // }


                    //Updating UnCheck Values

//                 if (!empty($all)) {


                    foreach ($filter_uncheck as $id) {
                        DB::table('tbl_port_update')
                            ->where('serial_no', $id)
                            ->update(['approve_status' => 'Rejected', 'approve_by' => $name, 'approve_date' => now(), 'entry_by' => auth()->user()->name]);
                    }

                }
//                 }

//                else{
//
//
//
//                }



                $desiName = DB::table('tbl_authority')->select('designation')->where('id', $Name)->get();

                $desi = $desiName[0]->designation;

//         $posted_data = $_POST;
// //        dd($posted_data);
//         $acceptData = array();
//         $rejectData = array();
//         foreach ($posted_data as $key => $value) {
//             if ($value != 0) {
//                 array_push($acceptData, $value);
//             }
//             if ($value == 0) {
//                 $rejectValue = str_replace("accept", "", $key);
//                 if ($rejectValue != 0) {
//                     array_push($rejectData, $rejectValue);
//                 }
//             }
//         }

                // dd($acceptData);


                $q = $request->masterpass;


                // $name = $request->name;
                // $desi = $request->desi;

                $todayDate = strtotime(date('Y-m-d'));
                $currentDate = date('j F Y', $todayDate);
                $accept = $request->accept;


                // if (!empty($acceptData)) {

                //     foreach ($acceptData as $id) {

                //         // $dateTime = Carbon::parse($request->recFrmHCI_time);
                //         DB::table('tbl_port_update')
                //             ->where('serial_no', $id)
                //             ->update(['approve_status' => 'Approved', 'approve_by'=>$name,  'approve_date' => now(),'entry_by'=>auth()->user()->name]);


                //     }


                // }
                // if (!empty($rejectData)) {

                //     foreach ($rejectData as $id) {


                //         DB::table('tbl_port_update')
                //             ->where('serial_no', $id)
                //             ->update(['approve_status' => 'Rejected', 'approve_by'=>$name,'approve_date' => now() ,'entry_by'=>auth()->user()->name]);


                //     }
                // }

                $count = DB::table('tbl_port_update')->whereDate('approve_date', Carbon::today())->where('approve_status', '=', 'Approved')->distinct('MasterPP')->count('MasterPP');


                $users = DB::table('tbl_port_update')->whereIn('serial_no', $chkval)->get();


                $address = Applicant::select(['area', 'OldPort', 'NewPort', 'mode', 'arrivalDate', 'departureDate', 'MasterPP'])->where('MasterPP', '=', $q)->orderBy('arrivalDate', 'DES')->first();

                $applicant = Applicant::select(array('arrivalDate', 'departureDate', 'MasterPP', 'passport'))->where('MasterPP', '=', $q)->orderBy('arrivalDate', 'DES')->first();

                $date = DB::table('tbl_port_update')->select('arrivalDate', 'departureDate', 'area', 'OldPort', 'NewPort', 'mode')->where('passport', $q)->get();

                $mydate = strtotime($date[0]->arrivalDate);

                $arrived = date('j F', $mydate);

                $mydate2 = strtotime($date[0]->departureDate);
                $departure = date('j F Y', $mydate2);

                $datetime1 = new DateTime($date[0]->arrivalDate);

                $datetime2 = new DateTime($date[0]->departureDate);
                $interval = $datetime1->diff($datetime2);
                $days = $interval->format('%a');


                $new = $days + 1;
                $word = PrintController::convert_number_to_words($new);
                return view('print.editPrint', ['name' => $name, 'desi' => $desi, 'users' => $users, 'days' => $days, 'word' => $word, 'address' => $address, 'currentDate' => $currentDate, 'arrived' => $arrived, 'departure' => $departure, 'area' => $date[0]->area, 'OldPort' => $date[0]->OldPort, 'NewPort' => $date[0]->NewPort, 'mode' => $date[0]->mode, 'count' => $count]);

                break;

            case 'Re-Print':


                $chkval = $request->accept; //Check Values
                $mp = $request->masterpass;

                $Name = $request->k;
                $userName = DB::table('tbl_authority')->select('name')->where('id', $Name)->get();
                $name = $userName[0]->name;

                $desiName = DB::table('tbl_authority')->select('designation')->where('id', $Name)->get();

                $desi = $desiName[0]->designation;


                $q = $request->masterpass;


                // $name = $request->name;
                // $desi = $request->desi;

                $todayDate = strtotime(date('Y-m-d'));
                $currentDate = date('j F Y', $todayDate);
                $accept = $request->accept;


                $count = DB::table('tbl_port_update')->whereDate('approve_date', Carbon::today())->where('approve_status', '=', 'Approved')->distinct('MasterPP')->count('MasterPP');


                $users = DB::table('tbl_port_update')->where('MasterPP', $mp)->where('approve_status', "Approved")->get();


                $address = Applicant::select(['area', 'OldPort', 'NewPort', 'mode', 'arrivalDate', 'departureDate', 'MasterPP'])->where('MasterPP', '=', $q)->orderBy('arrivalDate', 'DES')->first();

                $applicant = Applicant::select(array('arrivalDate', 'departureDate', 'MasterPP', 'passport'))->where('MasterPP', '=', $q)->orderBy('arrivalDate', 'DES')->first();

                $date = DB::table('tbl_port_update')->select('arrivalDate', 'departureDate', 'area', 'OldPort', 'NewPort', 'mode')->where('passport', $q)->get();

                $mydate = strtotime($date[0]->arrivalDate);

                $arrived = date('j F', $mydate);

                $mydate2 = strtotime($date[0]->departureDate);
                $departure = date('j F Y', $mydate2);

                $datetime1 = new DateTime($date[0]->arrivalDate);

                $datetime2 = new DateTime($date[0]->departureDate);
                $interval = $datetime1->diff($datetime2);
                $days = $interval->format('%a');


                $new = $days + 1;
                $word = PrintController::convert_number_to_words($new);

                return view('print.rePrint', ['name' => $name, 'desi' => $desi, 'users' => $users, 'days' => $days, 'word' => $word, 'address' => $address, 'currentDate' => $currentDate, 'arrived' => $arrived, 'departure' => $departure, 'area' => $date[0]->area, 'OldPort' => $date[0]->OldPort, 'NewPort' => $date[0]->NewPort, 'mode' => $date[0]->mode, 'count' => $count]);

                break;


        }


    }


    public function destroy(Applicant $ticket)
    {


        $ticket->delete();

        return redirect('/print');
    }

    public function ajax($request)
    {


        $data = DB::table('tbl_authority')->select('designation', 'name')->where('id', $request)->get();

        return response()->json($data);

    }

    public function basic(Request $request){

        $search_input = $request->input('q');
        $q = strtoupper(str_replace(' ', '', $search_input));


        $todayDate = strtotime(date('Y-m-d'));
        $currentDate = date('j F Y', $todayDate);

        $authorities = DB::table('tbl_authority')->select('id', 'name', 'designation')->get();

        $count = DB::table('tbl_port_update')->where('approve_status', '=', 'Approved')->whereDate('approve_date', Carbon::today())->count('approve_status');
        if (!empty($q)) {

            $masterpp = DB::select("select MasterPP from tbl_port_update where passport='$q'");

            if (!empty($masterpp)) {
                $mp = $masterpp[0]->MasterPP;
                $users = DB::select("select * from tbl_port_update where MasterPP='$mp' ");

            }
            else $users = DB::select("select * from tbl_port_update where passport='$q' ");
            // else
//                $users = Applicant::where('MasterPP', $q)->get();

        } else
            $users = "";


        $address = Applicant::select(['serial_no', 'OldPort', 'NewPort', 'arrivalDate', 'departureDate', 'MasterPP'])->where('MasterPP', '=', $q)->orderBy('arrivalDate', 'DES')->first();


        $applicant = Applicant::select(array('arrivalDate', 'departureDate', 'MasterPP', 'passport'))->where('MasterPP', '=', $q)->orderBy('arrivalDate', 'DES')->first();


        $mydate = strtotime($address['arrivalDate']);
        $arrived = date('j F', $mydate);

        $mydate2 = strtotime($address['departureDate']);
        $departure = date('j F Y', $mydate2);

        $datetime1 = new DateTime($applicant['arrivalDate']);

        $datetime2 = new DateTime($applicant['departureDate']);
        $interval = $datetime1->diff($datetime2);
        $days = $interval->format('%a');//now do whatever you like with $days

        $new = $days + 1;
        $word = PrintController::convert_number_to_words($new);
        $id = DB::table('tbl_authority')->select('id')->first();
        $name = DB::table('tbl_authority')->select('id', 'name', 'designation')->get();


        return view('print.basic', ['name' => $name, 'id' => $id, 'authorities' => $authorities, 'users' => $users, 'days' => $days, 'word' => $word, 'address' => $address, 'currentDate' => $currentDate, 'arrived' => $arrived, 'departure' => $departure, 'count' => $count, 'squery' => $q]);

    }

    public function basicStore(Request $request){

        $name = $request->name;
        $desi = $request->desi;

        $q = $request->masterpass;


        $mp = $request->masterpass;

//        $Name = $request->k;
//        $userName = DB::table('tbl_authority')->select('name')->where('id', $Name)->get();
//        $name = $userName[0]->name;
//
//        $desiName = DB::table('tbl_authority')->select('designation')->where('id', $Name)->get();
//
//        $desi = $desiName[0]->designation;


        $q = $request->masterpass;


        // $name = $request->name;
        // $desi = $request->desi;

        $todayDate = strtotime(date('Y-m-d'));
        $currentDate = date('j F Y', $todayDate);
        $accept = $request->accept;


        $count = DB::table('tbl_port_update')->whereDate('approve_date', Carbon::today())->where('approve_status', '=', 'Approved')->distinct('MasterPP')->count('MasterPP');


        //$users = DB::table('tbl_port_update')->where('MasterPP', $mp)->get();

        $masterpp = DB::select("select MasterPP from tbl_port_update where passport='$q'");

        if (!empty($masterpp)) {
            $mp = $masterpp[0]->MasterPP;
            $users = DB::select("select * from tbl_port_update where MasterPP='$mp' ");

        }
        else $users = DB::select("select * from tbl_port_update where passport='$q' ");


        //  print_r($users);exit;


        $address = Applicant::select(['area', 'OldPort', 'NewPort', 'mode', 'arrivalDate', 'departureDate', 'MasterPP'])->where('MasterPP', '=', $q)->orderBy('arrivalDate', 'DES')->first();

        $applicant = Applicant::select(array('arrivalDate', 'departureDate', 'MasterPP', 'passport'))->where('MasterPP', '=', $q)->orderBy('arrivalDate', 'DES')->first();

        $date = DB::table('tbl_port_update')->select('arrivalDate', 'departureDate', 'area', 'OldPort', 'NewPort', 'mode')->where('passport', $q)->get();

        $mydate = strtotime($date[0]->arrivalDate);

        $arrived = date('j F', $mydate);

        $mydate2 = strtotime($date[0]->departureDate);
        $departure = date('j F Y', $mydate2);

        $datetime1 = new DateTime($date[0]->arrivalDate);

        $datetime2 = new DateTime($date[0]->departureDate);
        $interval = $datetime1->diff($datetime2);
        $days = $interval->format('%a');


        $new = $days + 1;
        $word = PrintController::convert_number_to_words($new);
        return view('print.basic_print', ['name' => $name, 'desi' => $desi, 'users' => $users, 'days' => $days, 'word' => $word, 'address' => $address, 'currentDate' => $currentDate, 'arrived' => $arrived, 'departure' => $departure, 'area' => $date[0]->area, 'OldPort' => $date[0]->OldPort, 'NewPort' => $date[0]->NewPort, 'mode' => $date[0]->mode, 'count' => $count]);


    }

    public function passport_reprint(Request $request){
        $search_input = $request->input('q');
        if (isset($search_input)){

            $q = strtoupper(str_replace(' ', '', $search_input));

            $todayDate = strtotime(date('Y-m-d'));
            $currentDate = date('j F Y', $todayDate);
            $masterpp = DB::select("select MasterPP from tbl_port_update where passport='$q'");
            if (isset($masterpp) && !empty($masterpp)){
                $authorities = DB::table('tbl_authority')->select('id', 'name', 'designation')->get();

                $count = DB::table('tbl_port_update')
                    ->where('approve_status', '=', 'Approved')
                    ->whereDate('approve_date', Carbon::today())
                    ->count('approve_status');
                if (!empty($q)) {


                    if (isset($masterpp) && !empty($masterpp)) {
                        $mp = $masterpp[0]->MasterPP;
                        $users = DB::select("select * from tbl_port_update where MasterPP='$mp'");

                    } else
                        $users = Applicant::where('MasterPP', $q)
                            ->where('active', 1)
                            ->get();

                } else
                    $users = "";
//            $users = DB::table("select * from tbl_port_update where approve_status='Pending'  AND  active = '1' AND MasterPP=(select MasterPP from tbl_port_update where passport='$q')");

// dd($request->name);
                $id = DB::table('tbl_authority')->select('id')->first();
                $name = DB::table('tbl_authority')->select('id', 'name', 'designation')->get();
                if (!empty($q)) {
                    $name1 = DB::table('tbl_port_update')->select('approve_by')->where('passport', $q)->get();
                    $UserName = $name1[0]->approve_by;
                } else
                    $UserName = "";


                return view('print.reprint_passport', ['name' => $name, 'UserName' => $UserName, 'id' => $id, 'authorities' => $authorities, 'users' => $users, 'squery' => $q, 'count' => $count]);
            }else{
                return view('print.reprint_passport');
            }


        }else{
            return view('print.reprint_passport');
        }
    }



}
