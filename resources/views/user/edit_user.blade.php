@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Edit User
@endsection

<!--Page Header-->
@section('page-header')
    Edit User
@endsection

<!--Page Content Start Here-->
@section('page-content')

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="main_part">
                    <br>
                    <!-- Code Here.... -->
                    <div class="row">
                        <div class="col-md-3 change_passport_body"
                             style="width: 24%;padding-left: 20px;border-top: none;">
                            @if (Session::has('message'))
                                <div class="row">
                                    <div class="col-md-11 alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible" style="margin-left: 15px;">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                        </button>
                                        <h4> {{ Session::get('message') }}</h4>
                                    </div>
                                </div>
                            @endif
                            <p class="form_title_center">
                                <i>-Create New User-</i>
                            </p>
                            <form method="POST" id="advancedSearchForm" action="{{ url('/update_user') }}">
                                {{--<form>--}}
                                {{ csrf_field() }}
                                <input type="hidden" name="u_id" value="{{$edit_data->id}}">
                                <div class="form-group">
                                    <label for="new_password"><i>User ID:</i></label>
                                    <input type="text" class="form-control" name="user_id" value="{{$edit_data->user_id}}" required placeholder="User ID (Required)">
                                </div>
                                <div class="form-group">
                                    <label for="user_id"><i>USER NAME:</i></label>
                                    <input type="text" class="form-control" name="name" id="user_id" placeholder="User Name (Optional)" value="{{$edit_data->name}}">
                                </div>
                                <div class="form-group">
                                    <label for="form_date"><i>Center Type:</i></label>
                                    <select class="form-control" name="center_type" id="center_type" required>
                                        <option value="{{ $edit_data->center_type }}" selected> {{ $edit_data->center_type }} </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="form_date"><i>Center Name:</i></label>
                                    <select class="form-control" name="center_name" id="search-result" required>
                                        <option value="{{ $edit_data->center_name }}" selected> {{ $edit_data->center_name }} </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="new_password"><i>Password:</i></label>
                                    <input type="password" class="form-control" name="password" id="password"  placeholder="Password" >
                                </div>
                                <div class="form-group">
                                    <label for="new_password"><i>Confirm Password:</i></label>
                                    <input type="password" class="form-control" name="cfmPassword" id="confirm_password"  placeholder="Re-type Password" >
                                    <span id='message'></span>
                                </div>
                                <hr>
                                <div class="footer-box">
                                    <button type="reset" class="btn btn-danger">RESET</button>
                                    <button type="submit" id="submit" onclick="isClick()" class="btn btn-info pull-right">Update
                                    </button>
                                </div>

                        </div>
                        <div class="col-md-9">
                            <div style="">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="" style="border: 1px solid #ddd;">
                                            <h4 class="text-center bg-info"
                                                style="margin-top: 0px;  padding-top: 10px; padding-bottom: 10px">
                                                Settings</h4>
                                            <div style="padding-left: 5px; ">
                                                @foreach($settings as $s)
                                                    @if($s->menu == 'Settings')
                                                        {{--<p> <input type="checkbox" name="id[]" value="{{$s->id}}"> {{$s->menu}}--}}
                                                        @foreach($s->sub_menu as $sub)
                                                            <p style="margin-left: 5px;"><input type="checkbox" class="settingsCheck" name="id[]" value="{{$sub->id}}"
                                                                @foreach($permission_id as $p_id)
                                                                    @if($p_id == $sub->id)
                                                                        {{'checked'}}
                                                                     @endif
                                                                @endforeach
                                                                > {{$sub->menu}}</p>


                                                            @foreach($sub->child_menu as $child_menu)
                                                                    <p style="margin-left: 30px;"><input type="checkbox" class="settingsCheck" name="id[]" value="{{$child_menu->id}}"
                                                                        @foreach($permission_id as $p_id)
                                                                            @if($p_id == $child_menu->id)
                                                                                {{'checked'}}
                                                                            @endif
                                                                        @endforeach
                                                                        > {{$child_menu->menu}}</p>
                                                            @endforeach
                                                        @endforeach
                                                    @endif
                                                @endforeach

                                            </div>
                                        </div>
                                        <span style="border: 2px solid #009bca;padding: 0px 6px 0px 5px;background: #009bca;"><input type="checkbox" id="settingsCheck">Check All</span>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="" style="border: 1px solid #ddd;">
                                            <h4 class="text-center bg-info"
                                                style="margin-top: 0px;  padding-top: 10px; padding-bottom: 10px">
                                                Operation</h4>
                                            <div style="padding-left: 5px; ">
                                                @foreach($settings as $s)
                                                    @if($s->menu == 'Operation')
                                                        {{--<p> <input type="checkbox" name="id[]" value="{{$s->id}}"> {{$s->menu}}--}}
                                                        @foreach($s->sub_menu as $sub)
                                                            <p style="margin-left: 5px;"><input type="checkbox" class="operationCheck" name="id[]" value="{{$sub->id}}"
                                                                @foreach($permission_id as $p_id)
                                                                    @if($p_id == $sub->id)
                                                                        {{'checked'}}
                                                                            @endif
                                                                        @endforeach
                                                                > {{$sub->menu}}
                                                            @foreach($sub->child_menu as $child_menu)
                                                                <p style="margin-left: 30px;"><input type="checkbox" class="operationCheck" name="id[]" value="{{$child_menu->id}}"
                                                                    @foreach($permission_id as $p_id)
                                                                        @if($p_id == $child_menu->id)
                                                                            {{'checked'}}
                                                                        @endif
                                                                     @endforeach
                                                                    > {{$child_menu->menu}}
                                                            @endforeach
                                                        @endforeach
                                                    @endif
                                                @endforeach

                                            </div>
                                        </div>
                                        <span style="border: 2px solid #009bca;padding: 0px 6px 0px 5px;background: #009bca;"><input type="checkbox" id="operationCheck">Check All</span>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="" style="border: 1px solid #ddd;">
                                            <h4 class="text-center bg-info"
                                                style="margin-top: 0px;  padding-top: 10px; padding-bottom: 10px">
                                                Reports</h4>
                                            <div style="padding-left: 5px; ">
                                                @foreach($settings as $s)
                                                    @if($s->menu == 'Report')
                                                        {{--<p> <input type="checkbox" name="id[]" value="{{$s->id}}"> {{$s->menu}}--}}
                                                        @foreach($s->sub_menu as $sub)
                                                            <p style="margin-left: 5px;"><input type="checkbox" class="reportsCheck" name="id[]" value="{{$sub->id}}"
                                                                @foreach($permission_id as $p_id)
                                                                    @if($p_id == $sub->id)
                                                                        {{'checked'}}
                                                                            @endif
                                                                        @endforeach
                                                                > {{$sub->menu}}
                                                            @foreach($sub->child_menu as $child_menu)
                                                                <p style="margin-left: 30px;"><input type="checkbox" class="reportsCheck" name="id[]" value="{{$child_menu->id}}"
                                                                    @foreach($permission_id as $p_id)
                                                                        @if($p_id == $child_menu->id)
                                                                            {{'checked'}}
                                                                                @endif
                                                                            @endforeach
                                                                    > {{$child_menu->menu}}
                                                            @endforeach
                                                        @endforeach
                                                    @endif
                                                @endforeach

                                            </div>

                                        </div>
                                        <span style="border: 2px solid #009bca;padding: 0px 6px 0px 5px;background: #009bca;"><input type="checkbox" id="checkAll">Check All</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="permission" id="permission" value="">
                        {!! Form::close() !!}
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </section>
    <script>
        $("#checkAll").click(function () {
            $('.reportsCheck').not(this).prop('checked', this.checked);
        });
        $("#settingsCheck").click(function () {
            $('.settingsCheck').not(this).prop('checked', this.checked);
        });
        $("#operationCheck").click(function () {
            $('.operationCheck').not(this).prop('checked', this.checked);
        });
        $('#password, #confirm_password').on('keyup', function () {
            if ($('#password').val() == $('#confirm_password').val()) {
                $('#message').html('Matching').css('color', 'green');
            } else
                $('#message').html('Not Matching Confirm Password').css('color', 'red');
        });
    </script>
    <script>

        $('select[name="center_type"]').on('change', function () {
            var keyword = $(this).val();
            $.ajax({
                url: "{{ url("/search-center-name") }}",
                type: 'GET',
                data: {keyword: keyword},
                cache: false,
                success: function (result) {
                    var item = [];
                    item.push('<select class="form-control" name="center_name" required><option value="">Select Item</option>');
                    $.each(result, function (kay, val) {
                        item.push('<option value="' + val.center_name + '">' + val.center_name + '</option>')
                    });
                    item.push('</select>');
                    if (keyword === '') {
                        $('#search-result').html('');
                    } else {
                        $('#search-result').html(item.join(''));
                    }
                }
            }, 'json');

        });
    </script>
    <script>
        var name = '<?php echo $edit_data->center_type; ?>';
        if (name  == 'Admin') {
            $('select[name="center_type"]').on('change', function () {
                var keyword = $(this).val();
                $.ajax({
                    url: "{{ url("/search-menu-permission") }}",
                    type: 'GET',
                    data: {keyword: keyword},
                    cache: false,
                    success: function (data) {
                        var item = [];
                        var item2 = [];
                        var item3 = [];
                        $.each(data, function (kay, val) {
                            if (val.menu === 'Settings') {
                                $.each(val.sub_menu, function (kay, sub) {
                                    item.push('<p style="margin-left: 5px;"><input type="checkbox"  class="settingsCheck" name="id[]" value="' + sub.id + '">' + sub.menu)
                                    $.each(sub.child_menu_for_search, function (kay, child) {
                                        item.push('<p style="margin-left: 30px;"><input type="checkbox" class="settingsCheck" name="id[]" value="' + child.id + '">' + child.menu)
                                    });
                                });
                            }
                            if (val.menu === 'Operation') {
                                $.each(val.sub_menu, function (kay, sub) {
                                    item2.push('<p style="margin-left: 5px;"><input type="checkbox" class="operationCheck" name="id[]" value="' + sub.id + '">' + sub.menu)
                                    $.each(sub.child_menu_for_search, function (kay, child) {
                                        item2.push('<p style="margin-left: 30px;"><input type="checkbox" class="operationCheck" name="id[]" value="' + child.id + '">' + child.menu)
                                    });
                                });
                            }
                            if (val.menu === 'Report') {

                                $.each(val.sub_menu, function (kay, sub) {
                                    item3.push('<p style="margin-left: 5px;"><input type="checkbox" class="reportsCheck" name="id[]" value="' + sub.id + '">' + sub.menu)
                                    $.each(sub.child_menu_for_search, function (kay, child) {
                                        item3.push('<p style="margin-left: 30px;"><input type="checkbox" class="reportsCheck" name="id[]" value="' + child.id + '">' + child.menu)
                                    });
                                });
                            }
                        });
                        if (keyword === '') {
                            $('#search-menu').html('');
                            $('#search-menu-opreration').html('');
                            $('#search-menu-report').html('');
                        } else {
                            $('#search-menu').html(item.join(''));
                            $('#search-menu-opreration').html(item2.join(''));
                            $('#search-menu-report').html(item3.join(''));
                        }
                    }
                }, 'json');

            });
        }

    </script>
    <script type="text/javascript">
        function isClick() {
            var checkboxes = document.getElementsByName('id[]');
            var vals = "";
            for (var i=0, n=checkboxes.length;i<n;i++)
            {
                if (checkboxes[i].checked)
                {
                    vals += checkboxes[i].value+",";
                }
            }

            document.getElementById("permission").value=vals;


        }
    </script>
    <script>

    </script>
@endsection
<!--Page Content End Here-->

