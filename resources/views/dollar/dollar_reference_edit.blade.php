@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Dollar Endorsement Referred By
@endsection

<!--Page Header-->
@section('page-header')
    Dollar Endorsement Referrer Edit
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
                            <div class="col-md-6 col-md-offset-3 alert {{Session::get('alert-class')}} alert-dismissible">
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
                                <i>-Edit Referred Details-</i>
                            </p>
                            {!! Form::open(['url' => 'reference/update','id' => 'applicant_form']) !!}
                            <div class="form-group">
                                <input class="form-control" name="center" placeholder="center" required="required" autocomplete="off" value="{{$center->center_name}}" disabled>
                                <input type="hidden" class="form-control" name="center" placeholder="center" required="required" autocomplete="off" value="{{$center->center_name}}">
                                <input type="hidden" class="form-control" name="id" placeholder="center" autocomplete="off" value="{{$refer->id}}">
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="name" value="{{$refer->name}}" placeholder="Enter Name" required="required" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="refer_id" value="{{$refer->refer_id}}" placeholder="Enter Unique ID" required="required" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="ivac_id" value="{{$refer->ivac_id}}" placeholder="Enter Employee ID" required="required" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="designation" value="{{$refer->designation}}" placeholder="Enter Designation" required="required" autocomplete="off">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                            {!! Form::close() !!}
                        </div>
                        <div class="col-md-7 col-md-offset-1">

                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
<!--Page Content End Here-->