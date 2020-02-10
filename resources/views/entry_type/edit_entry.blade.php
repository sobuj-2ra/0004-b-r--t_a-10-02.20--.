@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Entry Type
@endsection

<!--Page Header-->
@section('page-header')
    Edit Entry Type
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
                            <div class="col-md-6 col-md-offset-3 alert alert-{{ Session::get('alert-class') }} alert-dismissible">
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
                                <i>-Edit Entry Type-</i>
                            </p>
                            {!! Form::open(['url' => 'entry/update','id' => 'applicant_form']) !!}
                            <input type="hidden" name="id" value="{{$entry->id}}">
                            <div class="form-group">
                                <input class="form-control" name="entry_type" placeholder="Entry Type"
                                       required="required" autocomplete="off" value="{{$entry->entry_type}}">
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
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

@endsection
<!--Page Content End Here-->