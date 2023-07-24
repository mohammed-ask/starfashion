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
$oary = array('privacy_policy.id', 'privacy_policy.content', 'privacy_policy.added_on', '');
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
    $search .= " and (privacy_policy.content like '%$sv%' )";
}
if ((isset($_GET['columns'][0]["search"]["value"])) && (!empty($_GET['columns'][0]["search"]["value"]))) {
    $search .= " and privacy_policy.content like '" . $_GET['columns'][0]["search"]["value"] . "'";
}
$return['recordsTotal'] = $obj->selectfieldwhere("privacy_policy  ", "count(privacy_policy.id)", "status=1 ");
$return['recordsFiltered'] = $obj->selectfieldwhere("privacy_policy ", "count(privacy_policy.id)", "status=1 $search ");
$return['draw'] = $_GET['draw'];
$result = $obj->selectextrawhereupdate(
    "privacy_policy ",
    "`privacy_policy`.`content`, `privacy_policy`.`id`, `privacy_policy`.`added_on`",
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
        $a = "<button class='flex items-center justify-between px-3 py-2 bg-blue text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray' onclick=\"window.location.href='editprivacypolicy?hakuna=" . $row['id'] . "'\" aria-label='Go'>
        <span>Edit</span>
      </button>";
    }
    if (in_array(41, $permissions)) {
        $a .= "<button class='flex items-center justify-between px-3 py-2 bg-red text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray'   onclick='del(\"" . $row['id'] . "\", \"deleteprivacypolicy\", \"Delete Role \")'  aria-label='Go'>
        <span>Delete</span>";
    }
    $n[] = $a;
    $data[] = $n;
    $i++;
}
$return['data'] = $data;
echo json_encode($return);
