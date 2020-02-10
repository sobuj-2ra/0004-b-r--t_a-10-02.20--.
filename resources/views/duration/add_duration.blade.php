@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Duration
@endsection

<!--Page Header-->
@section('page-header')
    Add Duration
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
                            <div class="col-md-6 col-md-offset-3 alert alert-{{ Session::get('alert-class') }} alert-dismissible">
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
                                <i>-Enter Duration-</i>
                            </p>
                            {!! Form::open(['url' => 'duration/store','id' => 'applicant_form']) !!}
                            <div class="form-group">
                                <input class="form-control" name="duration" placeholder="Duration "
                                       required="required" autocomplete="off">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                            {!! Form::close() !!}
                        </div>
                        <div class="col-md-6 col-md-offset-1">
                            <table class="table table-striped">
                                <thead style="background: #ddd">
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Duration</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 0; ?>
                                @foreach($durations as $duration)
                                    <?php $i++; ?>
                                    <tr>
                                        <th scope="row">{{$i}}</th>
                                        <td>{{$duration->duration}}</td>
                                        <td>
                                            <a href="{{URL::to('edit_duration/'.$duration->id)}}"><button class="btn btn-warning">Edit </button></a>
                                            <a href="{{URL::to('delete_duration/'.$duration->id)}}"><button class="btn btn-danger">Delete</button></a>
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