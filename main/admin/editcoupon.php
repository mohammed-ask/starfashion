<?php
include "main/session.php";
$couponid = $_GET['hakuna'];
$result = $obj->selectextrawhere("coupon", "id=$couponid");
$row = $obj->fetch_assoc($result);
?>
<form style="overflow-x: hidden;" id="adduser" onsubmit="event.preventDefault();sendForm('id', '<?= $couponid ?>', 'updatecoupon', 'resultid', 'adduser');return 0;">
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Coupon Name</span>
        <input name="name" data-bvalidator="required" class="block w-full  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="<?php echo $row['name'] ?>" placeholder="Coupon Name" />
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Type</span>
        <select data-bvalidator="required" class="form-control select2" name="type" id="type">
            <option value="">Select Type</option>
            <option value="Amount" <?= $row['type'] === 'Amount' ? 'selected' : null ?>>Amount</option>
            <option value="Percent" <?= $row['type'] === 'Percent' ? 'selected' : null ?>>Percent</option>
        </select>
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Number</span>
        <input type="number" step="any" name="number" class="block w-full  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="<?php echo $row['number'] ?>" placeholder="Number" />
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Order Above</span>
        <input type="number" step="any" name="orderabove" class="block w-full  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="<?php echo $row['orderabove'] ?>" placeholder="Number" value="0" />
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Expire Date</span>
        <input id="date" name="expirydate" onfocus="setcalenderlimit(this.id,'')" class="block w-full  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Select Date & Time" value="<?php echo changedateformatespecito($row['expirydate'], "Y-m-d", "d/m/Y") ?>" data-bvalidator='required' />
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