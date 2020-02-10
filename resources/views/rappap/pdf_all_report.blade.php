<?php $i = 0;  ?>
<table width="100%">
    <tr>
        <td align="center">INDIAN VISA APPLICATION CENTER</td>
    </tr>
    <tr>
        <td align="center">R.A.P./P.A.P. All Summary Report-<?php echo $approve_status; ?></td>
    </tr>
    <tr>
        <td align="center">From <?php echo date('d-m-Y', strtotime($from_date)) ?>
            To <?php echo date('d-m-Y', strtotime($to)) ?></td>
    </tr>
</table>

<table style="border: 1px solid #ddd;font-size: 13px;border-spacing: 0px !important;width: 100%">
    <thead style="background:#ddd">
    <tr style="border: 1px solid #ddd;">
        <th>SL</th>
        <th>Date</th>
        <?php if ($approve_status == 'all'){ ?>
        <th>Approved</th>
        <th>Rejected</th>
        <th>Pending</th>
        <?php }else if ($approve_status == 'Approved'){ ?>
        <th>Approved</th>
       <?php }elseif($approve_status == 'Rejected'){ ?>
        <th>Rejected</th>
        <?php }else if ($approve_status == 'Pending'){ ?>
        <th>Pending</th>
        <?php } ?>

    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($results as $result) {
        foreach ($result as $r) { $i++; ?>
            <tr>
                <td style="border: 1px solid #ddd;">{{$i}}</td>
                <td style="border: 1px solid #ddd;"><?php echo date('d-m-Y', strtotime($r->a_date)) ?></td>
                <?php if ($approve_status == 'all'){ ?>
                <td style="border: 1px solid #ddd;"><?php echo $r->accept_total; ?></td>
                <td style="border: 1px solid #ddd;"><?php echo $r->reject_total; ?></td>
                <td style="border: 1px solid #ddd;"><?php echo $r->pending_total; ?></td>
                <?php }else if ($approve_status == 'Approved'){ ?>
                <td style="border: 1px solid #ddd;"><?php echo $r->accept_total; ?></td>
                <?php }elseif($approve_status == 'Rejected'){ ?>
                <td style="border: 1px solid #ddd;"><?php echo $r->reject_total; ?></td>
                <?php }else if ($approve_status == 'Pending'){ ?>
                <td style="border: 1px solid #ddd;"><?php echo $r->pending_total; ?></td>
                <?php } ?>

            </tr>
        <?php }
    }
    ?>
    </tbody>
</table>
{{--<span style="page-break-after:always;"></span>--}}
