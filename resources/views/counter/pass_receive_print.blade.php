@extends('admin.master')
<!--Page Title-->
@section('page-title')
    
@endsection
<!--Page Header-->
@section('page-header')
   
@endsection

<!--Page Content Start Here-->
@section('page-content')

    <style>
        /*Print Slip*/

        @media print {
            @page {
                size: landscape;
            }

            .noprint {
                display: none;
            }

            /*#printableArea {*/
            /*display: block !important;*/
            /*font-size: 11px !important;*/
            /*}*/
            #p {
                padding: 0px 0px 0px 0px !important;
            }

        }

    </style>

    <div id="printableArea" style="display: none;">
        <?php for ($i = 1; $i <= $copy_qty; $i++){  ?>
        <table border=0 width="100%" class="tclass" style="padding: 0">
            <tr>
                <td colspan=2 class=text-center><strong>Indian Visa Application Center</strong></td>
            </tr>
            <tr>
                <td colspan=2 class=text-center>
                    <div class="centerdiv">{{$center_name}}</div>
                </td>
            </tr>
            <tr>
                <td colspan=2 class=text-center>
                    <div class="centerdiv2">Regular Passport Application</div>
                </td>
            </tr>

            <tr>
                <td>@php echo $now = date('d-M-Y'); @endphp</td>
                <td><span class=pull-right>@php echo date("h:i:s A"); @endphp</span></td>
            </tr>
            <tr>
                <td><hr style="font-weight: bold;color: #000;margin: 0px !important;border: 1px solid #000;"> <span style="font-size:18px;font-weight:bold">{{$sticker_type}}<span style="font-size: 16px;">{{$round_sticker}}</span></span></td>
                <td><hr style="font-weight: bold;color: #000;margin: 0px !important;border: 1px solid #000;"><span style="height:20px;display: inline-block"></span></td>
            </tr>
            <tr>
                <td colspan=2 class="text-center">
                    <div class="centerdiv2">
                        <center><svg id="bar_id"></svg></center>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan=2 style='margin: 105px 0'>
                    <div class="topborder"></div>
                    <strong>User :</strong> {{ $user}} <br/>
                    <strong>Counter :</strong> {{ $counter}} <br/>
                    <strong>Name:</strong> {{ $applicant_name}} <br/>
                    <strong>Passport:</strong> {{ $passport}} <br/>
                    <strong>Webfile No:</strong> {{ $webfile_no}} <br/>
                    <strong>Processing fee:</strong> {{ $proc_fee}} <br/>
                    <strong>Special fee:</strong> {{ $sp_fee}}
                    <strong>Corr fee:</strong> {{ $corFee}} <br/>
                    <strong>Total:</strong> {{ $total_pay}} <strong>Payment:</strong> {{ $payment}} <br/>
                    <strong>Visa Type:</strong> {{ $visa_type}} <br/>
                    <strong>Phone :</strong> {{ $contact}} <br/>
                    <strong>Fax:</strong> {{$fax}} <br/>
                    <strong>Info:</strong> {{$info}} <br/>
                    <strong>Delivery on or after:  </strong>{{  date('d-m-Y', strtotime($tdd))}}
                    <span class="float-right">{{$del_time}}</span>
                    </br>
                    <div class="topborder"></div>
                </td>
            </tr>
            <tr>
                <td><hr style="font-weight: bold;color: #000;margin: 0px !important;border: 1px solid #000;"></td>
                <td><hr style="font-weight: bold;color: #000;margin: 0px !important;border: 1px solid #000;"></td>
            </tr>
            <tr>
                <td>{{$center_web}}</td>
                <td><span class=pull-right>EasyQ</span></td>
            </tr>
        </table>
        <br>
        <script>
            JsBarcode("#bar_id", "<?php echo $BarcodeData; ?>", {
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
            var printContents = document.getElementById(pa).innerHTML;
            document.body.innerHTML = printContents;
            window.print();
        }
    </script>

    <script>
        <?php if (isset($id)){ ?>
            window.onload = printDiv('printableArea');
        $(window).on('afterprint', function () {
            {{--window.location.href = "{{ url("/portendorsement/$type/$form/$to/$id") }}";--}}
            window.close();
        });
        <?php } ?>
    </script>

    <script type="text/javascript">
        $(window).load(function () {
            //This execute when entire finished loaded
            window.print();
        });

    </script>


@endsection



