@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Edit SBI Branch Name
@endsection

<!--Page Header-->
@section('page-header')
    Edit SBI Branch Name & Address
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
                        <div class="col-md-12">
                            <div class="change_passport_body" style="width: 100% !important;">
                                <p class="form_title_center">
                                    <i>- Edit SBI Branch Name & Address-</i>
                                </p>
                                <form action="{{URL::to('/update-branch-name')}}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group col-md-3">
                                        <label for="form_date"><i>Center Type:</i></label>
                                        <select class="form-control" name="center_type" required>
                                            <option value="">Select Item</option>
                                                <option value="{{ $branch->center_type }}" selected> {{ $branch->center_type }} </option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="form_date"><i>SBI Branch Name:</i></label>
                                        <input type="text" class="form-control" name="branch_name" value="{{ $branch->branch_name }}" autocomplete="off">
                                        <input type="hidden" class="form-control" name="id" value="{{ $branch->id }}" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="form_date"><i>SBI Branch Address:</i></label>
                                        <input type="text" class="form-control" name="address" value="{{$branch->address}}" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="form_date"><i>SBI Branch Phone:</i></label>
                                        <input type="text" class="form-control" name="phone" value="{{$branch->phone}}" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="form_date"><i>SBI Branch Fax:</i></label>
                                        <input type="text" class="form-control" name="fax" value="{{$branch->fax}}" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="form_date"><i>SBI Branch Email:</i></label>
                                        <input type="email" class="form-control" name="email" value="{{$branch->email}}" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="form_date"><i>Enquiry Phone:</i></label>
                                        <input type="text" class="form-control" name="enquery_phone" value="{{$branch->enquery_phone}}" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="form_date"><i>Enquiry Email:</i></label>
                                        <input type="email" class="form-control" name="enquery_email" value="{{$branch->enquery_email}}" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="form_date"><i>Manager Signature:</i></label>
                                        <input type="file" name="manager_signature" id="fileToUpload">
                                    </div>
                                    <hr>
                                    <div class="footer-box col-md-3">
                                        <button type="submit" id="submit" class="btn btn-info pull-right">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-8">

                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </section>
@endsection