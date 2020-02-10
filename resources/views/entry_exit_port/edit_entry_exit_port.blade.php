@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Edit Entry / Exit Port
@endsection

<!--Page Header-->
@section('page-header')
    Edit Entry / Exit Port
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
                                    Edit Entry / Exit Port
                                </div>

                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            {!! Form::open(['url' => 'entry-exit-port/update','id' => 'applicant_form']) !!}
                                            <div class="form-group">
                                                <input class="form-control" name="port_name" value="{{$edit_data->route_name}}" required="required">
                                                <input type="hidden" name="id" value="{{$edit_data->route_id}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="form_date"><i>Service Type:</i></label>
                                                <select class="form-control" name="service_type" id="" required>
                                                    <option value="<?php echo $edit_data->service_type ?>" selected> <?php echo $edit_data->service_type ?> </option>
                                                </select>
                                            </div>
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