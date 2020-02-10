<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="{{ asset('public/assets/icon/icon.png')}}"/>
    <title>BRTA Call</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Icon -->
    <link rel="icon" type="image/png" href="{{asset('public/assets/icon/icon.png')}}"/>
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('public/assets/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('public/assets/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('public/assets/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('public/assets/css/AdminLTE.min.css') }}">
    <!-- Skin Blue -->
    <link rel="stylesheet" href="{{asset('public/assets/css/skins/skin-blue.min.css') }}">
    <!-- Style css -->
    <link rel="stylesheet" href="{{asset('public/assets/css/style.css') }}">
    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <!-- Date picker css -->
    <link rel="stylesheet" href="{{asset('public/assets/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{asset('public/assets/css/all.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href=""><b>BRTA</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        @if(Session::has('message'))
            <div class="row">
                <div class="col-md-12 alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</div>
            </div>
        @endif
        <?php
        $user = \App\Http\Controllers\UserController::check_user();
        if ($user > 0){ ?>

        <p class="login-box-msg">
            <i></i>
        </p>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group has-feedback">
                <input type="text" class="form-control" name="user_id" placeholder="User ID" required autocomplete="off">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary sing_in_btn">Sign In</button>
                </div>
                <div class="col-xs-2">
                    <div class="social-auth-links text-center">

                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-6">
                    <p class="forgot">

                    </p>
                </div>
                <!-- /.col -->
            </div>
        </form>
        <?php
        }else{ ?>

        <p class="login-box-msg">
        </p>
        <form method="POST" action="{{ URL::route("first-user") }}">
            @csrf
            <div class="form-group has-feedback">
                <input type="text" class="form-control" name="user_id" placeholder="User ID" required>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary sing_in_btn">Sign Up</button>
                </div>
                <div class="col-xs-2">

                </div>
                <!-- /.col -->
                <div class="col-xs-6">
                </div>
                <!-- /.col -->
            </div>
        </form>
        <?php
        }
        ?>

        <div class="social-auth-links text-center">
            <!--  -->
        </div>

        <p class="powered">
            <a href="http://166.62.19.0/2ra/index.php" target="_blank">

            </a>
        </p>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->


</body>
</html>
