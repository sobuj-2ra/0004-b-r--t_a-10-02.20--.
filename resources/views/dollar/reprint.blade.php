@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Dollar Endorsement Reprint
@endsection

<!--Page Header-->
@section('page-header')
    Dollar Endorsement Reprint
@endsection

<!--Page Content Start Here-->
@section('page-content')
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                @if (Session::has('message'))
                    <div class="col-md-4 col-md-offset-4" style="padding-top:10px">
                        <div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4> {{ Session::get('message') }}</h4>
                        </div>
                    </div>
                @endif
                <div class="main_part">
                    <form action="{{url('reprint-dollar-endorsement')}}" method="get" role="search">
                        {{ csrf_field() }}
                        <div class="passport_search">
                            <input type="search" name="q" value="" placeholder="Passport Search">
                            <button type="submit" class="btn_search">Search</button>
                        </div>
                    </form>
                    <div class="result_body">
                        <div class="result_table">
                            <?php if (isset($print_data) && !empty($print_data)){ ?>
                                <button type="submit" id="rePrint" name="action" value="Re-Print" onclick="printDivForTravel('printable_for_travelcard')" class="btn_approved" style="padding: 3px !important;margin-left: 5px;width: 120px;">Travel Card</button></a>
                                <button type="submit" id="rePrint" name="action" value="Re-Print" onclick="printDiv('printableArea')" class="btn_approved" style="padding: 3px !important;margin-left: 5px;width: 120px;">TM Form Print</button>
                                <button type="submit" id="rePrint" name="action" value="Re-Print" onclick="printDivForVoucher('printableArea_for_vucher')" class="btn_approved" style="padding: 3px !important;margin-left: 5px;width: 120px;">Voucher Print</button>
                                <button type="submit" id="rePrint" name="action" value="Re-Print" onclick="printDivVoucher('printableArea_for_voucher')" class="btn_approved" style="padding: 3px !important;margin-left: 5px;width: 120px;">Receive Print</button></a>
                                <a href="{{URL::to('/dollar_endorsement/'.$print_data->id)}}" class="" style="float: right; padding-bottom: 5px"><button type="submit" id="rePrint" name="action" value="Re-Print" class="btn_approved" style="padding: 3px !important;margin-left: 5px;width: 120px;">All Print</button></a>

                                <table class="table table-bordered">
                                    <thead style="background:#ddd">
                                    <tr>
                                        <th>Name</th>
                                        <th>Passport</th>
                                        <th>Mobile</th>
                                        <th>Place of Issue</th>
                                        <th>Issue Date</th>
                                        <th>Expiry Date</th>
                                        <th>Address</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><?php echo $print_data->a_name ?></td>
                                        <td><?php echo $print_data->passport_no ?></td>
                                        <td><?php echo $print_data->a_mobile ?></td>
                                        <td><?php echo $print_data->place_of_issue ?></td>
                                        <td><?php echo date('d-m-Y', strtotime($print_data->date_of_issue)); ?></td>
                                        <td><?php echo date('d-m-Y', strtotime($print_data->expire_date)); ?></td>
                                        <td><?php echo $print_data->current_address ?></td>
                                    </tr>
                                    </tbody>
                                </table>
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
                                <div id="printable_for_travelcard" style="display: none;">

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
                                                    <p style="margin: 5px !important;" >Date of Travel: <span style="border: 1px solid #ddd;padding-right: 100px;padding-left: 3px"><?php if($print_data->travel_date != '0000-00-00'){ echo date('d-m-Y', strtotime($print_data->travel_date)); }  ?></span></p>
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
                                                    <hr style="padding: 0px 0px 0px 0px; width: 50% !important;margin: 0px;"> Signature of applicant
                                                    </p>
                                                    <p style="margin: 0px !important;" >Place: <span style="border: 1px solid #ddd;padding-right: 90px;padding-left: 3px"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Date:<span style="border: 1px solid #ddd;padding-right: 13px;"><?php echo date('d-m-Y', strtotime($print_data->created_date)); ?></span>
                            </span></p>

                                                    <p style="margin: 0px !important;"><center><span style="color:#000 !important;">FOR OFFICE USE ONLY</span></center></p>
                                                    <p style="margin: 0px !important;color:#000 !important;" >Documents Submitted </p>
                                                    <p style="margin: 0px !important;line-height: 1em" >1. Please ensure you have verified the following documents: </p>
                                                    <p style="margin: 0px !important;line-height: 1em" >i. Form  &nbsp; ii. Copy of Passport </p>
                                                    <p style="margin: 0px !important;line-height: 0.8em;" >Verified the application and the relative documents <input type="checkbox"> </p>
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
                                                    <p style="margin: 0px !important;padding-top: 7px" >Signature of the authorized official   &nbsp;&nbsp;-----------------------------</p>
                                                    <p style="margin: 0px !important;padding: 0px;" ><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>Date:<span style="border: 1px solid #ddd;padding-right: 10px;padding-left: 4px"><?php echo date('d-m-Y', strtotime($print_data->created_date)); ?></span></p>
                                                    <p style="margin: 2px !important;line-height: 1em;">Receive the Travel Card Welcome Pack mentioned above.</p>
                                                    <p style="margin: 0px !important;" >Signature Of Applicant   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;X-------------------------------------------</p>
                                                    <p style="margin: 0px !important;padding: 0px;line-height: 1em" ><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>Date:<span style="border: 1px solid #ddd;padding-right: 10px;padding-left: 4px"><?php echo date('d-m-Y', strtotime($print_data->created_date)); ?></span></p>
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
                                                    <p style="margin: 4px !important;" >Date of Birth of the Applicant: <span style="border: 1px solid #ddd;padding-right: 20px;padding-left: 3px;"><?php echo date('d-m-Y', strtotime($print_data->a_birth)) ?></span></p>
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
                                <div class="result_table" style="display: none;">
                                    <?php if (isset($print_data) && !empty($print_data)){ ?>
                                    <style>
                                        @media print {
                                            @page  layout{ size: portrait;
                                                size: A4;
                                                margin: 0px !important;
                                                padding: 0px !important;

                                            }
                                        }
                                    </style>
                                    <div id="printableArea">
                                        <div style="color: #0d406b !important;">
                                            <table width="100%">
                                                <tr style="font-size: 15px;color: #0d406b !important;">
                                                    <td style="width: 18%;border: 1px solid #0d406b;padding: 5px;font-size: 15px;color: #0d406b !important;">See Chapter 5</td>
                                                    <td style="width: 10%;padding: 5px;text-align: center;border-top: 1px solid #0d406b;border-right: 1px solid #0d406b;border-bottom: 1px solid #0d406b;color: #0d406b !important;">Para-2</td>
                                                    <td style="width: 52%;text-align: center;font-size: 14px;">
                                                        <p style="line-height: 1em;margin-bottom: 0px !important;color: #0d406b !important;">FORM TM</p><p style="line-height: 1em;margin-bottom: 0px !important;color: #0d406b !important;">Travel and Miscellaneous Purposes</p><p style="line-height: 1em;margin-bottom: 0px !important;color: #0d406b !important;">(other than import)</p>
                                                    </td>
                                                    <td style="width: 12%;color: #0d406b !important;border: 1px solid #0d406b;text-align: center;">APP. 5</td>
                                                    <td style="width: 8%;color: #0d406b !important;border-top: 1px solid #0d406b;border-right: 1px solid #0d406b;border-bottom: 1px solid #0d406b;text-align: center;">5</td>
                                                </tr>
                                            </table>
                                            <table width="100%">
                                                <tr>
                                                    <td style="width: 17%;color: #0d406b !important;">No: STB </td>
                                                    <td style="width: 65%;text-align: center;font-size: 16px;font-weight: bold;letter-spacing: 0.01em;line-height: 1em">
                                                        <p style="margin-bottom: 0px;color: #0d406b !important;padding-top: 10px;">APPLICATION FOR PERMISSION UNDER FOREIGN EXCHANGE</p>
                                                        <p style="margin-bottom: 0px;color: #0d406b !important;">REGULATION ACT TO PURCHASE FOREIGN EXCHANGE</p>
                                                        <p style="margin-bottom: 0px;color: #0d406b !important;">FOR THE PURPOSE SPECIFIED BELOW</p>
                                                    </td>
                                                    <td style="width: 18%;"></td>
                                                </tr>
                                            </table>
                                            <table>
                                                <tr>
                                                    <td style="color: #0d406b !important;line-height: 1em;">To</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: #0d406b !important;line-height: 1em;">The Manager</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: #0d406b !important;font-size: 16px; font-weight: bold;line-height: 1em;">STATE BANK OF INDIA</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: #0d406b !important;font-size: 12px;line-height: 1em;"><span style="color: #0d406b !important;font-weight: bold"><?php echo $print_data->branch_name; ?> Branch:</span> <?php if (isset($branch_address) && !empty($branch_address)) {
                                                        echo $branch_address->address;
                                                        } ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="color: #0d406b !important;font-size: 12px;padding-bottom: 5px;line-height: 1em;">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: #0d406b !important;">I/We wish to purchase/remit <span style="border-bottom: 1px solid #0d406b;padding-left: 10px;padding-right: 10px;color: #0d406b !important;"> USD <?php echo $print_data->f_currency.' (USD '. $amount.' Only)'; ?></span>
                                                        <p style="text-align: center;line-height: 1em;margin-bottom: 0px;color: #0d406b !important;font-size: 12px;">(Amount in figures and words stating currency)</p>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td style="color: #0d406b !important;line-height: 1em">for the under-mentioned purpose:</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: #0d406b !important;">I/We hereby declare that the statements made by me/us on this form are true and that I/we have not already obtained exchange nor have I/we made any other application for the purpose.</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: #0d406b !important;">*A. <i style="color: #0d406b !important;">For Travel Purposes:</i></td>
                                                </tr>
                                                <tr>
                                                    <td style="color: #0d406b !important;padding-left: 5px">I/We desire to travel to<span style="border-bottom: 1px dotted #0d406b !important; padding-left: 60px;padding-right: 60px; color: #0d406b !important;"> India </span> for the purpose of <span style="border-bottom: 1px dotted #0d406b;padding-right: 60px;padding-left: 60px; color: #0d406b !important;"> Tourism </span> </td>
                                                </tr>
                                                <tr>
                                                    <td style="color: #0d406b !important;padding-left: 10px">The journey will be undertaken by <span style="border-bottom: 1px dotted #0d406b !important;padding-left: 150px;padding-right: 150px; color: #0d406b !important;">Road/Air</span>
                                                        <p style="text-align: center;line-height: 1em;margin-bottom: 0px;color: #0d406b !important;font-size:12px">(Name of the Air/Shipping Company)</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="color: #0d406b !important;line-height: 1em;">My/Our passport Nos. date & Place of issue are given below:-</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: #0d406b !important;">(a) <?php echo $print_data->passport_no; ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="color: #0d406b !important;">(b) <?php echo date('d-m-Y', strtotime($print_data->date_of_issue)); ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="color: #0d406b !important;">(c) <?php echo $print_data->place_of_issue; ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="color: #0d406b !important;line-height: 1em;">*B. <i style="color: #0d406b !important;">for Miscellaneous purposes other than travel and import:</i></td>
                                                </tr>
                                                <tr>
                                                    <td style="color: #0d406b !important;">(a) Reason for payment .................................................................................</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: #0d406b !important;">(b) Name & address of beneficiary ................................................................</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: #0d406b !important;">(c) Country receiving payment ......................................................................</td>
                                                </tr>

                                                <tr>
                                                    <td style="float: right;color: #0d406b !important;">___________________________</td>
                                                </tr>
                                                <tr>
                                                    <td style="float: right;color: #0d406b !important;border-bottom: 1px solid #0d406b;padding-left: 30px;padding-right: 30px;"><?php echo $print_data->a_name; ?></td>
                                                </tr>
                                                <?php if (isset($print_data->current_address) && !empty($print_data->current_address)){ ?>
                                                <tr>
                                                    <td style="float: right;color: #0d406b !important;border-bottom: 1px solid #0d406b;padding-left: 10px;padding-right: 10px;"><?php echo $print_data->current_address; ?></td>
                                                </tr>
                                                <?php }else{ ?>
                                                <tr>
                                                    <td style="float: right;color: #0d406b !important;padding-left: 10px;">____________________________</td>
                                                </tr>
                                                <?php } ?>

                                                <tr>
                                                    <td style="float: right;color: #0d406b !important;"><i style="color: #0d406b !important;">Signature, Name and Address</i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td style="float: right;color: #0d406b !important;"><i style="color: #0d406b !important;">of the Applicant</i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: #0d406b !important;text-align: center;font-size: 15px; font-weight: bold">Declaration to be signed by the traveller/remitter.</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: #0d406b !important;">(a) That I/we recognize that in the event of any misrepresentation or suppression of any material fact. I/we shall be  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  liable to action under the Foreign Exchange Regulation Act. 1947.</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: #0d406b !important;">(b)	That the Foreign exchange released to me/us shall be used for expenses incurred by means in foreign country/ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; countries for</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 10px;color: #0d406b !important;">*(i) my/our living and travelling expenses for business purposes.</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 10px;color: #0d406b !important;">*(ii) my/our en route expenses for travel abroad.</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 10px;color: #0d406b !important;">*(iii) my/our living expenses and medical treatment.</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: #0d406b !important;">(c)	I/We am/are aware that exchange issued to me/us under this form for travel purposes may only be taken out by  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  me/us on my/our departure from Bangladesh and may not be sent out by post or through the medium of any other  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  person or by any other means.</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: #0d406b !important;">(d)	That if the travel has not been undertaken for the purpose mentioned above, or if any unspent foreign exchange &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;remaining in my/our possession or at my/our disposal or which could not be utilized for the purpose for which it &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;was granted, will be sold by me/us to an Authorised Dealer in foreign exchange in Bangladesh immediately on &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;my/our return to Bangladesh.</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: #0d406b !important;">(e)	I/We declare that the payment mentioned against ‘b’ above is due to be made by me/us for which documentary &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;evidence is enclosed and assume full responsibility for complying with the provisions of the Foreign Exchange &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Regulation Act. 1947 and rules, orders and directives issued thereunder.</td>
                                                </tr>
                                                <tr>
                                                    <td style="float: right;padding-top: 10px;padding-bottom: 0px;color: #0d406b !important;"><i style="color: #0d406b !important;">Signature of the Applicant</i></td>
                                                </tr>
                                                <br>
                                            </table>
                                            <br>
                                            <table width="100%">
                                                <tr style="font-size: 15px;color: #0d406b !important;padding-top: 0px;">
                                                    <td style="width: 18%;border: 1px solid #0d406b;padding: 5px;font-size: 15px;color: #0d406b !important;">See Chapter 5</td>
                                                    <td style="width: 10%;padding: 5px;text-align: center;border-top: 1px solid #0d406b;border-right: 1px solid #0d406b;border-bottom: 1px solid #0d406b;color: #0d406b !important;">Para-2</td>
                                                    <td style="width: 52%;text-align: center;font-size: 14px;">
                                                        <p style="line-height: 1em;margin-bottom: 0px !important;color: #0d406b !important;">FORM TM</p><p style="line-height: 1em;margin-bottom: 0px !important;color: #0d406b !important;">Travel and Miscellaneous Purposes</p><p style="line-height: 1em;margin-bottom: 0px !important;color: #0d406b !important;">(other than import)</p>
                                                    </td>
                                                    <td style="width: 12%;color: #0d406b !important;border: 1px solid #0d406b;text-align: center;">APP. 5</td>
                                                    <td style="width: 8%;color: #0d406b !important;border-top: 1px solid #0d406b;border-right: 1px solid #0d406b;border-bottom: 1px solid #0d406b;text-align: center;">5</td>
                                                </tr>
                                            </table>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <table width="100%">
                                                <tr>
                                                    <td style="border-bottom: 1px solid #0d406b;padding-top: 10px;"></td>
                                                </tr>
                                                <tr style="line-height: 0.9em">
                                                    <td style="text-align: center;color: #0d406b !important;">Certificate of approval of the Bangladesh Bank (If required).</td>
                                                </tr>
                                                <tr style="line-height: 0.9em">
                                                    <td style="text-align: center;color: #0d406b !important;">(Valid for three calender months from the date of approval).</td>
                                                </tr>
                                            </table>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <table width="100%">
                                                <tr>
                                                    <td style="color: #0d406b !important;line-height: 0.5em;padding-top: 20px">____________________</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: #0d406b !important;line-height: 0.5em">Date of approval</td>
                                                    <td style="float: right;color: #0d406b !important;">Seal & Signature of the Bangladesh Bank</td>
                                                </tr>
                                            </table>

                                            <table width="100%">
                                                <tr>
                                                    <td style="border-bottom: 1px solid #0d406b;padding-bottom: 12px"></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: center;color: #0d406b !important;line-height: 0.9em">(Certificate by Authorised Dealer)</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: #0d406b !important;padding-top: 15px">*(a) We have issued Note & Coins________________T/C __________L/C__________Total__________ Date__________</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: #0d406b !important;">as per Bangladesh Bank approval dated _____________________ and endorsed the amount released in the traveller's</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: #0d406b !important;">passport after examining the ticket covering the passage.</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: #0d406b !important;">*(b) We have effected remittance of ____________________________________________________________________</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: #0d406b !important;text-align: center">(State amount)</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: #0d406b !important;">in terms of Para __________________________________ of GFET ___________________________________________</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: #0d406b !important;">Bangladesh Bank's approval No ________________________________ dated _________________________________</td>
                                                </tr>
                                                <tr>
                                                    <td style="color: #0d406b !important;">by __________________________________ on ___________________ (TT/MT/Draft) ___________________________</td>
                                                </tr>
                                            </table>
                                            <br>
                                            <br>
                                            <br>
                                            <table width="100%" style="">
                                                <tr><td colspan="21" style="color: #0d406b !important;border: 1px solid #0d406b;text-align: center;font-weight: bold">Cage to completed by Authorised Dealer indicating Code No. as per Code list circulated by the Bangladesh Bank.</td></tr>
                                                <tr>
                                                    <td colspan="1" style="border: 1px solid #0d406b;color: #0d406b !important;text-align: center;">Month</td>
                                                    <td colspan="4" style="border: 1px solid #0d406b;color: #0d406b !important;text-align: center;">Country of beneficiary</td>
                                                    <td colspan="4" style="border: 1px solid #0d406b;color: #0d406b !important;text-align: center;">Purpose</td>
                                                    <td colspan="2" style="border: 1px solid #0d406b;color: #0d406b !important;text-align: center;">Category</td>
                                                    <td colspan="2" style="border: 1px solid #0d406b;color: #0d406b !important;text-align: center;">Currency</td>
                                                    <td colspan="8" style="border: 1px solid #0d406b;color: #0d406b !important;text-align: center;">Amount in foreign currency</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="1" style="border: 1px solid #0d406b;padding: 10px; padding-bottom: 30px;"></td>
                                                    <td colspan="1" style="border: 1px solid #0d406b;padding: 10px;"></td>
                                                    <td colspan="1" style="border: 1px solid #0d406b;padding: 10px;"></td>
                                                    <td colspan="1" style="border: 1px solid #0d406b;padding: 10px;"></td>
                                                    <td colspan="1" style="border: 1px solid #0d406b;padding: 10px;"></td>
                                                    <td colspan="1" style="border: 1px solid #0d406b;padding: 10px;"></td>
                                                    <td colspan="1" style="border: 1px solid #0d406b;padding: 10px;"></td>
                                                    <td colspan="1" style="border: 1px solid #0d406b;padding: 10px;"></td>
                                                    <td colspan="1" style="border: 1px solid #0d406b;padding: 10px;"></td>
                                                    <td colspan="1" style="border: 1px solid #0d406b;padding: 10px;"></td>
                                                    <td colspan="1" style="border: 1px solid #0d406b;padding: 10px;"></td>
                                                    <td colspan="1" style="border: 1px solid #0d406b;padding: 10px;"></td>
                                                    <td colspan="1" style="border: 1px solid #0d406b;padding: 10px;"></td>
                                                    <td colspan="1" style="border: 1px solid #0d406b;padding: 10px;"></td>
                                                    <td colspan="1" style="border: 1px solid #0d406b;padding: 10px;"></td>
                                                    <td colspan="1" style="border: 1px solid #0d406b;padding: 10px;"></td>
                                                    <td colspan="1" style="border: 1px solid #0d406b;padding: 10px;"></td>
                                                    <td colspan="1" style="border: 1px solid #0d406b;padding: 10px;"></td>
                                                    <td colspan="1" style="border: 1px solid #0d406b;padding: 10px;"></td>
                                                    <td colspan="1" style="border: 1px solid #0d406b;padding: 10px;"></td>
                                                    <td colspan="1" style="border: 1px solid #0d406b;padding: 10px;"></td>
                                                </tr>
                                            </table>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <table width="100%">
                                                <tr>
                                                    <td style="float: right;padding-top: 30px;line-height: 1em;color: #0d406b !important;"><i style="color: #0d406b !important;">Signature and Stamp of the</i></td>
                                                </tr>
                                                <tr>
                                                    <td style="float: right;line-height: 1em;padding-bottom: 10px;color: #0d406b !important;"><i style="color: #0d406b !important;">Authorised Dealer &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: center;color: #0d406b !important;padding-top: 15px;">I/We hereby certify having received the exchange issued to me/us above.</td>
                                                </tr>
                                                <tr>
                                                    <td style="float: right;padding-top: 20px;color: #0d406b !important;"><i style="color: #0d406b !important;">Signature (s) of the Applicant (s)</i></td>
                                                </tr>
                                                <tr>
                                                    <td style="border-bottom: 1px solid #0d406b;color: #0d406b !important;"></td>
                                                </tr>
                                                <tr>
                                                    <td style="color: #0d406b !important;">*<i style="color: #0d406b !important;">Strike out items not applicable</i></td>
                                                </tr>
                                            </table>
                                        </div>

                                    </div>
                                    <?php } ?>
                                </div>
                                <div style="display: none;">
                                    <div id="printableArea_for_vucher">
                                        <p style="float: right;font-weight: bold;">Registration Number: <span style="border: 3px solid #000; font-weight: bold;"><?php if (isset($print_data->serial_number) && !empty($print_data->serial_number)){ echo $print_data->serial_number; } ?></span></p><br>
                                        <br>
                                        <div style="font-size:11px; border: 2px solid #000;padding-left: 3px;padding-right: 5px;padding-top: 0px;padding-bottom: 0px; ">
                                            <table width="100%">
                                                <tr width="100%">
                                                    <td width="25%"></td>
                                                    <td width="45%"><h4 style="font-weight: bold;margin: 0px !important;font-size: 17px;">State Bank of India, <?php echo $print_data->branch_name ?> Branch</h4></td>
                                                    <td width="30%"></td>
                                                </tr>
                                                <tr width="100%">
                                                    <td width="25%"></td>
                                                    <td width="45%"><h4 style="font-weight: bold;margin: 0px !important;line-height: 1.5em;font-size: 17px;">&nbsp;&nbsp;&nbsp; Credit Voucher for Travel Card</h4></td>
                                                    <td width="30%"><h4 style="font-weight: bold;margin: 0px !important;line-height: 1.5em;font-size: 17px;">Date: <?php echo date('d.m.Y') ?></h4></td>
                                                </tr>
                                            </table>
                                            <table style="width: 100%;font-size: 14px;">
                                                <tr>
                                                    <td width="20%" style="font-size: 14px;color: #000;" >A/C No.</td>
                                                    <td width="30%" style="font-size: 14px;color: #000;font-weight: bold"><?php if (isset($account_inter) && !empty($account_inter)){ echo $account_inter->account_no; } ?></td>
                                                    {{--<td width="20%"></td>--}}
                                                    <td width="50%" style="font-size: 14px;color: #000;font-weight: bold">(INTER BRANCH USD A/C)</td>
                                                </tr>
                                            </table>
                                            <table style="width: 100%;">
                                                <tr>
                                                    <td width="20%" style="font-size: 14px;color: #000;">Name:</td>
                                                    <td width="35%" style="font-size: 14px;color: #000;font-weight: bold"><?php echo $print_data->a_name; ?></td>
                                                    <td width="20%" style="padding-left: 20px;font-size: 14px;color: #000;font-weight: bold"> Card Load</td>
                                                    <td width="5%" style="font-size: 14px;color: #000;font-weight: bold"> $</td>
                                                    <td width="20%" style="float: right;font-size: 14px;font-weight: bold"><?php echo round($print_data->f_currency, 2); ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="20%" style="font-size: 14px;color: #000;">Passport:</td>
                                                    <td width="35%" style="font-size: 14px;color: #000;font-weight: bold"><?php echo $print_data->passport_no; ?></td>
                                                    <td width="20%" style="padding-left: 20px;font-size: 14px;color: #000;font-weight: bold"> Rate @ BDT</td>
                                                    <td width="5%" style="font-size: 14px;color: #000;font-weight: bold"> </td>
                                                    <td width="20%" style="float: right;font-size: 14px;color: #000;font-weight: bold"><?php echo $print_data->c_rate; ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="20%" style="font-size: 14px;color: #000;">URN No.</td>
                                                    <td width="35%" style="font-size: 14px;color: #000;font-weight: bold"><?php echo $print_data->urn; ?></td>
                                                    <td width="20%" style="padding-left: 20px;font-size: 14px;color: #000;font-weight: bold"></td>
                                                    <td width="5%" style="font-size: 14px;color: #000;font-weight: bold"> </td>
                                                    <td width="20%" style="float: right;font-size: 14px;color: #000;font-weight: bold"></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div style="border-bottom: 2px solid #000;border-left:2px solid #000;border-right: 2px solid #000;font-weight: bold;font-size: 18px;">
                                            <table width="100%">
                                                <tr>
                                                    <td width="20%" style="font-size: 14px;color: #000;"></td>
                                                    <td width="35%" style="font-size: 14px;color: #000;"></td>
                                                    <td width="20%" style="padding-left: 20px;font-size: 14px;color: #000;">Total Tk</td>
                                                    <td width="5%" style="font-size: 14px;color: #000;"> </td>
                                                    <td width="20%" style="font-size: 14px;color: #000;margin-right: 5px"><span style="float: right;padding-right: 10px"><?php $total_f =round($print_data->f_currency * $print_data->c_rate, 2); $foreign_sum = number_format($total_f,2); echo $foreign_sum; ?></span></td>
                                                </tr>

                                            </table>
                                            <table width="100%" style="font-weight: bold">
                                                <tr>
                                                    <td width="18%" style="font-size: 14px;color: #000;padding-left: 5px;">In Words:</td>
                                                    <td width="72%" style="font-size: 14px;color: #000;">
                                                        <?php
                                                        $foreign_usd = \App\Http\Controllers\DollarEndorsementController::convert_number_to_words($total_f);
                                                        echo ucfirst($foreign_usd);
                                                        ?> Taka Only
                                                    </td>
                                                </tr>
                                            </table>
                                            <table width="100%" style="font-weight: bold;">
                                                <td width="70%"></td>
                                                <td style="font-size: 14px;color: #000;">Contra: CASH</td>
                                            </table>
                                            <table width="100%" style="font-weight: bold;">
                                                <tr>
                                                    <td width="40%" style="font-size: 14px;color: #000;padding-left: 5px"></td>
                                                    <td width="40%" style="font-size: 14px;color: #000;">
                                                        <?php if (isset($image->manager_signature) && !empty($image->manager_signature)){ ?>
                                                        <img src="{{asset('public/uploads/').'/'.$image->manager_signature}}" height="40px" width="140px">
                                                        <?php } ?>
                                                    </td>
                                                    <td width="" style="font-size: 14px;color: #000;"></td>
                                                </tr>
                                                <tr>
                                                    <td width="40%" style="font-size: 14px;color: #000;padding-left: 5px">Prepared By</td>
                                                    <td width="40%" style="font-size: 14px;color: #000;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Manager</td>
                                                    <td width="" style="font-size: 14px;color: #000;">Verified By</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <br>
                                        {{--voucher 2--}}
                                        <div style="padding-top: 60px">
                                            <div style="border: 2px solid #000;padding-left: 3px;padding-right: 5px;padding-top: 5px;">
                                                <table width="100%">
                                                    <tr width="100%">
                                                        <td width="25%"></td>
                                                        <td width="45%"><h4 style="font-weight: bold;margin: 0px !important;font-size: 17px;">State Bank of India, <?php echo $print_data->branch_name ?> Branch</h4></td>
                                                        <td width="30%"></td>
                                                    </tr>
                                                    <tr width="100%">
                                                        <td width="25%"></td>
                                                        <td width="45%"><h4 style="font-weight: bold;margin: 0px !important;line-height: 1.5em;font-size: 17px;">&nbsp;&nbsp;&nbsp; Credit Voucher for Travel Card</h4></td>
                                                        <td width="30%"><h4 style="font-weight: bold;margin: 0px !important;line-height: 1.5em;font-size: 17px;">Date: <?php echo date('d.m.Y') ?></h4></td>
                                                    </tr>
                                                </table>
                                                <table style="width: 100%;">
                                                    <tr>
                                                        <td width="20%" style="font-size: 14px;color: #000;" >A/C No.</td>
                                                        <td width="30%" style="font-size: 14px;color: #000;font-weight: bold"><?php if (isset($account_pooling) && !empty($account_pooling)){ echo $account_pooling->account_no; } ?></td>
                                                        {{--<td width="20%"></td>--}}
                                                        <td width="50%" style="font-size: 14px;color: #000;font-weight: bold">(POOLING A/C)</td>
                                                    </tr>
                                                </table>
                                                <table style="width: 100%;">
                                                    <tr>
                                                        <td width="20%" style="font-size: 14px;color: #000;">Name:</td>
                                                        <td width="35%" style="font-size: 14px;color: #000;font-weight: bold"><?php echo $print_data->a_name; ?></td>
                                                        <td width="20%" style="padding-left: 20px;font-size: 14px;color: #000;font-weight: bold"> Commission</td>
                                                        <td width="5%" style="font-size: 14px;color: #000;font-weight: bold"> $</td>
                                                        <td width="20%" style="float: right;font-size: 14px;font-weight: bold"><span style="float: right;padding-right: 10px"><?php echo $print_data->commission; ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="20%" style="font-size: 14px;color: #000;">Passport:</td>
                                                        <td width="35%" style="font-size: 14px;color: #000;font-weight: bold"><?php echo $print_data->passport_no; ?></td>
                                                        <td width="20%" style="padding-left: 20px;font-size: 14px;color: #000;font-weight: bold"> Rate @ BDT</td>
                                                        <td width="5%" style="font-size: 14px;color: #000;font-weight: bold"> </td>
                                                        <td width="20%" style="float: right;font-size: 14px;color: #000;font-weight: bold"><span style="float: right;padding-right: 10px"><?php echo $print_data->c_rate; ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="20%" style="font-size: 14px;color: #000;">URN No.</td>
                                                        <td width="35%" style="font-size: 14px;color: #000;font-weight: bold"><?php echo $print_data->urn; ?></td>
                                                        <td width="20%" style="padding-left: 20px;font-size: 14px;color: #000;font-weight: bold"> </td>
                                                        <td width="5%" style="font-size: 14px;color: #000;font-weight: bold"> </td>
                                                        <td width="20%" style="float: right;font-size: 14px;color: #000;font-weight: bold"></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div style="border-bottom: 2px solid #000;border-left:2px solid #000;border-right: 2px solid #000;font-weight: bold;font-size: 18px;">
                                                <table width="100%">
                                                    <tr>
                                                        <td width="20%" style="font-size: 14px;color: #000;"></td>
                                                        <td width="35%" style="font-size: 14px;color: #000;"></td>
                                                        <td width="20%" style="padding-left: 20px;font-size: 14px;color: #000;">Total Tk</td>
                                                        <td width="5%" style="font-size: 14px;color: #000;"> </td>
                                                        <td width="20%" style="float: right;font-size: 14px;color: #000;margin-right: 5px"><span style="float: right;padding-right: 10px"><?php $comm_sum = round($print_data->commission * $print_data->c_rate, 2); $amount_comm = number_format($comm_sum,2); echo $amount_comm; ?></span></td>
                                                    </tr>

                                                </table>
                                                <table width="100%" style="font-weight: bold">
                                                    <tr>
                                                        <td width="18%" style="font-size: 14px;color: #000;padding-left: 5px;">In Words:</td>
                                                        <td width="72%" style="font-size: 14px;color: #000;">
                                                            <?php
                                                            $comm = \App\Http\Controllers\DollarEndorsementController::convert_number_to_words($amount_comm);
                                                            echo ucfirst($comm);
                                                            ?> Taka Only
                                                        </td>
                                                    </tr>
                                                </table>
                                                <table width="100%" style="font-weight: bold;">
                                                    <td width="70%"></td>
                                                    <td style="font-size: 14px;color: #000;">Contra: CASH</td>
                                                </table>
                                                <table width="100%" style="font-weight: bold;">
                                                    <tr>
                                                        <td width="40%" style="font-size: 14px;color: #000;padding-left: 5px">Prepared By</td>
                                                        <td width="40%" style="font-size: 14px;color: #000;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Manager</td>
                                                        <td width="" style="font-size: 14px;color: #000;">Verified By</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <br>
                                        {{--voucher 3--}}
                                        <div style="padding-top: 60px">
                                            <div style="border: 2px solid #000;padding-left: 3px;padding-right: 5px;padding-top: 5px;">
                                                <table width="100%">
                                                    <tr width="100%">
                                                        <td width="25%"></td>
                                                        <td width="45%"><h4 style="font-weight: bold;margin: 0px !important;font-size: 17px;">State Bank of India, <?php echo $print_data->branch_name ?> Branch</h4></td>
                                                        <td width="30%"></td>
                                                    </tr>
                                                    <tr width="100%">
                                                        <td width="25%"></td>
                                                        <td width="45%"><h4 style="font-weight: bold;margin: 0px !important;line-height: 1.5em;font-size: 17px;">&nbsp;&nbsp;&nbsp; Credit Voucher for Travel Card</h4></td>
                                                        <td width="30%"><h4 style="font-weight: bold;margin: 0px !important;line-height: 1.5em;font-size: 17px;">Date: <?php echo date('d.m.Y') ?></h4></td>
                                                    </tr>
                                                </table>
                                                <table style="width: 100%;">
                                                    <tr>
                                                        <td width="20%" style="font-size: 14px;color: #000;" >A/C No.</td>
                                                        <td width="30%" style="font-size: 14px;color: #000;font-weight: bold"><?php if (isset($account_expense) && !empty($account_expense)){ echo $account_expense->account_no; } ?></td>
                                                        {{--<td width="20%"></td>--}}
                                                        <td width="50%" style="font-size: 14px;color: #000;font-weight: bold">(EXPENSES & CHARGES ON PREPAID CARD)</td>
                                                    </tr>
                                                </table>
                                                <table style="width: 100%;">
                                                    <tr>
                                                        <td width="20%" style="font-size: 14px;color: #000;">Name:</td>
                                                        <td width="35%" style="font-size: 14px;color: #000;font-weight: bold"><?php echo $print_data->a_name ?></td>
                                                        <td width="20%" style="padding-left: 20px;font-size: 14px;color: #000;font-weight: bold">Comm.(Tk)</td>
                                                        <td width="5%" style="font-size: 14px;color: #000;font-weight: bold"> </td>
                                                        <td width="20%" style="float: right;font-size: 14px;font-weight: bold"><span style="float: right;padding-right: 10px"><?php echo $print_data->s_charge ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="20%" style="font-size: 14px;color: #000;">Passport:</td>
                                                        <td width="35%" style="font-size: 14px;color: #000;font-weight: bold"><?php echo $print_data->passport_no ?></td>
                                                        <td width="20%" style="padding-left: 20px;font-size: 14px;color: #000;font-weight: bold"></td>
                                                        <td width="5%" style="font-size: 14px;color: #000;font-weight: bold"> </td>
                                                        <td width="20%" style="float: right;font-size: 14px;color: #000;font-weight: bold"></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="20%" style="font-size: 14px;color: #000;">URN No.</td>
                                                        <td width="35%" style="font-size: 14px;color: #000;font-weight: bold"><?php echo $print_data->urn ?></td>
                                                        <td width="20%" style="padding-left: 20px;font-size: 14px;color: #000;font-weight: bold"></td>
                                                        <td width="5%" style="font-size: 14px;color: #000;font-weight: bold"> </td>
                                                        <td width="20%" style="float: right;font-size: 14px;color: #000;font-weight: bold"></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div style="border-bottom: 2px solid #000;border-left:2px solid #000;border-right: 2px solid #000;font-weight: bold;font-size: 18px;">
                                                <table width="100%">
                                                    <tr>
                                                        <td width="20%" style="font-size: 14px;color: #000;"></td>
                                                        <td width="35%" style="font-size: 14px;color: #000;"></td>
                                                        <td width="20%" style="padding-left: 20px;font-size: 14px;color: #000;">Total Tk</td>
                                                        <td width="5%" style="font-size: 14px;color: #000;"> </td>
                                                        <td width="20%" style="float: right;font-size: 14px;color: #000;margin-right: 5px"><span style="float: right;padding-right: 10px"><?php $service_amont = round($print_data->s_charge, 2); $s_sum = number_format($service_amont,2); echo $s_sum; ?></span></td>
                                                    </tr>

                                                </table>
                                                <table width="100%" style="font-weight: bold">
                                                    <tr>
                                                        <td width="18%" style="font-size: 14px;color: #000;padding-left: 5px;">In Words:</td>
                                                        <td width="72%" style="font-size: 14px;color: #000;"><?php
                                                            $ser_sum= \App\Http\Controllers\DollarEndorsementController::convert_number_to_words($service_amont);
                                                            echo ucfirst($ser_sum) ?> Taka Only</td>
                                                    </tr>
                                                </table>
                                                <table width="100%" style="font-weight: bold;">
                                                    <td width="70%"></td>
                                                    <td style="font-size: 14px;color: #000;">Contra: CASH</td>
                                                </table>
                                                <table width="100%" style="font-weight: bold;">
                                                    <tr>
                                                        <td width="40%" style="font-size: 14px;color: #000;padding-left: 5px"></td>
                                                        <td width="40%" style="font-size: 14px;color: #000;">
                                                            <?php if (isset($image->manager_signature) && !empty($image->manager_signature)){ ?>
                                                            <img src="{{asset('public/uploads/').'/'.$image->manager_signature}}" height="40px" width="140px">
                                                            <?php } ?>
                                                        </td>
                                                        <td width="" style="font-size: 14px;color: #000;"></td>
                                                    <tr>
                                                        <td width="40%" style="font-size: 14px;color: #000;padding-left: 5px">Prepared By</td>
                                                        <td width="40%" style="font-size: 14px;color: #000;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Manager</td>
                                                        <td width="" style="font-size: 14px;color: #000;">Verified By</td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div style="border-bottom: 2px solid #000;border-left: 2px solid #000; border-right: 2px solid #000;">
                                                <table width="100%">
                                                    <br>
                                                    <td width="60%"></td>
                                                    <td width="20%" style="border-top:2px solid #000;border-left:2px solid #000;border-right: 2px solid #000;font-weight: bold;padding-left: 3px">Grand Total (BDT)</td>
                                                    <td width="30%" style="border-top:2px solid #000;margin-right: -3px;font-weight: bold;"><span style="float: right;padding-right: 3px;font-size: 18px"><?php echo number_format(round($print_data->t_amount, 2),2); ?></span></td>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div style="display: none;">
                                    <div id="printableArea_for_voucher">
                                        <meta name="csrf-token" content="{{ csrf_token() }}"/>
                                        <section class="content">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    {{--<div class="main_part">--}}
                                                    <div class="result_body">
                                                        <div class="result_table">
                                                            <div id="printableArea">
                                                                <div style="font-size:11px; padding-left: 3px;padding-right: 5px;padding-top: 0px;padding-bottom: 0px">
                                                                    <table width="100%">
                                                                        <tr>
                                                                            <td width="40%"><h4 style="font-weight: bold;margin: 0px !important;font-size: 17px;padding-top: 27px">State Bank of India <span style="font-size: 10px"><?php echo $print_data->branch_name ?> Branch</span></h4></td>
                                                                            <td width="40%" style="float: left"><img style="height: 50px; width: 150px" src="{{asset('public/assets/img/logo-sbi-sm.png') }}"></td>
                                                                            <td width="15%" style="padding-left: 40px !important;">ORIGINAL </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%"><span style="font-size: 12px"><?php if (isset($address->address)){ echo $address->address; } ?></span></td>
                                                                            <td width="40%"></td>
                                                                            <td width="15%" style=""></td>
                                                                        </tr>

                                                                    </table>
                                                                    <table width="100%">
                                                                        <tr>
                                                                            <td width="75%"><span style="font-size: 12px">Phone: <?php if (isset($address->phone)){ echo $address->phone; } ?>, Fax: <?php if (isset($address->fax)){ echo $address->fax; } ?>, E-mail: <?php if (isset($address->email)){  echo $address->email; } ?></span></td>
                                                                            <td width="25%" style="font-size: 13px">Date: <?php echo date('F d, Y') ?></td>
                                                                        </tr>
                                                                    </table>
                                                                    <br>
                                                                    <table width="100%" style="border-spacing: 0px !important;">
                                                                        <tr style="font-size: 14px">
                                                                            <td width="60%"><span style="font-size: 14px">Name: <?php echo $print_data->a_name; ?></span></td>
                                                                            <td width="25%" style="border: 1px solid #000;" class="borderSpace">Passport No: </td>
                                                                            <td width="15%" style="border: 1px solid #000;" class="borderSpace"><?php echo $print_data->passport_no; ?> </td>
                                                                        </tr>
                                                                        <tr style="font-size: 14px">
                                                                            <td width="60%"><span style="font-size: 14px">Date of Issue: <?php echo date('F d, Y', strtotime($print_data->date_of_issue)); ?></span></td>
                                                                            <td width="25%" style="border: 1px solid #000;" class="borderSpace">Place of Issue: </td>
                                                                            <td width="15%" style="border: 1px solid #000;" class="borderSpace"><?php echo $print_data->place_of_issue; ?> </td>
                                                                        </tr>
                                                                        <tr style="font-size: 14px">
                                                                            <td width="60%"><span style="font-size: 14px">Nationality: Bangladeshi</span></td>
                                                                            <td width="25%" style="border: 1px solid #000;" class="borderSpace">Travel Card No: <span style="border-left: 1px solid #000;border-spacing: 0px;padding-left: 4px"></span>********</td>
                                                                            <td width="15%" style="border: 1px solid #000;" class="borderSpace"><?php $t_number = array_map('intval', str_split($print_data->digit)); $arr_count = count($t_number); echo $t_number[$arr_count-4].$t_number[$arr_count-3].$t_number[$arr_count-2].$t_number[$arr_count-1]; ?> </td>
                                                                        </tr>
                                                                    </table>
                                                                    <table width="100%">
                                                                        <tr>
                                                                            <td width="100%"><span style="font-size: 14px">We have sold / encashed the following foreign currencies to the above named person(s)</span></td>
                                                                        </tr>
                                                                    </table>
                                                                    <table width="100%" style="border-spacing: 0px !important;font-size: 14px">
                                                                        <tr>
                                                                            <td width="34%" style="border: 1px solid #000;text-align: center" class="borderSpace">FC Amount </td>
                                                                            <td width="11%" style="border: 1px solid #000;" class="borderSpace">&nbsp; <span style="padding: 5px"></span></td>
                                                                            <td width="55%" style="border: 1px solid #000;text-align: center" class="borderSpace">BDT Amount </td>
                                                                        </tr>
                                                                    </table>
                                                                    <table width="100%" style="border-spacing: 0px !important;font-size: 14px; text-align: center">
                                                                        <tr>
                                                                            <td width="10%" style="border-left: 1px solid #000;border-right: 1px solid #000;border-bottom: 1px solid #000;" class="borderSpace">Cash </td>
                                                                            <td width="10%" style="border-left: 1px solid #000;border-right: 1px solid #000;border-bottom: 1px solid #000;" class="borderSpace">Travel Card </td>
                                                                            <td width="10%" style="border-left: 1px solid #000;border-right: 1px solid #000;border-bottom: 1px solid #000;" class="borderSpace">Upload Fee</td>
                                                                            <td width="10%" style="border-left: 1px solid #000;border-right: 1px solid #000;border-bottom: 1px solid #000;" class="borderSpace">Conversion Rate</td>
                                                                            <td width="11%" style="border-left: 1px solid #000;border-right: 1px solid #000;border-bottom: 1px solid #000;text-align: center" class="borderSpace">Taka equivalent</td>
                                                                            <td width="9%" style="border-left: 1px solid #000;border-right: 1px solid #000;border-bottom: 1px solid #000;text-align: center" class="borderSpace">Charges</td>
                                                                            <td width="13%" style="border-left: 1px solid #000;border-right: 1px solid #000;border-bottom: 1px solid #000;text-align: center" class="borderSpace">Commission BDT(including 15% Vat) </td>
                                                                            <td width="15%" style="border-left: 1px solid #000;border-right: 1px solid #000;border-bottom: 1px solid #000;text-align: center" class="borderSpace">Total Taka Amt. </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="10%" style="border-left: 1px solid #000;border-right: 1px solid #000;border-bottom: 1px solid #000;" class="borderSpace">$0.00 </td>
                                                                            <td width="10%" style="border-left: 1px solid #000;border-right: 1px solid #000;border-bottom: 1px solid #000; text-align: center" class="borderSpace">$<?php echo round($print_data->f_currency, 2); ?> </td>
                                                                            <td width="10%" style="border-left: 1px solid #000;border-right: 1px solid #000;border-bottom: 1px solid #000;text-align: center" class="borderSpace">$<?php echo round($print_data->commission, 2); ?></td>
                                                                            <td width="10%" style="border-left: 1px solid #000;border-right: 1px solid #000;border-bottom: 1px solid #000;text-align: center" class="borderSpace"><?php echo round($print_data->c_rate, 2); ?></td>
                                                                            <td width="11%" style="border-left: 1px solid #000;border-right: 1px solid #000;border-bottom: 1px solid #000;text-align: center" class="borderSpace"><?php $t_dollar = $print_data->f_currency + $print_data->commission; $t_amount = $t_dollar * $print_data->c_rate; echo number_format(round($t_amount, 2),2); ?></td>
                                                                            <td width="9%" style="border-left: 1px solid #000;border-right: 1px solid #000;border-bottom: 1px solid #000;text-align: center" class="borderSpace">-</td>
                                                                            <td width="12%" style="border-left: 1px solid #000;border-right: 1px solid #000;border-bottom: 1px solid #000;text-align: center" class="borderSpace"><?php echo number_format(round($print_data->s_charge, 2),2); ?></td>
                                                                            <td width="15%" style="border-left: 1px solid #000;border-right: 1px solid #000;border-bottom: 1px solid #000;text-align: center" class="borderSpace"><?php $total_amount = round($print_data->t_amount, 2); echo number_format(round($print_data->t_amount, 2), 2); ?></td>
                                                                        </tr>
                                                                    </table>
                                                                    <br>
                                                                    <br>
                                                                    <table width="100%" style="font-size: 14px">
                                                                        <tr>
                                                                            <td width="13%">Receive Tk: </td>
                                                                            <td width="20%"><b><?php $total_amount = round($print_data->t_amount, 2); echo number_format($total_amount, 2); ?></b></td>
                                                                            <td width="67%"><b><?php $ser_sum= \App\Http\Controllers\DollarEndorsementController::convert_number_to_words($total_amount);
                                                                                    echo ucfirst($ser_sum) ?></b></td>
                                                                        </tr>
                                                                    </table>
                                                                    <br>
                                                                    <br>
                                                                    <table width="100%" style="font-size: 14px;">
                                                                        <tr>
                                                                            <td>For <b>State Bank of India</b></td>
                                                                        </tr>
                                                                    </table>
                                                                    <br>
                                                                    <br>
                                                                    <br>
                                                                    <table width="100%" style="font-size: 14px;">
                                                                        <tr>
                                                                            <td><i>Authorized Signatory</i></td>
                                                                        </tr>
                                                                    </table>
                                                                    <br>
                                                                    <table width="100%" style="font-size: 14px;">
                                                                        <tr>
                                                                            <td>For issues or queries related to Travel Card:</td>
                                                                        </tr>
                                                                    </table>
                                                                    <table width="100%" style="font-size: 14px;">
                                                                        <tr>
                                                                            <td>Contact: <?php if (isset($address->enquery_phone)){ echo $address->enquery_phone; } ?></td>
                                                                            <td>Email: <?php if (isset($address->enquery_email)){ echo $address->enquery_email; } ?></td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{--</div>--}}
                                                </div>
                                            </div>
                                        </section>

                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script>
        function printDivForTravel(divName) {
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
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
            var c_link = window.location.href;
            window.location.href=c_link;
        }
    </script>
    <script>
        function printDiv(divName) {
            var css = '@page { size: portrait; }',
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
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
            var c_link = window.location.href;
            window.location.href=c_link;
        }
    </script>
    <script>
        function printDivForVoucher(divName) {
            var css = '@page { size: portrait; }',
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
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
            var c_link = window.location.href;
            window.location.href=c_link;
        }
    </script>
    <script>
        function printDivVoucher(divName) {
            var css = '@page { size: portrait; }',
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
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
            var c_link = window.location.href;
            window.location.href=c_link;
        }
    </script>
@endsection


