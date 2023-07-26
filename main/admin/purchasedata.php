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
$oary = array('purchase.id', 'purchase.po_number', 'purchase.customer_id', 'purchase.customer_contact_id', 'purchase.date', 'purchase.added_on', '');
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
//if (!in_array("368", $permissions)) {
//    $search = " and (ticket.addedby='" . $_SESSION['employee'] . "' or ticket.allotedto='" . $_SESSION['employee'] . "')";
//}
if (isset($_GET['search']['value']) && !empty($_GET['search']['value'])) {
    $sv = $_GET['search']['value'];
    $search .= " and (purchase.po_number like '%$sv%' or purchase.customer_id like '%$sv%' or admin.firstname like '%$sv%' or purchase.sname like '%$sv%' or suppliers.company like '%$sv%')";
}
$status = "";
if ((isset($_GET['columns'][1]["search"]["value"])) && (!empty($_GET['columns'][1]["search"]["value"]))) {
    if ($_GET['columns'][1]["search"]["value"] == 1) {
        $status .= " purchase.status = " . $_GET['columns'][1]["search"]["value"] . "";
    } elseif ($_GET['columns'][1]["search"]["value"] == 2) {
        $status .= " purchase.status = " . -1 . "";
    } elseif ($_GET['columns'][1]["search"]["value"] == 3) {
        $status .= " purchase.status in (1,-1)";
    }
} else {
    $status = "purchase.status = 1";
}
// if ((isset($_GET['columns'][0]["search"]["value"])) && (!empty($_GET['columns'][0]["search"]["value"]))) {
//     $search .= " and purchase.po_number like '" . $_GET['columns'][0]["search"]["value"] . "'";
// }
if ((isset($_GET['columns'][2]["search"]["value"])) && (!empty($_GET['columns'][2]["search"]["value"]))) {
    $search .= " and (admin.firstname like '%" . $_GET['columns'][2]["search"]["value"] . "%' or admin.lastname like '%" . $_GET['columns'][2]["search"]["value"] . "%' or admin.middlename like '%" . $_GET['columns'][2]["search"]["value"] . "%')";
}
if ((isset($_GET['columns'][3]["search"]["value"])) && (!empty($_GET['columns'][3]["search"]["value"]))) {
    $search .= " and suppliers.company like '%" . $_GET['columns'][3]["search"]["value"] . "%'";
}
$join = "inner join suppliers on suppliers.id = purchase.customer_id";

$return['recordsTotal'] = $obj->selectfieldwhere("purchase $join", "count(purchase.id)", "$status ");
$return['recordsFiltered'] = $obj->selectfieldwhere("purchase $join", "count(purchase.id)", "$status $search ");
$return['draw'] = $_GET['draw'];
$result = $obj->selectextrawhereupdate(
    "purchase $join",
    "`purchase`.`po_number`, `purchase`.`customer_id`,`purchase`.`id`,`purchase`.`sname`,`purchase`.`added_on`,`purchase`.`status`,`purchase`.`added_by`,`purchase`.`approved_by`,`suppliers`.`company`,`suppliers`.`company`,`purchase`.`ordertype`",
    "$status $search $order limit $start, $limit"
);

$num = $obj->total_rows($result);
$data = array();
while ($row = $obj->fetch_assoc($result)) {
    $n = array();
    $n[] = $i;
    $n[] = $row['po_number'];
    $added_by = $obj->selectfieldwhere("users", "name", "id=" . $row['added_by'] . "");
    $n[] = $added_by;
    $customer_name = $row["sname"];
    $n[] = $row["company"] . " (" . $customer_name . ")";
    $n[] = changedateformatespecito($row['added_on'], "Y-m-d H:i:s", "d/m/Y");
    $a = "";
    $a = "<button class='flex items-center justify-between px-3 py-2 bg-blue text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray' onclick=\"window.location.href='viewfullpurchase?hakuna=" . $row['id'] . "'\" aria-label='Go'>
        <span>View Details</span>
      </button>";
    $a .= "<button class='flex items-center justify-between px-3 py-2 bg-red text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray'   onclick='del(\"" . $row['id'] . "\", \"deletepurchase\", \"Delete Role \")'  aria-label='Go'>
      <span>Delete</span>";


    $n[] = $a;
    $data[] = $n;
    $i++;
}
// echo "<pre>";
// print_r($data);
// die;
$return['data'] = $data;
echo json_encode($return);
