@extends('admin.master')
<!--Page Title-->
@section('page-title')
    User List
@endsection

<!--Page Header-->
@section('page-header')
    User List
@endsection

<!--Page Content Start Here-->
@section('page-content')

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="main_part">
                    <br>

                <!-- Code Here.... -->
                    <div class="row">
                        @if (Session::has('message'))
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6 alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible" style="margin-left: 15px;">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                    </button>
                                    <h4> {{ Session::get('message') }}</h4>
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                        @endif
                        <div class="col-md-12" style="padding: 10px 23px 10px 23px">
                            <table class="table table-striped">
                                <thead style="background: #ddd">
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">User ID</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Center Type</th>
                                    <th scope="col">Center Name</th>
                                    <th scope="col">Menu Permission</th>
                                    {{--<th scope="col">Status</th>--}}
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 0; ?>
                                @foreach($users_list as $user_list)
                                    <?php $i++; ?>
                                    <tr>
                                        <th scope="row" style="border:1px solid #ddd">{{$i}}</th>
                                        <td style="border:1px solid #ddd">{{$user_list->user_id}}</td>
                                        <td style="border:1px solid #ddd">{{$user_list->name}}</td>
                                        <td style="border:1px solid #ddd">{{$user_list->center_type}}</td>
                                        <td style="border:1px solid #ddd">{{$user_list->center_name}}</td>
                                        <td style="border:1px solid #ddd"><?php
                                            $permission_id = explode(",", $user_list->menu_permitted);
                                            foreach ($permission_id as $item) {

                                                $data = DB::table('menus')
                                                    ->select('menu')
                                                    ->whereIn('id', $permission_id)
                                                    ->orderBy('id', 'asc')
                                                    ->get();

                                            }
                                            foreach ($data as $datum) {
                                                echo $datum->menu.', &nbsp &nbsp';
                                            }
                                        ?></td>
                                        <td style="border:1px solid #ddd">
                                            <a href="{{URL::to('/edit_user/'.$user_list->id)}}"><button class="btn btn-warning">Edit </button></a>
                                            <a href="{{URL::to('/delete_user/'.$user_list->id)}}"><button class="btn btn-danger">Delete</button></a>
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