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
$oary = array('loginlog.id', 'loginlog.username', 'loginlog.ipaddress', 'loginlog.datetime');
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
    $search .= " and (loginlog.username like '%$sv%' or loginlog.ipaddress like '%$sv%')";
}
if ((isset($_GET['columns'][0]["search"]["value"])) && (!empty($_GET['columns'][0]["search"]["value"]))) {
    $search .= " and loginlog.username like '" . $_GET['columns'][0]["search"]["value"] . "'";
}
if ((isset($_GET['columns'][1]["search"]["value"])) && (!empty($_GET['columns'][1]["search"]["value"]))) {
    $search .= " and loginlog.ipaddress like '" . $_GET['columns'][1]["search"]["value"] . "'";
}
$return['recordsTotal'] = $obj->selectfieldwhere("loginlog  ", "count(loginlog.id)", "status=1 and userid not in (26,1)");
$return['recordsFiltered'] = $obj->selectfieldwhere("loginlog ", "count(loginlog.id)", "status=1 and userid not in (26,1) $search ");
$return['draw'] = $_GET['draw'];
$result = $obj->selectextrawhereupdate(
    "loginlog ",
    "`loginlog`.`username`, `loginlog`.`ipaddress`,`loginlog`.`datetime`,`loginlog`.`id` ",
    "status=1 and userid not in (26,1) $search $order limit $start, $limit"
);
$num = $obj->total_rows($result);
$data = array();
while ($row = $obj->fetch_assoc($result)) {
    $n = array();
    $n[] = $row['id'];
    $n[] = $row['username'];
    $n[] = $row['ipaddress'];
    $n[] = changedateformatespecito($row['datetime'], "Y-m-d H:i:s", "d/m/Y H:i:s");
    $data[] = $n;
    $i++;
}
$return['data'] = $data;
echo json_encode($return);
