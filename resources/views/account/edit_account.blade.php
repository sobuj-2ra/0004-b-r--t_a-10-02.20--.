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
                                <form action="{{URL::to('/update-account-name')}}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id" value="{{$account->id}}">
                                    <div class="form-group">
                                        <label for="form_date"><i>Service Name:</i></label>
                                        <select class="form-control" name="ivac_service" required>
                                            <option value="">Select Service</option>
                                            @foreach ($services as $service)
                                                <option value="{{ $service->Service }}" <?php if ($account->ivac_service == $service->Service){ echo 'selected'; } ?>> {{ $service->Service }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="form_date"><i>SBI Branch:</i></label>
                                        <select class="form-control" name="sbi_branch" required>
                                            <option value="">Select SBI Branch</option>
                                            @foreach ($branches as $branch)
                                                <option value="{{ $branch->branch_name }}" <?php if ($account->sbi_branch == $branch->branch_name){ echo 'selected'; } ?>> {{ $branch->branch_name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="">
                                        <div class="form-group">
                                            <label for="form_date"><i>Account Name:</i></label>
                                            <input type="text" class="form-control" name="account_name" value="{{$account->account_name}}" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="form-group">
                                            <label for="form_date"><i>Account No:</i></label>
                                            <input type="text" class="form-control" name="account_no" value="{{$account->account_no}}" autocomplete="off">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="footer-box">
                                        <button type="reset" class="btn btn-danger">RESET</button>
                                        <button type="submit" id="submit" class="btn btn-info pull-right">UPDATE</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-8">

                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </section>
@endsection