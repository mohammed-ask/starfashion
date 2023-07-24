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
$oary = array('slide.id', 'slide.heading', 'slide.desc', '');
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
    $search .= " and (slide.heading like '%$sv%' )";
}
if ((isset($_GET['columns'][0]["search"]["value"])) && (!empty($_GET['columns'][0]["search"]["value"]))) {
    $search .= " and slide.heading like '" . $_GET['columns'][0]["search"]["value"] . "'";
}
$return['recordsTotal'] = $obj->selectfieldwhere("slide  ", "count(slide.id)", "status=1 ");
$return['recordsFiltered'] = $obj->selectfieldwhere("slide ", "count(slide.id)", "status=1 $search ");
$return['draw'] = $_GET['draw'];
$result = $obj->selectextrawhereupdate(
    "slide ",
    "`slide`.`heading`, `slide`.`id`, `slide`.`desc`,`slide`.`file_picture`,`slide`.`isactive`,`slide`.`title`,`slide`.`occasion`,`slide`.`productid`   ",
    "status=1 $search $order limit $start, $limit"
);
$num = $obj->total_rows($result);
$data = array();
while ($row = $obj->fetch_assoc($result)) {
    $n = array();
    $n[] = $i;
    $n[] = $row['heading'];
    $n[] = $row['title'];
    $n[] = $row['desc'];
    $n[] = $obj->selectfieldwhere("products", "product_name", "id=" . $row['productid'] . "");
    $n[] = $row['occasion'];
    $n[] = "<img style='height:50px;width:50px' src=../" . $obj->fetchattachment($row['file_picture']) . "/>";
    $n[] = $row['isactive'];
    $a = "";
    if (in_array(40, $permissions)) {
        $a = "<button class='flex items-center justify-between px-3 py-2 bg-blue text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray' @click='openModal' onclick='dynamicmodal(\"" . $row['id'] . "\", \"editslides\", \"\", \"Edit Subategory\")' onclick='window.location.href='editcategory.php?hakuna=" . $row['id'] . "''  aria-label='Go'>
        <span>Edit</span>";
    }
    if (in_array(41, $permissions)) {
        $a .= "<button class='flex items-center justify-between px-3 py-2 bg-red text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray'   onclick='del(\"" . $row['id'] . "\", \"deleteslides\", \"Delete Role \")'  aria-label='Go'>
        <span>Delete</span>";
    }
    $n[] = $a;
    $data[] = $n;
    $i++;
}
$return['data'] = $data;
echo json_encode($return);
