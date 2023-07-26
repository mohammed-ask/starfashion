<?php
include "main/session.php";
?>
<form style="overflow-x: hidden;" id="adduser" onsubmit="event.preventDefault();sendForm('', '', 'insertsubcategory', 'resultid', 'adduser');return 0;">
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Subcategory Name</span>
        <input name="name" data-bvalidator="required" class="block w-full  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Category Name" />
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Subcategory Description</span>
        <input name="desc" class="block w-full  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Category description" />
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Code</span>
        <input name="code" class="block w-full  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Category description" />
    </label>
    <label class="block text-md" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Category</span>
        <select data-bvalidator="required" class="form-control select2" name="categoryid" id="categoryid">
            <option value="">Select Category</option>
            <?php
            $category = $obj->selectextrawhereupdate("categories", "id,name", "status = 1");
            $cat = mysqli_fetch_all($category);
            foreach ($cat as list($id, $name)) { ?>
                <option value="<?php echo $id; ?>"> <?php echo $name; ?></option>
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
                <option value="<?php echo $id; ?>"> <?php echo $name; ?></option>
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
                <option value="<?php echo $id; ?>"> <?php echo $name; ?></option>
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
                <option value="<?php echo $id; ?>"> <?php echo $name; ?></option>
            <?php
            } ?>
        </select>
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">HSN Code</span>
        <input name="hsn" class="block w-full  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Enter HSN Code" />
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Subcategory Image</span>
        <input style="padding: 0px; border-color: #00aaaa; font-size: 14px;" xdata-bvalidator="required" class="form-control" type="file" name="image">
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Is Active</span>
        <select data-bvalidator="required" name="isactive" class="block w-full  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>
    </label>
    <div>
        <button type="submit" id="modalsubmit" class="w-full px-3 py-1 mt-6 text-sm font-medium hidden">
            Submit
        </button>
    </div>
    <div id="resultid"></div>
</form>
<script>
    $("select").select2({
        minimumResultsForSearch: -1
    })
</script>