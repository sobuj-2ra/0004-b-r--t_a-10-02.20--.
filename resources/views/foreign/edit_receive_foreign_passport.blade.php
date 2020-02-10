@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Receive Foreign Passport
@endsection

<!--Page Header-->
@section('page-header')
    Edit Receive Foreign Passport
@endsection

<!--Page Content Start Here-->
@section('page-content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="main_part">
                    <br>
                    {{--<div class="row">--}}
                        {{--@if (Session::has('message'))--}}
                            {{--<div class="col-md-6 col-md-offset-3 alert {{ Session::get('alert-class') }}">{{ Session::get('message') }}</div>--}}
                        {{--@endif--}}
                    {{--</div>--}}
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
                                <i>-Edit Receive Foreign Passport-</i>
                            </p>
                            {!! Form::open(['url' => '/edit-receive-foreign-passport/search','id' => 'applicant_form']) !!}
                            <div class="form-group">
                                <input class="form-control" name="passport" placeholder="Enter Passport"
                                       required="required" autocomplete="off">
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
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
<?php if (isset($editData) && !empty($editData)){ ?>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="main_part">
                    <br>
                    <!-- Code Here.... -->
                    <div class="change_passport_body" style="width:100%;margin: 3px">

                        <form method="POST" autocomplete="off" action="{{ URL::to('update-foreign-passport') }}"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="<?php echo $editData->id ?>">
                            <input type="hidden" name="rupee" value="<?php echo $editData->rupee_rate ?>">
                        <?php if($editData->gratis_status == 'yes'){ ?>
                            <div class="row">
                                <div class="col-md-1" style="padding-right: 0px">
                                    <h4>GRATIS:</h4>
                                </div>
                                <div class="col-md-1" style="padding-right: 0px;padding-left: 0px">
                                    <div class="checkbox">
                                        <label>
                                            <input type="radio" name="gratis_status" id="gratiseYes" value="yes" <?php if($editData->gratis_status == 'yes'){ echo 'checked'; } ?> required> Yes
                                        </label>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <input class="form-control" value="Book no-<?php  echo $editData->book_no;  ?>" name="book_no"
                                               placeholder="Book No" autocomplete="off" disabled>
                                        <input type="hidden" class="form-control" value="<?php echo $editData->book_no; ?>" name="book_no" id="book_no"
                                               placeholder="Book No" autocomplete="off" >
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <input class="form-control" name="receive_no" id="receive" value="<?php echo $editData->receive_no; ?>" placeholder="Receipt No" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <input class="form-control" name="strk_number" id="number" value="<?php echo $editData->strk_no; ?>" placeholder="Sticker No" autocomplete="off" required>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input class="form-control" name="passport" placeholder="Passport" id="passport"  value="<?php echo $editData->passport; ?>" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input class="form-control " id="name" name="app_name"  value="<?php echo $editData->app_name; ?>" placeholder="Name of Applicant" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input class="form-control" name="contact" pattern=".{10}" title="Minimum & Maximum 10 digit" id="contact" placeholder="Contact"  value="<?php echo $editData->contact; ?>" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input class="form-control" id="web" name="web_file_no"  value="<?php echo $editData->web_file_no; ?>" placeholder="Web file number" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input class="form-control" name="nationality" placeholder="Nationality"  value="<?php echo $editData->nationality; ?>" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input class="form-control" name="date_of_checking" id="date"  value="<?php echo date('m/d/Y', strtotime($editData->date_of_checking)); ?>" placeholder="Date of Checking" required>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select class="form-control" name="duration" required>
                                            <option value="">Select Duration</option>
                                            <?php foreach ($duration as $item) { ?>
                                            <option value="<?php  echo $item->duration; ?>" <?php if ($item->duration == $remarks[0]){ echo 'selected'; } ?>><?php  echo $item->duration; ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select class="form-control" name="entry_type" required>
                                            <option value="">Entry Type</option>
                                            <?php foreach ($entry_type as $item) { ?>
                                            <option value="<?php  echo $item->entry_type; ?>" <?php if ($item->entry_type == $remarks[1]){ echo 'selected'; } ?>><?php  echo $item->entry_type; ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select class="form-control" name="visa_type" required>
                                            <option value="">Visa Type</option>
                                            <?php foreach ($visa_type as $item) { ?>
                                            <option value="<?php  echo $item->visa_type; ?>" <?php if ($item->visa_type == $remarks[2]){ echo 'selected'; } ?>><?php  echo $item->visa_type; ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="show">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <input class="form-control"  value="<?php echo $editData->visa_fee; ?>" name="visa_fee" id="visaFee"
                                                   placeholder="Visa Fee" >
                                            <span class="input-group-addon">Taka</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <input class="form-control"  value="<?php echo $editData->fax_trans_charge; ?>" name="fax_trans_charge" id="faxCharge"
                                                   placeholder="Fax Trans. Charge" >
                                            <span class="input-group-addon">Taka</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <input class="form-control" value="<?php echo $editData->icwf; ?>" name="icwf" id="icwf" placeholder="ICWF">
                                            <span class="input-group-addon">Taka</span>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <input class="form-control"  value="<?php echo $editData->visa_app_charge; ?>" name="visa_app_charge" id="appCharge"
                                                   placeholder="Visa App. Charge">
                                            <span class="input-group-addon">Taka</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input class="form-control"  value="<?php echo $editData->total_amount; ?>" name="" id="total_disable"
                                                   placeholder="Total Amount" disabled>
                                            <input type="hidden" value="<?php echo $editData->total_amount; ?>" class="form-control" id="total" name="total_amount"
                                                   value="0">
                                            <input type="hidden" class="form-control" id="total1" name="" value="<?php echo $editData->visa_fee; ?>">
                                            <input type="hidden" class="form-control" id="total2" name="" value="<?php echo $editData->fax_trans_charge; ?>">
                                            <input type="hidden" class="form-control" id="total3" name="" value="<?php echo $editData->icwf; ?>">
                                            <input type="hidden" class="form-control" id="total4" name="" value="<?php echo $editData->visa_app_charge; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input required class="form-control" name="old_passport_qty" value="<?php echo $editData->old_passport_qty; ?>" placeholder="Old Passport Quantity">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php }else if ($editData->gratis_status == 'no'){  ?>
                            <div class="row">
                                <div class="col-md-1" style="padding-right: 0px">
                                    <h4>GRATIS:</h4>
                                </div>
                                <div class="col-md-1" style="padding-left: 0px;">
                                    <div class="checkbox">
                                        <label>
                                            <input type="radio" name="gratis_status" id="gratiseNo" <?php if($editData->gratis_status == 'no'){ echo 'checked'; } ?> value="no"> No
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div id="strkID">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input class="form-control" value="Book no-<?php  echo $editData->book_no;  ?>" name="book_no"
                                                   placeholder="Book No" autocomplete="off" disabled>
                                            <input type="hidden" class="form-control" value="<?php echo $editData->book_no; ?>" name="book_no" id="book_no"
                                                   placeholder="Book No" autocomplete="off" >
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input class="form-control" name="receive_no" id="receive" value="<?php echo $editData->receive_no; ?>" placeholder="Receipt No" autocomplete="off" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <input class="form-control" name="strk_number" id="number"
                                               placeholder="Sticker No" autocomplete="off" value="<?php echo $editData->strk_no; ?>" required>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input class="form-control" name="passport" value="<?php echo $editData->passport; ?>" placeholder="Passport" id="passport"
                                               autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input class="form-control " id="name" value="<?php echo $editData->app_name; ?>" name="app_name"
                                               placeholder="Name of Applicant" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input class="form-control" name="contact" value="<?php echo $editData->contact; ?>" pattern=".{10}" title="Minimum  & Maximum 10 digit"  id="contact" placeholder="Contact"
                                               autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input class="form-control" id="web" value="<?php echo $editData->web_file_no; ?>" name="web_file_no"
                                               placeholder="Web file number" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input class="form-control" name="nationality" value="<?php echo $editData->nationality; ?>" placeholder="Nationality"
                                               autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input class="form-control" name="date_of_checking" value="<?php echo date('m/d/Y', strtotime($editData->date_of_checking)) ?>" id="date"
                                               placeholder="Date of Checking" required>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select class="form-control" name="duration" required>
                                            <option value="">Select Duration</option>
                                            <?php foreach ($duration as $item) { ?>
                                            <option value="<?php  echo $item->duration; ?>" <?php if ($item->duration == $remarks[0]){ echo 'selected'; } ?>><?php  echo $item->duration; ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select class="form-control" name="entry_type" required>
                                            <option value="">Entry Type</option>
                                            <?php foreach ($entry_type as $item) { ?>
                                            <option value="<?php  echo $item->entry_type; ?>" <?php if ($item->entry_type == $remarks[1]){ echo 'selected'; } ?>><?php  echo $item->entry_type; ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select class="form-control" name="visa_type" required>
                                            <option value="">Visa Type</option>
                                            <?php foreach ($visa_type as $item) { ?>
                                            <option value="<?php  echo $item->visa_type; ?>" <?php if ($item->visa_type == $remarks[2]){ echo 'selected'; } ?>><?php  echo $item->visa_type; ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="show">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <input class="form-control"  value="<?php echo $editData->visa_fee; ?>" name="visa_fee" id="visaFee"
                                                   placeholder="Visa Fee" required>
                                            <span class="input-group-addon">Taka</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <input class="form-control"  value="<?php echo $editData->fax_trans_charge; ?>" name="fax_trans_charge" id="faxCharge"
                                                   placeholder="Fax Trans. Charge" required>
                                            <span class="input-group-addon">Taka</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <input class="form-control" value="<?php echo $editData->icwf; ?>" name="icwf" id="icwf" placeholder="ICWF"
                                                   required>
                                            <span class="input-group-addon">Taka</span>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <input class="form-control"  value="<?php echo $editData->visa_app_charge; ?>" name="visa_app_charge" id="appCharge"
                                                   placeholder="Visa App. Charge">
                                            <span class="input-group-addon">Taka</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input class="form-control"  value="<?php echo $editData->total_amount; ?>" name="" id="total_disable"
                                                   placeholder="Total Amount" disabled>
                                            <input type="hidden" value="<?php echo $editData->total_amount; ?>" class="form-control" id="total" name="total_amount"
                                                   value="0">
                                            <input type="hidden" class="form-control" id="total1" name="" value="<?php echo $editData->visa_fee; ?>">
                                            <input type="hidden" class="form-control" id="total2" name="" value="<?php echo $editData->fax_trans_charge; ?>">
                                            <input type="hidden" class="form-control" id="total3" name="" value="<?php echo $editData->icwf; ?>">
                                            <input type="hidden" class="form-control" id="total4" name="" value="<?php echo $editData->visa_app_charge; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input required class="form-control" name="old_passport_qty" value="<?php echo $editData->old_passport_qty; ?>" placeholder="Old Passport Quantity">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <hr>
                            <div class="footer-box">
                                <button type="reset" class="btn btn-danger">RESET</button>
                                <button type="submit" class="btn btn-info">Submit</button>
                            </div>
                        </form>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function () {
            $('#gratiseNo').click(function () {
                $('#show').show();
                $('#strkID').show();
            });
        });
        $(document).ready(function () {
            $('#gratiseYes').click(function () {
                document.getElementById("strk_no").required = false;
                document.getElementById("formRange").required = false;
                document.getElementById("formRange").value = '';
                document.getElementById("toRange").required = false;
                document.getElementById("toRange").value = '';
                document.getElementById("icwf").required = false;
                document.getElementById("faxCharge").required = false;
                document.getElementById("visaFee").required = false;
                document.getElementById("receive").required = false;
                $('#show').hide();
                $('#strkID').hide();
            });
        });
    </script>

    <script>
        $('#number').blur(function (event) {
            var min_range = document.getElementById("formRange").value;
            var max_le = document.getElementById("toRange").value;
            var x = document.getElementById("number").value;
            if (parseInt(x) != '' || parseInt(min_range) != '') {
                if (parseInt(x) > parseInt(max_le) || parseInt(x) < parseInt(min_range)) {
                    alert("Number must be between " + min_range + " and " + max_le + "");
                    document.getElementById("number").value = "";
                    return false;
                }
            }
        });
        $('#receive').blur(function (event) {
            var receive_no = document.getElementById("receive").value;
            var book_no = document.getElementById("book_no").value;
            var min_range =parseInt( <?php if (isset($book_no->start_no) && !empty($book_no->start_no)){ echo $book_no->start_no; } ?>) ;
            var max_le = parseInt(<?php if (isset($book_no->end_no) && !empty($book_no->end_no)){ echo $book_no->end_no; } ?>) ;
            var edit_re_no = '<?php echo $editData->receive_no; ?>';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.ajax({
                url: "{{url("/search-receive-number")}}",
                type: 'GET',
                data: {receive_no: receive_no, book_no: book_no},
                success: function (result) {
                    console.log(result[0].receive_no);
                    console.log(result);
                    if (result.length == 0) {

                    }else if(result[0].receive_no == <?php echo $editData->receive_no; ?>){

                    }else {
                        alert("This Receipt number is already exist !");
                        document.getElementById("receive").value = "";
                    }
                    if (parseInt(receive_no) != '') {
                        if (parseInt(receive_no) > parseInt(max_le) || parseInt(receive_no) < parseInt(min_range)) {
                            alert("Receipt No must be between " + min_range + " and " + max_le + "");
                            document.getElementById("receive").value = "";
                            return false;
                        }
                    }
                }
            });


        });
    </script>
    <script>

        $("#number").blur(function () {
            var num = $(this).val();
            console.log(num);
            var min_range = document.getElementById("formRange").value;
            var max_le = document.getElementById("toRange").value;
            var strk_name = $('#strk_no').children(":selected").attr('value');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })

            $.ajax({
                url: "{{url("/search-sticker-numbers")}}",
                type: 'GET',
                data: {numb: num, name: strk_name},
                success: function (result) {
                    if (result.length == 0) {

                    } else {
                        alert("This Striker number is already exist !");
                        document.getElementById("number").value = "";
                    }
                }
            });
        });
    </script>
    <script>
        var icwf = 0;
        var visa_fee = 0;
        var faxCharge = 0;
        var appCharge = 0;
        var total = 0;

        $("#visaFee").keyup(function () {
            visa_fee = document.getElementById("visaFee").value;
            //var total = parseFloat(document.getElementById("total").value) + parseFloat(visa_fee);
            document.getElementById("total1").value = visa_fee;
        });
        $("#faxCharge").keyup(function () {
            faxCharge = document.getElementById("faxCharge").value;
            document.getElementById("total2").value = faxCharge;
        });
        $("#icwf").keyup(function () {
            icwf = document.getElementById("icwf").value;
            document.getElementById("total3").value = icwf;
        })

        $("#appCharge").keyup(function () {
            appCharge = document.getElementById("appCharge").value;
            document.getElementById("total4").value = appCharge;
        });
        $("#visaFee, #faxCharge, #icwf, #appCharge").keyup(function () {
            var t1 = document.getElementById("total1").value;
            var t2 = document.getElementById("total2").value;
            var t3 = document.getElementById("total3").value;
            var t4 = document.getElementById("total4").value;
            if (t4.length == 0) {
                t4 = 0;
            }
            if (t3.length == 0) {
                t3 = 0;
            }
            if (t2.length == 0) {
                t2 = 0;
            }
            if (t1.length == 0) {
                t1 = 0;
            }
            total = parseFloat(t1) + parseFloat(t2) + parseFloat(t3) + parseFloat(t4);
            document.getElementById("total").value = total;
            document.getElementById("total_disable").value = total;
        });

    </script>
    <script>
        $("#formRange").on("keypress keyup blur", function (event) {
            //this.value = this.value.replace(/[^0-9\.]/g,'');
            $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });
        $("#toRange").on("keypress keyup blur", function (event) {
            //this.value = this.value.replace(/[^0-9\.]/g,'');
            $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });
        $("#number").on("keypress keyup blur", function (event) {
            //this.value = this.value.replace(/[^0-9\.]/g,'');
            $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });
        $("#visaFee").on("keypress keyup blur", function (event) {
            //this.value = this.value.replace(/[^0-9\.]/g,'');
            $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });
        $("#faxCharge").on("keypress keyup blur", function (event) {
            //this.value = this.value.replace(/[^0-9\.]/g,'');
            $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });
        $("#icwf").on("keypress keyup blur", function (event) {
            //this.value = this.value.replace(/[^0-9\.]/g,'');
            $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });
        $("#appCharge").on("keypress keyup blur", function (event) {
            //this.value = this.value.replace(/[^0-9\.]/g,'');
            $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });
        $("#receive").on("keypress keyup blur", function (event) {
            //this.value = this.value.replace(/[^0-9\.]/g,'');
            $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });
        $("#formRange").on("keypress keyup blur", function (event) {
            //this.value = this.value.replace(/[^0-9\.]/g,'');
            $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });
        $("#toRange").on("keypress keyup blur", function (event) {
            //this.value = this.value.replace(/[^0-9\.]/g,'');
            $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });
        $("#contact").on("keypress keyup blur", function (event) {
            //this.value = this.value.replace(/[^0-9\.]/g,'');
            $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();

            }
        });
        // $('#contact').on('keyup', function () {
        //     var phone = $(this).val().length;
        //     var number = $(this).val();
        //     if (phone > 10) {
        //         alert('Max Phone Length 10');
        //         var a = number.substring(0, number.length - 1);
        //         console.log(a);
        //         document.getElementById("contact").value = a;
        //     }
        // });
    </script>
    <script>

        $("#passport").keyup(function () {
            var keyword = $(this).val();
            $.ajax({
                url: "{{ url("/search-passport-appointment") }}",
                type: 'GET',
                data: {keyword: keyword},
                cache: false,
                success: function (result) {
                    if (result.Applicant_name == undefined) {
                        console.log(result);
                    } else {
                        document.getElementById('name').value = result.Applicant_name;
                        document.getElementById("contact").value = result.Contact;
                        document.getElementById("web").value = result.WebFile_no;
                    }


                    //document.getElementById("rate2").value=result.currency_rate;
                }
            }, 'json');
        });
    </script>
<?php }else if(isset($messages) && !empty($messages)){
    echo $messages;
} ?>

@endsection