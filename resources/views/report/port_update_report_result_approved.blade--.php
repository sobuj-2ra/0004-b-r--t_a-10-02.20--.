@extends('master')
@section('main_content')
<?php 
$form_date = $_POST['form_date'];
$to_date = $_POST['to_date'];
$approved_status = $_POST['approved_status'];
 ?>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="main_part">
				<!-- Code Here.... -->
				<div class="table_view" style="padding: 10px">
					<h3 align="center">R.A.P./P.A.P. Approval Summary Report</h3>
					<h4 align="center"><?php echo $form_date ?> To <?php echo $to_date; ?></h4>
					<br>
					<table id="" class="table table-bordered table-striped" style="width: 700px;margin: 0px auto">
						<thead style="background:#ddd">
							<tr>
			                  <th>Serial</th>
			                  <th>Date</th>
			                  <th>Approved</th>
			                </tr>
						</thead>
						<tbody>
					<?php 
					$count = 1;
					while (strtotime($form_date) <= strtotime($to_date))
					{
					$sql = "SELECT COUNT(`approve_status`) as total FROM tbl_port_update WHERE CAST(`approve_date` AS DATE) = '$form_date' AND `approve_status` = 'Approved' ";
					 $pending = DB::select($sql);
					 //echo '<pre>';print_r($total);
					?>
					<tr>
	                  <th><?php echo $count; ?></th>
	                  <th><?php echo $form_date; ?></th>
	                  <th><?php echo $pending[0]->total; ?></th>
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
</section>
@endsection