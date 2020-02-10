@extends('admin.master')
<!--Page Title-->
@section('page-title')
    R.A.P / P.A.P
    @endsection

            <!--Page Header-->
@section('page-header')
    R.A.P / P.A.P Approve Detail Report
    @endsection

            <!--Page Content Start Here-->
@section('page-content')

<section class="content">
    <div class="row">
        <div class="col-md-12">
                      
            <div class="main_part">
            <div class="row">
                <div class="col-md-8"></div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary pull-right" style="margin:10px" onclick="printDiv('printableArea')" style="margin-right:10px;">Print</button>
                    <a href="{{URL::to('/approve-detail/1/'.$approveBy.'/'.$approve_status.'/'.$fromDate.'/'.$toDate)}}"><button type="submit" class="btn btn-primary pull-right" style="margin:10px">CSV</button></a>
                    <a href="{{URL::to('/approve-detail/2/'.$approveBy.'/'.$approve_status.'/'.$fromDate.'/'.$toDate)}}"><button type="submit" class="btn btn-primary pull-right" style="margin:10px">EXCEL</button></a>
                    <a href="{{URL::to('/approve-detail/3/'.$approveBy.'/'.$approve_status.'/'.$fromDate.'/'.$toDate)}}"><button type="submit" class="btn btn-primary pull-right" style="margin:10px">PDF</button></a>
                </div>
            </div>
                <!-- Code Here.... -->
                <div id="printableArea">
                <div class="table_view" style="padding: 10px">
                    <h3 align="center">INDIAN VISA APPLICATION CENTER</h3>
                    <h4 align="center">R.A.P / P.A.P Approve Detail Report</h4>
                    <p class="text-center">From <?php echo date('d-m-Y', strtotime($fromDate)); ?> To <?php echo date('d-m-Y', strtotime($toDate)) ?></p>
                    <br>
                    <div class="panel-body">
                        <table width="100%" class="table-bordered table" style="font-size:12px;">
                            <thead style="background:#ddd">
                            <tr>
                                <th>SL</th>
                                <th>Applicant name</th>
                                <th>Passport</th>
                                <th>Center</th>
                                <th>Visa no</th>
                                <th>Visa type</th>
                                <th>Contact</th>
                                <th>Approval Status</th>
                                <th>Approve Date</th>
                                <th>Approve By</th>
                                <th>Master Passport</th>
                                <th>Sticker</th>
                                <th>Entry port</th>
                                 <th>Area</th>
                                <th>Exit port</th>
                                <th>Mode</th>
                            </tr>
                            </thead>
                            <tbody>
                            <h1 style="display: none">   {{$sno=1}}</h1>
                            @foreach($details as $detail)
                                <tr class="odd gradeX">


                                    <td>{{$sno++}}.</td>
                                    <td>{{$detail->applicant_name}}</td>
                                    <td>{{$detail->passport}}</td>
                                    <td class="center">{{$detail->center}}</td>
                                    <td class="center">{{$detail->visa_no}}</td>
                                    <td>{{$detail->visa_type}}</td>
                                    <td>{{$detail->contact}}</td>
                                    <td>{{$detail->approve_status}}</td>
                                    <td>{{$detail->approve_date}}</td>
                                    <td class="center">{{$detail->approve_by}}</td>
                                    <td class="center">{{$detail->MasterPP}}</td>
                                    <td>{{$detail->sticker}}</td>
                                    <td>{{$detail->OldPort}}</td>
                                    <td>{{$detail->area}}</td>
                                     <td>{{$detail->OldPort}}</td>
                                    <td>{{$detail->mode}}</td>


                                </tr>

                            @endforeach

                            </tbody>
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