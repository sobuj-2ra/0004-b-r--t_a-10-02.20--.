@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Edit Currency Rate
@endsection

<!--Page Header-->
@section('page-header')
    Edit Currency Rate
@endsection

<!--Page Content Start Here-->
@section('page-content')

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="main_part">
                <!-- Code Here.... -->
                    <div class="row">
                        <div class="col-md-4 change_passport_body"
                             style="width: 30%;padding-left: 33px;border-top: none;">
                            <p class="form_title_center bg-info">
                                <i>-Edit Currency Rate-</i>
                            </p>
                            {!! Form::open(['url' => 'currency/update','id' => 'applicant_form']) !!}
                            <div class="form-group">
                                <input class="form-control" name="currency" placeholder="" value="<?php echo $rate->currency_name; ?>" disabled>
                                <input type="hidden" class="form-control" name="currency" placeholder="<?php echo $rate->currency_name; ?>" value="<?php echo $rate->currency_name; ?>">
                                <input type="hidden" class="form-control" name="id" placeholder="USD" value="{{$rate->id}}">
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="rate" placeholder="Enter Currency Rate" required="required" value="{{$rate->currency_rate}}">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                            {!! Form::close() !!}
                        </div>
                        <div class="col-md-6 col-md-offset-1">

                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
<!--Page Content End Here-->