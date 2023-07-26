<?php

include "main/session.php";
//var obj
// echo "<pre>";
// print_r($_POST);
// die;
$currency = $_POST["currency"][0];
$common_data['added_on'] = date('Y-m-d H:i:s');
$common_data['added_by'] = $employeeid;
$common_data['updated_on'] = date('Y-m-d H:i:s');
$common_data['updated_by'] = $employeeid;
$common_data['status'] = 1;

// Purchase Order Data Add
$date = $purchase_order["date"] = changedateformate($_POST["date"]);


$purchase_order["customer_id"] = $_POST["customer_id"];
$purchase_order["po_number"] = $_POST['po_number'];
// $purchase_order["delivery_terms"] = $_POST["delivery_terms"];
// $purchase_order["payment_terms"] = $_POST["payment_terms"];
// $purchase_order["quotationno"] = $_POST["quotationno"];
// $purchase_order["quotationdate"] = changedateformate($_POST["quotationdate"]);
// $purchase_order["ordertype"] = $_POST["ordertype"];
// $purchase_order["bill_and_consign_to"] = $_POST["bill_and_consign_to"];
$purchase_order["sname"] = $_POST["sname"];
$purchase_order["saddress"] = $_POST["saddress"];
$purchase_order["sphone"] = $_POST["sphone"];
$purchase_order["designation"] = $_POST["designation"];
$purchase_order["semail"] = $_POST["semail"];
$purchase_order["subtotal"] = $_POST["subtotal"];
// $purchase_order["product_tax_id"] = $tax_id;
// $purchase_order["cgst"] = $_POST["cgst"];
// $purchase_order["sgst"] = $_POST["sgst"];
// $purchase_order["igst"] = $_POST["igst"];
// $purchase_order["igst"] = $_POST["igst"];
$purchase_order["packaginchrgs"] = $_POST["packaginchrgs"];
$purchase_order["freightchrgs"] = $_POST["freightchrgs"];
$purchase_order["insurancechrgs"] = $_POST["insurancechrgs"];
$purchase_order["calibrationchrgs"] = $_POST["calibrationchrgs"];
$purchase_order["trainingchrgs"] = $_POST["trainingchrgs"];
$purchase_order["totaltaxamount"] = $_POST["totaltaxamount"];
$purchase_order["total_amount"] = $_POST["totalinvoiceamount"];
$purchase_order["finaltotal"] = $_POST["finaltotal"];
$purchase_order["customdutychrgs"] = $_POST["customdutychrgs"];
$purchase_order["roundoff"] = $_POST["roundoff"];
// $purchase_order["otherdetails"] = $_POST["otherdetails"];
// $purchase_order["warranty"] = $_POST["warranty"];
// $purchase_order["jurisdiction"] = $_POST["jurisdiction"];
$purchase_order["currency"] = $currency;
$purchase_order["totalafterdisc"] = $_POST["totalafterdisc"];
$purchase_order["discount"] = $_POST["discount"];
$purchase_order["cgst"] = $_POST["cgst"];
$purchase_order["sgst"] = $_POST["sgst"];
$purchase_order["igst"] = $_POST["igst"];

$common_data['status'] = -1;

$purchase_order = $purchase_order + $common_data;

$tb_name = "purchase";
$pradin = $obj->insertnew($tb_name, $purchase_order);
// purchase_order ID

$purchase_order_id = $pradin;

// Add Product Details Data
$product_item = array();
foreach ($_POST["subcategory_id"] as $key => $value) {
    $x = array();
    $x = $common_data;
    $x['subcategory_id'] = $value;
    $x['name'] = $obj->selectfieldwhere("subcategories", "name", "id" . $value . "");
    if (isset($_POST['itemname'][$key])) {
        $x["itemname"] = $_POST['itemname'][$key];
    }
    if (isset($_POST['unit'][$key])) {
        $x["unit"] = $_POST['unit'][$key];
    }
    $x['quantity'] = $_POST["quantity"][$key];
    $x['discount'] = $_POST["discountperitem"][$key];
    // $val4 = $_POST["taxable"][$key];
    // if ($_POST["ordertype"] == "WO") {
    //     $x['tax_rate'] = $_POST["tax_rate"][$key] . "%";
    // } else {
    $x['tax_rate'] = $_POST["tax_rate"][$key];
    // }
    $x['specification'] = $_POST["specification"][$key];
    $x['hsn_code'] = $_POST["hsn_code"][$key];
    $x['list_price'] = $_POST["list_price"][$key];
    $x['price'] = $_POST["price"][$key];
    // $val10 = $_POST["indent_item_id"][$key];
    $x['cgstamount'] = $_POST["cgstamount"][$key];
    $x['sgstamount'] = $_POST["sgstamount"][$key];
    $x['igstamount'] = $_POST["igstamount"][$key];
    $x['cgstper'] = $_POST["cgstper"][$key];
    $x['sgstper'] = $_POST["sgstper"][$key];
    $x['igstper'] = $_POST["igstper"][$key];
    $x['totaltaxamountitem'] = $_POST["totaltaxamountitem"][$key];
    $x['currency'] = $_POST["currency"][$key];
    $x['finalamount'] = $_POST["finalamount"][$key];
    $x['taxableamount'] = $_POST["taxableamount"][$key];
    $x['purchase_order_id'] = $purchase_order_id;
    $obj->insertnew("purchase_item", $x);
    unset($x);
}
if (is_integer($pradin) && $pradin > 0) {
    echo "Redirect : New Purchase has been Added URLpurchase";
} else {
    echo "Some Error Occured";
}
