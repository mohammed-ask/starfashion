<?php
include "main/session.php";
$pid = $_GET['hakuna'];
$result = $obj->selectextrawhere("products", "id=$pid");
$sizes = $obj->selectextrawhere("sizedetail", "productid=$pid and status = 1");
$row = $obj->fetch_assoc($result);
?>
<!-- <div class="row">
    <div class="col-12  mobile-bottom-margin">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Add Products</h3>
            </div> -->
<form style="overflow-x: hidden;" id="adduser" onsubmit="event.preventDefault();sendForm('id', '<?= $pid ?>', 'updateproducts', 'resultid', 'adduser');return 0;">
    <label class="block text-sm" style="margin-bottom: 5px;">

        <span class="text-gray-700 dark:text-gray-400">Product Display Position</span>
        <select data-bvalidator="required" class="form-control" name="product_display_position[]" multiple>
            <option <?php echo (in_array("Featured", explode(",", $row['product_display_position']))) ? 'selected="selected"' : ''; ?> value="Featured">Featured</option>
            <option <?php echo (in_array("Best Seller", explode(",", $row['product_display_position']))) ? 'selected="selected"' : ''; ?> value="Best Seller">Best Seller</option>
            <option <?php echo (in_array("Special", explode(",", $row['product_display_position']))) ? 'selected="selected"' : ''; ?> value="Special">Special</option>
            <option <?php echo (in_array("Latest", explode(",", $row['product_display_position']))) ? 'selected="selected"' : ''; ?> value="Latest">Latest</option>
            <option <?php echo (in_array("New Arrival", explode(",", $row['product_display_position']))) ? 'selected="selected"' : ''; ?> value="New Arrival">New Arrival</option>
            <option <?php echo (in_array("Hot Sales", explode(",", $row['product_display_position']))) ? 'selected="selected"' : ''; ?> value="Hot Sales">Hot Sales</option>
        </select>
    </label>

    <label class="block text-md" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Category</span>
        <select data-bvalidator="required" class="form-control select2" name="category_id" id="categoryid">
            <option value="">Select Category</option>
            <?php
            $category = $obj->selectextrawhereupdate("subcategories", "id,name", "status = 1");
            $cat = mysqli_fetch_all($category);
            foreach ($cat as list($id, $name)) { ?>
                <option value="<?php echo $id; ?>" <?= ($id == $row['category_id']) ? 'selected' : '' ?>> <?php echo $name; ?></option>
            <?php
            } ?>
        </select>
    </label><br>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Product Name</span>
        <input name="product_name" data-bvalidator="required" class="form-control" value="<?= $row['product_name'] ?>" placeholder="Product Name" />
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Product Title</span>
        <input name="product_title" class="form-control" value="<?= $row['product_name'] ?>" placeholder="Product description" />
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Brand</span>
        <input xdata-bvalidator="required" class="form-control" value="<?= $row['brand'] ?>" name="brand">
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Model</span>
        <input xdata-bvalidator="required" class="form-control" value="<?= $row['model'] ?>" name="model">
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">SKU</span>
        <input xdata-bvalidator="required" class="form-control" value="<?= $row['sku'] ?>" name="sku">
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Description</span>
        <input xdata-bvalidator="required" class="form-control" value="<?= $row['description'] ?>" name="description">
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Is Active</span>
        <select data-bvalidator="required" name="isactive" class="block w-full  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
            <option value="Yes" <?= $row['isactive'] === "Yes" ? "Selected" : "" ?>>Yes</option>
            <option value="No" <?= $row['isactive'] === "No" ? "Selected" : "" ?>>No</option>
        </select>
    </label>
    <label class="block text-md">
        <span class="text-gray-700 dark:text-gray-400">Product Condition</span>
        <select data-bvalidator="required" class="form-control select2" name="product_condition">
            <option value="New" <?= $row['product_condition'] === "New" ? "Selected" : "" ?>>New</option>
            <option value="Used" <?= $row['product_condition'] === "Used" ? "Selected" : "" ?>>Used</option>
            <option value="Old" <?= $row['product_condition'] === "Old" ? "Selected" : "" ?>>Old</option>
            <option value="Repaired" <?= $row['product_condition'] === "Repaired" ? "Selected" : "" ?>>Repaired</option>

        </select>
    </label><br>
    <label class="block text-md">
        <span class="text-gray-700 dark:text-gray-400">Sticker Option</span>
        <select data-bvalidator="required" class="form-control select2" name="sticker">
            <option value="None" <?= $row['sticker'] === "None" ? "Selected" : "" ?>>None</option>
            <option value="Sale" <?= $row['sticker'] === "Sale" ? "Selected" : "" ?>>Sale</option>
            <option value="New" <?= $row['sticker'] === "New" ? "Selected" : "" ?>>New</option>
        </select>
    </label><br>
    <label class="block text-md">
        <span class="text-gray-700 dark:text-gray-400">Gender</span>
        <select data-bvalidator="required" class="form-control select2" name="gender_for">
            <option value="Male" <?= $row['gender_for'] === "Male" ? "Selected" : "" ?>>Male</option>
            <option value="Female" <?= $row['gender_for'] === "Female" ? "Selected" : "" ?>>Female</option>
            <option value="Other" <?= $row['gender_for'] === "Other" ? "Selected" : "" ?>>Other</option>
        </select>
    </label><br>
    <label class="block text-md">
        <span class="text-gray-700 dark:text-gray-400">Age For</span>
        <select data-bvalidator="required" class="form-control select2" name="age_for" id="age">
            <option value="">Age For</option>
            <?php
            $category = $obj->selectextrawhereupdate("agegroup", "id,name", "status = 1");
            $cat = mysqli_fetch_all($category);
            foreach ($cat as list($id, $name)) { ?>
                <option value="<?php echo $id; ?>" <?= ($id == $row['age_for']) ? 'selected' : '' ?>> <?php echo $name; ?></option>
            <?php
            } ?>
        </select>
    </label><br>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Occasions</span>
        <select data-bvalidator="required" class="form-control" name="occasions[]" id="occasions" multiple>
            <?php
            $category = $obj->selectextrawhereupdate("occasion", "id,name", "status = 1");
            $cat = mysqli_fetch_all($category);
            foreach ($cat as list($id, $name)) {
                $isSelected = in_array($name, explode(',', $row['occasions']));
                echo '<option value="' . $name . '" ' . ($isSelected ? 'selected' : '') . '>' . $name . '</option>';
            } ?>
        </select>
        <!-- <input xdata-bvalidator="required" class="form-control" value="<?= $row['occasions'] ?>" name="occasions"> -->
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Material Used</span>
        <input xdata-bvalidator="required" class="form-control" value="<?= $row['material_used'] ?>" name="material_used">
    </label>

    <label class="block text-md">
        <span class="text-gray-700 dark:text-gray-400">Color</span>
        <select data-bvalidator="required" class="form-control select2" name="color">
            <option value="Not Specific" <?= $row['color'] === "Not Specific" ? "Selected" : "" ?>>Not Specific</option>
            <option value="WHITE" <?= $row['color'] === "WHITE" ? "Selected" : "" ?>>WHITE</option>
            <option value="BLACK" <?= $row['color'] === "BLACK" ? "Selected" : "" ?>>BLACK</option>
            <option value="RED" <?= $row['color'] === "RED" ? "Selected" : "" ?>>RED</option>
            <option value="BLUE" <?= $row['color'] === "BLUE" ? "Selected" : "" ?>>BLUE</option>
            <option value="YELLOW" <?= $row['color'] === "YELLOW" ? "Selected" : "" ?>>YELLOW</option>
            <option value="GREEN" <?= $row['color'] === "GREEN" ? "Selected" : "" ?>>GREEN</option>
        </select>
    </label><br>
    <label class="block text-md">
        <span class="text-gray-700 dark:text-gray-400">Size</span>
        <select data-bvalidator="required" class="form-control" name="size[]" multiple>
            <option <?php echo (in_array("Any", explode(",", $row['size']))) ? 'selected="selected"' : ''; ?> value="Any">Any</option>
            <option <?php echo (in_array("S", explode(",", $row['size']))) ? 'selected="selected"' : ''; ?> value="S">S</option>
            <option <?php echo (in_array("M", explode(",", $row['size']))) ? 'selected="selected"' : ''; ?> value="M">M</option>
            <option <?php echo (in_array("L", explode(",", $row['size']))) ? 'selected="selected"' : ''; ?> value="L">L</option>
            <option <?php echo (in_array("XL", explode(",", $row['size']))) ? 'selected="selected"' : ''; ?> value="XL">XL</option>
            <option <?php echo (in_array("XXl", explode(",", $row['size']))) ? 'selected="selected"' : ''; ?> value="XXl">XXL</option>
            <option <?php echo (in_array("XXXl", explode(",", $row['size']))) ? 'selected="selected"' : ''; ?> value="XXXl">XXXL</option>
        </select>
    </label><br>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Width x Height x Length</span>
        <div class="sizedata">
            <?php
            while ($rowsize = $obj->fetch_assoc($sizes)) { ?>
                <div class="row ml-1 mr-1 mb-4">
                    <input type="number" step="any" placeholder="Width" xdata-bvalidator="required" value="<?= $rowsize['width'] ?>" class="form-control col-sm-4" name="width[]">
                    <input type="number" step="any" placeholder="Height" xdata-bvalidator="required" value="<?= $rowsize['height'] ?>" class="form-control col-sm-4" name="height[]">
                    <input type="number" step="any" placeholder="Length" xdata-bvalidator="required" value="<?= $rowsize['length'] ?>" class="form-control col-sm-4" name="length[]">
                    <select data-bvalidator="required" class="form-control select2 col-sm-3" name="unit[]">
                        <option value="Meter" <?= $rowsize['unit'] === "Meter" ? "Selected" : "" ?>>Meter</option>
                        <option value="Feet" <?= $rowsize['unit'] === "Feet" ? "Selected" : "" ?>>Feet</option>
                        <option value="CM" <?= $rowsize['unit'] === "CM" ? "Selected" : "" ?>>CM</option>
                    </select>
                    <!-- <label class="block text-md"> -->
                    <!-- <span class="text-gray-700 dark:text-gray-400">Size</span> -->
                    <select data-bvalidator="required" class="form-control select2" name="sizename[]">
                        <!-- <option value="Any">Any</option> -->
                        <!-- <option value="Free Size">Free Size</option> -->
                        <option value="S" <?= $rowsize['sizename'] === "S" ? "Selected" : "" ?>>S</option>
                        <option value="M" <?= $rowsize['sizename'] === "M" ? "Selected" : "" ?>>M</option>
                        <option value="L" <?= $rowsize['sizename'] === "L" ? "Selected" : "" ?>>L</option>
                        <option value="XL" <?= $rowsize['sizename'] === "XL" ? "Selected" : "" ?>>XL</option>
                        <option value="XXl" <?= $rowsize['sizename'] === "XXl" ? "Selected" : "" ?>>XXl</option>
                        <option value="XXXl" <?= $rowsize['sizename'] === "XXXl" ? "Selected" : "" ?>>XXXl</option>
                    </select>
                    <!-- </label><br> -->
                </div>
            <?php } ?>
        </div>
        <button onclick="event.preventDefault();addsizes()" class="px-4 py-2  text-sm  bg-blue  rounded-lg">Add Size</button>

    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Weight</span>
        <div class="row ml-1 mr-1">
            <input type="number" step="any" placeholder="Weight" xdata-bvalidator="required" class="form-control col-sm-12" name="weight">
            <select data-bvalidator="required" class="form-control select2 col-sm-3" name="weight_unit">
                <option value="Gram" <?= $row['weight'] === "Gram" ? "Selected" : "" ?>>Gram</option>
                <option value="KG" <?= $row['weight'] === "KG" ? "Selected" : "" ?>>KG</option>
            </select>
        </div>
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Price</span>
        <input xdata-bvalidator="required" class="form-control" value="<?= $row['price'] ?>" name="price">
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Discount</span>
        <input xdata-bvalidator="required" class="form-control" value="<?= $row['discount'] ?>" name="discount">
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Net Price</span>
        <input xdata-bvalidator="required" class="form-control" value="<?= $row['net_price'] ?>" name="net_price">
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">GST Percent</span>
        <select data-bvalidator="required" class="form-control select2" name="gstrate" id="gstrate">
            <?php
            $gst = $obj->selectextrawhereupdate("tax", "id,name", "status = 1");
            $cat = mysqli_fetch_all($gst);
            foreach ($cat as list($id, $name)) { ?>
                <option value="<?php echo $id; ?>" <?= ($id == $row['gstrate']) ? 'selected' : '' ?>> <?php echo $name; ?></option>
            <?php
            } ?>
        </select>
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Net Price</span>
        <input xdata-bvalidator="required" class="form-control" value="<?= $row['final_price'] ?>" name="final_price">
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Currency</span>
        <input xdata-bvalidator="required" class="form-control" value="<?= $row['currency'] ?>" name="currency">
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Affiliated Commision</span>
        <input xdata-bvalidator="required" class="form-control" value="<?= $row['affiliate_commission'] ?>" name="affiliate_commission">
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Product Image</span>
        <input xdata-bvalidator="required" class="form-control" type="file" name="image">
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Terms & Condition</span>
        <textarea xdata-bvalidator="required" class="form-control" name="term_condition"><?= $row['term_condition'] ?></textarea>
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Delivery Info</span>
        <textarea xdata-bvalidator="required" class="form-control" name="delivery_info"><?= $row['delivery_info'] ?></textarea>
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Damage Return</span>
        <textarea xdata-bvalidator="required" class="form-control" name="damage_return"><?= $row['damage_return'] ?></textarea>
    </label>
    <label class="block text-md">
        <span class="text-gray-700 dark:text-gray-400">Stock Status</span>
        <select data-bvalidator="required" class="form-control select2" name="stockstatus">
            <option value="Available" <?= $row['stockstatus'] === "Available" ? "Selected" : "" ?>>Available</option>
            <option value="Out of stock" <?= $row['stockstatus'] === "Out of stock" ? "Selected" : "" ?>>Out of stock</option>
            <option value="Just a few left" <?= $row['stockstatus'] === "Just a few left" ? "Selected" : "" ?>>Just a few left</option>
        </select>
    </label><br>
    <div>
        <button type="submit" id="modalsubmit" class="px-4 py-2  text-sm  bg-blue  rounded-lg hidden">Submit</button>
        <div id="resultid" class="form-result"></div>
    </div>
</form>
<!-- </div>
    </div>
</div> -->


<?php
// $pagemaincontent = ob_get_clean();
// ob_clean();
// $extracss = "";
// $extrajs = '
// <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
// ';
// $pagemeta = "";
// $pagetitle = "Add Products::.Manage Products";
// $pageheader = "Manage Products";
// include "main/admin/templete.php";
?>
<script>
    $(".select2").select2({
        minimumResultsForSearch: -1
    })
</script>