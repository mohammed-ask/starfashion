<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include './main/function.php';
include './main/conn.php';

$xx['name'] = $_POST['name'];
$xx['email'] = $_POST['email'];
$xx['message'] = $_POST['message'];
$xx['added_on'] = date('Y-m-d H:i:s');
$xx['status'] = 1;
$pradin = $obj->insertnew('messages', $xx);

if ($pradin) {
    echo "Redirect : Message Sent Successfully URL ";
}
