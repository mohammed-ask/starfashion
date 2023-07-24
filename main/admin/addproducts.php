<?php
include "main/session.php";
?>
<!-- <div class="row">
    <div class="col-12  mobile-bottom-margin">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Add Products</h3>
            </div> -->
<form style="overflow-x: hidden;" id="adduser" onsubmit="event.preventDefault();sendForm('', '', 'insertproducts', 'resultid', 'adduser');return 0;">
    <label class="block text-sm" style="margin-bottom: 5px;">

        <span class="text-gray-700 dark:text-gray-400">Product Display Position</span>
        <select data-bvalidator="required" class="form-control" name="product_display_position[]" multiple>
            <option value="Featured">Featured</option>
            <option value="Best Seller">Best Seller</option>
            <option value="Special">Special</option>
            <option value="Latest">Latest</option>
            <option value="New Arrival">New Arrival</option>
            <option value="Hot Sales">Hot Sales</option>
        </select>
    </label>
    <label class="block text-md">
        <span class="text-gray-700 dark:text-gray-400">Size</span>
        <select data-bvalidator="required" class="form-control" name="size[]" multiple>
            <option value="Any">Any</option>
            <option value="Free Size">Free Size</option>
            <option value="S">S</option>
            <option value="M">M</option>
            <option value="L">L</option>
            <option value="XL">XL</option>
            <option value="XXl">XXl</option>
            <option value="XXXl">XXXl</option>
        </select>
    </label><br>
    <label class="block text-md" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Category</span>
        <select data-bvalidator="required" class="form-control select2" name="category_id" id="categoryid">
            <option value="">Select Category</option>
            <?php
            $category = $obj->selectextrawhereupdate("subcategories", "id,name", "status = 1");
            $cat = mysqli_fetch_all($category);
            foreach ($cat as list($id, $name)) { ?>
                <option value="<?php echo $id; ?>"> <?php echo $name; ?></option>
            <?php
            } ?>
        </select>
    </label><br>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Product Name</span>
        <input name="product_name" data-bvalidator="required" class="form-control" placeholder="Product Name" />
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Product Title</span>
        <input name="product_title" class="form-control" placeholder="Product description" />
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Brand</span>
        <input xdata-bvalidator="required" class="form-control" name="brand">
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Model</span>
        <input xdata-bvalidator="required" class="form-control" name="model">
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">SKU</span>
        <input xdata-bvalidator="required" class="form-control" name="sku">
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Description</span>
        <input xdata-bvalidator="required" class="form-control" name="description">
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Is Active</span>
        <select data-bvalidator="required" name="isactive" class="block w-full  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>
    </label>
    <label class="block text-md">
        <span class="text-gray-700 dark:text-gray-400">Product Condition</span>
        <select data-bvalidator="required" class="form-control select2" name="product_condition">
            <option value="New">New</option>
            <option value="Used">Used</option>
            <option value="Old">Old</option>
            <option value="Repaired">Repaired</option>

        </select>
    </label><br>
    <label class="block text-md">
        <span class="text-gray-700 dark:text-gray-400">Sticker Option</span>
        <select data-bvalidator="required" class="form-control select2" name="sticker">
            <option value="None">None</option>
            <option value="Sale">Sale</option>
            <option value="New">New</option>
        </select>
    </label><br>
    <label class="block text-md">
        <span class="text-gray-700 dark:text-gray-400">Gender</span>
        <select data-bvalidator="required" class="form-control select2" name="gender_for">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
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
                <option value="<?php echo $id; ?>"> <?php echo $name; ?></option>
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
            foreach ($cat as list($id, $name)) { ?>
                <option value="<?php echo $name; ?>"> <?php echo $name; ?></option>
            <?php
            } ?>
        </select>
        <!-- <input xdata-bvalidator="required" class="form-control" name="occasions"> -->
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Material Used</span>
        <input xdata-bvalidator="required" class="form-control" name="material_used">
    </label>

    <label class="block text-md">
        <span class="text-gray-700 dark:text-gray-400">Color</span>
        <select data-bvalidator="required" class="form-control select2" name="color">
            <option value="Not Specific">Not Specific</option>
            <option value="WHITE">WHITE</option>
            <option value="BLACK">BLACK</option>
            <option value="RED">RED</option>
            <option value="BLUE">BLUE</option>
            <option value="YELLOW">YELLOW</option>
            <option value="GREEN">GREEN</option>
        </select>
    </label><br>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Width x Height x Length</span>
        <div class="row ml-1 mr-1">
            <input type="number" step="any" placeholder="Width" xdata-bvalidator="required" class="form-control col-sm-4" name="width">
            <input type="number" step="any" placeholder="Height" xdata-bvalidator="required" class="form-control col-sm-4" name="height">
            <input type="number" step="any" placeholder="Length" xdata-bvalidator="required" class="form-control col-sm-4" name="length">
            <select data-bvalidator="required" class="form-control select2 col-sm-3" name="width_height_length_unit">
                <option value="Meter">Meter</option>
                <option value="Feet">Feet</option>
                <option value="CM">CM</option>
            </select>
        </div>
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Weight</span>
        <div class="row ml-1 mr-1">
            <input type="number" step="any" placeholder="Weight" xdata-bvalidator="required" class="form-control col-sm-12" name="weight">
            <select data-bvalidator="required" class="form-control select2 col-sm-3" name="weight_unit">
                <option value="Gram">Gram</option>
                <option value="KG">KG</option>
            </select>
        </div>
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Price</span>
        <input xdata-bvalidator="required" class="form-control" name="price">
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Discount</span>
        <input xdata-bvalidator="required" class="form-control" name="discount">
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Net Price</span>
        <input xdata-bvalidator="required" class="form-control" name="net_price">
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Currency</span>
        <input xdata-bvalidator="required" class="form-control" name="currency">
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Affiliated Commision</span>
        <input xdata-bvalidator="required" class="form-control" name="affiliate_commission">
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Product Image</span>
        <input xdata-bvalidator="required" class="form-control" type="file" name="image">
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Terms & Condition</span>
        <textarea xdata-bvalidator="required" class="form-control" name="term_condition"></textarea>
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Delivery Info</span>
        <textarea xdata-bvalidator="required" class="form-control" name="delivery_info"></textarea>
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Damage Return</span>
        <textarea xdata-bvalidator="required" class="form-control" name="damage_return"></textarea>
    </label>

    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">GST Percent</span>
        <select data-bvalidator="required" class="form-control select2" name="gstrate">
            <option value="0">0%</option>
            <option value="5">5%</option>
            <option value="12">12%</option>
            <option value="18">18%</option>
            <option value="28">28%</option>
        </select>
    </label>
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