@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Port Endorsement
@endsection

<!--Page Header-->
@section('page-header')
    Delete Port Endorsement
@endsection

<!--Page Content Start Here-->
@section('page-content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="main_part">
                    <br>
                    {{--<div class="row">--}}
                    {{--@if (Session::has('message'))--}}
                    {{--<div class="col-md-6 col-md-offset-3 alert {{ Session::get('alert-class') }}">{{ Session::get('message') }}</div>--}}
                    {{--@endif--}}
                    {{--</div>--}}
                    @if (Session::has('message'))
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3 alert {{ Session::get('alert-class') }} alert-dismissible">
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
                                <i>-Delete Port Endorsement-</i>
                            </p>
                            {!! Form::open(['url' => '/delete_portendorsement-search','id' => 'applicant_form']) !!}
                            <div class="form-group">
                                <input class="form-control" name="passport" placeholder="Enter Passport"
                                       required="required" autocomplete="off">
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
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
    <?php if (isset($delete_data) && !empty($delete_data)){ ?>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="main_part">
                    <!-- Code Here.... -->
                    <div class="row" style="padding: 20px;">
                        <div class="col-md-12 change_passport_body" style="width: 100%">
                            <div class="panel panel-default">
                                <div class="panel-heading">

                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr style="background: #ddd;">
                                                <th scope="col">SL</th>
                                                <th scope="col">Applicant Name</th>
                                                <th scope="col">Passport</th>
                                                <th scope="col">Contact</th>
                                                <th scope="col">Sticker No</th>
                                                <th scope="col">Visa No</th>
                                                <th scope="col">Visa Type</th>
                                                <th scope="col">Fee</th>
                                                <th scope="col">Remarks</th>
                                                <th scope="col">Current Port</th>
                                                <th style="width: 200px;">Requested Ports</th>
                                                <th style="width: 200px;">Receive Date</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $i=0; foreach ($delete_data as $delete){ $i++; ?>
                                                <tr>
                                                    <td>{{$i}}</td>
                                                    <td>{{$delete->applicant_name}}</td>
                                                    <td>{{$delete->passport}}</td>
                                                    <td>{{$delete->contact}}</td>
                                                    <td>{{$delete->sticker}}</td>
                                                    <td>{{$delete->visa_no}}</td>
                                                    <td>{{$delete->visa_type}}</td>
                                                    <td>{{$delete->Fee}}</td>
                                                    <td>{{$delete->Remarks}}</td>
                                                    <td>{{$delete->OldPort}}</td>
                                                    <td>{{$delete->NewPort}}</td>
                                                    <td>{{date('d-m-Y', strtotime($delete->created_at))}}</td>
                                                    <td><a href="{{URL::to('/delete-port/'.$delete->serial_no)}}"><button type="button" class="btn btn-block btn-default">Delete</button></a></td>

                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.row (nested) -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>

@endsection