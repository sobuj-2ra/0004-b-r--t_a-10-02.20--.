@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Foreign Passport
@endsection

<!--Page Header-->
@section('page-header')
    Delete Foreign Passport
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
                            <div class="col-md-6 col-md-offset-3 alert alert-info alert-dismissible">
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
                                <i>-Delete Foreign Passport-</i>
                            </p>
                            {!! Form::open(['url' => 'foreign/delete-search','id' => 'applicant_form']) !!}
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

    <?php if (isset($deleteDatas)){ ?>
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
                                                <th scope="col">Web File Number</th>
                                                <th scope="col">Nationality</th>
                                                <th scope="col">Remarks</th>
                                                <th scope="col">Entry Date</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $i = 0; foreach ($deleteDatas as $deleteData) { $i++; ?>
                                            <tr>
                                                <td><?php echo $i;  ?></td>
                                                <td><?php echo $deleteData->app_name;  ?></td>
                                                <td><?php echo $deleteData->passport;  ?></td>
                                                <td><?php echo $deleteData->contact;  ?></td>
                                                <td><?php echo $deleteData->strk_no;  ?></td>
                                                <td><?php echo $deleteData->web_file_no;  ?></td>
                                                <td><?php echo $deleteData->nationality;  ?></td>
                                                <td><?php echo $deleteData->remarks;  ?></td>
                                                <td><?php echo date('d-m-Y', strtotime($deleteData->created_date));  ?></td>
                                                <td><a href="{{URL::to('/delete-foreign/'.$deleteData->id)}}"><button type="button" class="btn btn-block btn-default">Delete</button></a> </td>
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
<!--Page Content End Here-->
