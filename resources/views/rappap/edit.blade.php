@extends('admin.master')
<!--Page Title-->
@section('page-title')
    R.A.P. / P.A.P.
@endsection

<!--Page Header-->
@section('page-header')
    Edit R.A.P. / P.A.P.
@endsection

<!--Page Content Start Here-->
@section('page-content')
    <!--Calling Controller here-->
    <div class="row" style="margin-left: 0px !important;margin-right: 0px !important; padding-top: 20px;padding-left:20px; padding-bottom: 20px">
        <div class="col-md-12">
            <div class="row" style="padding: 10px;margin-right: 0px;margin-left: 0px;">
                <div class="col-md-6">
                    @if (Session::has('message'))
                        <div class="alert alert-info">{{ Session::get('message') }}</div>
                    @endif
                </div>
            </div>
            <div class="row main_part">
                <div class="col-md-4" style="padding: 30px 30px 100px 30px">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Please Fill up the below field
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    {!! Form::open(['url' => 'rap/pap/edit/action','id' => 'applicant_edit_form']) !!}
                                    <div class="form-group">
                                        <input class="form-control" name="PassportNo" placeholder="Enter Passport No"
                                               required="required">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Search</button>
                                    <button type="reset" class="btn btn-default">Reset</button>
                                    {!! Form::close() !!}
                                </div>
                            </div>

                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <br>
                    <a href="{{URL::to('/rap/pap/edit/search/passport')}}" style="padding-left: 16px"><button type="submit" class="btn btn-outline-info"> Refresh &nbsp;<i class="fa fa-refresh" aria-hidden="true"></i></button></a>
                </div>
                <div class="col-md-8"></div>
            </div>
        </div>
    </div>

@endsection