<?php
include 'main/session.php';
/* @var $obj db */
$id = $_GET['hakuna'];
$obj->saveactivity("Privacy Policy Deleted by Admin", "", $id, $employeeid, "Admin", "Privacy Policy Deleted by Admin");
$res = $obj->delete("privacy_policy", $id);
if ($res == 1) {
    echo "Contact Us Deleted Successfully";
}
