<?php
include "main/session.php";
$id = $_POST['id'];
unset($_POST['id']);
$emailcount = $obj->selectfieldwhere('users', "count(id)", "email='" . $_POST['email'] . "' and status != 99 and id != '" . $id . "'");
if ($emailcount > 0) {
    echo "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative' role='alert'>Sorry! This Mail Already Exists </div>";
} else {
    $xx['updated_on'] = date('Y-m-d H:i:s');
    $xx['updated_by'] = $employeeid;
    $xx['status'] = 1;
    $xx['mobile'] = $_POST['phone'];
    $xx['name'] = $_POST['name'];
    $xx['role'] = $_POST['role'];
    $xx['email'] = $_POST['email'];
    $xx['password'] = $_POST['password'];
    $xx['activate'] = $_POST['activate'];
    $pradin = $obj->update("users", $xx, $id);
    if (is_numeric($pradin) && $pradin > 0) {
        echo "Redirect : Employee Updated Successfully URLemployeelist";
    }
}
