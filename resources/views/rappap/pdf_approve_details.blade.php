<?php $i = 1; ?>
<table width="100%">
    <tr>
        <td align="center">INDIAN VISA APPLICATION CENTER</td>
    </tr>
    <tr>
        <td align="center">R.A.P / P.A.P Approve Detail Report</td>
    </tr>
    <tr>
        <td align="center">From <?php echo date('d-m-Y', strtotime($from)) ?> To <?php echo date('d-m-Y', strtotime($to)) ?></td>
    </tr>
</table>
@foreach($results as $dos)
    <table style="border: 1px solid #ddd;font-size: 11px;border-spacing: 0px !important;">
        <thead style="background:#ddd">
        <tr style="border: 1px solid #ddd;">
            <th>SL</th>
            <th>Applicant name</th>
            <th>Passport</th>
            <th>Center</th>
            <th>Visa no</th>
            <th>Visa type</th>
            <th>Contact</th>
            <th>Approval Status</th>
            <th>Approve Date</th>
            <th>Approve By</th>
            <th>Master Passport</th>
            <th>Sticker</th>
            <th>Entry port</th>
            <th>Area</th>
            <th>Exit port</th>
            <th>Mode</th>
        </tr>
        </thead>
        <tbody>
        @foreach($dos as $do)
            <tr style="border: 1px solid #ddd;">
                <td style="border: 1px solid #ddd;">{{$i++}}.</td>
                <td style="border: 1px solid #ddd;padding: 2px">{{$do->applicant_name}}</td>
                <td style="border: 1px solid #ddd;padding: 2px">{{$do->passport}}</td>
                <td style="border: 1px solid #ddd;padding: 2px">{{$do->center}}</td>
                <td style="border: 1px solid #ddd;padding: 2px">{{$do->visa_no}}</td>
                <td style="border: 1px solid #ddd;padding: 2px">{{$do->visa_type}}</td>
                <td style="border: 1px solid #ddd;padding: 2px">{{$do->contact}}</td>
                <td style="border: 1px solid #ddd;padding: 2px">{{$do->approve_status}}</td>
                <td style="border: 1px solid #ddd;padding: 2px"><?php echo date('d-m-Y', strtotime($do->approve_date)) ?></td>
                <td style="border: 1px solid #ddd;padding: 2px">{{$do->approve_by}}</td>
                <td style="border: 1px solid #ddd;padding: 2px">{{$do->MasterPP}}</td>
                <td style="border: 1px solid #ddd;padding: 2px">{{$do->sticker}}</td>
                <td style="border: 1px solid #ddd;padding: 2px">{{$do->OldPort}}</td>
                <td style="border: 1px solid #ddd;padding: 2px">{{$do->area}}</td>
                <td style="border: 1px solid #ddd;padding: 2px">{{$do->OldPort}}</td>
                <td style="border: 1px solid #ddd;padding: 2px">{{$do->mode}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <span style="page-break-after:always;"></span>


@endforeach
