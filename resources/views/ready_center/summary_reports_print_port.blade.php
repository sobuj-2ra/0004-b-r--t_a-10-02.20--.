@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Port Endorsement
@endsection

<!--Page Header-->
@section('page-header')
    Port Endorsement Ready Centre Summary Report
@endsection

<!--Page Content Start Here-->
@section('page-content')
    <?php
    $from = date('d-m-Y', strtotime($formDate));
    $to = date('d-m-Y', strtotime($toDate));
    $user_id = $user_id;
    ?>
    <section class="content">
        <div class="row">
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
                            <h4 align="center">Port Endorsement Ready Centre Summary Report </h4>
                            <p class="text-center">{{$user_id}} - Date: <?php if ($from == $to){ echo $from; }else{ echo 'From '.$from.' To '.$to; } ?></p>
                            <br>
                            <div class="panel-body">
                                <table width="50%"  class="table-bordered table" style="font-size: 15px;">
                                    <thead style="background:#ddd">
                                    <tr>
                                        <th>Date</th>
                                        <th>Quantity</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $total = 0; ?>
                                    @foreach($print_data as $detail)
                                        <tr class="odd gradeX">
                                            <td><?php echo date('d-m-Y', strtotime($detail->ready_cen_time)); ?></td>
                                            <td><?php $total+= $detail->count_row; echo $detail->count_row; ?></td>
                                        </tr>

                                    @endforeach
                                    <tfooter>
                                        <th>Total</th>
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