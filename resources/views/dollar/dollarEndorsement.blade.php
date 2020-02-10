@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Dollar Endorsement
@endsection

<!--Page Header-->
@section('page-header')
    Dollar Endorsement
@endsection

<!--Page Content Start Here-->
@section('page-content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="main_part">
                    <div class="row">
                        <div class="col-md-2"><h4 style="padding-left: 20px">Travel Card: $ <?php print_r($travel_card[0]->sum_f_currency) ?> </h4></div>
                        <div class="col-md-2"><h4 style="padding-left: 20px">Commission: $ <?php print_r(round($commission[0]->sum_commission, 2)) ?></h4></div>
                        <div class="col-md-3"><h4 style="padding-left: 20px">Service Charge: <?php print_r($service_charge[0]->sum_s_charge) ?> BDT</h4></div>
                        <div class="col-md-3"><h4>Total BDT: <?php print_r(round($balance[0]->sum_bdt, 2)) ?> BDT</h4></div>
                        <div class="col-md-2"><h4>Quantity: <?php print_r($counts[0]->c_count) ?></h4></div>
                    </div>
                    @if (Session::has('message'))
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3 alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                </button>
                                <h4> {{ Session::get('message') }}</h4>
                            </div>
                        </div>
                @endif
                <!-- Code Here.... -->
                    <?php if (isset($print_data) && !empty($print_data)){ ?>
                    <button  onclick="printDiv('printableArea')" class="btn_approved" style="margin-right: 10px;" >TM Print</button>
                    <?php } ?>

                    <br>
                    <div class="row" style="padding: 20px;">
                        <div class="col-md-12 change_passport_body" style="width: 100%">
                            <div class="panel panel-default">
                                <div class="panel-heading">

                                </div>
                                <div class="panel-body">
                                    {!! Form::open(['url' => 'dollar/store','id' => 'applicant_form']) !!}
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
                                        <div class="col-lg-12" style="border: 1px solid #ddd; padding: 10px;background: #f7f7f7">
                                            <h4 style="margin-top: 0px;color: #8c0404;font-weight: 600; border-bottom: 2px solid #fff">Required Fields*</h4>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <?php if (isset($currencyName->currency_rate) && !empty($currencyName->currency_rate)){ ?>
                                                            <input class="form-control" value="{{$currencyName->currency_rate}}"  placeholder="Current Dollar Rate" disabled>
                                                            <input type="hidden" name="c_rate" value="{{$currencyName->currency_rate}}" id="rate2">
                                                       <?php }else{ ?>
                                                            <input type="text" value="Please Set Currency Rate !" style="color: red; font-weight: bold;" disabled="">
                                                        <?php } ?>

                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input type="text" class="datepicker form-control" data-date-format="dd/mm/yyyy" name="created_date" id="selected_date" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <select class="form-control" name="branch_name" required>
                                                            <option value="<?php echo $center_name; ?>"><?php echo $center_name; ?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <input class="form-control" name="branch_code" placeholder="Branch Code" autocomplete="off" type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <input class="form-control" name="serial_number" placeholder="Registration Number" autocomplete="off" type="text" required onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label>T. Details Currency</label>
                                                    <div class="form-group">
                                                        <?php if (isset($currencyName->currency_name) && !empty($currencyName->currency_name)){ ?>
                                                            <select class="form-control" id="currency_name" name="c_type">
                                                                <option value="{{$currencyName->currency_name}}">{{$currencyName->currency_name}}</option>
                                                            </select>
                                                        <?php }else{ ?>
                                                            <input type="text" value="Please Set Currency Rate !" style="color: red; font-weight: bold;" disabled="" required>
                                                        <?php } ?>

                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label>Foreign Currency</label>
                                                    <div class="form-group">
                                                        <input class="form-control" id="foregin_currency" name="f_currency" placeholder="amount in foreign currency" autocomplete="off" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label>Amount in BDT</label>
                                                    <div class="form-group">
                                                        <input class="form-control" id="amount_in_bdt" name="" placeholder="amount in BDT" disabled autocomplete="off">
                                                        <input class="form-control" id="amount_in_bdt2" name="amount_bdt" placeholder="amount in BDT" autocomplete="off" type="hidden" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label>Commission</label>
                                                    <div class="form-group">
                                                        <input class="form-control" id="commission" name="" placeholder="Commission (USD)" disabled autocomplete="off">
                                                        <input class="form-control" id="commission2" name="commission" autocomplete="off" type="hidden" value="">
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <label>Service Charge</label>
                                                    <div class="form-group">
                                                        <input class="form-control" id="charge" name="" value="{{$serviceFee->Svc_Fee}} " placeholder="Service Charge" autocomplete="off" disabled>
                                                        <input class="form-control" id="charge2" name="s_charge" value="{{$serviceFee->Svc_Fee}} " placeholder="Service Charge" autocomplete="off" type="hidden">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label>Total Amount</label>
                                                    <div class="form-group">
                                                        <input class="form-control" id="total_taka_d" name="" placeholder="Total" autocomplete="off" disabled="">
                                                        <input class="form-control" id="total_taka" name="t_amount" placeholder="Total" autocomplete="off" type="hidden" value="">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input class="form-control" id="passport" name="passport_no" placeholder="Passport Number" autocomplete="off" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input class="datepicker form-control" name="date_of_issue" data-date-format="dd/mm/yyyy" id="date_of_issue" placeholder=" Date of Issue of Passport" autocomplete="off">
                                                        {{--<input type="date" class="form-control" name="date_of_issue" id="datemask" autocomplete="off" placeholder=" Date of Issue Passport" required>--}}
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input type="text" aria-invalid="expiry_date" class="datepicker form-control" name="expire_date" data-date-format="dd/mm/yyyy" id="expire_date" autocomplete="off" placeholder="Expiry Date of Passport" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input class="form-control" name="place_of_issue" placeholder="Place of Issue of Passport" autocomplete="off" value="Dhaka" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input class="form-control" id="applicant_name" name="a_name" placeholder="Name of the applicant" autocomplete="off" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input class="form-control" name="a_mobile" id="mobile_number" pattern=".{10}" placeholder="Mobile Number (1XXXXXXXXX)" autocomplete="off" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input class="form-control" id="urn_number" name="urn" placeholder="URN" autocomplete="off" type="text" pattern=".{10}" required title="10 number minimum" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input class="form-control" id="digit" name="digit" placeholder="Travel Card Number" autocomplete="off" type="text" pattern=".{4,}"   required title="4 number minimum" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <textarea class="form-control" id="c_address" name="current_address" required rows="3" placeholder="Current Address of the applicant"></textarea>
                                                    </div>
                                                </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <input class="form-control" id="mother_name" name="a_maiden_name" required placeholder="Mother's Maiden Name" autocomplete="off" >
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <input type="text" class="datepicker form-control" required data-date-format="dd/mm/yyyy" name="a_birth" id="date_of_birth" autocomplete="off" placeholder="Applicant's Date of Birth" >
                                                </div>
                                            </div>

                                            <div class="col-md-1" style="padding-right: 0px">
                                                <h4>Gender:</h4>
                                            </div>
                                            <div class="col-md-1" style="padding-right: 0px;padding-left: 0px">
                                                <div class="checkbox">
                                                    <label style="padding-left: 0px">
                                                        <input type="radio" id="male" name="gender" required value="Male" > Male
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-1" style="padding-left: 0px;">
                                                <div class="checkbox">
                                                    <label style="padding-left: 0px">
                                                        <input type="radio" id="female" name="gender" value="Female"> Female
                                                    </label>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12" style="border: 1px solid #ddd;padding: 10px">
                                            <h4 style="margin-top: 0px;color: #054e00;font-weight: 600;border-bottom: 2px solid #ddd">Optional fields</h4>
                                            <div class="row">

                                            </div>
                                            <h4>Personal Information</h4>
                                            <div class="row">

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input class="form-control" name="a_phone" pattern=".{10}" title="Minimum & Maximum 10 digit" id="phone" placeholder="Phone (1XXXXXXXXX)" autocomplete="off" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" >
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" style="margin-bottom: 0px">
                                                        <input class="form-control" type="email" name="a_email" placeholder="Email Address" autocomplete="off" >
                                                    </div>
                                                    <p>Your Prepaid Card Statement will be sent on the above Email ID</p>
                                                </div>

                                            </div>
                                            <h4>Security Details</h4>
                                            <div class="row">

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input class="form-control" name="a_nid" placeholder="National ID Number" autocomplete="off" >
                                                    </div>
                                                </div>
                                            </div>
                                            <h4>Emergency Details</h4>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input class="form-control" name="e_name" placeholder="Name of the Person to Contact" autocomplete="off" >
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input class="form-control" name="e_relation" placeholder="Relationship  with the Applicant" autocomplete="off" >
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input class="form-control" name="e_phone" id="e_phone" pattern=".{10,10}" title="Minimum 10 digit" placeholder="Phone number (1XXXXXXXXX)" autocomplete="off" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" >
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <textarea class="form-control" name="e_address"  rows="3" placeholder="Address"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <textarea class="form-control" rows="3" name="e_permanent_address"  placeholder="Permanent Residential Address as appearing on the passport"></textarea>
                                                    </div>
                                                </div>

                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input class="form-control" name="e_city" placeholder="City"  autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input class="form-control" name="e_pin" placeholder="PIN" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input class="form-control" name="e_phone1" id="phone_11" pattern=".{10}" title="Minimum 10 digit" placeholder="Phone 1 (1XXXXXXXXX)" autocomplete="off" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input class="form-control" name="e_phone2" id="phone_22" pattern=".{10}" title="Minimum 10 digit" placeholder="Phone 2 (1XXXXXXXXX)" autocomplete="off" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <textarea class="form-control" name="e_address_2" rows="4" placeholder="Business/Office Name & Address of the Card Holder"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input class="form-control" name="e_city_2" placeholder="City" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input class="form-control" name="e_pin_2" placeholder="PIN" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input class="form-control" name="e_phone_3" id="phone_33" pattern=".{10}" title="Minimum 10 digit" placeholder="Phone 1 (1XXXXXXXXX)" autocomplete="off" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input class="form-control" name="e_phone_extn" id="phone_44" pattern=".{10}" title="Minimum 10 digit" placeholder="Extn (1XXXXXXXXX)" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <h4>Funding Details</h4>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input class="form-control" name="cash_amount" placeholder="Cash Amount" autocomplete="off" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input class="form-control" name="cheque_amount" placeholder="Cheque Amount" autocomplete="off" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input class="form-control" name="sbl_ca_account_no" placeholder="Debi SBI/CA Account No" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input class="form-control" name="sbl_ca_amount" placeholder="Amount BDT" autocomplete="off" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                                    </div>
                                                </div>
                                            </div>
                                            <h4>Personal Profile</h4>
                                            <h4>Nature of employment</h4>
                                            <div class="row">
                                                <div class="col-md-2" style="padding-right: 0px">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="employment_type[]" id="showselfEmployment" value="Self Employment">Self Employment
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-1" style="padding-left: 0px;">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="employment_type[]" id="showSalariedHolder" value="Salaried">Salaried
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2" style="padding-left: 37px;">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="employment_type[]" id="showProfesionalEmployment" value="Professional">Professional
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-1" style="padding-left: 0px;">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="employment_type[]" value="Retired">Retired
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="ProfesionalEmployment" style="display: none;">
                                                <h4>Professional Details/Employment</h4>
                                                <div class="row">
                                                    <div class="col-md-2" style="padding-right: 0px">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="p_name[]" value="Information Technology">Information Technology
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="p_name[]" value="Government">Government
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="p_name[]" value="Travel/Tourism">Travel/Tourism
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2" style="padding-right: 0px">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="p_name[]" value="Small Scale Industry">Small Scale Industry
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="p_name[]" value="Transport">Transport
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="p_name[]" value="Export/Import">Export/Import
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="p_name[]" value="Medical">Medical
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="p_name[]" value="Agriculture">Agriculture
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="p_name[]" value="Lawyer">Lawyer
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="p_name[]" value="Construction/Real estate">Construction/Real estate
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="p_name[]" value="Others">Others
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="SalariedHolder" style="display: none">
                                                <h4>Please fill this section for Salaried Card Holder</h4>
                                                <h4>You Work for</h4>
                                                <div class="row">
                                                    <div class="col-md-2" style="padding-right: 0px">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="s_name[]" value="Govt.Dept.">Govt.Dept.
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2"  style="padding-right: 0px">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="s_name[]" value="Public Ltd. Co.">Public Ltd. Co.
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="s_name[]" value="Private Ltd. Co.">Private Ltd. Co.
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2" style="padding-left: 0px; padding-right: 0px">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="s_name[]" value="Partnership/Proprietorship">Partnership/Proprietorship
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input class="form-control" name="s_company" placeholder="Name of the Company" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input class="form-control" name="s_designation" placeholder="Current Designaton" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input class="form-control" name="s_years" placeholder="Years at Current Job" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="SelfEmployement" style="display: none;" >
                                                <h4>Please Fill this section for Self employment</h4>
                                                <div class="row">
                                                    <div class="col-md-2"  style="width: 131px;">
                                                        <div class="checkbox">
                                                            <label>
                                                                Your Farm is:
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1"  style="width: 148px;">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="s_e_name[]" value="Private Ltd. Co.">Private Ltd. Co.
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <div class="col-md-3">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="s_e_name[]" value="Proprietorship">Proprietorship
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="col-md-5">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="s_e_name[]" value="Partnership">Partnership
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input class="form-control" name="s_e_designation" placeholder="Designaton" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input class="form-control" name="s_e_years" placeholder="Years at Current Business" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input class="form-control" name="s_e_invest" placeholder="Capital Invest(BDT Lakh)" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input class="form-control" name="s_e_previous_business" placeholder="Years at Previous Business" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input class="form-control" name="s_e_annual_turnover" placeholder="Annual Turnover(BDT Lakh)" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                                <h4>If No.</h4>
                                                <h4>Income Details (Optional)</h4>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input class="form-control" name="s_e_income" placeholder="Income per annum(BDT)" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4>Bank Details: Are you a Customer of SBI?</h4>
                                            <div class="row">
                                                <div class="col-md-1">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="radio" name="sbl_status" id="sblyes" value="Yes">Yes
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="radio" id="sblno" name="sbl_status" value="No">No
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="sblyesShow" style="display: none;">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input class="form-control" name="sbl_years" placeholder="Number of years with the Bank" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input class="form-control" name="sbl_customer_no" placeholder="Customer No" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input class="form-control" name="sbl_branch" placeholder="Branch Name" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input class="form-control" name="sbl_nature_account" placeholder="Nature of Account" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-1">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="sbl_account_type[]" value="Deposit">Deposit
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="sbl_account_type[]" value="Personal/loan">Personal/loan
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1" style="padding-right: 0px; padding-left: 0px">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="sbl_account_type[]" value="Car Loan">Car Loan
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1" style="width: 125px;">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="sbl_account_type[]" value="Home Loan">Home Loan
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="sbl_account_type[]" value="Other">Other
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input class="form-control" name="sbl_banker_name" placeholder="Name of your Main Banker" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input class="form-control" name="sbl_banker_branch" placeholder="Branch Name" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input class="form-control" name="sbl_banker_city" placeholder="City" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input class="form-control" name="sbl_banker_pin" placeholder="PIN" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input class="form-control" name="sbl_banker_account_no" placeholder="Bank Account Number" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                                <h4>Nature of Account:</h4>
                                                <div class="row">
                                                    <div class="col-md-1">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="sbl_banker_account_nature[]" VALUE="Current">Current
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="sbl_banker_account_nature[]" VALUE="Savings">Savings
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="sbl_banker_account_nature[]" value="Fixed">Fixed
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="sbl_banker_account_nature[]" value="Loan">Loan
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="sbl_banker_account_nature[]" value="Other">Other
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4>Travel Details</h4>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input class="form-control" name="travel_country" placeholder="Country of Travel" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input type="text" class="datepicker form-control" data-date-format="dd/mm/yyyy" name="travel_date" id="date2" autocomplete="off" placeholder="Date of Travel">
                                                    </div>
                                                </div>
                                            </div>
                                            <h4>Type of Travel</h4>
                                            <div class="row">
                                                <div class="col-md-1">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="travel_type[]" VALUE="Business">Business
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="travel_type[]" VALUE="Personal/Leisure">Personal/Leisure
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="travel_type[]" VALUE="Education">Education
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="travel_type[]" VALUE="Others">Others
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <input class="form-control" name="travel_total_days" placeholder="Number of Days of Travel" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Referrer By</label>
                                                        <select class="form-control select2" name="refer_id" style="width: 100%;">
                                                            <option selected="selected" value=""></option>
                                                            <?php foreach ($refers as $refer) { ?>
                                                            <option value="<?php echo $refer->refer_id; ?>"><?php echo $refer->refer_id.' - '.$refer->name.' - '.$refer->ivac_id; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6"></div>
                                        <div class="col-md-6">
                                            <button type="submit" class="btn btn-primary" onclick="check()">Submit</button>
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
        function check(){
            var mobile_number = document.getElementById("mobile_number").value;
            var mobile_number_l = mobile_number.length;
            if (mobile_number_l <10 || mobile_number_l>10){
                alert('Mobile number must be 10 digit');
                document.getElementById("mobile_number").style.border = "2px solid red";
                return false;
            }


        }

        $('#sub_name').keyup(function() {
            var keyword = $(this).val();

            $.ajax({
                url:"{{ url("/search-referred-id") }}",
                type:'GET',
                data:{keyword:keyword},
                cache:false,
                success: function(result) {
                    console.log(result);
                    var item = [];
                    item.push('<datalist class="list-group" id="search-list" style="position: absolute;width: 37%; background: #eee;cursor: pointer;">');
                    $.each(result, function(kay, val) {
                        item.push('<option class="list-group-item list-group-item-warning">' + val.name +' - '+ val.refer_id + '</option>')
                    });
                    item.push('</datalist>');
                    if (keyword === '') {
                        $('#search-result').html('');
                    } else {
                        $('#search-result').html(item.join(''));
                    }
                }
            },'json');

        });
    </script>
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
        $(document).ready(function() {
            $('#sblno').click(function() {
                $('#sblyesShow').hide();
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
        var rate = document.getElementById("rate2").value;
        console.log(rate);

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
                    if (result) {
                        document.getElementById("applicant_name").value='';
                        document.getElementById("mobile_number").value='';
                        document.getElementById("date_of_issue").value='';
                        document.getElementById("expire_date").value='';
                        document.getElementById("c_address").value='';
                        document.getElementById("mother_name").value='';
                        document.getElementById("date_of_birth").value='';
                        $( "#female" ).prop( "checked", false );
                        $( "#male" ).prop( "checked", false );

                    }

                    if (result.Applicant_name == undefined){


                    }else {
                        document.getElementById("applicant_name").value=result.Applicant_name;
                        document.getElementById("mobile_number").value=result.Contact;
                        document.getElementById("date_of_issue").value=result.date_of_issue;
                        document.getElementById("expire_date").value=result.expiry_date;
                        document.getElementById("c_address").value=result.p_address;
                        document.getElementById("mother_name").value=result.mothers_name;
                        document.getElementById("date_of_birth").value=result.date_of_birth;
                        if (result.gender == 'F'){
                            $( "#female" ).prop( "checked", true );
                            $( "#male" ).prop( "checked", false );
                        }else if (result.gender == 'M'){
                            $( "#male" ).prop( "checked", true );
                            $( "#female" ).prop( "checked", false );
                        }

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
            document.getElementById("amount_in_bdt").value=parseFloat(total).toFixed(2);
            document.getElementById("amount_in_bdt2").value=parseFloat(total).toFixed(2);
            var commission = <?php echo $commission_per_passport->commission; ?>;
            document.getElementById("commission").value=commission;
            document.getElementById("commission2").value=commission;
            var commission_bdt = rate*commission;
            var totalWithCharge = parseFloat(total) + parseFloat(charge) + parseFloat(commission_bdt);
            console.log(totalWithCharge);
            document.getElementById("total_taka").value=totalWithCharge;
            document.getElementById("total_taka_d").value=parseFloat(totalWithCharge).toFixed(2);

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
                document.getElementById("mobile_number").style.border = '2px solid red';
            }else if (phone == 10) {
                document.getElementById("mobile_number").style.border = '1px solid green';
            }
        });
        $('#mobile_number').on('blur',function(){
            var phone = $(this).val().length;
            if (phone <10){
                alert('Minimum Phone Length 10');
                document.getElementById("mobile_number").style.border = '2px solid red';
            }else if (phone == 10){
                document.getElementById("mobile_number").style.border = '1px solid green';
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
        $('#urn_number').on('keyup',function(){
            var urn_number = $(this).val().length;
            var number = $(this).val();
            if (urn_number >10){
                alert('Max URN Number is 10');
                var a = number.substring(0,number.length - 1);
                document.getElementById("urn_number").value=a;
            }
        });
        $('#digit').on('keyup',function(){
            var digit = $(this).val().length;
            var number = $(this).val();
            if (digit >4){
                alert('Max Travel Card Number is 4');
                //console.log(number.length - 1);
                var a = number.substring(0,number.length - 1);
                document.getElementById("digit").value=a;
            }
        });
    </script>



@endsection
<!--Page Content End Here-->
