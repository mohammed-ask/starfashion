<?php
include "main/session.php";
/* @var $obj db */
ob_start();

$customers = $obj->selectextrawhereupdate("suppliers", "id,company", "status=1");
$customer_data = mysqli_fetch_all($customers);

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
        <h3 class="card-title">Add Purchase</h3>

        <div class="card-tools">
            <a href="view_purchase_order.php" class=" px-3 py-2 bg-gray text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" data-card-widget="">
                Go Back </a>

            <button type="button" class="btn btn-tool" data-card-widget="">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form data-bvalidator-validate data-bvalidator-theme="gray" id="purchaseorderadd" onsubmit="event.preventDefault(); sendForm('', '', 'insertpurchase', 'resultid', 'purchaseorderadd'); return 0;" autocomplete="off">
        <div class="card-body">
            <div class="form-group row">
                <label class="col-sm-7 col-form-label text-right">Date: </label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="date" readonly data-bvalidator="required" value="<?= changedateformatespecito(date("d-m-Y"), "d-m-Y", "d/m/Y") ?>" id="date" onfocus="datepickermaxlimit('date', '2030')">
                </div>
            </div>
            <div id="wopocode">
                <div class="form-group row">
                    <label for="phone" class="col-sm-7 col-form-label text-right">Invoice No.</label>
                    <div class="col-sm-5">
                        <input type="text" data-bvalidator="required" name="po_number" class="form-control" id="purchase_order">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="website" class="col-sm-12 col-form-label">Currency</label>
                        <div class="col-sm-12">
                            <select class='form-control select2' id="currency" data-bvalidator='required' name='currency'>
                                <option value=''></option>
                                <?php
                                $tax_data = $obj->selectextrawhereupdate("currency", "id,name,description", "status=1");
                                $tax_data = mysqli_fetch_all($tax_data);

                                foreach ($tax_data as list($id, $name, $code)) {
                                ?>

                                    <option value='<?= $id ?>' <?= ($id == 1) ? "selected" : '' ?>><?php echo $name . $code ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-12 col-form-label">Business Name</label>
                        <div class="col-sm-12 ">
                            <div class="input-group-prepend">
                            </div>
                            <select name="customer_id" id="business" class="form-control select2" style="width: 100%">
                                <option value="-1">Choose One..</option>
                                <?php foreach ($customer_data as list($id, $customer_name)) { ?>
                                    <option value="<?php echo $id; ?>"> <?php echo $customer_name ?></option>
                                <?php } ?>
                            </select>

                        </div>
                    </div>
                    <div id="contact">

                    </div>
                </div>
                <div class="col-sm-6">
                    <!-- <div class="form-group row">
                        <label for="phone" class="col-sm-12 col-form-label">*Billed and Consign To:</label>
                        <div class="col-sm-12 ">
                            <textarea type="text" style="resize:none;height:150px" data-bvalidator="required" name="bill_and_consign_to" class="form-control" id="purchase_order"><?= $companyname . " &#10;" . $companyaddress . "&#10; Name :" . $companypersonname . " &#10; " . $companyphone ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-sm-12 col-form-label">Delivery Terms:</label>
                        <div class="col-sm-12 ">
                            <input type="text" data-bvalidator="required" name="delivery_terms" class="form-control" id="delivery_terms">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-sm-12 col-form-label">Payment Terms:</label>
                        <div class="col-sm-12 ">
                            <input type="text" data-bvalidator="required" name="payment_terms" class="form-control" id="payment_terms">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="quotationdate" class="col-sm-12 col-form-label">Quotation Date:</label>
                        <div class="col-sm-12">
                            <input type="text" readonly name="quotationdate" class="form-control" id="quotationdate" onfocus="datepickermaxlimit('quotationdate', '2030')">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-sm-12 col-form-label">Quotation Reference No:</label>
                        <div class="col-sm-12 ">
                            <input type="text" name="quotationno" class="form-control" id="payment_terms">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-sm-12 col-form-label">Warranty:</label>
                        <div class="col-sm-12 ">
                            <input type="text" data-bvalidator="required" name="warranty" class="form-control" id="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-sm-12 col-form-label">Jurisdiction :</label>
                        <div class="col-sm-12 ">
                            <input type="text" data-bvalidator="required" value="Subject to Indore Jurisdiction only" name="jurisdiction" class="form-control" id="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-sm-12 col-form-label">Other Detail :</label>
                        <div class="col-sm-12 ">
                            <textarea type="text" name="otherdetails" class="form-control" id=""></textarea>
                        </div>
                    </div> -->
                </div>
            </div>



            <div class="full-product-ui p-2">
                <div class="ml-4 mt-3">
                    <h5>Product Details</h5>
                </div>
                <table class="table table-responsive table-hover text-center table-bordered">
                    <thead>
                        <tr>
                            <td>
                                S.no

                            </td>
                            <td>
                                Instrument details
                            </td>

                            <td>
                                Specification

                            </td>

                            <td>
                                Quantity

                            </td>
                            <td>
                                Unit
                            </td>
                            <td>
                                Currency
                            </td>
                            <td>
                                Amount

                            </td>
                            <td>
                                Discount%

                            </td>
                            <td>
                                Tax Rate

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
                                Taxable
                            </td>
                            <td>
                                Total
                            </td>
                            <td style="width: 5%">
                                Close
                            </td>
                        </tr>
                    </thead>
                    <tbody id="result"></tbody>
                </table>
                <div id="nodata"></div>
                <div class="float-right mt-3 tax-detail" style="display:none;z-index:-1">
                    <div class="row">
                        <label class="col-md-10 text-right">Total Item Amount</label>
                        <div class="col-md-2"><input class="form-control  " data-bvalidator="" type="text" id="subtotal" name="subtotal" readonly="readonly" /><br></div>
                    </div>
                    <div class="row">
                        <label class="col-md-10 text-right"> Discount</label>
                        <div class="col-md-2"> <input class="form-control" onkeyup="" value="0" name="discount" id="discount" type="text" readonly="readonly" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10 text-right">Total After Discount Value</div>
                        <div class="col-md-2"><input class="form-control  " type="text" id="totalafterdisc" name="totalafterdisc" readonly="readonly" /><br></div>
                    </div>
                    <div class="row">
                        <div class="col-md-10 text-right">Packing & Forwarding Charges</div>
                        <div class="col-md-2"><input class="form-control  " type="text" id="packaginchrgs" name="packaginchrgs" value="0" onclick="this.select()" onkeyup="sumamount()" /><br></div>
                    </div>
                    <div class="row">
                        <div class="col-md-10 text-right">Freight Charges</div>
                        <div class="col-md-2"><input class="form-control  " type="text" id="freightchrgs" name="freightchrgs" value="0" onclick="this.select()" onkeyup="sumamount()" /><br></div>
                    </div>
                    <div class="row">
                        <div class="col-md-10 text-right">Insurance charges</div>
                        <div class="col-md-2"><input class="form-control  " type="text" id="insurancechrgs" name="insurancechrgs" value="0" onclick="this.select()" onkeyup="sumamount()" /><br></div>
                    </div>
                    <div class="row">
                        <div class="col-md-10 text-right">Calibration Certificate Charges</div>
                        <div class="col-md-2"><input class="form-control  " type="text" id="calibrationchrgs" name="calibrationchrgs" value="0" onclick="this.select()" onkeyup="sumamount()" /><br></div>
                    </div>
                    <div class="row">
                        <div class="col-md-10 text-right">Installation,Demonstration&Training Charges</div>
                        <div class="col-md-2"><input class="form-control  " type="text" id="trainingchrgs" name="trainingchrgs" value="0" onclick="this.select()" onkeyup="sumamount()" /><br></div>
                    </div>
                    <div class="row">
                        <div class="col-md-10 text-right">Import /Custom Duty Charges </div>
                        <div class="col-md-2"><input class="form-control  " type="text" id="importexportchrgs" name="customdutychrgs" value="0" onclick="this.select()" onkeyup="sumamount()" /><br></div>
                    </div>

                    <div class="row">
                        <div class="col-md-10 text-right">Total Tax Value</div>
                        <div class="col-md-2"><input class="form-control  " type="text" id="totaltaxamount" name="totaltaxamount" readonly="readonly" /><br></div>
                    </div>
                    <div class="row">
                        <div class="col-md-10 text-right">CGST Total</div>
                        <div class="col-md-2"><input class="form-control  " type="text" id="cgsttotal" name="cgst" readonly="readonly" /><br></div>
                    </div>
                    <div class="row">
                        <div class="col-md-10 text-right">SGST Total</div>
                        <div class="col-md-2"><input class="form-control  " type="text" id="sgsttotal" name="sgst" readonly="readonly" /><br></div>
                    </div>
                    <div class="row">
                        <div class="col-md-10 text-right">IGST Total</div>
                        <div class="col-md-2"><input class="form-control  " type="text" id="igsttotal" name="igst" readonly="readonly" /><br></div>
                    </div>
                    <div id="taxdiv">
                    </div>
                    <div class="row">
                        <label class="col-md-10 text-right">Total Invoice Amount</label>
                        <div class="col-md-2"><input class="form-control " data-bvalidator="required,number,min[0]" type="text" id="totalamount" name="totalinvoiceamount" readonly="readonly" /><br></div>
                    </div>
                    <div class="row">
                        <label class="col-md-10 text-right">Round Off</label>
                        <div class="col-md-2"><input class="form-control " type="text" id="roundoff" name="roundoff" readonly="readonly" /><br></div>
                    </div>
                    <div class="row">
                        <label class="col-md-10 text-right">Total</label>
                        <div class="col-md-2"><input class="form-control " data-bvalidator="required,number,min[0]" type="text" id="finaltotal" name="finaltotal" readonly="readonly" /><br></div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="flex items-center justify-between px-3 py-2 bg-blue text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray">
                    Submit
                </button>

                <div id="resultid"></div>
            </div>
    </form>
</div>


<!-- /.card-body -->


<?php
$pagemaincontent = ob_get_contents();
ob_end_clean();
$extracss = "";
$extrajs = '
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
';
$pagemeta = "";
$pagetitle = "Add About Us::$companyname";
$pageheader = "Manage About Us";
$breadcrumb = '<ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>';
include "templete.php";
?>
<script id="script">
    $(document).ready(function() {
        var my_code = '';
        var vendor_code = '';
        var state_code = '';
        $(document).on("change", "#customer_contact", function() {
            {
                (this.value == -2) ? $("#contact2").show(): $("#contact2").hide();
            };
        })

        $("button[type=submit]").click(function(e) {
            if ($.trim($("tbody#result").html()) == '') {
                e.preventDefault();
                alert("No Item is Added");
            }
        })

        $("#indent").click(function() {
            $("#indent_list").toggle();
        })

        $("#wopo").change(function() {
            search(this.id, 'wopocode', 'fetchwocode.php', '');
            $("#contact").html("");
            $("#business").select2().select2('val', '-1');
        })

        $("#business").change(function() {
            $(".cgst").val("")
            $(".sgst").val("")
            $(".igst").val("")
            $("#result").html("");
            var currency = $("#currency").val();
            var vendorid = $(this).val();
            $.get("../main/admin/fillvendordata.php", {
                hakuna: vendorid
            }, function(data) {
                $("#contact").html(data[0]);
                // console.log(data[0]);
                $.ajax({
                    type: "POST",
                    url: "../main/admin/fetchinstrumentsearch.php",
                    data: {
                        id: vendorid,
                        my_gst_code: data[2],
                        gst_state_code: data[3],
                        state_code: data[4],
                        currency: currency,
                        wopo: $("#wopo").val()
                    },
                    dataType: "json",
                    success: function(response) {
                        $("#contact").append(response[0]);
                        my_code = response[1];
                        vendor_code = response[2];
                        state_code = response[3];
                        $("#nodata").append(response[4]);
                        calculateamount(response[1], response[2], response[3]);
                        // console.log(response);
                        j = 1;
                        $(".s_no").each(function() {
                            $(this).val(j)
                            j = j + 1;
                        })
                        $(".tax-detail").show();
                    }
                });
            }, "json");
        });
        $(document).on('click', '.cls', function() {
            $(this).parents("tr").remove();
            var sno = $(".s_no").length;
            var j = 1;
            $(".s_no").each(function() {
                $(this).html(j)
                j = j + 1;
            });
            calculateamount(my_code, vendor_code, state_code);
        });


    });

    function additem(my_gst_code, gst_state_code, state_code) {
        html = "" +
            "<tr class='item-class itemrow' id='itemrow$i' style='position:relative'>" +
            "<td class='s_no'>" +
            "</td>" +
            "<td>" +
            "HSN/SAC:  <input type='text'  name='hsn_code[]' value='' class='form-control hsn'>" +
            "Name:" +
            "    <input type='text' id='subid' value='' hidden name='subcategory_id[]'>" +
            "    <input type='text' id='indent_item' value='' hidden name='indent_item_id[]'>" +
            "    <input type='text'  id='it_name' name='itemname[]' value='' class='form-control'>" +
            "         <br>" +
            "        Price: <input type='number' id='price'  data-bvalidator='required' name='price[]' value='' step='any' onclick='this.select()' onkeyup='calculateamount(" + my_gst_code + "," + gst_state_code + "," + state_code + ",this)' class='form-control price_class'>"

            +
            "</td>" +
            "<td>" +
            "    <input type='text' name='specification[]' value='' class='form-control'>"

            +
            "   </td>" +
            "<td>" +
            "    <input type='number' id='quantity' step='any' name='quantity[]' data-bvalidator='required,min[1]' onclick='this.select()' value='' onkeyup='calculateamount(" + my_gst_code + "," + gst_state_code + "," + state_code + ",this)'  class='form-control qty'>" +
            "</td>" +
            "<td>" +
            "<select   class='form-control' name='unit[]' id='unit'>"
        <?php
        $tbname = "units";

        $result = $obj->selecttable($tbname);
        while ($brow = $obj->fetch_assoc($result)) {
        ?>

                +
                "           <option  value='<?php echo $brow['id']; ?>' > <?php echo $brow['name'] . "(" . $brow['description'] . ")"; ?></option>"
        <?php
        }
        ?>
            +
            "     </select>"

            +
            "</td>"

            +
            "<td>" +
            "    <input type='text' id='currency'  value='<?php echo $obj->selectfield("currency", "concat(name,' ',description)", "id", "1"); ?>' class='form-control currency'>" +
            "    <input type='text' id='currency'   value='1' name='currency[]' hidden class='form-control currency hidden'>" +
            "</td>" +
            "<td>" +
            "    <input type='number' id='amount' readonly step='any' name='list_price[]' class='form-control amount_class'>" +
            "</td>" +
            "<td>" +
            "    <input type='number'  id='eachdiscount' step='any' onkeyup='calculateamount(" + my_gst_code + "," + gst_state_code + "," + state_code + ",this)'  value='0' name='discountperitem[]'  class='form-control discount_class'>" +
            "    <input type='hidden'  name='discamount[]' value='0' class='form-control discamount' readonly='readonly'/>" +
            "</td>" +
            "<td>" +
            "<input type='number'  name='tax_rate[]' value='18' class='form-control tax_class' />" +
            "</td>" +
            "<td style=''><input   type='text'  name='igstper[]' value='' class='form-control igst hidden' ' readonly='readonly'  />" +
            "<input  name='igstamount[]' value='0' class='form-control igstamount' readonly='readonly'/></td>" +
            "<td style=''><input type='text'   name='sgstper[]' value='' class='form-control sgst hidden' ' readonly='readonly' />" +
            "<input  name='sgstamount[]' value='0' class='form-control sgstamount' readonly='readonly'/></td>" +
            "<td style=''><input type='text'   name='cgstper[]' value='' class='form-control cgst hidden' ' readonly='readonly' />" +
            "<input  name='cgstamount[]' value='0' class='form-control cgstamount' readonly='readonly'/></td>" +
            "<td><input type='text'  name='totaltaxamountitem[]' value='0' class='form-control totaltaxamountitem' readonly='readonly'/></td>" +
            "<td><input type='text'  name='taxableamount[]' value='0' class='form-control taxableamount' readonly='readonly'/></td>"

            +
            "<td><input type='text'  name='finalamount[]' value='0' class='form-control finalamount' readonly='readonly'/></td>" +
            "<td>" +
            "<button class='btn-sm btn-danger cls' onclick='event.preventDefault()'><i class='fa fa-times' aria-hidden='true'></i></button>" +
            "</td>" +
            "</tr>";
        $('tbody#result').append(html).each(function() {
            var j = 1;
            a = $(this).children().last().find('#subid').val();
            $('.s_no').each(function() {
                $(this).html(j)
                j = j + 1;
            });
        });
    }

    function calculateTotal() {
        var subtotal = 0;
        $(".qty").each(function() {
            calculateamount(this);
        });
    }

    function calculateamount(my_code, vendor_code, state_code, obj = null) {
        var tr = $(obj).parent("td").parent(".itemrow");
        //        alert($(tr).html());

        $(".item-class").each(function() {
            var qty = $(this).find(".qty").val();
            var rate = $(this).find(".price_class").val();
            var tax_rate = $(this).find(".tax_class").val();
            tax_rate = tax_rate.replace("%", "");
            var finalamount = parseFloat(qty) * parseFloat(rate);
            $(this).find(".amount_class").val(finalamount);
            var discountpercent = $(this).find(".discount_class").val();
            // alert(discountpercent, 'dp')
            var discountamount = ((parseFloat(finalamount) / 100) * parseFloat(discountpercent));
            $(this).find(".discamount").val(discountamount);

            var taxableamount = parseFloat(finalamount) - parseFloat(discountamount);
            $(this).find(".taxableamount").val(taxableamount);
            tax = taxableamount * tax_rate / 100;
            var cgstamount = 0;
            var sgstamount = 0;
            var igstamount = 0;
            if (vendor_code == my_code) {
                tax_rate = tax_rate / 2;
                tax1 = tax / 2;
                tax2 = tax / 2;
                cgst = parseFloat(cgstamount) + parseFloat(tax1);
                sgst = parseFloat(sgstamount) + parseFloat(tax2);
                // alert(cgst + sgst + tax1 + 'ta' + taxableamount + 'dd')
                $(this).find(".cgst").val(parseFloat(tax_rate).toFixed(2));
                $(this).find(".sgst").val(parseFloat(tax_rate).toFixed(2));
                $(this).find(".cgstamount").val(parseFloat(cgst).toFixed(2));
                $(this).find(".sgstamount").val(parseFloat(cgst).toFixed(2));
                var totaltaxamount = parseFloat(cgst) + parseFloat(sgst)
            } else if (parseInt(vendor_code) !== 0) {
                igst = parseFloat(igstamount) + parseFloat(tax);
                $(this).find(".igst").val(parseFloat(tax_rate).toFixed(2));
                $(this).find(".igstamount").val(parseFloat(igst).toFixed(2));
                var totaltaxamount = parseFloat(igst);
            } else if (my_code == state_code) {
                tax_rate = tax_rate / 2;
                tax1 = tax / 2;
                tax2 = tax / 2;
                cgst = parseFloat(cgstamount) + parseFloat(tax1);
                sgst = parseFloat(sgstamount) + parseFloat(tax2);
                alert(cgst + sgst + tax1 + 'ta' + taxableamount + 'vv')

                $(this).find(".cgst").val(parseFloat(tax_rate).toFixed(2));
                $(this).find(".sgst").val(parseFloat(tax_rate).toFixed(2));
                $(this).find(".cgstamount").val(parseFloat(cgst).toFixed(2));
                $(this).find(".sgstamount").val(parseFloat(cgst).toFixed(2));
                var totaltaxamount = parseFloat(cgst) + parseFloat(sgst)
            } else if (parseInt(state_code) !== 0) {
                igst = parseFloat(igstamount) + parseFloat(tax);
                $(this).find(".igst").val(parseFloat(tax_rate).toFixed(2));
                $(this).find(".igstamount").val(parseFloat(igst).toFixed(2));
                var totaltaxamount = parseFloat(igst);
            } else if (parseInt(vendor_code) == 0) {
                igst = parseFloat(igstamount) + parseFloat(tax);
                $(this).find(".igst").val(parseFloat(tax_rate).toFixed(2));
                $(this).find(".igstamount").val(parseFloat(igst).toFixed(2));
                var totaltaxamount = parseFloat(igst);
            } else {
                // gross_amount = gross_amount + taxable;
                // $(".gross_amount").val(parseFloat(gross_amount).toFixed(2));
            }
            // var totaltaxamount = parseFloat(cgst) + parseFloat(sgst) + parseFloat(igst);
            $(this).find(".totaltaxamountitem").val(totaltaxamount);
            var finalamount = parseFloat(taxableamount) + parseFloat(totaltaxamount);
            $(this).find(".finalamount").val(finalamount);
            sumamount();
        });
    }

    function sumamount() {
        var subtotal = 0;
        var cgst = 0;
        var sgst = 0;
        var igst = 0;
        $('.amount_class').each(function() {
            subtotal += parseFloat(this.value);
        });
        $('.cgstamount').each(function() {
            cgst += parseFloat(this.value);
        });
        $('.sgstamount').each(function() {
            sgst += parseFloat(this.value);
        });
        $('.igstamount').each(function() {
            igst += parseFloat(this.value);
        });
        $("#subtotal").val(subtotal);
        var discountamount = 0;
        $('.discamount').each(function() {
            discountamount += parseFloat(this.value);
        });
        $("#discount").val(discountamount);
        $("#cgsttotal").val(cgst.toFixed(2));
        $("#sgsttotal").val(sgst.toFixed(2));
        $("#igsttotal").val(igst.toFixed(2));
        var toalafterdisc = subtotal - discountamount;
        $("#totalafterdisc").val(toalafterdisc);
        var totaltaxamount = 0;
        $('.totaltaxamountitem').each(function() {
            totaltaxamount += parseFloat(this.value);
        });
        packchrgs = $("#packaginchrgs").val();
        packchrgsgst = packchrgs * 18 / 100;
        freight = $("#freightchrgs").val();
        freightgst = freight * 18 / 100;
        insurance = $("#insurancechrgs").val();
        insurancegst = insurance * 18 / 100;
        calibration = $("#calibrationchrgs").val();
        calibrationgst = calibration * 18 / 100;
        training = $("#trainingchrgs").val();
        traininggst = training * 18 / 100;
        totaltaxamount += parseFloat(packchrgsgst) + parseFloat(insurancegst) + parseFloat(calibrationgst) + parseFloat(traininggst) + parseFloat(freightgst);
        $("#totaltaxamount").val(totaltaxamount.toFixed(2));
        var ftc = $("#importexportchrgs").val();
        var totalamount = parseFloat(toalafterdisc) + parseFloat(totaltaxamount) + parseFloat(packchrgs) + parseFloat(freight) + parseFloat(insurance) + parseFloat(calibration) + parseFloat(training) + parseFloat(ftc);
        totalamount = totalamount.toFixed(2);
        $("#totalamount").val(totalamount);
        finalamount = Math.round(totalamount);
        $("#finaltotal").val(finalamount)
        roundoff = finalamount - totalamount;
        roundoff = parseFloat(roundoff).toFixed(2)
        $("#roundoff").val(roundoff);
    }
</script>