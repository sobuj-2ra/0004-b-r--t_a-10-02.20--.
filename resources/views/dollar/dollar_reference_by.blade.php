@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Dollar Endorsement Referrer By
@endsection

<!--Page Header-->
@section('page-header')
    Dollar Endorsement Referrer By
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
                                <i>-Enter Referred Details-</i>
                            </p>
                            {!! Form::open(['url' => 'reference/store','id' => 'applicant_form']) !!}
                            <div class="form-group">
                                <input class="form-control" name="center" placeholder="center" required="required" autocomplete="off" value="{{$center}}" disabled>
                                <input type="hidden" class="form-control" name="center" placeholder="center" required="required" autocomplete="off" value="{{$center}}">
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="name" placeholder="Enter Name" required="required" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="refer_id" placeholder="Enter Unique ID" required="required" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="ivac_id" placeholder="Enter Employee ID" required="required" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="designation" placeholder="Enter Designation" required="required" autocomplete="off">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                            {!! Form::close() !!}
                        </div>
                        <div class="col-md-7 col-md-offset-1">
                            <table class="table table-striped">
                                <thead style="background: #ddd">
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Designation</th>
                                    <th scope="col">Employee ID</th>
                                    <th scope="col">Unique ID</th>
                                    <th scope="col">Center Name</th>
                                    <th scope="col" width="22%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 0; ?>
                                @foreach($refers as $refer)
                                    <?php $i++; ?>
                                    <tr>
                                        <th scope="row">{{$i}}</th>
                                        <td>{{$refer->name}}</td>
                                        <td>{{$refer->designation}}</td>
                                        <td>{{$refer->ivac_id}}</td>
                                        <td>{{$refer->refer_id}}</td>
                                        <td>{{$refer->center}}</td>
                                        <td>
                                            <a href="{{URL::to('edit_referrer/'.$refer->id)}}"><button class="btn btn-warning">Edit </button></a>
                                            <a href="{{URL::to('delete_refer/'.$refer->id)}}"><button class="btn btn-danger">Delete</button></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
<!--Page Content End Here-->