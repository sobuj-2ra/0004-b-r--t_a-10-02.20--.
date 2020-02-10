<?php $i = 1;
$t_usd=0;
$t_com =0;
$t_charge =0;
$t_total=0;
?>
<p align="center" style="padding-bottom: 0px !important;line-height: 0.5em"></p>
<p align="center" style="padding-bottom: 0px !important;"></p>
<p class="text-center" style="text-align: center;padding-bottom: 0px !important;"></p>
<table width="100%">
    <tr>
        <td align="center">INDIAN VISA APPLICATION CENTER</td>
    </tr>
    <tr>
        <td align="center">Dollar Endorsement Detail Report</td>
    </tr>
    <tr>
        <td align="center">From <?php echo date('d-m-Y', strtotime($from)) ?> To <?php echo date('d-m-Y', strtotime($to)) ?></td>
    </tr>
</table>
@foreach($results as $dos)
    <table style="border: 1px solid #ddd;font-size: 12px;border-spacing: 0px !important;">
        <thead style="background:#ddd">
        <tr style="border: 1px solid #ddd;">
            <th>SL</th>
            <th>Applicant name</th>
            <th>Passport</th>
            <th>Card No</th>
            <th>URN</th>
            <th>Registration Number</th>
            <th>Travel Card Amount (USD)</th>
            <th>Commission (USD)</th>
            <th>Service Charge (BDT)</th>
            <th>Total (BDT)</th>
            <th>R. User</th>
            <th>C. Rate</th>
            <th>Date</th>
        </tr>
        </thead>
        <tbody>
        @foreach($dos as $do)
            <tr style="border: 1px solid #ddd;">
                <td style="border: 1px solid #ddd;">{{$i++}}.</td>
                <td style="border: 1px solid #ddd;width: 20%;">{{$do->a_name}}</td>
                <td style="border: 1px solid #ddd;">{{$do->passport_no}}</td>
                <td style="border: 1px solid #ddd;">{{$do->digit}}</td>
                <td style="border: 1px solid #ddd;">{{$do->urn}}</td>
                <td style="border: 1px solid #ddd;">{{$do->serial_number}}</td>
                <td style="border: 1px solid #ddd;"><span style="float: right"><?php $t_usd +=$do->f_currency; echo $do->f_currency; ?></span></td>
                <td style="border: 1px solid #ddd;"><sapn style="float: right;"><?php $t_com +=$do->commission; echo round($do->commission, 2); ?></sapn></td>
                <td style="border: 1px solid #ddd;"><span style="float: right"><?php $t_charge +=$do->s_charge; echo $do->s_charge; ?></span></td>
                <td style="border: 1px solid #ddd;"><span style="float: right"><?php $t_total +=$do->t_amount; echo round($do->t_amount, 2); ?></span></td>
                <td style="border: 1px solid #ddd;">{{$do->created_by}}</td>
                <td style="border: 1px solid #ddd;">{{$do->c_rate}}</td>
                <td style="border: 1px solid #ddd;"><?php echo date('d-m-Y', strtotime($do->created_date)); ?></td>
            </tr>
        @endforeach
        <tr style="border: 1px solid #ddd !important;float: right !important;">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="font-weight: 600;">Total</td>
            <td style="border: 1px solid #ddd !important;"><span style="float: right;font-weight: 600;"><?php echo $t_usd; ?></span></td>
            <td style="border: 1px solid #ddd !important;"><span style="float: right;font-weight: 600;"><?php echo $t_com; ?></span></td>
            <td style="border: 1px solid #ddd !important;"><span style="float: right;font-weight: 600;"><?php echo $t_charge; ?></span></td>
            <td style="border: 1px solid #ddd !important;"><span style="float: right;font-weight: 600;"><?php echo $t_total; ?></span></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        </tbody>
    </table>
    <span style="page-break-after:always;"></span>


@endforeach
