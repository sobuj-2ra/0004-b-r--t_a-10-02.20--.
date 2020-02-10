@extends('admin.master')
<!--Page Title-->
@section('page-title')
    R.A.P / P.A.P
@endsection

<!--Page Header-->
@section('page-header')
    R.A.P / P.A.P Receive Detail Report
@endsection

<!--Page Content Start Here-->
@section('page-content')

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8"></div>
                    <div class="col-md-1" style="padding: 0px;">
                        <a href="{{URL::to('/details-rappap/1/'.$user_id.'/'.$ServiceType.'/'.$centerName.'/'.$fromdate.'/'.$todate)}}"><button style="padding: 7px 22px;margin:10px;" type="button" class="btn btn-primary pull-right">CSV</button></a>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <a href="{{URL::to('/details-rappap/2/'.$user_id.'/'.$ServiceType.'/'.$centerName.'/'.$fromdate.'/'.$todate)}}"><button style="padding: 7px 22px;margin:10px;" type="button" class="btn btn-primary pull-right">EXCEL</button></a>
                    </div>
                    <div class="col-md-1" style="padding: 0px;">
                        <a href="{{URL::to('/details-rappap/3/'.$user_id.'/'.$ServiceType.'/'.$centerName.'/'.$fromdate.'/'.$todate)}}"><button style="padding: 7px 22px;margin:10px;" type="button" class="btn btn-primary pull-right">PDF</button></a>
                    </div>
                    <div class="col-md-1" style="padding: 10px;">
                        <button type="button" class="btn btn-primary pull-right" onclick="printDiv('printableArea')" style="margin-right:10px;">Print</button>

                    </div>
                </div>
                <div class="main_part">
                    <br>
                    <!-- Code Here.... -->
                    <div id="printableArea">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <h3 class="text-center">INDIAN VISA APPLICATION CENTER</h3>
                                <h4 class="text-center">R.A.P. / P.A.P. Receive Detail Report</h4>
                                <p class="text-center">From <?php echo date('d-m-Y', strtotime($fromdate)) ?> To <?php echo date('d-m-Y', strtotime($todate)) ?></p>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table-bordered table" style="font-size:11px;">
                                <thead style="background: #ddd">
                                <tr>
                                    <th>SL</th>
                                    <th>Applicant name</th>
                                    <th>Passport</th>
                                    <th>Master Passport</th>
                                    <th>Center</th>
                                    <th>Visa no</th>
                                    <th>Visa type</th>
                                    <th>Contact</th>
                                    <th>Receive time</th>
                                    <th>Receive by</th>
                                    <th>Fee</th>
                                    <th>Sticker</th>
                                    <th>Entry Port</th>
                                    <th>Area</th>
                                    <th>Exit Port</th>
                                    <th>Mode</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i=1;
                                @endphp
                                @foreach($rappap_detail as $detail_val)
                                    <tr class="odd gradeX">
                                        <td>{{$i}}</td>
                                        <td>{{$detail_val->applicant_name}}</td>
                                        <td>{{$detail_val->passport}}</td>
                                        <td>{{$detail_val->MasterPP}}</td>
                                        <td>{{$detail_val->center}}</td>
                                        <td>{{$detail_val->visa_no}}</td>
                                        <td>{{$detail_val->visa_type}}</td>
                                        <td>{{$detail_val->contact}}</td>
                                        <td>{{$detail_val->rec_cen_time}}</td>
                                        <td>{{$detail_val->rec_cen_by}}</td>
                                        <td>{{$detail_val->Fee}}</td>
                                        <td>{{$detail_val->sticker}}</td>
                                        <td>{{$detail_val->OldPort}}</td>
                                        <td>{{$detail_val->area}}</td>
                                        <td>{{$detail_val->OldPort}}</td>
                                        <td>{{$detail_val->mode}}</td>
                                    </tr>
                                    @php
                                        $i++;
                                    @endphp
                                @endforeach
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        function printDiv(printableArea) {
            var printContents = document.getElementById(printableArea).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>

@endsection

