@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Detail Report
@endsection

<!--Page Header-->
@section('page-header')
    Detail Report
@endsection

<!--Page Content Start Here-->
@section('page-content')

    <section class="content">
        <div class="row">
            @if(isset($service_logs))
                <div class="col-md-12">

                    <div class="main_part">
                        <div class="row">
                            <div class="col-md-1" style="padding-right: 6px; float: right">
                                <button type="submit" class="btn btn-primary pull-right" style="padding: 7px 22px;margin:10px" onclick="printDiv('printableArea')" style="margin-right:10px;">Print</button>
                            </div>
                        </div>
                        <!-- Code Here.... -->
                        <div id="printableArea">
                            <style type="text/css" media="print">
                                @page { size: portrait;font-size: 14px;
                                }
                            </style>
                            <div class="table_view" style="padding: 10px">
                                <h3 align="center">Bangladesh Road Transport Authority</h3>
                                <h4 align="center">Detail Report</h4>
                                <p class="text-center">{{@$user_id}}  Date: <?php if (@$fromDate == @$toDate){ echo @$fromDate; }else{ echo 'From '.@$fromDate.' To '.@$toDate; } ?></p>
                                <br>
                                <div class="panel-body">
                                    <table width="50%"  class="table-bordered table" style="font-size: 15px;">
                                        <thead style="background:#ddd">
                                        <tr>
                                            <th>Sl</th>
                                            <th>Token No</th>
                                            <th>Service Name</th>
                                            <th>Token Issue Time</th>
                                            <th>Service Start Time</th>
                                            <th>Service Stop Time</th>
                                            <th>Wait Time</th>
                                            <th>Service Time</th>
                                            <th>Counter No</th>
                                            <th>Served By</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $total = 0; $total_wait = 0;?>
                                        @foreach($service_logs as $data_item)
                                            <tr class="odd gradeX">
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$data_item->tokenno}}</td>
                                                <td>{{$data_item->servicetype}}</td>
                                                <td>{{ $data_item->tissuetime }}</td>
                                                <td>{{ $data_item->ststart }}</td>
                                                <td>{{ $data_item->ststop }}</td>
                                                <td>{{gmdate('H:i:s',$data_item->waiting)}}</td>
                                                <td>{{gmdate('H:i:s',$data_item->service)}}</td>
                                                <td>{{$data_item->cno}}</td>
                                                <td>{{$data_item->servedby}}</td>
                                            </tr>
                                            <?php
                                                $total_wait += $data_item->waiting;
                                             ?>
                                        @endforeach
                                        <tfooter>

                                        </tfooter>
                                        </tbody>
                                    </table>
                                    @if(count($service_logs) > 0)
                                    <div class="col-md-6 col-md-offset-6">
                                      <table width="50%"  class="table-bordered table" style="font-size: 15px;">

                                        <tbody>

                                          <tr>
                                              <td><b>Minimum Wait Time</b></td>
                                              <td><b>{{ gmdate('H:i:s',$min)}}</b></td>
                                          </tr>
                                          <tr>
                                              <td><b>Maximum Wait Time</b></td>
                                              <td><b>{{ gmdate('H:i:s',$max)}}</b></td>
                                          </tr>
                                          <tr>
                                              <td><b>Average Wait Time</b></td>
                                              <td><b>{{ gmdate('H:i:s',$avg)}}</b></td>
                                          </tr>
                                          <tr>
                                              <td><b>Minimum Service Time</b></td>
                                              <td><b>{{ gmdate('H:i:s',$min_s)}}</b></td>
                                          </tr>
                                          <tr>
                                              <td><b>Maximum Service Time</b></td>
                                              <td><b>{{ gmdate('H:i:s',$max_s)}}</b></td>
                                          </tr>
                                          <tr>
                                              <td><b>Average Service Time</b></td>
                                              <td><b>{{ gmdate('H:i:s',$avg_s)}}</b></td>
                                          </tr>

                                        </tbody>
                                      </table>
                                  </div>
                                  @else
                                    <h2 class="text-center" style="color:#ddd">No Data Found</h2>
                                  @endif

                                    <!-- /.table-responsive -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
            <div class="col-md-12">
                <div class="main_part">
                    <br>
                    <!-- Code Here.... -->
                    <div class="change_passport_body">
                        <p class="form_title_center">
                            <i>Receive Detail Report</i>
                        </p>
                        <form action="{{ URL::to('counter-receive/details/report') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="status"><i>User Id:</i></label>
                                <select class="form-control" name="user_id">
                                    <option value="all" selected="">All</option>
                                    @foreach($allUserArr as $user)
                                      <option value="{{$user}}">{{$user}}</option>
                                    @endforeach;
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status"><i>Services:</i></label>
                                <select class="form-control" name="service">
                                    <option value="all" selected="">All</option>
                                    @foreach($allServices as $service)
                                      <option value="{{$service->svc_name}}">{{$service->svc_name}}</option>
                                    @endforeach;
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="form_date"><i>FORM DATE:</i></label>
                                <input type="text" value="<?php echo date('d-m-Y'); ?>" class="form-control datepicker" name="from_date" data-date-format="dd/mm/yyyy" required autocomplete="off">
                                <span id="status_response" style="font-size: 12px;float: right;"></span>
                            </div>
                            <div class="form-group">
                                <label for="to_date"><i>TO DATE:</i></label>
                                <input type="text" value="<?php echo date('d-m-Y'); ?>" class="form-control datepicker" name="to_date" data-date-format="dd/mm/yyyy" required autocomplete="off">
                            </div>
                            <hr>
                            <div class="footer-box">
                                <button type="reset" class="btn btn-danger">RESET</button>
                                <button type="submit" id="submit" class="btn btn-info pull-right">SUBMIT</button>
                            </div>
                        </form>
                    </div>
                    <br>
                </div>
            </div>
            @endif
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
        $(window).on('afterprint', function () {
            {{--window.location.href = "{{ url("/portendorsement/$type/$form/$to/$id") }}";--}}
            location.reload(true);
        });

</script>
@endsection
