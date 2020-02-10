@extends('admin.master')
<!--Page Title-->
@section('page-title')
    R.A.P / P.A.P
    @endsection

            <!--Page Header-->
@section('page-header')
    R.A.P. / P.A.P. All Detail Report
    @endsection

            <!--Page Content Start Here-->
@section('page-content')

<?php 
$form_date = date('Y-m-d', strtotime($_POST['from_date']));
$to_date = date('Y-m-d', strtotime($_POST['to_date']));
$approved_status = $_POST['approved_status'];

 ?>
	<div class="row">
		<div class="col-md-12">
			<div class="main_part">
				<div class="row">
					<div class="col-md-8"></div>
					<div class="col-md-4">
						<button type="submit" class="btn btn-primary pull-right" style="margin:10px" onclick="printDiv('printableArea')" style="margin-right:10px;">Print</button>
						<a href="{{URL::to('/rappap-all-report/1/'.$approved_status.'/'.$form_date.'/'.$to_date)}}"><button type="submit" class="btn btn-primary pull-right" style="margin:10px">CSV</button></a>
						<a href="{{URL::to('/rappap-all-report/2/'.$approved_status.'/'.$form_date.'/'.$to_date)}}"><button type="submit" class="btn btn-primary pull-right" style="margin:10px">EXCEL</button></a>
						<a href="{{URL::to('/rappap-all-report/3/'.$approved_status.'/'.$form_date.'/'.$to_date)}}"><button type="submit" class="btn btn-primary pull-right" style="margin:10px">PDF</button></a>
					</div>
				</div>
				<!-- Code Here.... -->
				<div class="table_view" id="printableArea" style="padding: 10px">
					<h3 align="center">R.A.P./P.A.P. All Summary Report</h3>
					<h4 align="center"><?php echo date('d-m-Y', strtotime($form_date)) ?> To <?php echo date('d-m-Y', strtotime($to_date)); ?></h4>
					<br>
					<table id="" class="table table-bordered table-striped" style="width:900px;margin: 0px auto;text-align: center;font-size:16px">
						<thead style="background:#ddd">
							<tr>
			                  <th>Serial</th>
			                  <th>Date</th>
			                  <th>Approved</th>
			                  <th>Rejected</th>
			                  <th>Pending</th>
			                </tr>
						</thead>
						<tbody>
					<?php 
					$count = 1;
					while (strtotime($form_date) <= strtotime($to_date))
					{
					$sql = 
					"
					SELECT
						(SELECT COUNT(`approve_status`) FROM tbl_port_update WHERE CAST(`approve_date` AS DATE) = '$form_date' AND `approve_status` = 'Approved') as accept_total,

						(SELECT COUNT(`approve_status`) FROM tbl_port_update WHERE CAST(`approve_date` AS DATE) = '$form_date' AND `approve_status` = 'Rejected') as reject_total,

						(SELECT COUNT(`approve_status`)l FROM tbl_port_update WHERE CAST(`approve_date` AS DATE) = '$form_date' AND `approve_status` = 'Pending') as pending_total
					";
					$result = DB::select($sql);	
					?>
					<tr>
	                  <th><?php echo $count; ?></th>
	                  <th><?php echo $form_date; ?></th>
	                  <th><?php echo $result[0]->accept_total; ?></th>
	                  <th><?php echo $result[0]->reject_total; ?></th>
	                  <th><?php echo $result[0]->pending_total; ?></th>
	                </tr>
					<?php	
					$form_date = date ("Y-m-d", strtotime("+1 day", strtotime($form_date)));
					$count++;
					}

					?>
					</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

<script type="text/javascript">
	function printDiv(printableArea) {
		var printContents = document.getElementById(printableArea).innerHTML;
		var originalContents = document.body.innerHTML;

		document.body.innerHTML = printContents;

		window.print();

		document.body.innerHTML = originalContents;
	}
</script>
@endsection