<?php
include 'main/session.php';
/* @var $obj db */
ob_start();
$sid = $_POST['id'];
$_POST['status'] = 1;
unset($_POST['id']);

$tb_name = "returns";
$postdata = $_POST;
$ures = $obj->update($tb_name, $postdata, $sid);
if ($ures == 1) {
    echo "Redirect : Return Policy has been Updated URLreturn";
}
