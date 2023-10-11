<?php
include "./function.php";
include "./conn.php";
$xx['added_on'] = date('Y-m-d H:i:s');
$xx['added_by'] = $customerid;
$xx['status'] = 1;
$xx['productid'] = $_POST['productid'];
$xx['rating'] = $_POST['rating'];
$xx['review'] = $_POST['review'];
$xx['userid'] = $customerid;
$xx['name'] = $obj->selectfieldwhere("users", "name", "id=" . $customerid . "");
$rev = $obj->insertnew("review", $xx);
if ($rev > 0) {
    echo 'Success';
} else {
    echo 'Failed';
}
