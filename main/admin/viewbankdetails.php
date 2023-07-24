<?php
include "main/session.php";
$id = $_GET['hakuna'];
$rowbank = $obj->selectextrawhereupdate("users", "bankname,accountno,ifsc", "id=" . $id . "")->fetch_assoc();
?>
<div class="px-3 bg-white rounded-lg ">
    <span>
        <p class="block w-full  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray"><b>Bank Name: </b><?= $rowbank['bankname'] ?> <br><span style="margin-top: 10px !important; margin-bottom: 10px !important;"> <b>A/c No: </b></span><?= $rowbank['accountno'] ?> <br><b>IFSC: </b><?= $rowbank['ifsc'] ?></p>

    </span>
</div>