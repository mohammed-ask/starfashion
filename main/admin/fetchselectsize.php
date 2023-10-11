<div class="row ml-1 mr-1 mb-4">
    <input type="number" step="any" placeholder="Width" xdata-bvalidator="required" class="form-control col-sm-3" name="width[]">
    <input type="number" step="any" placeholder="Height" xdata-bvalidator="required" class="form-control col-sm-3" name="height[]">
    <input type="number" step="any" placeholder="Length" xdata-bvalidator="required" class="form-control col-sm-3" name="length[]">
    <button class='col-sm-2 offset-1 btn-sm btn-danger cls' onclick='event.preventDefault()'><i class='fa fa-times' style="color:white" aria-hidden='true'></i></button>
    <select data-bvalidator="required" class="form-control select2 col-sm-3" name="unit[]">
        <option value="Meter">Meter</option>
        <option value="Feet">Feet</option>
        <option value="CM">CM</option>
    </select>
    <!-- <label class="block text-md"> -->
    <!-- <span class="text-gray-700 dark:text-gray-400">Size</span> -->
    <select data-bvalidator="required" class="form-control select2" name="sizename[]">
        <!-- <option value="Any">Any</option> -->
        <!-- <option value="Free Size">Free Size</option> -->
        <option value="S">S</option>
        <option value="M">M</option>
        <option value="L">L</option>
        <option value="XL">XL</option>
        <option value="XXl">XXl</option>
        <option value="XXXl">XXXl</option>
    </select>
    <!-- </label><br> -->
</div>