@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Add Currency Rate
@endsection

<!--Page Header-->
@section('page-header')
    Add Currency Rate
@endsection

<!--Page Content Start Here-->
@section('page-content')

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="main_part">
                    <br>
                    @if (Session::has('message'))
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3 alert alert-info alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                </button>
                                <h4> {{ Session::get('message') }}</h4>
                            </div>
                        </div>
                @endif
                <!-- Code Here.... -->
                    <div class="row">
                        <div class="col-md-4 change_passport_body"
                             style="width: 30%;padding-left: 33px;border-top: none;">
                            <p class="form_title_center bg-info">
                                <i>-Enter Currency Rate-</i>
                            </p>
                            {!! Form::open(['url' => 'currency/add','id' => 'applicant_form']) !!}
                            <div class="form-group">
                                <select class="form-control" name="currency" required>
                                    <option value="USD">USD</option>
                                    <option value="RUPEE">RUPEE</option>
                                </select>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control" name="rate" placeholder="Enter Currency Rate" required="required" autocomplete="off">
                                <span class="input-group-addon">Taka</span>
                            </div>
                            <br>

                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                            {!! Form::close() !!}
                        </div>
                        <div class="col-md-6 col-md-offset-1">
                            <table class="table table-striped">
                                <thead style="background: #ddd">
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Currency Name</th>
                                    <th scope="col">Currency Rate</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=0; foreach ($rate as $cr){ $i++ ?>
                                <tr>
                                    <th scope="row"><?php echo $i; ?></th>
                                    <td><?php echo $cr->currency_name ?></td>
                                    <td><?php echo $cr->currency_rate ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($cr->reg_date)) ?></td>
                                    <td>
                                        <a href="{{URL::to('edit_currency/'.$cr->id)}}"><button class="btn btn-warning">Edit </button></a>
                                        <a href="{{URL::to('delete_currency/'.$cr->id)}}"><button class="btn btn-danger">Delete</button></a>
                                    </td>
                                </tr>
                                <?php } ?>
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