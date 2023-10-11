<?php
session_start();
// ini_set('display_errors', 1);
// error_reporting(E_ALL);

include './function.php';
include './conn.php';

// echo "<pre>";
// print_r($_POST);
// die;

if ($_SESSION['otp'] != $_POST['otp']) {
    echo "Failed";
} else {

    $emailcount = $obj->selectfieldwhere('users', "count(id)", "email='" . $_POST['email'] . "' and status != 99");
    $empcode = $obj->selectfieldwhere('users', 'count(id)', 'uniqueid="' . trim($_POST['employeeref']) . '" and type = 1');
    if ($emailcount > 0) {
        echo "Already Exists";
    } elseif ($empcode != 1 && !empty($_POST['employeeref'])) {
        echo "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative' role='alert'>Sorry! Referral ID Does Not Match With Our Existing Clients  </div>";
    } else {

        $x = array();
        $tb_name = 'users';
        $result4 = $obj->selectextrawhere('codegenerator', "`category` like 'usercode'");
        $num4 = $obj->total_rows($result4);
        $codegeneratorid = 0;
        $codenumber = 0;
        if ($num4) {
            $row4 = $obj->fetch_assoc($result4);
            $codegeneratorid = $row4['id'];
            $codenumber = $row4['number'] + 1;
            $generatedcode = sprintf('%04d', $codenumber);
            // $month = strtoupper(date("M", strtotime($date)));
            $uniqueid = str_replace(array("{prefix}", "{number}"), array($row4['prefix'], $generatedcode), $row4['pattern']);
        } else {
            $cg['prefix'] = "FL/US/";
            $cg['number'] = 0;
            $cg['pattern'] = "{prefix}{number}";
            $cg['category'] = "usercode";
            $cg['addedon'] = date("Y-m-d H:i:s");
            $cg['addedby'] = 0;
            $cg['status'] = 1;
            $codegeneratorid = $obj->insertnew("codegenerator", $cg);
            $codenumber = 1;
            $generatedcode = sprintf('%04d', $codenumber);
            $uniqueid = str_replace(array("{prefix}", "{number}"), array($cg['prefix'], $generatedcode), $cg['pattern']);
        }
        $n['number'] = $codenumber;
        $obj->update("codegenerator", $n, $codegeneratorid);
        $x['uniqueid'] = $uniqueid;
        $x['added_on'] = date('Y-m-d H:i:s');
        $x['updated_on'] = date('Y-m-d H:i:s');
        $x['status'] = 0;
        $x['name'] = ucwords($_POST['username']);
        $x['email'] = $_POST['email'];
        $x['mobile'] = $_POST['mobileno'];
        $x['address'] = $_POST['address'];
        $x['refid'] = $_POST['employeeref'];
        $x['password'] = $_POST['password'];
        $x['country_id'] = $_POST['country'];
        $x['address'] = $_POST['address'] . ' ' . $_POST['address2'];
        $x['zip'] = $_POST['zip'];
        $x['city'] = $_POST['city'];
        $x['state'] = $obj->selectfieldwhere("state_list", "state", "id=" . $_POST['ship_state'] . "");
        $x['type'] = 'client';
        $x['role'] = 2;
        $userid = $obj->insertnew($tb_name, $x);

        $jk['ship_country'] = $obj->selectfieldwhere("country", "country_name", "id=" . $_POST['country'] . "");
        $jk['ship_adress1'] = $_POST['address'];
        $jk['ship_adress2'] = $_POST['address2'];
        $jk['ship_zip_code'] = $_POST['zip'];
        $jk['ship_city'] = $_POST['city'];
        $jk['ship_state'] = $_POST['ship_state'];
        $jk['ship_contact_phone'] = $_POST['mobileno'];
        $jk['added_on'] = date("Y-m-d H:i:s");
        $jk['added_by'] = 0;
        $jk['updated_on'] = date("Y-m-d H:i:s");
        $jk['updated_by'] = 0;
        $jk['status'] = 1;
        $jk['userid'] = $userid;
        $obj->insertnew('shipping_address', $jk);
        $obj->saveactivity("Customer Registered", "", $userid, $userid, "User", "Customer Registered");
        echo "Success";
    }
}
