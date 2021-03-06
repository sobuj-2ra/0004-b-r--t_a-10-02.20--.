@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Port Endorsement Details Report
@endsection

<!--Page Header-->
@section('page-header')
    Port Endorsement Details Report
@endsection

<!--Page Content Start Here-->
@section('page-content')

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="main_part">
                    <br>
                    <!-- Code Here.... -->
                    <div class="change_passport_body">
                        <p class="form_title_center">
                            <i>Port Endorsement Details Report</i>
                        </p>
                        <form action="{{ URL::to('port-details-report-search') }}" method="post" target="_blank">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="status"><i>User Id:</i></label>
                                <select class="form-control" name="user_id">
                                    <option value="all" selected="">All</option>
                                    <?php foreach ($details as $user){ ?>
                                    <option value="{{$user->rec_cen_by}}">{{$user->rec_cen_by}}</option>
                                    <?php } ?>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="form_date"><i>FORM DATE:</i></label>
                                <input type="text" class="form-control datepicker" name="from_date" data-date-format="dd/mm/yyyy" required autocomplete="off" value="<?php echo date('d-m-Y'); ?>">
                                <span id="status_response" style="font-size: 12px;float: right;"></span>
                            </div>
                            <div class="form-group">
                                <label for="to_date"><i>TO DATE:</i></label>
                                <input type="text" class="form-control datepicker" name="to_date" data-date-format="dd/mm/yyyy" required autocomplete="off" value="<?php echo date('d-m-Y'); ?>">
                            </div>
                            <hr>
                            <div class="footer-box">
                                <button type="reset" class="btn btn-danger">RESET</button>
                                <button type="submit" id="submit" class="btn btn-info pull-right">SUBMIT</button>
                            </div>
                        </form>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </section>

@endsection
