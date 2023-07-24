<?php
include "main/session.php";
$emailcount = $obj->selectfieldwhere('users', "count(id)", "email='" . $_POST['email'] . "' and status != 99 and id != '" . $employeeid . "'");
if ($emailcount > 0) {
    echo "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative' role='alert'>Sorry! This Mail Already Exists </div>";
} else {
    $xx['updated_on'] = date('Y-m-d H:i:s');
    $xx['updated_by'] = $employeeid;
    $xx['email'] = $_POST['email'];
    $xx['mobile'] = $_POST['phone'];
    $xx['password'] = $_POST['password'];
    $tb_name = 'users';
    $profile = $obj->update($tb_name, $xx, $employeeid);
    $obj->saveactivity("Profile Updated by admin", "", $employeeid, $employeeid, "Admin", "Profile Updated by admin");
    if ($profile > 0) {
        echo "Redirect : User Updated Successfully URLindex";
    }
}
