@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Dollar Endorsement Summary Report
@endsection

<!--Page Header-->
@section('page-header')
    Dollar Endorsement Summary Report
@endsection

<!--Page Content Start Here-->
@section('page-content')

    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="main_part">
                    <div class="row">
                        <div class="col-md-8"></div>
                        <div class="col-md-1" style="padding: 0px;">
                            <a href="{{URL::to('/summary/1/'.$user_id.'/'.$formDate.'/'.$toDate)}}"><button style="padding: 7px 22px;margin:10px;" type="button" class="btn btn-primary pull-right">CSV</button></a>
                        </div>
                        <div class="col-md-1" style="padding: 0px;">
                            <a href="{{URL::to('/summary/2/'.$user_id.'/'.$formDate.'/'.$toDate)}}"><button style=" padding: 7px 22px;margin:10px;" type="button" class="btn btn-primary pull-right">EXCEL</button></a>
                        </div>
                        <div class="col-md-1" style="padding: 0px;">
                            <a href="{{URL::to('/summary/3/'.$user_id.'/'.$formDate.'/'.$toDate)}}"><button style="padding: 7px 22px;margin:10px;" type="button" class="btn btn-primary pull-right">PDF</button></a>
                        </div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-primary pull-right" style="margin:10px" onclick="printDiv('printableArea')" style="margin-right:10px;">Print</button>
                        </div>
                    </div>
                    <!-- Code Here.... -->
                    <div id="printableArea">
                        <div class="table_view" style="padding: 10px">
                            <h3 align="center">INDIAN VISA APPLICATION CENTER</h3>
                            <h4 align="center">Dollar Endorsement Summary Report</h4>
                            <p class="text-center">From <?php echo date('d-m-Y', strtotime($formDate)) ?> To <?php echo date('d-m-Y', strtotime($toDate)) ?></p>
                            <br>
                            <div class="panel-body">
                                <table width="100%" class="table-bordered table" style="font-size:14px;">
                                    <thead style="background:#ddd">
                                    <tr>
                                        <th>SL</th>
                                        <th>Date</th>
                                        <th>Receiving User</th>
                                        <th>Total Number of Card</th>
                                        <th>Card Amount(USD)</th>
                                        <th>Commission(USD)</th>
                                        <th>Total Service Charge(BDT)</th>
                                        <th>Total BDT</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $qty = 0;
                                    $t_dollar = 0;
                                    $t_bdt = 0;
                                    $t_charge = 0;
                                    $t_collect = 0;
                                    $t_com =0;
                                    ?>
                                    <h1 style="display: none">   {{$sno=1}}</h1>
                                    @foreach($print_data as $detail)
                                        <tr class="odd gradeX">


                                            <td>{{$sno++}}.</td>
                                            <td><?php echo date('d-m-Y', strtotime($detail->created_date)) ?></td>
                                            <td>{{$detail->created_by}}</td>
                                            <td class="center"><?php $qty+=$detail->count_row; echo $detail->count_row; ?></td>
                                            <td class="center"><?php $t_dollar+=$detail->dollar; echo $detail->dollar; ?></td>
                                            <td><?php $t_com +=$detail->comm; echo round($detail->comm, 2); ?></td>
                                            <td><?php $t_charge+=$detail->charge; echo round($detail->charge, 2); ?></td>
                                            <td><?php $t_collect+=$detail->total; echo round($detail->total, 2); ?></td>
                                        </tr>
                                    @endforeach
                                    <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><strong>{{$qty}}</strong></td>
                                        <td><strong>{{$t_dollar}} USD</strong></td>
                                        <td><strong><?php echo round($t_com, 2) ?> BDT</strong></td>
                                        <td><strong><?php echo round($t_charge, 2) ?> BDT</strong></td>
                                        <td><strong><?php echo round($t_collect, 2) ?> BDT</strong></td>
                                    </tr>
                                    </tfoot>
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