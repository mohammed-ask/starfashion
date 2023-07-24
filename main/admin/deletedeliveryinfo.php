<?php
include 'main/session.php';
/* @var $obj db */
$id = $_GET['hakuna'];
$obj->saveactivity("Return Deleted by Admin", "", $id, $employeeid, "Admin", "Return Deleted by Admin");
$res = $obj->delete("delivery_information", $id);
if ($res == 1) {
    echo "Return Deleted Successfully";
}
