<?php
include "main/session.php";
$id = $_GET['hakuna'];
$rowuser = $obj->selectextrawhere('users', 'id="' . $id . '"')->fetch_assoc();
?>
<form id="adduser" onsubmit="event.preventDefault();sendForm('id', '<?= $id ?>', 'updateuser', 'resultid', 'adduser');return 0;">
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Name</span>
        <input name="username" data-bvalidator="required" class="block w-full  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="<?= $rowuser['name'] ?>" placeholder="Client's Name" />
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Email</span>
        <input name="email" data-bvalidator="required,email" class="block w-full  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="<?= $rowuser['email'] ?>" placeholder="Client's Email ID" />
    </label>

    <div class="row">
        <label class="col-6 block text-sm" style="margin-bottom: 5px;">
            <span class="text-gray-700 dark:text-gray-400">Mob No.</span>
            <input data-bvalidator="required,digit,minlength[10],maxlength[10]" name="mobileno" class="block w-full  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="<?= $rowuser['mobile'] ?>" placeholder="Client's Mobile No." />
        </label>
        <label class="col-6 block text-sm" style="margin-bottom: 5px;">
            <span class="text-gray-700 dark:text-gray-400">DOB</span>
            <input id="date" data-bvalidator="required,gap18year" onfocus="setcalenderlimit(this.id,'')" data-bvalidator-msg-gap18year="Customer Should be minimum 18 year Old" name="dob" class="block w-full  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="<?= changedateformatespecito($rowuser['dob'], "Y-m-d", "d/m/Y") ?>" placeholder="Date of Birth" /></label>
    </div>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Address</span>
        <input data-bvalidator="required" name="address" class="block w-full  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="<?= $rowuser['address'] ?>" placeholder="Client's Address" />
    </label>

    <div class="row">
        <label class="col-6 block text-sm" style="margin-bottom: 5px;">
            <span class="text-gray-700 dark:text-gray-400">Aadhar No.</span>
            <input data-bvalidator="required" name="adharno" class="block w-full  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="<?= $rowuser['adharno'] ?>" placeholder="Enter 12 Digit Aadhar No." /></label>
        <label class="col-6 block text-sm" style="margin-bottom: 5px;">
            <span class="text-gray-700 dark:text-gray-400">PAN No.</span>
            <input data-bvalidator="required" name="panno" class="block w-full  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="<?= $rowuser['panno'] ?>" placeholder="Client's Pan No." /></label>
    </div>

    <div class="row">
        <label class="col-6 block text-sm" style="margin-bottom: 5px;">
            <span class="text-gray-700 dark:text-gray-400">Bank Name</span>
            <input data-bvalidator="required" name="bankname" class="block w-full  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="<?= $rowuser['bankname'] ?>" placeholder="eg. BOI, State bank of India, Kotak etc..." /></label>

        <label class="col-6 block text-sm" style="margin-bottom: 5px;">
            <span class="text-gray-700 dark:text-gray-400">Account No.</span>
            <input data-bvalidator="required" name="accountno" class="block w-full  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="<?= $rowuser['accountno'] ?>" placeholder="Client's A/c No." /></label>
    </div>

    <div class="row">
        <label class="col-6 block text-sm" style="margin-bottom: 5px;">
            <span class="text-gray-700 dark:text-gray-400">IFSC Code</span>
            <input data-bvalidator="required" name="ifsc" class="block w-full  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="<?= $rowuser['ifsc'] ?>" placeholder="IFSC Code of Bank" /></label>


        <label class="col-6 block text-sm" style="margin-bottom: 5px;">
            <span class="text-gray-700 dark:text-gray-400">Limit</span>
            <input type="number" name="limit" data-bvalidator="required" step="any" onfocus="this.select()" class="block w-full  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="<?= $rowuser['limit'] ?>" placeholder="Limit on Investment" /></label>
    </div>
    <div class="row">
        <label class="col-6 block text-sm" style="margin-bottom: 5px;">
            <span class="text-gray-700 dark:text-gray-400">Stop Withdrawal- <span style="margin-left: 5px !important;">From</span></span>
            <input name="starttime" id="starttime" value="<?= changedateformatespecito($rowuser['startdatetime'], "Y-m-d H:i:s", "d/m/Y H:i:s") ?>" onfocus="datetimepicker(this.id)" class="block w-full  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Select Start Time" />
        </label>
        <label class="col-6 block text-sm" style="margin-bottom: 5px;">
            <span class="text-gray-700 dark:text-gray-400">To</span>
            <input name="endtime" id="endtime" value="<?= changedateformatespecito($rowuser['enddatetime'], "Y-m-d H:i:s", "d/m/Y H:i:s") ?>" onfocus="datetimepicker(this.id)" class="block w-full  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Select End Time" />
        </label>
    </div>
    <div class="row">
        <label class="col-6 block text-sm" style="margin-bottom: 5px;">
            <span class="text-gray-700 dark:text-gray-400">Carry Forward</span>
            <select data-bvalidator="required" name="carryforward" class="block w-full  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
                <option value="No" <?= $rowuser['carryforward'] === 'No' ? 'selected' : null ?>>No</option>
                <option value="Yes" <?= $rowuser['carryforward'] === 'Yes' ? 'selected' : null ?>>Yes</option>
            </select>
        </label>
        <label class="col-6 block text-sm" style="margin-bottom: 5px;">
            <span class="text-gray-700 dark:text-gray-400">Long Holding</span>
            <select data-bvalidator="required" name="longholding" class="select2 block w-full  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
                <option value="No" <?= $rowuser['longholding'] === 'No' ? 'selected' : null ?>>No</option>
                <option value="Yes" <?= $rowuser['longholding'] === 'Yes' ? 'selected' : null ?>>Yes</option>
            </select>
        </label>
    </div>
    <div class="row">
        <label class="col-6 block text-sm" style="margin-bottom: 5px;">
            <span class="text-gray-700 dark:text-gray-400">Withdraw Limit</span>
            <input type="number" name="withdrawlimit" data-bvalidator="required" step="any" onfocus="this.select()" class="block w-full  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="<?= $rowuser['withdrawlimit'] ?>" placeholder="Withdrawal Limit" /></label>
        </label>
    </div>
    <div>
        <label class="block text-sm" style="margin-bottom: 5px;">
            <div class="row my-1"> <span class="col-6 text-gray-700 dark:text-gray-400"> Withdrawal Message</span>
                <span id="switchtype" class="col-6 text-right text-gray-700 dark:text-gray-400" style="color:green">Custom Message</span>
            </div>
            <div id="stype">

                <select data-bvalidator="required" name="message" class="select2 block w-full  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
                    <option value="Withdrawal temporarily unavailable due to a technical problem. Our team is working to resolve it promptly. Thank you for your patience.">Withdrawal temporarily unavailable due to a technical problem. Our team is working to resolve it promptly. Thank you for your patience.</option>

                    <option value="Withdrawal Restriction: You are currently unable to make a withdrawal for the next 24 hours. Please try again after the specified time has elapsed. Apologies for any inconvenience caused.">Withdrawal Restriction: You are currently unable to make a withdrawal for the next 24 hours. Please try again after the specified time has elapsed. Apologies for any inconvenience caused.</option>
                    <option value="Withdrawal temporarily unavailable due to suspicious activity. Please re-verify your account to ensure security. To re-verify send your document(PAN, Aadhar & Bank Details) on mail. It will take 7 working days for verification.">Withdrawal temporarily unavailable due to suspicious activity. Please re-verify your account to ensure security. To re-verify send your document(PAN, Aadhar & Bank Details) on mail. It will take 7 working days for verification.</option>
                    <option value="Withdrawal Limit: You can only withdraw once every 7 days. Please wait until the specified time period has passed to initiate a withdrawal.">Withdrawal Limit: You can only withdraw once every 7 days. Please wait until the specified time period has passed to initiate a withdrawal.</option>
                </select>
            </div>
    </div>
    <!-- <label class="block text-md" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Withdrawel Request Start Time</span>
        <select data-bvalidator="required" class="form-control select2" name="starttime" id="starttime">
            <?php
            //for ($i = 0; $i <= 23; $i++) {
            ?>
                <option <?php //echo ($i == $rowuser['starttime']) ? 'selected="selected"' : ""; 
                        ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php
            //}
            ?>
        </select>
    </label><br>
    <label class="block text-md" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Withdrawel Request End Time</span>
        <select data-bvalidator="required" class="form-control select2" name="endtime" id="endtime">
            <?php
            //for ($i = 0; $i <= 23; $i++) {
            ?>
                <option <?php //echo ($i == $rowuser['endtime']) ? 'selected="selected"' : ""; 
                        ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php
            //}
            ?>
        </select>
    </label><br> -->

    <div class="row">
        <label class="col-6 block text-sm" style="margin-bottom: 5px;position:relative">
            <span class="text-gray-700 dark:text-gray-400">Change Password</span>
            <input type="password" id="password" value="<?= $rowuser['password'] ?>" name="password" class="block w-full  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Please Give Strong Password!" />
            <i id="eye" class="fa fa-eye" style="position: absolute;top:34px;right:12px;z-index:50" aria-hidden="true"></i>
        </label>

        <label class="col-6 block text-sm" style="margin-bottom: 5px;">
            <span class="text-gray-700 dark:text-gray-400">Employee ID</span>
            <input xdata-bvalidator="required" name="employeeref" class="block w-full  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="<?= $rowuser['employeeref'] === '' ? '' : $rowuser['employeeref'] ?>" placeholder="Employee ID For Further Reference" /></label>
    </div>
    <strong>Documents</strong>

    <label class="block text-sm mt-3 " style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Aadhar Front Side</span>
        <input hidden value="Aadhar Card Front" name="name[]">
        <input style="padding: 0px; border-color: #00aaaa; font-size: 14px;" xdata-bvalidator="required" class="form-control" type="file" name="path[]">
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <input hidden value="Aadhar Card Back" name="name[]">
        <span class="text-gray-700 dark:text-gray-400">Aadhar Back Side</span>
        <input style="padding: 0px; border-color: #00aaaa; font-size: 14px;" xdata-bvalidator="required" class="form-control" type="file" name="path[]">
    </label>


    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Pan Card</span>
        <input hidden value="PAN card" name="name[]">

        <input style="padding: 0px; border-color: #00aaaa; font-size: 14px;" xdata-bvalidator="required" class="form-control" type="file" name="path[]">
    </label>
    <label class="block text-sm" sty le="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Signature</span>
        <input hidden value="Signature" name="name[]">
        <input style="padding: 0px; border-color: #00aaaa; font-size: 14px;" xdata-bvalidator="required" class="form-control" type="file" name="path[]">
    </label>


    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Passport Size Photo</span>
        <input hidden value="Passport Size Photo" name="name[]">
        <input style="padding: 0px; border-color: #00aaaa; font-size: 14px;" xdata-bvalidator="required" class="form-control" type="file" name="path[]">
    </label>
    <label class="block text-sm" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Passbook</span>
        <input hidden value="Passbook" name="name[]">
        <input style="padding: 0px; border-color: #00aaaa; font-size: 14px;" xdata-bvalidator="required" class="form-control" type="file" name="path[]">
    </label>

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