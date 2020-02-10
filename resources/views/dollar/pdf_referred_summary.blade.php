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
    <table style="border: 1px solid #ddd;font-size: 15px;border-spacing: 0px !important;width: 100%;">
        <thead style="background:#ddd">
        <tr style="border: 1px solid #000;">
            <th>SL</th>
            <th>Referer ID</th>
            <th>Name</th>
            <th>Designation</th>
            <th>Total Number of Card</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($refer_id == 'all') {
            $refferer = DB::table('tbl_dollarendorsement_reference')->get();
        } else {
            $refferer = DB::table('tbl_dollarendorsement_reference')->where('refer_id', $refer_id)->get();
        }
        $i=0;

        foreach ($refferer as $refer) { $i++;
        $result = DB::select("SELECT refer_id, COUNT(refer_id) as count_row FROM `tbl_dollar_endorsement` WHERE refer_id = '$refer->refer_id' AND date(`created_date`) >= '$from' AND date(`created_date`) <= '$to'");
        ?>
        <tr>
            <td style="border: 1px solid #000;"><?php echo $i; ?></td>
            <td style="border: 1px solid #000;"><?php echo $refer->refer_id ?></td>
            <td style="border: 1px solid #000;"><?php echo $refer->name ?></td>
            <td style="border: 1px solid #000;"><?php echo $refer->designation ?></td>
            <td style="border: 1px solid #000;"><?php echo $result[0]->count_row; ?></td>
        </tr>
        <?php
        }
        ?>
        </tbody>
    </table>

