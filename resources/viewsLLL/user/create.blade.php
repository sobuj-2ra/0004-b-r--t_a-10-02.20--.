@include('admin.inc.header')
@include('admin.inc.leftmenu')
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Create User</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
     
    <div class="row">


        <div class="col-md-6">
            <div class="register-logo">
                <a class="text-center" href="#"><b>Create</b></a>
            </div>

            <div class="register-box-body col-md-8 col-xs-offset-2">
                {{--<p class="login-box-msg">Register a new membership</p>--}}

                <form class="form-horizontal" method="POST" action="{{ url('/store') }}">
                    {{ csrf_field() }}
                    <div class="form-group has-feedback">
                        @if ($errors->has('name'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif
                        <input type="text" class="form-control" placeholder="Full name" name="name" required>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif


                    </div>

                    <div class="form-group has-feedback">
                        <input type="email" class="form-control" placeholder="Email" name="email" required>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif


                    </div>

                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>


                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Retype password"
                               name="password_confirmation"
                               required>
                        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif


                    </div>
                    <div class="row">

                        <!-- /.col -->
                        <div class="col-xs-4 pull-right">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Create</button>
                        </div>
                        <!-- /.col -->
                    </div>


            </div>
            <!-- /.form-box -->
        </div>

        <div class="col-md-6">
            <div class="form-group col-md-8">
                <div class="register-logo">
                    <a href="#"><b>Roles</b></a>
                </div>
                <hr>
                @foreach($roles as $key=>$role)
                    <input type="checkbox" name="roles[]" id="examplepermission" value="{{$key}}"><label
                            class="label label-success badge-pill">{{$role}}</label>
                @endforeach
            </div>

        </div>
        </form>
    </div>
    <!-- /.register-box -->

                  </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-8 -->
                
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

@include('admin.inc.footer')




