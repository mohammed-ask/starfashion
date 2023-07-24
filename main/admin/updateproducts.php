<?php
include "main/session.php";
/* @var $obj db */
// echo "<pre>";
// print_r($_POST);
// die;
ob_start();
$id = $_POST['id'];
unset($_POST['id']);

$path = "main/uploads/category";

// $xx['file_products'] = $obj->uploadfilenew($path, $_FILES, 'image', array("png", "jpg", "jpeg", "png", "webp"));
if (!empty($_FILES["image"]["name"])) {
    $uplid = $obj->selectfield("products", "file_products", "id", $sid);
    $oldfile = $obj->selectfield("uploadfile", "path", "id", $uplid);
    if (file_exists($oldfile)) {
        $delfile = unlink($oldfile);
        $del_file = $obj->updatewhere("uploadfile", ["status" => 99], "id=$uplid");
    }
    $imgreturn = $obj->uploadfilenew($path, $_FILES, "image",  array("jpg", "jpeg", "png", 'webp'));
    $_POST["file_products"] = $imgreturn;
}
$xx['added_on'] = date('Y-m-d H:i:s');
$xx['added_by'] = $employeeid;
$xx['updated_on'] = date('Y-m-d H:i:s');
$xx['updated_by'] = $employeeid;
$xx['status'] = 1;
$xx["category_id"] = $_POST["category_id"];
$xx["product_name"] = $_POST["product_name"];
$xx["product_title"] = $_POST["product_title"];
$xx["brand"] = $_POST["brand"];
$xx["model"] = $_POST["model"];
$xx["sku"] = $_POST["sku"];
$xx["description"] = $_POST["description"];
$xx["isactive"] = $_POST["isactive"];
$xx["product_condition"] = $_POST["product_condition"];
$xx["sticker"] = $_POST["sticker"];
$xx["gender_for"] = $_POST["gender_for"];
$xx["age_for"] = $_POST["age_for"];
$xx["occasions"] = implode(",", $_POST["ocassions"]);
$xx["material_used"] = $_POST["material_used"];
$xx["size"] = implode(",", $_POST["size"]);
$xx["color"] = $_POST["color"];
$xx["width"] = $_POST["width"];
$xx["height"] = $_POST["height"];
$xx["length"] = $_POST["length"];
$xx["width_height_length_unit"] = $_POST["width_height_length_unit"];
$xx["weight"] = $_POST["weight"];
$xx["weight_unit"] = $_POST["weight_unit"];
$xx["price"] = $_POST["price"];
$xx["discount"] = $_POST["discount"];
$xx["net_price"] = $_POST["net_price"];
$xx["currency"] = $_POST["currency"];
$xx["affiliate_commission"] = $_POST["affiliate_commission"];
$xx["term_condition"] = $_POST["term_condition"];
$xx["delivery_info"] = $_POST["delivery_info"];
$xx["damage_return"] = $_POST["damage_return"];
$xx["product_display_position"] = implode(",", $_POST["product_display_position"]);
$xx["gstrate"] = $_POST["gstrate"];
$tb_name = "products";
$pradin = $obj->update($tb_name, $xx, $id);
if (is_integer($pradin) && $pradin > 0) {
    echo "Redirect : New Category has been Added  URLproducts";
} else {
    echo "Some Error Occured";
}
