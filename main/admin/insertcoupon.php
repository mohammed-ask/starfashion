<?php
include "main/session.php";
/* @var $obj db */
// print_r($_POST);
if ($_POST['type'] === 'Percent' and $_POST['number'] > 100) {
    echo "<div class='alert alert-warning'>Percent cannot be greater than 100</div>";
    die;
}
$xx['added_on'] = date('Y-m-d H:i:s');
$xx['added_by'] = $employeeid;
$xx['updated_on'] = date('Y-m-d H:i:s');
$xx['updated_by'] = $employeeid;
$xx['status'] = 1;
$xx['name'] = $_POST['name'];
$xx['number'] = $_POST['number'];
$xx['type'] = $_POST['type'];
$xx['orderabove'] = $_POST['orderabove'];
$xx['expirydate'] = changedateformate($_POST['expirydate']);
$tb_name = "coupon";
$pradin = $obj->insertnew($tb_name, $xx);
if (is_integer($pradin) && $pradin > 0) {
    echo "Redirect : New Coupon has been Added  URLcoupon";
} else {
    echo "Some Error Occured";
}
