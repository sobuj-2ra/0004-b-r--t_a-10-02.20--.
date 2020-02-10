@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Edit Center
@endsection

<!--Page Header-->
@section('page-header')
    Edit Center
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
                        <div class="col-md-4">
                            <div class="change_passport_body" style="width: 100% !important;">
                                <p class="form_title_center">
                                    <i>-Edit Center Name-</i>
                                </p>
                                <form action="{{URL::to('/update-center')}}" method="POST">
                                    <input type="hidden" name="id" value="{{$names->centerinfo_id}}" >
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="form_date"><i>Center Type:</i></label>
                                        <select class="form-control" name="center_type" required>
                                            <option value="">Select Item</option>
                                            @foreach ($centers as $center)
                                                <option value="{{ $center->center_type }}" <?php if ($center->center_type == $names->center_type){ echo 'selected'; } ?>> {{ $center->center_type }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="form_date"><i>Center:</i></label>
                                        <input type="text" required class="form-control" name="center_name" value="{{$names->center_name}}" autocomplete="off">
                                    </div>
                                    {{--<div class="form-group">--}}
                                        {{--<label for="form_date"><i>Region:</i></label>--}}
                                        {{--<input type="text" required class="form-control" name="region" value="{{$names->region}}" autocomplete="off">--}}
                                    {{--</div>--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label for="form_date"><i>Center Phone:</i></label>--}}
                                        {{--<input type="text" required class="form-control" name="center_phone" value="{{$names->center_phone}}" autocomplete="off">--}}
                                    {{--</div>--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label for="form_date"><i>Center Info:</i></label>--}}
                                        {{--<input type="text" required class="form-control" name="center_info" value="{{$names->center_info}}" autocomplete="off">--}}
                                    {{--</div>--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label for="form_date"><i>Center Fax:</i></label>--}}
                                        {{--<input type="text" required class="form-control" name="center_fax" value="{{$names->center_fax}}" autocomplete="off">--}}
                                    {{--</div>--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label for="form_date"><i>Center Web:</i></label>--}}
                                        {{--<input type="text" required class="form-control" name="center_web" value="{{$names->center_web}}" autocomplete="off">--}}
                                    {{--</div>--}}
                                    <?php //$time = explode("-", $names->del_time); ?>
                                    {{--<div class="bootstrap-timepicker">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label>Delivery Time Start:</label>--}}
                                            {{--<div class="input-group">--}}
                                                {{--<input type="text" name="del_time_start" class="form-control timepicker" value="{{$time[0]}}">--}}
                                                {{--<div class="input-group-addon">--}}
                                                    {{--<i class="fa fa-clock-o"></i>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="bootstrap-timepicker">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label>Delivery Time End:</label>--}}
                                            {{--<div class="input-group">--}}
                                                {{--<input type="text" name="del_time_end" class="form-control timepicker" value="{{$time[1]}}">--}}
                                                {{--<div class="input-group-addon">--}}
                                                    {{--<i class="fa fa-clock-o"></i>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    <hr>
                                    <div class="footer-box">
                                        <button type="reset" class="btn btn-danger">RESET</button>
                                        <button type="submit" id="submit" class="btn btn-info pull-right">STORE</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-8">

                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </section>
@endsection
<!--Page Content End Here--