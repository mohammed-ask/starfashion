<?php
include "./function.php";
include "./conn.php";
if (empty($_POST['mail'])) {
    echo "Empty";
} elseif (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
    $chkmail = $obj->selectfieldwhere("messages", "count(id)", "message='Newsletter' and email='" . $_POST['mail'] . "' and status = 1");
    if (empty($chkmail) || $chkmail == 0) {
        $xx['email'] = $_POST['mail'];
        $xx['message'] = 'Newsletter';
        $xx['added_on'] = date('Y-m-d H:i:s');
        $xx['status'] = 1;
        $pradin = $obj->insertnew('messages', $xx);
        if ($pradin > 0) {
            echo 'Success';
        }
    } else {
        echo "Found";
    }
} else {
    echo 'Failed';
}
// print_r($_POST);
