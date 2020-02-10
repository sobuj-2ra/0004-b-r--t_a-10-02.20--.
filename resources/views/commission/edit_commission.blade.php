@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Add Commission
@endsection

<!--Page Header-->
@section('page-header')
    Update Commission
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
                                    <i>- Update Commission-</i>
                                </p>
                                <form action="{{URL::to('/update-commission')}}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id" value="{{$commission->id}}">
                                    <div class="form-group">
                                        <label for="form_date"><i>Service Name:</i></label>
                                        <select class="form-control" name="ivac_service" required>
                                            <option value="Dollar Endorsement">Dollar Endorsement</option>
                                        </select>
                                    </div>
                                    <div class="">
                                        <div class="form-group">
                                            <label for="form_date"><i>Commission (%):</i></label>
                                            <input type="text" class="form-control" name="commission" value="{{$commission->commission}}" autocomplete="off" required>
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