
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                {{--<div class="main_part">--}}
                    <div class="result_body">
                        <div class="result_table">
                            <div id="printableArea">
                                <table width="100%">
                                    <tr>
                                        <td style="float: right;font-weight: bold;">Registration Number: <span style="border: 3px solid #000; font-weight: bold;"><?php if (isset($print_data->serial_number) && !empty($print_data->serial_number)){ echo $print_data->serial_number; } ?></span></td>
                                    </tr>
                                </table>
                                <div style="font-size:11px; border: 2px solid #000;padding-left: 3px;padding-right: 5px;padding-top: 0px;padding-bottom: 0px">
                                    <table width="100%">
                                        <tr width="100%">
                                            <td width="25%"></td>
                                            <td width="45%"><h4 style="font-weight: bold;margin: 0px !important;font-size: 16px;">State Bank of India, <?php echo $print_data->branch_name ?> Branch </h4></td>
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
                                        <tr>
                                        <tr>
                                            <td width="40%" style="font-size: 14px;color: #000;padding-left: 5px">Prepared By</td>
                                            <td width="40%" style="font-size: 14px;color: #000;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Manager</td>
                                            <td width="" style="font-size: 14px;color: #000;">Verified By</td>
                                        </tr>
                                    </table>
                                </div>
                                {{--voucher 2--}}
                                <div style="padding-top: 50px">
                                    <div style="border: 2px solid #000;padding-left: 3px;padding-right: 5px;padding-top: 5px;">
                                        <table width="100%">
                                            <tr width="100%">
                                                <td width="25%"></td>
                                                <td width="45%"><h4 style="font-weight: bold;margin: 0px !important;font-size: 16px;">State Bank of India, <?php echo $print_data->branch_name ?> Branch</h4></td>
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
                                        <br>
                                        <table width="100%" style="font-weight: bold;">
                                            <tr>
                                                <td width="40%" style="font-size: 14px;color: #000;padding-left: 5px">Prepared By</td>
                                                <td width="40%" style="font-size: 14px;color: #000;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Manager</td>
                                                <td width="" style="font-size: 14px;color: #000;">Verified By</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                {{--voucher 3--}}
                                <div style="padding-top: 50px">
                                    <div style="border: 2px solid #000;padding-left: 3px;padding-right: 5px;padding-top: 5px;">
                                        <table width="100%">
                                            <tr width="100%">
                                                <td width="25%"></td>
                                                <td width="45%"><h4 style="font-weight: bold;margin: 0px !important;font-size: 16px;">State Bank of India, <?php echo $print_data->branch_name ?> Branch</h4></td>
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
                                        <br>
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
                    </div>
                {{--</div>--}}
            </div>
        </div>
    </section>
    <script>
        window.onload = function () {
            //var css = '@page { size: legal; }';
            var css = '@page { layout: portrait; }',
                head = document.head || document.getElementsByTagName('head')[0],
                style = document.createElement('style');

            style.type = 'text/css';
            style.media = 'print';

            if (style.styleSheet){
                style.styleSheet.cssText = css;
                // style.styleSheet.cssText = c;
            } else {
                style.appendChild(document.createTextNode(css));
                // style.appendChild(document.createTextNode(c));
            }

            head.appendChild(style);
            window.print();
            window.location.href="{{ url("/dollar_endorsement/receive-print/$print_data->id") }}";

        }
    </script>
    <script>
        //window.onload = printDiv('printableArea');
        $(window).on('afterprint', function () {
            //window.location.href="{{ url("/dollar_endorsement") }}";
        });
    </script>



