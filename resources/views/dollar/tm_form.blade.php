@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Dollar Endorsement
@endsection

<!--Page Header-->
@section('page-header')
    Dollar Endorsement - FORM TM
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
                    <form action="{{url('/print-tm-form')}}" method="get" role="search">
                        {{ csrf_field() }}
                        <div class="passport_search">
                            <input type="search" name="q" value="" placeholder="Passport Search">
                            <button type="submit" class="btn_search">Search</button>
                        </div>
                    </form>
                    <div class="result_body">
                        <div class="result_table">
                            <?php if (isset($print_data) && !empty($print_data)){ ?>
                            <button value="Voucher Print" onclick="printDiv('printableArea')" class="btn_approved"> Reprint</button>
                            <br>
                            <br>

                            <br>
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
                                            <td style="color: #0d406b !important;font-size: 12px;line-height: 1em;"><span style="color: #0d406b !important;font-weight: bold">Gulshan Branch:</span> Uday Tower, 57 & 57(A) 1st Floor</td>
                                        </tr>
                                        <tr>
                                            <td style="color: #0d406b !important;font-size: 12px;padding-bottom: 5px;line-height: 1em;">Gulshan Avenue, Circle-1, Gulshan, Dhaka-1212</td>
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
                    </div>
                </div>
            </div>
        </div>
    </section>
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
        }
    </script>

    <script>
        //window.onload = printDiv('printableArea');
        $(window).on('afterprint', function () {
            //window.location.href="{{ url("/tm-form") }}";
        });
    </script>
@endsection


