@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Port Endorsement
@endsection

<!--Page Header-->
@section('page-header')
    Reprint Port Endorsement
@endsection

<!--Page Content Start Here-->
@section('page-content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="main_part">
                    <br>
                    @if (Session::has('message'))
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3 alert alert-info alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                </button>
                                <h4> {{ Session::get('message') }}</h4>
                            </div>
                        </div>
                @endif
                <!-- Code Here.... -->
                    <div class="row">
                        <div class="col-md-4 change_passport_body"
                             style="width: 30%;padding-left: 33px;border-top: none;">
                            <p class="form_title_center bg-info">
                                <i>-Reprint Port Endorsement-</i>
                            </p>
                            {!! Form::open(['url' => 'port/reprint-search','id' => 'applicant_form']) !!}
                            <div class="form-group">
                                <input class="form-control" name="passport" placeholder="Enter Passport"
                                       required="required" autocomplete="off">
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                            {!! Form::close() !!}
                        </div>
                        <div class="col-md-6 col-md-offset-1">

                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php if (isset($reprint)){ ?>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="main_part">
                    <!-- Code Here.... -->
                    <div class="row" style="padding: 20px;">
                        <div class="col-md-12 change_passport_body" style="width: 100%">
                            <div class="panel panel-default">
                                <div class="panel-heading">

                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr style="background: #ddd;">
                                                <th scope="col">Applicant Name</th>
                                                <th scope="col">Passport</th>
                                                <th scope="col">Contact</th>
                                                <th scope="col">Sticker No</th>
                                                <th scope="col">Visa Number</th>
                                                <th scope="col">Visa Type</th>
                                                <th scope="col">Entry Date</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td><?php echo $reprint->applicant_name;  ?></td>
                                                <td><?php echo $reprint->passport;  ?></td>
                                                <td><?php echo $reprint->contact;  ?></td>
                                                <td><?php echo $reprint->sticker;  ?></td>
                                                <td><?php echo $reprint->visa_no;  ?></td>
                                                <td><?php echo $reprint->visa_type;  ?></td>
                                                <td><?php echo date('d-m-Y', strtotime($reprint->created_at));  ?></td>
                                                <td>
                                                    <button type="submit" class="btn btn-primary" style="padding: 7px 22px;" onclick="printDiv('printableArea')" style="margin-right:10px;">Print</button>
                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.row (nested) -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </section>

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

        <?php for ($i = 1; $i <= $fee->slip_copy; $i++){ ?>
            <table border=0 width="100%" class="tclass" style="padding: 0">
                <tr>
                    <td colspan=2 class=text-center><strong>Indian Visa Application Center</strong></td>
                </tr>
                <tr>
                    <td colspan=2 class=text-center>
                        <div class="centerdiv">{{$reprint->center}}</div>
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
                        <strong>Name:</strong> {{ $reprint->applicant_name}} <br/>
                        <strong>Contact:</strong> {{ $reprint->contact}} <br/>
                        <strong>Passport:</strong> {{ $reprint->passport}} <br/>
                        <strong>Visa No:</strong> {{ $reprint->visa_no}} <br/>
                        <strong>Visa Type:</strong> {{ $reprint->visa_type}} <br/>
                        <strong>Old Port:</strong> {{ $reprint->OldPort}} <br/>
                        <strong>New Port:</strong> {{ $reprint->NewPort}} <br/>
                        <strong>Sticker:</strong> {{ $reprint->sticker}} <br/>
                        <strong>Fee:</strong> <?php echo $fee->Svc_Fee; ?> <br/>
                        <strong>Phone:</strong> {{ $center_name->center_phone}} <br/>
                        <strong>Info:</strong> {{ $center_name->center_info}} <br/>
                        <strong>Delivery on or after:</strong> <?php  echo date('d-m-Y', strtotime($reprint->tdd)); ?>
                        &nbsp;  {{ $center_name->del_time}}</br>
                        <strong></strong>  <br/>

                        <div class="topborder"></div>
                    </td>
                </tr>
                <tr>
                    <td><hr style="font-weight: bold;color: #000;margin: 0px !important;border: 1px solid #000;"></td>
                    <td><hr style="font-weight: bold;color: #000;margin: 0px !important;border: 1px solid #000;"></td>
                </tr>
                <tr>
                    <td>{{$center_name->center_web}}</td>
                    <td><span class=pull-right></span></td>
                </tr>
            </table>
            <br>
            <script>
                JsBarcode("#bar_id", "<?php echo $reprint->passport; ?>", {
                        height: 25,
                        width: 1.5,
                        margin: 10,
                        fontSize: 11,
                    }
                );
            </script>
       <?php } ?>


    </div>
    <script type="text/javascript">
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
            window.location.href="{{ url("/portendorsement/re_print") }}";
        });
    </script>
    <?php } ?>
@endsection
<!--Page Content End Here-->
