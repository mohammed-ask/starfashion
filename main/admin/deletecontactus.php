<?php
include 'main/session.php';
/* @var $obj db */
$id = $_GET['hakuna'];
$obj->saveactivity("Contact us Deleted by Admin", "", $id, $employeeid, "Admin", "Contact us Deleted by Admin");
$res = $obj->delete("contact_us", $id);
if ($res == 1) {
    echo "Contact Us Deleted Successfully";
}
