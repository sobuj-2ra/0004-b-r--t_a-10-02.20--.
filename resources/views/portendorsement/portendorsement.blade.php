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
    <!--Calling Controller here-->
    @php use\App\Http\Controllers\PortEndorsementController; @endphp

    <section class="content">
        <div class="row">
            <div class="l-mcod-12" style="padding: 30px">
                <div class="main_part">
                    @if(Session::has('message'))
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4 alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</div>
                        </div>
                @endif
                <!-- Code Here.... -->
                    <div style="padding: 10px;width: 95%;margin: 0 auto">
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div style="color:#808080;font-size:20px;float:right;">Total
                                    Receive: @php echo PortEndorsementController::total_receive() @endphp </div>
                                <br/></div>
                        </div>
                        {!! Form::open(['url' => "/portendorsement/save",'id' => 'applicant_form', 'name' => 'form1', 'onsubmit' => 'return(validate()']) !!}

                        <meta name="csrf-token" content="{{ csrf_token() }}"/>
                        <input type="hidden" name="center_name" value="{{$center_name[0]->center_name}}">
                        <input type="hidden" name="region" value="{{$center_name[0]->region}}">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <div class="form-inline">
                                <label style="">Service Type:</label>&nbsp;
                                <input type="text" class="form-control" id="serviceType" name="serviceType"
                                       value="Port Endorsement" style="width: 200px" required="required" readonly="">
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                    <!-- <br> -->
                    <hr>
                    <div class="row" style="margin: 10px"><!-- row start -->
                        <div class="col-md-4">
                            <div class="port">
                                <p class="port_title">-Current Port-</p>

                                @foreach ($routes as $routes_value)

                                    <ul>
                                        <li>

                                            <label class="check_container">
                                                <input class="checkCurrentPort" type="checkbox" id="checkCurrentPort"
                                                       name='current_port[]'
                                                       value="{{$routes_value->route_name}}"/>{{$routes_value->route_name}}
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                @endforeach
                            </div>
                            <div class="">
                                <input type="checkbox" onclick='current_select(this);' name="select all"> <label> Select
                                    all <label>
                            </div>
                        </div>
                        <!-- Middle -->
                        <div class="col-md-4" style="margin-left: -10px">
                            <br>
                            <!-- form here -->

                            <div style="margin-left: 2px">
                                <label style="margin-left: -10px">Sticker Type&nbsp;:</label>&nbsp;
                                <select style="width:70px;padding:3px" id="sticker_type" name="sticker_type"
                                        required="required">
                                    <option value="">Sticker Type</option>
                                    <?php foreach ($sticker as $sticker_value){ ?>
                                    <option <?php if($sticker_value->sticker == "$stype") { ?> selected="selected"
                                            <?php } ?> value="{{$sticker_value->sticker}}" <?php if (isset($type) && !empty($type)){
                                                if ($sticker_value->sticker == $type){
                                                    echo 'selected';
                                                }
                                            } ?>>
                                        {{$sticker_value->sticker}}
                                    </option>
                                    <?php }
                                    ?>
                                </select>
                                &nbsp;&nbsp;&nbsp;
                                <label>From</label>
                                <input type="text" id="sticker_no_from" name="sticker_no_from" style="width: 40px"
                                       value="{{$sfrom}}">
                                <label style="margin-left: 6px">To</label>
                                <input type="text" id="sticker_no_to" name="sticker_no_to" style="width: 40px"
                                       value="{{$sto}}">
                            </div>


                            <div>
                                <div class="input_label">
                                    <label>Passport:</label>
                                </div>
                                <div class="input_field">
                                    <input type="text" id="passport" name="passport" required="required"
                                           style="width:260px;" value="">

                                </div>
                                <span class="enter_press" style="margin-right: 10px">-PRESS ENTER-</span>
                            </div>
                            <br>
                            <div>
                                <div class="input_label">
                                    <label>Visa No:</label>
                                </div>
                                <div class="input_field"><input type="text" id="visa_no" name="visa_no"
                                                                style="width:260px" required="required"></div>
                            </div>

                            <div>
                                <div class="input_label">
                                    <label>Fee:</label>
                                </div>
                                <div class="input_field">
                                    <input type="text" id="fee" name="fee" value="{{$fee->Svc_Fee}}" required="required"
                                           style="width:260px" readonly=""/>
                                </div>
                            </div>

                            <div>
                                <div class="input_label">
                                    <label>Sticker No:</label>
                                </div>
                                <div class="input_field stck_no_chk"><input type="text" id="sticker_no"
                                                                            name="sticker_no" required="required"
                                                                            onchange="stickerFunction();"
                                                                            style="width:260px"></div>
                            </div>


                            <div>
                                <div class="input_label">
                                    <label>Name:</label>
                                </div>
                                <div class="input_field"><input type="text" id="name" name="name" required="required"
                                                                style="width:260px"></div>
                            </div>

                            <div>
                                <div class="input_label">
                                    <label>Visa Type:</label>
                                </div>
                                <div class="input_field">
                                    <select style="width:260px;padding:4px" id="visa_type" name="visa_type"
                                            required="required" class="visa_type">
                                        <option value="">Visa Type</option>
                                        <?php foreach ($visatype as $visatype_value){ ?>
                                        <option <?php if($visatype_value->visa_type == "$vt") { ?> selected="selected"
                                                <?php } ?> value="{{$visatype_value->visa_type}}">{{$visatype_value->visa_type}}</option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                            </div>


                            <div>
                                <div class="input_label">
                                    <label>Contact:</label>
                                </div>
                                <div class="input_field">
                                    <input type="text" id="contact" placeholder="1XXXXXXXXX" name="contactNo" pattern=".{10,10}" max="10" title="Min & max 10 digit"
                                           class="contact_valid" required="required" style="width:260px" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                </div>
                            </div>

                            <div>
                                <div class="input_label">
                                    <label>Remarks:</label>
                                </div>
                                <div class="input_field">
                                    <input type="text" id="remarks" name="remarks" style="width:260px">
                                </div>
                            </div>

                            <!-- form here -->
                        </div>
                        <div class="col-md-4" style="margin-left: 10px">
                            <div class="port">
                                <p class="port_title">-Required Port-</p>

                                @foreach ($routes as $routes_value)

                                    <ul>
                                        <li>

                                            <label class="check_container">
                                                <input class="checkRequiredPort" type="checkbox" id="checkRequiredPort"
                                                       name='require_port[]'
                                                       value="{{$routes_value->route_name}}"/>{{$routes_value->route_name}}
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                @endforeach
                            </div>
                            <div class="">
                                <input id='required_checkbox' type="checkbox" name="select all"
                                       onclick='reqired_select()'> <label> Select all <label>
                            </div>
                        </div>

                    </div><!-- row end -->
                    <hr>
                    <!-- row start -->
                    <div class="row" style="margin-left: 10px">

                        <div class="col-md-1">
                            <button type="submit" class="btn btn-default" onclick="check()" name="ADD" id="saveData" title="Submit"
                                    target="_blank">Submit
                            </button>
                        </div>

                        <div class="col-md-1">
                            <button type="reset" class="btn btn-default" id="clear" title="Clear">Clear</button>
                        </div>

                        <!--div class="col-md-1">
                            <button type="submit" class="btn btn-default" name="UPDATE" id="update" title="Update">Update</button>
                        </div-->

                        {!! Form::close() !!}


                        <div class="col-sm-7" style="display:block" id="total1"></div>

                    </div>
                    <br>
                    <!-- row end -->
                </div>
            </div>
        </div>

        <!-- Table -->

        </div>
    </section>
    <script>

        $("#passport").keyup(function () {
            var keyword = $(this).val();
            console.log(keyword);
            $.ajax({
                url: "{{ url("/search-passport-appointment") }}",
                type: 'GET',
                data: {keyword: keyword},
                cache: false,
                success: function (result) {
                    console.log(result);
                    if (result){
                        document.getElementById('name').value = '';
                        document.getElementById("contact").value = '';
                        // document.getElementById("visa_type").value = '';
                    }
                    if (result.Applicant_name == undefined) {
                        console.log(result);
                    } else {
                        document.getElementById('name').value = result.Applicant_name;
                        document.getElementById("contact").value = result.Contact;
                        // document.getElementById("visa_type").value = result.Visa_Type;
                    }


                    //document.getElementById("rate2").value=result.currency_rate;
                }
            }, 'json');
        });
    </script>
    <script>

        $("#sticker_no").blur(function () {
            var num = $(this).val();
            var min_range = document.getElementById("sticker_no_from").value;
            var max_le = document.getElementById("sticker_no_to").value;
            var strk_name = $('#sticker_type').children(":selected").attr('value');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })

            $.ajax({
                url: "{{url("/port-search-sticker-numbers")}}",
                type: 'GET',
                data: {numb: num, name: strk_name},
                success: function (result) {
                    if (result.length == 0) {

                    } else {
                        alert("This Striker number is already exist !");
                        document.getElementById("sticker_no").value = "";
                    }
                }
            });
        });
    </script>
@endsection

@section('page-script')

    <script type="text/javascript">
        var mobile_number = document.getElementById("contact").value;
        console.log(mobile_number);
        function check(){
            var mobile_number = document.getElementById("contact").value;
            var mobile_number_l = mobile_number.length;
            if (mobile_number_l <10 || mobile_number_l>10){
                alert('Mobile number must be 10 digit');
                document.getElementById("contact").style.border = "2px solid red";
                return false;
            }


        }

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
        //console.log('10');


        function stickerFunction() {

            var from = document.getElementById('sticker_no_from').value;
            console.log(from);
            var to = document.getElementById('sticker_no_to').value;
            var val = document.getElementById('sticker_no').value;
            console.log(to);

            if (parseInt(val, 10) > parseInt(to, 10)) {
                alert("Can't be greater than >" + to);
                return false;
            }

            if (parseInt(val, 10) < parseInt(from, 10)) {
                alert("Can't be smaller than >" + from);
                return false;
            }


        }

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
            // if (phone > 11) {
            //     alert('Max Phone Length 11');
            // }
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



