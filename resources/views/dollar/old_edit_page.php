@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Edit Dollar Endorsement
@endsection

<!--Page Header-->
@section('page-header')
    Edit Dollar Endorsement
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
                                <i>-Edit Dollar Endorsement-</i>
                            </p>
                            {!! Form::open(['url' => 'dollar-Endorsement/edit-search','id' => 'applicant_form']) !!}
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

    {{--edit section--}}
    <?php if (isset($editData)){ ?>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="main_part">
                    <!-- Code Here.... -->
                    <div class="row" style="padding: 20px;">
                        <div class="col-md-12 change_passport_body" style="width: 100%">
                            <div class="panel panel-default">
                                <div class="panel-heading">

                                </div>
                                <div class="panel-body">
                                    {!! Form::open(['url' => 'dollar/edit','id' => 'applicant_form']) !!}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h4>Application For State Bank of India Travel Card</h4>
                                                </div>
                                                <div class="col-md-3">

                                                </div>
                                                <div class="col-md-3">

                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <hr>
                                        <div class="col-lg-6"  style="border: 1px solid #ddd; padding: 10px;background: #f7f7f7">
                                            <h4 style="margin-top: 0px;color: #8c0404;font-weight: 600; border-bottom: 2px solid #fff">Required Fields*</h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" id="rate" value="<?php echo $editData->c_rate; ?>"  placeholder="Current Dollar Rate" disabled>
                                                        <input type="hidden" name="c_rate" value="<?php echo $editData->c_rate; ?>" id="rate2">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="created_date" autocomplete="off" disabled value="<?php echo date('d-m-Y', strtotime($editData->created_date)); ?>">
                                                        <input type="hidden" class="form-control" name="created_date" autocomplete="off" value="<?php echo date('d-m-Y', strtotime($editData->created_date)); ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <select class="form-control" name="branch_name">
                                                            <option value="">Select Branch</option>
                                                            <option value="Gulsan" <?php if ($editData->branch_name == 'Gulsan'){ echo 'selected'; } ?>>Gulsan</option>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" name="branch_code" placeholder="Branch Code" autocomplete="off" value="<?php echo $editData->branch_code; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>T. Details Currency</label>
                                                    <div class="form-group">
                                                        <select class="form-control" id="currency_name" name="c_type">
                                                            <option value="<?php echo $editData->c_type ?>"><?php echo $editData->c_type ?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Foreign Currency</label>
                                                    <div class="form-group">
                                                        <input class="form-control" id="foregin_currency" name="f_currency" placeholder="amount in foreign currency" autocomplete="off" value="<?php echo $editData->f_currency ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Amount in BDT</label>
                                                    <div class="form-group">
                                                        <input class="form-control" id="amount_in_bdt" name="" placeholder="amount in BDT" disabled autocomplete="off" value="<?php echo $editData->amount_bdt ?>">
                                                        <input class="form-control" id="amount_in_bdt2" name="amount_bdt" placeholder="amount in BDT" autocomplete="off" type="hidden" value="<?php echo $editData->amount_bdt ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Service Charge</label>
                                                    <div class="form-group">
                                                        <input class="form-control" id="charge" name="" placeholder="Service Charge" autocomplete="off" disabled value="<?php echo $editData->s_charge ?>">
                                                        <input class="form-control" id="charge2" name="s_charge" value="<?php echo $editData->s_charge ?>" placeholder="Service Charge" autocomplete="off" type="hidden">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Total Amount</label>
                                                    <div class="form-group">
                                                        <input class="form-control" id="total_taka_d" name="" placeholder="Total" autocomplete="off" disabled=""  value="<?php echo $editData->t_amount ?>">
                                                        <input class="form-control" id="total_taka" name="t_amount" placeholder="Total" autocomplete="off" type="hidden" value="<?php echo $editData->t_amount ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>URN</label>
                                                    <div class="form-group">
                                                        <input class="form-control" name="urn" value="<?php echo $editData->urn ?>" placeholder="URN" autocomplete="off" type="text" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Last 4 Digit</label>
                                                    <div class="form-group">
                                                        <input class="form-control" name="digit" value="<?php echo $editData->digit ?>" placeholder="Last 4 Digit" autocomplete="off" type="text" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control"  value="<?php echo $editData->passport_no ?>" id="passport" name="passport_no" placeholder="Passport Number" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <h4>Personal Information</h4>
                                            <div class="form-group">
                                                <input class="form-control" id="applicant_name" name="a_name" placeholder="Name of the applicant" autocomplete="off" value="<?php echo $editData->a_name ?>">
                                            </div>
                                            <div class="form-group">
                                                <textarea class="form-control" name="current_address" rows="3" placeholder="Current Address of the applicant"><?php echo $editData->current_address ?></textarea>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" value="<?php echo $editData->a_phone ?>" name="a_phone" id="phone" placeholder="Phone" autocomplete="off" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" name="a_mobile" value="<?php echo $editData->a_mobile ?>" id="mobile_number" placeholder="Mobile Number " autocomplete="off" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" value="<?php echo $editData->a_email ?>" type="email" name="a_email" placeholder="Email Address" autocomplete="off">
                                                    </div>
                                                    <p>Your Prepaid Card Statement will be sent on the above Email Id</p>
                                                </div>
                                                <div class="col-md-1">
                                                    <h4>Gender:</h4>
                                                </div>
                                                <div class="col-md-2" style="padding-right: 0px">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="radio" name="gender" value="Male" <?php if ($editData->gender == 'Male'){ echo 'checked'; } ?>> Male
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3" style="padding-left: 0px;">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="radio" name="gender" value="Female" <?php if ($editData->gender == 'Female'){ echo 'checked'; } ?>> Female
                                                        </label>
                                                    </div>
                                                </div>

                                            </div>
                                            <h4>Security Details</h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" value="<?php echo $editData->a_maiden_name ?>" name="a_maiden_name" placeholder="Mother's Maiden Name" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text"  value="<?php echo $editData->a_birth ?>" class="form-control" name="a_birth" id="date" autocomplete="off" placeholder="Applicant's Date of Birth">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" value="<?php echo $editData->place_of_issue ?>" name="place_of_issue" placeholder="Place of Issue" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" value="<?php echo $editData->date_of_issue ?>" name="date_of_issue" id="entry_date" autocomplete="off" placeholder=" Date of Issue">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control"  value="<?php echo $editData->expire_date ?>" name="expire_date" id="expire_date" autocomplete="off" placeholder="Expiry Date">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" name="a_nid" value="<?php echo $editData->a_nid ?>" placeholder="National ID Number" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <h4>Emergency Details</h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" value="<?php echo $editData->e_name ?>" name="e_name" placeholder="Name of the Person to Contact" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" value="<?php echo $editData->e_relation ?>" name="e_relation" placeholder="Relationship  with the Applicant" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" value="<?php echo $editData->e_phone ?>" name="e_phone" id="e_phone" placeholder="Phone number" autocomplete="off" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <textarea class="form-control" name="e_address" rows="3" placeholder="Address"><?php echo $editData->e_address ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <textarea class="form-control" rows="3" name="e_permanent_address" placeholder="Permanent Residential Address as appearing on the passport"><?php echo $editData->e_permanent_address ?></textarea>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="col-md-6" style="border: 1px solid #ddd;padding: 10px">
                                            <h4 style="margin-top: 0px;color: #054e00;font-weight: 600;border-bottom: 2px solid #ddd">Optional fields</h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" value="<?php echo $editData->e_city ?>" name="e_city" placeholder="City"  autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" value="<?php echo $editData->e_pin ?>" name="e_pin" placeholder="PIN" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" value="<?php echo $editData->e_phone1 ?>" name="e_phone1" id="phone_11" placeholder="Phone 1" autocomplete="off" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" value="<?php echo $editData->e_phone2 ?>" name="e_phone2" id="phone_22" placeholder="Phone 2" autocomplete="off" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <textarea class="form-control" name="e_address_2" rows="3" placeholder="Business/Office Name & Address of the Card Holder"><?php echo $editData->e_address_2 ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" value="<?php echo $editData->e_city_2 ?>" name="e_city_2" placeholder="City" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" value="<?php echo $editData->e_pin_2 ?>" name="e_pin_2" placeholder="PIN" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" value="<?php echo $editData->e_phone_3 ?>" name="e_phone_3" id="phone_33" placeholder="Phone 1" autocomplete="off" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" value="<?php echo $editData->e_phone_extn ?>" name="e_phone_extn" id="phone_44" placeholder="Extn" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <h4>Funding Details</h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" value="<?php echo $editData->cash_amount ?>" name="cash_amount" placeholder="Cash Amount" autocomplete="off" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" value="<?php echo $editData->cheque_amount ?>" name="cheque_amount" placeholder="Cheque Amount" autocomplete="off" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" value="<?php echo $editData->sbl_ca_account_no ?>" name="sbl_ca_account_no" placeholder="Debi SBI/CA Account No" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" value="<?php echo $editData->sbl_ca_amount ?>" name="sbl_ca_amount" placeholder="Amount BDT" autocomplete="off" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                                    </div>
                                                </div>
                                            </div>
                                            <h4>Personal Profile</h4>
                                            <h4>Nature of employment</h4>
                                            <div class="row">
                                                <div class="col-md-3" style="padding-right: 0px">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="employment_type[]" id="showselfEmployment" value="Self Employment" <?php $arr = explode(',', $editData->employment_type); foreach ($arr as $employee_t){  if ($employee_t == 'Self Employment'){ echo 'checked';} } ?>>Self Employment
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2" style="padding-left: 0px;">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="employment_type[]" id="showSalariedHolder" value="Salaried" <?php foreach ($arr as $employee_t){  if ($employee_t == 'Salaried'){ echo 'checked';} } ?>>Salaried
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2" style="padding-left: 0px;">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="employment_type[]" id="showProfesionalEmployment" value="Professional" <?php foreach ($arr as $employee_t){  if ($employee_t == 'Professional'){ echo 'checked';} } ?>>Professional
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2" style="padding-left: 0px;">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="employment_type[]" value="Retired" <?php foreach ($arr as $employee_t){  if ($employee_t == 'Retired'){ echo 'checked';} } ?>>Retired
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="">
                                                <h4>Professional Details/Employment</h4>
                                                <div class="row">
                                                    <div class="col-md-4" style="padding-right: 0px">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="p_name[]" value="Information Technology" <?php $arrs = explode(',', $editData->p_name); foreach ($arrs as $employee_p){  if ($employee_p == 'Information Technology'){ echo 'checked';} } ?>>Information Technology
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2" style="padding-left: 0px;">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="p_name[]" value="Government" <?php foreach ($arrs as $employee_p){  if ($employee_p == 'Government'){ echo 'checked';} } ?>>Government
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2" style="padding-left: 0px;">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="p_name[]" value="Travel/Tourism" <?php foreach ($arrs as $employee_p){  if ($employee_p == 'Travel/Tourism'){ echo 'checked';} } ?>>Travel/Tourism
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4" style="padding-right: 0px">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="p_name[]" value="Small Scale Industry" <?php foreach ($arrs as $employee_p){  if ($employee_p == 'Small Scale Industry'){ echo 'checked';} } ?>>Small Scale Industry
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="p_name[]" value="Transport" <?php foreach ($arrs as $employee_p){  if ($employee_p == 'Transport'){ echo 'checked';} } ?>>Transport
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="p_name[]" value="Export/Import" <?php foreach ($arrs as $employee_p){  if ($employee_p == 'Export/Import'){ echo 'checked';} } ?>>Export/Import
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="p_name[]" value="Medical" <?php foreach ($arrs as $employee_p){  if ($employee_p == 'Medical'){ echo 'checked';} } ?>>Medical
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="p_name[]" value="Agriculture" <?php foreach ($arrs as $employee_p){  if ($employee_p == 'Agriculture'){ echo 'checked';} } ?>>Agriculture
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="p_name[]" value="Lawyer" <?php foreach ($arrs as $employee_p){  if ($employee_p == 'Lawyer'){ echo 'checked';} } ?>>Lawyer
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="p_name[]" value="Construction/Real estate" <?php foreach ($arrs as $employee_p){  if ($employee_p == 'Construction/Real estate'){ echo 'checked';} } ?>>Construction/Real estate
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="p_name[]" value="Others" <?php foreach ($arrs as $employee_p){  if ($employee_p == 'Others'){ echo 'checked';} } ?>>Others
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="">
                                                <h4>Please fill this section for Salaried Card Holder</h4>
                                                <h4>You Work for</h4>
                                                <div class="row">
                                                    <div class="col-md-2" style="padding-right: 0px">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="s_name[]" value="Govt.Dept." <?php $arr_s = explode(',', $editData->s_name); foreach ($arr_s as $employee_s){  if ($employee_s == 'Govt.Dept.'){ echo 'checked';} } ?>>Govt.Dept.
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3"  style="padding-right: 0px">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="s_name[]" value="Public Ltd. Co." <?php foreach ($arr_s as $employee_s){  if ($employee_s == 'Public Ltd. Co.'){ echo 'checked';} } ?>>Public Ltd. Co.
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="s_name[]" value="Private Ltd. Co." <?php foreach ($arr_s as $employee_s){  if ($employee_s == 'Private Ltd. Co.'){ echo 'checked';} } ?>>Private Ltd. Co.
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4" style="padding-left: 0px; padding-right: 0px">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="s_name[]" value="Partnership/Proprietorship" <?php foreach ($arr_s as $employee_s){  if ($employee_s == 'Partnership/Proprietorship'){ echo 'checked';} } ?>>Partnership/Proprietorship
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <input class="form-control" name="s_company" placeholder="Name of the Company" autocomplete="off" value="<?php echo $editData->s_company ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input class="form-control" name="s_designation" placeholder="Current Designaton" autocomplete="off" value="<?php echo $editData->s_designation ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input class="form-control" name="s_years" placeholder="Years at Current Job" autocomplete="off" value="<?php echo $editData->s_years ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="">
                                                <h4>Please Fill this section for Self employment</h4>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="checkbox">
                                                            <label>
                                                                Your Farm is:
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="s_e_name[]" value="Private Ltd. Co." <?php $arr_se = explode(',', $editData->s_e_name); foreach ($arr_se as $employee_se){  if ($employee_se == 'Private Ltd. Co.'){ echo 'checked';} } ?>>Private Ltd. Co.
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="col-md-5">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="s_e_name[]" value="Proprietor" <?php foreach ($arr_se as $employee_se){  if ($employee_se == 'Proprietor'){ echo 'checked';} } ?>>Proprietor
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="col-md-5">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="s_e_name[]" value="Partnership" <?php foreach ($arr_se as $employee_se){  if ($employee_se == 'Partnership'){ echo 'checked';} } ?>>Partnership
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input class="form-control" name="s_e_designation" placeholder="Designaton" autocomplete="off" value="<?php echo $editData->s_e_designation ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input class="form-control" name="s_e_years" placeholder="Years at Current Business" autocomplete="off" value="<?php echo $editData->s_e_years ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input class="form-control" name="s_e_invest" placeholder="Capital Invest(BDT Lakh)" autocomplete="off" value="<?php echo $editData->s_e_invest ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input class="form-control" name="s_e_previous_business" placeholder="Years at Previous Business" autocomplete="off" value="<?php echo $editData->s_e_previous_business ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input class="form-control" name="s_e_annual_turnover" placeholder="Annual Turnover(BDT Lakh)" autocomplete="off" value="<?php echo $editData->s_e_annual_turnover ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <h4>If No.</h4>
                                                <h4>Income Details (Optional)</h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input class="form-control" name="s_e_income" placeholder="Income per annum(BDT)" autocomplete="off" value="<?php echo $editData->s_e_income ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4>Bank Details: Are you a Customer of SBI?</h4>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="sbl_status" id="sblyes" value="Yes" <?php $emp_s = explode(',', $editData->sbl_status); foreach ($emp_s as $empl_s){  if ($empl_s == 'Yes'){ echo 'checked';} } ?>>Yes
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="sbl_status" value="No" <?php foreach ($emp_s as $empl_s){  if ($empl_s == 'No'){ echo 'checked';} } ?>>No
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input class="form-control" name="sbl_years" value="<?php echo $editData->sbl_years; ?>" placeholder="Number of years with the Bank" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input class="form-control" name="sbl_customer_no" value="<?php echo $editData->sbl_customer_no; ?>" placeholder="Customer No" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input class="form-control" name="sbl_branch" value="<?php echo $editData->sbl_branch; ?>" placeholder="Branch Name" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input class="form-control" name="sbl_nature_account" value="<?php echo $editData->sbl_nature_account; ?>" placeholder="Nature of Account" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="sbl_account_type[]" value="Deposit" <?php $arr_sbl = explode(',', $editData->sbl_account_type); foreach ($arr_sbl as $sbl){  if ($sbl == 'Deposit'){ echo 'checked';} } ?>>Deposit
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="sbl_account_type[]" value="Personal/loan" <?php foreach ($arr_sbl as $sbl){  if ($sbl == 'Personal/loan'){ echo 'checked';} } ?>>Personal/loan
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2" style="padding-right: 0px; padding-left: 0px">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="sbl_account_type[]" value="Car Loan" <?php foreach ($arr_sbl as $sbl){  if ($sbl == 'Car Loan'){ echo 'checked';} } ?>>Car Loan
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="sbl_account_type[]" value="Home Loan" <?php foreach ($arr_sbl as $sbl){  if ($sbl == 'Home Loan'){ echo 'checked';} } ?>>Home Loan
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="sbl_account_type[]" value="Other" <?php foreach ($arr_sbl as $sbl){  if ($sbl == 'Other'){ echo 'checked';} } ?>>Other
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input class="form-control" name="sbl_banker_name" placeholder="Name of your Main Banker" autocomplete="off" value="<?php echo $editData->sbl_banker_name ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input class="form-control" name="sbl_banker_branch" placeholder="Branch Name" autocomplete="off" value="<?php echo $editData->sbl_banker_branch ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input class="form-control" name="sbl_banker_city" placeholder="City" autocomplete="off" value="<?php echo $editData->sbl_banker_city ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input class="form-control" name="sbl_banker_pin" placeholder="PIN" autocomplete="off" value="<?php echo $editData->sbl_banker_pin ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input class="form-control" name="sbl_banker_account_no" placeholder="Bank Account Number" autocomplete="off" value="<?php echo $editData->sbl_banker_account_no ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <h4>Nature of Account:</h4>
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="sbl_banker_account_nature[]" value="General" <?php $n_sbl = explode(',', $editData->sbl_banker_account_nature); foreach ($n_sbl as $sbl_n){  if ($sbl_n == 'General'){ echo 'checked';} } ?>>General
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="sbl_banker_account_nature[]" value="Savings" <?php foreach ($n_sbl as $sbl_n){  if ($sbl_n == 'Savings'){ echo 'checked';} } ?> >Savings
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="sbl_banker_account_nature[]" value="Fixed" <?php foreach ($n_sbl as $sbl_n){  if ($sbl_n == 'Fixed'){ echo 'checked';} } ?> >Fixed
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="sbl_banker_account_nature[]" value="Loan" <?php foreach ($n_sbl as $sbl_n){  if ($sbl_n == 'Loan'){ echo 'checked';} } ?> >Loan
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="sbl_banker_account_nature[]" value="Other" <?php foreach ($n_sbl as $sbl_n){  if ($sbl_n == 'Other'){ echo 'checked';} } ?> >Other
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4>Travel Details</h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" name="travel_country" placeholder="Country of Travel" autocomplete="off" value="<?php echo $editData->travel_country; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="travel_date" id="date2" autocomplete="off" placeholder="Date of Travel" value="<?php echo date('d-m-Y', strtotime($editData->travel_date)); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <h4>Type of Travel</h4>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="travel_type[]" VALUE="Business" <?php $t_TYPE = explode(',', $editData->travel_type); foreach ($t_TYPE as $type){  if ($type == 'Business'){ echo 'checked';} } ?>>Business
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="travel_type[]" VALUE="Personal/Leisure" <?php foreach ($t_TYPE as $type){  if ($type == 'Personal/Leisure'){ echo 'checked';} } ?>>Personal/Leisure
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="travel_type[]" VALUE="Education"  <?php foreach ($t_TYPE as $type){  if ($type == 'Education'){ echo 'checked';} } ?>>Education
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="travel_type[]" VALUE="Others" <?php foreach ($t_TYPE as $type){  if ($type == 'Others'){ echo 'checked';} } ?>>Others
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <input class="form-control" name="travel_total_days" value="<?php echo $editData->travel_total_days ?>" placeholder="Number of Days of Travel" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="hidden" name="id" value="<?php echo $editData->id ?>" >
                                        </div>
                                        <div class="col-md-6">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <button type="reset" class="btn btn-default">Reset</button>
                                        </div>
                                    </div>
                                {!! Form::close() !!}
                                <!-- /.row (nested) -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            $('#showselfEmployment').click(function() {
                $('#SelfEmployement').slideToggle("fast");
            });
        });
        $(document).ready(function() {
            $('#showSalariedHolder').click(function() {
                $('#SalariedHolder').slideToggle("fast");
            });
        });
        $(document).ready(function() {
            $('#showProfesionalEmployment').click(function() {
                $('#ProfesionalEmployment').slideToggle("fast");
            });
        });
        $(document).ready(function() {
            $('#sblyes').click(function() {
                $('#sblyesShow').slideToggle("fast");
            });
        });
    </script>
    <script>
        $("#foregin_currency").on("keypress keyup blur",function (event) {
            //this.value = this.value.replace(/[^0-9\.]/g,'');
            $(this).val($(this).val().replace(/[^0-9\.]/g,''));
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });
    </script>
    <script>

        $('select[name="c_type"]').on('change', function () {
            var keyword = $(this).val();
            $.ajax({
                url: "{{ url("/search-dollar-rate") }}",
                type: 'GET',
                data: {keyword: keyword},
                cache: false,
                success: function (result) {
                    document.getElementById("rate").value=result.currency_rate;
                    document.getElementById("rate2").value=result.currency_rate;
                }
            }, 'json');


        });
    </script>
    <script>

        $( "#passport" ).keyup(function() {
            var keyword = $(this).val();
            $.ajax({
                url: "{{ url("/search-passport-appointment") }}",
                type: 'GET',
                data: {keyword: keyword},
                cache: false,
                success: function (result) {
                    if (result){
                        console.log(result);
                        document.getElementById("applicant_name").value=result.Applicant_name;
                        document.getElementById("phone").value=result.Contact;
                    }


                    //document.getElementById("rate2").value=result.currency_rate;
                }
            }, 'json');
        });
    </script>
    <script>
        $( "#foregin_currency" ).keyup(function() {
            var rate = document.getElementById("rate2").value;
            var fCurrency = document.getElementById("foregin_currency").value;
            var charge = document.getElementById("charge").value;
            var total = rate*fCurrency;
            console.log(total);
            document.getElementById("amount_in_bdt").value=total;
            document.getElementById("amount_in_bdt2").value=total;
            var totalWithCharge = parseInt(total) + parseInt(charge);
            document.getElementById("total_taka").value=totalWithCharge;
            document.getElementById("total_taka_d").value=totalWithCharge;

        });
    </script>
    <script>
        // length check
        $('#phone').on('keyup',function(){
            var phone = $(this).val().length;
            if (phone >10){
                alert('Max Phone Length 10');
            }
        });
        $('#mobile_number').on('keyup',function(){
            var phone = $(this).val().length;
            if (phone >10){
                alert('Max Phone Length 10');
            }
        });
        $('#e_phone').on('keyup',function(){
            var phone = $(this).val().length;
            if (phone >10){
                alert('Max Phone Length 10');
            }
        });
        $('#phone_11').on('keyup',function(){
            var phone = $(this).val().length;
            if (phone >10){
                alert('Max Phone Length 10');
            }
        });
        $('#phone_22').on('keyup',function(){
            var phone = $(this).val().length;
            if (phone >10){
                alert('Max Phone Length 10');
            }
        });
        $('#phone_33').on('keyup',function(){
            var phone = $(this).val().length;
            if (phone >10){
                alert('Max Phone Length 10');
            }
        });
        $('#phone_44').on('keyup',function(){
            var phone = $(this).val().length;
            if (phone >10){
                alert('Max Phone Length 10');
            }
        });
    </script>
   <?php } ?>

@endsection
<!--Page Content End Here-->