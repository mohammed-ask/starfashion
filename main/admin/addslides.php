<?php
include "main/session.php";
?>
<form style="overflow-x: hidden;" id="adduser" onsubmit="event.preventDefault();sendForm('', '', 'insertslides', 'resultid', 'adduser');return 0;">
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Heading</span>
        <input name="heading" data-bvalidator="required" class="block w-full  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Enter Heading" />
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Title</span>
        <input name="title" data-bvalidator="required" class="block w-full  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Enter Title" />
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Description</span>
        <input name="desc" class="block w-full  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="description" />
    </label>
    <label class="block text-md" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Occasion</span>
        <select data-bvalidator="required" class="form-control select2" name="occasion[]" id="occasion" multiple>
            <?php
            $occasion = $obj->selectextrawhereupdate("occasion", "id,name", "status = 1");
            $occ = mysqli_fetch_all($occasion);
            foreach ($occ as list($id, $name)) { ?>
                <option value="<?php echo $name; ?>"> <?php echo $name; ?></option>
            <?php
            } ?>
        </select>
    </label><br>
    <label class="block text-md" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Product</span>
        <select data-bvalidator="required" class="form-control select2" name="productid[]" id="productid" multiple>
            <?php
            $prod = $obj->selectextrawhereupdate("products", "id,product_name", "status = 1");
            $pro = mysqli_fetch_all($prod);
            foreach ($pro as list($id, $name)) { ?>
                <option value="<?php echo $id; ?>"> <?php echo $name; ?></option>
            <?php
            } ?>
        </select>
    </label><br>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Slide Image</span>
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