@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Ready At Center
@endsection

<!--Page Header-->
@section('page-header')
    Edit Ready at Center

@endsection

<!--Page Content Start Here-->
@section('page-content')

    <!--Calling Controller here-->
    <div class="row" style="margin-left: 0px !important;margin-right: 0px !important; padding-top: 0px;padding-left:20px; padding-bottom: 20px">
        <div class="col-md-12">
            <div class="row" style="padding: 10px;margin-right: 0px;margin-left: 0px;">
                <div class="col-md-6">
                    @if (Session::has('message'))
                        <div class="alert {{ Session::get('msgType') }}">{{ Session::get('message') }}</div>
                    @endif
                </div>
            </div>
            <div class="row main_part" style="background: #f3f3f3;">
                @if(isset($readyEditData))
                    <div class="col-md-12">
                        <div class="edit-receive-pass-area">
                            <form action="{{URL::to('ready-center/edit-store')}}" method="post" class="">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-md-8">
                                        <table class="table table-responsive">
                                            <tr>
                                                <th>Passport</th>
                                                <th>Webfile</th>
                                                <th>Date Time</th>
                                                <th>User By</th>
                                            </tr>
                                            <tr style="background: #fff;">
                                                <td>{{$readyEditData->Passport}}</td>
                                                <td>{{$readyEditData->WebFile_no}}</td>
                                                <td>{{$readyEditData->ReadyCentertime}}</td>
                                                <td>{{$readyEditData->ReadyCenterby}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-12">
                                        <a  onclick="return confirm('Are you sure! Do you want to Delete?')" href="{{URL::to('ready-center/edit-destroy').'/'.$readyEditData->WebFile_no}}" name="delete" value="Delete" class="btn btn-danger">Delete</a>&nbsp;&nbsp;&nbsp;&nbsp;<a
                                                href="{{URL::to('/ready-at-center-edit')}}" class="btn btn-info">Cancel</a>
                                        <p></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @elseif(isset($status))
                    <h3 class="text-center">{{$status}}</h3>
                    <p class="text-center"><a href="{{URL::to('/ready-at-center-edit')}}" class="btn btn-primary">Search Again</a></p>
                @else
                    <div class="col-md-4" style="padding: 30px 30px 100px 30px">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Please Fill up the below field
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        {!! Form::open(['url' => '/ready-at-center-edit','id' => 'applicant_edit_form']) !!}
                                        <div class="form-group">
                                            <label for="passDate">Select Date</label>
                                            <input type="text" name="passDate" id="passDate" value="<?php echo Date('d-m-Y'); ?>" id="tddDateId"  data-date-format="dd/mm/yyyy"  autocomplete="off" class="form-control datepicker">
                                        </div>
                                        <div class="form-group">
                                            <label for="passno">Passport Number</label>
                                            <input class="form-control" id="passno" name="PassportNo" placeholder="Enter Passport No"
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
                        <a href="{{URL::to('/ready-at-center-edit')}}" style="padding-left: 16px"><button type="submit" class="btn btn-outline-info"> Refresh &nbsp;<i class="fa fa-refresh" aria-hidden="true"></i></button></a>
                    </div>
                    <div class="col-md-8"></div>

                @endif
            </div>
        </div>
    </div>



@endsection