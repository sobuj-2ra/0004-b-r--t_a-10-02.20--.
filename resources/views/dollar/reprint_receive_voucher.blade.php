@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Dollar Endorsement
@endsection

<!--Page Header-->
@section('page-header')
    Dollar Endorsement - Reprint Receive Voucher
@endsection

<!--Page Content Start Here-->
@section('page-content')

    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                @if (Session::has('message'))
                    <div class="col-md-4 col-md-offset-4" style="padding-top:10px">
                        <div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4> {{ Session::get('message') }}</h4>
                        </div>
                    </div>
                @endif
                <div class="main_part">
                    <form action="{{url('/reprint-receive-voucher')}}" method="post" role="search">
                        {{ csrf_field() }}
                        <div class="passport_search">
                            <input type="search" name="q" value="" placeholder="Passport Search">
                            <button type="submit" class="btn_search">Search</button>
                        </div>
                    </form>
                    <div class="result_body">
                        <div class="result_table">
                            <?php if (isset($print_data) && !empty($print_data)){ ?>
                            <button value="Voucher Print" onclick="printDiv('printableArea')" class="btn_approved"> Reprint</button>
                            <br>
                            <br>

                            <br>
                            <style>

                            </style>
                            <div id="printableArea">
                                <meta name="csrf-token" content="{{ csrf_token() }}"/>
                                <section class="content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            {{--<div class="main_part">--}}
                                            <div class="result_body">
                                                <div class="result_table">
                                                    <div id="printableArea">
                                                        <div style="font-size:11px; padding-left: 3px;padding-right: 5px;padding-top: 0px;padding-bottom: 0px">
                                                            <table width="100%">
                                                                <tr>
                                                                    <td width="40%"><h4 style="font-weight: bold;margin: 0px !important;font-size: 17px;padding-top: 27px">State Bank of India <span style="font-size: 10px"><?php echo $print_data->branch_name ?> Branch</span></h4></td>
                                                                    <td width="40%" style="float: left"><img style="height: 50px; width: 100%" src="{{asset('public/assets/img/logo-sbi-sm.png') }}"></td>
                                                                    <td width="15%" style="padding-left: 40px !important;">ORIGINAL </td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="40%"><span style="font-size: 12px"><?php if (isset($address->address)){ echo $address->address; } ?></span></td>
                                                                    <td width="40%"></td>
                                                                    <td width="15%" style=""></td>
                                                                </tr>

                                                            </table>
                                                            <table width="100%">
                                                                <tr>
                                                                    <td width="75%"><span style="font-size: 12px">Phone: <?php if (isset($address->phone)){ echo $address->phone; } ?>, Fax: <?php if (isset($address->fax)){ echo $address->fax; } ?>, E-mail: <?php if (isset($address->email)){  echo $address->email; } ?></span></td>
                                                                    <td width="25%" style="font-size: 13px">Date: <?php echo date('F d, Y') ?></td>
                                                                </tr>
                                                            </table>
                                                            <br>
                                                            <table width="100%" style="border-spacing: 0px !important;">
                                                                <tr style="font-size: 14px">
                                                                    <td width="60%"><span style="font-size: 14px">Name: <?php echo $print_data->a_name; ?></span></td>
                                                                    <td width="25%" style="border: 1px solid #000;" class="borderSpace">Passport No: </td>
                                                                    <td width="15%" style="border: 1px solid #000;" class="borderSpace"><?php echo $print_data->passport_no; ?> </td>
                                                                </tr>
                                                                <tr style="font-size: 14px">
                                                                    <td width="60%"><span style="font-size: 14px">Date of Issue: <?php echo date('F d, Y', strtotime($print_data->date_of_issue)); ?></span></td>
                                                                    <td width="25%" style="border: 1px solid #000;" class="borderSpace">Place of Issue: </td>
                                                                    <td width="15%" style="border: 1px solid #000;" class="borderSpace"><?php echo $print_data->place_of_issue; ?> </td>
                                                                </tr>
                                                                <tr style="font-size: 14px">
                                                                    <td width="60%"><span style="font-size: 14px">Nationality: </span></td>
                                                                    <td width="25%" style="border: 1px solid #000;" class="borderSpace">Travel Card No: <span style="border-left: 1px solid #000;border-spacing: 0px;padding-left: 4px"></span>********</td>
                                                                    <td width="15%" style="border: 1px solid #000;" class="borderSpace"><?php $t_number = array_map('intval', str_split($print_data->digit)); $arr_count = count($t_number); echo $t_number[$arr_count-4].$t_number[$arr_count-3].$t_number[$arr_count-2].$t_number[$arr_count-1]; ?> </td>
                                                                </tr>
                                                            </table>
                                                            <table width="100%">
                                                                <tr>
                                                                    <td width="100%"><span style="font-size: 14px">We have sold / encashed the following foreign currencies to the above named person(s)</span></td>
                                                                </tr>
                                                            </table>
                                                            <table width="100%" style="border-spacing: 0px !important;font-size: 14px">
                                                                <tr>
                                                                    <td width="34%" style="border: 1px solid #000;text-align: center" class="borderSpace">FC Amount </td>
                                                                    <td width="11%" style="border: 1px solid #000;" class="borderSpace">&nbsp; <span style="padding: 5px"></span></td>
                                                                    <td width="55%" style="border: 1px solid #000;text-align: center" class="borderSpace">BDT Amount </td>
                                                                </tr>
                                                            </table>
                                                            <table width="100%" style="border-spacing: 0px !important;font-size: 14px; text-align: center">
                                                                <tr>
                                                                    <td width="10%" style="border-left: 1px solid #000;border-right: 1px solid #000;border-bottom: 1px solid #000;" class="borderSpace">Cash </td>
                                                                    <td width="10%" style="border-left: 1px solid #000;border-right: 1px solid #000;border-bottom: 1px solid #000;" class="borderSpace">Travel Card </td>
                                                                    <td width="10%" style="border-left: 1px solid #000;border-right: 1px solid #000;border-bottom: 1px solid #000;" class="borderSpace">Upload Fee</td>
                                                                    <td width="10%" style="border-left: 1px solid #000;border-right: 1px solid #000;border-bottom: 1px solid #000;" class="borderSpace">Conversion Rate</td>
                                                                    <td width="11%" style="border-left: 1px solid #000;border-right: 1px solid #000;border-bottom: 1px solid #000;text-align: center" class="borderSpace">Taka equivalent</td>
                                                                    <td width="9%" style="border-left: 1px solid #000;border-right: 1px solid #000;border-bottom: 1px solid #000;text-align: center" class="borderSpace">Charges</td>
                                                                    <td width="13%" style="border-left: 1px solid #000;border-right: 1px solid #000;border-bottom: 1px solid #000;text-align: center" class="borderSpace">Commission BDT(including 15% Vat) </td>
                                                                    <td width="15%" style="border-left: 1px solid #000;border-right: 1px solid #000;border-bottom: 1px solid #000;text-align: center" class="borderSpace">Total Taka Amt. </td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="10%" style="border-left: 1px solid #000;border-right: 1px solid #000;border-bottom: 1px solid #000;" class="borderSpace">$0.00 </td>
                                                                    <td width="10%" style="border-left: 1px solid #000;border-right: 1px solid #000;border-bottom: 1px solid #000; text-align: center" class="borderSpace">$<?php echo round($print_data->f_currency, 2); ?> </td>
                                                                    <td width="10%" style="border-left: 1px solid #000;border-right: 1px solid #000;border-bottom: 1px solid #000;text-align: center" class="borderSpace">$<?php echo round($print_data->commission, 2); ?></td>
                                                                    <td width="10%" style="border-left: 1px solid #000;border-right: 1px solid #000;border-bottom: 1px solid #000;text-align: center" class="borderSpace"><?php echo round($print_data->c_rate, 2); ?></td>
                                                                    <td width="11%" style="border-left: 1px solid #000;border-right: 1px solid #000;border-bottom: 1px solid #000;text-align: center" class="borderSpace"><?php $t_dollar = $print_data->f_currency + $print_data->commission; $t_amount = $t_dollar * $print_data->c_rate; echo round($t_amount, 2); ?></td>
                                                                    <td width="9%" style="border-left: 1px solid #000;border-right: 1px solid #000;border-bottom: 1px solid #000;text-align: center" class="borderSpace">-</td>
                                                                    <td width="12%" style="border-left: 1px solid #000;border-right: 1px solid #000;border-bottom: 1px solid #000;text-align: center" class="borderSpace"><?php echo round($print_data->s_charge, 2); ?></td>
                                                                    <td width="15%" style="border-left: 1px solid #000;border-right: 1px solid #000;border-bottom: 1px solid #000;text-align: center" class="borderSpace"><?php echo $total_amount = round($print_data->t_amount, 2); ?></td>
                                                                </tr>
                                                            </table>
                                                            <br>
                                                            <br>
                                                            <table width="100%" style="font-size: 14px">
                                                                <tr>
                                                                    <td width="13%">Receive Tk: </td>
                                                                    <td width="20%"><b><?php echo $total_amount = round($print_data->t_amount, 2); ?></b></td>
                                                                    <td width="67%"><b><?php $ser_sum= \App\Http\Controllers\DollarEndorsementController::convert_number_to_words($total_amount);
                                                                            echo ucfirst($ser_sum) ?></b></td>
                                                                </tr>
                                                            </table>
                                                            <br>
                                                            <br>
                                                            <table width="100%" style="font-size: 14px;">
                                                                <tr>
                                                                    <td>For <b>State Bank of India</b></td>
                                                                </tr>
                                                            </table>
                                                            <br>
                                                            <br>
                                                            <br>
                                                            <table width="100%" style="font-size: 14px;">
                                                                <tr>
                                                                    <td><i>Authorized Signatory</i></td>
                                                                </tr>
                                                            </table>
                                                            <br>
                                                            <table width="100%" style="font-size: 14px;">
                                                                <tr>
                                                                    <td>For issues or queries related to Travel Card:</td>
                                                                </tr>
                                                            </table>
                                                            <table width="100%" style="font-size: 14px;">
                                                                <tr>
                                                                    <td>Contact: <?php if (isset($address->enquery_phone)){ echo $address->enquery_phone; } ?></td>
                                                                    <td>Email: <?php if (isset($address->enquery_email)){ echo $address->enquery_email; } ?></td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{--</div>--}}
                                        </div>
                                    </div>
                                </section>

                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function printDiv(divName) {
            var css = '@page { size: portrait; }',
                head = document.head || document.getElementsByTagName('head')[0],
                style = document.createElement('style');

            style.type = 'text/css';
            style.media = 'print';

            if (style.styleSheet){
                style.styleSheet.cssText = css;
            } else {
                style.appendChild(document.createTextNode(css));
            }

            head.appendChild(style);
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>

    <script>
        //window.onload = printDiv('printableArea');
        $(window).on('afterprint', function () {
            window.location.href="{{ url("/reprint-receive-voucher") }}";
        });
    </script>
@endsection


