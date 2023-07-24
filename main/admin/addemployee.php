<?php
include "main/session.php";
$id = $_GET['hakuna'];
$result4 = $obj->selectextrawhere('codegenerator', "`category` like 'employeecode'");
$num4 = $obj->total_rows($result4);
$codegeneratorid = 0;
$codenumber = 0;
if ($num4) {
    $row4 = $obj->fetch_assoc($result4);
    $codegeneratorid = $row4['id'];
    $codenumber = $row4['number'] + 1;
    $generatedcode = sprintf('%04d', $codenumber);
    // $month = strtoupper(date("M", strtotime($date)));
    $uniqueid = str_replace(array("{prefix}", "{number}"), array($row4['prefix'], $generatedcode), $row4['pattern']);
} else {
    $cg['prefix'] = "EMP";
    $cg['number'] = 0;
    $cg['pattern'] = "{prefix}{number}";
    $cg['category'] = "employeecode";
    // $fsed = getfirstandlastday($date);
    $cg['addedon'] = date("Y-m-d H:i:s");
    $cg['addedby'] = $employeeid;
    $cg['status'] = 1;
    $codegeneratorid = $obj->insertnew("codegenerator", $cg);
    $codenumber = 1;
    $generatedcode = sprintf('%03d', $codenumber);
    $uniqueid = str_replace(array("{prefix}", "{number}"), array($cg['prefix'], $generatedcode), $cg['pattern']);
}
?>
<form id="adduser" onsubmit="event.preventDefault();sendForm('', '', 'insertemployee', 'resultid', 'adduser');return 0;">
    <label class="block text-sm mb-3" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Employee ID</span>
        <input name="usercode" class="block w-full  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" readonly value="<?= $uniqueid ?>" placeholder="Enter Employee ID" />
    </label>
    <label class="block text-sm  mb-3" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Name</span>
        <input name="name" data-bvalidator="required" class="block w-full  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Employee's Name" />
    </label>
    <label class="block text-sm  mb-3" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Mob No.</span>
        <input type="number" name="phone" data-bvalidator="minlength[10],maxlength[10]" class="block w-full  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Employee Mobile No." />
    </label>
    <label class="block text-sm mb-3" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Email</span>
        <input name="email" data-bvalidator="required,email" class="block w-full  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Employee's Email ID" />
    </label>
    <label class="block text-sm  mb-3" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Password</span>
        <input type="password" data-bvalidator="required,minlength[6]" id="password" name="password" class="block w-full  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Please Give Strong Password!" />
    </label>
    <label class="block text-md" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Employee Role</span>
        <select data-bvalidator="required" class="form-control select2" name="role" id="role">
            <option value="">Select Role</option>
            <?php
            $role = $obj->selectextrawhereupdate("roles", "id,name", "status = 1 and id != 1");
            $emprole = mysqli_fetch_all($role);
            foreach ($emprole as list($id, $name)) { ?>
                <option value="<?php echo $id; ?>"> <?php echo $name; ?></option>
            <?php
            } ?>
        </select>
    </label><br>
    <label class="block text-md" style="margin-bottom: 5px;">
        <span class="text-gray-700 dark:text-gray-400">Login Allowed</span>
        <select data-bvalidator="required" class="form-control select2" name="activate" id="login">
            <option value="">Choose One</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>
    </label><br>
    <div>
        <button type="submit" id="modalsubmit" class="w-full px-3 py-1 mt-6 text-sm font-medium hidden">
            Submit
        </button>
    </div>
    <div id="resultid"></div>
</form>
<script>
    $('select').select2()
</script>