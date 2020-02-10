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
                    <br>
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
                    <div class="row" style="padding: 20px;">
                        <div class="col-md-12 change_passport_body" style="width: 100%">
                            <div class="panel panel-default">
                                <div class="panel-heading">

                                </div>
                                <div class="panel-body">
                                    {!! Form::open(['url' => 'dollar/store','id' => 'applicant_form']) !!}
                                    <div class="row">
                                        <h4>Application For State Bank Of India Travel Card</h4>
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" id="rate"  placeholder="Current Dollar Rate" disabled>
                                                        <input type="hidden" name="c_rate" value="" id="rate2">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="created_date" id="selected_date" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <select class="form-control" name="branch_name">
                                                            <option value="">Select Branch</option>
                                                            <option value="Gulsan">Gulsan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" name="branch_code" placeholder="Branch Code" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>T. Details Currency</label>
                                                    <div class="form-group">
                                                        <select class="form-control" id="currency_name" name="c_type">
                                                            <option value="">Select Currency</option>
                                                            <?php foreach ($currencyName as $name){ ?>
                                                            <option value="{{$name->currency_name}}">{{$name->currency_name}}</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Foreign Currency</label>
                                                    <div class="form-group">
                                                        <input class="form-control" id="foregin_currency" name="f_currency" placeholder="amount in foreign currency" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Amount in BDT</label>
                                                    <div class="form-group">
                                                        <input class="form-control" id="amount_in_bdt" name="" placeholder="amount in BDT" disabled autocomplete="off">
                                                        <input class="form-control" id="amount_in_bdt2" name="amount_bdt" placeholder="amount in BDT" autocomplete="off" type="hidden" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Service Charge</label>
                                                    <div class="form-group">
                                                        <input class="form-control" id="charge" name="" value="{{$serviceFee->Svc_Fee}} " placeholder="Service Charge" autocomplete="off" disabled>
                                                        <input class="form-control" id="charge2" name="s_charge" value="{{$serviceFee->Svc_Fee}} " placeholder="Service Charge" autocomplete="off" type="hidden">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Total Amount</label>
                                                    <div class="form-group">
                                                        <input class="form-control" id="total_taka_d" name="" placeholder="Total" autocomplete="off" disabled="">
                                                        <input class="form-control" id="total_taka" name="t_amount" placeholder="Total" autocomplete="off" type="hidden" value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <h4>Personal Information</h4>
                                            <div class="form-group">
                                                <input class="form-control" name="a_name" placeholder="Name Of the applicant" autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <textarea class="form-control" name="current_address" rows="3" placeholder="Current Address of the applicant"></textarea>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" name="a_phone" id="phone" placeholder="Phone" autocomplete="off" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" name="a_mobile" id="mobile_number" placeholder="Mobile Number " autocomplete="off" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" type="email" name="a_email" placeholder="Email Address" autocomplete="off">
                                                    </div>
                                                    <p>Your Prepaid Card Statement will be sent on the above Email Id</p>
                                                </div>
                                                <div class="col-md-1">
                                                    <h4>Gender:</h4>
                                                </div>
                                                <div class="col-md-2" style="padding-right: 0px">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="radio" name="gender" value="Male"> Male
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3" style="padding-left: 0px;">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="radio" name="gender" value="Female"> Female
                                                        </label>
                                                    </div>
                                                </div>

                                            </div>
                                            <h4>Security Details</h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" name="a_maiden_name" placeholder="Mother's Maiden Name" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="a_birth" id="date" autocomplete="off" placeholder="Applicant Date of Birth">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" name="passport_no" placeholder="Passport Number" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" name="place_of_issue" placeholder="Place of Issue" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="date_of_issue" id="entry_date" autocomplete="off" placeholder=" Date of Issue">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="expire_date" id="expire_date" autocomplete="off" placeholder="Expiry Date">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" name="a_nid" placeholder="National Id Number" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <h4>Emergency Details</h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" name="e_name" placeholder="Name of the Person to Contact" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" name="e_relation" placeholder="Relationship  with the Applicant" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" name="e_phone" id="e_phone" placeholder="Phone number" autocomplete="off" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <textarea class="form-control" name="e_address" rows="3" placeholder="Address"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <textarea class="form-control" rows="3" name="e_permanent_address" placeholder="Permanent Residential Address as appearing on the passport"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" name="e_city" placeholder="City"  autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" name="e_pin" placeholder="PIN" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" name="e_phone1" id="phone_11" placeholder="Phone 1" autocomplete="off" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" name="e_phone2" id="phone_22" placeholder="Phone 2" autocomplete="off" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <textarea class="form-control" name="e_address_2" rows="3" placeholder="Business/Office name & Address of the card Holder"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" name="e_city_2" placeholder="City" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" name="e_pin_2" placeholder="PIN" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" name="e_phone_3" id="phone_33" placeholder="Phone 1" autocomplete="off" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" name="e_phone_extn" id="phone_44" placeholder="Extn" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <h4>Funding Details</h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" name="cash_amount" placeholder="Cash Amount" autocomplete="off" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" name="cheque_amount" placeholder="Cheque Amount" autocomplete="off" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" name="sbl_ca_account_no" placeholder="Debi SBI/CA Account No" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" name="sbl_ca_amount" placeholder="Amount BDT" autocomplete="off" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h4>Personal Profile</h4>
                                            <h4>Nature of employment</h4>
                                            <div class="row">
                                                <div class="col-md-3" style="padding-right: 0px">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="employment_type[]" id="showselfEmployment" value="Self Employment">Self Employment
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2" style="padding-left: 0px;">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="employment_type[]" id="showSalariedHolder" value="Salaried">Salaried
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2" style="padding-left: 0px;">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="employment_type[]" id="showProfesionalEmployment" value="Professional">Professional
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2" style="padding-left: 0px;">
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
                                                    <div class="col-md-4" style="padding-right: 0px">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="p_name[]" value="Information Technology">Information Technology
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2" style="padding-left: 0px;">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="p_name[]" value="Government">Government
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2" style="padding-left: 0px;">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="p_name[]" value="Travel/Tourism">Travel/Tourism
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4" style="padding-right: 0px">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="p_name[]" value="Small Scale Industry">Small Scale Industry
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="p_name[]" value="Transport">Transport
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="p_name[]" value="Export/Import">Export/Import
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="p_name[]" value="Medical">Medical
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
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
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5">
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
                                                <h4>Please Fill this section for Salaried Holder</h4>
                                                <h4>You Work for</h4>
                                                <div class="row">
                                                    <div class="col-md-2" style="padding-right: 0px">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="s_name[]" value="Govt.Dept.">Govt.Dept.
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3"  style="padding-right: 0px">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="s_name[]" value="Public Ltd. Co.">Public Ltd. Co.
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="s_name[]" value="Private Ltd. Co.">Private Ltd. Co.
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4" style="padding-left: 0px; padding-right: 0px">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="s_name[]" value="Partnership/Proprietorship">Partnership/Proprietorship
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <input class="form-control" name="s_company" placeholder="Name of the Company" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input class="form-control" name="s_designation" placeholder="Current Designaton" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input class="form-control" name="s_years" placeholder="Years at Current Job" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="SelfEmployement" style="display: none;" >
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
                                                                <input type="checkbox" name="s_e_name[]" value="Private Ltd. Co.">Private Ltd. Co.
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="col-md-5">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="s_e_name[]" value="Proprietor">Proprietor
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
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input class="form-control" name="s_e_designation" placeholder="Designaton" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input class="form-control" name="s_e_years" placeholder="Years at Current Business" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input class="form-control" name="s_e_invest" placeholder="Capital Invest(BDT Lakh)" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input class="form-control" name="s_e_previous_business" placeholder="Years at Previous Business" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input class="form-control" name="s_e_annual_turnover" placeholder="Annual Turnover(BDT Lakh)" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                                <h4>If No.</h4>
                                                <h4>Income Details (Optional)</h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input class="form-control" name="s_e_income" placeholder="Income per Annum(BDT)" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4>Bank Details: Are you a Customer of SBI ?</h4>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="sbl_status" id="sblyes" value="Yes">Yes
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="sbl_status" value="No">No
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="sblyesShow" style="display: none;">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input class="form-control" name="sbl_years" placeholder="Number of years with the Bank" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input class="form-control" name="sbl_customer_no" placeholder="Customer No" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input class="form-control" name="sbl_branch" placeholder="Branch Name" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input class="form-control" name="sbl_nature_account" placeholder="Nature of Account" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="sbl_account_type[]" value="Deposit">Deposit
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="sbl_account_type[]" value="Personal/loan">Personal/loan
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2" style="padding-right: 0px; padding-left: 0px">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="sbl_account_type[]" value="Car Loan">Car Loan
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="sbl_account_type[]" value="Home Loan">Home Loan
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="sbl_account_type[]" value="Other">Other
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input class="form-control" name="sbl_banker_name" placeholder="Name of your Main Banker" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input class="form-control" name="sbl_banker_branch" placeholder="Branch Name" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input class="form-control" name="sbl_banker_city" placeholder="City" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input class="form-control" name="sbl_banker_pin" placeholder="PIN" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input class="form-control" name="sbl_banker_account_no" placeholder="Bank Account Number" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                                <h4>Nature of Account:</h4>
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="sbl_banker_account_nature[]" VALUE="General">General
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="sbl_banker_account_nature[]" VALUE="Savings">Savings
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="sbl_banker_account_nature[]" value="Fixed">Fixed
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="sbl_banker_account_nature[]" value="Loan">Loan
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="sbl_banker_account_nature[]" value="Other">Other
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4>Travels Details</h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" name="travel_country" placeholder="Country of Travels" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="travel_date" id="date2" autocomplete="off" placeholder="Date of Travel">
                                                    </div>
                                                </div>
                                            </div>
                                            <h4>Type of Travel</h4>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="travel_type[]" VALUE="Business">Business
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="travel_type[]" VALUE="Personal/Leisure">Personal/Leisure
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="travel_type[]" VALUE="Education">Education
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="travel_type[]" VALUE="Others">Others
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <input class="form-control" name="travel_total_days" placeholder="Number of Days of Travel" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6"></div>
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

    <style>
        @media print {
            @page  layout{ size: portrait;
                size: A4;
                margin: 0px !important;
                padding: 0px !important;

            }
        }
    </style>

    <style>
        /*Print Slip*/

        @media print {
            @page  layout{ size: landscape;
                size: A4;
                margin: 0px !important;
                padding: 0px !important;

            }
            .noprint {
                display: none;
            }


            /*#printableArea {*/
            /*display: block !important;*/
            /*font-size: 11px !important;*/

            /*}*/

            #p{
                padding: 0px 0px 0px 0px !important;
            }
            textcolor{
                color:#2ABCE0;
            }
            #printableArea{
                margin: 0px !important;
                padding: 0px !important;

            }
            .layout{
                width: 21cm;
                height: 29.7cm;
            }

        }
        @media print {
            html, body {
                width: 100%;
                height: 100%;
            }
        }

    </style>


    <div id="printableArea" style="display: none;">
        <table class="layout">
            <table  width="100%">
                <tbody>

                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td style="font-size: 11px;padding: 0px !important;margin: 0px !important;" width="33%">
                        <p style="margin: 5px !important;line-height: 1em;color:#000 !important;" >Please fill this section for Self Employed Card Holder:</p>
                        <p style="margin: 7px !important;line-height: 1em" >Your Farm is:
                            <?php $type = explode(',',$print_data->s_e_name);
                            $sArray = array('Private Ltd. Co.','Proprietorship','Partnership');
                            foreach($sArray as $sbi){
                                foreach ($type as $sbi_data){
                                    if ($sbi_data == $sbi){
                                        $check = 'checked';
                                        break;
                                    }else{
                                        $check ='';
                                    }
                                }
                                echo '<span  style="padding-right:10px;">'.$sbi.'&nbsp;<input type="checkbox" style="margin-top: 10px" >'.$check.'</span>';
                            }
                            ?>
                        </p>
                        <p style="margin: 7px !important;" >Designation: <span style="border: 1px solid #ddd;padding-right: 20px;padding-left: 3px">{{$print_data->s_e_designation}}</span></p>
                        <p style="margin: 7px !important;" >Years at Current Business: <span style="border: 1px solid #ddd;padding-right: 40px;padding-left: 3px">{{$print_data->s_e_years}}</span></p>
                        <p style="margin: 7px !important;" >Capital Invest (BDT Lakh): <span style="border: 1px solid #ddd;padding-right: 80px;padding-left: 3px">{{$print_data->s_e_invest}}</span></p>
                        <p style="margin: 7px !important;" >Years at Previous Business: <span style="border: 1px solid #ddd;padding-right: 10px;padding-left: 3px;">{{$print_data->s_e_previous_business}}</span></p>
                        <p style="margin: 7px !important;" >Annual Turnover (BDT Lakh): <span style="border: 1px solid #ddd;padding-right: 90px;padding-left: 3px">{{$print_data->s_e_annual_turnover}}</span></p>
                        <p style="margin: 7px !important;line-height: 1em;" >If NO,</p>
                        <p style="margin: 7px !important;line-height: 1em !important;padding: 0px !important;color:#000 !important;" >Income Details (Optional) </p>
                        <p style="margin: 7px !important;" >Income per annum(BDT): <span style="border: 1px solid #ddd;padding-right: 80px;padding-left: 3px">{{$print_data->s_e_income}}</span></p>
                        <p style="margin: 5px !important;line-height: 1em;" ><span style="color:#000 !important;">Bank Details:</span> Are you a Customer of SBI?</p>
                        <p style="margin: 5px !important;line-height: 1em;" ><span><?php if ($print_data->sbl_status == 'Yes'){ echo $print_data->sbl_status.' <input type="checkbox" checked> &nbsp;&nbsp; No <input type="checkbox">'; } ?><?php if ($print_data->sbl_status == 'No'){ echo 'Yes <input type="checkbox"> &nbsp;&nbsp; '.$print_data->sbl_status.' <input type="checkbox" checked>'; } ?></span></p>
                        <p style="margin: 5px !important;" >If Yes then Number of Years with the Bank:<span style="border: 1px solid #ddd;padding-right: 20px;padding-left: 3px"> {{$print_data->sbl_years}}</span></p>
                        <p style="margin: 5px !important;" >Customer No: <span style="border: 1px solid #ddd;padding-right: 130px;padding-left: 3px">{{$print_data->sbl_customer_no}}</span></p>
                        <p style="margin: 5px !important;" >Branch Name: <span style="border: 1px solid #ddd;padding-right: 20px;padding-left: 3px">{{$print_data->sbl_branch}}</span></p>
                        <p style="margin: 5px !important;" ><span style="color:#000 !important;">Nature of Account:</span> <span style="border: 1px solid #ddd;padding-right: 20px;padding-left: 3px">{{$print_data->sbl_nature_account}}</span></p>
                        <p style="margin: 5px !important;" ><?php $d = explode(',',$print_data->sbl_account_type);
                            $sbiArray = array('Deposit','Personal/loan','Car Loan','Home Loan','Other');
                            foreach($sbiArray as $sbi){
                                foreach ($d as $sbi_data){
                                    if ($sbi_data == $sbi){
                                        $check = 'checked';
                                        break;
                                    }else{
                                        $check ='';
                                    }
                                }
                                echo '<span  style="padding-right:10px;line-height: 1em; ">'.$sbi.'&nbsp;<input type="checkbox" style="margin-top:10px" '.$check.'></span>';
                            }
                            ?>
                        </p>
                        <p style="margin: 5px !important;" >Name of your Main Banker:<span style="border: 1px solid #ddd;padding-right: 10px;padding-left: 3px"> {{$print_data->sbl_banker_name}}</span></p>
                        <p style="margin: 5px !important;" >Branch Name:<span style="border: 1px solid #ddd;padding-right: 20px;padding-left: 3px"> {{$print_data->sbl_banker_branch}}</span></p>
                        <p style="margin: 5px !important;" >City: <span style="border: 1px solid #ddd;padding-right: 30px;padding-left: 3px">{{$print_data->sbl_banker_city}}</span> &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; <span style="">PIN: <span style="border: 1px solid #ddd;padding-right: 30px;padding-left: 3px"> {{$print_data->sbl_banker_pin}}</span></span></p>

                        <p style="margin: 5px !important;" >Bank Account No: <span style="border: 1px solid #ddd;padding-right: 20px;padding-left: 3px">{{$print_data->sbl_banker_account_no}}</span></p>
                        <p style="margin: 5px !important;line-height: 1em;" >Nature of Account:</p>
                        <p style="margin: 5px !important;" >
                            <?php $n = explode(',',$print_data->sbl_banker_account_nature);
                            $sbiArray = array('Current','Savings','Fixed','Loan','Other');
                            foreach($sbiArray as $sbi){
                                foreach ($n as $sbi_data){
                                    if ($sbi_data == $sbi){
                                        $check = 'checked';
                                        break;
                                    }else{
                                        $check ='';
                                    }
                                }
                                echo '<span  style="padding-right:5px">'.$sbi.'&nbsp;<input type="checkbox" style="margin-top:10px" '.$check.'></span>';
                            }
                            ?></p>
                        <p style="margin: 5px !important;line-height: 1em;color:#000 !important;" >Travel Details:</p>
                        <p style="margin: 5px !important;" >Country of Travel: <span style="border: 1px solid #ddd;padding-right: 100px;padding-left: 3px">{{$print_data->travel_country}}</span></p>
                        <p style="margin: 5px !important;" >Date of Travel: <span style="border: 1px solid #ddd;padding-right: 100px;padding-left: 3px"><?php if ($print_data->travel_date != 000-00-00) echo date('d-m-Y', strtotime($print_data->travel_date)) ?></span></p>
                        <p style="margin: 5px !important;" >Type of Travel:
                            <?php $type = explode(',',$print_data->travel_type);
                            $sArray = array('Business','Personal/Leisure','Education','Others');
                            foreach($sArray as $sbi){
                                foreach ($type as $sbi_data){
                                    if ($sbi_data == $sbi){
                                        $check = 'checked';
                                        break;
                                    }else{
                                        $check ='';
                                    }
                                }
                                echo '<span  style="padding-right:20px">'.$sbi.'&nbsp;<input type="checkbox" style="" '.$check.'></span>';
                            }
                            ?></p>
                        <p style="margin: 7px !important;" >Number Of Days of Travel: <span style="border: 1px solid #ddd;padding-right: 70px;padding-left: 3px">{{$print_data->travel_total_days}}</span></p>
                        <p></p>
                        <p></p>
                        <p></p>
                        <p></p>
                    </td>
                    <td style="font-size: 12px;padding: 5px; height: 600px !important;" width="33%">
                        <p style="text-align: justify; font-size: 11px !important;margin: 0px !important; color:#000 !important;">
                            Please Sign This Authorization
                        </p>
                        <p style="text-align: justify; font-size: 11px !important;margin: 0px !important; line-height: 1.1em;">

                            I hereby apply for the issue of a SBI Travel Card to me and declare  that the information included in the application is true and correct and that I am a resident Bangladeshi/foreign national residing in Bangladesh/Non Resident Bangladeshi and that I am eligibility to apply for an internationally valid card. I accept that State Bank of India is entitled in its absolute discretion to accept or reject this application without assigning any reason what so ever. It is my responsibility to obtain the terms and conditions applying to the SBI Travel Card as may be in force from time to time and use of the Card shall be deemed to be acceptance of those terms and conditions. I authorize State Bank of India to verify any information or otherwise at my office/residence or to contact me/my employer/ Banker/Credit Bureau/Bangladesh Bank or any other source to obtain or provide any information that may be required for confirming eligility for issue of issue of SBI Travel Card. I understand and acknowledge the local laws and Bangladesh Bank regulations, laid down norms and limits for the purchase and use of foreign exchange. I undertake that the usage of the SBI Travel Card by me will be in accordance with the Exchange Control Regulations of the Bangladesh Bank and the applicable laws in force from time to time. In the event of any failure on my part to do so or in the event of any information supplied by us/me being incorrect or inaccurate. I agree that I will be solely liable for any/all penalties and/or action under the local laws and/or regualtions as may be in force, governing purchase and the use of the SBI Travel Card.

                        </p>
                        <p style="padding-top: 10px">x
                        <hr style="padding: 0px 0px 0px 0px; width: 50% !important;margin: 0px;line-height:0.5em;"> Signature of applicant
                        </p>
                        <p style="margin: 0px !important;line-height: 1em" >Place: <span style="border: 1px solid #ddd;padding-right: 100px;padding-left: 3px"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <span>Date:<span style="border: 1px solid #ddd;padding-right: 10px;padding-left: 4px"> <?php echo date('d-m-Y', strtotime($print_data->created_date)); ?> </span></span></p>

                        <p style="margin: 0px !important;">
                        <center><span style="color:#000 !important;padding-top: 3px;">FOR OFFICE USE ONLY</span></center>
                        </p>
                        <p style="margin: 0px !important;color:#000 !important;" >Documents Submitted </p>
                        <p style="margin: 0px !important;line-height: 1em" >1. Please ensure you have verified the following documents: </p>
                        <p style="margin: 0px !important;line-height: 1em" >i. Form  &nbsp; ii. Copy of Passport </p>
                        <p style="margin: 0px !important;line-height: 1em;" >Verified the application and the relative documents <input type="checkbox"> </p>
                        <?php if (isset($image->manager_signature) && !empty($image->manager_signature)){ ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="{{asset('public/uploads/').'/'.$image->manager_signature}}" height="40px" width="140px">
                    <?php } ?>
                        <br>
                        Signature of the Authorized official
                        </p>
                        <p style="margin: 0px !important;line-height: 1em;">2. Details of the Application form uploaded in the Card Management System.</p>
                        <p style="margin: 0px !important;">3. Travel Card Welcome Pack</p>
                        <p style="margin: 0px !important;">Ref.No:<span style="border: 1px solid #ddd;padding-right: 9px;"></span><span style="border: 1px solid #ddd;padding-right: 9px;"></span><span style="border: 1px solid #ddd;padding-right: 9px;"></span><span style="border: 1px solid #ddd;padding-right: 9px;"></span><span style="border: 1px solid #ddd;padding-right: 9px;"></span><span style="border: 1px solid #ddd;padding-right: 9px;"></span><span style="border: 1px solid #ddd;padding-right: 9px;"></span><span style="border: 1px solid #ddd;padding-right: 9px;"></span><span style="border: 1px solid #ddd;padding-right: 9px;"></span><span style="border: 1px solid #ddd;padding-right: 9px;"></span><span style="border: 1px solid #ddd;padding-right: 9px;"></span><span style="border: 1px solid #ddd;padding-right: 9px;"></span><span style="border: 1px solid #ddd;padding-right: 9px;"></span><span style="border: 1px solid #ddd;padding-right: 9px;"></span><span style="border: 1px solid #ddd;padding-right: 9px;"></span><span style="border: 1px solid #ddd;padding-right: 9px;"></span><span style="border: 1px solid #ddd;padding-right: 9px;"></span><span style="border: 1px solid #ddd;padding-right: 9px;"></span><span style="border: 1px solid #ddd;padding-right: 9px;"></span><span style="border: 1px solid #ddd;padding-right: 9px;"></span><span style="border: 1px solid #ddd;padding-right: 9px;"></span><span style="border: 1px solid #ddd;padding-right: 9px;"></span><span style="border: 1px solid #ddd;padding-right: 9px;"></span><span style="border: 1px solid #ddd;padding-right: 9px;"></span>
                        </p>
                        <p style="margin: 0px !important;padding-top:10px" >Signature of the authorized official   &nbsp;&nbsp;-----------------------------</p>
                        <p style="margin: 0px !important;padding: 0px;" ><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>Date:<span style="border: 1px solid #ddd;padding-right: 10px;padding-left: 4px"><?php echo date('d-m-Y', strtotime($print_data->created_date)); ?> </span></p>
                        <p style="margin: 2px !important;line-height: 1em;">Receive the Travel Card Welcome Pack mentioned above.</p>
                        <p style="margin: 0px !important;" >Signature Of Applicant   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;X-------------------------------------------</p>
                        <p style="margin: 0px !important;padding: 0px;line-height: 1em" ><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>Date:<span style="border: 1px solid #ddd;padding-right: 10px;padding-left: 4px"><?php echo date('d-m-Y', strtotime($print_data->created_date)); ?> </span></p>
                    </td>
                    <td style="font-size: 13px;padding: 5px;" width="33%">
                        <img src="{{asset('public/assets/img/SBI.png')}}" style="width: 300px; height: 670px; !important">
                    </td>

                </tr>
                </tbody>
            </table>
        </table>
        <table width="100%">
            <table width="100%">
                <tbody>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td style="font-size: 11px;padding: 5px;line-height: 1em" width="33%">
                        <p style="margin: 0px !important;" class="text-center"><span class="textcolor" style="color:#000 !important;font-weight: bold;">STATE BANK OF INDIA TRAVEL CARD</span></p>
                        <p style="margin: 0px !important;" class="text-center" ><span style="color:#903235 !important;font-weight: bold;">JUST RIGHT FOR HOLIDAY MAKERS!</span></p>
                        <p style="margin: 0px !important;" class="text-center"><span style="color:#903235 !important;font-weight: bold;">PERFECT FOR STUDENTS!!</span></p>
                        <p style="margin: 0px !important;" class="text-center"><span style="color:#903235 !important;font-weight: bold;">IDEAL FOR BUSINESS TRAVELLERS!!!</span></p>
                        <p style="margin: 0px !important;text-align: justify">State Bank of India Travel Card is a Prepaid Foreign Currency Card that makes your foreign trip convenient and allows you to enjoy your trip abroad on Business/Leisure/ Studies/ or Others. The Card has been designed with several unique features embedded in it which keeps you away from worries of carrying wallet full of Foreign Currency Travelers Cheques/notes of various denominations or hopping from money changer to money changer.
                        </p>
                        <p style="color:#000 !important;line-height: 1em;font-weight: bold;">STATE BANK OF INDIA TRAVEL CARD</p>
                        <p style="margin: 0px !important;">• VISA Prepaid Card denominated in US Dollar can be used anywhere in the world except Bangladesh & Israel.</p>
                        <p style="margin: 0px !important;">• Corporates can purchase the Card for their employees going abroad.</p>
                        <p style="margin: 0px !important;">• Beneficial to the parents whose children go abroad for studies.</p>
                        <p style="margin: 0px !important;">• Card can be reloaded any number of times in person/ by authorized to issue the Travel Card.</p>
                        <p style="margin: 0px !important;">• Minimum purchase value USD 150.</p>
                        <p style="margin: 0px !important;">• Minimum reload value 50.</p>
                        <p style="margin: 0px !important;">• Maximum purchase value USD 5000 for visits to SAARC countries and USD 7000 for visits to other countries.</p>
                        <p style="margin: 0px !important;">• Maximum Daily cash withdrawal at ATM is USD 500.</p>
                        <p style="margin: 0px !important;color:#000 !important;font-weight: bold;">CONVENIENCE</p>
                        <p style="margin: 0px !important;">• The Card can be used for withdrawals at ATMs, making payments at Merchant Establishments (POS) and e-Commerce transactions.</p>
                        <p style="margin: 0px !important;">• Balance enquiry through ATMs (VISA) throughout the world.</p>
                        <p style="margin: 0px !important;">• Balance enquiry and view / Download details of transactions through online.</p>
                        <p style="margin: 0px !important;">• Available at all Branches of SBI Bangladesh (Dhaka, Gulshan, Chittagong, Sylhet, Rajshahi & Khulna)</p>
                        <p style="margin: 0px !important;">• ATM PIN, and IVR based resetting of PIN in English.</p>
                        <p style="margin: 0px !important;color:#000 !important;font-weight: bold;">SECURITY</p>
                        <p style="margin: 0px !important;">• Secured by 4-digit PIN at ATMs and by signature / IPIN at Point of Sales (POS).</p>
                        <p style="margin: 0px !important;">• 24 hours helpline services across the globe in case of loss/misplacement/theft of the card for hot listing (blocking).</p>
                        <p style="margin: 0px !important;">• SMS message on your mobile for card activation/all loads/reloads/transactions on the card.</p>
                        <p style="margin: 0px !important;color:#000 !important;font-weight: bold;">SURRENDER OF CARD</p>
                        <p style="margin: 0px !important;">On return from your trip to abroad, you have following options:</p>
                        <p style="margin: 0px !important;">• Claim the balance amount in the Card for cash payment or by credit to your account as per Bangladesh Bank guidelines from any branch authorized to issue the Card.</p>
                        <p style="margin: 0px !important;">• Choose to retain the balance up to the permissible limit, in case you are planning for another trip abroad in the near future.</p>
                        <p style="margin: 0px !important;">• In case you choose to retain the Card with balance within the permissible limits, you may simply reload the Card with additional amount, at the time of next visit abroad, by submitting the reload application. Unspent amount in the Card in excess of USD 5000 brought back to Bangladesh shall be encased within 30 days from the date of return or utilised for the subsequent visit abroad, by submitting the reload application. Unspent amount in the Card in excess of USD 5000 brought back to Bangladesh shall be encased within 30 days from the date of return or utilised for the subsequent visit abroad within a period of 30 days from the date of return.</p>
                    </td>
                    <td style="font-size: 12px; padding: 5px;"  width="33%">
                        <p style="margin: 5px !important; " class="text-right">Date:<span style="border: 1px solid #ddd;padding-right: 0px;padding-left: 3px;"><?php echo date('d-m-Y', strtotime($print_data->created_date)) ?></span></p>
                        <p style="margin: 0px !important;" class="text-center"><span style="color:#000 !important;font-weight: bold;font-size: 12px">APPLICATION FOR STATE BANK OF INDIA TRAVEL CARD</span></p>
                        <p style="margin: 3px !important;" >Branch Name: <span style="border: 1px solid #ddd;padding-right: 100px;padding-left: 3px">{{$print_data->branch_name}}</span></p>
                        <p style="margin: 3px !important;" >Branch Code: <span style="border: 1px solid #ddd;padding-right: 100px;padding-left: 3px">{{$print_data->branch_code}}</span></p>
                        <p style="margin: 4px !important;" >URN Number: <span style="border: 1px solid #ddd;padding-right: 0px;padding-left: 3px;"><?php echo $print_data->urn ?></span><span style="float: right">Card Number: <span style="border: 1px solid #ddd;padding-right: 0px;padding-left: 3px;"><?php $t_number = array_map('intval', str_split($print_data->digit)); $arr_count = count($t_number); echo '********'.$t_number[$arr_count-4].$t_number[$arr_count-3].$t_number[$arr_count-2].$t_number[$arr_count-1]; ?></span></p>
                        <p style="margin: 5px !important;" ><span style="color:#000 !important;">Transaction Details: &nbsp; Currency: </span><span style="border: 1px solid #ddd;padding-right: 120px;padding-left: 3px;">{{$print_data->c_type}}</span></p>
                        <p style="margin: 4px !important;" >Amount in Foreign Currency: <span style="border: 1px solid #ddd;padding-right: 60px;padding-left: 3px;float:right">{{$print_data->f_currency}}</span></p>
                        <p style="margin: 4px !important;" >Amount in BDT: <span style="border: 1px solid #ddd;padding-right: 60px;padding-left: 3px;float:right">{{$print_data->amount_bdt}}</span></p>
                        <p style="margin: 3px !important;color:#000 !important;line-height:0.9em;" >Personal Information </p>
                        <p style="margin: 4px !important;" >Name of the Applicant:<div  width="30px" style="border: 1px solid #ddd;padding-left: 3px;"><span >{{$print_data->a_name}}</span></div> </p>
                        <p style="margin: 3px !important;line-height: 0.9em" >Current Address of the Applicant: </p>
                        <p>
                        <div style="border: 1px solid #ddd;width:100%;padding-left: 3px;min-height: 20px">{{$print_data->current_address}}</div>
                        </p>
                        <p style="margin: 3px !important;" >Phone:<span style="border: 1px solid #ddd;padding-right: 20px;padding-left: 3px;"> {{$print_data->a_phone}}</span><span style="float: right;">Mobile Number:<span style="border: 1px solid #ddd;padding-right: 20px;padding-left: 3px;">{{$print_data->a_mobile}}</span> </span></p>
                        <p style="margin: 3px !important;" >Email ID: <span style="border: 1px solid #ddd;padding-right: 20px;padding-left: 3px;">{{$print_data->a_email}}</span> <span style=""> &nbsp; Gender:

                                <?php
                                if($print_data->gender = "Male"){
                                    echo 'Male <input type="checkbox" checked> &nbsp;&nbsp;Female <input type="checkbox" >';
                                }else if($print_data->gender = "Female"){
                                    echo 'Male <input type="checkbox"> &nbsp;&nbsp;Female <input type="checkbox" checked>';
                                }

                                ?></span></p>
                        <p style="margin: 3px !important;line-height: 1em" >Your Prepaid Card Statement will be sent on the above Email ID.</p>
                        <p style="margin: 4px !important;line-height:1em;color:#000 !important;" >Security Details</p>
                        <p style="margin: 4px !important;" >Mother's Maiden Name: <span style="border: 1px solid #ddd;padding-right: 20px;padding-left: 3px;">{{$print_data->a_maiden_name}}</span></p>
                        <p style="margin: 4px !important;" >Date of Birth of the Applicant: <span style="border: 1px solid #ddd;padding-right: 20px;padding-left: 3px;"><?php if($print_data->a_birth != 000-00-00){ echo date('d-m-Y', strtotime($print_data->a_birth)); }  ?></span></p>
                        <p style="margin: 4px !important;" >Passport Number: <span style="border: 1px solid #ddd;padding-right: 20px;padding-left: 3px;">{{$print_data->passport_no}}</span> </p>
                        <p style="margin: 4px !important;"><span >Place of Issue:<span style="border: 1px solid #ddd;padding-right: 20px;padding-left: 1px;">{{$print_data->place_of_issue}}</span></span></p>
                        <p style="margin: 4px !important;" >Date of Issue: <span style="border: 1px solid #ddd;padding-right: 0px;padding-left: 3px;"><?php echo date('d-m-Y', strtotime($print_data->date_of_issue)) ?></span><span style="float: right">Expiry Date: <span style="border: 1px solid #ddd;padding-right: 0px;padding-left: 3px;"><?php echo date('d-m-Y', strtotime($print_data->expire_date)) ?></span></p>
                        <p style="margin: 4px !important;" >National ID No: <span style="border: 1px solid #ddd;padding-right: 30px;padding-left: 3px;">{{$print_data->a_nid}}</span></p>
                        <p style="margin: 3px !important;line-height: 0.9em;color:#000 !important;" >Emergency Details</p>
                        <p style="margin: 4px !important;" >Name of the Person to Contact: <span style="border: 1px solid #ddd;padding-right: 0px;padding-left: 3px;">{{$print_data->e_name}}</span></p>
                        <p style="margin: 4px !important;" >Relationship with the Applicant: <span style="border: 1px solid #ddd;padding-right: 20px;padding-left: 3px;">{{$print_data->e_relation}}</span></p>
                        <p style="margin: 4px !important;line-height: 1em"><span style="">Phone No: <span style="border: 1px solid #ddd;padding-right: 20px;padding-left: 3px;">{{$print_data->e_phone}}</span></span></p>
                        <p style="margin: 4px !important;line-height: 1em" >Address:
                        <div  style="border: 1px solid #ddd;padding-right: 0px;padding-left: 3px;">{{$print_data->e_address}}</div>
                        </p>
                        <p style="margin: 4px !important;line-height: 0.9em;color:#000 !important;" >Permanent Residential Address as appearing on the passport:
                        <div  style="border: 1px solid #ddd;padding-right: 0px;padding-left: 3px; min-height: 20px">
                            {{$print_data->e_permanent_address}}
                        </div>
                        </p>

                    </td>
                    <td style="font-size: 12px;padding: 5px;" width="33%">
                        <p ><sapn style="color:#000;font-weight: bold;">Registration Number: </sapn><span style="border: 2px solid #000;padding-right: 20px;padding-left: 3px;color:#000; font-weight: bold;"> {{$print_data->serial_number}}</span></p>
                        <p style="margin: 7px !important;" >City: <span style="border: 1px solid #ddd;padding-right: 20px;padding-left: 3px;">{{$print_data->e_city}}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>PIN: <span style="border: 1px solid #ddd;padding-right: 20px;padding-left: 3px;">{{$print_data->e_pin}}</span></span></p>
                        <p style="margin: 7px !important;" >Phone 1: <span style="border: 1px solid #ddd;padding-right: 20px;padding-left: 3px;">{{$print_data->e_phone1}}</span><span style="float: right">Phone 2: <span style="border: 1px solid #ddd;padding-right: 20px;padding-left: 3px;">{{$print_data->e_phone2}}</span></span></p>
                        <p style="margin: 7px !important;color:#000 !important;line-height: 1.5em;" >Business/Office Name & Address of the Card Holder (applicant):
                        <div width="100%" style="border: 1px solid #ddd;padding-right: 10px;padding-left: 3px;min-height: 20px">
                            {{$print_data->e_address_2}}
                        </div>
                        </p>
                        <p style="margin: 7px !important;" >City: <span style="border: 1px solid #ddd;padding-right: 20px;padding-left: 3px;">{{$print_data->e_city_2}}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>PIN: <span style="border: 1px solid #ddd;padding-right: 20px;padding-left: 3px;">{{$print_data->e_pin_2}}</span></span></p>
                        <p style="margin: 7px !important;" >Phone 1: <span style="border: 1px solid #ddd;padding-right: 20px;padding-left: 3px;">{{$print_data->e_phone_3}}</span><span style="float: right">Extn: <span style="border: 1px solid #ddd;padding-right: 20px;padding-left: 3px;">{{$print_data->e_phone_extn}}</span></span></p>
                        <p style="margin: 7px !important;color:#000 !important;line-height: 1.5em !important;" >Funding Details: </p>
                        <p style="margin: 7px !important;" >Cash Amount: <span style="border: 1px solid #ddd;padding-right: 20px;padding-left: 3px;">{{$print_data->cash_amount}}</span><span style="float: right"> Cheque Amount:<span style="border: 1px solid #ddd;padding-right: 20px;padding-left: 3px;">{{$print_data->cheque_amount}}</span></span></p>
                        <p style="margin: 7px !important;" >Debi SBI SB/CA Account No: <span style="border: 1px solid #ddd;padding-right: 0px;padding-left: 3px;">{{$print_data->sbl_ca_account_no}}</span><span style="float: right">Amount BDT: <span style="border: 1px solid #ddd;padding-right: 0px;padding-left: 3px;">{{$print_data->sbl_ca_amount}}</span></span></p>
                        <p style="margin: 7px !important; color:#000 !important;line-height: 1.5em !important;" >Personal Profile: </p>
                        <p style="margin: 7px !important;" >Nature of employment: </p>
                        <p style="margin: 7px !important;" >
                            <?php $type = explode(',',$print_data->employment_type);
                            $sArray = array('Self Employment','Salaried','Professional','Retired');
                            foreach($sArray as $sbi){
                                foreach ($type as $sbi_data){
                                    if ($sbi_data == $sbi){
                                        $check = 'checked';
                                        break;
                                    }else{
                                        $check ='';
                                    }
                                }
                                echo '<span  style="padding-right:10px">'.$sbi.'&nbsp;<input type="checkbox" style="" '.$check.'></span>';
                            }
                            ?>
                        </p>
                        <p style="margin: 7px !important;color:#000 !important;" >Professional Details/Employment:</p>
                        <p style="margin: 7px !important;" >
                            <?php $type = explode(',',$print_data->p_name);
                            $sArray = array('Information Technology','Government','Travel/Tourism','Small Scale Industry','Transport','Export/Import','Medical','Agriculture','Lawyer','Construction/Real estate','Others');
                            foreach($sArray as $sbi){
                                foreach ($type as $sbi_data){
                                    if ($sbi_data == $sbi){
                                        $check = 'checked';
                                        break;
                                    }else{
                                        $check ='';
                                    }
                                }
                                echo '<span  style="padding-right:20px">'.$sbi.'&nbsp;<input type="checkbox" style="" '.$check.'></span>';
                            }
                            ?>
                        </p>
                        <p style="margin: 7px !important;color:#000 !important;" >Please fill this section for Salaried Card Holder:</p>
                        <p style="margin: 7px !important;" >You Work for: &nbsp;&nbsp;
                            <?php $type = explode(',',$print_data->s_name);
                            $sArray = array('Govt.Dept.','Public Ltd. Co.','Private Ltd. Co.','Partnership/Proprietorship');
                            foreach($sArray as $sbi){
                                foreach ($type as $sbi_data){
                                    if ($sbi_data == $sbi){
                                        $check = 'checked';
                                        break;
                                    }else{
                                        $check ='';
                                    }
                                }
                                echo '<span  style="padding-right:20px">'.$sbi.'&nbsp;<input type="checkbox" style="" '.$check.'></span>';
                            }
                            ?>
                        </p>
                        <p style="margin: 7px !important;" >Name of the company: <span style="border: 1px solid #ddd;padding-right: 0px;padding-left: 3px;">{{$print_data->s_company}}</span></p>
                        <p style="margin: 7px !important;" >Current Designation: <span style="border: 1px solid #ddd;padding-right: 15px;padding-left: 3px;">{{$print_data->s_designation}}</span></p>
                        <p style="margin: 7px !important;">Years at Current Job:<span style="border: 1px solid #ddd;padding-right: 15px;padding-left: 3px;">{{$print_data->s_years}}</span></p>
                        <p></p>
                        <p></p>
                        <p></p>


                    </td>
                </tr>
                </tbody>
            </table>
        </table>
    </div>
    <script>
        function printDiv(pa) {
            var css = '@page { size: landscape; }',
                head = document.head || document.getElementsByTagName('head')[0],
                style = document.createElement('style');

            style.type = 'text/css';
            style.media = 'print';

            if (style.styleSheet){
                style.styleSheet.cssText = css;
            } else {
                style.appendChild(document.createTextNode(css));
            }

            head.appendChild(style);
            var printContents = document.getElementById(pa).innerHTML;
            document.body.innerHTML = printContents;
            window.print();
        }
    </script>
    <script>
        <?php if (isset($id)){ ?>
            window.onload = printDiv('printableArea');
        $(window).on('afterprint', function () {
            window.location.href="{{ url("/dollar_endorsement/m/$id") }}";
        });
        <?php } ?>
    </script>
    <script>
        $(window).on('afterprint', function () {
            window.location.reload(true);
        });
    </script>

    <script type="text/javascript">
        $(window).load(function() {
            //This execute when entire finished loaded
            window.print();
        });

    </script>


@endsection

