@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Services
@endsection

<!--Page Header-->
@section('page-header')
    Edit Services
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
                        <div class="col-md-4 change_passport_body" style="width: 30%">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Edit Services
                                </div>

                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            {!! Form::open(['url' => 'service/update','id' => 'applicant_form']) !!}
                                            <input type="hidden" name="sl" value="{{$edit_data->sl}}">
                                            <div class="form-group">
                                                <input class="form-control" value="{{$edit_data->Service}}" name="services" placeholder="Enter service name" required="required" autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" value="{{$edit_data->slip_copy}}" name="slip_copy" placeholder="Enter number of slip copy" autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" value="{{$edit_data->Svc_Fee}}" name="Svc_fee" placeholder="Enter Service Fee" required="required" autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" value="{{$edit_data->LeadTime}}" name="LeadTime" placeholder="Enter Lead Time" required="required" autocomplete="off">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                            <button type="reset" class="btn btn-default">Reset</button>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                    <!-- /.row (nested) -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                        </div>
                        <div class="col-md-8">

                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
<!--Page Content End Here-->