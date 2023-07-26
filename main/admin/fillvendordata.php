<?php
include "../session.php";
// @var obj db
ob_start();
$id = $_GET["hakuna"];
// print_r($_GET);
// die;
// $dep_id = $obj->selectfield("departments", "id", "department_name", "$dep_name");

$customer = $obj->selectextrawhere("suppliers", "id = $id and status =1");
// $customer_data = mysqli_fetch_all($customer,1);
// $data = $obj->selectextrawhereupdate("customer_contact", "id,name,phone", "customer_id = $id and status =1");
// $row = mysqli_fetch_all($data);
// $data2 = $obj->selectextrawhereupdate("customer_address", "id,address_1,address_2,city,state,indian_state,pincode,country_id", "customer_id = $id and status =1");
// $row2 = mysqli_fetch_all($data2);

// GST Code Detail
$customers_id = $id;
// $customer_address = $obj->selectextrawhereupdate("customer_address", "id,indian_state", "status=1 and customer_type_id = 1 and customer_id = $id");
// $customer_address_data = mysqli_fetch_all($customer_address, 1);

$my_gst_code = $companygstno;
$my_gst_code = substr($my_gst_code, 0, 2);
// $_SESSION["my_gst_code"] = $my_gst_code;
$gst_no = $obj->selectfield("suppliers", "gstno", "id", $customers_id);
$gst_state_code = substr($gst_no, 0, 2);

$gst_state_code = (empty($gst_state_code) || $gst_state_code == "NA") ? "0" : $gst_state_code;
// $_SESSION["gst_state_code"] = $gst_state_code;

$state_code = $obj->selectfield("suppliers", "statecode", "id", $customers_id);
$state_code = ($state_code == "Not Applicable" || !is_numeric($state_code)) ? 0 : $state_code;
// $_SESSION["state_code"] = $state_code;

// Temporary
while ($customer_data = $obj->fetch_assoc($customer)) {
    $data1 =   '<div class="form-group row">
        <label for="phone" class="col-sm-12 col-form-label">Phone Number</label>
        <div class="col-sm-12 ">
            <input type="text" data-bvalidator="required" value=' . "\"$customer_data[mobile]\"" . ' disabled class="form-control" id="phone">
        </div>
    </div>
    <div class="form-group row">
        <label for="phone" class="col-sm-12 col-form-label">E-mail Address</label>
        <div class="col-sm-12">
            <input type="text" xdata-bvalidator="required" value=' . "\"$customer_data[email]\"" . ' readonly class="form-control" id="email">
        </div>
    </div>
    <div class="form-group row">
        <label for="phone" class="col-sm-12 col-form-label">GST Number</label>
        <div class="col-sm-12">
            <input type="text" xdata-bvalidator="required" value=' . "\" $customer_data[gstno]\"" . ' disabled class="form-control" id="gst">
        </div>
    </div>
    <div class="form-group row">
        <label for="phone" class="col-sm-12 col-form-label">Website</label>
        <div class="col-sm-12">
            <input type="text" xdata-bvalidator="required" value=' . "\" $customer_data[website]\"" . ' disabled class="form-control" id="gst">
        </div>
    </div>
  <div class="form-group row">
    <label for="shipping_state" class="col-sm-12 col-form-label">Contact</label>
    <div class="col-sm-12">
        <input type="text" value=' . "\" $customer_data[scontact]\"" . '  data-bvalidator="required" name="sname" class="form-control" id="name">
        
    </div>
  </div>
<div id="contact2" style="display: block;">
    <div class="form-group row">
        <label for="phone" class="col-sm-12 col-form-label">Phone*</label>
        <div class="col-sm-12">
            <input type="text" data-bvalidator="required" value=' . "\" $customer_data[sphone] \"" . ' name="sphone" class="form-control" id="name" placeholder="Enter Name">
        </div>
    </div>
    <div class="form-group row">
        <label for="phone" class="col-sm-12 col-form-label">Designation*</label>
        <div class="col-sm-12">
            <input type="text" xdata-bvalidator="required" value=' . "\" $customer_data[designation] \"" . ' name="designation" class="form-control" id="phone" placeholder="Enter Phone Number">
        </div>
    </div>
    <div class="form-group row">
        <label for="phone" class="col-sm-12 col-form-label">Email</label>
        <div class="col-sm-12">
            <input type="text" name="semail" xdata-bvalidator="required" class="form-control" value=' . "\" $customer_data[semail] \"" . ' id="email" placeholder="Enter Email Address">
        </div>
    </div>
</div>
<h5>Address Information</h5>
<div class="form-group row">
    <label for="shipping_state" class="col-sm-12 col-form-label">Address</label>
    <div class="col-sm-12">
        <div class="input-group-prepend">
            <!-- <span class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></span> -->
        </div>
        <input type="text" value=' . "\" $customer_data[address] $customer_data[city]\"" . '  data-bvalidator="required" name="saddress" class="form-control" id="name">
    </div>
</div>
<script>$(".select2").select2()</script>';
}
$data = [0 => $data1, 2 => $my_gst_code, 3 => $gst_state_code, 4 => $state_code];
// $return['data'] = $data;
echo json_encode($data);
