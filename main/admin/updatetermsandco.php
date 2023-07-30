<?php
include 'main/session.php';
/* @var $obj db */
// echo "<pre>";
// print_r($_POST);
// die;
ob_start();
$sid = $_POST['id'];
$_POST['status'] = 1;
unset($_POST['id']);

$tb_name = "terms_condition";
$postdata = $_POST;
$ures = $obj->update($tb_name, $postdata, $sid);
if ($ures == 1) {
    echo "Redirect : Terms and Condition has been Updated URLtermsandco";
}
