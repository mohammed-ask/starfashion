<?php
include 'main/session.php';
/* @var $obj db */
$id = $_GET['hakuna'];
$obj->saveactivity("Coupon Deleted by Admin", "", $id, $employeeid, "Admin", "Coupon Deleted by Admin");
$res = $obj->delete("coupon", $id);
if ($res == 1) {
    echo "Coupon Deleted Successfully";
}
