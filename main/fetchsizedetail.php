<?php
include "./function.php";
include "./conn.php";
$pid = $_POST['productid'];
$size = $_POST['size'];
$sizedetail = $obj->selectextrawhere("sizedetail", "productid=" . $pid . " and sizename='" . $size . "'"); //->fetch_assoc();
// print_r($sizedetail);
?>
<div>
    <table class="table table-bordered mt-3">
        <thead>
            <!-- <th>Name</th> -->
            <th>Length</th>
            <th>Height</th>
            <th>Width</th>
            <th>Unit</th>
        </thead>
        <?php
        while ($rowdetail = $obj->fetch_assoc($sizedetail)) { ?>
            <tbody>
                <!-- <th><?= $rowdetail['sizename'] ?></th> -->
                <td><?= $rowdetail['length'] ?></td>
                <td><?= $rowdetail['height'] ?></td>
                <td><?= $rowdetail['width'] ?></td>
                <td><?= $rowdetail['unit'] ?></td>
            </tbody>
        <?php } ?>
    </table>
</div>