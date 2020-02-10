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
        <td align="center">Foreign Passport Detail Report <?php if ($from == $to){ echo date('d-m-Y', strtotime($from)); }else{ echo date('d.m.Y', strtotime($from)).'-'.date('d.m.Y', strtotime($to)); }  ?>  </td>
    </tr>
</table>
<table style="border: 1px solid #ddd;font-size: 15px;border-spacing: 0px !important;" width="100%">
    <thead style="background:#ddd">
    <tr style="border: 1px solid #ddd;">
        <th>Date</th>
        <th>Quantity</th>
    </tr>
    </thead>
    <tbody>
    <?php $total = 0; ?>
    @foreach($results as $do)
        <tr style="border: 1px solid #ddd;">
            <td style="border: 1px solid #ddd;"><?php echo date('d-m-Y', strtotime($do->created_date)) ?></td>
            <td style="border: 1px solid #ddd;"><?php $total += $do->count_row; echo $do->count_row; ?></td>
        </tr>
    @endforeach
    <tr style="border: 1px solid #ddd !important;float: right !important; font-weight: bold;">
        <td style="border: 1px solid #ddd;">Total</td>
        <td style="border: 1px solid #ddd;">{{$total}}</td>
    </tr>
    </tbody>
</table>

