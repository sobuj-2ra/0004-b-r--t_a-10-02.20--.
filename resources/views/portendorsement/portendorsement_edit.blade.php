@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Port Endorsment
@endsection
<!--Page Header-->
@section('page-header')
    Port Endorsement Form
@endsection

<!--Page Content Start Here-->
@section('page-content')
    <section class="content">
        <div class="row">
            <div class="l-mcod-12">
                <div class="main_part">
                    @if(Session::has('message'))
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4 alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</div>
                        </div>
                    @endif
                <!-- Code Here.... -->
                    @php

                        $current_port = explode(',',$data->OldPort);
                        $require_port  = explode(',',$data->NewPort);

                    @endphp

                    <div style="padding: 10px;width: 95%;margin: 0 auto">
                        <br>
                        <div class="row">
                            {!! Form::open(['url' => "/update_portendorsement",'id' => 'applicant_form', 'name' => 'form1', 'onsubmit' => 'return(validate()']) !!}
                            <meta name="csrf-token" content="{{ csrf_token() }}"/>
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <div class="form-inline">
                                    <label style="">Service Type:</label>&nbsp;
                                    <input type="text" class="form-control" id="serviceType" name="serviceType"
                                           value="Port Endorsement" style="width: 200px" required="required"
                                           readonly="">
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                        <!-- <br> -->
                        <hr>
                        <div class="row"><!-- row start -->
                            <div class="col-md-4">
                                <div class="port">
                                    <p class="port_title">-Current Port-</p>

                                    @foreach ($routes as $routes_value)

                                        <ul>
                                            <li>

                                                <label class="check_container">
                                                    <input class="checkCurrentPort" type="checkbox"
                                                           id="checkCurrentPort" name='current_port[]'
                                                           value="{{$routes_value->route_name}}"
                                                           @php if (in_array($routes_value->route_name, array_map("trim", $current_port))) { @endphp checked @php } @endphp/>
                                                    {{$routes_value->route_name}}
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                        </ul>
                                    @endforeach
                                </div>
                                <div class="">
                                    <input type="checkbox" onclick='current_select(this);' name="select all"> <label>
                                        Select all <label>
                                </div>
                            </div>
                            <!-- Middle -->
                            <div class="col-md-4" style="margin-left: -10px">
                                <br>
                                <!-- form here -->
                                <div>
                                    <div class="input_label">
                                        <label>Sticker :</label>
                                    </div>
                                    <div class="input_field"><input type="text" id="sticker" name="sticker"
                                                                    value="{{$data->sticker}}" required="required"
                                                                    style="width:260px"></div>
                                </div>

                                <div>
                                    <div class="input_label">
                                        <label>Passport:</label>
                                    </div>
                                    <div class="input_field">
                                        <input type="text" id="passport" name="passport" required="required"
                                               value="{{$data->passport}}" style="width:260px;">
                                    </div>
                                    <span class="enter_press" style="margin-right: -20px">-PRESS ENTER-</span>
                                </div>
                                <br>
                                <div>
                                    <div class="input_label">
                                        <label>Visa No:</label>
                                    </div>
                                    <div class="input_field"><input type="text" id="visa_no" name="visa_no"
                                                                    style="width:260px" value="{{$data->visa_no}}"
                                                                    required="required"></div>
                                </div>

                                <div>
                                    <div class="input_label">
                                        <label>Correction:</label>
                                    </div>
                                    <div class="input_field">
                                        <input type="text" id="fee" name="fee" value="{{$fee->Svc_Fee}}"
                                               required="required" style="width:260px" readonly=""/>
                                    </div>
                                </div>


                                <div>
                                    <div class="input_label">
                                        <label>Name:</label>
                                    </div>
                                    <div class="input_field"><input type="text" id="name" name="name"
                                                                    required="required" style="width:260px"
                                                                    value="{{$data->applicant_name}}"></div>
                                </div>

                                <div>
                                    <div class="input_label">
                                        <label>Visa Type:</label>
                                    </div>
                                    <div class="input_field">
                                        <select style="width:260px;padding:4px" id="visa_type" name="visa_type"
                                                required="required" class="visa_type">
                                            <option value="">Visa Type</option>
                                            @foreach($visatype as $visatype_value)
                                                <option @php if($visatype_value->visa_type==$data->visa_type) { @endphp selected="selected"
                                                        @php } @endphp  value="{{$visatype_value->visa_type}}">
                                                    {{$visatype_value->visa_type}}
                                                </option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div>
                                    <div class="input_label">
                                        <label>Contact:</label>
                                    </div>
                                    <div class="input_field">
                                        <input type="text" id="contact" name="contactNo"
                                               placeholder="Contact No 10 Digit" pattern="[1-9]{1}[0-9]{9}"
                                               class="contact_valid" required="required" value="{{$data->contact}}"
                                               style="width:260px">
                                    </div>
                                </div>

                                <div>
                                    <div class="input_label">
                                        <label>Remarks:</label>
                                    </div>
                                    <div class="input_field">
                                        <input type="text" id="remarks" name="remarks" value="{{$data->Remarks}}"
                                               style="width:260px">
                                    </div>
                                </div>
                                <input type="hidden" id="serial_number" name="serial_number"
                                       value="{{$data->serial_no}}">
                                <!-- form here -->
                            </div>
                            <div class="col-md-4" style="margin-left: 10px">
                                <div class="port">
                                    <p class="port_title">-Required Port-</p>

                                    @foreach ($routes as $routes_value)

                                        <ul>
                                            <li>

                                                <label class="check_container">
                                                    <input class="checkRequiredPort" type="checkbox"
                                                           id="checkRequiredPort" name='require_port[]'
                                                           value="{{$routes_value->route_name}}"
                                                           @php if (in_array($routes_value->route_name, array_map("trim", $require_port))) { @endphp checked @php } @endphp/>
                                                    {{$routes_value->route_name}}
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                        </ul>
                                    @endforeach

                                </div>
                                <div class="">
                                    <input id='required_checkbox' type="checkbox" ;' name="select all"
                                    onclick='reqired_select()'> <label> Select all <label>
                                </div>
                            </div>

                        </div><!-- row end -->

                        <hr>
                        <!-- row start -->
                        <div class="row" style="margin-left: 10px">

                            <div class="col-md-1">
                                <button type="submit" class="btn btn-default" name="Update" onclick="return my_save();"
                                        id="saveData" title="Submit" target="_blank">Update
                                </button>
                            </div>
                            {!! Form::close() !!}

                            <div class="col-sm-7" style="display:block" id="total1"></div>

                        </div>
                        <br>
                        <!-- row end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('page-script')


    <script type="text/javascript">
        /*function my_save() {
            document.getElementById("applicant_form").submit();
        }*/

        function validate() {
            if (document.form1.name.value == "") {
                alert("Please provide your name!");
                document.form1.name.focus();
                return false;
            }
            if (document.form1.current_port[].value == "") {
                alert("Please provide current_port ");
                document.form1.current_port[].focus();
                return false;
            }
            if (document.myForm.require_port[].value == "") {
                alert("Please provide require_port !");
                document.form1.require_port[].focus();
                return false;
            }
            if (document.myForm.contactNo.value == "") {
                alert("Please provide contactNo !");
                document.form1.contactNo.focus();
                return false;
            }
            if (document.myForm.visa_type.value == "") {
                alert("Please provide visa_type !");
                document.form1.visa_type.focus();
                return false;
            }
            if (document.myForm.sticker_no.value == "") {
                alert("Please provide sticker_no !");
                document.form1.sticker_no.focus();
                return false;
            }
            if (document.myForm.sticker_type.value == "") {
                alert("Please provide sticker_typet !");
                document.form1.sticker_type.focus();
                return false;
            }
            if (document.myForm.visa_no.value == "") {
                alert("Please provide visa_no !");
                document.form1.visa_no.focus();
                return false;
            }
            if (document.myForm.passport.value == "") {
                alert("Please provide passport !");
                document.form1.passport.focus();
                return false;
            }
            return (true);
        }

    </script>

    <script type="text/javascript">

        function current_select(source) {
            var checkboxes = document.querySelectorAll('input[name="current_port[]"]');
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i] != source)
                    checkboxes[i].checked = source.checked;
            }
        }

        function reqired_select() {
            alert("You can not select all required port");
            document.getElementById("required_checkbox").checked = false;
        }

        $('input[type=checkbox].checkRequiredPort').click(function (e) {
            //alert('ooooooo');
            var num_checked = $("input[type=checkbox].checkRequiredPort:checked").length;
            if (num_checked > 2) {
                $(e.target).prop('checked', false);
                alert("Exceed Maximum Limit of 2");
            }
        });

        /*$(document).ready(function () {
                        $(".alert").fadeOut(3500);

        $("#applicant_form").submit(function (event) {


        if ($('input[type=checkbox].checkCurrentPort:checked').length == 0){
            alert('Please select Current Port');
            return false;
            }

            if ($('input[type=checkbox].checkRequiredPort:checked').length == 0){
            alert('Please select Required Port');
            return false;
            }

            //$("#submit_confirm").modal('show');
            return false;
        });

    });*/

        $('#contact').on('keyup', function () {
            var phone = $(this).val().length;
            if (phone > 10) {
                alert('Max Phone Length 10');
            }
        });

        $('#applicant_form').on('submit', function (e) {
            if ($('input[class^="checkRequiredPort"]:checked').length === 0) {
                alert('Please select Required Port');
                return false;
            }
        });

        $('#applicant_form').on('submit', function (e) {
            if ($('input[class^="checkCurrentPort"]:checked').length === 0) {
                alert('Please select Current Port');
                return false;
            }
        });


    </script>



@endsection