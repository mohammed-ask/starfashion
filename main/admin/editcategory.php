<?php
include "main/session.php";
$category_id = $_GET['hakuna'];
$result = $obj->selectextrawhere("categories", "id=$category_id");
$row = $obj->fetch_assoc($result);
?>
<form id="categoryupdate" onsubmit="event.preventDefault();sendForm('id', '<?php echo $category_id; ?>', 'updatecategory', 'resultid', 'categoryupdate');return 0;" data-bvalidator-validate>
    <div class="form-group">
        <label for="name">Category Name</label>
        <input type="text" name="name" class="form-control" value="<?php echo $row['name'] ?>" id="name" placeholder="Enter category name" data-bvalidator="required">
    </div>
    <div class="form-group">
        <label for="descripton">Description</label>
        <textarea type="text" style="resize:none" name="desc" class="form-control" id="description" placeholder="Enter sub Description" data-bvalidator="required"><?php echo $row['desc'] ?></textarea>
    </div>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Category Image</span>
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