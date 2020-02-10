@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Foreign Passport
@endsection

<!--Page Header-->
@section('page-header')
    Foreign Passport
@endsection

<!--Page Content Start Here-->
@section('page-content')
    <style>
        /*Print Slip*/
        @media print {

            .noprint {
                display: none;
            }

            .noprintFooter {
                display: none;
            }

            #printableArea {
                display: block !important;
                font-size: 11px !important;

            }

            .topborder {
                width: 100%;
                border-top: 2px solid #000;
                margin: 5px 0;
            }

            .topmargin {
                margin-top: 0px;
            }

            .topmargin:first-child {
                margin-top: 0px;
            }

            .tclass {
                font-size: 11px !important;
            }

            .centerdiv {
                padding: 5px 0;
            }

            .centerdiv2 {
                margin-bottom: 5px;
            }

            table { /* Or specify a table class */
                overflow: hidden;
                page-break-after: always;
                font-size: 11px !important;

            }

        }

    </style>
    <div id="printableArea" style="display: none;">
        <?php for ($i =1; $i<=$service->slip_copy; $i++){ ?>
        <table border=0 width="100%" class="tclass" style="padding: 0">
            <tr>
                <td colspan=2 class="text-center"><strong>
                        <center>INDIAN VISA APPLICATION CENTRE</center>
                    </strong></td>
            </tr>
            <tr>
                <td colspan=2 class="text-center"><strong>
                        <center>{{ $val->center}}</center>
                    </strong></td>
            </tr>
            <tr>
                <td colspan=2 class="text-center">
                    <div class="centerdiv">
                        <center>STATEMENT OF VISA FEE COLLECTION</center>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan=2 class="text-center">
                    <div class="centerdiv2">
                        <center>Foreign Passport</center>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="text-left">@php echo $now = date('d-M-Y'); @endphp</td>
                <td><span class="text-right" style="float: right">@php echo date("h:i:s A"); @endphp</span></td>
            </tr>
            <tr>
                <td><hr style="font-weight: bold;color: #000;margin: 0px !important;border: 1px solid #000;"></td>
                <td><hr style="font-weight: bold;color: #000;margin: 0px !important;border: 1px solid #000;"></td>
            </tr>
            <tr>
                <td colspan=2 class="text-center">
                    <div class="centerdiv2">
                        <center><svg id="bar_id_<?php echo $i; ?>"></svg></center>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan=2 style='margin: 105px 0'>
                    <div class="topborder"></div>
                    <strong>Name:</strong> {{ $val->app_name}} <br/>
                    <strong>Contact:</strong> {{ $val->contact}} <br/>
                    <strong>Passport:</strong> {{ $val->passport}} <br/>
                    <strong>Web file No:</strong> {{ $val->web_file_no}} <br/>
                    <strong>Nationality:</strong> {{ $val->nationality}} <br/>
                    <strong>date of Checking:</strong> <?php echo date('d-m-Y', strtotime($val->date_of_checking)) ?> <br/>
                    <strong>Remarks:</strong> {{ $val->remarks}} <br/>
                    <strong>Visa fee:</strong> {{ $val->visa_fee}} tk<br/>
                    <strong>Fax trans. charge:</strong> {{ $val->fax_trans_charge}} tk<br/>
                    <strong>icwf:</strong> {{ $val->icwf}}tk <br/>
                    <strong>Visa app. charge:</strong> {{ $val->visa_app_charge}} <br/>
                    <strong>Total Amount:</strong> {{ $val->total_amount}} tk<br/>
                    <strong>Sticker:</strong> {{ $val->strk_no}} <br/>

                    <strong>Receiving Date:</strong><?php echo date('d-m-Y', strtotime($val->receiving_date)) ?> <br/>
                    <strong>Delivery on or after: <?php echo date('d-m-Y', strtotime($val->tdd)); ?> <?php if (isset($center->del_time) && !empty($center->del_time)){ echo $center->del_time; } ?></strong>

                    <div class="topborder"></div>
                </td>
            </tr>
            <tr>
                <td><hr style="font-weight: bold;color: #000;margin: 0px !important;border: 1px solid #000;"></td>
                <td><hr style="font-weight: bold;color: #000;margin: 0px !important;border: 1px solid #000;"></td>
            </tr>
            <tr>
                <td><?php if (isset($center->center_web) && !empty($center->center_web)){ echo $center->center_web; } ?></td>
                <td><span class="pull-right"></span></td>
            </tr>
        </table>
        <br>
            <script>
                JsBarcode("#bar_id_<?php echo $i; ?>", "<?php echo $val->web_file_no; ?>", {
                        height: 25,
                        width: 1.5,
                        margin: 10,
                        fontSize: 11,
                    }
                );
            </script>
        <?php } ?>

    </div>

    <script>
        function printDiv(pa) {
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
            var printContents = document.getElementById(pa).innerHTML;
            document.body.innerHTML = printContents;
            window.print();
        }
    </script>
    <script>
        <?php if (isset($id)){ ?>
            window.onload = printDiv('printableArea');
        $(window).on('afterprint', function () {
                window.location.href="{{ url("/edit-receive-foreign-passport") }}";
        });
        <?php } ?>
    </script>
    <script>
        $(window).on('afterprint', function () {
            window.location.reload(true);
        });
    </script>
@endsection