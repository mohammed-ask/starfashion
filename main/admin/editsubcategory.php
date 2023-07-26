<?php
include "main/session.php";
$category_id = $_GET['hakuna'];
$result = $obj->selectextrawhere("subcategories", "id=$category_id");
$row = $obj->fetch_assoc($result);
?>
<form id="categoryupdate" onsubmit="event.preventDefault();sendForm('id', '<?php echo $category_id; ?>', 'updatesubcategory', 'resultid', 'categoryupdate');return 0;" data-bvalidator-validate>
    <div class="form-group">
        <label for="name">Subcategory Name</label>
        <input type="text" name="name" class="form-control" value="<?php echo $row['name'] ?>" id="name" placeholder="Enter category name" data-bvalidator="required">
    </div>
    <div class="form-group">
        <label for="descripton">Description</label>
        <textarea type="text" style="resize:none" name="desc" class="form-control" id="description" placeholder="Enter sub Description" data-bvalidator="required"><?php echo $row['desc'] ?></textarea>
    </div>
    <label class="block text-md" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Category</span>
        <select data-bvalidator="required" class="form-control select2" name="categoryid" id="categoryid">
            <option value="">Select Category</option>
            <?php
            $category = $obj->selectextrawhereupdate("categories", "id,name", "status = 1");
            $cat = mysqli_fetch_all($category);
            foreach ($cat as list($id, $name)) { ?>
                <option value="<?php echo $id; ?>" <?= ($id == $row['categoryid']) ? 'selected' : '' ?>> <?php echo $name; ?></option>
            <?php
            } ?>
        </select>
    </label>
    <label class="block text-md">
        <span class="text-gray-700 dark:text-gray-400">Tax</span>
        <select data-bvalidator="required" class="form-control select2" name="tax" id="tax">
            <option value="">Select Tax</option>
            <?php
            $category = $obj->selectextrawhereupdate("tax", "id,description", "status = 1");
            $cat = mysqli_fetch_all($category);
            foreach ($cat as list($id, $name)) { ?>
                <option value="<?php echo $id; ?>" value="<?php echo $id; ?>" <?= ($id == $row['tax']) ? 'selected' : '' ?>> <?php echo $name; ?></option>
            <?php
            } ?>
        </select>
    </label>
    <label class="block text-md">
        <span class="text-gray-700 dark:text-gray-400">Unit</span>
        <select data-bvalidator="required" class="form-control select2" name="unit" id="unit">
            <option value="">Select Unit</option>
            <?php
            $category = $obj->selectextrawhereupdate("units", "id,name", "status = 1");
            $cat = mysqli_fetch_all($category);
            foreach ($cat as list($id, $name)) { ?>
                <option value="<?php echo $id; ?>" value="<?php echo $id; ?>" <?= ($id == $row['unit']) ? 'selected' : '' ?>> <?php echo $name; ?></option>
            <?php
            } ?>
        </select>
    </label>
    <label class="block text-md">
        <span class="text-gray-700 dark:text-gray-400">Unit</span>
        <select data-bvalidator="required" class="form-control select2" name="unit" id="unit">
            <option value="">Select Unit</option>
            <?php
            $category = $obj->selectextrawhereupdate("units", "id,name", "status = 1");
            $cat = mysqli_fetch_all($category);
            foreach ($cat as list($id, $name)) { ?>
                <option value="<?php echo $id; ?>" value="<?php echo $id; ?>" <?= ($id == $row['unit']) ? 'selected' : '' ?>> <?php echo $name; ?></option>
            <?php
            } ?>
        </select>
    </label>
    <label class="block text-md">
        <span class="text-gray-700 dark:text-gray-400">Type</span>
        <select data-bvalidator="required" class="form-control select2" name="type" id="type">
            <option value="">Select Type</option>
            <?php
            $category = $obj->selectextrawhereupdate("type", "id,name", "status = 1");
            $cat = mysqli_fetch_all($category);
            foreach ($cat as list($id, $name)) { ?>
                <option value="<?php echo $id; ?>" value="<?php echo $id; ?>" <?= ($id == $row['type']) ? 'selected' : '' ?>> <?php echo $name; ?></option>
            <?php
            } ?>
        </select>
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">HSN Code</span>
        <input name="hsn" class="block w-full  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="<?= $row['hsn'] ?>" placeholder="Enter HSN Code" />
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Subcategory Image</span>
        <input style="padding: 0px; border-color: #00aaaa; font-size: 14px;" xdata-bvalidator="required" class="form-control" type="file" name="image">
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Is Active</span>
        <select data-bvalidator="required" name="isactive" class="block w-full  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
            <option value="Yes" <?= $row['isactive'] === 'Yes' ? 'selected' : null ?>>Yes</option>
            <option value="No" <?= $row['isactive'] === 'No' ? 'selected' : null ?>>No</option>
        </select>
    </label>
    <div>
        <button type="submit" id="modalsubmit" hidden class="btn btn-primary">Submit</button>
        <div id="resultid"> </div>
</form>
<script>
    $("select").select2({
        minimumResultsForSearch: -1
    })
</script>