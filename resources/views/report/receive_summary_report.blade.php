@extends('admin.master')
<!--Page Title-->
@section('page-title')
	R.A.P / P.A.P 
@endsection 

<!--Page Header-->
@section('page-header')
	Receive Summary Report Form
@endsection 

<!--Page Content Start Here-->
@section('page-content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="main_part">
                    <br>
                    <!-- Code Here.... -->
                    <div class="change_passport_body">
                        <p class="form_title_center">
                            <i>-R.A.P./P.A.P. Receive Detail Report-</i>
                        </p>
                        <form action="{{URL::to('receive-summary-report-result')}}" method="post" target="_blank">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="status"><i>SELECT STATUS:</i></label>
                                <select class="form-control" name="service_status" required="required" id="approved_status">
                                    <option value=""></option>
                                    <option selected="selected" value="R.A.P./P.A.P.">R.A.P./P.A.P.</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="form_date"><i>FORM DATE:</i></label>
                                <input type="text" class="form-control datepicker" name="from_date" data-date-format="dd/mm/yyyy" required
                                       autocomplete="off" value="<?php echo date('d-m-Y'); ?>">
                                <span id="status_response" style="font-size: 12px;float: right;"></span>
                            </div>
                            <div class="form-group">
                                <label for="to_date"><i>TO DATE:</i></label>
                                <input type="text" class="form-control datepicker" name="to_date" data-date-format="dd/mm/yyyy" required
                                       autocomplete="off" value="<?php echo date('d-m-Y'); ?>">
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
<!--Page Content End Here-->


@section('page-script')
<script type="text/javascript">
function mydate1()
{
  d=new Date(document.getElementById("dt").value);
  dt=d.getDate();
  mn=d.getMonth();
  mn++;
  yy=d.getFullYear();
  document.getElementById("ndt").value=dt+"/"+mn+"/"+yy
  document.getElementById("ndt").hidden=false;
  document.getElementById("dt").hidden=true;
}
function mydate2()
{
  d=new Date(document.getElementById("dt").value);
  dt=d.getDate();
  mn=d.getMonth();
  mn++;
  yy=d.getFullYear();
  document.getElementById("ndt").value=dt+"/"+mn+"/"+yy
  document.getElementById("ndt").hidden=false;
  document.getElementById("dt").hidden=true;
}

</script>

@endsection 
