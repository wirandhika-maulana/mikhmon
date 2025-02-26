<?php
session_start();
// HIDE SEMUA LOG ERROR BIAR LOG GA DI TAMPILIN DI USER
error_reporting(0);
if (!isset($_SESSION["mikhmon"])) {
    header("Location:../admin.php?id=login");
} else {

    $getprofile = $API->comm("/ppp/profile/print");
    // $getbridge = $API->comm("/bridge/bridge/print");
    date_default_timezone_set('Asia/Jakarta');
    $hariini = strtolower(date('M/d/Y H:i:s'));

    if (isset($_POST['name'])) {
        $name = (preg_replace('/\s+/', '-', $_POST['name']));
        $password = ($_POST['password']);
        $service = ($_POST['service']);
        $callerid = ($_POST['callerid']);
        $profile = ($_POST['profile']);
        $localaddress = ($_POST['local-address']);
        $remoteaddress = ($_POST['remote-address']);
        $interval = ($_POST['interval']);
        date_default_timezone_set('Asia/Jakarta');
        $hari = date('d/M/Y');
        $hariini = strtolower(date('M/d/Y H:i:s'));

        // $namesch = "PPP Secret Disabled " . $hariini;
        $start_date = date('M/d/Y');
        $start_time = date('H:i:s');
        // $interval = "00:00:30";
        // $on_event = "/ppp secret set disabled=yes [/ppp secret find name=" . $name . "] \r /system scheduler remove [find name=" . $name . "]";
        $on_event = "/ppp secret set disabled=yes [/ppp secret find name=" . $name . "] \r /system scheduler disable [find name=" . $name . "]";

        $API->comm("/ppp/secret/add", array(
            /*"add-mac-cookie" => "yes",*/
            "name" => "$name",
            "password" => "$password",
            "service" => "$service",
            "caller-id" => "$callerid",
            "profile" => "$profile",
            "local-address" => "$localaddress",
            "remote-address" => "$remoteaddress",
        ));

        $API->comm("/system/scheduler/add", array(
            /*"add-mac-cookie" => "yes",*/
            "name" => "$name",
            "start-date" => "$start_date",
            "start-time" => "$start_time",
            "interval" => "$interval",
            "on-event" => "$on_event",
        ));

        echo "<script>window.location='./?ppp=secrets&session=" . $session . "'</script>";
    }
}
?>
<div class="row">
    <div class="col-8">
        <div class="card box-bordered">
            <div class="card-header">
                <h3><i class="fa fa-plus"></i> Add PPP Secrets <small id="loader" style="display: none;"><i><i
                                class='fa fa-circle-o-notch fa-spin'></i> Processing... </i></small></h3>
            </div>
            <div class="card-body">
                <form autocomplete="off" method="post" action="">
                    <div>
                        <a class="btn bg-warning" href="./?ppp=secrets&session=<?= $session; ?>"> <i
                                class="fa fa-close btn-mrg"></i> <?= $_close ?></a>
                        <button type="submit" name="save" class="btn bg-primary btn-mrg"><i
                                class="fa fa-save btn-mrg"></i> <?= $_save ?></button>
                    </div>
                    <table class="table">
                        <tr>
                            <td class="align-middle"><?= $_name ?></td>
                            <td><input class="form-control" type="text" onchange="remSpace();" autocomplete="off"
                                    name="name" value="" required="1" autofocus></td>
                        </tr>
                        <tr>
                            <td class="align-middle">Password</td>
                            <td><input class="form-control" type="text" size="4" autocomplete="off" name="password">
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle">Service</td>
                            <td>
                                <select class="form-control" name="service" required="1">
                                    <option value="any">any</option>
                                    <option value="async">async</option>
                                    <option value="l2tp">l2tp</option>
                                    <option value="ovpn">ovpn</option>
                                    <option value="pppoe">pppoe</option>
                                    <option value="pptp">pptp</option>
                                    <option value="sstp">sstp</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle">Caller ID</td>
                            <td><input class="form-control" type="text" size="4" autocomplete="off" name="callerid">
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle">Profile</td>
                            <td>
                                <select class="form-control" name="profile" required="1">
                                    <?php
                                    $TotalReg = count($getprofile);
                                    for ($i = 0; $i < $TotalReg; $i++) {
                                        echo "<option>" . $getprofile[$i]['name'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle">Local Address</td>
                            <td><input class="form-control" type="text" size="4" autocomplete="off" name="localaddress">
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle">Remote Address</td>
                            <td><input class="form-control" type="text" size="4" autocomplete="off" name="remoteaddress">
                            </td>
                        </tr>
                        <hr />
                        <tr>
                            <td class="align-middle">Interval</td>
                            <td><input class="form-control" placeholder="example : 30d" type="text" size="4"
                                    autocomplete="off" name="interval"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
function remSpace() {
    var upName = document.getElementsByName("name")[0];
    var newUpName = upName.value.replace(/\s/g, "-");
    //alert("<?php if ($currency == in_array($currency, $cekindo['indo'])) {
    echo "Nama Profile tidak boleh berisi spasi";
} else {
    echo "Profile name can't containing white space!";
} ?>
");
upName.value = newUpName;
upName.focus();
}
</script>