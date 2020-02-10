@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Edit Transport Mode
@endsection

<!--Page Header-->
@section('page-header')
    Edit Transport Mode
@endsection

<!--Page Content Start Here-->
@section('page-content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="main_part">
                    <br>
                    @if (Session::has('message'))
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3 alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                </button>
                                <h4> {{ Session::get('message') }}</h4>
                            </div>
                        </div>
                @endif
                <!-- Code Here.... -->
                    <div class="row" style="padding: 20px;">
                        <div class="col-md-4"></div>
                        <div class="col-md-4 change_passport_body">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Edit Transport Mode
                                </div>

                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            {!! Form::open(['url' => 'mode/update','id' => 'applicant_form']) !!}
                                            <div class="form-group">
                                                <input class="form-control" value="{{$edit_data->mode}}" name="mode_name" placeholder="Enter Transport Mode" required="required" autocomplete="off">
                                            </div>
                                            <input type="hidden" name="id" value="{{$edit_data->serial_no}}">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <button type="reset" class="btn btn-default">Reset</button>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                    <!-- /.row (nested) -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
<!--Page Content End Here-->