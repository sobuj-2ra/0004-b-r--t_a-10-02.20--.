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

    <div class="row">
        <div class="col-lg-12">
            <button type="submit" class="btn btn-success pull-right">Export
                <div class="row">
                    {{--<input class="col-xs-offset-3" type="button"  value="print"/>--}}
                    <button type="submit" class="btn btn-primary pull-right" onclick="printDiv('printableArea')"
                            style="margin-right:10px;">Print
                        <div class="row">

                        </div>

                </div>


                <div id="printableArea">

                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <h3 class="text-center">INDIAN VISA APPLICATION CENTER</h3>
                            <h4 class="text-center">R.A.P / P.A.P Approve Summary Report</h4>

                            <p class="text-center">From 2019-01-10 To 2019-01-14</p>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                    <!-- /.panel-heading -->
                    <h1 style="display: none">   {{$sno=1}}</h1>

                    <div class="panel-body">
                        <table width="100%" class="table-bordered table" style="font-size:10px;">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Applicant name</th>
                                <th>Passport</th>
                                <th>Center</th>
                                <th>Visa no</th>
                                <th>Visa type</th>
                                <th>Contact</th>
                                <th>Approve Date</th>
                                <th>Approve By</th>
                                <th>Master Passport</th>
                                <th>Sticker</th>
                                <th>Route</th>
                                <th>Area</th>
                            </tr>
                            </thead>
                            <tbody>
                            {{--@foreach($details as $detail)--}}
                            {{--<tr class="odd gradeX">--}}


                            {{--<td>{{$sno++}}.</td>--}}
                            {{--<td>{{$detail->applicant_name}}</td>--}}
                            {{--<td>{{$detail->passport}}</td>--}}
                            {{--<td class="center">{{$detail->center}}</td>--}}
                            {{--<td class="center">{{$detail->visa_no}}</td>--}}
                            {{--<td>{{$detail->visa_type}}</td>--}}
                            {{--<td>{{$detail->contact}}</td>--}}
                            {{--<td>{{$detail->approve_date}}</td>--}}
                            {{--<td class="center">{{$detail->approve_by}}</td>--}}
                            {{--<td class="center">{{$detail->MasterPP}}</td>--}}
                            {{--<td>{{$detail->sticker}}</td>--}}
                            {{--<td>{{$detail->OldPort}}</td>--}}
                            {{--<td>{{$detail->NewPort}}</td>--}}


                            {{--</tr>--}}

                            {{--@endforeach--}}

                            </tbody>
                        </table>
                        <!-- /.table-responsive -->

                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
        </div>

        <!-- /.col-lg-12 -->
    </div>
    </div>

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