<?php
include "main/session.php";
$sid = $_GET['hakuna'];
$result = $obj->selectextrawhere("slide", "id=$sid");
$row = $obj->fetch_assoc($result);
?>
<form id="categoryupdate" onsubmit="event.preventDefault();sendForm('id', '<?php echo $sid; ?>', 'updateslides', 'resultid', 'categoryupdate');return 0;" data-bvalidator-validate>
    <div class="form-group">
        <label for="name">Heading</label>
        <input type="text" name="heading" class="form-control" value="<?php echo $row['heading'] ?>" id="name" placeholder="Enter category name" data-bvalidator="required">
    </div>
    <div class="form-group">
        <label for="name">Title</label>
        <input type="text" name="title" class="form-control" value="<?php echo $row['title'] ?>" id="name" placeholder="Enter category name" data-bvalidator="required">
    </div>
    <div class="form-group">
        <label for="descripton">Description</label>
        <textarea type="text" style="resize:none" name="desc" class="form-control" id="description" placeholder="Enter sub Description" data-bvalidator="required"><?php echo $row['desc'] ?></textarea>
    </div>
    <label class="block text-md" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Occasion</span>
        <select data-bvalidator="required" class="form-control select2" name="occasion[]" id="occasion" multiple>
            <?php
            $occasion = $obj->selectextrawhereupdate("occasion", "id,name", "status = 1");
            $occ = mysqli_fetch_all($occasion);
            foreach ($occ as list($id, $name)) {
                $isSelected = in_array($name, explode(',', $row['occasion']));
                echo '<option value="' . $name . '" ' . ($isSelected ? 'selected' : '') . '>' . $name . '</option>';
            ?>
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
            foreach ($pro as list($id, $name)) {
                $isSelected = in_array($id, explode(',', $row['productid']));
                echo '<option value="' . $id . '" ' . ($isSelected ? 'selected' : '') . '>' . $name . '</option>'; ?>
            <?php
            } ?>
        </select>
    </label><br>
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