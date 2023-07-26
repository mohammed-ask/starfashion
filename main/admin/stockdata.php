<?php
include '../session.php';
/* @var $obj db */
$limit = $_GET['length'];
$start = $_GET['start'];
$i = 1;
$tbname = "mmproducts";
$search = "";
if (isset($_GET['category']) && !empty($_GET['category'])) {
    $category = $_GET['category'];
    $search .= " and mmproducts.category=$category";
}
//$labid = 6;

$return['recordsTotal'] = 0;
$return['recordsFiltered'] = 0;
$return['draw'] = $_GET['draw'];
$return['data'] = array();
$orderdirection = "";
if (isset($_GET['order'][0]['dir'])) {
    $orderdirection = $_GET['order'][0]['dir'];
}
$oary = array("$tbname.id", 'categories.name', 'mmproducts.name', 'mmproducts.idno', 'labs.name', 'subcategories.critical', "$tbname.batchno", "$tbname.quantity");
$ocoloum = "";
if (isset($_GET['order'][0]['column'])) {
    $ci = $_GET['order'][0]['column'];
    $ocoloum = $oary[$ci];
}
$order = "";
if (!empty($ocoloum)) {
    $order = " order by $ocoloum $orderdirection ";
}




if (isset($_GET['search']['value']) && !empty($_GET['search']['value'])) {
    $sv = $_GET['search']['value'];
    $search .= "and ( categories.name like '%$sv%' or  mmproducts.name like '%$sv%' or  mmproducts.idno like '%$sv%' or  labs.name like '%$sv%' or  subcategories.critical like '%$sv%' or  $tbname.batchno like '%$sv%' or  $tbname.quantity like '%$sv%')";
    //    $search .= " and (mmproducts.name like '%$sv%' or mmproducts.idno like '%$sv%' or mmproducts.serialno like '%$sv%' )";
}
$join = " left join subcategories on subcategories.id=mmproducts.type"
    . " left join units on units.id=subcategories.unit"
    . " left join categories on categories.id=mmproducts.category";
$return['recordsTotal'] = $obj->selectfieldwhere("$tbname $join", "count($tbname.id)", "$tbname.quantity>0 and ($tbname.status<=1 and $tbname.status!=0) ");
$return['recordsFiltered'] = $obj->selectfieldwhere("$tbname $join", "count($tbname.id)", "$tbname.quantity>0 and ($tbname.status<=1 and $tbname.status!=0) $search ");
$return['draw'] = $_GET['draw'];

$where = "$tbname.quantity>0 and ($tbname.status<=1 and $tbname.status!=0) $search $order limit $start, $limit";
$result = $obj->selectextrawhereupdate(
    "$tbname $join ",
    "$tbname.batchno,$tbname.quantity,categories.name as cname,mmproducts.name,mmproducts.idno,units.description as units",
    $where
);
// echo $obj->total_rows($result);
$data = array();
while ($row = $obj->fetch_assoc($result)) {
    $n = array();
    $n[] = $row['cname'];
    $n[] = $row['name'];
    $n[] = $row['idno'];
    // $n[] = $row['labname'];
    // $n[] = $obj->selectfieldwhere("choices", "name", "id='" . $row['critical'] . "'");
    $n[] = $row['batchno'];
    $n[] = $row['quantity'] . " " . $row['units'];

    $data[] = $n;
    $i++;
}

$return['data'] = $data;
echo json_encode($return);
