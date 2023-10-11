<?php
include './main/function.php';
include './main/conn.php';
// print_r($_POST);
// die;
$statecode = $obj->selectfieldwhere('state_list', 'gst_code', 'state="' . $_POST['state'] . '"');
// echo $statecode;
// die;
// Generate the order ID
$orderID = generateOrderID($customerid, $_POST['total']);
$date = date('Y-m-d');
$result4 = $obj->selectextrawhere('fiscyearcodegenerator', "`category` like 'invoice' and '$date' between startdate and enddate");
$num4 = $obj->total_rows($result4);
$invoice = "";
// $fulldate = $day . $month . $year;
if ($num4) {
    $row4 = $obj->fetch_assoc($result4);
    $codegeneratorid = $row4['id'];
    $codenumber = $row4['number'] + 1;
    $generatedcode = sprintf('%03d', $codenumber);
    $invoice = str_replace(array("{prefix}", "{year}", "{fulldate}", "{number}"), array($row4['prefix'], getFinancialYear($date), date("dmY", strtotime($date)), $generatedcode), $row4['pattern']);
} else {
    $cg['prefix'] = "SF";
    $cg['number'] = 0;
    $cg['pattern'] = "{prefix}/{year}/{fulldate}/{number}";
    $cg['category'] = "invoice";
    $fsed = getfirstandlastday($date);
    $cg['startdate'] = $fsed['startdate'];
    $cg['enddate'] = $fsed['enddate'];
    $cg['addedon'] = date("Y-m-d H:i:s");
    // $cg['addedby'] = $employeeid;
    $cg['status'] = 1;
    $codegeneratorid = $obj->insertnew("fiscyearcodegenerator", $cg);
    $codenumber = 1;
    $generatedcode = sprintf('%03d', $codenumber);
    $invoice = str_replace(array("{prefix}", "{year}", "{fulldate}", "{number}"), array($cg['prefix'], getFinancialYear($date), date("dmY", strtotime($date)), $generatedcode), $cg['pattern']);
}
$n['number'] = $codenumber;
$obj->update("fiscyearcodegenerator", $n, $codegeneratorid);
$tt['added_on'] = date('Y-m-d H:i:s');
$tt['added_by'] = $customerid;
$tt['status'] = 1;
$tt['delivery_status'] = 'pending';
$tt['order_number'] = $orderID;
$tt['invoice_number'] = $invoice;
$tt['currency'] = 1;
$tt['userid'] = $customerid;
$tt['country'] = $_POST["country"];
$tt['address'] = $_POST["address"];
$tt['city'] = $_POST["city"];
$tt['zip'] = $_POST["zip"];
$tt['phone'] = $_POST["phone"];
$tt['email'] = $_POST["email"];
$tt['ordernote'] = $_POST["ordernote"];
$tt['discountamt'] = $_POST["discount"];
$tt['subtotal'] = $_POST["subtotal"];
$tt['totalamt'] = $_POST["total"];
if (isset($_POST['couponid'])) {
    $tt['couponid'] = $_POST["couponid"];
}
$orderid = $obj->insertnew('orders', $tt);

foreach ($_POST['productid'] as $key => $val) {
    $uu['productid'] = $val;
    $uu['orderid'] = $orderid;
    $uu['quantity'] = $_POST['qty'][$key];
    $uu['size'] = $_POST['size'][$key];
    $uu['item_name'] = $obj->selectfieldwhere("products", "product_name", "id=" . $val . " and status = 1");
    $uu['price'] = $obj->selectfieldwhere("products", "net_price", "id=" . $val . " and status = 1");
    $uu['taxrate'] = $obj->selectfieldwhere("tax inner join products on products.gstrate = tax.id", "tax.percentage", "products.id=" . $val . " and products.status = 1");
    if ($compstatecode == $statecode) {
        $uu['cgstamt'] = $uu['price'] * $uu['taxrate'] / 100 / 2;
        $uu['sgstamt'] = $uu['cgstamt'];
        $uu['csgstper'] = $uu['taxrate'] / 2;
        $uu['sgstper'] = $uu['taxrate'] / 2;
        $uu['totaltaxamt'] = $uu['cgstamt'] * 2;
    } else {
        $uu['igstamt'] = $uu['price'] * $uu['taxrate'] / 100 / 2;
        $uu['igstper'] = $uu['taxrate'];
        $uu['totaltaxamt'] = $uu['igstamt'];
    }
    $uu['finalamt'] = $_POST['price'][$key];
    // echo "<pre>";
    // print_r($uu);
    $products = $obj->insertnew('orderitem', $uu);
}
$obj->deletewhere('cart', 'userid=' . $customerid . ' and status = 1');
echo "Redirect :Order Placed Successfully URLindex";
