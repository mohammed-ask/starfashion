<?php
include "main/session.php";
/* @var $obj db */
ob_start();
$_POST['added_on'] = date('Y-m-d H:i:s');
$_POST['added_by'] = $employeeid;
$_POST['updated_on'] = date('Y-m-d H:i:s');
$_POST['updated_by'] = $employeeid;
$_POST['status'] = 1;
$tb_name = "returns";
$postdata = $_POST;
$pradin = $obj->insertnew($tb_name, $postdata);
if (is_integer($pradin) && $pradin > 0) {
    echo "Redirect : Return Policy has been Added  URLreturn";
} else {
    echo "Some Error Occured";
}
