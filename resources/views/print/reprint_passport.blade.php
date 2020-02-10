@extends('admin.master')
<!--Page Title-->
@section('page-title')
    RAPPAP
@endsection

<!--Page Header-->
@section('page-header')
    Reprint
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
                    <form action="{{url('passport-reprint')}}" method="get" role="search">
                        {{ csrf_field() }}
                        <div class="passport_search">
                            <input type="search" name="q" value="" placeholder="Passport Search">
                            <button type="submit" class="btn_search">Search</button>
                        </div>
                    </form>
                    <div class="result_body">
                        <div class="result_top">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 style="margin-left: 36px"><b>No. DAC/VISA/406/14/2019</b></h4>
                                </div>
                                <div class="col-md-6">
                                    <h4 style="float: right;margin-right: 36px"><b><?php echo date('d M Y') ?></b></h4>
                                </div>
                            </div>
                        </div>
                        <div class="result_title">
                            <h4><b>RESTRICTED / PROTECTED AREA PERMIT</b></h4>
                        </div>
                        <div class="result_table">
                            <table class="table table-bordered">
                                <thead style="background:#ddd">
                                <tr>
                                    <th>S.No.</th>
                                    <th>Name</th>
                                    <th>Designation / Relation</th>
                                    <th>Passport No.</th>
                                    <th>Arrival Date</th>
                                    <th>Departure Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (isset($users) && !empty($users)){   $i = 0; foreach ($users as $user){ $i++; ?>
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$user->applicant_name}}</td>
                                        <td>{{$user->designation}}</td>
                                        <td>{{$user->passport}}</td>
                                        <td>{{$user->arrivalDate}}</td>
                                        <td>{{$user->departureDate}}</td>
                                    </tr>
                                <?php }
                                }else{

                                    echo '<tr><td style="align-content: center">No Data Found !</td></tr>';
                                }?>

                                </tbody>
                            </table>
                            <div class="" style="float: right;"><button type="submit" id="rePrint" name="action" value="Re-Print" onclick="printDiv('printableArea')" class="btn_approved">Re-print</button></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
{{--print section--}}

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
        <?php if (isset($users) && !empty($users)){  ?>
        @foreach ($users as $val)

            <table border=0 width="100%" class="tclass" style="padding: 0">
                <tr>
                    <td colspan=2 class="text-center"><strong>Indian Visa Application Center <br> {{$val->center}}</strong></td>
                </tr>
                <tr>
                    <td colspan=2 class="text-center">
{{--                        <div class="centerdiv">{{$val->center_name}}</div>--}}
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
                        {{--<strong>Center Info:</strong> {{$val->center}} <br/>--}}
                        <strong>Delivery on or
                            after:</strong> <?php if ($val->tdd != null){
                            echo date('d-m-Y', strtotime($val->tdd));
                        }
                         ?>

                    </td>
                </tr>
                <tr>
                    <td><hr style="font-weight: bold;color: #000;margin: 0px !important;border: 1px solid #000;"></td>
                    <td><hr style="font-weight: bold;color: #000;margin: 0px !important;border: 1px solid #000;"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><span class="pull-right"></span></td>
                </tr>
            </table>
                <script>
                    JsBarcode("#bar_id", "<?php echo $val->passport; ?>", {
                            height: 25,
                            width: 1.5,
                            margin: 10,
                            fontSize: 11,
                        }
                    );
                </script>
            <br>
            <br>
                <table border=0 width="100%" class="tclass" style="padding: 0">
                    <tr>
                        <td colspan=2 class="text-center"><strong>Indian Visa Application Center <br> {{$val->center}}</strong></td>
                    </tr>
                    <tr>
                        <td colspan=2 class="text-center">
                            {{--                        <div class="centerdiv">{{$val->center_name}}</div>--}}
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
                            {{--<strong>Center Info:</strong> {{$val->center}} <br/>--}}
                            <strong>Delivery on or
                                after:</strong> <?php if ($val->tdd != null){
                                echo date('d-m-Y', strtotime($val->tdd));
                            }
                            ?>

                        </td>
                    </tr>
                    <tr>
                        <td><hr style="font-weight: bold;color: #000;margin: 0px !important;border: 1px solid #000;"></td>
                        <td><hr style="font-weight: bold;color: #000;margin: 0px !important;border: 1px solid #000;"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><span class="pull-right"></span></td>
                    </tr>
                </table>
                <script>
                    JsBarcode("#bar_id", "<?php echo $val->passport; ?>", {
                            height: 25,
                            width: 1.5,
                            margin: 10,
                            fontSize: 11,
                        }
                    );
                </script>

        @endforeach
        <?php } ?>
    </div>
    <script>
        function printDiv(printableArea) {
            var printContents = document.getElementById(printableArea).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
    <script>
        //window.onload = printDiv('printableArea');
        $(window).on('afterprint', function () {
            window.location.href="{{ url("/passport-reprint") }}";
        });
    </script>
@endsection


