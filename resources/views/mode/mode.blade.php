@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Transport Mode
@endsection

<!--Page Header-->
@section('page-header')
    Transport Mode
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
                            <div class="col-md-6 col-md-offset-3 alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                </button>
                                <h4> {{ Session::get('message') }}</h4>
                            </div>
                        </div>
                @endif
                <!-- Code Here.... -->
                    <div class="row" style="padding: 20px;">
                        <div class="col-md-4 change_passport_body" style="width: 30%">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Transport Mode
                                </div>

                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            {!! Form::open(['url' => 'mode/store','id' => 'applicant_form']) !!}
                                            <div class="form-group">
                                                <input class="form-control" name="mode_name" placeholder="Enter Transport Mode" required="required" autocomplete="off">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <button type="reset" class="btn btn-default">Reset</button>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                    <!-- /.row (nested) -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                        </div>
                        <div class="col-md-8">
                            <table width="100%" class="table-bordered table" style="font-size:14px;">
                                <thead style="background:#ddd">
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col" width="40%">Mode Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 0; ?>
                                @foreach($mode_names as $mode_name)
                                    <?php $i++; ?>
                                    <tr>
                                        <th scope="row">{{$i}}</th>
                                        <td>{{$mode_name->mode}}</td>
                                        <td>
                                            <a href="{{URL::to('/edit-mode-port/'.$mode_name->serial_no)}}"><button class="btn btn-warning">Edit </button></a>
                                            <a href="{{URL::to('/mode-port-delete/'.$mode_name->serial_no)}}"><button class="btn btn-danger">Delete</button></a>
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