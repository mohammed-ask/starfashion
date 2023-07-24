<?php
include "../session.php";
$id = $_POST['id'];
$type = $_POST['type'];
$value = $_POST['value'];
if ($value === 'No') {
    $obj->update('users', [$type => 'Yes'], $id);
} elseif ($value === 'Yes') {
    $obj->update('users', [$type => 'No'], $id);
}
echo "Success";
