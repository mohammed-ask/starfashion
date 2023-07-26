<?php
include "../session.php";
// echo "<pre>";print_r($_POST);die;
if (isset($_POST["search"])) {
    $search = $_POST["search"];
    $vendor_id = (isset($_POST["vendor"])) ? $_POST["vendor"] : "";
    $currency = (isset($_POST["currency"])) ? $_POST["currency"] : "";
    // if ($_POST["wopo"] == "WO") {
    //     $wopo = "2";
    // } else if ($wopo = "PO") {
    //     $wopo = "1";
    // };
    // $join = "INNER join instrumentcategories on instrumentcategories.id = suppliermaterials.material";
    $resultdata = $obj->selectextrawhereupdate("subcategories", "subcategories.*", "subcategories.status = 1 and name like '%$search%'");

    $response = array();
    // echo "dasdas";
    // print_r($obj->fetch_assoc($data));
    // die;
    static $i = 0;
    while ($row = $obj->fetch_assoc($resultdata)) {
        $taxid =  $row["tax"];
        $unit_id =  $row["unit"];
        $item = "";
        $item .= "
<tr class='item-class itemrow' id='itemrow$i' style='position:relative'>
    <td class='s_no'>
    </td>
    <td>
   HSN/SAC:  <input type='text' readonly name='hsn_code[]' value='" . $row["hsn"] . "' class='form-control hsn'>
    Name:
        <input type='text' id='subid' value='" . $row["id"] . "' hidden name='subcategory_id[]'>
        <input type='text' id='indent_item' value='' hidden name='indent_item_id[]'>
        <input type='text' readonly id='it_name' value='" . $row["name"] . "' class='form-control'>
            <br>
            Price: <input type='number' id='price' data-bvalidator='required' name='price[]' value='' step='any' onclick='this.select()' onkeyup='calculateamount($_POST[my_gst_code],$_POST[gst_state_code],$_POST[state_code],this)' class='form-control price_class'>
    
    </td>
    <td>
        <input type='text' name='specification[]' value='' class='form-control'>

       </td>
    <td>
        <input type='number' id='quantity' step='any' name='quantity[]' data-bvalidator='required,min[1]' onclick='this.select()' value='' onkeyup='calculateamount($_POST[my_gst_code],$_POST[gst_state_code],$_POST[state_code],this)'  class='form-control qty'>
    </td>
    <td>
    <input type='text' id='unit' readonly value='" . $obj->selectfield("units", "description", "id", $unit_id) . "' class='form-control'>
    </td>
     
    <td>
        <input type='text' id='currency' readonly value='INR' class='form-control currency'>
        <input type='text' id='currency'  readonly value='$currency' name='currency[]' hidden class='form-control currency hidden'>
    </td>
    <td>
        <input type='number' id='amount' readonly step='any' name='list_price[]' class='form-control amount_class'>
    </td>
    <td>
        <input type='number'  id='eachdiscount' step='any'  value='0' name='discountperitem[]'  class='form-control discount_class'>
        <input type='hidden'  name='discamount[]' value='0' class='form-control discamount' readonly='readonly'/>
    </td>
    <td>
    <input type='text'  name='tax_rate[]' value='" . $obj->selectfield("tax", "percentage", "id", $taxid) . "%' class='form-control tax_class' readonly='readonly'/>
    </td>
    <td style=''><input   type='text'  name='igstper[]' value='' class='form-control igst hidden' '   />
    <input  name='igstamount[]' value='0' class='form-control igstamount' readonly='readonly'/></td>
    <td style=''><input type='text'   name='sgstper[]' value='' class='form-control sgst hidden' '  />
    <input  name='sgstamount[]' value='0' class='form-control sgstamount' readonly='readonly'/></td>
    <td style='<?php echo (0 == 0) ? 'display:none' : ''; ?><input type='text'   name='cgstper[]' value='' class='form-control cgst hidden' '  />
    <input  name='cgstamount[]' value='0' class='form-control cgstamount' readonly='readonly'/></td>
    <td><input type='text'  name='totaltaxamountitem[]' value='0' class='form-control totaltaxamountitem' readonly='readonly'/></td>
    <td><input type='text'  name='taxableamount[]' value='0' class='form-control taxableamount' readonly='readonly'/></td>
    
    <td><input type='text'  name='finalamount[]' value='0' class='form-control finalamount' readonly='readonly'/></td>
    <td>
    <button class='btn-sm btn-danger cls' onclick='event.preventDefault()'><i class='fa fa-times' aria-hidden='true'></i></button>
    </td>
</tr>
" . $i++ . "";
        $response[] = array(
            'value' => $row['name'],
            "label" => $row['name'],
            "data" => $item
        );
    }
    echo json_encode($response);
}
exit;
