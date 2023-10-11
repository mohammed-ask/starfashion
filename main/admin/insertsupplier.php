<?php
include 'main/session.php';
//print_r($_POST);
// die;
$_POST['status'] = 1;
$_POST['added_on'] = date('Y-m-d H:i:s');
$_POST['added_by'] = $employeeid;
$_POST['updated_by'] = $employeeid;
$_POST['updated_on'] = date('Y-m-d H:i:s');
unset($_POST['_wysihtml5_mode']);
$tb_name = "suppliers";
$postdata = $_POST;
$pradin = $obj->insertnew($tb_name, $postdata);
if (is_integer($pradin) && $pradin > 0) {

    echo "Redirect :New Supplier has been Added to your Catalogue URLsuppliers";
} else {
    echo "Some Error Occured";
}
