@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Add Center Type
@endsection

<!--Page Header-->
@section('page-header')
    Add Center Type
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

                        <div class="col-md-4"><br>
                            <div class="change_passport_body" style="width: 100% !important;">
                                <p class="form_title_center">
                                    <i>-Add Center Type-</i>
                                </p>
                                <form action="{{URL::to('/store-center-type')}}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="form_date"><i>Center Type:</i></label>
                                        <input type="text" class="form-control" name="center_type" value="" autocomplete="off" placeholder="Center Type">
                                    </div>
                                    <hr>
                                    <div class="footer-box">
                                        <button type="reset" class="btn btn-danger">RESET</button>
                                        <button type="submit" id="submit" class="btn btn-info pull-right">STORE</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="table_view" style="padding: 10px">
                                <div class="panel-body">
                                    <table width="80%" class="table-bordered table" style="font-size:14px;">
                                        <thead style="background:#ddd">
                                        <tr>
                                            <th scope="col">SL</th>
                                            <th scope="col">Center Type</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 0; ?>
                                        @foreach($centers as $center)
                                            <?php $i++; ?>
                                            <tr>
                                                <th scope="row">{{$i}}</th>
                                                <td>{{$center->center_type}}</td>
                                                <td>
                                                    <a href="{{URL::to('/edit-center-type/'.$center->id)}}"><button class="btn btn-warning">Edit </button></a>
                                                    <a href="{{URL::to('/delete-center-type/'.$center->id)}}"><button class="btn btn-danger">Delete</button></a>
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
<!--Page Content End Here--