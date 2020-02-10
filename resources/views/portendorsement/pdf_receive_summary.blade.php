<?php $i = 1; ?>
<table width="100%">
    <tr>
        <td align="center" style="font-size: 17px; font-weight: bold;">INDIAN VISA APPLICATION CENTER</td>
    </tr>
    <tr>
        <td align="center">{{$ServiceType}} SUMMARY REPORT - {{$user_id}}</td>
    </tr>
    <tr>
        <td align="center">From <?php echo date('d-m-Y', strtotime($from)) ?> To <?php echo date('d-m-Y', strtotime($to)) ?></td>
    </tr>
</table>
@foreach($results as $dos)
    <table style="border: 1px solid #ddd;font-size: 15px;border-spacing: 0px !important;width: 100%">
        <thead style="background:#ddd">
        <tr style="border: 1px solid #ddd;">
            <th>SL</th>
            <th>Date</th>
            <th>Quantity</th>
        </tr>
        </thead>
        <tbody>
        @foreach($dos as $do)
            <tr style="border: 1px solid #ddd;">
                <td style="border: 1px solid #ddd;width: 10%;padding: 5px">{{$i++}}.</td>
                <td style="border: 1px solid #ddd;width: 20%;width: 40%;padding: 5px"><?php echo date('d-m-Y', strtotime($do->rec_cen_time)); ?></td>
                <td style="border: 1px solid #ddd;padding: 5px">{{$do->count_row}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <span style="page-break-after:always;"></span>


@endforeach
