<?php
include '../session.php';
/* @var $obj db */
$id = $employeeid;
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
$oary = array('mail.id', 'mail.senderid', 'mail.receiverid', 'mail.subject', 'mail.message');
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
    $search .= " and (mail.senderid like '%$sv%' or mail.receiverid like '%$sv%')";
}
if ((isset($_GET['columns'][0]["search"]["value"])) && (!empty($_GET['columns'][0]["search"]["value"]))) {
    $search .= " and mail.senderid like '" . $_GET['columns'][0]["search"]["value"] . "'";
}
if ((isset($_GET['columns'][1]["search"]["value"])) && (!empty($_GET['columns'][1]["search"]["value"]))) {
    $search .= " and mail.description like '" . $_GET['columns'][1]["search"]["value"] . "'";
}
$return['recordsTotal'] = $obj->selectfieldwhere("mail", "count(mail.id)", "status = 1 and receiverid = $id");
$return['recordsFiltered'] = $obj->selectfieldwhere("mail", "count(mail.id)", "status = 1 and receiverid = $id $search ");
$return['draw'] = $_GET['draw'];
$result = $obj->selectextrawhereupdate(
    "mail",
    "*",
    "status = 1 and receiverid = $id $search $order limit $start, $limit"
);
$num = $obj->total_rows($result);
$data = array();
while ($row = $obj->fetch_assoc($result)) {
    $n = array();
    $n[] = $i;
    $n[] = changedateformatespecito($row['added_on'], "Y-m-d H:i:s", "d M, Y H:i");
    $n[] = $obj->selectfieldwhere("users", "email", "id=" . $row['senderid'] . "");
    $n[] =  $row['subject'];
    $n[] =  "<button class='px-3 py-2 leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100' aria-label='view' @click='openModal'  onclick='dynamicmodal(\"" . $row['id'] . "\", \"viewmaildetail\", \"\", \"View Mail\")'>
    <span class='w-5 h-5' fill='currentColor'><i fill='currentColor' class='fa-sharp fa-solid fa-eye'></i></span>
</button>";
    $n[] = $row['readstatus'];
    $data[] = $n;

    $i++;
}
$obj->updatewhere("mail", ["readstatus" => 1], "receiverid=" . $employeeid . "");
$return['data'] = $data;
echo json_encode($return);
