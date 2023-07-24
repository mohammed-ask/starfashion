<?php
include 'main/session.php';
/* @var $obj db */
ob_start();
$sid = $_POST['id'];
$_POST['status'] = 1;
unset($_POST['id']);

$path = "main/uploads/category";

if (!empty($_FILES["image"]["name"])) {
    $uplid = $obj->selectfield("categories", "image", "id", $sid);
    $oldfile = $obj->selectfield("uploadfile", "path", "id", $uplid);
    if (file_exists($oldfile)) {
        $delfile = unlink($oldfile);
        $del_file = $obj->updatewhere("uploadfile", ["status" => 99], "id=$uplid");
    }
    $imgreturn = $obj->uploadfilenew($path, $_FILES, "image",  array("jpg", "jpeg", "png"));
    $_POST["image"] = $imgreturn;
}
$tb_name = "categories";
$postdata = $_POST;
$ures = $obj->update($tb_name, $postdata, $sid);
if ($ures == 1) {
    echo "Redirect : Category has been Updated URLcategory";
}
