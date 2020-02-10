@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Foreign Passport
@endsection

<!--Page Header-->
@section('page-header')
    Reprint Foreign Passport
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
                                <i>-Reprint Foreign Passport-</i>
                            </p>
                            {!! Form::open(['url' => 'foreign/reprint-search','id' => 'applicant_form']) !!}
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

    <?php if (isset($deleteData)){ ?>
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
                                                <th scope="col">Web File Number</th>
                                                <th scope="col">Nationality</th>
                                                <th scope="col">Remarks</th>
                                                <th scope="col">Entry Date</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td><?php echo $deleteData->app_name;  ?></td>
                                                <td><?php echo $deleteData->passport;  ?></td>
                                                <td><?php echo $deleteData->contact;  ?></td>
                                                <td><?php echo $deleteData->strk_no;  ?></td>
                                                <td><?php echo $deleteData->web_file_no;  ?></td>
                                                <td><?php echo $deleteData->nationality;  ?></td>
                                                <td><?php echo $deleteData->remarks;  ?></td>
                                                <td><?php echo date('d-m-Y', strtotime($deleteData->created_date));  ?></td>
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
        <?php for ($i =1; $i<=$service->slip_copy; $i++){ ?>
        <table border=0 width="100%" class="tclass" style="padding: 0">
            <tr>
                <td colspan=2 class="text-center"><strong>
                        <center>INDIAN VISA APPLICATION CENTER</center>
                    </strong></td>
            </tr>
            <tr>
                <td colspan=2 class="text-center"><strong>
                        <center>{{ $deleteData->center}}</center>
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
                    <strong>Name:</strong> {{ $deleteData->app_name}} <br/>
                    <strong>Contact:</strong> {{ $deleteData->contact}} <br/>
                    <strong>Passport:</strong> {{ $deleteData->passport}} <br/>
                    <strong>Web file No:</strong> {{ $deleteData->web_file_no}} <br/>
                    <strong>Nationality:</strong> {{ $deleteData->nationality}} <br/>
                    <strong>date of Checking:</strong> <?php echo date('d-m-Y', strtotime($deleteData->date_of_checking)) ?> <br/>
                    <strong>Remarks:</strong> {{ $deleteData->remarks}} <br/>
                    <strong>Visa fee:</strong> {{ $deleteData->visa_fee}} tk<br/>
                    <strong>Fax trans. charge:</strong> {{ $deleteData->fax_trans_charge}} tk<br/>
                    <strong>icwf:</strong> {{ $deleteData->icwf}}tk <br/>
                    <strong>Visa app. charge:</strong> {{ $deleteData->visa_app_charge}} <br/>
                    <strong>Total Amount:</strong> {{ $deleteData->total_amount}} tk<br/>
                    <strong>Sticker:</strong> {{ $deleteData->strk_no}} <br/>

                    <strong>Receiving Date:</strong> <?php echo date('d-m-Y', strtotime($deleteData->receiving_date)) ?> <br/>
                    <strong>Delivery on or after: <?php echo date('d-m-Y', strtotime( $deleteData->tdd)); ?> <?php if (isset($center->del_time) && !empty($center->del_time)){ echo $center->del_time; } ?></strong>

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
                JsBarcode("#bar_id_<?php echo $i; ?>", "<?php echo $deleteData->web_file_no; ?>", {
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
            window.location.href="{{ url("/reprint-foreign-passport") }}";
        });
    </script>
    <?php } ?>
@endsection
<!--Page Content End Here-->
