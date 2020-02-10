<?php $i = 1; ?>
<p align="center" style="padding-bottom: 0px !important;line-height: 0.5em"></p>
<p align="center" style="padding-bottom: 0px !important;"></p>
<p class="text-center" style="text-align: center;padding-bottom: 0px !important;"></p>
<table width="100%">
    <tr>
        <td align="center">INDIAN VISA APPLICATION CENTER</td>
    </tr>
    <tr>
        <td align="center">Port Endorsement Detail Report <?php echo date('d.m.Y', strtotime($from)) ?> - <?php echo date('d.m.Y', strtotime($to)) ?> </td>
    </tr>
</table>
<table width="100%" style="border: 1px solid #ddd;font-size: 11px;border-spacing: 0px !important;">
    <thead style="background:#ddd">
    <tr style="border: 1px solid #ddd;">
        <th>SL</th>
        <th>Applicant name</th>
        <th>Passport</th>
        <th>Center</th>
        <th>Visa no</th>
        <th>Visa type</th>
        <th>Contact</th>
        <th>Receive time</th>
        <th>Receive by</th>
        <th>Fee</th>
        <th>Sticker</th>
        <th>Entry Port</th>
        <th>Exit Port</th>
    </tr>
    </thead>
    <tbody>
    @foreach($results as $do)
        <tr style="border: 1px solid #ddd;">
            <td style="border: 1px solid #ddd;">{{$i++}}.</td>
            <td style="border: 1px solid #ddd;width: 20%;">{{$do->applicant_name}}</td>
            <td style="border: 1px solid #ddd;">{{$do->passport}}</td>
            <td style="border: 1px solid #ddd;">{{$do->center}}</td>
            <td style="border: 1px solid #ddd;">{{$do->visa_no}}</td>
            <td style="border: 1px solid #ddd;">{{$do->visa_type}}</td>
            <td style="border: 1px solid #ddd;">{{$do->contact}}</td>
            <td style="border: 1px solid #ddd;">{{$do->rec_cen_time}}</td>
            <td style="border: 1px solid #ddd;">{{$do->rec_cen_by}}</td>
            <td style="border: 1px solid #ddd;">{{$do->Fee}}</td>
            <td style="border: 1px solid #ddd;">{{$do->sticker}}</td>
            <td style="border: 1px solid #ddd;">{{$do->OldPort}}</td>
            <td style="border: 1px solid #ddd;">{{$do->OldPort}}</td>
        </tr>
    @endforeach
    </tbody>
</table>

