@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Single User Summary Report
@endsection

<!--Page Header-->
@section('page-header')
     Single User Summary Report
@endsection

<!--Page Content Start Here-->
@section('page-content')

    <section class="content">
        <div class="row">
            @if(isset($userWiseData))
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
                                <h4 align="center">Single User Summary Report</h4>
                                <p class="text-center">Date: <?php if (@$fromDate == @$toDate){ echo @$fromDate; }else{ echo 'From '.@$fromDate.' To '.@$toDate; } ?></p>

                                <br>
                                <div class="panel-body">
                                  <p  class="text-center"><b>User ID: {{@$user_id}}</b></p>
                                  @if(isset($userWiseData))
                                    <table width="50%"  class="table-bordered table" style="font-size: 15px;">
                                        <thead style="background:#ddd">
                                        <tr>
                                            <th>Date</th>
                                            <th>Service</th>
                                            <th>Total Qty</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $total = 0;
                                          $is_row = true;
                                          $row_i = 0;
                                        foreach($userWiseData as $item_date){
                                          $rowDate = Date('Y-m-d', strtotime($item_date->tissuetime));

                                          $rowWiseData = App\Tbl_service_log::whereDate('tissuetime', $rowDate)->where('servedby',$user_id)->groupBy('servicetype')->get();
                                          //$Gdata = $rowWiseData->groupBy('servicetype');
                                            $rowC = count($rowWiseData);
                                            $rowC = $rowC+1;
                                              echo "<tr>";
                                                echo "<td rowspan='".$rowC."'>";
                                                    echo $rowDate;
                                                echo "</td>";
                                              echo "</tr>";
                                            foreach ($rowWiseData as $i => $userWise){
                                                $totalServiceTypeCount = App\Tbl_service_log::whereDate('tissuetime', $rowDate)->where('servedby',$user_id)->where('servicetype',$userWise->servicetype)->count();
                                                echo "<tr>";
                                                  echo "<td>";
                                                    echo $userWise->servicetype;
                                                  echo "</td>";
                                                  echo "<td>";
                                                    echo $totalServiceTypeCount;
                                                  echo "</td>";
                                                echo "</tr>";
                                                $total += $totalServiceTypeCount;
                                            }
                                          }
                                         ?>
                                         <tr>
                                           <td colspan="2"><b>Total</b></td>
                                           <td><b>{{$total}}</b></td>
                                         </tr>
                                        </tbody>
                                    </table>
                                    @else
                                      <h2 class="text-center" style="color:#ddd">No Data Found</h2>
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
                            <i>-- Single User Summary Report --</i>
                        </p>
                        <form action="{{ URL::to('counter-receive/user-wise/summary/report') }}" method="post">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="status"><i>Select User:</i></label>
                                <select class="form-control" name="user_id" required>
                                    <option value="all" selected=""></option>
                                    @foreach($allUserArr as $user)
                                      <option value="{{$user}}">{{$user}}</option>
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
