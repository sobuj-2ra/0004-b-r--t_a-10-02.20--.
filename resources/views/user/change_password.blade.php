@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Change Password
@endsection

<!--Page Header-->
@section('page-header')
    Change Password
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
                            <div class="col-md-6 col-md-offset-3 alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                </button>
                                <h4> {{ Session::get('message') }}</h4>
                            </div>
                        </div>
                    @endif
                <!-- Code Here.... -->
                    <div class="row" style="padding: 20px;">
                        <div class="col-md-4">

                        </div>
                        <div class="col-md-4 change_passport_body" style="width: 33%">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Change Password
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            {!! Form::open(['url' => '/password-changed','id' => 'applicant_form']) !!}
                                            <div class="form-group">
                                                <label>Old Password</label>
                                                <input type="password" class="form-control" name="old_password" placeholder="Old Password" id="old_password" required="required" autocomplete="off">
                                                <span id='error'></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="new_password">New Password</label>
                                                <input type="password" class="form-control" name="password" id="password" required placeholder="New Password">
                                            </div>
                                            <div class="form-group">
                                                <label for="new_password">Confirm Password</label>
                                                <input type="password" class="form-control" name="cfmPassword" id="confirm_password" required placeholder="Re-type Password">
                                                <span id='message'></span>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <button type="reset" class="btn btn-default">Reset</button>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                    <!-- /.row (nested) -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                        </div>
                        <div class="col-md-4">

                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </section>
<script>
    $('#password, #confirm_password').on('keyup', function () {
        if ($('#password').val() == $('#confirm_password').val()) {
            $('#message').html('Matching').css('color', 'green');
        } else
            $('#message').html('Not Matching Confirm Password').css('color', 'red');
    });
    $('#old_password').on('keyup', function () {
        var old_pass = $(this).val();
        $.ajax({
            url: "{{ url("/search-old-password") }}",
            type: 'GET',
            data: {keyword: old_pass},
            cache: false,
            success: function (result) {
                if (result) {
                    $('#error').html('Matching').css('color', 'green');
                } else
                    $('#error').html('Not Matching Confirm Password').css('color', 'red');

            }
        }, 'json');



    });
</script>
@endsection
<!--Page Content End Here-->