<?php $i = 1;
$qty = 0;
$t_dollar = 0;
$t_bdt = 0;
$t_charge = 0;
$t_collect = 0;
$t_com =0;
?>

<table width="100%">
    <tr>
        <td align="center">INDIAN VISA APPLICATION CENTER</td>
    </tr>
    <tr>
        <td align="center">Dollar Endorsement Summary Report</td>
    </tr>
    <tr>
        <td align="center">From <?php echo date('d-m-Y', strtotime($from)) ?> To <?php echo date('d-m-Y', strtotime($to)) ?></td>
    </tr>
</table>

@foreach($results as $dos)
    <table style="border: 1px solid #ddd;font-size: 13px;border-spacing: 0px !important;width: 100%;">
        <thead style="background:#ddd">
        <tr style="border: 1px solid #ddd;">
            <th>SL</th>
            <th>Date</th>
            <th>Receiving User</th>
            <th>Total Number of Card</th>
            <th>Card Amount(USD)</th>
            <th>Commission(USD)</th>
            <th>Total Service Charge(BDT)</th>
            <th>Total BDT</th>
        </tr>
        </thead>
        <tbody>

        @foreach($dos as $detail)
            <tr style="border: 1px solid #ddd;">
                <td style="border: 1px solid #ddd;">{{$i++}}.</td>
                <td style="border: 1px solid #ddd;"><?php echo date('d-m-Y', strtotime($detail->created_date)) ?></td>
                <td style="border: 1px solid #ddd;">{{$detail->created_by}}</td>
                <td style="border: 1px solid #ddd;"><span style="float: right"><?php $qty+=$detail->count_row; echo $detail->count_row; ?></span></td>
                <td style="border: 1px solid #ddd;"><span style="float: right"><?php $t_dollar+=$detail->dollar; echo $detail->dollar; ?></span></td>
                <td style="border: 1px solid #ddd;"><span style="float: right"><?php $t_com +=$detail->comm; echo round($detail->comm, 2); ?></span></td>
                <td style="border: 1px solid #ddd;"><sapn style="float: right;"><?php $t_charge+=$detail->charge; echo round($detail->charge, 2); ?></sapn></td>
                <td style="border: 1px solid #ddd;width: 20%"><span style="float: right"><?php $t_collect+=$detail->total; echo round($detail->total, 2); ?></span></td>
            </tr>
        @endforeach
        <tr style="border: 1px solid #ddd !important;float: right !important;">
            <td></td>
            <td></td>
            <td style="font-weight: 600;">Total</td>
            <td style="font-weight: 600;border: 1px solid #ddd !important;"><span style="float: right;font-weight: 600;">{{$qty}}</span></td>
            <td style="border: 1px solid #ddd !important;"><span style="float: right;font-weight: 600;">USD {{$t_dollar}}</span></td>
            <td style="border: 1px solid #ddd !important;"><span style="float: right;font-weight: 600;">BDT <?php echo round($t_com, 2) ?></span></td>
            <td style="border: 1px solid #ddd !important;"><span style="float: right;font-weight: 600;">BDT <?php echo round($t_charge, 2) ?></span></td>
            <td style="border: 1px solid #ddd !important;"><span style="float: right;font-weight: 600;">BDT <?php echo round($t_collect, 2) ?> </span></td>
        </tr>
        </tbody>
    </table>
    <span style="page-break-after:always;"></span>


@endforeach
