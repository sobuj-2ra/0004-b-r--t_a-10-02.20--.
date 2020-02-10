<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use Auth;
use Input;
use Session;
use Excel;
use Illuminate\Support\Facades\Response as FacadeResponse;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type, $user_id, $from, $to)
    {
        $data = array();
        $user_id = $user_id;
        $from_date = $from;
        $from = date('Y-m-d', strtotime($from_date));
        $to_date = $to;
        $to = date('Y-m-d', strtotime($to_date));
        $data['formDate'] = $from;
        $data['toDate'] = $to;
        if ($user_id == 'all') {
            $data['print_data'] = $printData = DB::select("SELECT * FROM `tbl_dollar_endorsement` WHERE date(created_date) >= '$from' AND date(created_date) <= '$to'");
        } else {
            $data['print_data'] = $printData = DB::select("SELECT * FROM `tbl_dollar_endorsement` WHERE `created_by` = '$user_id' AND date(created_date) >= '$from' AND date(created_date) <= '$to'");
        }
        $name = 'dollarEndorsement-details-' . $from . '-to-' . $to;
        if ($type == 3) {
            $rankings = collect($data['print_data']);
            $results = $rankings->chunk(13);

            $pdf = PDF::loadView('dollar.pdf_details', compact('results', 'from', 'to')); //load view page
            return $pdf->download($name . '.pdf'); // download pdf file
        } elseif ($type == 2 || $type == 1) {
            $excel_array[] = array('SL No', 'Applicant name', 'Passport', 'Card No', 'URN', 'Registration Number', 'Travel Card Amount (USD)', 'Commission (USD)', 'Service Charge (BDT)', 'Total (BDT)', 'R. User', 'Currency Rate', 'Date');
            $i = 0;
            foreach ($printData as $val) {
                $i++;
                $excel_array[] = array(
                    'SL No' => $i,
                    'Applicant name' => $val->a_name,
                    'Passport' => $val->passport_no,
                    'Card No' => $val->digit,
                    'URN' => $val->urn,
                    'Registration Number' => $val->serial_number,
                    'Travel Card Amount (USD)' => $val->f_currency,
                    'Commission (USD)' => $val->commission,
                    'Service Charge (BDT)' => $val->s_charge,
                    'Total (BDT)' => $val->t_amount,
                    'R. User' => $val->created_by,
                    'Currency Rate' => $val->c_rate,
                    'Date' => date('d-m-Y', strtotime($val->created_date))
                );
            }
            if ($type == 1) {
                $extension = 'csv';
            } elseif ($type == 2) {
                $extension = 'xlsx';
            }
            Excel::create($name, function ($excel) use ($excel_array) {

                $excel->setTitle('Dollar Endorsement Data');
                $excel->sheet('Table Data', function ($sheet) use ($excel_array) {
                    $sheet->fromArray($excel_array, null, 'A1', false, false);

                });

            })->download($extension);

        }

    }

    public function referred($type, $refer_id, $from, $to)
    {
        $data = array();
        $refer_id = $refer_id;
        $from_date = $from;
        $from = date('Y-m-d', strtotime($from_date));
        $to_date = $to;
        $to = date('Y-m-d', strtotime($to_date));
        $data['formDate'] = $from;
        $data['toDate'] = $to;
        if ($refer_id == 'all') {
            $data['print_data'] = $printData = DB::select("SELECT * FROM `tbl_dollar_endorsement` WHERE date(created_date) >= '$from' AND date(created_date) <= '$to'");
        } else {
            $data['print_data'] = $printData = DB::select("SELECT * FROM `tbl_dollar_endorsement` WHERE `refer_id` = '$refer_id' AND date(created_date) >= '$from' AND date(created_date) <= '$to'");
        }
        $name = 'dollarEndorsement-referred-' . $from . '-to-' . $to;
        if ($type == 3) {
            $rankings = collect($data['print_data']);
            $results = $rankings->chunk(18);

            $pdf = PDF::loadView('dollar.pdf_referred', compact('results', 'from', 'to')); //load view page
            return $pdf->download($name . '.pdf'); // download pdf file
        } elseif ($type == 2 || $type == 1) {
            $excel_array[] = array('SL No', 'Referrer ID', 'Name', 'Designation', 'Passport', 'Card No', 'URN', 'Date');
            $i = 0;
            foreach ($printData as $val) {
                $referrer = DB::table('tbl_dollarendorsement_reference')->where('refer_id', $val->refer_id)->first();
                if (isset($referrer) && !empty($referrer)) {
                    $refer_name = $referrer->name;
                    $designation = $referrer->designation;
                } else {
                    $refer_name = '';
                    $designation = '';
                }

                $i++;
                $excel_array[] = array(
                    'SL No' => $i,
                    'Referrer ID' => $val->refer_id,
                    'Name' => $refer_name,
                    'Designation' => $designation,
                    'Passport' => $val->passport_no,
                    'Card No' => $val->digit,
                    'URN' => $val->urn,
                    'Date' => date('d-m-Y', strtotime($val->created_date))
                );
            }
            if ($type == 1) {
                $extension = 'csv';
            } elseif ($type == 2) {
                $extension = 'xlsx';
            }
            Excel::create($name, function ($excel) use ($excel_array) {

                $excel->setTitle('Dollar Endorsement Data');
                $excel->sheet('Table Data', function ($sheet) use ($excel_array) {
                    $sheet->fromArray($excel_array, null, 'A1', false, false);

                });

            })->download($extension);

        }

    }

    public function summary_dollar($type, $user_id, $from, $to)
    {
        $data = array();
        $user_id = $user_id;
        $from_date = $from;
        $from = date('Y-m-d', strtotime($from_date));
        $to_date = $to;
        $to = date('Y-m-d', strtotime($to_date));
        $data['formDate'] = $from;
        $data['toDate'] = $to;
        if ($user_id == 'all') {
            $data['print_data'] = $printData = DB::select("SELECT SUM(`f_currency`) as dollar,SUM(`amount_bdt`) as bdt,SUM(`s_charge`) as charge,SUM(`t_amount`) as total,SUM(`commission`) as comm, count(*) as count_row, `created_date`,`created_by` FROM tbl_dollar_endorsement WHERE date(created_date) >='$from' AND date(created_date) <= '$to' GROUP BY date(created_date)");
        } else {
            $data['print_data'] = $printData = DB::select("SELECT SUM(`f_currency`) as dollar,SUM(`amount_bdt`) as bdt,SUM(`s_charge`) as charge,SUM(`t_amount`) as total,SUM(`commission`) as comm, count(*) as count_row, `created_date`,`created_by` FROM tbl_dollar_endorsement WHERE created_by='$user_id' AND date(created_date) >= '$from' AND date(created_date) <= '$to' GROUP BY date(created_date)");
        }

        $name = 'dollarEndorsement-summary-' . $from . '-to-' . $to;
        if ($type == 3) {
            $rankings = collect($data['print_data']);
            $results = $rankings->chunk(20);

            $pdf = PDF::loadView('dollar.pdf_summary', compact('results', 'from', 'to')); //load view page
            return $pdf->download($name . '.pdf'); // download pdf file
        } elseif ($type == 2 || $type == 1) {
            $excel_array[] = array('SL No', 'Date', 'Receiving User', 'Total Number of Card', 'Card Amount(USD)', 'Commission(USD)', 'Total Service Charge(BDT)', 'Total BDT');
            $i = 0;
            foreach ($printData as $val) {
                $i++;
                $excel_array[] = array(
                    'SL No' => $i,
                    'Date' => date('d-m-Y', strtotime($val->created_date)),
                    'Receiving User' => $val->created_by,
                    'Total Number of Card' => $val->count_row,
                    'Card Amount(USD)' => round($val->dollar, 2),
                    'Commission(USD)' => round($val->comm, 2),
                    'Total Service Charge(BDT)' => round($val->charge, 2),
                    'Total BDT' => round($val->total, 2),
                );
            }
            if ($type == 1) {
                $extension = 'csv';
            } elseif ($type == 2) {
                $extension = 'xlsx';
            }
            Excel::create($name, function ($excel) use ($excel_array) {

                $excel->setTitle('Dollar Endorsement Data');
                $excel->sheet('Table Data', function ($sheet) use ($excel_array) {
                    $sheet->fromArray($excel_array, null, 'A1', false, false);

                });

            })->download($extension);

        }
    }

    public function referred_summary($type, $refer_id, $from, $to)
    {
        $data = array();
        $refer_id = $refer_id;
        $from_date = $from;
        $from = date('Y-m-d', strtotime($from_date));
        $to_date = $to;
        $to = date('Y-m-d', strtotime($to_date));
        $data['formDate'] = $from;
        $data['toDate'] = $to;
        $data['refer_id'] = $refer_id;


        $name = 'dollarEndorsement-referred-summary-' . $from . '-to-' . $to;
        if ($type == 3) {

            $pdf = PDF::loadView('dollar.pdf_referred_summary', compact('refer_id', 'from', 'to')); //load view page
            return $pdf->download($name . '.pdf'); // download pdf file
        } elseif ($type == 2 || $type == 1) {
            $excel_array[] = array('SL', 'Referer ID', 'Name', 'Designation', 'Total Number of Card');
            if ($refer_id == 'all') {
                $refferer = DB::table('tbl_dollarendorsement_reference')->get();
            } else {
                $refferer = DB::table('tbl_dollarendorsement_reference')->where('refer_id', $refer_id)->get();
            }
            $i = 0;
            foreach ($refferer as $refer) {
                $i++;
                $result = DB::select("SELECT refer_id, COUNT(refer_id) as count_row FROM `tbl_dollar_endorsement` WHERE refer_id = '$refer->refer_id' AND date(`created_date`) >= '$from' AND date(`created_date`) <= '$to'");
                $excel_array[] = array(
                    'SL No' => $i,
                    'Referred ID' => $refer->refer_id,
                    'Name' => $refer->name,
                    'Designation' => $refer->designation,
                    'Total Number of Card' => $result[0]->count_row,
                );
            }


            if ($type == 1) {
                $extension = 'csv';
            } elseif ($type == 2) {
                $extension = 'xlsx';
            }
            Excel::create($name, function ($excel) use ($excel_array) {

                $excel->setTitle('Dollar Endorsement Data');
                $excel->sheet('Table Data', function ($sheet) use ($excel_array) {
                    $sheet->fromArray($excel_array, null, 'A1', false, false);

                });

            })->download($extension);

        }
    }

    public function details_rap_pap($type, $user_id, $ServiceType, $centerName, $from, $to)
    {
        $ServiceType = str_replace("-", "/", $ServiceType);

        $data = array();
        $user_id = $user_id;
        $from_date = $from;
        $from = date('Y-m-d', strtotime($from_date));
        $to_date = $to;
        $to = date('Y-m-d', strtotime($to_date));
        $data['formDate'] = $from;
        $data['toDate'] = $to;
        $sql = "SELECT * FROM tbl_port_update";
        $con1 = " WHERE ServiceType='$ServiceType'";
        $con2 = " AND cast(rec_cen_time as date) BETWEEN '$from' AND '$to'";

        if (($user_id == 'all') && ($centerName == 'all')) {
            $sql_common = $sql . $con1 . $con2;
        } else if (($user_id == 'all') && ($centerName !== 'all')) {
            $con3 = " AND center ='$centerName'";
            $sql_common = $sql . $con1 . $con2 . $con3;
        } else if (($user_id !== 'all') && ($centerName == 'all')) {
            $con4 = " AND rec_cen_by = '$user_id'";

            $sql_common = $sql . $con1 . $con2 . $con4;
        } else if (($user_id !== 'all') && ($centerName !== 'all')) {
            $con4 = " AND center = '$centerName'";
            $con5 = " AND rec_cen_by = '$user_id'";

            $sql_common = $sql . $con1 . $con2 . $con4 . $con5;
        } else {

            $sql_common = $sql . $con1 . $con2;
        }
        $data['print_data'] = $printData = DB::select($sql_common);

        $name = 'rap-pap-details-' . $from . '-to-' . $to;
        if ($type == 3) {
            $rankings = collect($data['print_data']);
            $results = $rankings->chunk(16);

            $pdf = PDF::loadView('rappap.pdf_details', compact('results', 'from', 'to')); //load view page
            return $pdf->download($name . '.pdf'); // download pdf file
        } elseif ($type == 2 || $type == 1) {
            $excel_array[] = array('SL', 'Applicant name', 'Passport', 'Master Passport','Center', 'Visa no', 'Visa type', 'Contact', 'Receive time', 'Receive by', 'Fee', 'Sticker', 'Entry Port', 'Area', 'Exit Port', 'Mode');
            $i = 0;
            foreach ($printData as $val) {
                $i++;
                $excel_array[] = array(
                    'SL' => $i,
                    'Applicant name' => $val->applicant_name,
                    'Passport' => $val->passport,
                    'Master Passport' => $val->MasterPP,
                    'Center' => $val->center,
                    'Visa no' => $val->visa_no,
                    'Visa type' => $val->visa_type,
                    'Contact' => $val->contact,
                    'Receive time' => $val->rec_cen_time,
                    'Receive by' => $val->rec_cen_by,
                    'Fee' => $val->Fee,
                    'Sticker' => $val->sticker,
                    'Entry Port' => $val->OldPort,
                    'Area' => $val->area,
                    'Exit Port' => $val->OldPort,
                    'Mode' => $val->mode,
                );
            }
            if ($type == 1) {
                $extension = 'csv';
            } elseif ($type == 2) {
                $extension = 'xlsx';
            }
            Excel::create($name, function ($excel) use ($excel_array) {

                $excel->setTitle('Rap Pap Details');
                $excel->sheet('Table Data', function ($sheet) use ($excel_array) {
                    $sheet->fromArray($excel_array, null, 'A1', false, false);

                });

            })->download($extension);

        }
    }

    public function receive_summary_rappap($type, $ServiceType, $from, $to)
    {
        $ServiceType = str_replace("-", "/", $ServiceType);

        $data = array();
        $from_date = $from;
        $from = date('Y-m-d', strtotime($from_date));
        $to_date = $to;
        $to = date('Y-m-d', strtotime($to_date));
        $data['formDate'] = $from;
        $data['toDate'] = $to;
        $data['print_data'] = $printData = DB::select("SELECT count(*) as count_row, `rec_cen_time` FROM tbl_port_update WHERE date(rec_cen_time) >='$from' AND date(rec_cen_time) <= '$to' and `ServiceType` = '$ServiceType' GROUP BY date(rec_cen_time)");
        $name = 'rap-pap-receive-summary-' . $from . '-to-' . $to;
        if ($type == 3) {
            $rankings = collect($data['print_data']);
            $results = $rankings->chunk(24);

            $pdf = PDF::loadView('rappap.pdf_receive_summary', compact('results', 'from', 'to', 'ServiceType', 'type')); //load view page
            return $pdf->download($name . '.pdf'); // download pdf file
        } elseif ($type == 2 || $type == 1) {
            $excel_array[] = array('SL', 'Date', 'Quantity');
            $i = 0;
            foreach ($printData as $val) {
                $i++;
                $excel_array[] = array(
                    'SL' => $i,
                    'Date' => date('d-m-Y', strtotime($val->rec_cen_time)),
                    'Quantity' => $val->count_row
                );
            }
            if ($type == 1) {
                $extension = 'csv';
            } elseif ($type == 2) {
                $extension = 'xlsx';
            }
            Excel::create($name, function ($excel) use ($excel_array) {

                $excel->setTitle('Rap Pap Receive Summary');
                $excel->sheet('Table Data', function ($sheet) use ($excel_array) {
                    $sheet->fromArray($excel_array, null, 'A1', false, false);

                });

            })->download($extension);

        }
    }

    public function approve_detail_rappap($type, $approveBy, $approve_status, $from, $to)
    {

        $data = array();
        $from_date = $from;
        $from = date('Y-m-d', strtotime($from_date));
        $to_date = $to;
        $to = date('Y-m-d', strtotime($to_date));
        $data['formDate'] = $from;
        $data['toDate'] = $to;

        $sql = " SELECT * FROM tbl_port_update ";
        $con1 = " WHERE approve_by ='$approveBy'";
        $con2 = " AND date(approve_date) BETWEEN '$from' AND '$to'";
        $con3 = " WHERE date(approve_date) BETWEEN '$from' AND '$to'";
        $con4 = " AND approve_status='$approve_status'";

        if (($approveBy == 'all') && ($approve_status == 'all')) {
            $sql_common = $sql . $con3;
        } else if (($approveBy == 'all') && ($approve_status !== 'all')) {

            if ($approve_status == 'Pending') {

                $con3 = " WHERE approve_status ='$approve_status'";
                $con5 = " AND  date(approve_date) BETWEEN '$from' AND '$to'";
                $sql_common = $sql . $con3 . $con5;
            } else if (($approve_status == 'Approved') || ($approve_status == 'Rejected')) {


                $con3 = " WHERE approve_status ='$approve_status'";
                $con5 = " AND  date(approve_date) BETWEEN '$from' AND '$to'";
                $sql_common = $sql . $con3 . $con5;
            }

        } else if (($approveBy !== 'all') && ($approve_status == 'all')) {


            $con6 = " WHERE approve_by  = '$approveBy'";
            $con5 = " AND  date(approve_date) BETWEEN '$from' AND '$to'";
            $sql_common = $sql . $con6 . $con5;

        } else if (($approveBy !== 'all') && ($approve_status !== 'all')) {
            $con4 = " WHERE approve_status = '$approve_status'";
            $con5 = " AND approve_by  = '$approveBy'";

            $sql_common = $sql . $con4 . $con5;
        } else

            $sql_common = $sql . $con1 . $con2;

        $data['print_data'] = $printData = DB::select($sql_common);

        $name = 'rap-pap-receive-summary-' . $from . '-to-' . $to;
        if ($type == 3) {
            $rankings = collect($data['print_data']);
            $results = $rankings->chunk(16);

            $pdf = PDF::loadView('rappap.pdf_approve_details', compact('results', 'from', 'to')); //load view page
            return $pdf->download($name . '.pdf'); // download pdf file
        } elseif ($type == 2 || $type == 1) {
            $excel_array[] = array('SL', 'Applicant name', 'Passport', 'Center', 'Visa no', 'Visa type', 'Contact', 'Approval Status', 'Approve Date', 'Approve By', 'Master Passport', 'Sticker', 'Entry port', 'Area', 'Exit port', 'Mode');
            $i = 0;
            foreach ($printData as $val) {
                $i++;
                $excel_array[] = array(
                    'SL' => $i,
                    'Applicant name' => $val->applicant_name,
                    'Passport' => $val->passport,
                    'Center' => $val->center,
                    'Visa no' => $val->visa_no,
                    'Visa type' => $val->visa_type,
                    'Contact' => $val->contact,
                    'Approval Status' => $val->approve_status,
                    'Approve Date' => $val->approve_date,
                    'Approve By' => $val->approve_by,
                    'Master Passport' => $val->MasterPP,
                    'Sticker' => $val->sticker,
                    'Entry port' => $val->OldPort,
                    'Area' => $val->area,
                    'Exit port' => $val->OldPort,
                    'Mode' => $val->mode
                );
            }
            if ($type == 1) {
                $extension = 'csv';
            } elseif ($type == 2) {
                $extension = 'xlsx';
            }
            Excel::create($name, function ($excel) use ($excel_array) {

                $excel->setTitle('Rap Pap Approve Details');
                $excel->sheet('Table Data', function ($sheet) use ($excel_array) {
                    $sheet->fromArray($excel_array, null, 'A1', false, false);

                });

            })->download($extension);

        }
    }

    public function rappap_all_report($type, $approve_status, $from, $to)
    {

        $data = array();
        $from_date = $from;
        $from = date('Y-m-d', strtotime($from_date));
        $to_date = $to;
        $to = date('Y-m-d', strtotime($to_date));
        $data['formDate'] = $from;
        $data['toDate'] = $to;

        $count = 1;
        while (strtotime($from) <= strtotime($to)) {
            $sql =
                "
					SELECT
						(SELECT COUNT(`approve_status`) FROM tbl_port_update WHERE CAST(`approve_date` AS DATE) = '$from' AND `approve_status` = 'Approved') as accept_total, '$from' as a_date,

						(SELECT COUNT(`approve_status`) FROM tbl_port_update WHERE CAST(`approve_date` AS DATE) = '$from' AND `approve_status` = 'Rejected') as reject_total, '$from' as a_date,

						(SELECT COUNT(`approve_status`)l FROM tbl_port_update WHERE CAST(`approve_date` AS DATE) = '$from' AND `approve_status` = 'Pending') as pending_total, '$from' as a_date
					";
            $arr_datas[] = DB::select($sql);
            $from = date("Y-m-d", strtotime("+1 day", strtotime($from)));
            $count++;
        }

        $data['print_data'] = $printData = $arr_datas;


        $name = 'rap-pap-all-report-' . $from . '-to-' . $to;
        if ($type == 3) {
            //$rankings = collect($arr_datas);
            $results = $arr_datas;

            $pdf = PDF::loadView('rappap.pdf_all_report', compact('results', 'from_date', 'to', 'approve_status')); //load view page
            return $pdf->download($name . '.pdf'); // download pdf file
        } elseif ($type == 2 || $type == 1) {
            if ($approve_status == 'all') {
                $excel_array[] = array('SL', 'Date', 'Approved', 'Rejected', 'Pending');
                $i = 0;
                foreach ($printData as $print) {
                    foreach ($print as $val) {
                        $i++;
                        $excel_array[] = array(
                            'SL' => $i,
                            'Date' => date('d-m-Y', strtotime($val->a_date)),
                            'Approved' => $val->accept_total,
                            'Rejected' => $val->reject_total,
                            'Pending' => $val->pending_total
                        );
                    }

                }
            } elseif ($approve_status == 'Approved') {
                $excel_array[] = array('SL', 'Date', 'Approved');
                $i = 0;
                foreach ($printData as $print) {
                    foreach ($print as $val) {
                        $i++;
                        $excel_array[] = array(
                            'SL' => $i,
                            'Date' => date('d-m-Y', strtotime($val->a_date)),
                            'Approved' => $val->accept_total
                        );
                    }

                }
            } elseif ($approve_status == 'Rejected') {
                $excel_array[] = array('SL', 'Date', 'Rejected');
                $i = 0;
                foreach ($printData as $print) {
                    foreach ($print as $val) {
                        $i++;
                        $excel_array[] = array(
                            'SL' => $i,
                            'Date' => date('d-m-Y', strtotime($val->a_date)),
                            'Rejected' => $val->reject_total
                        );
                    }

                }
            } elseif ($approve_status == 'Pending') {
                $excel_array[] = array('SL', 'Date', 'Pending');
                $i = 0;
                foreach ($printData as $print) {
                    foreach ($print as $val) {
                        $i++;
                        $excel_array[] = array(
                            'SL' => $i,
                            'Date' => date('d-m-Y', strtotime($val->a_date)),
                            'Pending' => $val->pending_total
                        );
                    }

                }
            }

            if ($type == 1) {
                $extension = 'csv';
            } elseif ($type == 2) {
                $extension = 'xlsx';
            }
            Excel::create($name, function ($excel) use ($excel_array) {

                $excel->setTitle('Rap Pap Approve Details');
                $excel->sheet('Table Data', function ($sheet) use ($excel_array) {
                    $sheet->fromArray($excel_array, null, 'A1', false, false);

                });

            })->download($extension);

        }
    }

    public function fee_collection($type, $from, $to)
    {
        $data = array();
        $from_date = $from;
        $from = date('Y-m-d', strtotime($from_date));
        $to_date = $to;
        $to = date('Y-m-d', strtotime($to_date));
        $data['formDate'] = $from;
        $data['toDate'] = $to;
        $data['print_data'] = $printData = DB::select("SELECT * FROM `tbl_fp_served` WHERE date(created_date) >= '$from' AND date(created_date) <= '$to'");
        $receipt = DB::select("SELECT book_no, MIN(`receive_no`) AS mini, MAX(`receive_no`) AS maxi FROM `tbl_fp_served` WHERE `book_no` IS NOT NULL AND `receive_no` IS NOT NULL AND date(created_date) >= '$from' AND date(created_date) <= '$to' GROUP BY book_no");
        $name = 'Foreign-passport-fee-collection-' . $from . '-to-' . $to;
        if ($type == 3) {
            $rankings = collect($data['print_data']);
            $results = $rankings->chunk(30);

            $pdf = PDF::loadView('foreign.pdf_fee_collection', compact('results', 'from', 'to','receipt')); //load view page
            return $pdf->download($name . '.pdf'); // download pdf file
        } elseif ($type == 2 || $type == 1) {
            $excel_array[] = array('SL', 'NAME OF APPLICANT', 'PASSPORT', 'Nationality', 'Receipt No', 'Visa Fee', 'Fax Trans. Charge', 'ICWF', 'Visa App. Charge', 'Total Amount', 'Remarks');
            $i = 0;
            foreach ($printData as $val) {
                $i++;
                if ($val->gratis_status == 'yes'){
                    $excel_array[] = array(
                        'SL No' => $i,
                        'NAME OF APPLICANT' => $val->app_name,
                        'PASSPORT' => $val->passport,
                        'Nationality' => $val->nationality,
                        'Receipt No' => $val->receive_no,
                        'Visa Fee' => 'GRATIS',
                        'Fax Trans. Charge' => $val->fax_trans_charge,
                        'ICWF' => $val->icwf,
                        'Visa App. Charge' => $val->visa_app_charge,
                        'Total Amount' =>$val->total_amount,
                        'Remarks' => $val->remarks
                    );
                }else{
                    if ($val->fax_trans_charge == 0 && $val->visa_fee != 0){
                        $minor = 'minor';
                    }else{
                        $minor = $val->fax_trans_charge;
                    }
                    $excel_array[] = array(
                        'SL No' => $i,
                        'NAME OF APPLICANT' => $val->app_name,
                        'PASSPORT' => $val->passport,
                        'Nationality' => $val->nationality,
                        'Receipt No' => $val->receive_no,
                        'Visa Fee' => $val->visa_fee,
                        'Fax Trans. Charge' => $minor,
                        'ICWF' => $val->icwf,
                        'Visa App. Charge' => $val->visa_app_charge,
                        'Total Amount' => $val->total_amount,
                        'Remarks' => $val->remarks
                    );
                }

            }
            if ($type == 1) {
                $extension = 'csv';
            } elseif ($type == 2) {
                $extension = 'xlsx';
            }
            Excel::create($name, function ($excel) use ($excel_array) {

                $excel->setTitle('Dollar Endorsement Data');
                $excel->sheet('Table Data', function ($sheet) use ($excel_array) {
                    $sheet->fromArray($excel_array, null, 'A1', false, false);

                });

            })->download($extension);

        }
    }

    public function foreign_details($type, $user_id, $from, $to){
        $data = array();
        $user_id = $user_id;
        $from_date = $from;
        $from = date('Y-m-d', strtotime($from_date));
        $to_date = $to;
        $to = date('Y-m-d', strtotime($to_date));
        $data['formDate'] = $from;
        $data['toDate'] = $to;
        if ($user_id == 'all') {
            $data['print_data'] = $printData = DB::select("SELECT * FROM `tbl_fp_served` WHERE date(created_date) >= '$from' AND date(created_date) <= '$to'");
        } else {
            $data['print_data'] = $printData = DB::select("SELECT * FROM `tbl_fp_served` WHERE `created_by` = '$user_id' AND date(created_date) >= '$from' AND date(created_date) <= '$to'");
        }
        $name = 'foreign-passport-details-' . $from . '-to-' . $to;
        if ($type == 3) {
//            $rankings = collect($data['print_data']);
//            $results = $rankings->chunk(13);
            $results = $data['print_data'];

            $pdf = PDF::loadView('foreign.pdf_details', compact('results', 'from', 'to')); //load view page
            return $pdf->download($name . '.pdf'); // download pdf file
        } elseif ($type == 2 || $type == 1) {
            $excel_array[] = array('SL No', 'Applicant name', 'Passport', 'Sticker No', 'Web File No.', 'Nationality',
                'Contact', 'Date of Checking', 'Remarks', 'Receipt No', 'Visa Fee','Fax Trans. Charge', 'ICWF','Visa App. Charge','Total','Created By','Date');
            $i = 0;
            foreach ($printData as $val) {
                $i++;
                if ($val->gratis_status == 'yes'){
                    $rec = 'GRATIS';
                    $minor = '';
                }else{
                    $rec = $val->receive_no;
                    if ($val->fax_trans_charge > 0){
                        $minor = $val->fax_trans_charge;
                    }else{
                        $minor = 'minor';
                    }
                }

                $excel_array[] = array(
                    'SL No' => $i,
                    'Applicant name' => $val->app_name,
                    'Passport' => $val->passport,
                    'Sticker No' => $val->strk_no,
                    'Web File No.' => $val->web_file_no,
                    'Nationality' => $val->nationality,
                    'Contact' => $val->contact,
                    'Date of Checking' => date('d-m-Y', strtotime($val->date_of_checking)),
                    'Remarks' => $val->remarks,
                    'Receipt No' => $rec,
                    'Visa Fee' => $val->visa_fee,
                    'Fax Trans. Charge' => $minor,
                    'ICWF' => $val->icwf,
                    'Visa App. Charge' => $val->visa_app_charge,
                    'Total' => $val->total_amount,
                    'Created By' => $val->created_by,
                    'Date' => date('d-m-Y', strtotime($val->created_date))
                );
            }
            if ($type == 1) {
                $extension = 'csv';
            } elseif ($type == 2) {
                $extension = 'xlsx';
            }
            Excel::create($name, function ($excel) use ($excel_array) {

                $excel->setTitle('Dollar Endorsement Data');
                $excel->sheet('Table Data', function ($sheet) use ($excel_array) {
                    $sheet->fromArray($excel_array, null, 'A1', false, false);

                });

            })->download($extension);

        }
    }


    public function foreign_summary($type, $user_id, $from, $to){
        $data = array();
        $user_id = $user_id;
        $from_date = $from;
        $from = date('Y-m-d', strtotime($from_date));
        $to_date = $to;
        $to = date('Y-m-d', strtotime($to_date));
        $data['formDate'] = $from;
        $data['toDate'] = $to;
        if ($user_id == 'all') {
            //$data['print_data'] = DB::select("SELECT * FROM `tbl_dollar_endorsement` WHERE `created_date` >= date('$from_date') AND `created_date` <= date('$to_date')");
            $data['print_data'] = $printData = DB::select("SELECT count(*) as count_row, `created_date`,`created_by` FROM tbl_fp_served WHERE date(created_date) >='$from' AND date(created_date) <= '$to' GROUP BY date(created_date)");
        } else {
            $data['print_data'] = $printData = DB::select("SELECT count(*) as count_row, `created_date`,`created_by` FROM tbl_fp_served WHERE created_by='$user_id' AND date(created_date) >= '$from' AND date(created_date) <= '$to' GROUP BY date(created_date)");
        }
        $name = 'foreign-passport-summary-' . $from . '-to-' . $to;
        if ($type == 3) {
            $results = $data['print_data'];

            $pdf = PDF::loadView('foreign.pdf_summary', compact('results', 'from', 'to')); //load view page
            return $pdf->download($name . '.pdf'); // download pdf file
        } elseif ($type == 2 || $type == 1) {
            $excel_array[] = array('Date','Quantity');
            foreach ($printData as $val) {

                $excel_array[] = array(
                    'Date' => date('d-m-Y', strtotime($val->created_date)),
                    'Quantity'=> $val->count_row
                );
            }
            if ($type == 1) {
                $extension = 'csv';
            } elseif ($type == 2) {
                $extension = 'xlsx';
            }
            Excel::create($name, function ($excel) use ($excel_array) {

                $excel->setTitle('Foreign Passport Data');
                $excel->sheet('Table Data', function ($sheet) use ($excel_array) {
                    $sheet->fromArray($excel_array, null, 'A1', false, false);

                });

            })->download($extension);

        }
    }

    public function details_port($type, $user_id, $ServiceType, $from, $to){
        $service = str_replace("-"," ",$ServiceType);
        $data = array();
        $user_id = $user_id;
        $from_date = $from;
        $from = date('Y-m-d', strtotime($from_date));
        $to_date = $to;
        $to = date('Y-m-d', strtotime($to_date));
        $data['formDate'] = $from;
        $data['toDate'] = $to;
        if ($user_id == 'all') {
            $data['print_data'] = $printData = DB::select("SELECT * FROM `tbl_port_update` WHERE ServiceType = '$service' AND date(rec_cen_time) >= '$from' AND date(rec_cen_time) <= '$to'");
        } else {
            $data['print_data'] = $printData = DB::select("SELECT * FROM `tbl_port_update` WHERE ServiceType = '$service' AND `rec_cen_by` = '$user_id' AND date(rec_cen_time) >= '$from' AND date(rec_cen_time) <= '$to'");
        }
        $name = 'port-endorsement-details-' . $from . '-to-' . $to;
        if ($type == 3) {
            $results = $data['print_data'];

            $pdf = PDF::loadView('portendorsement.pdf_details', compact('results', 'from', 'to')); //load view page
            return $pdf->download($name . '.pdf'); // download pdf file
        } elseif ($type == 2 || $type == 1) {
            $excel_array[] = array('SL', 'Applicant name', 'Passport', 'Center', 'Visa no', 'Visa type', 'Contact', 'Receive time', 'Receive by', 'Fee', 'Sticker', 'Entry Port', 'Exit Port');
            $i = 0;
            foreach ($printData as $val) {
                $i++;
                $excel_array[] = array(
                    'SL' => $i,
                    'Applicant name' => $val->applicant_name,
                    'Passport' => $val->passport,
                    'Center' => $val->center,
                    'Visa no' => $val->visa_no,
                    'Visa type' => $val->visa_type,
                    'Contact' => $val->contact,
                    'Receive time' => $val->rec_cen_time,
                    'Receive by' => $val->rec_cen_by,
                    'Fee' => $val->Fee,
                    'Sticker' => $val->sticker,
                    'Entry Port' => $val->OldPort,
                    'Exit Port' => $val->OldPort
                );
            }
            if ($type == 1) {
                $extension = 'csv';
            } elseif ($type == 2) {
                $extension = 'xlsx';
            }
            Excel::create($name, function ($excel) use ($excel_array) {

                $excel->setTitle('Port Endorsement Details');
                $excel->sheet('Table Data', function ($sheet) use ($excel_array) {
                    $sheet->fromArray($excel_array, null, 'A1', false, false);

                });

            })->download($extension);

        }
    }

    public function receive_summary_port($type, $ServiceType, $user_id, $from, $to)
    {
        $ServiceType = str_replace("-", " ", $ServiceType);

        $data = array();
        $from_date = $from;
        $from = date('Y-m-d', strtotime($from_date));
        $to_date = $to;
        $to = date('Y-m-d', strtotime($to_date));
        $data['formDate'] = $from;
        $data['toDate'] = $to;
        $data['user_id'] = $user_id;
        if ($user_id == 'all'){
            $data['print_data'] = $printData = DB::select("SELECT count(*) as count_row, `rec_cen_time` FROM tbl_port_update WHERE date(rec_cen_time) >='$from' AND date(rec_cen_time) <= '$to' and `ServiceType` = '$ServiceType' GROUP BY date(rec_cen_time)");
        } else{
            $data['print_data'] = $printData = DB::select("SELECT count(*) as count_row, `rec_cen_time` FROM tbl_port_update WHERE `rec_cen_by` = '$user_id' AND date(rec_cen_time) >='$from' AND date(rec_cen_time) <= '$to' and `ServiceType` = '$ServiceType' GROUP BY date(rec_cen_time)");
        }

        $name = 'port-endorsement-summary-' . $from . '-to-' . $to;
        if ($type == 3) {
            $rankings = collect($data['print_data']);
            $results = $rankings->chunk(24);

            $pdf = PDF::loadView('portendorsement.pdf_receive_summary', compact('results', 'from', 'to', 'ServiceType', 'user_id')); //load view page
            return $pdf->download($name . '.pdf'); // download pdf file
        } elseif ($type == 2 || $type == 1) {
            $excel_array[] = array('SL', 'Date', 'Quantity');
            $i = 0;
            foreach ($printData as $val) {
                $i++;
                $excel_array[] = array(
                    'SL' => $i,
                    'Date' => date('d-m-Y', strtotime($val->rec_cen_time)),
                    'Quantity' => $val->count_row
                );
            }
            if ($type == 1) {
                $extension = 'csv';
            } elseif ($type == 2) {
                $extension = 'xlsx';
            }
            Excel::create($name, function ($excel) use ($excel_array) {

                $excel->setTitle('Rap Pap Receive Summary');
                $excel->sheet('Table Data', function ($sheet) use ($excel_array) {
                    $sheet->fromArray($excel_array, null, 'A1', false, false);

                });

            })->download($extension);

        }
    }



}
