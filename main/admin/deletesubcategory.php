<?php
include 'main/session.php';
/* @var $obj db */
$id = $_GET['hakuna'];
$obj->saveactivity("Subcategory Deleted by Admin", "", $id, $employeeid, "Admin", "Subcategory Deleted by Admin");
$res = $obj->delete("subcategories", $id);
if ($res == 1) {
    echo "Subcategory Deleted Successfully";
}
