@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Export Dollar Endorsement
@endsection

<!--Page Header-->
@section('page-header')
    Export Dollar Endorsement
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
                        @if (Session::has('success'))
                            <div class="alert alert-info">{{ Session::get('success') }}</div>
                        @endif
                        <p class="form_title_center">
                            <i>-Export Dollar Endorsement (tbl_dollar_endorsement)-</i>
                        </p>
                        <form method="POST" autocomplete="off" action="{{ URL::to('/dollar/export') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="to_date"><i>Receive Date:</i></label>
                                <input type="text" id="date2" class="form-control datepicker" name="dateinput" data-date-format="dd/mm/yyyy" required>
                            </div>
                            <hr>
                            <div class="footer-box">
                                <button type="reset" class="btn btn-danger">RESET</button>
                                <button type="submit" id="submit" class="btn btn-info pull-right">Export FILE</button>
                            </div>
                        </form>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </section>

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
    </script>

@endsection