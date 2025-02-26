																																																																														<?php
if (substr($validity, -1) == "d") {
    $validity = "AKTIF:" . substr($validity, 0, -1) . "HARI";
} else if (substr($validity, -1) == "h") {
    $validity = "AKTIF:" . substr($validity, 0, -1) . "JAM";
}
if (substr($timelimit, -1) == "d" & strlen($timelimit) > 3) {
    $timelimit = "Durasi:" . ((substr($timelimit, 0, -1) * 7) +  substr($timelimit, 2, 1)) . "HARI";
} else if (substr($timelimit, -1) == "d") {
    $timelimit = "Durasi:" . substr($timelimit, 0, -1) . "HARI";
} else if (substr($timelimit, -1) == "h") {
    $timelimit = "Durasi:" . substr($timelimit, 0, -1) . "JAM";
} else if (substr($timelimit, -1) == "w") {
    $timelimit = "Durasi:" . (substr($timelimit, 0, -1) * 7) . "HARI";
}

if ($getprice == "2000") {
    $net = "
    border:none;
    width: 350px;
    height:50px;
    background: url('../img/3000.png') no-repeat;
    background-size:contain;
    ";
} elseif ($getprice == "4000") {
    $net = "
    border:none;
    width: 350px;
    height:50px;
    background: url('../img/5000.png') no-repeat;
    background-size:contain;
    ";
} elseif ($getprice == "9000") {
    $net = "
    border:none;
    width: 350px;
    height:50px;
    background: url('../img/10000.png') no-repeat;
    background-size:contain;
    ";
} elseif ($getprice == "19000") {
    $net = "
	border:none;
    width: 350px;
    height:50px;
    background: url('../img/20000.png') no-repeat;
    background-size:contain;
    ";
} elseif ($getprice == "45000") {
    $net = "
    border:none;
    width: 350px;
    height:50px;
    background: url('../img/50000.png') no-repeat;
    background-size:contain;
    ";
}
?>

<tr>
    <td style="color:#666;border-collapse: collapse;" valign="top">
        <table class="voucher" style="<?php echo $net ?>">
            <tbody>
                <tr>
                    <td style="width:92px" valign="top">
                        <div style="clear:both;color:#fff;margin-top: 16px;margin-bottom:8px;">
                            <?php if ($v_opsi == 'up') { ?>
                            <?php } else { ?>
                                <div style="font-weight:bold;font-size:14px;">
									<center><?php echo $username; ?></center>
								</div>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </td>
</tr>	        	        	        	        	      	        	        	        	        	        	        	        	        