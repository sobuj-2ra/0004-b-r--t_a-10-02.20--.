@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Foreign Passport
@endsection

<!--Page Header-->
@section('page-header')
    Foreign Passport Reports
@endsection

<!--Page Content Start Here-->
@section('page-content')
    <?php
    $from = date('d-m-Y', strtotime($formDate));
    $to = date('d-m-Y', strtotime($toDate));
    ?>
    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="main_part">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-2" style="padding-right: 40px;">
                            <button type="submit" class="btn btn-primary pull-right"
                                    style="padding: 7px 22px;margin:10px" onclick="visaDiv('visaDiv')"
                                    style="margin-right:10px;">Visa & Telex/Fax App.
                            </button>
                        </div>
                        <div class="col-md-1" style="padding-right: 0px;">
                            <button type="submit" class="btn btn-primary pull-right" style="padding: 7px 22px;margin:10px" onclick="icwfDiv('icwfDiv')">ICWF App.
                            </button>
                        </div>
                        <div class="col-md-2" style="padding-right: 6px;">
                            <button type="submit" class="btn btn-primary pull-left"
                                    style="padding: 7px 22px;margin:10px" onclick="sendingDiv('sendingDiv')"
                                    style="margin-right:10px;">Sending Status Print
                            </button>
                        </div>
                        <div class="col-md-1" style="padding: 0px;">
                            <a href="{{URL::to('/fee-collection/1/'.$from.'/'.$to)}}">
                                <button style="padding: 7px 22px;margin:10px;" type="button"
                                        class="btn btn-primary pull-right">CSV
                                </button>
                            </a>
                        </div>
                        <div class="col-md-1" style="padding: 0px;">
                            <a href="{{URL::to('/fee-collection/2/'.$from.'/'.$to)}}">
                                <button style=" padding: 7px 22px;margin:10px;" type="button"
                                        class="btn btn-primary pull-right">EXCEL
                                </button>
                            </a>
                        </div>
                        <div class="col-md-1" style="padding: 0px;">
                            <a href="{{URL::to('/fee-collection/3/'.$from.'/'.$to)}}">
                                <button style="padding: 7px 22px;margin:10px;" type="button"
                                        class="btn btn-primary pull-right">PDF
                                </button>
                            </a>
                        </div>
                        <div class="col-md-1" style="padding-right: 6px;">
                            <button type="submit" class="btn btn-primary pull-right"
                                    style="padding: 7px 22px;margin:10px" onclick="printDiv('printableArea')"
                                    style="margin-right:10px;">Print
                            </button>
                        </div>
                    </div>
                    <!-- Code Here.... -->
                    <div id="printableArea">
                        <style type="text/css" media="print">
                            @page { size: landscape;
                            }
                            table {
                                empty-cells: show;
                                border: 2px solid #000;
                            }

                            table td,
                            table th {
                                min-width: 2em;
                                min-height: 2em;
                                border: 2px solid #000;
                            }
                        </style>
                        <div class="table_view" style="padding: 10px">
                            <h3 align="center">INDIAN VISA APPLICATION CENTRE - <?php if (isset($center->center_name)){ echo strtoupper($center->center_name);} ?></h3>
                            <h5 align="center">STATEMENT OF VISA FEE COLLECTION <?php
                                if ($from == $to){ echo $from; }else{ echo $from.' - '.$to; } ?>  <span style="font-size: 9px">TODAY USED RECEIPT <?php
                                    if (isset($receipt) && !empty($receipt)){

                                        foreach ($receipt as $rec){
                                            if ( isset($rec->book_no) && $rec->mini != 'NULL' && !empty($rec->book_no) && $rec->book_no != ' '){
                                                echo '('.$rec->book_no.')'.' '.$rec->mini.' - '.$rec->maxi.' ';
                                            }

                                        }
                                    }
                                ?></span></h5>
                            <br>
                            <div class="panel-body">
                                <table width="100%" class="table-bordered table" style="font-size:14px;">

                                    <thead>
                                    <tr>
                                        <th rowspan="2"></th>
                                        <th rowspan="2">NAME OF APPLICANT</th>
                                        <th rowspan="2">PASSPORT</th>
                                        <th colspan="8" style="text-align: center"> Fee Collected</th>
                                    </tr>
                                    <tr>
                                        <th>Nationality</th>
                                        <th>Receipt No</th>
                                        <th>Visa Fee</th>
                                        <th>Fax Trans. Charge</th>
                                        <th>ICWF</th>
                                        <th>Visa App. Charge</th>
                                        <th>Total Amount</th>
                                        <th>Remarks</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $visa_fee = 0;
                                    $fax = 0;
                                    $icwf_fee = 0;
                                    $visa_app = 0;
                                    $total_tk = 0;
                                    $icwf_rupee = 0;
                                    $tlex_rupee = 0;
                                    $fax_rupee = 0;
                                    $visa_rupee = 0;
                                    $i=0; foreach ($print_data as $print){ $i++; ?>
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$print->app_name}}</td>
                                        <td>{{$print->passport}}</td>
                                        <td>{{$print->nationality}}</td>
                                        <td><?php
                                        echo $print->receive_no;

                                        ?></td>
                                        <?php if ($print->gratis_status == 'yes'){ ?>
                                        <td>GRATIS</td>
                                        <?php }else{ ?>
                                        <td><span style="float: right;"><?php $visa_fee += round($print->visa_fee, 2); echo round($print->visa_fee,2); ?></span></td>
                                        <?php } ?>
                                        <td><span style="float: right;"><?php $fax += round($print->fax_trans_charge, 2);  if( $print->fax_trans_charge == 0 && $print->visa_fee != 0){ echo 'Minor'; }else{ echo round($print->fax_trans_charge,2); } ?></span></td>
                                        <td><span style="float: right;"><?php $icwf_fee +=round($print->icwf,2); echo round($print->icwf, 2)  ?></span></td>
                                        <td><span style="float: right;"><?php $visa_app += round($print->visa_app_charge, 2); echo round($print->visa_app_charge, 2); ?></span></td>
                                        <td><span style="float: right;"><?php $total_tk += round($print->total_amount,2); echo round($print->total_amount, 2); ?></span></td>
                                        <td>{{$print->remarks}}</td>
                                        <?php  $icwf_rupee += $print->icwf * $print->rupee_rate;
                                        $fax_rupee += $print->fax_trans_charge * $print->rupee_rate;
                                        $visa_rupee += ($print->visa_fee + $print->visa_app_charge) * $print->rupee_rate;
                                        $tlex_rupee += round($print->visa_fee + $print->visa_app_charge + $print->fax_trans_charge,2) * $print->rupee_rate;
                                        ?>
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tfooter>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th><span style="float: right;"><?php echo number_format(round($visa_fee)) ?></span></th>
                                        <th><span style="float: right;"><?php echo number_format(round($fax)); ?></span></th>
                                        <th><span style="float: right;"><?php echo number_format(round($icwf_fee)); ?></span></th>
                                        <th><span style="float: right;"><?php echo number_format(round($visa_app)); ?></span></th>
                                        <th><span style="float: right;"><?php echo number_format(round($total_tk)); ?></span></th>
                                        <th></th>
                                    </tfooter>
                                    </tbody>
                                    </tbody>
                                </table>
                                <br>
                                <br>
                                <div  style="width: 100%;">
                                    <span style="width: 70%;font-weight: bold;">Amount in words: Taka
                                        <?php $t_taka_amount=$total_tk; $words = \App\Http\Controllers\DollarEndorsementController::convert_number_to_words(round($t_taka_amount)); echo ucfirst($words); ?>  Only
                                        <br>Visa Section, HCI, <?php if (isset($center->center_name)){ echo $center->center_name;} ?> and Accounts Section, HCI,  <?php if (isset($center->center_name)){ echo $center->center_name;} ?>.</span>
                                    <span style="float: right;width: 30%;font-weight: bold;"> Dy.COO / Manager (Operations) <br>Indian Visa Application Centre<br><span style="padding-left: 65px"><?php if (isset($center->center_name)){ echo strtoupper($center->center_name);} ?></span></span>
                                </div>
                                <!-- /.table-responsive -->

                            </div>
                        </div>
                    </div>
                    <div id="sendingDiv" style="display: none">
                        <style type="text/css" media="print">
                            @page { size: landscape;
                            }
                            table {
                                empty-cells: show;
                                border: 2px solid #000;
                            }

                            table td,
                            table th {
                                min-width: 2em;
                                min-height: 2em;
                                border: 2px solid #000;
                            }
                        </style>
                        <div class="table_view" style="padding: 10px">
                            <h3 align="center">DAILY FOREIGN PASSPORT SENDING STATUS</h3>
                            <h5 align="center">INDIAN VISA APPLICATION CENTRE &nbsp;&nbsp;&nbsp; Date: <?php if ($from == $to){ echo $from; }else{ echo $from.' - '.$to; } ?> </h5>
                            <h5 align="center"><?php if (isset($center->center_name)){ echo strtoupper($center->center_name);} ?></h5>
                            <br>
                            <div class="panel-body">
                                <table width="100%" class="table-bordered table" style="font-size:14px;">

                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>NAME</th>
                                        <th>Passport Num</th>
                                        <th>Nationality</th>
                                        <th>Date of Receiving</th>
                                        <th>Sticker No.</th>
                                        <th>Rec. No.</th>
                                        <th>Date of Checking </th>
                                        <th>Contact No.</th>
                                        <th>Remarks</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i=0; foreach ($print_data as $print){ $i++; ?>
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$print->app_name}}</td>
                                        <td>{{$print->passport}}</td>
                                        <td>{{$print->nationality}}</td>
                                        <td><?php echo date('d.m.Y', strtotime($print->created_date)) ?></td>
                                        <?php if ($print->gratis_status == 'yes'){ ?>
                                        <td>{{$print->strk_no}}</td>
                                        <td><?php if (isset($print->receive_no) && !empty($print->receive_no) && $print->receive_no != NULL){ echo $print->receive_no.' -'; } ?> GRATIS</td>
                                        <?php }else{ ?>
                                        <td><?php echo $print->strk_no; ?></td>
                                        <td><?php echo $print->receive_no; ?></td>
                                        <?php } ?>
                                        <td><?php echo date('d-m-Y', strtotime($print->date_of_checking)) ?></td>
                                        <td>{{$print->contact}}</td>
                                        <td>{{$print->remarks}}</td>
                                    </tr>
                                    <?php } ?>
                                    </tbody>
                                    </tbody>
                                </table>
                                <!-- /.table-responsive -->

                            </div>
                        </div>
                    </div>
                    <div id="visaDiv" style="display: none;">
                        <style type="text/css" media="print">
                            @page { size: portrait;
                            }
                        </style>
                        <div class="table_view" style="padding: 10px">
                            <h5 style="float: right;font-weight: bold">(Foreign Wing) </h5>
                            <h3 align="center">INDIAN VISA APPLICATION CENTRE </h3>
                            <h3 align="center" style="line-height: 0px"><?php if (isset($center->center_name)){ echo strtoupper($center->center_name);} ?> &nbsp;&nbsp;&nbsp;&nbsp;</h3>
                            <h5 style="float: right"> Date: <?php if ($from == $to){ echo $from; }else{ echo $from.' - '.$to; } ?> </h5>
                            <br>
                            <div class="panel-body">
                                <table width="100%" class="" style="font-size:14px;">
                                    <tbody>
                                        <tr>
                                            <td colspan="12">To</td>
                                        </tr>
                                        <tr>
                                            <td colspan="12">The Cashier</td>
                                        </tr>
                                        <tr>
                                            <td colspan="12">High Commission of India</td>
                                        </tr>
                                        <tr>
                                            <td colspan="12">
                                                <?php
                                                    if ($c_name == 'Dhaka' || $c_name == 'Mymensingh' || $c_name == 'Barisal' || $c_name == 'JFP'){
                                                        echo 'Dhaka';
                                                    }else if ($c_name == 'Chattogram' || $c_name == 'Commilla' || $c_name == 'Noakhali' || $c_name == 'Brahmanbaria' || $c_name == 'Chittagong'){
                                                        echo 'Chittagong';
                                                    }else if($c_name == 'Rajshahi' || $c_name == 'Rangpur' || $c_name == 'Bogra' || $c_name == 'Thakurgaon'){
                                                        echo 'Rajshahi';
                                                    }else if ($c_name == 'Khulna' ){
                                                        echo 'Khulna';
                                                    }else if ($c_name == 'Sylhet'){
                                                        echo 'Sylhet';
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="padding-bottom: 70px">Through: Visa wing</td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="font-weight: bold;font-size: 15px; padding-bottom: 50px">Please receive from IVAC the sum of BD Taka <?php $visa_total = $visa_fee + $visa_app+$fax; echo number_format($visa_total).'/-' ?> (Taka <?php $visa_total_word = \App\Http\Controllers\DollarEndorsementController::convert_number_to_words(round($visa_total)); echo ucfirst($visa_total_word).' Only'; ?>) equivalent to Rs.<?php echo number_format($tlex_rupee); ?>/- (Rupees <?php $visa_total_word_rupee = \App\Http\Controllers\DollarEndorsementController::convert_number_to_words(round($tlex_rupee)); echo ucfirst($visa_total_word_rupee).' Only'; ?>)</td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="padding-bottom: 100px">On account of Cash received from foreign passport holders as visa fee & telex/fax charges in connection with issuance of visa to foreigners. The amount has been deposited in Mission's A/C No. 05420023920001</td>
                                        </tr>
                                        <tr style="font-weight: bold;">
                                            <td></td>
                                            <td></td>
                                            <td style="text-decoration: underline;text-align: center;width: 25%">Taka Amount</td>
                                            <td style="text-decoration: underline;text-align: center;width: 25%">Rs. Amount</td>
                                            <td style="text-decoration: underline;text-align: center;width: 15%">Receipt No</td>
                                        </tr>
                                        <tr style="font-weight: bold;">
                                            <td>1. </td>
                                            <td>TLX</td>
                                            <td style="text-align: center"><?php echo round($fax,2) ?></td>
                                            <td style="text-align: center"><?php echo round($fax_rupee,2); ?></td>
                                            <td style="text-align: center"></td>
                                        </tr>
                                        <tr style="font-weight: bold;">
                                            <td>2. </td>
                                            <td>VISA</td>
                                            <td style="text-decoration: underline;text-align: center;"><?php echo $t_visa = round($visa_fee + $visa_app,2); ?></td>
                                            <td style="text-decoration: underline;text-align: center"><?php echo round($visa_rupee,2); ?></td>
                                            <td style="text-align: center">
                                                <?php
                                                if (isset($receipt) && !empty($receipt)){
                                                    foreach ($receipt as $rec){
                                                        if (isset($rec->book_no) && !empty($rec->book_no) && $rec->mini != 'NULL' && $rec->book_no != ' '){
                                                        echo '('.$rec->book_no.')'.' '.$rec->mini.' - '.$rec->maxi.'<br>';
                                                        }
                                                    }
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr style="font-weight: bold;">
                                            <td></td>
                                            <td></td>
                                            <td style="text-align: center; text-decoration:underline double;"><?php echo round($visa_total); ?></td>
                                            <td style="text-decoration: underline double;text-align: center"><?php echo round($tlex_rupee) ?></td>
                                            <td style="text-align: center"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="6"></td>
                                            <td colspan="6" style="padding-top: 60px;text-align: center;font-weight: bold"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="6"></td>
                                            <td colspan="6" style="text-align: center;font-weight: bold;">Dy.COO/Manager (Operation)</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6"></td>
                                            <td colspan="12" style="text-align: center;font-weight: bold">Indian Visa Application Centre</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6"></td>
                                            <td colspan="12" style="text-align: center;font-weight: bold"><?php if (isset($center->center_name)){ echo strtoupper($center->center_name);} ?> </td>
                                        </tr>

                                    </tbody>
                                    </tbody>
                                </table>
                                <br>
                                <br>
                                <br>
                                <table width="100%" style="font-size: 14px">
                                    <tr>
                                        <td>Credit Item No. ............................... Dated .............................. Received by</td>
                                    </tr>
                                    <tr>
                                        <td>sum BD Taka ................................... equivalent to Rs.  ................................</td>
                                    </tr>
                                    <tr>
                                        <td>The Item No. under which the amount is shown in the main cash Book may given here.</td>
                                    </tr>
                                </table>
                                <!-- /.table-responsive -->

                            </div>
                        </div>
                    </div>
                    <div id="icwfDiv" style="display: none;">
                        <style type="text/css" media="print">
                            @page { size: portrait;
                            }
                        </style>
                        <div class="table_view" style="padding: 10px">
                            <h5 style="float: right;font-weight: bold">(Foreign Wing) </h5>
                            <h3 align="center">INDIAN VISA APPLICATION CENTRE </h3>
                            <h3 align="center" style="line-height: 0px"><?php if (isset($center->center_name)){ echo strtoupper($center->center_name); }  ?> &nbsp;&nbsp;&nbsp;&nbsp;</h3>
                            <h5 style="float: right"> Date: <?php if ($from == $to){ echo $from; }else{ echo $from.' - '.$to; } ?> </h5>
                            <br>
                            <div class="panel-body">
                                <table width="100%" class="" style="font-size:14px;">
                                    <tbody>
                                    <tr>
                                        <td colspan="12">To</td>
                                    </tr>
                                    <tr>
                                        <td colspan="12">The Cashier</td>
                                    </tr>
                                    <tr>
                                        <td colspan="12">High Commission of India</td>
                                    </tr>
                                    <tr>
                                        <td colspan="12">
                                            <?php
                                            if ($c_name == 'Dhaka' || $c_name == 'Barisal' || $c_name == 'JFP' || $c_name == 'Dhaka JFP' || $c_name == 'Jessore' || $c_name == 'Satkhira'){
                                                echo 'Dhaka';
                                            }else if ($c_name == 'Chattogram' || $c_name == 'Commilla' || $c_name == 'Noakhali' || $c_name == 'Brahmanbaria' || $c_name == 'Chittagong'){
                                                echo 'Chittagong';
                                            }else if($c_name == 'Rajshahi' || $c_name == 'Rangpur' || $c_name == 'Bogra' || $c_name == 'Thakurgaon'){
                                                echo 'Rajshahi';
                                            }else if ($c_name == 'Khulna' ){
                                                echo 'Khulna';
                                            }else if ($c_name == 'Sylhet'  || $c_name == 'Mymensingh'){
                                                echo 'Sylhet';
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="12"  style="padding-bottom: 70px">Through: Visa wing</td>
                                    </tr>
                                    <tr>
                                        <td colspan="12" style="font-weight: bold;font-size: 15px; padding-bottom: 50px">Please receive from IVAC the sum of BD Taka <?php  echo number_format($icwf_fee).'/-' ?> (Taka <?php $icwf_total_word = \App\Http\Controllers\DollarEndorsementController::convert_number_to_words(round($icwf_fee)); echo ucfirst($icwf_total_word).' Only'; ?>) equivalent to Rs. <?php $icwf_rupee_unfrt = round($icwf_rupee); $icwf_rupees = $icwf_rupee_unfrt; echo number_format($icwf_rupee_unfrt);  ?>/- (Rupees <?php $icwf_total_word_rupee = \App\Http\Controllers\DollarEndorsementController::convert_number_to_words(round($icwf_rupee_unfrt)); echo ucfirst($icwf_total_word_rupee).' Only'; ?>).</td>
                                    </tr>
                                    <tr>
                                        <td colspan="12" style="padding-bottom: 100px">On account of Cash received from foreign passport holders towards their contribution to ICWF. The amount has been deposited in Mission's A/C No. 05420216820001</td>
                                    </tr>
                                    <tr style="font-weight: bold;">
                                        <td></td>
                                        <td></td>
                                        <td style="text-decoration: underline;text-align: center;width: 22%">Taka Amount</td>
                                        <td style="text-decoration: underline;text-align: center;width: 22%">Rs. Amount</td>
                                        <td style="text-decoration: underline;text-align: center;width: 15%">Receipt No</td>
                                    </tr>
                                    <tr style="font-weight: bold;">
                                        <td>1.  </td>
                                        <td style="padding-left: 10px"> ICWF</td>
                                        <td style="text-align: center"><?php echo round($icwf_fee) ?></td>
                                        <td style="text-align: center"><?php echo $icwf_rupees; ?></td>
                                        <td style="text-align: center"><?php
                                            if (isset($receipt) && !empty($receipt)){
                                                foreach ($receipt as $rec){
                                                    if (isset($rec->book_no) && !empty($rec->book_no) && $rec->mini != 'NULL' && $rec->book_no != ' '){
                                                    echo '('.$rec->book_no.')'.' '.$rec->mini.' - '.$rec->maxi.'<br>';
                                                    }
                                                }
                                            }
                                            ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6"></td>
                                        <td colspan="6" style="padding-top: 60px;text-align: center;font-weight: bold"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6"></td>
                                        <td colspan="6" style="text-align: center;font-weight: bold">Dy.COO/Manager (Operation)</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6"></td>
                                        <td colspan="12" style="text-align: center;font-weight: bold">Indian Visa Application Centre</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6"></td>
                                        <td colspan="12" style="text-align: center;font-weight: bold"><?php if (isset($center->center_name)){ echo strtoupper($center->center_name);} ?></td>
                                    </tr>

                                    </tbody>
                                    </tbody>
                                </table>
                                <br>
                                <br>
                                <br>
                                <table width="100%" style="font-size: 14px">
                                    <tr>
                                        <td>Credit Item No. ............................... Dated .............................. Received by</td>
                                    </tr>
                                    <tr>
                                        <td>sum BD Taka ................................... equivalent to Rs.  ................................</td>
                                    </tr>
                                    <tr>
                                        <td>The Item No. under which the amount is shown in the main cash Book may given here.</td>
                                    </tr>
                                </table>
                                <!-- /.table-responsive -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection


<script type="text/javascript">
    function printDiv(printableArea) {
        var printContents = document.getElementById(printableArea).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>
<script type="text/javascript">
    function sendingDiv(sendingDiv) {
        var printContents = document.getElementById(sendingDiv).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
    function visaDiv(visaDiv) {
        var printContents = document.getElementById(visaDiv).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
    function icwfDiv(icwfDiv) {
        var printContents = document.getElementById(icwfDiv).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>