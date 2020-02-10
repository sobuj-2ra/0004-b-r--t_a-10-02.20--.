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
    <table width="100%" style="border: 1px solid #ddd;font-size: 15px;border-spacing: 0px !important;">
        <thead style="background:#ddd">
        <tr style="border: 1px solid #ddd;">
            <th>SL</th>
            <th>Referred ID</th>
            <th>Name</th>
            <th>Designation</th>
            <th>Passport</th>
            <th>Card Number</th>
            <th>URN</th>
            <th>Date</th>
        </tr>
        </thead>
        <tbody>
        @foreach($dos as $do)
            <tr style="border: 1px solid #ddd;">
                <?php $referrer = DB::table('tbl_dollarendorsement_reference')->where('refer_id', $do->refer_id)->first();
                ?>
                    <td style="border: 1px solid #ddd;">{{$i++}}.</td>
                    <td style="border: 1px solid #ddd;">{{$do->refer_id}}</td>
                    <td style="border: 1px solid #ddd;"><?php if (isset($referrer) && !empty($referrer)){ echo $referrer->name; } ?></td>
                    <td style="border: 1px solid #ddd;"><?php if (isset($referrer) && !empty($referrer)){ echo $referrer->designation; } ?></td>
                    <td style="border: 1px solid #ddd;">{{$do->passport_no}}</td>
                    <td style="border: 1px solid #ddd;">{{$do->digit}}</td>
                    <td style="border: 1px solid #ddd;">{{$do->urn}}</td>
                    <td style="border: 1px solid #ddd;"><?php echo date('d-m-Y', strtotime($do->created_date)); ?></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <span style="page-break-after:always;"></span>


@endforeach
