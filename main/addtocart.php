<?php
include "./function.php";
include "./conn.php";
// print_r($_POST);
if (!empty($_POST['userid'])) {
    $productid = $obj->selectfieldwhere("cart", "count(id)", "productid=" . $_POST['productid'] . " and userid = " . $_POST['userid'] . " and status = 1");
    if (empty($productid) || $productid === 0) {
        $tb_name = 'cart';
        $xx['added_on'] = date('Y-m-d H:i:s');
        $xx['added_by'] = $_POST['userid'];
        $xx['updated_on'] = date('Y-m-d H:i:s');
        $xx['updated_by'] = $_POST['userid'];
        $xx['status'] = 1;
        $xx['productid'] = $_POST['productid'];
        $xx['userid'] = $_POST['userid'];
        $xx['productname'] = $obj->selectfieldwhere("products", "product_name", "id=" . $xx['productid'] . " and status = 1");
        $xx['file_product'] = $obj->selectfieldwhere("products", "file_products", "id=" . $xx['productid'] . " and status = 1");
        $cartid = $obj->insertnew($tb_name, $xx);
        if ($cartid > 0) {
            echo "Success";
        }
    } else {
        echo 'Failed';
    }
} else {
    $productname = $obj->selectfieldwhere("products", "product_name", "id=" . $_POST['productid'] . " and status = 1");
    $imageid = $obj->selectfieldwhere("products", "file_products", "id=" . $_POST['productid'] . " and status = 1");
    if (!isset($_COOKIE['cartData'])) {
        $cartData = array(
            array(
                'productid' => $_POST['productid'],
                'productname' => $productname,
                'file_product' => $imageid,
            )

        );
        $cookieData = json_encode($cartData);
        setcookie('cartData', $cookieData, time() + (86400 * 60), '/');
        echo "Success";
    } else {
        $oldCartData = json_decode($_COOKIE['cartData'], true);
        // print_r($oldCartData);
        $productExists = false;

        foreach ($oldCartData as $data) {
            if ($data['productid'] === $_POST['productid']) {
                $productExists = true;
                break; // No need to continue checking once found
            }
        }
        if ($productExists) {
            echo 'Failed';
        } else {
            $newCartItem = array(
                'productid' => $_POST['productid'],
                'productname' => $productname,
                'file_product' => $imageid,
            );
            array_push($oldCartData, $newCartItem);
            $cookieData = json_encode($oldCartData);
            setcookie('cartData', $cookieData, time() + (86400 * 60), '/');
            echo "Success";
        };
    }
}
