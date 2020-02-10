@extends('admin.master')
<!--Page Title-->
@section('page-title')
    R.A.P / P.A.P
    @endsection

            <!--Page Header-->
@section('page-header')
    R.A.P / P.A.P Approve Summary Report
    @endsection

            <!--Page Content Start Here-->
@section('page-content')

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Additional Services Approve Summary Report
                </div>
                <div class="panel-body">
                    {{--<form action="{{ URL::to('approve/detail') }}" method="post" target="_blank">--}}
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>From Date</label>
                                    <input  type="date" name="from_date" id="dt" class="form-control" onchange="mydate1();" required="required" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>To Date</label>
                                    <input type="date" name="to_date"  id="dt" class="form-control" required="required" onchange="mydate2();">
                                </div>
                            </div>
                            <!-- /.col-lg-6 (nested) -->
                        </div>


                        <div class="row">
                            <div class="col-sm-4"> <button type="submit" class="btn btn-primary">Submit </button> <button  type="reset" class="btn btn-default">Reset</button> </div>



                        </div>
                </div>
                </form>
                <!-- /.row (nested) -->


            </div>

        </div>
        <div class="col-md-6"></div>
    </div>
    </div>

@endsection


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