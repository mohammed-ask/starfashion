<?php
include '../session.php';
/* @var $obj db */
ob_clean();
ob_start();
$ids = implode(",", $_POST['ids']);
$result = $obj->selectextrawhere("purchase_item ", " status=-1  and id in ($ids) ");
$num = $obj->total_rows($result);
$data = array();
$tb_name = "mmproducts";
while ($row = $obj->fetch_assoc($result)) {
    $resultchallan = $obj->selectextrawhere("purchase", "id='" . $row['purchase_order_id'] . "'");
    $rowchallan = $obj->fetch_assoc($resultchallan);
    $resultsubcatgory = $obj->selectextrawhere("subcategories", "id='" . $row['subcategory_id'] . "'");
    $rowsubcategory = $obj->fetch_assoc($resultsubcatgory);
    $masterid = 0;
    if ($rowsubcategory['type'] != 3) {
        if ($rowsubcategory['type'] == 1) {
            $resultmaster = $obj->selectextrawhere("mmproducts", "type='" . $row['subcategory_id'] . "' and status !=99");
            $nummaster = $obj->total_rows($resultmaster);
            if ($nummaster) {
                $rowmaster = $obj->fetch_assoc($resultmaster);
                $masterid = $rowmaster['id'];
                $x = array();
                $x['quantity'] = $rowmaster['quantity'] + $row['qty'];
                $obj->update("mmproducts", $x, $masterid);
            } else {
                $x = array();
                $x['name'] = $row['name'];
                $x['description'] = $row['name'];
                // $x['nickname'] = $row['name'];
                //                $x['serialno'] = $row['serialno'];
                $x['unit'] = $rowsubcategory['unit'];
                $x['typeofuse'] = $rowsubcategory['type'];
                $x['category'] = $rowsubcategory['categoryid'];
                $x['type'] = $row['subcategory_id'];
                $x['quantity'] = $row['quantity'];
                // $x['batchno'] = $row['batchno'];
                // $x['mfddate'] = ($row['mfddate']);
                // $x['expdate'] = ($row['expdate']);
                // $x['purchasedate'] = ($rowchallan['date']);
                $x['added_on'] = date('Y-m-d H:i:s');
                $x['added_by'] = $employeeid;
                $x['updated_on'] = date('Y-m-d H:i:s');
                $x['updated_by'] = $employeeid;
                $x['status'] = 1;
                /* generate new code */
                $result4 = $obj->selectextrawhere("categories", "id='" . $x['category'] . "'");
                $row4 = $obj->fetch_assoc($result4);
                $codenumber = $row4['number'] + 1;
                $generatedcode = sprintf('%04d', $codenumber);
                $idno = str_replace(array("{prefix}", "{number}"), array($row4['code'], $generatedcode), $row4['pattern']);
                $n['number'] = $codenumber;
                $obj->update("categories", $n, $row4['id']);
                /* generate new code end */
                $x['idno'] = $idno;
                $postdata = $x;
                $masterid = $obj->insertnew($tb_name, $postdata);
            }
            // $y = array();
            // $y['mminstid'] = $masterid;
            // $y['mfddate'] = ($row['mfddate']);
            // $y['expdate'] = ($row['expdate']);
            // $y['batchno'] = $row['batchno'];
            // $y['purchasedate'] = ($rowchallan['challandate']);
            // $y['qty'] = $row['qty'];
            // $y['locationtype'] = "Lab";
            // $y['added_on'] = date('Y-m-d H:i:s');
            // $y['added_by'] = $employeeid;
            // $y['updated_on'] = date('Y-m-d H:i:s');
            // $y['updated_by'] = $employeeid;

            // $y['instrumentlocation']  = 24;
            // if ($rowsubcategory['critical'] == "1" || $rowsubcategory['status'] = -2) {
            //     $y['status'] = -1;
            // } else {
            //     $y['status'] = 1;
            // }

            // // $y['status'] = -2;
            // $obj->insertnew("materiallocation", $y);
        }


        if ($rowsubcategory['type'] == 2) {
            for ($i = 1; $i <= $row['qty']; $i++) {
                $x = array();

                $x['name'] = $row['name'];
                $x['description'] = $row['name'];
                // $x['nickname'] = $row['name'];

                //                $x['serialno'] = $row['serialno'];
                $x['unit'] = $rowsubcategory['unit'];
                $x['typeofuse'] = $rowsubcategory['type'];
                $x['category'] = $rowsubcategory['categoryid'];
                $x['type'] = $row['subcategory_id'];
                $x['quantity'] = 1;
                // $x['batchno'] = $row['batchno'];
                // $x['mfddate'] = ($row['mfddate']);
                // $x['expdate'] = ($row['expdate']);
                // $x['purchasedate'] = ($rowchallan['date']);
                $x['added_on'] = date('Y-m-d H:i:s');
                $x['added_by'] = $employeeid;
                $x['updated_on'] = date('Y-m-d H:i:s');
                $x['updated_by'] = $employeeid;
                $x['status'] = 1;
                /* generate new code */
                $result4 = $obj->selectextrawhere("categories", "id='" . $x['category'] . "'");
                $row4 = $obj->fetch_assoc($result4);
                $codenumber = $row4['number'] + 1;
                $generatedcode = sprintf('%04d', $codenumber);
                $idno = str_replace(array("{prefix}", "{number}"), array($row4['code'], $generatedcode), $row4['pattern']);
                $n['number'] = $codenumber;
                $obj->update("categories", $n, $row4['id']);
                /* generate new code end */
                $x['idno'] = $idno;
                $postdata = $x;
                $masterid = $obj->insertnew($tb_name, $postdata);
                // $y = array();
                // $y['mminstid'] = $masterid;
                // $y['mfddate'] = ($row['mfddate']);
                // $y['expdate'] = ($row['expdate']);
                // $y['batchno'] = $row['batchno'];
                // $y['purchasedate'] = ($rowchallan['challandate']);
                // $y['qty'] = 1;
                // $y['locationtype'] = "Lab";
                // $y['added_on'] = date('Y-m-d H:i:s');
                // $y['added_by'] = $employeeid;
                // $y['updated_on'] = date('Y-m-d H:i:s');
                // $y['updated_by'] = $employeeid;

                // $y['instrumentlocation']  = 24;
                // if ($rowsubcategory['critical'] == "1" || $rowsubcategory['status'] = -2) {
                //     $y['status'] = -1;
                // } else {
                //     $y['status'] = 1;
                // }

                // // $y['status'] = -2;
                // $obj->insertnew("materiallocation", $y);
            }
        }
    } else {
    }
    $z = array();
    $z['status'] = 0;
    $obj->update("purchase_item", $z, $row['id']);
}
echo "Success";
