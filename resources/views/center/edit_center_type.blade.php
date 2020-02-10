@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Edit Center Type
@endsection

<!--Page Header-->
@section('page-header')
    Edit Center Type
@endsection

<!--Page Content Start Here-->
@section('page-content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="main_part">
                    <br>
                    @if(Session::has('message'))
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4 alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</div>
                        </div>
                @endif
                <!-- Code Here.... -->
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-4"><br>
                            <div class="change_passport_body" style="width: 100% !important;">
                                <p class="form_title_center">
                                    <i>-Edit Center Type-</i>
                                </p>
                                <form action="{{URL::to('/update-center-type')}}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" value="{{$centers->id}}" name="id">
                                    <div class="form-group">
                                        <label for="form_date"><i>Center Type:</i></label>
                                        <input type="text" class="form-control" name="center_type" value="{{$centers->center_type}}" autocomplete="off" placeholder="Center Type" >
                                    </div>
                                    <hr>
                                    <div class="footer-box">
                                        <button type="reset" class="btn btn-danger">RESET</button>
                                        <button type="submit" id="submit" class="btn btn-info pull-right">STORE</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6">

                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </section>
@endsection
<!--Page Content End Here--