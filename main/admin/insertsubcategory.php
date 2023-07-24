<?php
include "main/session.php";
/* @var $obj db */
ob_start();
$path = "main/uploads/category";

$_POST['image'] = $obj->uploadfilenew($path, $_FILES, 'image', array("png", "jpg", "jpeg", "png", "webp"));
$_POST['added_on'] = date('Y-m-d H:i:s');
$_POST['added_by'] = $employeeid;
$_POST['updated_on'] = date('Y-m-d H:i:s');
$_POST['updated_by'] = $employeeid;
$_POST['status'] = 1;
$tb_name = "subcategories";
$postdata = $_POST;
$pradin = $obj->insertnew($tb_name, $postdata);
if (is_integer($pradin) && $pradin > 0) {
    echo "Redirect : New Category has been Added  URLsubcategory";
} else {
    echo "Some Error Occured";
}
