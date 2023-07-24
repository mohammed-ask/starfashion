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
$oary = array('products.id', 'products.name', 'products.desc', '');
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
    $search .= " and (products.name like '%$sv%' )";
}
if ((isset($_GET['columns'][0]["search"]["value"])) && (!empty($_GET['columns'][0]["search"]["value"]))) {
    $search .= " and products.name like '" . $_GET['columns'][0]["search"]["value"] . "'";
}
$return['recordsTotal'] = $obj->selectfieldwhere("products  ", "count(products.id)", "status=1 ");
$return['recordsFiltered'] = $obj->selectfieldwhere("products ", "count(products.id)", "status=1 $search ");
$return['draw'] = $_GET['draw'];
$result = $obj->selectextrawhereupdate(
    "products ",
    "*",
    "status=1 $search $order limit $start, $limit"
);
$num = $obj->total_rows($result);
$data = array();
while ($row = $obj->fetch_assoc($result)) {
    $n = array();
    $n[] = $i;
    $parentcatid = $obj->selectfieldwhere("subcategories", "categoryid", "id=" . $row['category_id'] . "");
    $parentcat = $obj->selectfieldwhere("categories", "name", "id=" . $parentcatid . "");
    $subcat = $obj->selectfieldwhere("subcategories", "name", "id=" . $row['category_id'] . "");
    $n[] = $parentcat;
    $n[] = $subcat;
    $n[] = $row['product_name'];
    $n[] = $row['product_title'];
    $n[] = $row['brand'];
    $n[] = $row['model'];
    $n[] = $row['sku'];
    $n[] = $row['description'];
    $n[] = $row['product_condition'];
    $n[] = $row['sticker'];
    $n[] = $row['gender_for'];
    $n[] = $row['age_for'];
    $n[] = $row['occasions'];
    $n[] = $row['material_used'];
    $n[] = $row['size'];
    $n[] = $row['color'];
    $n[] = $row['width'] . "x" . $row['height'] . "x" . $row['length'] . " " . $row['width_height_length_unit'];
    $n[] = $row['weight'] . " " . $row['weight_unit'];
    $n[] = "INR" . $row['price'];
    $n[] = "INR" . $row['discount'];
    $n[] = "INR" . $row['net_price'];
    $n[] = $row['currency'];
    $n[] = $row['affiliate_commission'];
    $n[] = "<img style='height:50px;width:50px' src=../" . $obj->fetchattachment($row['file_products']) . "/>";
    $n[] = $row['term_condition'];
    $n[] = $row['delivery_info'];
    $n[] = $row['damage_return'];
    $n[] = $row['product_display_position'];
    $n[] = changedateformatespecito($row['added_on'], "Y-m-d H:i:s", "d/m/Y");
    $n[] = $row['isactive'];
    $n[] = $row['gstrate'];
    $a = "";
    if (in_array(40, $permissions)) {
        $a = "<button class='flex items-center justify-between px-3 py-2 bg-blue text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray' @click='openModal' onclick='dynamicmodal(\"" . $row['id'] . "\", \"editproducts\", \"\", \"Edit Subategory\")' onclick='window.location.href='editcategory.php?hakuna=" . $row['id'] . "''  aria-label='Go'>
        <span>Edit</span>";
    }
    if (in_array(41, $permissions)) {
        // $a .= "<button class='flex items-center justify-between px-3 py-2 bg-red text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray'   onclick='del(\"" . $row['id'] . "\", \"deleteproduct\", \"Delete Role \")'  aria-label='Go'>
        // <span>Delete</span>";
    }
    $n[] = $a;
    $data[] = $n;
    $i++;
}
$return['data'] = $data;
echo json_encode($return);
