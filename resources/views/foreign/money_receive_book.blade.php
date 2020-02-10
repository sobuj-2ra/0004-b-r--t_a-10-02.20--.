@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Receive Foreign Passport
@endsection

<!--Page Header-->
@section('page-header')
    Receive Foreign Passport
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
                                <i>Money Receive Book Entry</i>
                            </p>
                            {!! Form::open(['url' => 'book/store','id' => 'applicant_form']) !!}
                            <div class="form-group">
                                <input class="form-control" name="center" placeholder="center_name" required="required" autocomplete="off" value="{{$center}}" disabled>
                                <input type="hidden" class="form-control" name="center_name" placeholder="center" required="required" autocomplete="off" value="{{$center}}">
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="book_no" placeholder="Enter Book No." required="required" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="start_no" placeholder="Enter Start Receipt Number" required="required" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="end_no" placeholder="Enter End Receipt Number" required="required" autocomplete="off">
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
                                    <th scope="col">Center Name</th>
                                    <th scope="col">Book No.</th>
                                    <th scope="col">Start No.</th>
                                    <th scope="col">End No.</th>
                                    <th scope="col" width="22%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 0; ?>
                                @foreach($get_data as $get)
                                    <?php $i++; ?>
                                    <tr>
                                        <th scope="row">{{$i}}</th>
                                        <td>{{$get->center_name}}</td>
                                        <td>{{$get->book_no}}</td>
                                        <td>{{$get->start_no}}</td>
                                        <td>{{$get->end_no}}</td>
                                        <td>
                                            <a href="{{URL::to('edit_money_receive/'.$get->id)}}"><button class="btn btn-warning">Edit </button></a>
                                            <a href="{{URL::to('delete_money_receive/'.$get->id)}}"><button class="btn btn-danger">Delete</button></a>
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