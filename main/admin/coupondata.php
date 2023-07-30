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
if (isset($_GET['order'][0]['dir'])) {
    $orderdirection = $_GET['order'][0]['dir'];
}
$oary = array('coupon.id', 'coupon.name', 'coupon.number', '');
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
    $search .= " and (coupon.name like '%$sv%' )";
}
if ((isset($_GET['columns'][0]["search"]["value"])) && (!empty($_GET['columns'][0]["search"]["value"]))) {
    $search .= " and coupon.name like '" . $_GET['columns'][0]["search"]["value"] . "'";
}
$return['recordsTotal'] = $obj->selectfieldwhere("coupon  ", "count(coupon.id)", "status=1 ");
$return['recordsFiltered'] = $obj->selectfieldwhere("coupon ", "count(coupon.id)", "status=1 $search ");
$return['draw'] = $_GET['draw'];
$result = $obj->selectextrawhereupdate(
    "coupon ",
    "`coupon`.`name`, `coupon`.`id`, `coupon`.`number`,`coupon`.`type`,`coupon`.`added_on`,`coupon`.`expirydate`,`coupon`.`orderabove`",
    "status=1 $search $order limit $start, $limit"
);
$num = $obj->total_rows($result);
$data = array();
while ($row = $obj->fetch_assoc($result)) {
    $n = array();
    $n[] = $i;
    $n[] = $row['name'];
    $n[] = $row['type'];
    $n[] = $row['type'] === 'Percent' ? $row['number'] : $currencysymbol . $row['number'];
    $n[] = $currencysymbol . $row['orderabove'];
    $n[] = changedateformatespecito($row['expirydate'], "Y-m-d", "d/m/Y");
    $a = "";
    if (in_array(40, $permissions)) {
        $a = "<button class='flex items-center justify-between px-3 py-2 bg-blue text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray' @click='openModal' onclick='dynamicmodal(\"" . $row['id'] . "\", \"editcoupon\", \"\", \"Edit Subategory\")' onclick='window.location.href='editcategory.php?hakuna=" . $row['id'] . "''  aria-label='Go'>
        <span>Edit</span>";
    }
    if (in_array(41, $permissions)) {
        $a .= "<button class='flex items-center justify-between px-3 py-2 bg-red text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray'   onclick='del(\"" . $row['id'] . "\", \"deletecoupon\", \"Delete Role \")'  aria-label='Go'>
        <span>Delete</span>";
    }
    $n[] = $a;
    $data[] = $n;
    $i++;
}
$return['data'] = $data;
echo json_encode($return);
