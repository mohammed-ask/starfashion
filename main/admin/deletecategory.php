<?php
include 'main/session.php';
/* @var $obj db */
$id = $_GET['hakuna'];
$obj->saveactivity("Category Deleted by Admin", "", $id, $employeeid, "Admin", "Category Deleted by Admin");
$res = $obj->delete("categories", $id);
if ($res == 1) {
    echo "Category Deleted Successfully";
}
