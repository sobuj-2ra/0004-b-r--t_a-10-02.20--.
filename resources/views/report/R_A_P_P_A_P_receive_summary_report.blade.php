@extends('admin.master')
<!--Page Title-->
@section('page-title')
	R.A.P / P.A.P 
@endsection 

<!--Page Header-->
@section('page-header')
	R.A.P./P.A.P. Receive Summary Report
@endsection 

<!--Page Content Start Here-->
@section('page-content')
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="main_part">
					<br>
					<!-- Code Here.... -->
					<div id="">
						<div class="row">
							<div class="col-md-8">

							</div>
							<div class="col-md-1" style="padding: 0px;">
								<a href="{{URL::to('/receive-summary-rappap/1/'.$serviceType.'/'.$form_date.'/'.$to_date)}}"><button style="padding: 7px 22px;margin:10px;" type="button" class="btn btn-primary pull-right">CSV</button></a>
							</div>
							<div class="col-md-1" style="padding: 0px;">
								<a href="{{URL::to('/receive-summary-rappap/2/'.$serviceType.'/'.$form_date.'/'.$to_date)}}"><button style="padding: 7px 22px;margin:10px;" type="button" class="btn btn-primary pull-right">EXCEL</button></a>
							</div>
							<div class="col-md-1" style="padding: 0px;">
								<a href="{{URL::to('/receive-summary-rappap/3/'.$serviceType.'/'.$form_date.'/'.$to_date)}}"><button style="padding: 7px 22px;margin:10px;" type="button" class="btn btn-primary pull-right">PDF</button></a>
							</div>
							<div class="col-md-1" style="padding: 10px;">
								<button type="button" class="btn btn-primary pull-right" onclick="printDiv('printableArea')" style="margin-right:10px;">Print</button>

							</div>

						</div>
						<!-- /.panel-heading -->
						<div class="row" id="printableArea">
							<div class="col-md-3"></div>
							<div class="col-md-6">
								<h3 class="text-center">{{$page_title}}</h3>
								<p class="text-center"><?php echo date('d-m-Y', strtotime($form_date)) ?> To <?php echo date('d-m-Y', strtotime($to_date)); ?></p>
							</div>
							<div class="col-md-3"></div>
							<div class="col-md-6 col-md-offset-3">
								<div class="panel-body">
									<table width="100%" class="table-bordered table" style="font-size:13px;">
										<thead style="background: #ddd">
										<tr>
											<th>SL</th>
											<th>Date</th>
											<th>Quantity</th>
										</tr>
										</thead>
										<tbody>
										<?php $i=0;
										foreach ($p_data as $p_datum) { $i++;
										?>
										<tr>
											<th><?php echo $i; ?></th>
											<th><?php echo  date('d-m-Y', strtotime($p_datum->rec_cen_time)); ?></th>
											<th><?php echo  $p_datum->count_row; ?></th>
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
					<br>
				</div>
			</div>
		</div>
	</section>
	<script type="text/javascript">
		function printDiv(printableArea) {
			var printContents = document.getElementById(printableArea).innerHTML;
			var originalContents = document.body.innerHTML;

			document.body.innerHTML = printContents;

			window.print();

			document.body.innerHTML = originalContents;
			// var c_link = window.location.href;
			// window.location.href=c_link;
		}
	</script>
@endsection 
<!--Page Content End Here-->
