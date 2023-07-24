<?php
include 'main/session.php';
/* @var $obj db */
$id = $_GET['hakuna'];
$obj->saveactivity("Slide Deleted by Admin", "", $id, $employeeid, "Admin", "Slide Deleted by Admin");
$res = $obj->delete("slide", $id);
if ($res == 1) {
    echo "Slide Deleted Successfully";
}
