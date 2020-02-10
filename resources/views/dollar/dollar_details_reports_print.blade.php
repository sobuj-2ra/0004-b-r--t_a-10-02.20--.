@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Dollar Endorsement
@endsection

<!--Page Header-->
@section('page-header')
    Dollar Endorsement Detail Report
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
                        <div class="col-md-8"></div>
                        <div class="col-md-1" style="padding: 0px;">
                            <a href="{{URL::to('/details/1/'.$user_id.'/'.$from.'/'.$to)}}"><button style="padding: 7px 22px;margin:10px;" type="button" class="btn btn-primary pull-right">CSV</button></a>
                        </div>
                        <div class="col-md-1" style="padding: 0px;">
                            <a href="{{URL::to('/details/2/'.$user_id.'/'.$from.'/'.$to)}}"><button style=" padding: 7px 22px;margin:10px;" type="button" class="btn btn-primary pull-right">EXCEL</button></a>
                        </div>
                        <div class="col-md-1" style="padding: 0px;">
                            <a href="{{URL::to('/details/3/'.$user_id.'/'.$from.'/'.$to)}}"><button style="padding: 7px 22px;margin:10px;" type="button" class="btn btn-primary pull-right">PDF</button></a>
                        </div>
                        <div class="col-md-1" style="padding-right: 6px;">
                            <button type="submit" class="btn btn-primary pull-right" style="padding: 7px 22px;margin:10px" onclick="printDiv('printableArea')" style="margin-right:10px;">Print</button>
                        </div>
                    </div>
                    <!-- Code Here.... -->
                    <div id="printableArea">
                        <div class="table_view" style="padding: 10px">
                            <h3 align="center">INDIAN VISA APPLICATION CENTER</h3>
                            <h4 align="center">Dollar Endorsement Detail Report</h4>
                            <p class="text-center">From <?php echo $from ?> To <?php echo $to ?></p>
                            <br>
                            <div class="panel-body">
                                <table width="100%"  class="table-bordered table" style="font-size:14px;">
                                    <thead style="background:#ddd">
                                    <tr>
                                        <th>SL</th>
                                        <th>Applicant name</th>
                                        <th>Passport</th>
                                        <th>Card No</th>
                                        <th>URN</th>
                                        <th>Registration Number</th>
                                        <th>Travel Card Amount (USD)</th>
                                        <th>Commission (USD)</th>
                                        <th>Service Charge (BDT)</th>
                                        <th>Total (BDT)</th>
                                        <th>R. User</th>
                                        <th>C. Rate</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <h1 style="display: none">   {{$sno=1}}</h1>
                                    <?php $t_usd = 0;
                                    $t_com =0;
                                    $t_charge =0;
                                    $t_total=0;
                                    ?>
                                    @foreach($print_data as $detail)
                                        <tr class="odd gradeX">


                                            <td>{{$sno++}}.</td>
                                            <td>{{$detail->a_name}}</td>
                                            <td>{{$detail->passport_no}}</td>
                                            <td>{{$detail->digit}}</td>
                                            <td>{{$detail->urn}}</td>
                                            <td>{{$detail->serial_number}}</td>
                                            <td ><span style="float: right"><?php $t_usd +=$detail->f_currency; echo $detail->f_currency; ?></span></td>
                                            <td><sapn style="float: right;"><?php $t_com +=$detail->commission; echo round($detail->commission, 2); ?></sapn></td>
                                            <td><span style="float: right"><?php $t_charge +=$detail->s_charge; echo $detail->s_charge; ?></span></td>
                                            <td><span style="float: right"><?php $t_total +=$detail->t_amount; echo round($detail->t_amount, 2); ?></span></td>
                                            <td>{{$detail->created_by}}</td>
                                            <td>{{$detail->c_rate}}</td>
                                            <td><?php echo date('d-m-Y', strtotime($detail->created_date)); ?></td>
                                        </tr>

                                    @endforeach
                                        <tfooter>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th>Total</th>
                                            <th><span style="float: right;"><?php echo $t_usd; ?></span></th>
                                            <th><span style="float: right;"><?php echo $t_com; ?></span></th>
                                            <th><span style="float: right;"><?php echo $t_charge; ?></span></th>
                                            <th><span style="float: right;"><?php echo $t_total; ?></span></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
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