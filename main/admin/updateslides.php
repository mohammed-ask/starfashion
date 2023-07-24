<?php
include 'main/session.php';
/* @var $obj db */
ob_start();
$sid = $_POST['id'];
$_POST['status'] = 1;
unset($_POST['id']);

$path = "main/uploads/category";

if (!empty($_FILES["image"]["name"])) {
    $uplid = $obj->selectfield("slide", "file_picture", "id", $sid);
    $oldfile = $obj->selectfield("uploadfile", "path", "id", $uplid);
    if (file_exists($oldfile)) {
        $delfile = unlink($oldfile);
        $del_file = $obj->updatewhere("uploadfile", ["status" => 99], "id=$uplid");
    }
    $imgreturn = $obj->uploadfilenew($path, $_FILES, "image",  array("jpg", "jpeg", "png", 'webp'));
    $_POST["file_picture"] = $imgreturn;
}
$tb_name = "slide";
$_POST['occasion'] = implode(",", $_POST['occasion']);
$_POST['productid'] = implode(",", $_POST['productid']);
$postdata = $_POST;
$ures = $obj->update($tb_name, $postdata, $sid);
if ($ures == 1) {
    echo "Redirect : Slide has been Updated URLslides";
}
