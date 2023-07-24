<?php
include 'main/session.php';
/* @var $obj db */
$id = $_GET['hakuna'];
$obj->saveactivity("Terms and Condition Deleted by Admin", "", $id, $employeeid, "Admin", "Terms and Condition Deleted by Admin");
$res = $obj->delete("contact_us", $id);
if ($res == 1) {
    echo "Terms and Condition Deleted Successfully";
}
