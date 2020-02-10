@php use \App\Http\Controllers\RappapController; @endphp
@extends('admin.master')
<!--Page Title-->
@section('page-title')
    R.A.P / P.A.P
@endsection
<!--Page Header-->
@section('page-header')
    R.A.P / P.A.P Application Form
@endsection

<!--Page Content Start Here-->
@section('page-content')

    <style>
        /*Print Slip*/

        @media print {

            .noprint {
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
        <?php if(!empty(RappapController::slip_print($printid))) {
        echo $printid;
        $data = RappapController::slip_print($printid);
        ?>
        <?php foreach ($data as $val) { ?>

        <table border=0 width="100%" class="tclass" style="padding: 0">
            <tr>
                <td colspan=2 class="text-center"><strong>Indian Visa Application Center</strong></td>
            </tr>
            <tr>
                <td colspan=2 class="text-center">
                    <div class="centerdiv">{{$val->center_name}}</div>
                </td>
            </tr>
            <tr>
                <td colspan=2 class="text-center">
                    <div class="centerdiv2">R.A.P./P.A.P. Application</div>
                </td>
            </tr>
            <tr>
                <td>@php echo $now = date('d-M-Y'); @endphp</td>
                <td><span class="pull-right">@php echo date("h:i:s A"); @endphp</span></td>
            </tr>
            <tr>
                <td colspan=2 style='margin: 105px 0'>
                    <div class="topborder"></div>
                    <strong>Name:</strong> {{ $val->applicant_name}} <br/>
                    <strong>Contact:</strong> {{ $val->contact}} <br/>
                    <strong>Passport:</strong> {{ $val->passport}} <br/>
                    <strong>Visa No:</strong> {{ $val->visa_no}} <br/>
                    <strong>Visa Type:</strong> {{ $val->visa_type}} <br/>
                    <strong>Entry Port:</strong> {{ $val->OldPort}} <br/>
                    <strong>Exit Port:</strong> {{ $val->NewPort}} <br/>
                    <strong>Area:</strong> {{ $val->area}} <br/>
                    <strong>Mode:</strong> {{ $val->mode}} <br/>
                    <strong>Sticker:</strong> {{ $val->sticker}} <br/>
                    <strong>Fee:</strong> {{ $val->Fee}} <br/>
                    <strong>Info:</strong> {{$val->center_info}} <br/>
                    <strong>Delivery on or
                        after:</strong> @php echo rappapController::delivery_date() @endphp {{$val->del_time}}

                    <div class="topborder"></div>
                </td>
            </tr>
            <tr>
                <td>{{$val->center_web}}</td>
                <td><span class="pull-right">EasyQ</span></td>
            </tr>
        </table>

        <table border=0 width="100%" class="tclass" style="padding: 0">
            <tr>
                <td colspan=2 class="text-center"><strong>Indian Visa Application Center</strong></td>
            </tr>
            <tr>
                <td colspan=2 class="text-center">
                    <div class="centerdiv">{{$val->center_name}}</div>
                </td>
            </tr>
            <tr>
                <td colspan=2 class="text-center">
                    <div class="centerdiv2">R.A.P./P.A.P. Application</div>
                </td>
            </tr>
            <tr>
                <td>@php echo $now = date('d-M-Y'); @endphp</td>
                <td><span class="pull-right">@php echo date("h:i:s A"); @endphp</span></td>
            </tr>
            <tr>
                <td colspan=2 style='margin: 105px 0'>
                    <div class="topborder"></div>
                    <strong>Name:</strong> {{ $val->applicant_name}} <br/>
                    <strong>Contact:</strong> {{ $val->contact}} <br/>
                    <strong>Passport:</strong> {{ $val->passport}} <br/>
                    <strong>Visa No:</strong> {{ $val->visa_no}} <br/>
                    <strong>Visa Type:</strong> {{ $val->visa_type}} <br/>
                    <strong>Entry Port:</strong> {{ $val->OldPort}} <br/>
                    <strong>Exit Port:</strong> {{ $val->NewPort}} <br/>
                    <strong>Area:</strong> {{ $val->area}} <br/>
                    <strong>Mode:</strong> {{ $val->mode}} <br/>
                    <strong>Sticker:</strong> {{ $val->sticker}} <br/>
                    <strong>Fee:</strong> {{ $val->Fee}} <br/>
                    <strong>Info:</strong> {{$val->center_info}} <br/>
                    <strong>Delivery on or
                        after:</strong> @php echo rappapController::delivery_date() @endphp {{$val->del_time}}

                    <div class="topborder"></div>
                </td>
            </tr>
            <tr>
                <td>{{$val->center_web}}</td>
                <td><span class="pull-right">EasyQ</span></td>
            </tr>
        </table>


        <?php } } ?>
    </div>

@endsection