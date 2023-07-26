<?php
include "main/session.php";
/* @var $obj db */
ob_start();
$po_id = $_GET["hakuna"];
$purchase_order = $obj->selectextrawhere("purchase", "id=$po_id");

$po_item = $obj->selectextrawhere("purchase_item", "purchase_order_id=$po_id");
$approveid = $obj->selectfield("purchase", "status", "id", $po_id);



?>
<style>
    ::-webkit-scrollbar {
        width: 4px;
    }

    ::-webkit-scrollbar-track {
        box-shadow: inset 0 0 5px grey;
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb {
        background: lightblue;
        border-radius: 10px;
    }

    input {
        width: 200px;

    }

    .item-class td {
        padding: 5px;
    }
</style>
<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">View Purchase Order</h3>

        <div class="card-tools">
            <a href="view_purchase_order.php" class="btn btn-default" data-card-widget="">
                << Back </a>
                    <?php if ($approveid == -1) { ?>
                        <a href="edit_purchase_order.php?hakuna=<?= $po_id ?>" class="btn border border-warning" data-card-widget="">
                            Edit
                        </a>
                    <?php } ?>
                    <a href="exportpotopdf.php?hakuna=<?= $po_id ?>" class="btn border border-secondary" data-card-widget="">
                        Export to PDF
                    </a>
                    <button type="button" class="btn btn-tool" data-card-widget="">
                        <i class="fas fa-times"></i>
                    </button>
        </div>
    </div>
    <!-- /.card-header -->
    <!-- form start -->

    <div class="card-body">
        <?php while ($row = $obj->fetch_assoc($purchase_order)) { ?>
            <div class="form-group row">
                <label for="phone" class="col-sm-8 col-form-label text-right">Date: </label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="date" readonly data-bvalidator="required" value="<?= changedateformatespecito($row["date"], "Y-m-d", "d/m/Y") ?>" id="date">
                </div>
            </div>
            <div class="form-group row">
                <label for="phone" class="col-sm-8 col-form-label text-right">PO No.</label>
                <div class="col-sm-4">
                    <input type="text" disabled data-bvalidator="required" name="po_number" readonly value="<?= $row["po_number"]  ?>" class="form-control" id="purchase_order">
                </div>
            </div>
            </br>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="name" class="col-sm-12 col-form-label">Business Name</label>
                        <div class="col-sm-12">

                            <input type="text" readonly class="form-control" value="<?= $obj->selectfield("suppliers", "company", "id", $row["customer_id"]) ?>">

                        </div>
                    </div>
                    <div id="contact">

                        <div class="form-group row">
                            <label for="phone" class="col-sm-12 col-form-label">Phone Number</label>
                            <div class="col-sm-12">
                                <input type="text" data-bvalidator="required" disabled value="<?= $obj->selectfield("suppliers", "mobile", "id", $row["customer_id"]) ?>" class="form-control" id="phone">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-sm-12 col-form-label">E-mail Address</label>
                            <div class="col-sm-12">
                                <input type="text" data-bvalidator="required" disabled value="<?= $obj->selectfield("suppliers", "email", "id", $row["customer_id"]) ?>" class="form-control" id="email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-sm-12 col-form-label">GST Number</label>
                            <div class="col-sm-12">
                                <input type="text" data-bvalidator="required" disabled value="<?= $obj->selectfield("suppliers", "gstno", "id", $row["customer_id"]) ?>" class="form-control" id="gst">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-sm-12 col-form-label">Website</label>
                            <div class="col-sm-12">
                                <input type="text" xdata-bvalidator="required" value='<?= $obj->selectfield("suppliers", "website", "id", $row["customer_id"]) ?>' disabled class="form-control" id="gst">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="shipping_state" class="col-sm-12 col-form-label">Contact</label>
                            <div class="col-sm-12">
                                <input type="text" value='<?= $row["sname"] ?>' data-bvalidator="required" readonly class="form-control" id="name">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="shipping_state" class="col-sm-12 col-form-label">Phone</label>
                            <div class="col-sm-12">
                                <input type="text" value='<?= $row["sphone"] ?>' data-bvalidator="required" readonly class="form-control" id="name">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="shipping_state" class="col-sm-12 col-form-label">Designation</label>
                            <div class="col-sm-12">
                                <input type="text" value='<?= $row["designation"] ?>' data-bvalidator="required" readonly class="form-control" id="name">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="shipping_state" class="col-sm-12 col-form-label">Email</label>
                            <div class="col-sm-12">
                                <input type="text" value='<?= $row["semail"] ?>' data-bvalidator="required" readonly class="form-control" id="name">

                            </div>
                        </div>
                        <h5>Address Information</h5>
                        <div class="form-group row">
                            <label for="address" class="col-sm-12 col-form-label">Address</label>
                            <div class="col-sm-12">
                                <textarea type="text" data-bvalidator="required" style="resize:none;height:110px" disabled class="form-control" id="address"><?php echo $row["saddress"] ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <!-- <div class="form-group row">
                        <label for="phone" class="col-sm-12 col-form-label">Billed and Consign To:</label>
                        <div class="col-sm-12">
                            <textarea type="text" style="resize:none;height:120px" disabled data-bvalidator="required" name="bill_and_consign_to" class="form-control" id="purchase_order"><?= $row["bill_and_consign_to"] ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-sm-12 col-form-label">Delivery Terms:</label>
                        <div class="col-sm-12">
                            <input type="text" data-bvalidator="required" disabled value="<?= $row["delivery_terms"] ?>" name="delivery_terms" class="form-control" id="delivery_terms">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-sm-12 col-form-label">Payment Terms:</label>
                        <div class="col-sm-12">
                            <input type="text" data-bvalidator="required" disabled value="<?= $row["payment_terms"] ?>" name="payment_terms" class="form-control" id="payment_terms">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="quotationdate" class="col-sm-12 col-form-label">Quotation Date:</label>
                        <div class="col-sm-12">
                            <input type="text" readonly data-bvalidator="required" value="<?= changedateformatespecito($row["quotationdate"], "Y-m-d", "d/m/Y") ?>" name="quotationdate" class="form-control" id="quotationdate">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-sm-12 col-form-label">Quotation Reference No:</label>
                        <div class="col-sm-12 ">
                            <input type="text" data-bvalidator="required" value="<?= $row["quotationno"] ?>" name="quotationno" class="form-control" id="payment_terms" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-sm-12 col-form-label">Warranty:</label>
                        <div class="col-sm-12 ">
                            <input type="text" data-bvalidator="required" name="warranty" value="<?= $row["warranty"] ?>" class="form-control" id="" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-sm-12 col-form-label">Jurisdiction :</label>
                        <div class="col-sm-12 ">
                            <input type="text" data-bvalidator="required" value="<?= $row["jurisdiction"] ?>" name="jurisdiction" class="form-control" id="" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-sm-12 col-form-label">Other Detail :</label>
                        <div class="col-sm-12 ">
                            <textarea type="text" name="otherdetails" readonly class="form-control" id=""><?= $row["otherdetails"] ?></textarea>
                        </div>
                    </div> -->
                </div>
            </div>


            <div class="full-product-ui p-2">
                <div class="ml-4 mt-3">
                    <h5>Product Details</h5>
                </div>
                <table class="table table-striped table-responsive text-center table-bordered">
                    <thead>
                        <tr>
                            <td>
                                <h5>S.no</h5>

                            </td>
                            <td>
                                <h5>HSN/SAC</h5>
                            </td>
                            <td>
                                <h5>Material / Services Name</h5>

                            </td>
                            <td>
                                <h5>Specification</h5>

                            </td>
                            <td>
                                <h5>Price</h5>

                            </td>
                            <td>
                                <h5>Quantity</h5>

                            </td>
                            <td>
                                <h5>Amount</h5>

                            </td>
                            <td>
                                <h5>Discount%</h5>

                            </td>
                            <td>
                                <h5>Tax Rate</h5>

                            </td>
                            <td>
                                IGST

                            </td>
                            <td>
                                CGST
                            </td>
                            <td>
                                SGST
                            </td>
                            <td>
                                Total Tax
                            </td>
                            <td>
                                Total
                            </td>

                        </tr>
                    </thead>
                    <?php
                    $i = 1;
                    while ($subrow = $obj->fetch_assoc($po_item)) { ?>
                        <tr class='item-class' style='position:relative'>
                            <td>
                                <?php echo $i;
                                $i++ ?>
                            </td>
                            <td>
                                <?= $subrow["hsn_code"] ?>
                            </td>

                            <td>
                                <input type='text' id='subcategory_id' value='$subrow[subcategory_id]' hidden name='subcategory_id[]'>
                                <?php
                                echo $obj->selectfield("subcategories", "name", "id", $subrow['subcategory_id']);
                                ?>
                            </td>
                            <td>
                                <?= $subrow["specification"] ?>

                            </td>
                            <td>
                                <?= $subrow["price"] ?>
                            </td>
                            <td>
                                <?= $subrow["quantity"] ?>
                            </td>
                            <td>
                                <?= $subrow["list_price"] ?>
                            </td>
                            <td>
                                <?= (empty($subrow["discount"])) ? "NA" : $subrow["discount"] . "%" ?>
                            </td>
                            <td>
                                <?= $subrow["tax_rate"]  ?>
                            </td>
                            <td>
                                <?= $subrow["igstamount"]  ?>

                            </td>
                            <td>
                                <?= $subrow["cgstamount"]  ?>
                            </td>
                            <td>
                                <?= $subrow["sgstamount"]  ?>
                            </td>
                            <td>
                                <?= $subrow["totaltaxamountitem"]  ?>
                            </td>
                            <td>
                                <?= $subrow["finalamount"]  ?>
                            </td>

                        </tr>
                    <?php } ?>
                </table>
                <div class="float-right mt-3 tax-detail">
                    <div class="row">
                        <label class="col-md-10 text-right">Total Item Amount</label>
                        <div class="col-md-2"><input class="form-control" value="<?= $row["subtotal"] ?>" data-bvalidator="" type="text" id="subtotal" name="subtotal" readonly="readonly" /><br></div>
                    </div>
                    <div class="row">
                        <label class="col-md-10 text-right"> Discount</label>
                        <div class="col-md-2"> <input class="form-control" value="<?= $row["discount"]
                                                                                    ?>" name="discount" id="discount" type="text" readonly="readonly" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10 text-right">Total After Discount Value</div>
                        <div class="col-md-2"><input class="form-control  " value="<?= $row["totalafterdisc"] ?>" type="text" id="totalafterdisc" name="totalafterdisc" readonly="readonly" /><br></div>
                    </div>
                    <div class="row">
                        <div class="col-md-10 text-right">Packing & Forwarding Charges</div>
                        <div class="col-md-2"><input class="form-control" readonly="readonly" value="<?= $row["packaginchrgs"] ?>" type="text" id="packaginchrgs" name="packaginchrgs" onclick="this.select()" onkeyup="sumamount()" /><br></div>
                    </div>
                    <div class="row">
                        <div class="col-md-10 text-right">Freight Charges</div>
                        <div class="col-md-2"><input class="form-control" readonly="readonly" type="text" id="freightchrgs" name="freightchrgs" value="<?= $row["freightchrgs"] ?>" onclick="this.select()" onkeyup="sumamount()" /><br></div>
                    </div>
                    <div class="row">
                        <div class="col-md-10 text-right">Insurance charges</div>
                        <div class="col-md-2"><input class="form-control" readonly="readonly" type="text" id="insurancechrgs" name="insurancechrgs" value="<?= $row["insurancechrgs"] ?>" onclick="this.select()" onkeyup="sumamount()" /><br></div>
                    </div>
                    <div class="row">
                        <div class="col-md-10 text-right">Calibration Certificate Charges</div>
                        <div class="col-md-2"><input class="form-control" readonly="readonly" type="text" id="calibrationchrgs" name="calibrationchrgs" value="<?= $row["calibrationchrgs"] ?>" onclick="this.select()" onkeyup="sumamount()" /><br></div>
                    </div>
                    <div class="row">
                        <div class="col-md-10 text-right">Installation,Demonstration&Training Charges</div>
                        <div class="col-md-2"><input class="form-control" readonly="readonly" type="text" id="trainingchrgs" name="trainingchrgs" value="<?= $row["trainingchrgs"] ?>" onclick="this.select()" onkeyup="sumamount()" /><br></div>
                    </div>
                    <div class="row">
                        <div class="col-md-10 text-right">Import /Custom Duty Charges </div>
                        <div class="col-md-2"><input class="form-control" readonly="readonly" type="text" id="importexportchrgs" name="customdutychrgs" value="<?= $row["customdutychrgs"] ?>" onclick="this.select()" onkeyup="sumamount()" /><br></div>
                    </div>

                    <div class="row">
                        <div class="col-md-10 text-right">Total Tax Value</div>
                        <div class="col-md-2"><input class="form-control  " type="text" id="totaltaxamount" name="totaltaxamount" value="<?= $row["totaltaxamount"] ?>" readonly="readonly" /><br></div>
                    </div>
                    <div id="taxdiv">
                    </div>
                    <div class="row">
                        <label class="col-md-10 text-right">Total Invoice Amount</label>
                        <div class="col-md-2"><input class="form-control " data-bvalidator="required,number,min[0]" type="text" id="totalamount" value="<?= $row["total_amount"] ?>" name="totalinvoiceamount" readonly="readonly" /><br></div>
                    </div>
                    <div class="row">
                        <label class="col-md-10 text-right">Round Off</label>
                        <div class="col-md-2"><input class="form-control " value="<?= $row["roundoff"] ?>" type="text" id="roundoff" name="roundoff" readonly="readonly" /><br></div>
                    </div>
                    <div class="row">
                        <label class="col-md-10 text-right">Total</label>
                        <div class="col-md-2"><input class="form-control" value="<?= $row["finaltotal"] ?>" data-bvalidator="required,number,min[0]" type="text" id="finaltotal" name="finaltotal" readonly="readonly" /><br></div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <div class="card-footer">
            <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
            <div id="resultid"></div>
        </div>

    </div>
    <!-- /.card-body -->
</div>
<?php
$pagemaincontent = ob_get_clean();
ob_clean();
$extracss = "<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css'/>";
$extrajs = '
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->

';
$breadcrumbs = '<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">View Purchase </li>
</ol>';
$pagemeta = "";
$pagetitle = "View Purchase ::.Manage Purchase -Quality";
$pageheader = "Manage Purchase ";
$breadcrumb = '<ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>';
$contentheader = "";
include "templete.php";
?>