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
$oary = array('delivery_information.id', 'delivery_information.content', 'delivery_information.added_on', '');
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
    $search .= " and (delivery_information.content like '%$sv%' )";
}
if ((isset($_GET['columns'][0]["search"]["value"])) && (!empty($_GET['columns'][0]["search"]["value"]))) {
    $search .= " and delivery_information.content like '" . $_GET['columns'][0]["search"]["value"] . "'";
}
$return['recordsTotal'] = $obj->selectfieldwhere("delivery_information  ", "count(delivery_information.id)", "status=1 ");
$return['recordsFiltered'] = $obj->selectfieldwhere("delivery_information ", "count(delivery_information.id)", "status=1 $search ");
$return['draw'] = $_GET['draw'];
$result = $obj->selectextrawhereupdate(
    "delivery_information ",
    "`delivery_information`.`content`, `delivery_information`.`id`, `delivery_information`.`added_on`",
    "status=1 $search $order limit $start, $limit"
);
$num = $obj->total_rows($result);
$data = array();
while ($row = $obj->fetch_assoc($result)) {
    $n = array();
    $n[] = $i;
    $n[] = $row['content'];
    $n[] = $row['added_on'];
    $a = "";
    if (in_array(40, $permissions)) {
        $a = "<button class='flex items-center justify-between px-3 py-2 bg-blue text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray' onclick=\"window.location.href='editdeliveryinfo?hakuna=" . $row['id'] . "'\" aria-label='Go'>
        <span>Edit</span>
      </button>";
    }
    if (in_array(41, $permissions)) {
        $a .= "<button class='flex items-center justify-between px-3 py-2 bg-red text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray'   onclick='del(\"" . $row['id'] . "\", \"deletedeliveryinfo\", \"Delete Role \")'  aria-label='Go'>
        <span>Delete</span>";
    }
    $n[] = $a;
    $data[] = $n;
    $i++;
}
$return['data'] = $data;
echo json_encode($return);
