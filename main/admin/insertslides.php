<?php
include "main/session.php";
/* @var $obj db */
ob_start();
$path = "main/uploads/category";

$_POST['file_picture'] = $obj->uploadfilenew($path, $_FILES, 'image', array("png", "jpg", "jpeg", "png", "webp"));
$_POST['added_on'] = date('Y-m-d H:i:s');
$_POST['added_by'] = $employeeid;
$_POST['updated_on'] = date('Y-m-d H:i:s');
$_POST['updated_by'] = $employeeid;
$_POST['status'] = 1;
$_POST['occasion'] = implode(",", $_POST['occasion']);
$_POST['productid'] = implode(",", $_POST['productid']);
$tb_name = "slide";
$postdata = $_POST;
$pradin = $obj->insertnew($tb_name, $postdata);
if (is_integer($pradin) && $pradin > 0) {
    echo "Redirect : New Slide has been Added  URLslides";
} else {
    echo "Some Error Occured";
}
