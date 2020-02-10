<?php $i = 1;
$visa_fee = 0;
$fax = 0;
$icwf_fee = 0;
$visa_app = 0;
$total_tk = 0;
?>
<p align="center" style="padding-bottom: 0px !important;line-height: 0.5em"></p>
<p align="center" style="padding-bottom: 0px !important;"></p>
<p class="text-center" style="text-align: center;padding-bottom: 0px !important;"></p>
<table width="100%">
    <tr>
        <td align="center">INDIAN VISA APPLICATION CENTER</td>
    </tr>
    <tr>
        <td align="center">STATEMENT OF VISA FEE COLLECTION <?php if ($from == $to) {
                echo date('d-m-Y', strtotime($from));
            } else {
                echo 'From ' . date('d-m-y', strtotime($from)) . ' To ' . date('d-m-Y', strtotime($to));
            } ?> <span style="font-size: 9px">TODAY USED RECEIPT (<?php if (isset($receipt) && !empty($receipt)){
                if (isset($receipt) && !empty($receipt)) {
                    foreach ($receipt as $rec) {
                        if ($rec->mini != 'NULL' && $rec->book_no != ' ') {
                            echo '(' . $rec->book_no . ')' . ' ' . $rec->mini . ' - ' . $rec->maxi . '<br>';
                        }
                    }
                }
                } ?></span></td>
    </tr>
</table>
@foreach($results as $dos)
    <table style="border: 1px solid #ddd;font-size: 15px;border-spacing: 0px !important;">
        <thead style="background:#ddd">
        <tr style="border: 1px solid #ddd;">
            <th rowspan="2"></th>
            <th rowspan="2">NAME OF APPLICANT</th>
            <th rowspan="2">PASSPORT</th>
            <th colspan="8" style="text-align: center"> Fee Collected</th>
        </tr>
        <tr style="border: 1px solid #ddd;">
            <th>Nationality</th>
            <th>Receipt No</th>
            <th>Visa Fee</th>
            <th>Fax Trans. Charge</th>
            <th>ICWF</th>
            <th>Visa App. Charge</th>
            <th>Total Amount</th>
            <th>Remarks</th>
        </tr>
        </thead>
        <tbody>
        @foreach($dos as $do)
            <tr style="border: 1px solid #ddd;">
                <td style="border: 1px solid #ddd;">{{$i++}}.</td>
                <td style="border: 1px solid #ddd;">{{$do->app_name}}</td>
                <td style="border: 1px solid #ddd;">{{$do->passport}}</td>
                <td style="border: 1px solid #ddd;">{{$do->nationality}}</td>
                <td style="border: 1px solid #ddd;">{{$do->receive_no}}</td>
                <?php if ($do->gratis_status == 'yes'){ ?>
                <td style="border: 1px solid #ddd;">GRATIS</td>
                <?php }else{ ?>
                <td style="border: 1px solid #ddd;"><span
                            style="float: right;"><?php $visa_fee += round($do->visa_fee, 2); echo round($do->visa_fee, 2); ?></span>
                </td>
                <?php } ?>
                <td style="border: 1px solid #ddd;"><span
                            style="float: right;"><?php $fax += round($do->fax_trans_charge, 2); if ($do->fax_trans_charge == 0 && $do->visa_fee != 0) {
                            echo 'Minor';
                        } else {
                            echo round($do->fax_trans_charge, 2);
                        } ?></span></td>
                <td style="border: 1px solid #ddd;"><span
                            style="float: right;"><?php $icwf_fee += round($do->icwf, 2); echo round($do->icwf, 2)  ?></span>
                </td>
                <td style="border: 1px solid #ddd;"><span
                            style="float: right;"><?php $visa_app += round($do->visa_app_charge, 2); echo round($do->visa_app_charge, 2); ?></span>
                </td>
                <td style="border: 1px solid #ddd;"><span
                            style="float: right;"><?php $total_tk += round($do->total_amount, 2); echo round($do->total_amount, 2); ?></span>
                </td>
                <td style="border: 1px solid #ddd;">{{$do->remarks}}</td>
            </tr>
        @endforeach
        <tr style="border: 1px solid #ddd !important;float: right !important;">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="font-weight: 600;"></td>
            <td style="border: 1px solid #ddd !important;"><span
                        style="float: right;font-weight: 600;"><?php echo number_format(round($visa_fee)); ?></span></td>
            <td style="border: 1px solid #ddd !important;"><span
                        style="float: right;font-weight: 600;"><?php echo number_format(round($fax)); ?></span></td>
            <td style="border: 1px solid #ddd !important;"><span
                        style="float: right;font-weight: 600;"><?php echo number_format(round($icwf_fee)); ?></span></td>
            <td style="border: 1px solid #ddd !important;"><span
                        style="float: right;font-weight: 600;"><?php echo number_format(round($visa_app)); ?></span></td>
            <td style="border: 1px solid #ddd !important;"><span
                        style="float: right;font-weight: 600;"><?php echo number_format(round($total_tk)); ?></span></td>
            <td></td>
        </tr>
        </tbody>
    </table>
    <span style="page-break-after:always;"></span>


@endforeach
