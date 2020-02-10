@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Port Endorsement
@endsection

<!--Page Header-->
@section('page-header')
    Edit Port Endorsement
@endsection

<!--Page Content Start Here-->
@section('page-content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="main_part">
                    <br>
                    {{--<div class="row">--}}
                    {{--@if (Session::has('message'))--}}
                    {{--<div class="col-md-6 col-md-offset-3 alert {{ Session::get('alert-class') }}">{{ Session::get('message') }}</div>--}}
                    {{--@endif--}}
                    {{--</div>--}}
                    @if (Session::has('message'))
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3 alert alert-info alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                </button>
                                <h4> {{ Session::get('message') }}</h4>
                            </div>
                        </div>
                @endif
                <!-- Code Here.... -->
                    <div class="row">
                        <div class="col-md-4 change_passport_body"
                             style="width: 30%;padding-left: 33px;border-top: none;">
                            <p class="form_title_center bg-info">
                                <i>-Edit Port Endorsement-</i>
                            </p>
                            {!! Form::open(['url' => '/edit-port-endorsement/search','id' => 'applicant_form']) !!}
                            <div class="form-group">
                                <input class="form-control" name="passport" placeholder="Enter Passport"
                                       required="required" autocomplete="off">
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                            {!! Form::close() !!}
                        </div>
                        <div class="col-md-6 col-md-offset-1">

                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php if (isset($messages) && !empty($messages)){
    echo $messages;
} ?>

@endsection