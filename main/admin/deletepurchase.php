<?php
include "session.php";
/* @var $obj db */
ob_start();


$id = $_GET['hakuna'];
$res = $obj->delete("purchase_order", $id);
$res = $obj->deletewhere("purchase_order_item", "purchase_order_id=$id");
$product_tax = $obj->selectfield("purchase_order_item", "product_tax_id", "purchase_order_id", $id);
// $res = $obj->deletewhere("product_tax", "id=$product_tax");

echo "Purchase Order Deleted Successfully";
