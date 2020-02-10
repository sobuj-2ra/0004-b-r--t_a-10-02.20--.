@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Ready at Center Summary Report
@endsection

<!--Page Header-->
@section('page-header')
    Ready at Center Summary Report
@endsection

<!--Page Content Start Here-->
@section('page-content')

    <section class="content">
        <div class="row">
            @if(isset($getData_list))
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
                                <h3 align="center">INDIAN VISA APPLICATION CENTRE</h3>
                                <h4 align="center">Ready at Center Summary Report </h4>
                                <p class="text-center">{{@$user_id}}  Date: <?php if (@$fromDate == @$toDate){ echo @$fromDate; }else{ echo 'From '.@$fromDate.' To '.@$toDate; } ?></p>
                                <br>
                                <div class="panel-body">
                                    <table width="50%"  class="table-bordered table" style="font-size: 15px;">
                                        <thead style="background:#ddd">
                                        <tr>
                                            <th>Summary </th>
                                            <th>Quantity</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $total = 0; ?>
                                        @foreach($getData_list as $data_item)
                                            <tr class="odd gradeX">
                                                <td>Saved</td>
                                                <td><?php $total+= $data_item->webfile_count; echo $data_item->webfile_count; ?></td>
                                            </tr>
                                        @endforeach
                                        @foreach($getDelData_list as $data_item)
                                            <tr class="odd gradeX">
                                                <td>Failed</td>
                                                <td><?php $total+= $data_item->id_count; echo $data_item->id_count; ?></td>
                                            </tr>
                                        @endforeach
                                        <tfooter>
                                            <th>Total Data</th>
                                            <th><?php echo $total; ?></th>
                                        </tfooter>
                                        </tbody>
                                    </table>
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
                            <i>Ready at Center Summary Report</i>
                        </p>
                        <form action="{{ URL::to('ready-at-summary-report') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="status"><i>User Id:</i></label>
                                <select class="form-control" name="user_id">
                                    <option value="all" selected="">All</option>
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