<?php
include "../session.php";
// @var obj db
ob_start();
$id = $_GET["hakuna"];
$fieldname = (isset($_GET["fieldname"])) ? $_GET["fieldname"] : "indian_state";
$data = $obj->selectextrawhereupdate("state_list", "id,state", "status =1");
$row = mysqli_fetch_all($data);
?>

<div class="form-group row">
    <label for="shipping_state" class="col-sm-12 col-form-label">State</label>
    <div class="col-sm-12">

        <select id="state" class="form-control select2" data-bvalidator="required" name="<?= $fieldname ?>" style="width: 100%;">
            <option value="">Select State</option>
            <?php foreach ($row as list($id, $state_name)) {
                if ($id == $_GET["what"]) { ?>
                    <option value="<?php echo $id ?>" selected><?php echo $state_name ?></option> <?php } else { ?>
                    <option value="<?php echo $id ?>"> <?php echo  $state_name ?></option>
            <?php }
                                                                                            } ?>
        </select>
    </div>
</div>