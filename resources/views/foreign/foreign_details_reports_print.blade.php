@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Foreign Passport
@endsection

<!--Page Header-->
@section('page-header')
    Foreign Passport Detail Report
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
                            <a href="{{URL::to('/foreign-details/1/'.$user_id.'/'.$from.'/'.$to)}}"><button style="padding: 7px 22px;margin:10px;" type="button" class="btn btn-primary pull-right">CSV</button></a>
                        </div>
                        <div class="col-md-1" style="padding: 0px;">
                            <a href="{{URL::to('/foreign-details/2/'.$user_id.'/'.$from.'/'.$to)}}"><button style=" padding: 7px 22px;margin:10px;" type="button" class="btn btn-primary pull-right">EXCEL</button></a>
                        </div>
                        <div class="col-md-1" style="padding: 0px;">
                            <a href="{{URL::to('/foreign-details/3/'.$user_id.'/'.$from.'/'.$to)}}"><button style="padding: 7px 22px;margin:10px;" type="button" class="btn btn-primary pull-right">PDF</button></a>
                        </div>
                        <div class="col-md-1" style="padding-right: 6px;">
                            <button type="submit" class="btn btn-primary pull-right" style="padding: 7px 22px;margin:10px" onclick="printDiv('printableArea')" style="margin-right:10px;">Print</button>
                        </div>
                    </div>
                    <!-- Code Here.... -->
                    <div id="printableArea">
                        <style type="text/css" media="print">
                            @page { size: landscape;font-size: 13px;
                            }
                        </style>
                        <div class="table_view" style="padding: 10px">
                            <h3 align="center">INDIAN VISA APPLICATION CENTRE</h3>
                            <h4 align="center">Foreign Passport Detail Report</h4>
                            <p class="text-center">Date: <?php if ($from == $to){ echo $from; }else{ echo 'From '.$from.' To '.$to; } ?></p>
                            <br>
                            <div class="panel-body">
                                <table width="100%"  class="table-bordered table" style="font-size: 12px;">
                                    <thead style="background:#ddd">
                                    <tr>
                                        <th>SL</th>
                                        <th>Applicant name</th>
                                        <th>Passport</th>
                                        <th>Sticker No</th>
                                        <th>Web File No.</th>
                                        <th>Nationality</th>
                                        <th>Contact</th>
                                        <th>Date of Checking</th>
                                        <th>Remarks</th>
                                        <th>Receipt No</th>
                                        <th>Visa Fee</th>
                                        <th>Fax Trans. Charge</th>
                                        <th>ICWF</th>
                                        <th>Visa App. Charge</th>
                                        <th>Total</th>
                                        <th>Created By</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <h1 style="display: none">   {{$sno=1}}</h1>
                                    <?php $t_visa_fee = 0;
                                    $t_fax =0;
                                    $t_icwf =0;
                                    $t_total=0;
                                    $t_app=0;
                                    ?>
                                    @foreach($print_data as $detail)
                                        <tr class="odd gradeX">
                                            <td>{{$sno++}}.</td>
                                            <td>{{$detail->app_name}}</td>
                                            <td>{{$detail->passport}}</td>
                                            <td>{{$detail->strk_no}}</td>
                                            <td>{{$detail->web_file_no}}</td>
                                            <td>{{$detail->nationality}}</td>
                                            <td>{{$detail->contact}}</td>
                                            <td><?php echo date('d.m.Y', strtotime($detail->date_of_checking)); ?></td>
                                            <td>{{$detail->remarks}}</td>
                                            <?php if ($detail->gratis_status == 'yes'){ ?>
                                            <td><?php echo 'GRATIS'; ?></td>
                                            <?php }else{ ?>
                                            <td><?php echo $detail->receive_no; ?></td>
                                            <?php } ?>
                                            <td ><span style="float: right"><?php $t_visa_fee +=$detail->visa_fee; echo $detail->visa_fee; ?></span></td>
                                            <td><sapn style="float: right;"><?php $t_fax +=$detail->fax_trans_charge; if ($detail->fax_trans_charge == 0 && $detail->visa_fee != 0){ echo 'minor'; }else{  echo round($detail->fax_trans_charge, 2);} ?></sapn></td>
                                            <td><span style="float: right"><?php $t_icwf +=$detail->icwf; echo $detail->icwf; ?></span></td>
                                            <td><span style="float: right"><?php $t_app +=$detail->visa_app_charge; echo round($detail->visa_app_charge, 2); ?></span></td>
                                            <td><span style="float: right"><?php $t_total +=$detail->total_amount; echo round($detail->total_amount, 2); ?></span></td>
                                            <td>{{$detail->created_by}}</td>
                                            <td><?php echo date('d-m-Y', strtotime($detail->created_date)); ?></td>
                                        </tr>

                                    @endforeach
                                    <tfooter>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>Total</th>
                                        <th><span style="float: right;"><?php echo number_format(round($t_visa_fee)); ?></span></th>
                                        <th><span style="float: right;"><?php echo number_format(round($t_fax)); ?></span></th>
                                        <th><span style="float: right;"><?php echo number_format(round($t_icwf)); ?></span></th>
                                        <th><span style="float: right;"><?php echo number_format(round($t_app)); ?></span></th>
                                        <th><span style="float: right;"><?php echo number_format(round($t_total)); ?></span></th>
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