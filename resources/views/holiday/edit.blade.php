@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Add Holiday
@endsection

<!--Page Header-->
@section('page-header')
    Update Holiday
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
                                    <i>- Update Holiday-</i>
                                </p>
                                <form action="{{URL::to('/update-holiday')}}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id" value="{{$h_date->hday_id}}" />
                                    <div class="">
                                        <div class="form-group">
                                            <label for="form_date"><i>Holiday Date</i></label>
                                            <input type="text" class="form-control datepicker" name="date" autocomplete="off" value="{{date('d-m-Y', strtotime($h_date->date))}}" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="form_date"><i>Short Description</i></label>
                                        <input type="text" class="form-control" value="{{$h_date->description}}" name="description" autocomplete="off">
                                    </div>
                                    <hr>
                                    <div class="footer-box">
                                        <button type="reset" class="btn btn-danger">RESET</button>
                                        <button type="submit" id="submit" class="btn btn-info pull-right">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-8">
                            <div class="table_view" style="padding: 10px">
                                <div class="panel-body">

                                    <!-- /.table-responsive -->

                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </section>
@endsection