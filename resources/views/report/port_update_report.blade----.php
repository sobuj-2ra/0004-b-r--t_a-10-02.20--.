@extends('master')
@section('main_content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="main_part">
				<br>
				<!-- Code Here.... -->
				<div class="change_passport_body">
					<p class="form_title_center">
						<i>-PORT UPDATE REPORT FORM-</i>
					</p>
					<form method="POST" autocomplete="off" action="{{URL::to('port-update-report-result')}}">
						@csrf
					  <div class="form-group">
					  	<label for="status"><i>APPROVAL STATUS:</i></label>
					  	<select class="form-control" name="approved_status" id="approved_status">
					  		<option value="all">All</option>
					  		<option value="Approved">Approved</option>
					  		<option value="Rejected">Rejected</option>
					  		<option value="Pending">Pending</option>
					  	</select>
					  </div>
					  <div class="form-group">
					    <label for="form_date"><i>FORM DATE:</i></label>
					    <input type="text" class="form-control" name="form_date" id="from_date" required>
					    <span id="status_response" style="font-size: 12px;float: right;"></span>
					  </div>
					  <div class="form-group">
					    <label for="to_date"><i>TO DATE:</i></label>
					    <input type="text" class="form-control" name="to_date" id="to_date" required>
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
	</div>
</section>
@endsection