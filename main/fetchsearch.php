<?php
include "./function.php";
include "./conn.php";
// print_r($_POST);
$catid = $_POST['catid'];
$priceid = $_POST['priceid'];
$size = $_POST['size'];
$type = $_POST['type'];
$val = $_POST['val'];
if ($type === 'Category' && $catid !== $val) {
    echo "shop?hakuna=$val&matata=$priceid&sonata=$size";
} elseif ($type === 'Price' && $priceid !== $val) {
    echo "shop?hakuna=$catid&matata=$val&sonata=$size";
} elseif ($type === 'Size' && $size !== $val) {
    echo "shop?hakuna=$catid&matata=$priceid&sonata=$val";
}


// elseif (!empty($catid) && empty($priceid) && empty($size)) {
//     echo "shop?hakuna=$catid&matata=$priceid&sonata=$size";
// } elseif (!empty($catid) && !empty($priceid) && !empty($size)) {
//     echo "shop?hakuna=$catid&matata=$priceid&sonata=$size";
// }
