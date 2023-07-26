<?php
include "main/session.php";
ob_flush();
ob_start();
$sid = $_GET['hakuna'];
$tbname = "suppliers";
$where = "id=$sid";
$result = $obj->selectextrawhere($tbname, $where);
$row = $obj->fetch_assoc($result);
?>
<div class="card card-default">
    <div class="card-header ">
        <h3 class="card-title">Edit Supplier</h3>
    </div>
    <div class="card-body">
        <form id="addbrand" enctype="multipart/form-data">
            <div class="card-body">
                <div class="form-group row">
                    <label class="form-control-label col-md-3">Supplier Name</label>
                    <div class='col-md-9'>
                        <input class="form-control" name="name" id="name" data-bvalidator="required" value="<?php echo $row['name']; ?>" type="text" placeholder="Supplier name"> <br />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="form-control-label col-md-3">Address</label>
                    <div class='col-md-9'><textarea class="textarea" name="address" data-bvalidator="required" data-bvalidator-msg="Plese enter a short description" name="description" placeholder="Company Address" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required><?php echo $row['address']; ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <span class="form-control-label col-md-3">Company</span>
                    <div class="col-md-9">
                        <input type="text" value="<?php echo $row['company']; ?>" name="company" id="company" placeholder="" class="form-control">
                    </div>
                </div>
                <br />
                <div class="form-group row">
                    <span class="form-control-label col-md-3">Email</span>
                    <div class="col-md-9">
                        <input type="text" name="email" value="<?php echo $row['email']; ?>" id="email" placeholder="" class="form-control">
                    </div>
                </div>
                <br />
                <div class="form-group row">
                    <span class="form-control-label col-md-3">Mobile</span>
                    <div class="col-md-9">
                        <input type="text" name="mobile" value="<?php echo $row['mobile']; ?>" id="mobile" placeholder="" class="form-control">
                    </div>
                </div>
                <br />
                <div class="form-group row">
                    <span class="form-control-label col-md-3">GST No</span>
                    <div class="col-md-9">
                        <input type="text" name="gstno" id="gstno" data-bvalidator="required,checkgst" value="<?php echo $row['gstno']; ?>" placeholder="" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <span class="form-control-label col-md-3">PAN No</span>
                    <div class="col-md-9">
                        <input type="text" name="panno" id="gstno" data-bvalidator="required" value="<?php echo $row['panno']; ?>" placeholder="" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <span class="form-control-label col-md-3">City</span>
                    <div class="col-md-9">
                        <input type="text" name="city" id="city" value="<?php echo $row['city']; ?>" placeholder="" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <span class="form-control-label col-md-3">Website</span>
                    <div class="col-md-9">
                        <input type="text" name="website" id="website" value="<?php echo $row['website']; ?>" placeholder="" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="shipping_country" class="col-sm-3 col-form-label">Country*</label>
                    <div class="col-sm-9 ">
                        <select name="country" data-bvalidator="required" id="country_id" class="form-control select2">
                            <option value="">Choose one..</option>
                            <?php
                            $country = $obj->selectextrawhereupdate("country", "id,country_name", "status=1");
                            $country_data = mysqli_fetch_all($country);
                            foreach ($country_data as list($id, $country_name)) { ?>
                                <option value="<?php echo $id; ?>" <?= ($id == $row["country"]) ? "selected='selected'" : '' ?>> <?php echo  $country_name ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div id="indian_state">

                    <div class="form-group row">
                        <label for="shipping_state1" class="col-sm-12 col-form-label"> State*</label>
                        <div class="col-sm-12">
                            <input name="state" type="text" value="<?php echo $row['state']; ?>" data-bvalidator="required" class="form-control" id="shipping_state1" placeholder=" State">
                        </div>
                    </div>
                </div>
                <h5 style="padding-bottom:8px;margin-right:15px">Contact person</h5>
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">Name*</label>
                    <div class="col-sm-9 ">
                        <input data-bvalidator="required" type="text" value="<?php echo $row['scontact']; ?>" name="scontact" class="form-control" id="name" placeholder="Primary Name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-sm-3 col-form-label">Phone*</label>
                    <div class="col-sm-9 ">
                        <input data-bvalidator="required,number" type="number" name="sphone" class="form-control" id="phone" value="<?php echo $row['sphone']; ?>" placeholder="Primary Phone Number">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label">E-mail</label>
                    <div class="col-sm-9 ">
                        <input type="email" name="semail" value="<?php echo $row['semail']; ?>" class="form-control" id="semail" placeholder="Primary Email">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="designation" class="col-sm-3 col-form-label">Designation</label>
                    <div class="col-sm-9 ">
                        <input type="text" name="designation" class="form-control" value="<?php echo $row['designation']; ?>" id="designation" placeholder="Designation">
                    </div>
                </div>
            </div>
        </form>
        <div class="card-footer">
            <button type="submit" onclick="sendForm('hakuna', '<?php echo $sid; ?>', 'updatesupplier', 'resultid', 'addbrand')" class="flex items-center justify-between px-3 py-2 bg-blue text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray">
                Submit
            </button>

            <div class="col-md-12" id="resultid"></div>
        </div>
    </div><!-- div class card body ended -->
</div>
<?php
//Assign all Page Specific variables
$pagemaincontent = ob_get_contents();
ob_end_clean();
$pagetitle = "Update Supplier: $companyname";
$pagemeta = "Some Meta Goes Here";
$pagekeywords = "Some keywords Goes here";
$contentheader = "Edit Supplier";
//Apply the template
include("templete.php");
?>
<script>
    $(document).ready(function() {
        $("select").select2();
    });
</script>
<script>
    $(document).ready(function() {
        $("#country_id").change(function() {
            if ($(this).val() == "1") {
                search(this.id, 'indian_state', '../main/admin/fill_state.php', 'NA&fieldname=state')
            } else if ($(this).val() !== "1") {
                $("#indian_state").html(" <div class='form-group row'><label for='shipping_state' class='col-sm-3 col-form-label'> State*</label><div class='col-sm-9'><input name='state' type='text' data-bvalidator='required' class='form-control' id='shipping_state' placeholder= 'State'></div></div>")
            }
        })
        var val = $("#country_id").val();
        if (val == 1) {
            search("country_id", 'indian_state', '../main/admin/fill_state.php', '<?= $row['state'] ?>&fieldname=state')
        }
    })
</script>