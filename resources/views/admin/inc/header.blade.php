<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>BRTA QMS</title>
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
    <link rel="stylesheet" href="{{asset('public/dist/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{asset('public/assets/bootstrap/timepicker/bootstrap-timepicker.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('public/assets/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{asset('public/assets/css/select2.min.css') }}">
    <!-- Skin Blue -->
    <link rel="stylesheet" href="{{asset('public/assets/css/skins/skin-blue.min.css') }}">
    <!-- Style css -->
    <link rel="stylesheet" href="{{asset('public/assets/css/style.css') }}">
    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <!-- Date picker css -->
    <link rel="stylesheet" href="{{asset('public/assets/css/jquery-ui.css') }}">
    {{--<link rel="stylesheet" href="{{asset('public/assets/css/all.css') }}">--}}
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('public/admin/vendor/datatables/css/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <!-- jQuery 3 -->
    <script src="{{asset('public/assets/jquery/jquery.min.js') }}"></script>
    <script src="{{asset('public/assets/js/barcode.all.js') }}"></script>
    <script src="{{asset('public/assets/js/vue.js') }}"></script>
    <script src="{{asset('public/assets/js/axios.js') }}"></script>
    <style type="text/css">
        div.dataTables_wrapper {
            width: 100%;
            margin: 0 auto;
        }
    </style>
    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper noprint">
    <!-- Header section -->
    <header class="main-header">
        <!-- Logo -->
        <a href="{{URL('/')}}" class="logo">
            <span class="logo-mini"><b>BQ</b>  MS</span>
            <span class="logo-lg"><b>BRTA</b>-QMS</span>
        </a>
        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span style="font-size: 15px">{{ Auth::user()->user_id }}</span>
                        </a>
                        <ul class="dropdown-menu" style="width: 160px !important;">
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out text-aqua"></i> {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>


                    <!-- Control Sidebar Toggle Button -->
                </ul>
            </div>


            <div class="navbar-custom-menu">
                <P style="color: #FFFFFF;margin: 15px 11px;letter-spacing: 0.5px">
                    Welcome : <?php echo Session::get('user_id'); ?>
                </P>
            </div>
        </nav>

    </header>
    <!-- Header section -->
