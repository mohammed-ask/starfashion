<?php
include 'main/session.php';
/* @var $obj db */
$id = $_GET['hakuna'];
$obj->saveactivity("About us Deleted by Admin", "", $id, $employeeid, "Admin", "About us Deleted by Admin");
$res = $obj->delete("about", $id);
if ($res == 1) {
    echo "Subcategory Deleted Successfully";
}
