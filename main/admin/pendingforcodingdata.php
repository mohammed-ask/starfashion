<?php
include '../session.php';
/* @var $obj db */
$limit = $_GET['length'];
$start = $_GET['start'];
$i = 1;
$return['recordsTotal'] = 0;
$return['recordsFiltered'] = 0;
$return['draw'] = $_GET['draw'];
$return['data'] = array();
$orderdirection = "";
//$challanid = $_GET['hakuna'];
if (isset($_GET['order'][0]['dir'])) {
    $orderdirection = $_GET['order'][0]['dir'];
}
$oary = array('purchase_item.id', 'purchase_item.name', 'purchase_item.description', 'purchase_item.accreditation', 'purchase_item.rate', 'purchase_item.qty', 'purchase_item.amount', '');
$ocoloum = "";
if (isset($_GET['order'][0]['column'])) {
    $ci = $_GET['order'][0]['column'];
    $ocoloum = $oary[$ci];
}
$order = "";
if (!empty($ocoloum)) {
    $order = " order by $ocoloum $orderdirection ";
}
$search = "";
if (isset($_GET['search']['value']) && !empty($_GET['search']['value'])) {
    $sv = $_GET['search']['value'];
    $search .= " and (purchase_item.name like '%$sv%' or purchase_item.description   like '%$sv%')";
}

$return['recordsTotal'] = $obj->selectfieldwhere(
    "purchase_item  ",
    "count(purchase_item.id)",
    "status=-1"
);
$return['recordsFiltered'] = $obj->selectfieldwhere(
    "purchase_item ",
    "count(purchase_item.id)",
    "status=-1 $search "
);
$return['draw'] = $_GET['draw'];
$result = $obj->selectextrawhereupdate(
    "purchase_item ",
    "`purchase_item`.`status`,`hsn_code`,`purchase_item`.`id`, `purchase_item`.`name`,`purchase_item`.`price`,`purchase_item`.`quantity`,`purchase_item`.`finalamount`,`purchase_item`.`subcategory_id` ",
    " status= -1 $search $order limit $start, $limit"
);
$num = $obj->total_rows($result);
$data = array();
while ($row = $obj->fetch_assoc($result)) {
    extract($row);
    $n = array();
    $n[] = '<input type="checkbox" name="ids" id="ids" class="checkboxes" value="' . $row['id'] . '"/>';
    $n[] = $row['name'];
    $n[] = $row['hsn_code'];
    $unitid = $obj->selectfieldwhere("subcategories", "unit", "id='" . $row['subcategory_id'] . "'");
    $n[] = $obj->selectfieldwhere("units", "description", "id='" . $unitid . "'");
    $n[] = $row['quantity'];
    $n[] = $row['price'];
    $n[] = $row['finalamount'];
    $data[] = $n;
    $i++;
}
$return['data'] = $data;
echo json_encode($return);
