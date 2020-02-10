@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Port Endorsment
@endsection
<!--Page Header-->
@section('page-header')
    Port Endorsement Form
@endsection

<!--Page Content Start Here-->
@section('page-content')
    <style>
        /*Print Slip*/

        @media print {
            @page { size: landscape; }
            .noprint {
                display: none;
            }

            /*#printableArea {*/
            /*display: block !important;*/
            /*font-size: 11px !important;*/

            /*}*/

            #p{
                padding: 0px 0px 0px 0px !important;
            }

        }

    </style>

    <div id="printableArea" style="display: none;">
        <?php for ($i = 1; $i <= $fee->slip_copy; $i++){ ?>
        <table border=0 width="100%" class="tclass" style="padding: 0">
            <tr>
                <td colspan=2 class=text-center><strong>Indian Visa Application Center</strong></td>
            </tr>
            <tr>
                <td colspan=2 class=text-center>
                    <div class="centerdiv">{{$print_details[0]->center_name}}</div>
                </td>
            </tr>
            <tr>
                <td colspan=2 class=text-center>
                    <div class="centerdiv2">Port Endorsement Application</div>
                </td>
            </tr>
            <tr>
                <td>@php echo $now = date('d-M-Y'); @endphp</td>
                <td><span class=pull-right>@php echo date("h:i:s A"); @endphp</span></td>
            </tr>
            <tr>
                <td><hr style="font-weight: bold;color: #000;margin: 0px !important;border: 1px solid #000;"></td>
                <td><hr style="font-weight: bold;color: #000;margin: 0px !important;border: 1px solid #000;"></td>
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
                    <strong>Name:</strong> {{ $print_details[0]->applicant_name}} <br/>
                    <strong>Contact:</strong> {{ $print_details[0]->contact}} <br/>
                    <strong>Passport:</strong> {{ $print_details[0]->passport}} <br/>
                    <strong>Visa No:</strong> {{ $print_details[0]->visa_no}} <br/>
                    <strong>Visa Type:</strong> {{ $print_details[0]->visa_type}} <br/>
                    <strong>Old Port:</strong> {{ $print_details[0]->OldPort}} <br/>
                    <strong>New Port:</strong> {{ $print_details[0]->NewPort}} <br/>
                    <strong>Sticker:</strong> {{ $print_details[0]->sticker}} <br/>
                    <strong>Fee:</strong> {{ $print_details[0]->Fee}} <br/>
                    <strong>Phone:</strong> {{ $print_details[0]->center_phone}} <br/>
                    <strong>Info:</strong> {{$print_details[0]->center_info}} <br/>
                    <strong>Delivery on or after: {{ $print_details[0]->tdd}} </strong>
                    </br>
                    <strong></strong> {{date('d-m-Y', strtotime( $print_details[0]->del_time))}} <br/>

                    <div class="topborder"></div>
                </td>
            </tr>
            <tr>
                <td><hr style="font-weight: bold;color: #000;margin: 0px !important;border: 1px solid #000;"></td>
                <td><hr style="font-weight: bold;color: #000;margin: 0px !important;border: 1px solid #000;"></td>
            </tr>
            <tr>
                <td>{{$print_details[0]->center_web}}</td>
                <td><span class=pull-right></span></td>
            </tr>
        </table>
            <br>
            <script>
                JsBarcode("#bar_id", "<?php echo $print_details[0]->passport; ?>", {
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
            window.location.href="{{ url("edit-port-endorsement") }}";
        });
        <?php } ?>
    </script>

    <script type="text/javascript">
        $(window).load(function() {
            //This execute when entire finished loaded
            window.print();
        });

    </script>


@endsection

@section('page-script')




@endsection



