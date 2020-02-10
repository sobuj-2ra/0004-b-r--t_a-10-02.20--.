@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Add Account Name
@endsection

<!--Page Header-->
@section('page-header')
    Add Account Name & Number
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
                                    <i>- Add Account Name & Number-</i>
                                </p>
                                <form action="{{URL::to('/store-account-name')}}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="form_date"><i>Service Name:</i></label>
                                        <select class="form-control" name="ivac_service" required>
                                            <option value="">Select Service</option>
                                            @foreach ($services as $service)
                                                <option value="{{ $service->Service }}"> {{ $service->Service }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="form_date"><i>SBI Branch:</i></label>
                                        <select class="form-control" name="sbi_branch" required>
                                            <option value="">Select SBI Branch</option>
                                            @foreach ($branches as $branch)
                                                <option value="{{ $branch->branch_name }}"> {{ $branch->branch_name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="">
                                        <div class="form-group">
                                            <label for="form_date"><i>Account Name:</i></label>
                                            <input type="text" class="form-control" name="account_name" value="" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="form-group">
                                            <label for="form_date"><i>Account No:</i></label>
                                            <input type="text" class="form-control" name="account_no" value="" autocomplete="off" required>
                                        </div>
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
                                            <th scope="col">Service</th>
                                            <th scope="col">SBI Branch</th>
                                            <th scope="col">Account Name</th>
                                            <th scope="col">Account No</th>

                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 0; ?>
                                        @foreach($names as $center)
                                            <?php $i++; ?>
                                            <tr>
                                                <th scope="row">{{$i}}</th>
                                                <td>{{$center->ivac_service}}</td>
                                                <td>{{$center->sbi_branch}}</td>
                                                <td>{{$center->account_name}}</td>
                                                <td>{{$center->account_no}}</td>

                                                <td>
                                                    <a href="{{URL::to('/edit-account-name/'.$center->id)}}"><button class="btn btn-warning">Edit </button></a>
                                                    <a href="{{URL::to('/delete-account-name/'.$center->id)}}"><button class="btn btn-danger">Delete</button></a>
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