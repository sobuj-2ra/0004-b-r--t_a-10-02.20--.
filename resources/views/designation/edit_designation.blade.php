@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Designation Edit
@endsection

<!--Page Header-->
@section('page-header')
    Designation Edit
@endsection

<!--Page Content Start Here-->
@section('page-content')

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="main_part">
                    <br>

                    <!-- Code Here.... -->
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4 change_passport_body"
                             style="padding-left: 33px;border-top: none;">
                            @if (Session::has('message'))
                                <div class="">
                                    <div class="alert alert-info alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                        </button>
                                        <h4> {{ Session::get('message') }}</h4>
                                    </div>
                                </div>
                            @endif
                            <p class="form_title_center bg-info">
                                <i>-Edit Designation-</i>
                            </p>
                            <form action="{{URL::to('/update_designation')}}" method="get">
                                @csrf
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Designation</label>
                                    <input type="text" class="form-control" name="designation"
                                           value="{{$designation_data->designation}}">
                                </div>
                                <input type="hidden" name="id" value="{{$designation_data->id}}">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <button type="reset" class="btn btn-default">Reset</button>
                            </form>
                        </div>

                        <br>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection