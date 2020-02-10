@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Summary Report
@endsection

<!--Page Header-->
@section('page-header')
     Summary Report
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
                                <h4 align="center">{{$reportType}} Summary Report</h4>
                                <p class="text-center">{{@$user_id}}  Date: <?php if (@$fromDate == @$toDate){ echo @$fromDate; }else{ echo 'From '.@$fromDate.' To '.@$toDate; } ?></p>
                                <br>
                                  <p style="text-align:center;font-weight:bold;margin-bottom:0">{{@$wiseMsg}}</p>                                <div class="panel-body">
                                  @if(isset($UserArr))
                                    <table width="50%"  class="table-bordered table" style="font-size: 15px;">
                                        <thead style="background:#ddd">
                                        <tr>
                                            <th>Sl</th>
                                            <th>User ID</th>
                                            <th>Qty</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $total = 0; $total_wait = 0;?>
                                        @foreach($UserArr as $user_item)

                                            <tr class="odd gradeX">
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$user_item['servedby']}}</td>
                                                <td>{{$user_item['u_c']}}</td>

                                            </tr>
                                            <?php
                                                $total += $user_item['u_c'];
                                             ?>
                                        @endforeach
                                        <tfooter>
                                          <tr>
                                            <td colspan="2"  class="text-right" ><b>Total</b></td>
                                            <td><b>{{$total}}</b></td>
                                          </tr>
                                        </tfooter>
                                        </tbody>
                                    </table>
                                  @else
                                        @if(isset($serviceTypeArr))
                                          <table width="50%"  class="table-bordered table" style="font-size: 15px;">
                                              <thead style="background:#ddd">
                                              <tr>
                                                  <th>Sl</th>
                                                  <th>Service</th>
                                                  <th>Qty</th>
                                              </tr>
                                              </thead>
                                              <tbody>
                                              <?php $total = 0; ?>
                                              @foreach($serviceTypeArr as $svc_item)
                                                  <tr class="odd gradeX">
                                                      <td>{{$loop->iteration}}</td>
                                                      <td>{{$svc_item['servicetype']}}</td>
                                                      <td>{{$svc_item['st_c']}}</td>
                                                  </tr>
                                                  <?php
                                                      $total += $svc_item['st_c'];
                                                   ?>
                                              @endforeach
                                              <tfooter>
                                                <tr>
                                                  <td colspan="2"  class="text-right"><b>Total</b></td>
                                                  <td><b>{{$total}}</b></td>
                                                </tr>
                                              </tfooter>
                                              </tbody>
                                          </table>
                                        @else
                                          <h2 class="text-center" style="color:#ddd">No Data Found</h2>
                                        @endif
                                  @endif

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
                            <i>--  Summary Report --</i>
                        </p>
                        <form action="{{ URL::to('counter-receive/summary/report') }}" method="post">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="status"><i>Select Type:</i></label>
                                <select class="form-control" name="type" required>
                                      <option value=""></option>
                                      <option value="1">User Wise</option>
                                      <option value="2">Service Wise</option>
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
