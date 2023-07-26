<?php
include 'main/session.php';
//print_r($_POST);
//print_r($_FILES);
$sid = $_POST['hakuna'];

$_POST['updated_on'] = date('Y-m-d H:i:s');
$_POST['updated_by'] = $employeeid;
$_POST['status'] = 1;

unset($_POST['_wysihtml5_mode']);
unset($_POST['hakuna']);
$tb_name = "suppliers";
$postdata = $_POST;
$resu = $obj->update($tb_name, $postdata, $sid);
if ($resu == 1) {
    echo "Redirect : Supplier has been Updated URLsupplier";
} else {
    echo "Some error occured";
}
