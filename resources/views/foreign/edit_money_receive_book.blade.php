@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Receive Foreign Passport
@endsection

<!--Page Header-->
@section('page-header')
    Edit Receive Money Book
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
                                <i>Edit Money Receive Book Entry</i>
                            </p>
                            {!! Form::open(['url' => 'book/update','id' => 'applicant_form']) !!}
                            <div class="form-group">
                                <input class="form-control" name="center" placeholder="center_name" required="required" autocomplete="off" value="{{$get_data->center_name}}" disabled>
                                <input type="hidden" class="form-control" name="center_name" placeholder="center" required="required" autocomplete="off" value="{{$get_data->center_name}}">
                                <input type="hidden" class="form-control" name="id" placeholder="center" required="required" autocomplete="off" value="{{$get_data->id}}">
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="book_no" placeholder="Enter Book No." value="{{$get_data->book_no}}" required="required" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="start_no" placeholder="Enter Start Receive Number" value="{{$get_data->start_no}}" required="required" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="end_no" placeholder="Enter End Receive Number" value="{{$get_data->end_no}}" required="required" autocomplete="off">
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
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