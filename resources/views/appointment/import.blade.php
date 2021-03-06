@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Appointment Import Data
@endsection

<!--Page Header-->
@section('page-header')
    Appointment List Import Data
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
                            <i>-Import Appointment List table information-</i>
                        </p>
                        <form method="POST" autocomplete="off" action="{{ URL::to('appointment-import') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="text" class="form-control datepicker" name="date" data-date-format="dd/mm/yyyy" autocomplete="off" placeholder="Date" required>
                            </div>
                            <div class="form-group">
                                <label for="to_date"><i>CHOICE IMPORT FILE:</i></label>
                                <input type="file" class="form-control" name="import_file" required>
                            </div>
                            <hr>
                            <div class="footer-box">
                                <button type="reset" class="btn btn-danger">RESET</button>
                                <button type="submit" id="submit" class="btn btn-info pull-right">IMPORT FILE</button>
                            </div>
                        </form>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </section>

@endsection