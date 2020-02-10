@php use \App\Http\Controllers\RappapController; @endphp
@extends('admin.master')
<!--Page Title-->
@section('page-title')
    R.A.P / P.A.P
@endsection
<!--Page Header-->
@section('page-header')
    R.A.P / P.A.P Application Form
@endsection

<!--Page Content Start Here-->
@section('page-content')
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <br>
                   <?php if (Session::has('message')) { ?>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3 alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                            </button>
                            <h4> {{ Session::get('message') }}</h4>
                        </div>
                    </div>
                  <?php } ?>

                <!-- Code Here.... -->
                    <div class="row"
                         style="margin-left: 0px !important;margin-right: 0px !important;padding-left: 15px; padding-right: 15px;height: 100%;">
                        <div class="main_part" style="padding-left: 20px; padding-right: 20px">
                            <div class="row">
                                <div class="col-md-12">
                                    <div style="color:#808080;font-size:20px;float:right;">Total
                                        Receive: @php echo RappapController::total_receive() @endphp </div>
                                    <br/></div>
                            </div>

                        <!-- /.row -->
                            {!! Form::open(['url' => "rap/pap/save",'id' => 'applicant_form', 'name' => 'form1']) !!}

                            <input type="hidden" name="stickerType" value={{$stype}}>
                            <input type="hidden" name="stickerfrom" value={{$sfrom}}>
                            <input type="hidden" name="stickerto" value={{$sto}}>

                            <input type="hidden" name="center_name" value="{{$center_name[0]->center_name}}">
                            <input type="hidden" name="region" value="{{$center_name[0]->region}}">

                            <input type="hidden" name="duplicate_visa" id="duplicate_visa">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <select class="form-control" name="stickerType" id="stickerType" required="required">
                                                    <option value="">--Sticker Type--</option>
                                                    <?php foreach ($sticker as $sticker_value){ ?>
                                                    <option <?php if($sticker_value->sticker=="$stype") { ?> selected="selected"
                                                            <?php } ?> value="{{$sticker_value->sticker}}">{{$sticker_value->sticker}}</option>
                                                    <?php }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group"><input class="form-control" id="fromstk" value="{{$sfrom}}" name="stickerfrom" placeholder="From" required="required" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                            </div>
                                        </div>
                                        <div class="col-sm-1" style="padding:0;text-align: center;">To</div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <input class="form-control" id="tostk" name="stickerto" value="{{$sto}}" placeholder="To" required="required" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-11"></div>
                                        <div class="col-md-1">
                                            <?php if($printid > 0) { ?>
                                            <button type="button" class="btn btn-primary pull-right" onclick="printDiv('printableArea')"
                                                    style="margin-right:10px;">Re-Print
                                            </button> <?php } ?>
                                        </div>
                                    </div>

                                    <div id="server-results">
                                        <div class="loader"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <input type="hidden" name="mpassport" id="mp4">
                                    <div class="form-group">
                                        <div class="routearea">
                                            <label>Entry Port</label>
                                            <div id="routeDiv">
                                                @foreach ($routes as $routes_value)
                                                    <ul class="list-group" style="margin:0;padding: 0;">
                                                        <li style="list-style-type:none;padding:0;margin:0;">
                                                            <label style="font-weight:normal;cursor: pointer;"><input type="checkbox" id="eport" name='eport' value="{{$routes_value->route_name}}"/>{{$routes_value->route_name}}
                                                            </label>
                                                        </li>
                                                    </ul>
                                                @endforeach
                                                <p class="routefield"></p>
                                                <input type="hidden" name="route" id="routefield">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="routearea">
                                        <div class="form-group">
                                            <label>Area</label>
                                            <div id="areaDiv">
                                                @foreach ($port as $port_value)
                                                    <ul class="list-group" style="margin:0;padding: 0;">
                                                        <li style="list-style-type:none;padding:0;margin:0;">
                                                            <label style="font-weight:normal;cursor: pointer;"> <input type="checkbox" id="areaport" name="areaport" value="{{$port_value->port_name}}"/> {{$port_value->port_name}}
                                                            </label>
                                                        </li>
                                                    </ul>
                                                @endforeach
                                                <p class="areafield"></p>
                                                <input type="hidden" name="port" id="areafield">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="routearea">
                                        <div class="form-group">
                                            <label>Exit Port</label>
                                            <div id="exitDiv">
                                                @foreach ($routes as $routes_value)
                                                    <ul class="list-group" style="margin:0;padding: 0;">
                                                        <li style="list-style-type:none;padding:0;margin:0;">
                                                            <label style="font-weight:normal;cursor: pointer;"> <input type="checkbox" id="exitport" name="exitport" value=" {{$routes_value->route_name}}"/> {{$routes_value->route_name}}
                                                            </label>
                                                        </li>
                                                    </ul>
                                                @endforeach
                                                <p class="exitfield"></p>
                                                <input type="hidden" name="exit_port" id="exitfield">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="routearea">
                                        <div class="form-group">
                                            <label>Mode</label>
                                            <div id="modeDiv">
                                                @foreach ($mode as $mode_value)
                                                    <ul class="list-group" style="margin:0;padding: 0;">
                                                        <li style="list-style-type:none;padding:0;margin:0;">
                                                            <label style="font-weight:normal;cursor: pointer;"> <input type="checkbox" id="modeid" name="mode" value="{{$mode_value->mode}}"/> {{$mode_value->mode}}
                                                            </label>
                                                        </li>
                                                    </ul>
                                                @endforeach
                                                <p class="modefield"></p>
                                                <input type="hidden" name="mode" id="modefield">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="form_date">Arrival Date:</label>
                                                <input type="text" class="form-control" name="arrivalDate" id="from_date"
                                                       onchange="mydate1();" required autocomplete="off" required="required">
                                                <span id="status_response" style="font-size: 12px;float: right;"></span>
                                            </div>
                                            {{--<b>Arrival Date</b> <br/>--}}
                                            {{--<input type="date" name="arrivalDate" id="dt" class="form-control margintop5" onchange="mydate1();" required="required"/>--}}
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="to_date">Departure Date:</label>
                                                <input type="text" class="form-control" name="derpartureDate" id="to_date" required
                                                       autocomplete="off" onchange="mydate2();">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div id="dTable">
                                <div class="control-group after-add-more margintop5" id="q1">
                                    <div class="row">
                                        <div class="col-md-2">

                                            <div style="float:left;width:100px;">
                                                <input type="text" id="v1" name="passportNo[]"
                                                                                         class="form-control mpass_val"crequired="required"cplaceholder="P.P. No"></div>
                                            <div style="float:right;width:42px;margin-top:5px;">
                                                <label style="font-weight:normal;">
                                                    <input type="radio" id="dnd" value="1" name="master_passport"> M.P
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-1" style="padding:0;">
                                            <input type="text" name="visa_no[]" required="required" class="form-control vsano"
                                                   placeholder="Visa No">
                                        </div>
                                        <div class="col-md-2">
                                            <div style="float:left;"><input type="text" required="required" style="width:70px;" name="stickerNo[]" class="form-control stck_no_chk" placeholder="Stic.No" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"></div>
                                            <div style="float:right;"><input style="width:70px;" type="text" name="fee[]"
                                                                             class="form-control"
                                                                             placeholder="Fee" value="{{$fee[0]->Svc_Fee}}"
                                                                             required="required">
                                            </div>
                                        </div>
                                        <div class="col-md-3" style="padding:0;">
                                            <div style="float:left;width:148px;">
                                                <label style="font-weight:normal;"></label>
                                                <input class="form-control" type="text" name="applicant_name[]"
                                                       placeholder="Applicant Name"
                                                       required="required">
                                            </div>
                                            <div style="float:right;width:105px;">
                                                <select class="form-control" name="designation[]" required="required">
                                                    <option value="">Des/Res</option>
                                                    @foreach ($designation as $desig_value)
                                                        <option value="{{$desig_value->designation}}">{{$desig_value->designation}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <select class="form-control" name="visaType[]">
                                                    <option value="">-- Visa Type --</option>
                                                    @foreach($visatype as $visatype_value)
                                                        <option <?php if($visatype_value->visa_type=='TOURIST') { ?> selected="selected"
                                                                <?php } ?>  value="{{$visatype_value->visa_type}}">{{$visatype_value->visa_type}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2" style="padding-left:0;"><input type="text" required="required"
                                                                                             name="contactNo[]"
                                                                                             class="form-control contact_valid"
                                                                                             placeholder="Contact No 10 Digit"></div>
                                    </div>
                                    <div class="row">
                                        <!--<div class="col-md-2"></div>-->
                                        <div class="col-sm-2" style="float:right;text-align: right;">
                                            <div class="input-group-btn">
                                                <button class="btn btn-success add-more" type="button" style="border-radius:4px;"><i
                                                            class="glyphicon glyphicon-plus"></i> Add
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="copy hide">
                                <div class="control-group input-group" id="temp"
                                     style="border-top:1px dashed #ccc;margin-top:15px;width: 100%;">
                                    <div class="row" style="margin-top:15px;">
                                        <div class="col-md-2">
                                            <div style="float:right;width:42px;margin-top:5px;"><label style="font-weight:normal;">
                                                    <input
                                                            type="radio" value="1" id="nID" name="master_passport" class="sRow">
                                                    M.P</label>
                                            </div>
                                            <div style="float:left;width:100px;"><input type="text" name="passportNo[]" id="nID2"
                                                                                         class="form-control mpass_val"
                                                                                         placeholder="P.P. No">
                                            </div>
                                        </div>
                                        <div class="col-md-1" style="padding:0;">
                                            <div class="form-group"><input type="text" id="vid" name="visa_no[]"
                                                                           class="form-control vsano"
                                                                           placeholder="Visa No"></div>
                                        </div>
                                        <div class="col-md-2">
                                            <div style="float:left;"><input type="text" id="stid" style="width:70px;" name="stickerNo[]"
                                                                            class="form-control stck_no_chk" placeholder="Stic.No">
                                            </div>
                                            <div style="float:right;"><input style="width:70px;" type="text" id="feeID" name="fee[]"
                                                                             value="{{$fee[0]->Svc_Fee}}" class="form-control"
                                                                             placeholder="Fee"></div>
                                        </div>
                                        <div class="col-md-3" style="padding:0;">

                                            <div style="float:left;width:148px;"><label style="font-weight:normal;"></label>
                                                <input class="form-control" type="text" id="appliD" name="applicant_name[]"
                                                       placeholder="Applicant Name">
                                            </div>
                                            <div style="float:right;width:105px;">
                                                <select class="form-control" id="desigId" name="designation[]">
                                                    <option value="">Des/Res</option>
                                                    @foreach ($designation as $desig_value)
                                                        <option value="{{$desig_value->designation}}">{{$desig_value->designation}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <select class="form-control" id="vtypeID" name="visaType[]">
                                                    <option value="">-- Visa Type --</option>
                                                    @foreach($visatype as $visatype_value)
                                                        <option <?php if($visatype_value->visa_type=='TOURIST') { ?> selected="selected"
                                                                <?php } ?>  value="{{$visatype_value->visa_type}}">{{$visatype_value->visa_type}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2" style="padding-left:0;"><input id="contID" type="text" name="contactNo[]"
                                                                                             class="form-control contact_valid"
                                                                                             placeholder="Contact No 10 Digit"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="input-group-btn" style="text-align: right;">
                                                <button class="btn btn-danger remove margintop15" type="button"
                                                        style="border-radius:4px;"><i
                                                            class="glyphicon glyphicon-remove"></i> Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row" style="margin-top:15px;">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <input type="text" name="reMarks" class="form-control" placeholder="Enter Remarks">
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="text-align:right;">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success">Submit</button>&nbsp;
                                    <button type="reset" class="btn btn-default">Reset</button>
                                </div>
                            </div>
                            {!! Form::close() !!}

                        <!-- Button trigger modal -->

                            <div class="modal fade" id="submit_confirm" tabindex="-1" role="dialog"
                                 aria-labelledby="submit_confirmTitle"
                                 aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="submit_confirmTitle">Passport Save Confirmation</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Are you Sure to Save this information ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" onclick="return my_save();" id="saveData">Save
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
@endsection
                        <!--Page Content End Here-->
                            <style>
                                /*Print Slip*/

                                @media print {

                                    .noprint {
                                        display: none;
                                    }

                                    #printableArea {
                                        display: block !important;
                                        font-size: 11px !important;

                                    }

                                    .topborder {
                                        width: 100%;
                                        border-top: 2px solid #000;
                                        margin: 5px 0;
                                    }

                                    .topmargin {
                                        margin-top: 0px;
                                    }

                                    .topmargin:first-child {
                                        margin-top: 0px;
                                    }

                                    .tclass {
                                        font-size: 11px !important;
                                    }

                                    .centerdiv {
                                        padding: 5px 0;
                                    }

                                    .centerdiv2 {
                                        margin-bottom: 5px;
                                    }

                                    table { /* Or specify a table class */
                                        overflow: hidden;
                                        page-break-after: always;
                                        font-size: 11px !important;

                                    }

                                }

                            </style>

                            <div id="printableArea" style="display: none;">
                                <?php if(!empty(RappapController::slip_print($printid))) {
                                    echo $printid;
                                    $data = RappapController::slip_print($printid);
                                    ?>
                                <?php foreach ($data as $val) { ?>

                                    <table border=0 width="100%" class="tclass" style="padding: 0">
                                        <tr>
                                            <td colspan=2 class="text-center"><strong>Indian Visa Application Center</strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan=2 class="text-center">
                                                <div class="centerdiv">{{$val->center_name}}</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan=2 class="text-center">
                                                <div class="centerdiv2">R.A.P./P.A.P. Application</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>@php echo $now = date('d-M-Y'); @endphp</td>
                                            <td><span class="pull-right">@php echo date("h:i:s A"); @endphp</span></td>
                                        </tr>
                                        <tr>
                                            <td colspan=2 style='margin: 105px 0'>
                                                <div class="topborder"></div>
                                                <strong>Name:</strong> {{ $val->applicant_name}} <br/>
                                                <strong>Contact:</strong> {{ $val->contact}} <br/>
                                                <strong>Passport:</strong> {{ $val->passport}} <br/>
                                                <strong>Visa No:</strong> {{ $val->visa_no}} <br/>
                                                <strong>Visa Type:</strong> {{ $val->visa_type}} <br/>
                                                <strong>Entry Port:</strong> {{ $val->OldPort}} <br/>
                                                <strong>Exit Port:</strong> {{ $val->NewPort}} <br/>
                                                <strong>Area:</strong> {{ $val->area}} <br/>
                                                <strong>Mode:</strong> {{ $val->mode}} <br/>
                                                <strong>Sticker:</strong> {{ $val->sticker}} <br/>
                                                <strong>Fee:</strong> {{ $val->Fee}} <br/>
                                                <strong>Info:</strong> {{$val->center_info}} <br/>
                                                <strong>Delivery on or
                                                    after:</strong> @php echo rappapController::delivery_date() @endphp {{$val->del_time}}

                                                <div class="topborder"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{$val->center_web}}</td>
                                            <td><span class="pull-right">EasyQ</span></td>
                                        </tr>
                                    </table>

                                    <table border=0 width="100%" class="tclass" style="padding: 0">
                                        <tr>
                                            <td colspan=2 class="text-center"><strong>Indian Visa Application Center</strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan=2 class="text-center">
                                                <div class="centerdiv">{{$val->center_name}}</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan=2 class="text-center">
                                                <div class="centerdiv2">R.A.P./P.A.P. Application</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>@php echo $now = date('d-M-Y'); @endphp</td>
                                            <td><span class="pull-right">@php echo date("h:i:s A"); @endphp</span></td>
                                        </tr>
                                        <tr>
                                            <td colspan=2 style='margin: 105px 0'>
                                                <div class="topborder"></div>
                                                <strong>Name:</strong> {{ $val->applicant_name}} <br/>
                                                <strong>Contact:</strong> {{ $val->contact}} <br/>
                                                <strong>Passport:</strong> {{ $val->passport}} <br/>
                                                <strong>Visa No:</strong> {{ $val->visa_no}} <br/>
                                                <strong>Visa Type:</strong> {{ $val->visa_type}} <br/>
                                                <strong>Entry Port:</strong> {{ $val->OldPort}} <br/>
                                                <strong>Exit Port:</strong> {{ $val->NewPort}} <br/>
                                                <strong>Area:</strong> {{ $val->area}} <br/>
                                                <strong>Mode:</strong> {{ $val->mode}} <br/>
                                                <strong>Sticker:</strong> {{ $val->sticker}} <br/>
                                                <strong>Fee:</strong> {{ $val->Fee}} <br/>
                                                <strong>Info:</strong> {{$val->center_info}} <br/>
                                                <strong>Delivery on or
                                                    after:</strong> @php echo rappapController::delivery_date() @endphp {{$val->del_time}}

                                                <div class="topborder"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{$val->center_web}}</td>
                                            <td><span class="pull-right">EasyQ</span></td>
                                        </tr>
                                    </table>


                                <?php } } ?>
                            </div>


                            <!--<iframe id="printf" style="display: block;"></iframe>-->
@section('page-script')


                                <script type="text/javascript">


                                    /////Form submit from modal popup
                                    function my_save() {
                                        document.getElementById("applicant_form").submit();
                                    }

                                    function printDiv(pa) {
                                        // document.getElementById("printableArea").style.display = "block";

                                        var printContents = document.getElementById(pa).innerHTML;
                                        // var originalContents = document.body.innerHTML;

                                        document.body.innerHTML = printContents;

                                        window.print();

                                        // document.body.innerHTML = originalContents;
                                    }

                                    <?php if($printid != 'm') { ?>
                                        window.onload = printDiv('printableArea');

                                    <?php } ?>


                                    function mydate1() {
                                        d = new Date(document.getElementById("dt").value);
                                        dt = d.getDate();
                                        mn = d.getMonth();
                                        mn++;
                                        yy = d.getFullYear();
                                        document.getElementById("ndt").value = dt + "/" + mn + "/" + yy
                                        document.getElementById("ndt").hidden = false;
                                        document.getElementById("dt").hidden = true;
                                    }

                                    function mydate2() {
                                        d = new Date(document.getElementById("dt").value);
                                        dt = d.getDate();
                                        mn = d.getMonth();
                                        mn++;
                                        yy = d.getFullYear();
                                        document.getElementById("ndt").value = dt + "/" + mn + "/" + yy
                                        document.getElementById("ndt").hidden = false;
                                        document.getElementById("dt").hidden = true;
                                    }

                                    //////////////VALIDATION FORM
                                    function stickerFunction() {

                                        var from = document.getElementById('fromstk').value;
                                        var to = document.getElementById('tostk').value;
                                        var val = document.getElementById('v2').value;
                                        if (val < from) {
                                            alert("cannot be smaller from range");
                                            return false;
                                        } else if (val > to) {
                                            alert("cannot be greater than max range");
                                            return false;
                                        }
                                    }

                                    //////////////VALIDATION FORM


                                    $(document).ready(function () {
                                        $(".alert").fadeOut(3500);
//$("input").prop('required',true)
///Using for multi select value for routes

//Displying Route Names


                                        function updateRoutechk() {
                                            var allVals = [];
                                            $('#routeDiv :checked').each(function () {
                                                allVals.push($(this).val());
                                            });
                                            var a = allVals.join(", ");
                                            $(".routefield").html(a);
                                            $("#routefield").val(a);
                                        }

                                        $(function () {
                                            $('#routeDiv input').click(updateRoutechk);
                                            updateRoutechk();
                                        });

                                        function updateAreachk() {
                                            var allVals = [];
                                            $('#areaDiv :checked').each(function () {
                                                allVals.push($(this).val());
                                            });
                                            var a = allVals.join(" ");
                                            $(".areafield").html(a);
                                            $("#areafield").val(a);
                                        }

                                        $(function () {
                                            $('#areaDiv input').click(updateAreachk);
                                            updateAreachk();
                                        });

                                        function updateExitchk() {
                                            var allVals = [];
                                            $('#exitDiv :checked').each(function () {
                                                allVals.push($(this).val());
                                            });
                                            var a = allVals.join(", ");
                                            $(".exitfield").html(a);
                                            $("#exitfield").val(a);
                                        }

                                        $(function () {
                                            $('#exitDiv input').click(updateExitchk);
                                            updateExitchk();
                                        })

                                        function updateModechk() {
                                            var allVals = [];
                                            $('#modeDiv :checked').each(function () {
                                                allVals.push($(this).val());
                                            });
                                            var a = allVals.join(", ");
                                            $(".modefield").html(a);
                                            $("#modefield").val(a);
                                        }

                                        $(function () {
                                            $('#modeDiv input').click(updateModechk);
                                            updateModechk();
                                        });
//Displying Port Names


                                        /*Key Press Delay Function Start*/
                                        var delay = (function () {
                                            var timer = 0;
                                            return function (callback, ms) {
                                                clearTimeout(timer);
                                                timer = setTimeout(callback, ms);
                                            };
                                        })();
                                        /*Key Press Delay Function End*/

///Using for duplicate value in array

                                        function checkValue(arr) {


                                            var reportRecipients = arr;
                                            //alert(arr);

                                            var recipientsArray = reportRecipients.sort();

                                            var reportRecipientsDuplicate = [];
                                            for (var i = 0; i < recipientsArray.length - 1; i++) {
                                                if (recipientsArray[i + 1] == recipientsArray[i]) {
                                                    reportRecipientsDuplicate.push(recipientsArray[i]);
                                                }
                                            }
//if(reportRecipientsDuplicate>0)
                                            return reportRecipientsDuplicate;
                                        }

                                        function itemremove(inputarra, inputvalue) {
                                            arr = inputarra; // array inicial
                                            var removeItem = inputvalue;   // item do array que deverÃƒÂ¡ ser removido

                                            arr = jQuery.grep(arr, function (value) {
                                                return value != removeItem;
                                            });
                                            return arr;
                                        }

                                        /*Contact No Validation Start here*/
                                        function validate_Phone_Number(getinput) {

                                            var contact_number = getinput;
                                            for (var i = 0; i < contact_number.length; i++) {

                                                var reqularExp = /^[0][1-9]\d{9}$|^[1-9]\d{9}$/g;

                                                var cont = contact_number[i];

                                                var matchval = cont.match(reqularExp);
                                            }
                                            return matchval;
                                        }

                                        /*Contact No Validation End here*/

/// //////////////Checking Master Passport Duplicate in Group End/////////////////////


/// //////////////Checking Visa No Duplicate Start/////////////////////

                                        $.ajaxSetup({
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            }
                                        });
                                        var ajaxResult = [];

                                        $('#applicant_form').on('keyup', '.vsano', function () {

                                            var visano_val = $(this).val();

                                            delay(function () {

                                                $.post("{{ url('rappap/visano_duplicate_check') }}", {input_value: visano_val}, function (result) {

                                                    var obj = jQuery.parseJSON(result);

                                                    if (obj.flg == 1) {
                                                        ajaxResult.push(obj.flg);

                                                        alert('Visa No: ' + obj.existVal + '. Already Exist. Try Another One!');
                                                        $("#duplicate_visa").val('Invalid');

                                                    } else {

                                                        $("#duplicate_visa").val('Valid');

                                                        ajaxResult.pop();
                                                    }

                                                });

                                            }, 1000);

                                        });

/// //////////////Checking Visa No Duplicate End/////////////////////

/// //////////////Checking Range From To For Sticker Start/////////////////////

// $('.stck_no_chk').prop('disabled', true);

//     $('#applicant_form').on('keyup', '#fromstk', function(){

//       delay(function(){

//     var fromsti  = parseInt($("#fromstk").val());
//     var tosti    = parseInt($("#tostk").val());

//     if((fromsti >0) && (tosti >0))
//     {

// $('.stck_no_chk').prop('disabled', false);

//     }

//  }, 1000 );
// });

//       $('#applicant_form').on('keyup', '#tostk', function(){

//     var fromsti  = parseInt($("#fromstk").val());
//     var tosti    = parseInt($("#tostk").val());

//     delay(function(){

//     if((fromsti >0) && (tosti >0))
//     {

//        $('.stck_no_chk').prop('disabled', false);

//     }
//  }, 1000 );

// });

                                        var storeVal1 = [];

                                        $('#applicant_form').on('keyup', '.stck_no_chk', function () {

                                            var stck_val = parseInt($(this).val());
                                            var fromsti = parseInt($("#fromstk").val());
                                            var tosti = parseInt($("#tostk").val());


                                            delay(function () {

                                                if (stck_val > 0) {
                                                    storeVal1.push(stck_val);

                                                } else
                                                    storeVal1.pop();
                                                /********Content Start Under Keyup Delay Function ***********/

                                                if (stck_val < fromsti) {
                                                    alert('Cannot be smaller than <  ' + fromsti);
                                                    return false;
                                                } else if (stck_val > tosti) {
                                                    alert('Cannot be greater than > ' + tosti);
                                                    return false;
                                                }

                                                // alert(storeVal1);
                                                if (storeVal1.length > 0) {

                                                    var a = checkValue(storeVal1);  // Returning Duplicate Value

                                                    //alert(a);
                                                    if (a > 0) {

                                                        var arraNew = itemremove(storeVal1, a);

                                                        alert("Duplicate Sticker not allowed");
                                                        return false;
                                                    } else
                                                        storeVal1 = arraNew.push(stck_val);
                                                }

                                            }, 1000);

                                            /********Content End Under Keyup Delay Function ***********/

                                        });
/// //////////////Checking Range From To For Sticker End/////////////////////


/////////////////////////////FORM SUBMIT////////////////////////////
                                        a = 1;

                                        $("#applicant_form").submit(function (event) {
                                            //event.preventDefault(); //prevent default action

                                            /*Duplicate check passport no start*/
                                            tpass = [];

                                            $(".mpass_val").each(function () {
                                                var value = $(this).val();
                                                tpass.push(value);
                                            });

                                            var passport_list = tpass.slice(0, -1);
                                            var duplicate_passport = checkValue(passport_list);

                                            if (duplicate_passport.length > 0) {
                                                alert('Passport Cannot be Duplicate: ' + duplicate_passport);
                                                return false;
                                            }

                                            /*Duplicate check passport no End*/

                                            /*Duplicate visa no Start*/
                                            tvisa = [];
                                            $(".vsano").each(function () {
                                                var value = $(this).val();
                                                tvisa.push(value);
                                            });
                                            var visa_list = tvisa.slice(0, -1);
                                            var duplicate_visa = checkValue(visa_list);

                                            if (duplicate_visa.length > 0) {
                                                alert('Visa No Cannot be Duplicate: ' + duplicate_visa);
                                                return false;
                                            }

                                            /*Duplicate visa no End*/

                                            /*Duplicate sticker no Start*/
                                            tsticker = [];
                                            $(".stck_no_chk").each(function () {
                                                var value = $(this).val();
                                                tsticker.push(value);
                                            });
                                            var sticker_list = tsticker.slice(0, -1);
                                            var duplicate_sticker = checkValue(sticker_list);

                                            if (duplicate_sticker.length > 0) {
                                                alert('Sticker No Cannot be Duplicate: ' + duplicate_sticker);
                                                return false;
                                            }

                                            /*Duplicate sticker no End*/


                                            /*Contact No Validation Start*/
                                            contactNo = [];
                                            $(".contact_valid").each(function () {
                                                var value = $(this).val();
                                                contactNo.push(value);
                                            });

                                            var contact_list = contactNo.slice(0, -1);
                                            var contact = validate_Phone_Number(contact_list);

                                            if (!contact) {
                                                alert('Check your contact no');
                                                return false;
                                            }

// if(duplicate_sticker.length>0)
// {
//    alert('Sticker No Cannot be Duplicate: ' + duplicate_sticker);
//    return false;
// }
                                            /*Contact No Validation Start*/


                                            /*Passport No empty field validation start*/
// $("#v" + a).each(function(){

// var myval=$("#v" + a).val();
// if(myval==''){
//  alert('Passport No Cannot be empty');
//  return false;
// }
// });


                                            /*Passport No empty field validation start*/
                                            var breakOut1 = '';
                                            $("#v" + a).each(function () {

                                                var myval = $("#v" + a).val();
                                                if (myval == '') {
                                                    alert('Passport No Cannot be empty');
                                                    breakOut1 = true;
                                                    return false;
                                                }
                                            });

                                            if (breakOut1) {
                                                $("#v" + a).focus();
                                                breakOut1 = false;
                                                return false;
                                            }
                                            /*Passport No empty field validation end*/

                                            /*Visa No empty field validation start*/


                                            var breakOut2 = '';
                                            $("#vn" + a).each(function () {

                                                var myval = $("#vn" + a).val();
                                                if (myval == '') {
                                                    alert('Visa No Cannot be empty');
                                                    breakOut2 = true;
                                                    return false;
                                                }

                                            });
                                            if (breakOut2) {
                                                $("#vn" + a).focus();
                                                breakOut2 = false;
                                                return false;
                                            }
                                            /*Visa No empty field validation end*/

                                            /*Sticker No empty field validation start*/
                                            var breakOut3 = '';
                                            $("#stk" + a).each(function () {

                                                var myval = $("#stk" + a).val();
                                                if (myval == '') {
                                                    alert('Sticker No Cannot be empty');
                                                    breakOut3 = true;
                                                    return false;
                                                }

                                            });

                                            if (breakOut3) {
                                                $("#stk" + a).focus();
                                                breakOut3 = false;
                                                return false;
                                            }

                                            /*Sticker No empty field validation end*/

                                            /*Fee No empty field validation start*/
                                            var breakOut4 = '';
                                            $("#fid" + a).each(function () {

                                                var myval = $("#fid" + a).val();
                                                if (myval == '') {
                                                    alert('Fee Cannot be empty');
                                                    breakOut4 = true;
                                                    return false;
                                                }

                                            });
                                            if (breakOut4) {
                                                $("#fid" + a).focus();
                                                breakOut4 = false;
                                                return false;
                                            }

                                            /*Fee No empty field validation end*/


                                            /*Applicant name field validation start*/
                                            var breakOut5 = '';
                                            $("#apid" + a).each(function () {

                                                var myval = $("#apid" + a).val();
                                                if (myval == '') {
                                                    alert('Applicant name Cannot be empty');
                                                    breakOut5 = true;
                                                    return false;
                                                }

                                            });

                                            if (breakOut5) {
                                                $("#apid" + a).focus();
                                                breakOut5 = false;
                                                return false;
                                            }

                                            /*Applicant name field validation end*/

                                            /*Designation field validation start*/
                                            var breakOut6 = '';
                                            $("#dsid" + a).each(function () {

                                                var myval = $("#dsid" + a).val();
                                                if (myval == '') {
                                                    alert('Designation Cannot be empty');
                                                    breakOut6 = true;
                                                    return false;
                                                }

                                            });

                                            if (breakOut6) {
                                                $("#dsid" + a).focus();
                                                breakOut6 = false;
                                                return false;
                                            }

                                            /*Designation field validation end*/

                                            /*Visa type field validation start*/
                                            var breakOut7 = '';
                                            $("#vtid" + a).each(function () {

                                                var myval = $("#vtid" + a).val();
                                                if (myval == '') {
                                                    alert('Visa type Cannot be empty');
                                                    brkOueat7 = true;
                                                    return false;
                                                }

                                            });

                                            if (breakOut7) {
                                                $("#vtid" + a).focus();
                                                breakOut7 = false;
                                                return false;
                                            }

                                            /*Visa type field validation end*/

                                            /*Contact field validation start*/
                                            var breakOut8 = '';

                                            $("#cid" + a).each(function () {

                                                var myval = $("#cid" + a).val();
                                                if (myval == '') {
                                                    alert('Contact Field Cannot be empty');
                                                    brkOueat8 = true;
                                                    return false;
                                                }

                                            });
                                            if (breakOut8) {
                                                $("#cid" + a).focus();
                                                breakOut8 = false;
                                                return false;
                                            }

                                            /*Contact field validation end*/

                                            if ($('input[type=checkbox][name=eport]:checked').length == 0) {
                                                alert('Please select Entry Port');
                                                return false;
                                            }


                                            if ($('input[type=checkbox][name=areaport]:checked').length == 0) {
                                                alert('Please select Area');
                                                return false;
                                            }

                                            if ($('input[type=checkbox][name=exitport]:checked').length == 0) {
                                                alert('Please select Exit Port');

                                                return false;
                                            }
                                            if ($('input[type=checkbox][name=mode]:checked').length == 0) {
                                                alert('Please select Mode');

                                                return false;
                                            }


                                            if ($('input[type=radio][name=master_passport]:checked').length == 0) {
                                                alert("Please select M.P (Master Passport)");

                                                return false;
                                            }

                                            // if ($("#mp4").val() == '') {
                                            //     alert("Please select M.P (Master Passport)");
                                            //
                                            //     return false;
                                            // }

                                            if (ajaxResult.length > 0) {
                                                alert("Visa No Cannot be Duplicate.");

                                                return false;
                                            }

                                            //  if(storeVal1.length>0)
                                            // {
                                            //   alert("Sticker Number Not in Range.");

                                            //    return false;
                                            // }

                                            //alert(inputvalueTake());

                                            $("#submit_confirm").modal('show');

                                            return false;

                                            // $("#saveData").click(function(){
                                            //     return true;
                                            //    });


                                            // var post_url = $(this).attr("action"); //get form action url

                                            //var post_url = 'http://localhost/pts/public/rap/pap/save';
                                            //var request_method = $(this).attr("method"); //get form GET/POST method

                                            // var form_data = $(this).serialize(); //Encode form elements for submission
                                            //alert(post_url);
                                            // $.ajax({
                                            //     url : post_url,
                                            //     type: request_method,
                                            //     data : form_data
                                            // }).done(function(response){ //
                                            //     $("#server-results").html(response);
                                            // $(".input-group").hide();
                                            //$('#yellow-box').hide();
                                            // $('#server-results').fadeOut('slow',0.5);
                                            // location.reload();
                                            //  $('yourdiv').find('form')[0].reset();
                                            //     $("#applicant_form")[0].reset();
                                            // });
                                        });
                                        //Form submit end


                                        var a = 1;

                                        $("body").on("click", '.sRow', function (e) {
                                            var rr = $(this).attr('id');
                                            var r = "#v" + rr;

                                            var fv = $(r).val();
                                            $("#mp4").val(fv);


                                        });


                                        $("#dnd").click(function () {
                                            var fv = $("#v1").val();

                                            $("#mp4").val(fv);


                                        });


                                        $(".add-more").click(function () {
//$(".input-group").show();
                                            a = a + 1;
//alert(a);
                                            var html = $(".copy").html();

                                            $(".after-add-more").append(html);

                                            var c = 'q' + a;
                                            // alert(c);

                                            $('#dTable #temp').attr('id', c);  //group row
                                            $('#dTable #nID').attr('id', a); // Radio button value set
                                            $('#dTable #nID2').attr('id', 'v' + a); //Master passport input field
                                            $('#dTable #vid').attr('id', 'vn' + a); //Visa no input field
                                            $('#dTable #stid').attr('id', 'stk' + a); //Visa no input field
                                            $('#dTable #feeID').attr('id', 'fid' + a); //Fee input field
                                            $('#dTable #appliD').attr('id', 'apid' + a); //Applicant name input field
                                            $('#dTable #desigId').attr('id', 'dsid' + a); //Applicant name input field
                                            $('#dTable #vtypeID').attr('id', 'vtid' + a); //Applicant name input field
                                            $('#dTable #contID').attr('id', 'cid' + a);  // Contact

                                        });


                                        $("body").on("click", ".remove", function () {

                                            $(this).parents(".input-group").remove();

                                        });


                                    });


                                    //Print Slip
                                    function printDiv(printableArea) {
                                        var printContents = document.getElementById(printableArea).innerHTML;
                                        var originalContents = document.body.innerHTML;

                                        document.body.innerHTML = printContents;

                                        window.print();

                                        document.body.innerHTML = originalContents;
                                    }


                                </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
