<?php
include "main/session.php";
/* @var $obj db */
ob_start();
$emp = $obj->selectextrawhereupdate("users", "id,firstname,lastname", "status=1");
$emp_data = mysqli_fetch_all($emp);
$state = $obj->selectextrawhereupdate("state_list", "id,state", "status=1");
$state_data = mysqli_fetch_all($state);
$country = $obj->selectextrawhereupdate("country", "id,country_name", "status=1");
$country_data = mysqli_fetch_all($country);
// $account_type = $obj->selectextrawhereupdate("bank_account_type", "id,name", "status=1");
// $account_type_data = mysqli_fetch_all($account_type);
$company = $obj->selectextrawhere("personal_detail", "status=11");
$row = $obj->fetch_assoc($company);
$path = $obj->fetchattachment($row['uploadfile_id']);
?>
<style>
    #vert-tabs-tab {
        display: block !important;
    }

    textarea {
        resize: none;
    }
</style>
<div class="container px-6 mx-auto grid">
    <h3 class="my-6 font-semibold text-gray-700 dark:text-gray-200">Settings</h3>
    <div class="card mobile-bottom-margin">
        <!-- <div class="card-header with-border">
        
        <div class="card-tools pull-right">
        </div>
    </div> -->
        <div class="card-body">
            <!-- <div class="row">
            <div class="col-md-3">
                <h4 class="m-4"><?php echo $row["company_name"] ?></h4>
                <div class="col-8 offset-2">
                    <div>
                        <img src="<?php echo "$path" ?>" style="width:100%;height:150px" alt="not available">
                    </div>
                </div>
            </div>
        </div> -->
            <div id="tabs">
                <ul>
                    <li><a id="vert-tabs-profile-tab" href="#vert-tabs-profile">Company Info </a></li>
                    <li> <a id="vert-tabs-home-tab" href="#vert-tabs-home">Payments Details</a></li>

                </ul>
                <div class="" id="vert-tabs-profile">
                    <!-- <div class="card" style="background-color: white;"> -->
                    <!-- <div class="card-header" style="background-color: #fdfdfd;">
                        <h3 class="card-title">General information</h3>
                        <div class="card-tools">
                            <a href="index.php" class="btn btn-default" data-card-widget="">
                                << Back </a>
                                    <button type="button" class="btn btn-tool" data-card-widget="">
                                        <i class="fas fa-times"></i>
                                    </button>
                        </div>
                    </div> -->
                    <!-- <div class="card-body"> -->
                    <form data-bvalidator-validate data-bvalidator-theme="gray" id="personaladd" onsubmit="event.preventDefault();sendForm('', '', 'insertpersonalaccount', 'resultid', 'personaladd');return 0;">
                        <input type="text" name="personal_detail" value="-1" hidden>
                        <div class="form-row">
                            <!-- <div class="form-group col-md-6">
                            <label for="inputEmail4">Company Name</label>
                            <input type="text" class="form-control" value="<?php
                                                                            if (isset($row["company_name"])) {
                                                                                echo $row["company_name"];
                                                                            }
                                                                            ?>" name="company_name" id="inputEmail4" placeholder="Company Name">
                        </div> -->
                            <!-- <div class="form-group col-md-6">
                            <label for="short_name">Short Name</label>
                            <input type="text" class="form-control" name="short_name" value="<?php
                                                                                                if (isset($row["short_name"])) {
                                                                                                    echo $row["short_name"];
                                                                                                }
                                                                                                ?>" id="short_name">
                        </div> -->
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="phone">Phone No.</label>
                                <input type="text" class="form-control" name="phone" value="<?php
                                                                                            if (isset($row["phone"])) {
                                                                                                echo $row["phone"];
                                                                                            }
                                                                                            ?>" id="phone" pla ceholder="Phone Number">
                            </div>
                            <!-- <div class="form-group col-md-6">
                            <label for="website">Website</label>
                            <input type="text" class="form-control" name="website" value="<?php
                                                                                            if (isset($row["website"])) {
                                                                                                echo $row["website"];
                                                                                            }
                                                                                            ?>" id="website" placeholder="www.samplesite.com">
                        </div> -->
                        </div>
                        <div class="form-row">
                            <!-- <div class="form-group col-md-6">
                            <label for="gst_no">GST No</label>
                            <input type="text" class="form-control" data-bvalidator="checkgst" name="gst_no" value="<?php
                                                                                                                    if (isset($row["gst_no"])) {
                                                                                                                        echo $row["gst_no"];
                                                                                                                    }
                                                                                                                    ?>" id="gst_no" placeholder="GST Number">
                        </div> -->

                            <div class="form-group col-md-6">
                                <label for="email">E-Mail</label>
                                <input type="text" class="form-control" name="email" value="<?php
                                                                                            if (isset($row["email"])) {
                                                                                                echo $row["email"];
                                                                                            }
                                                                                            ?>" id="email" placeholder="Company E-mail">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Address</label>
                            <textarea type="text" style="resize:none" class="form-control" name="address_line_1" value="" id="inputAddress" placeholder="1234 Main St"><?php
                                                                                                                                                                        if (isset($row["address_1"])) {
                                                                                                                                                                            echo $row["address_1"];
                                                                                                                                                                        }
                                                                                                                                                                        ?></textarea>
                        </div>

                        <!-- <div class="form-group">
                        <label for="inputAddress2">City</label>
                        <input type="text" class="form-control" name="city" value="<?php
                                                                                    if (isset($row["city"])) {
                                                                                        echo $row["city"];
                                                                                    }
                                                                                    ?>" id="inputAddress2" placeholder="City">
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="shipping_country" class="">Country</label>
                                <div class=" input-group sinput-group">
                                    <div class="input-group-prepend">
                                    </div>
                                    <select id="country" class="form-control select2" name="country_id" style="width: 100%;">
                                        <?php
                                        foreach ($country_data as list($id, $country)) {
                                            if ($id == $row["country_id"]) {
                                        ?>
                                                <option value="<?php echo $id ?>" selected><?php echo $country ?></option> <?php } else { ?>
                                                <option value="<?php echo $id ?>"> <?php echo $country ?></option>
                                        <?php }
                                                                                                                    } ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="form-group col-md-4">
                            <div id="indian_state">
                                <label for="shipping_state1" class=""> state</label>
                                <div class=" input-group sinput-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                    </div>
                                    <input name="state" type="text" class="form-control" value="<?php
                                                                                                if (isset($row["state"])) {
                                                                                                    echo $row["state"];
                                                                                                }
                                                                                                ?>" id="state1" placeholder=" State">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputZip">Pincode</label>
                            <input type="number" name="pincode" value="<?php
                                                                        if (isset($row["pincode"])) {
                                                                            echo $row["pincode"];
                                                                        }
                                                                        ?>" class="form-control" id="inputZip">
                        </div>
                    </div> -->
                        <!-- <div class="form-group col-md-6">
                        <label for="inputEmail4">Company Logo</label>
                        <input type="file" class="form-control" name="logo_upload">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Favicon Logo</label>
                        <input type="file" class="form-control" name="favicon">
                    </div> -->

                        <div class="card-footer pl-0">
                            <?php if (in_array(33, $permissions)) { ?>
                                <button type="submit" class="text-white btn btn-primary">Save</button>
                                <div id="resultid"></div>
                            <?php } ?>
                        </div>
                    </form>
                    <!-- </div> -->
                    <!-- </div> -->
                </div>
                <div id="vert-tabs-home">
                    <!-- <div class="card" style="background-color: white;"> -->
                    <!-- <div class="card-header" style="background-color: #fdfdfd;">
                        <h3 class="card-title">Bank information</h3>
                        <div class="card-tools">
                            <a href="index.php" class="btn btn-default" data-card-widget="">
                                << Back </a>
                                    <button type="button" class="btn btn-tool" data-card-widget="">
                                        <i class="fas fa-times"></i>
                                    </button>
                        </div>
                    </div> -->
                    <!-- <div class="card-body"> -->
                    <form data-bvalidator-validate data-bvalidator-theme="gray" id="personalbankadd" onsubmit="event.preventDefault();sendForm('', '', 'insertpersonalaccount', 'resultid1', 'personalbankadd');return 0;">
                        <div>
                            <input type="text" name="bank_detail" value="-1" hidden>
                            <div class="form-group">
                                <label for="account_name" class="col-sm-12 col-form-label">Bank Name</label>
                                <div class="col-sm-12 input-group sinput-group">
                                    <div class="input-group-prepend"></i>
                                        <span class="input-group-text"><i class="fa-solid fa-building-columns" aria-hidden="true"></i></span>
                                    </div>
                                    <input name="bank_name" type="text" class="form-control" value="<?php
                                                                                                    if (isset($row["bank_name"])) {
                                                                                                        echo $row["bank_name"];
                                                                                                    }
                                                                                                    ?>" id="bank_name" placeholder="Bank Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="account_name" class="col-sm-12 col-form-label">Account Holder Name</label>
                                <div class="col-sm-12 input-group sinput-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
                                    </div>
                                    <input name="account_name" type="text" class="form-control" value="<?php
                                                                                                        if (isset($row["account_name"])) {
                                                                                                            echo $row["account_name"];
                                                                                                        }
                                                                                                        ?>" id="account_name" placeholder="Account Holder Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="account_no" class="col-sm-12 col-form-label">Account No.</label>
                                <div class="col-sm-12 input-group sinput-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa-solid fa-file-invoice"></i></span>
                                    </div>
                                    <input name="account_no" type="number" class="form-control" value="<?php
                                                                                                        if (isset($row["account_number"])) {
                                                                                                            echo $row["account_number"];
                                                                                                        }
                                                                                                        ?>" id="account_no" placeholder="Account Number">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ifsc_code" class="col-sm-12 col-form-label">IFSC Code</label>
                                <div class="col-sm-12 input-group sinput-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa-solid fa-hashtag"></i></span>
                                    </div>
                                    <input name="ifsc_code" type="text" class="form-control" value="<?php
                                                                                                    if (isset($row["ifsc_code"])) {
                                                                                                        echo $row["ifsc_code"];
                                                                                                    }
                                                                                                    ?>" id="ifsc_code" placeholder="IFSC Code">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="upiid" class="col-sm-12 col-form-label">UPI Id</label>
                                <div class="col-sm-12 input-group sinput-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa-solid fa-at"></i></span>
                                    </div>
                                    <input name="upiid" type="text" class="form-control" value="<?php
                                                                                                if (isset($row["upiid"])) {
                                                                                                    echo $row["upiid"];
                                                                                                }
                                                                                                ?>" id="upiid" placeholder="UPI Id">
                                </div>
                            </div>
                            <!-- <div class="form-group">
                            <label for="branch_name" class="col-sm-12 col-form-label">Branch Name</label>
                            <div class="col-sm-12 input-group sinput-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                </div>
                                <input name="branch_name" type="text" value="<?php
                                                                                if (isset($row["branch_name"])) {
                                                                                    echo $row["branch_name"];
                                                                                }
                                                                                ?>" class="form-control" id="branch_name" placeholder="Branch Name">
                            </div>
                        </div> -->
                            <div class="form-group col-md-6">
                                <label>Qr Code</label>
                                <input type="file" class="form-control" name="paymentqr">
                            </div>
                        </div>
                        <div class="card-footer">
                            <?php if (in_array(33, $permissions)) { ?>
                                <button type="submit" class="text-white btn btn-primary">Save</button>
                                <div id="resultid1"></div>
                            <?php } ?>
                        </div>
                    </form>
                    <!-- </div> -->

                    <!-- </div> -->
                </div>

            </div>
        </div>
        <!-- /.card-body -->


    </div>
</div>




<?php
$pagemaincontent = ob_get_clean();
ob_clean();
$extracss = "";
$pageheader = "";
$extrajs = '';
$breadcrumbs = '<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">Add setting</li>
</ol>';
$pagemeta = "";
$pagetitle = "Add setting::.Settings-Quality";
$contentheader = "Settings";
$breadcrumb = '<ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>';
include "templete.php";
?>
<script type="text/javascript">
    $(document).ready(function() {
        $('form').bValidator();

        $("#tabs").tabs().addClass("ui-tabs-vertical ui-helper-clearfix");
        $("#tabs li").removeClass("ui-corner-top").addClass("ui-corner-left");

    });

    $("#country").change(function() {
        var valu = $(this).val();
        if (valu == "1") {
            search(this.id, 'indian_state', '../main/admin/fill_state.php', '')
        }
    })
    var val = $("#country").val();
    if (val == 1) {
        search("country", 'indian_state', '../main/admin/fill_state.php', '<?= $row['indian_state'] ?>')
    }
    $("#country").change(function() {
        if ($(this).val() !== "1") {
            $("#indian_state").html(
                "<label for='shipping_state'> state</label>" +
                "<div class='input-group sinput-group'>" +
                "<div class='input-group-prepend'>" +
                "<span class='input-group-text'><i class='fa fa-envelope' aria-hidden='true'></i></span>" +
                "</div>" +
                "<input name='state' type='text' class='form-control' id='shipping_state' placeholder= 'State'>" +
                "</div>");
        }
    });
</script>