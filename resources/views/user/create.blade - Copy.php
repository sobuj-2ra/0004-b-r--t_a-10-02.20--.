@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Create User
@endsection

<!--Page Header-->
@section('page-header')
    Create New User
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
                        <div class="col-md-3 change_passport_body" style="width: 24%;padding-left: 20px;border-top: none;">
                            @if (Session::has('message'))
                                <div class="">
                                    <div class="alert alert-info alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                        </button>
                                        <h4> {{ Session::get('message') }}</h4>
                                    </div>
                                </div>
                            @endif
                            <p class="form_title_center">
                                <i>-Create New User-</i>
                            </p>
                            <form method="POST" autocomplete="off" action="{{ url('/store') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="user_id"><i>USER NAME:</i></label>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                    <input type="text" class="form-control" name="name" id="user_id" required>
                                    <span id="status_response" style="font-size: 12px;float: right;"></span>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="new_password"><i>NEW PASSWORD:</i></label>
                                    <input type="password" class="form-control" name="password" id="new_password" required>
                                </div>
                                <div class="form-group">
                                    <label for="confirm_password"><i>CONFIRM PASSWORD:</i></label>
                                    <input type="password" class="form-control" name="password_confirmation"
                                           id="confirm_password" required>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <hr>
                                <div class="footer-box">
                                    <button type="reset" class="btn btn-danger">RESET</button>
                                    <button type="submit" id="submit" class="btn btn-info pull-right">ADD CIRCLE</button>
                                </div>

                        </div>
                        <div class="col-md-9">
                            <div style="">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="" style="border: 1px solid #ddd;">
                                            <h4 class="text-center bg-info" style="margin-top: 0px;  padding-top: 10px; padding-bottom: 10px">Settings</h4>
                                            <div style="padding-left: 5px; ">
                                                @foreach( $settings as $s)
                                                    @if($s->url_link == '#')
                                                        @foreach($s->sub_child as $data)
                                                                <p> <input type="checkbox" value="{{$data->id}}" name="id[]"> {{$data->menu}} </p>
                                                        @endforeach
                                                    @else
                                                        <p> <input type="checkbox" name="id[]" value="{{$s->id}}"> {{$s->menu}} </p>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="" style="border: 1px solid #ddd;">
                                            <h4 class="text-center bg-info" style="margin-top: 0px;  padding-top: 10px; padding-bottom: 10px">Operation</h4>
                                            <div style="padding-left: 5px; ">
                                                @foreach( $operations as $operation)
                                                    @if($operation->url_link == '#')
                                                        @foreach($operation->sub_child_operation as $data)
                                                            <p> <input type="checkbox" value="{{$data->id}}" name="id[]"> {{$data->menu}} </p>
                                                        @endforeach
                                                    @else
                                                        <p> <input type="checkbox" name="id[]" value="{{$operation->id}}"> {{$operation->menu}} </p>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="" style="border: 1px solid #ddd;">
                                            <h4 class="text-center bg-info" style="margin-top: 0px;  padding-top: 10px; padding-bottom: 10px">Reports</h4>
                                            <div style="padding-left: 5px; ">
                                                @foreach( $reports as $report)
                                                    @if($report->url_link == '#')
                                                        @foreach($report->sub_child as $data)
                                                            <p> <input type="checkbox" value="{{$data->id}}" name="id[]"> {{$data->menu}} </p>
                                                        @endforeach
                                                    @else
                                                        <p> <input type="checkbox" name="id[]" value="{{$report->id}}"> {{$report->menu}} </p>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </section>

@endsection
<!--Page Content End Here-->

