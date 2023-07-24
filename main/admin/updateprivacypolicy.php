<?php
include 'main/session.php';
/* @var $obj db */
ob_start();
$sid = $_POST['id'];
$_POST['status'] = 1;
unset($_POST['id']);

$tb_name = "privacy_policy";
$postdata = $_POST;
$ures = $obj->update($tb_name, $postdata, $sid);
if ($ures == 1) {
    echo "Redirect : Privacy Policy has been Updated URLprivacypolicy";
}
