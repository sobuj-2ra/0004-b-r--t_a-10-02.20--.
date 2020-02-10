@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Foreign Passport Receive
@endsection

<!--Page Header-->
@section('page-header')
    Foreign Passport Receive
@endsection

<!--Page Content Start Here-->
@section('page-content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="main_part">
                    <br>
                    <!-- Code Here.... -->
                    <div class="change_passport_body" style="width:100%;margin: 3px">
                        <div class="row">
                            @if (Session::has('message'))
                                <div class="col-md-6 col-md-offset-3 alert {{ Session::get('alert-class') }}">{{ Session::get('message') }}</div>
                            @endif
                        </div>
                        <form method="POST" id="applicant_form" autocomplete="off" action="{{ URL::to('store-foreign-passport') }}"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-1" style="padding-right: 0px">
                                    <h4>GRATIS:</h4>
                                </div>
                                <div class="col-md-1" style="padding-right: 0px;padding-left: 0px">
                                    <div class="checkbox">
                                        <label>
                                            <input type="radio" name="gratis_status1" id="gratiseYes" value="yes"
                                                   required> Yes
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-1" style="padding-left: 0px;">
                                    <div class="checkbox">
                                        <label>
                                            <input type="radio" name="gratis_status1" id="gratiseNo" value="no"> No
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">


                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input class="form-control"
                                                   value="Book no-<?php if (isset($book_no->book_no) && !empty($book_no->book_no)) {
                                                       echo $book_no->book_no;
                                                   } ?>" name="book_no"
                                                   placeholder="Book No" autocomplete="off" disabled>
                                            <input type="hidden" class="form-control"
                                                   value="<?php if (isset($book_no->book_no) && !empty($book_no->book_no)) {
                                                       echo $book_no->book_no;
                                                   } ?>" name="book_no" id="book_no"
                                                   placeholder="Book No" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input class="form-control" name="receive_no" id="receive"
                                                   placeholder="Receipt No" autocomplete="off" required>
                                        </div>
                                    </div>
                                <div id="strkID">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <select class="form-control" id="strk_no" name="strk_no[]" required>
                                                <option value="">Select Sticker</option>
                                                <?php foreach ($sticker as $strk){ ?>
                                                <option value="<?php echo $strk->sticker ?>" <?php if (isset($strks) && !empty($strks)) {
                                                    if ("$strk->sticker" == "$strks") {
                                                        echo 'selected';
                                                    }
                                                } ?>><?php echo $strk->sticker ?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input class="form-control" name="strk_form" id="formRange"
                                                   placeholder="From Range" autocomplete="off" required
                                                   value="<?php if (isset($form)) {
                                                       echo $form;
                                                   } ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input class="form-control" name="strk_to" id="toRange"
                                                   placeholder="To Range" autocomplete="off" required
                                                   value="<?php if (isset($to)) {
                                                       echo $to;
                                                   } ?>">
                                        </div>
                                    </div>


                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <input class="form-control" name="strk_number[]" id="number"
                                               placeholder="Sticker No" autocomplete="off" required>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input class="form-control passport" name="passport[]" placeholder="Passport"
                                               id="passport" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input class="form-control " id="name" name="app_name[]"
                                               placeholder="Name of Applicant" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input class="form-control" name="contact[]" id="contact" pattern=".{10}" title="Minimum  & Maximum 10 digit" placeholder="Contact (1XXXXXXXXX)"
                                               autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input class="form-control" id="web" name="web_file_no[]"
                                               placeholder="Web file number" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input class="form-control" name="nationality[]" placeholder="Nationality"
                                               autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input class="form-control datepicker" value="<?php echo date('d-m-Y'); ?>"
                                               name="date_of_checking[]"
                                               placeholder="Date of Checking" required>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select class="form-control" name="duration[]" required>
                                            <option value="">Select Duration</option>
                                            <?php foreach ($duration as $item) { ?>
                                            <option value="<?php  echo $item->duration; ?>"><?php  echo $item->duration; ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select class="form-control" name="entry_type[]" required>
                                            <option value="">Entry Type</option>
                                            <?php foreach ($entry_type as $item) { ?>
                                            <option value="<?php  echo $item->entry_type; ?>"><?php  echo $item->entry_type; ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select class="form-control" name="visa_type[]" required>
                                            <option value="">Visa Type</option>
                                            <?php foreach ($visa_type as $item) { ?>
                                            <option value="<?php  echo $item->visa_type; ?>"><?php  echo $item->visa_type; ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="show">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="visa_fee[]" id="visaFee"
                                                   placeholder="Visa Fee" required autocomplete="off">
                                            <span class="input-group-addon">Taka</span>
                                        </div>
                                        {{--<div class="form-group">--}}
                                        {{--<input class="form-control" name="visa_fee" id="visaFee"--}}
                                        {{--placeholder="Visa Fee" required>--}}
                                        {{--</div>--}}
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <input class="form-control" name="fax_trans_charge[]" id="faxCharge"
                                                   placeholder="Fax Trans. Charge" required>
                                            <span class="input-group-addon">Taka</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <input class="form-control" name="icwf[]" id="icwf" placeholder="ICWF"
                                                   required>
                                            <span class="input-group-addon">Taka</span>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <input class="form-control" name="visa_app_charge[]" id="appCharge"
                                                   placeholder="Visa App. Charge">
                                            <span class="input-group-addon">Taka</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input class="form-control" name="" id="total_disable"
                                                   placeholder="Total Amount" disabled>
                                            <input type="hidden" class="form-control" id="total" name="total_amount[]"
                                                   value="0">
                                            <input type="hidden" class="form-control" id="total1" name="" value="0">
                                            <input type="hidden" class="form-control" id="total2" name="" value="0">
                                            <input type="hidden" class="form-control" id="total3" name="" value="0">
                                            <input type="hidden" class="form-control" id="total4" name="" value="0">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input required class="form-control" name="old_passport_qty[]"
                                               placeholder="Old Passport Quantity">
                                    </div>
                                </div>
                            </div>
                            {{--add area--}}
                            <div class="before-add-more">

                            </div>
                            {{------}}

                            <div class="copy hide">


                            </div>

                            <div class="input-group-btn" id="addbutton">
                                <button class="btn btn-success add-more" type="button" style="border-radius:4px;"><i
                                            class="glyphicon glyphicon-plus"></i> Add
                                </button>
                            </div>

                            <hr>
                            <div class="footer-box">
                                <input type="hidden" id="count_row" name="count_row" value="1">
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
        $("#applicant_form").submit(function (event) {

        });
    </script>
    <script>
        $(document).ready(function () {
            $(".add-more").click(function () {
                var counts = document.getElementById("count_row").value;
                if (parseInt(counts) >= 4){
                    document.getElementById("addbutton").style.display="none";
                }else {
                    document.getElementById("addbutton").style.display="block";
                }
                var count_row = document.getElementById("count_row").value = parseInt(counts) + 1;
                var a = 1;
                a = a + 1;
                //var html = $(".copy").html();
                var html = '<div class="hidden_field"><hr>\n' +
                    '                                    <div class="row ">\n' +
                    '                                        <div class="col-md-1" style="padding-right: 0px">\n' +
                    '                                            <h4>GRATIS:</h4>\n' +
                    '                                        </div>\n' +
                    '                                        <div class="col-md-1" style="padding-right: 0px;padding-left: 0px">\n' +
                    '                                            <div class="checkbox">\n' +
                    '                                                <label><input type="radio" name="gratis_status'+count_row+'"\n' +
                    '                                                              id="gratiseYes'+count_row+'" value="yes" required>Yes</label>\n' +
                    '                                            </div>\n' +
                    '                                        </div>\n' +
                    '                                        <div class="col-md-1" style="padding-left: 0px;">\n' +
                    '                                            <div class="checkbox">\n' +
                    '                                                <label><input type="radio" name="gratis_status'+count_row+'" id="gratiseNo'+count_row+'"\n' +
                    '                                                              value="no">No</label>\n' +
                    '                                            </div>\n' +
                    '                                        </div>\n' +
                    '                                    </div>\n' +
                    '                                    <div class="row">\n' +
                    '                                        <div id="strkID'+count_row+'">\n' +
                    '                                            <div class="col-md-2">\n' +
                    '                                                <div class="form-group">\n' +
                    '                                                    <select required class="form-control" id="strk_no'+count_row+'"\n' +
                    '                                                            name="strk_no[]">\n' +
                    '                                                        <option value="">Select Sticker</option>\n' +
                    '                                                        <?php foreach ($sticker as $strk){ ?>\n' +
                    '                                                        <option value="<?php echo $strk->sticker ?>"><?php echo $strk->sticker ?>\n' +
                    '                                                        </option><?php } ?>\n' +
                    '                                                    </select>\n' +
                    '                                                </div>\n' +
                    '                                            </div>\n' +
                    '                                        </div>\n' +
                    '                                        <div class="col-md-2">\n' +
                    '                                            <div class="form-group"><input class="form-control" required\n' +
                    '                                                                           name="strk_number[]"\n' +
                    '                                                                           id="number'+count_row+'" placeholder="Sticker No"\n' +
                    '                                                                           autocomplete="off">\n' +
                    '                                            </div>\n' +
                    '                                        </div>\n' +
                    '                                    </div>\n' +
                    '                                    <div class="row">\n' +
                    '                                        <div class="col-md-3">\n' +
                    '                                            <div class="form-group">\n' +
                    '                                                <input class="form-control" required name="passport[]"\n' +
                    '                                                       placeholder="Passport" id="passport'+count_row+'" autocomplete="off">\n' +
                    '                                            </div>\n' +
                    '                                        </div>\n' +
                    '                                        <div class="col-md-3">\n' +
                    '                                            <div class="form-group">\n' +
                    '                                                <input required class="form-control " id="name'+count_row+'"\n' +
                    '                                                       name="app_name[]" placeholder="Name of Applicant"\n' +
                    '                                                       autocomplete="off">\n' +
                    '                                            </div>\n' +
                    '                                        </div>\n' +
                    '                                        <div class="col-md-3">\n' +
                    '                                            <div class="form-group">\n' +
                    '                                                <input required class="form-control" pattern=".{10}" title="Minimum  & Maximum 10 digit" name="contact[]" id="contact'+count_row+'"\n' +
                    '                                                       placeholder="Contact (1XXXXXXXXX)" autocomplete="off">\n' +
                    '                                            </div>\n' +
                    '                                        </div>\n' +
                    '                                    </div>\n' +
                    '                                    <div class="row">\n' +
                    '                                        <div class="col-md-3">\n' +
                    '                                            <div class="form-group">\n' +
                    '                                                <input required class="form-control" id="web'+count_row+'"\n' +
                    '                                                       name="web_file_no[]" placeholder="Web file number"\n' +
                    '                                                       autocomplete="off">\n' +
                    '                                            </div>\n' +
                    '                                        </div>\n' +
                    '                                        <div class="col-md-3">\n' +
                    '                                            <div class="form-group">\n' +
                    '                                                <input required class="form-control" name="nationality[]"\n' +
                    '                                                       placeholder="Nationality" autocomplete="off">\n' +
                    '                                            </div>\n' +
                    '                                        </div>\n' +
                    '                                        <div class="col-md-3">\n' +
                    '                                            <div class="form-group">\n' +
                    '                                                <input required class="form-control datepicker"\n' +
                    '                                                       value="<?php echo date("d-m-Y"); ?>" name="date_of_checking[]"\n' +
                    '                                                       placeholder="Date of Checking">\n' +
                    '                                            </div>\n' +
                    '\n' +
                    '                                        </div>\n' +
                    '\n' +
                    '                                    </div>\n' +
                    '                                    <div class="row">\n' +
                    '                                        <div class="col-md-3">\n' +
                    '                                            <div class="form-group">\n' +
                    '                                                <select required class="form-control" name="duration[]">\n' +
                    '                                                    <option value="">Select Duration</option>\n' +
                    '                                                    <?php foreach ($duration as $item) { ?>\n' +
                    '                                                    <option value="<?php  echo $item->duration; ?>"><?php  echo $item->duration; ?></option>\n' +
                    '                                                    <?php } ?>\n' +
                    '                                                </select>\n' +
                    '                                            </div>\n' +
                    '                                        </div>\n' +
                    '                                        <div class="col-md-3">\n' +
                    '                                            <div class="form-group">\n' +
                    '                                                <select required class="form-control" name="entry_type[]">\n' +
                    '                                                    <option value="">Entry Type</option>\n' +
                    '                                                    <?php foreach ($entry_type as $item) { ?>\n' +
                    '                                                    <option value="<?php  echo $item->entry_type; ?>"><?php  echo $item->entry_type; ?></option>\n' +
                    '                                                    <?php } ?>\n' +
                    '                                                </select>\n' +
                    '                                            </div>\n' +
                    '                                        </div>\n' +
                    '                                        <div class="col-md-3">\n' +
                    '                                            <div class="form-group">\n' +
                    '                                                <select required class="form-control" name="visa_type[]">\n' +
                    '                                                    <option value="">Visa Type</option>\n' +
                    '                                                    <?php foreach ($visa_type as $item) { ?>\n' +
                    '\n' +
                    '                                                    <option value="<?php  echo $item->visa_type; ?>"><?php  echo $item->visa_type; ?></option>\n' +
                    '                                                    <?php } ?>\n' +
                    '                                                </select>\n' +
                    '                                            </div>\n' +
                    '                                        </div>\n' +
                    '                                    </div>\n' +
                    '                                    <div id="show'+count_row+'">\n' +
                    '                                        <div class="row">\n' +
                    '                                            <div class="col-md-3">\n' +
                    '                                                <div class="input-group">\n' +
                    '                                                    <input type="text" class="form-control" required name="visa_fee[]"\n' +
                    '                                                           id="visaFee'+count_row+'" required placeholder="Visa Fee" autocomplete="off">\n' +
                    '                                                    <span class="input-group-addon">Taka</span>\n' +
                    '                                                </div>\n' +
                    '                                            </div>\n' +
                    '                                            <div class="col-md-3">\n' +
                    '                                                <div class="input-group">\n' +
                    '                                                    <input class="form-control" required name="fax_trans_charge[]" id="faxCharge'+count_row+'"\n' +
                    '                                                           placeholder="Fax Trans. Charge">\n' +
                    '                                                    <span class="input-group-addon">Taka</span>\n' +
                    '                                                </div>\n' +
                    '                                            </div>\n' +
                    '                                            <div class="col-md-3">\n' +
                    '                                                <div class="input-group">\n' +
                    '                                                    <input class="form-control" name="icwf[]" required id="icwf'+count_row+'"\n' +
                    '                                                           placeholder="ICWF">\n' +
                    '                                                    <span class="input-group-addon">Taka</span>\n' +
                    '                                                </div>\n' +
                    '                                            </div>\n' +
                    '                                        </div>\n' +
                    '\n' +
                    '                                        <br>\n' +
                    '                                        <div class="row">\n' +
                    '\n' +
                    '                                            <div class="col-md-3">\n' +
                    '\n' +
                    '                                                <div class="input-group">\n' +
                    '                                                    <input class="form-control" name="visa_app_charge[]"\n' +
                    '                                                           id="appCharge'+count_row+'" placeholder="Visa App. Charge">\n' +
                    '                                                    <span class="input-group-addon">Taka</span>\n' +
                    '                                                </div>\n' +
                    '                                            </div>\n' +
                    '                                            <div class="col-md-3">\n' +
                    '\n' +
                    '                                                <div class="form-group">\n' +
                    '                                                    <input class="form-control" name="total_disable'+count_row+'" id="total_disable'+count_row+'" placeholder="Total Amount"\n' +
                    '                                                           disabled>\n' +
                    '                                                    <input type="hidden" class="form-control" id="total'+count_row+'" name=""\n' +
                    '                                                           value="0">\n' +
                    '                                                    <input type="hidden" class="form-control" id="total_amount'+count_row+'" name="total_amount[]" value="0"><input type="hidden" class="form-control" id="total'+count_row+'1" name="" value="0">\n' +
                    '                                                    <input type="hidden" class="form-control" id="total'+count_row+'2" name="" value="0">\n' +
                    '                                                    <input type="hidden" class="form-control" id="total'+count_row+'3" name="" value="0">\n' +
                    '                                                    <input type="hidden" class="form-control" id="total'+count_row+'4" name="" value="0">\n' +
                    '                                                </div>\n' +
                    '                                            </div>\n' +
                    '                                        </div>\n' +
                    '                                    </div>\n' +
                    '                                    <div class="row ">\n' +
                    '                                        <div class="col-md-3">\n' +
                    '                                            <div class="form-group">\n' +
                    '                                                <input required class="form-control qq" id="qq"\n' +
                    '                                                       name="old_passport_qty[]"\n' +
                    '                                                       placeholder="Old Passport Quantity">\n' +
                    '                                            </div>\n' +
                    '                                        </div>\n' +
                    '                                    </div>\n' +
                    '                                    <div class="input-group-btn" style="text-align: left;">\n' +
                    '\n' +
                    '                                        <button class="btn btn-danger remove margintop15" type="button"\n' +
                    '                                                style="border-radius:4px;"><i class="glyphicon glyphicon-remove"></i>\n' +
                    '                                            Remove\n' +
                    '                                        </button>\n' +
                    '                                    </div>\n' +
                    '                                    <hr></div>';
                $(".before-add-more").append(html);


            });


            $("body").on("click", ".remove", function () {
                $(this).parents(".hidden_field").remove();
                var count_row = document.getElementById("count_row").value;
                document.getElementById("count_row").value = parseInt(count_row) - 1;
                document.getElementById("addbutton").style.display="block";
            });


            // ADD MORE VALIDATION
            $("body").on("keypress keyup blur", "#number2", function () {
                $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
                if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
            });
            $("body").on("keypress keyup blur", "#visaFee2", function () {
                $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
                if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
            });
            $("body").on("keypress keyup blur", "#faxCharge2", function () {
                $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
                if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
            });
            $("body").on("keypress keyup blur", "#icwf2", function () {
                $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
                if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
            });
            $("body").on("keypress keyup blur", "#appCharge2", function () {
                $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
                if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
            });
            $("body").on("keypress keyup blur", "#contact2", function () {
                $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
                if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                    event.preventDefault();

                }
            });
            // $("body").on("keypress keyup blur", "#contact2", function () {
            //     var phone = $(this).val().length;
            //     var number = $(this).val();
            //     //if (phone > 10) {
            //       //  alert('Max Phone Length 10');
            //         // var a = number.substring(0, number.length - 1);
            //         // console.log(a);
            //         // document.getElementById("contact2").value = a;
            //     //}
            // });




            // sum
            var icwf2 = 0;
            var visa_fee2 = 0;
            var faxCharge2 = 0;
            var appCharge2 = 0;
            var total_amount_2 = 0;

            $("body").on("keyup", "#visaFee2", function () {
                visa_fee2 = document.getElementById("visaFee2").value;
                // console.log(visa_fee2);
                document.getElementById("total21").value = visa_fee2;
            });
            $("body").on("keyup", "#faxCharge2", function () {
                faxCharge2 = document.getElementById("faxCharge2").value;
                //console.log(faxCharge2);
                document.getElementById("total22").value = faxCharge2;
            });
            $("body").on("keyup", "#icwf2", function () {
                icwf2 = document.getElementById("icwf2").value;
                //console.log(faxCharge2);
                document.getElementById("total23").value = icwf2;
            });
            $("body").on("keyup", "#appCharge2", function () {
                appCharge2 = document.getElementById("appCharge2").value;
                console.log(faxCharge2);
                document.getElementById("total24").value = appCharge2;
            });
            $("body").on("keyup", "#visaFee2, #faxCharge2, #icwf2, #appCharge2", function () {
                //$("#visaFee2, #faxCharge2, #icwf2, #appCharge2").keyup(function () {
                var t21 = document.getElementById("total21").value;
                var t22 = document.getElementById("total22").value;
                var t23 = document.getElementById("total23").value;
                var t24 = document.getElementById("total24").value;
                if (t24.length == 0) {
                    t24 = 0;
                }
                if (t23.length == 0) {
                    t23 = 0;
                }
                if (t22.length == 0) {
                    t22 = 0;
                }
                if (t21.length == 0) {
                    t21 = 0;
                }
                total_amount_2 = parseFloat(t21) + parseFloat(t22) + parseFloat(t23) + parseFloat(t24);
                console.log(total_amount_2);
                document.getElementById("total_amount2").value = total_amount_2;
                document.getElementById("total_disable2").value = total_amount_2;
            });



            // search
            $("body").on("keyup", "#passport2", function () {
                //$("#passport2").keyup(function () {
                var keyword = $(this).val();
                $.ajax({
                    url: "{{ url("/search-passport-appointment") }}",
                    type: 'GET',
                    data: {keyword: keyword},
                    cache: false,
                    success: function (result) {
                        if (result){
                            document.getElementById('name2').value = '';
                            document.getElementById("contact2").value = '';
                            document.getElementById("web2").value = '';
                        }
                        if (result.Applicant_name == undefined) {
                            console.log(result);
                        } else {
                            document.getElementById('name2').value = result.Applicant_name;
                            document.getElementById("contact2").value = result.Contact;
                            document.getElementById("web2").value = result.WebFile_no;
                        }


                        //document.getElementById("rate2").value=result.currency_rate;
                    }
                }, 'json');
            });


            // sticker

            $(document).ready(function () {
                $("body").on("click", "#gratiseNo2", function () {
                    //console.log('paici');
                    document.getElementById("strk_no2").required = true;
                    document.getElementById("icwf2").required = true;
                    document.getElementById("faxCharge2").required = true;
                    document.getElementById("visaFee2").required = true;
                    document.getElementById("show2").style.display = "block";
                    document.getElementById("strkID2").style.display = "block";
                });
            });
            $(document).ready(function () {
                $("body").on("click", "#gratiseYes2", function () {
                    //$('#gratiseYes').click(function () {
                    document.getElementById("strk_no2").required = false;
                    document.getElementById("icwf2").required = false;
                    document.getElementById("faxCharge2").required = false;
                    document.getElementById("visaFee2").required = false;
                    //document.getElementById("show2").style.display = "none";
                    document.getElementById("strkID2").style.display = "none";
                });
            });
            $("body").on("blur", "#number2", function () {
                var num = $(this).val();
                var strk_name = $('#strk_no2').children(":selected").attr('value');
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
                            alert("This Striker number already exists !");
                            document.getElementById("number2").value = "";
                        }
                    }
                });
            });

            // -------------------------------------
            // ADD MORE VALIDATION 3
            $("body").on("keypress keyup blur", "#number3", function () {
                $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
                if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
            });
            $("body").on("keypress keyup blur", "#visaFee3", function () {
                $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
                if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
            });
            $("body").on("keypress keyup blur", "#faxCharge3", function () {
                $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
                if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
            });
            $("body").on("keypress keyup blur", "#icwf3", function () {
                $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
                if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
            });
            $("body").on("keypress keyup blur", "#appCharge3", function () {
                $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
                if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
            });
            $("body").on("keypress keyup blur", "#contact3", function () {
                $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
                if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                    event.preventDefault();

                }
            });
            // $("body").on("keypress keyup blur", "#contact3", function () {
            //     var phone = $(this).val().length;
            //     var number = $(this).val();
            //     if (phone > 10) {
            //         alert('Max Phone Length 10');
            //         // var a = number.substring(0, number.length - 1);
            //         // console.log(a);
            //         // document.getElementById("contact3").value = a;
            //     }
            // });




            // sum
            var icwf3 = 0;
            var visa_fee3 = 0;
            var faxCharge3 = 0;
            var appCharge3 = 0;
            var total_amount_3 = 0;

            $("body").on("keyup", "#visaFee3", function () {
                visa_fee3 = document.getElementById("visaFee3").value;
                // console.log(visa_fee2);
                document.getElementById("total31").value = visa_fee3;
            });
            $("body").on("keyup", "#faxCharge3", function () {
                faxCharge3 = document.getElementById("faxCharge3").value;
                //console.log(faxCharge2);
                document.getElementById("total32").value = faxCharge3;
            });
            $("body").on("keyup", "#icwf3", function () {
                icwf3 = document.getElementById("icwf3").value;
                //console.log(faxCharge2);
                document.getElementById("total33").value = icwf3;
            });
            $("body").on("keyup", "#appCharge3", function () {
                appCharge3 = document.getElementById("appCharge3").value;
                //console.log(faxCharge2);
                document.getElementById("total34").value = appCharge3;
            });
            $("body").on("keyup", "#visaFee3, #faxCharge3, #icwf3, #appCharge3", function () {
                //$("#visaFee2, #faxCharge2, #icwf2, #appCharge2").keyup(function () {
                var t31 = document.getElementById("total31").value;
                var t32 = document.getElementById("total32").value;
                var t33 = document.getElementById("total33").value;
                var t34 = document.getElementById("total34").value;
                if (t34.length == 0) {
                    t34 = 0;
                }
                if (t33.length == 0) {
                    t33 = 0;
                }
                if (t32.length == 0) {
                    t32 = 0;
                }
                if (t31.length == 0) {
                    t31 = 0;
                }
                total_amount_3 = parseFloat(t31) + parseFloat(t32) + parseFloat(t33) + parseFloat(t34);
                //console.log(total_amount_3);
                document.getElementById("total_amount3").value = total_amount_3;
                document.getElementById("total_disable3").value = total_amount_3;
            });



            // search
            $("body").on("keyup", "#passport3", function () {
                //$("#passport2").keyup(function () {
                var keyword = $(this).val();
                $.ajax({
                    url: "{{ url("/search-passport-appointment") }}",
                    type: 'GET',
                    data: {keyword: keyword},
                    cache: false,
                    success: function (result) {
                        if (result){
                            document.getElementById('name3').value = '';
                            document.getElementById("contact3").value = '';
                            document.getElementById("web3").value = '';
                        }
                        if (result.Applicant_name == undefined) {
                            console.log(result);
                        } else {
                            document.getElementById('name3').value = result.Applicant_name;
                            document.getElementById("contact3").value = result.Contact;
                            document.getElementById("web3").value = result.WebFile_no;
                        }


                        //document.getElementById("rate2").value=result.currency_rate;
                    }
                }, 'json');
            });


            // sticker

            $(document).ready(function () {
                $("body").on("click", "#gratiseNo3", function () {
                    //console.log('paici');
                    document.getElementById("strk_no3").required = true;
                    document.getElementById("icwf3").required = true;
                    document.getElementById("faxCharge3").required = true;
                    document.getElementById("visaFee3").required = true;
                    document.getElementById("show3").style.display = "block";
                    document.getElementById("strkID3").style.display = "block";
                });
            });
            $(document).ready(function () {
                $("body").on("click", "#gratiseYes3", function () {
                    //$('#gratiseYes').click(function () {
                    document.getElementById("strk_no3").required = false;
                    document.getElementById("icwf3").required = false;
                    document.getElementById("faxCharge3").required = false;
                    document.getElementById("visaFee3").required = false;
                    //document.getElementById("show3").style.display = "none";
                    document.getElementById("strkID3").style.display = "none";
                });
            });
            $("body").on("blur", "#number3", function () {
                var num = $(this).val();
                var strk_name = $('#strk_no3').children(":selected").attr('value');
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
                            alert("This Striker number already exists !");
                            document.getElementById("number3").value = "";
                        }
                    }
                });
            });

            // ------------------------------------------------
// ADD MORE VALIDATION 4
            $("body").on("keypress keyup blur", "#number4", function () {
                $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
                if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
            });
            $("body").on("keypress keyup blur", "#visaFee4", function () {
                $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
                if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
            });
            $("body").on("keypress keyup blur", "#faxCharge4", function () {
                $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
                if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
            });
            $("body").on("keypress keyup blur", "#icwf4", function () {
                $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
                if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
            });
            $("body").on("keypress keyup blur", "#appCharge4", function () {
                $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
                if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
            });
            $("body").on("keypress keyup blur", "#contact4", function () {
                $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
                if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                    event.preventDefault();

                }
            });
            // $("body").on("keypress keyup blur", "#contact4", function () {
            //     var phone = $(this).val().length;
            //     var number = $(this).val();
            //     if (phone > 10) {
            //         alert('Max Phone Length 10');
            //         // var a = number.substring(0, number.length - 1);
            //         // console.log(a);
            //         // document.getElementById("contact4").value = a;
            //     }
            // });




            // sum
            var icwf4 = 0;
            var visa_fee4 = 0;
            var faxCharge4 = 0;
            var appCharge4 = 0;
            var total_amount_4 = 0;

            $("body").on("keyup", "#visaFee4", function () {
                visa_fee4 = document.getElementById("visaFee4").value;
                // console.log(visa_fee2);
                document.getElementById("total41").value = visa_fee4;
            });
            $("body").on("keyup", "#faxCharge4", function () {
                faxCharge4 = document.getElementById("faxCharge4").value;
                //console.log(faxCharge2);
                document.getElementById("total42").value = faxCharge4;
            });
            $("body").on("keyup", "#icwf4", function () {
                icwf4 = document.getElementById("icwf4").value;
                //console.log(faxCharge2);
                document.getElementById("total43").value = icwf4;
            });
            $("body").on("keyup", "#appCharge4", function () {
                appCharge4 = document.getElementById("appCharge4").value;
                //console.log(faxCharge2);
                document.getElementById("total44").value = appCharge4;
            });
            $("body").on("keyup", "#visaFee4, #faxCharge4, #icwf4, #appCharge4", function () {
                //$("#visaFee2, #faxCharge2, #icwf2, #appCharge2").keyup(function () {
                var t41 = document.getElementById("total41").value;
                var t42 = document.getElementById("total42").value;
                var t43 = document.getElementById("total43").value;
                var t44 = document.getElementById("total44").value;
                if (t44.length == 0) {
                    t44 = 0;
                }
                if (t43.length == 0) {
                    t43 = 0;
                }
                if (t42.length == 0) {
                    t42 = 0;
                }
                if (t41.length == 0) {
                    t41 = 0;
                }
                total_amount_4 = parseFloat(t41) + parseFloat(t42) + parseFloat(t43) + parseFloat(t44);
                //console.log(total_amount_3);
                document.getElementById("total_amount4").value = total_amount_4;
                document.getElementById("total_disable4").value = total_amount_4;
            });



            // search
            $("body").on("keyup", "#passport4", function () {
                //$("#passport2").keyup(function () {
                var keyword = $(this).val();
                $.ajax({
                    url: "{{ url("/search-passport-appointment") }}",
                    type: 'GET',
                    data: {keyword: keyword},
                    cache: false,
                    success: function (result) {
                        if (result){
                            document.getElementById('name4').value = '';
                            document.getElementById("contact4").value = '';
                            document.getElementById("web4").value = '';
                        }
                        if (result.Applicant_name == undefined) {
                            console.log(result);
                        } else {
                            document.getElementById('name4').value = result.Applicant_name;
                            document.getElementById("contact4").value = result.Contact;
                            document.getElementById("web4").value = result.WebFile_no;
                        }


                        //document.getElementById("rate2").value=result.currency_rate;
                    }
                }, 'json');
            });


            // sticker

            $(document).ready(function () {
                $("body").on("click", "#gratiseNo4", function () {
                    //console.log('paici');
                    document.getElementById("strk_no4").required = true;
                    document.getElementById("icwf4").required = true;
                    document.getElementById("faxCharge4").required = true;
                    document.getElementById("visaFee4").required = true;
                    document.getElementById("show4").style.display = "block";
                    document.getElementById("strkID4").style.display = "block";
                });
            });
            $(document).ready(function () {
                $("body").on("click", "#gratiseYes4", function () {
                    //$('#gratiseYes').click(function () {
                    document.getElementById("strk_no4").required = false;
                    document.getElementById("icwf4").required = false;
                    document.getElementById("faxCharge4").required = false;
                    document.getElementById("visaFee4").required = false;
                    //document.getElementById("show4").style.display = "none";
                    document.getElementById("strkID4").style.display = "none";
                });
            });
            $("body").on("blur", "#number4", function () {
                var num = $(this).val();
                var strk_name = $('#strk_no4').children(":selected").attr('value');
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
                            alert("This Striker number already exists !");
                            document.getElementById("number4").value = "";
                        }
                    }
                });
            });

            // -----------------------------------------
            // ADD MORE VALIDATION 5
            $("body").on("keypress keyup blur", "#number5", function () {
                $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
                if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
            });
            $("body").on("keypress keyup blur", "#visaFee5", function () {
                $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
                if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
            });
            $("body").on("keypress keyup blur", "#faxCharge5", function () {
                $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
                if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
            });
            $("body").on("keypress keyup blur", "#icwf5", function () {
                $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
                if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
            });
            $("body").on("keypress keyup blur", "#appCharge5", function () {
                $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
                if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
            });
            $("body").on("keypress keyup blur", "#contact5", function () {
                $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
                if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                    event.preventDefault();

                }
            });
            // $("body").on("keypress keyup blur", "#contact5", function () {
            //     var phone = $(this).val().length;
            //     var number = $(this).val();
            //     if (phone > 10) {
            //         alert('Max Phone Length 10');
            //         // var a = number.substring(0, number.length - 1);
            //         // console.log(a);
            //         // document.getElementById("contact5").value = a;
            //     }
            // });




            // sum
            var icwf5 = 0;
            var visa_fee5 = 0;
            var faxCharge5 = 0;
            var appCharge5 = 0;
            var total_amount_5 = 0;

            $("body").on("keyup", "#visaFee5", function () {
                visa_fee5 = document.getElementById("visaFee5").value;
                // console.log(visa_fee2);
                document.getElementById("total51").value = visa_fee5;
            });
            $("body").on("keyup", "#faxCharge5", function () {
                faxCharge5 = document.getElementById("faxCharge5").value;
                //console.log(faxCharge2);
                document.getElementById("total52").value = faxCharge5;
            });
            $("body").on("keyup", "#icwf5", function () {
                icwf5 = document.getElementById("icwf5").value;
                //console.log(faxCharge2);
                document.getElementById("total53").value = icwf5;
            });
            $("body").on("keyup", "#appCharge5", function () {
                appCharge5 = document.getElementById("appCharge5").value;
                //console.log(faxCharge2);
                document.getElementById("total54").value = appCharge5;
            });
            $("body").on("keyup", "#visaFee5, #faxCharge5, #icwf5, #appCharge5", function () {
                //$("#visaFee2, #faxCharge2, #icwf2, #appCharge2").keyup(function () {
                var t51 = document.getElementById("total51").value;
                var t52 = document.getElementById("total52").value;
                var t53 = document.getElementById("total53").value;
                var t54 = document.getElementById("total54").value;
                if (t54.length == 0) {
                    t54 = 0;
                }
                if (t53.length == 0) {
                    t53 = 0;
                }
                if (t52.length == 0) {
                    t52 = 0;
                }
                if (t51.length == 0) {
                    t51 = 0;
                }
                total_amount_5 = parseFloat(t51) + parseFloat(t52) + parseFloat(t53) + parseFloat(t54);
                //console.log(total_amount_3);
                document.getElementById("total_amount5").value = total_amount_5;
                document.getElementById("total_disable5").value = total_amount_5;
            });



            // search
            $("body").on("keyup", "#passport5", function () {
                //$("#passport2").keyup(function () {
                var keyword = $(this).val();
                $.ajax({
                    url: "{{ url("/search-passport-appointment") }}",
                    type: 'GET',
                    data: {keyword: keyword},
                    cache: false,
                    success: function (result) {
                        if (result.Applicant_name == undefined) {
                            if (result){
                                document.getElementById('name5').value = '';
                                document.getElementById("contact5").value = '';
                                document.getElementById("web5").value = '';
                            }
                            console.log(result);
                        } else {
                            document.getElementById('name5').value = result.Applicant_name;
                            document.getElementById("contact5").value = result.Contact;
                            document.getElementById("web5").value = result.WebFile_no;
                        }


                        //document.getElementById("rate2").value=result.currency_rate;
                    }
                }, 'json');
            });


            // sticker

            $(document).ready(function () {
                $("body").on("click", "#gratiseNo5", function () {
                    //console.log('paici');
                    document.getElementById("strk_no5").required = true;
                    document.getElementById("icwf5").required = true;
                    document.getElementById("faxCharge5").required = true;
                    document.getElementById("visaFee5").required = true;
                    document.getElementById("show5").style.display = "block";
                    document.getElementById("strkID5").style.display = "block";
                });
            });
            $(document).ready(function () {
                $("body").on("click", "#gratiseYes5", function () {
                    //$('#gratiseYes').click(function () {
                    document.getElementById("strk_no5").required = false;
                    document.getElementById("icwf5").required = false;
                    document.getElementById("faxCharge5").required = false;
                    document.getElementById("visaFee5").required = false;
                    //document.getElementById("show5").style.display = "none";
                    document.getElementById("strkID5").style.display = "none";
                });
            });

            $("body").on("blur", "#number5", function () {
                var num = $(this).val();
                var strk_name = $('#strk_no5').children(":selected").attr('value');
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
                            alert("This Striker number already exists !");
                            document.getElementById("number5").value = "";
                        }
                    }
                });
            });
        });
    </script>
    <script>

    </script>
    <script>
        $(document).ready(function () {
            $('#gratiseNo').click(function () {
                document.getElementById("visaFee").required = true;
                document.getElementById("icwf").required = true;
                document.getElementById("faxCharge").required = true;
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
                //$('#show').hide();
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
            if(book_no == ''){
              alert('Please Add Book No');
            }
            var min_range = parseInt( <?php if (isset($book_no->start_no) && !empty($book_no->start_no)) {
                echo $book_no->start_no;
            } ?>);
            var max_le = parseInt(<?php if (isset($book_no->end_no) && !empty($book_no->end_no)) {
                echo $book_no->end_no;
            } ?>);
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
                    console.log(result);
                    if (result.length == 0) {

                    } else {
                        alert("This Receipt number already exists !");
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
                        alert("This Striker number already exists !");
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
        $('#contact').on('keyup', function () {
            var phone = $(this).val().length;
            var number = $(this).val();
            if (phone > 10) {
                alert('Max Phone Length 10');
                // var a = number.substring(0, number.length - 1);
                // console.log(a);
                // document.getElementById("contact").value = a;
            }
        });
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
                    if (result){
                        document.getElementById('name').value = '';
                        document.getElementById("contact").value = '';
                        document.getElementById("web").value = '';
                    }
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
@endsection