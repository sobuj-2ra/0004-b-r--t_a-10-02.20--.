@extends('master.master')

@section('content')

    <div class="col-md-6 clo-xs-offset-3">
        <div class="login-logo">
            <a href="#"><b>Create</b>Menu</a>
        </div>


    <form class="col-md-10 " action="{{route('store')}}" method="post">
        {{csrf_field()}}
        <div class="form-group has-feedback">
            <input type="text" class="form-control" name="menu" placeholder="Menu">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>

        <div class="form-group has-feedback">
            <select class="form-control" name="parent_id">

                <option value="">Select Item</option>

                @foreach ($menus as $menu)
                    <option value="{{ $menu->id }}" {{ ( $menu->id == $menu->parent_id) ? 'selected' : '' }}> {{ $menu->menu }} </option>
                @endforeach    </select>
            {{--<input type="text" class="form-control" name="menu" placeholder="Menu">--}}
            {{--<span class="glyphicon glyphicon-envelope form-control-feedback"></span>--}}
        </div>

        <div class="form-group has-feedback">
            <input type="text" class="form-control" name="url_link" placeholder="URL LINK">
            <span class="glyphicon glyphicon-link form-control-feedback"></span>
        </div>

        <div class="row">

            <!-- /.col -->
            <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Create Menu</button>
            </div>
            <!-- /.col -->
        </div>
    </form>

    </div>

    </div>


@endsection