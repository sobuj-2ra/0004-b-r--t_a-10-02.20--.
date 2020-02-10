@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Add Holiday
@endsection

<!--Page Header-->
@section('page-header')
    Add Holiday
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
                                    <i>- Add Holiday-</i>
                                </p>
                                <form action="{{URL::to('/store-holiday')}}" method="POST">
                                    {{ csrf_field() }}

                                    <div class="">
                                        <div class="form-group">
                                            <label for="form_date"><i>Holiday Date</i></label>
                                            <input type="text" class="form-control datepicker" name="date" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="form_date"><i>Short Description</i></label>
                                        <input type="text" class="form-control" name="description" autocomplete="off">
                                    </div>
                                    <hr>
                                    <div class="footer-box">
                                        <button type="reset" class="btn btn-danger">RESET</button>
                                        <button type="submit" id="submit" class="btn btn-info pull-right">STORE</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-8">
                            <div class="table_view" style="padding: 10px">
                                <div class="panel-body">
                                    <table width="80%" class="table-bordered table" style="font-size:14px;">
                                        <thead style="background:#ddd">
                                        <tr>
                                            <th scope="col">SL</th>
                                            <th scope="col">Holiday Date</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 0; ?>
                                        @foreach($holidays as $holiday)
                                            <?php $i++; ?>
                                            <tr>
                                                <th scope="row">{{$i}}</th>
                                                <td>{{ date('d-m-Y', strtotime($holiday->date)) }}</td>
                                                <td>{{$holiday->description}}</td>
                                                <td>
                                                    <a href="{{URL::to('/edit-holiday/'.$holiday->hday_id)}}"><button class="btn btn-warning">Edit </button></a>
                                                    <a href="{{URL::to('/delete-holiday/'.$holiday->hday_id)}}"><button class="btn btn-danger">Delete</button></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
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