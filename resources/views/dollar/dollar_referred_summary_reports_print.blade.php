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
                            <a href="{{URL::to('/referred-summary/1/'.$refer_id.'/'.$formDate.'/'.$toDate)}}">
                                <button style="padding: 7px 22px;margin:10px;" type="button"
                                        class="btn btn-primary pull-right">CSV
                                </button>
                            </a>
                        </div>
                        <div class="col-md-1" style="padding: 0px;">
                            <a href="{{URL::to('/referred-summary/2/'.$refer_id.'/'.$formDate.'/'.$toDate)}}">
                                <button style=" padding: 7px 22px;margin:10px;" type="button"
                                        class="btn btn-primary pull-right">EXCEL
                                </button>
                            </a>
                        </div>
                        <div class="col-md-1" style="padding: 0px;">
                            <a href="{{URL::to('/referred-summary/3/'.$refer_id.'/'.$formDate.'/'.$toDate)}}">
                                <button style="padding: 7px 22px;margin:10px;" type="button"
                                        class="btn btn-primary pull-right">PDF
                                </button>
                            </a>
                        </div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-primary pull-right" style="margin:10px"
                                    onclick="printDiv('printableArea')" style="margin-right:10px;">Print
                            </button>
                        </div>
                    </div>
                    <!-- Code Here.... -->
                    <div id="printableArea">
                        <div class="table_view" style="padding: 10px">
                            <h3 align="center">INDIAN VISA APPLICATION CENTER</h3>
                            <h4 align="center">Dollar Endorsement Referred Summary Report</h4>
                            <p class="text-center">From <?php echo date('d-m-Y', strtotime($formDate)) ?>
                                To <?php echo date('d-m-Y', strtotime($toDate)) ?></p>
                            <br>
                            <div class="panel-body">
                                <table width="100%" class="table-bordered table" style="font-size:14px;">
                                    <thead style="background:#ddd">
                                    <tr>
                                        <th>SL</th>
                                        <th>Referer ID</th>
                                        <th>Name</th>
                                        <th>Designation</th>
                                        <th>Total Number of Card</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if ($refer_id == 'all') {
                                        $refferer = DB::table('tbl_dollarendorsement_reference')->get();
                                    } else {
                                        $refferer = DB::table('tbl_dollarendorsement_reference')->where('refer_id', $refer_id)->get();
                                    }
                                    $i=0;

                                    foreach ($refferer as $refer) { $i++;
                                        $result = DB::select("SELECT refer_id, COUNT(refer_id) as count_row FROM `tbl_dollar_endorsement` WHERE refer_id = '$refer->refer_id' AND date(`created_date`) >= '$formDate' AND date(`created_date`) <= '$toDate'");
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $refer->refer_id ?></td>
                                            <td><?php echo $refer->name ?></td>
                                            <td><?php echo $refer->designation ?></td>
                                            <td><?php echo $result[0]->count_row; ?></td>
                                        </tr>
                                     <?php
                                    }
                                    ?>
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