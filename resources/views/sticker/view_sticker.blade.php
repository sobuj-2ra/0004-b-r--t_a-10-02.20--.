@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Sticker List
@endsection

<!--Page Header-->
@section('page-header')
    Sticker List
@endsection
<!--Page Content Start Here-->
@section('page-content')

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="main_part">
                    @if(Session::has('message'))
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3 alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</div>
                        </div>
                    @endif
                    <!-- Code Here.... -->
                    <div id="">
                        <div class="table_view" style="padding: 10px">
                            <div class="panel-body">
                                <table width="100%" class="table-bordered table" style="font-size:14px;">
                                    <thead style="background:#ddd">
                                    <tr>
                                        <th scope="col">SL</th>
                                        <th scope="col">Sticker</th>
                                        <th scope="col">Center</th>
                                        <th scope="col">Region</th>
                                        <th scope="col">Remarks</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 0; ?>
                                    @foreach($stickers as $sticker)
                                        <?php $i++; ?>
                                        <tr>
                                            <th scope="row">{{$i}}</th>
                                            <td>{{$sticker->sticker}}</td>
                                            <td>{{$sticker->center}}</td>
                                            <td>{{$sticker->region}}</td>
                                            <td>{{$sticker->remarks}}</td>
                                            <td>
                                                <a href="{{URL::to('edit_sticker/'.$sticker->id)}}"><button class="btn btn-warning">Edit </button></a>
                                                <a href="{{URL::to('delete_sticker/'.$sticker->id)}}"><button class="btn btn-danger">Delete</button></a>
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
            </div>
        </div>
    </section>
@endsection