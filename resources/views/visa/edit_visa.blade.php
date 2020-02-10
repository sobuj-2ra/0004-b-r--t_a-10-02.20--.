@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Visa
@endsection

<!--Page Header-->
@section('page-header')
    Visa Type Edit
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
                                    Edit Visa Type
                                </div>

                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            {!! Form::open(['url' => '/visa/update','id' => 'applicant_form']) !!}
                                            <div class="form-group">
                                                <input class="form-control" name="visa_type" value="{{$edit_data->visa_type}}" placeholder="Enter visa type name" required="required" autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" name="symbol" value="{{$edit_data->symbol}}" placeholder="Enter symbol (Optional)" autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" name="days" value="{{$edit_data->days}}" placeholder="Enter Delivery lead time" required="required" autocomplete="off">
                                            </div>
                                            <input type="hidden" value="{{$edit_data->visa_type_id}}" name="id">
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