<?php
include "main/session.php";
ob_flush();
ob_start();
// if (!in_array(172, $permissions)) {
//     header("location:index.php");
// }
//$woid = $_GET['hakuna'];
?>
<div class="card card-default">
    <div class="card-header with-border">
        <h3 class="card-title with-border">Item List Pending For Coding</h3>
        <div class="card-tools pull-right">

        </div>
    </div>
    <div class="card-body" id="catid">
        <table id="example1" class="table w-full whitespace-no-wrap">
            <thead>
                <tr class="text-sm font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th>Sr.No</th>
                    <th>Name</th>
                    <th>HSN Code </th>
                    <th>UOM </th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
            </tbody>
        </table>
        <div class="card-footer">
            <div id="resultidallot"></div>
            <button type="button" class="btn btn-default" onclick="approveForCoding()">Approve For Coding</button>
        </div>
    </div>

</div>
<?php
//Assign all Page Specific variables
$pagemaincontent = ob_get_contents();
ob_end_clean();
$pagetitle = "Manage Material Receipt note";
$pagemeta = "Some Meta Goes Here";
$pagekeywords = "Some keywords Goes here";
$contentheader = "Manage Material Receipt note";
$onpagejs = '$(document).ready(function () {
    table = $("#example1").DataTable({
                             "responsive": true,
                             "ajax": "../main/admin/pendingforcodingdata.php",
                             "processing": true,
                             "serverSide": true,
                             "pageLength": 100,
                             "bJQueryUI": true,
                             "order": [[0, "desc"]],
                             "sPaginationType": "full_numbers",
                             dom: \'<"top"if>rt<"bottom"lp><"clear">\'
                             
                         });
   
 });
      ';
$extrajs = ' <script src="plugins/datatables/jquery.dataTables.min.js"></script>';
$extracss = '<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">';
//Apply the template
include("templete.php");
?>
<script>
    function approveForCoding() {
        var ids = new Array();
        $('.checkboxes:checkbox:checked').each(function() {
            ids.push($(this).val());
        });
        if (ids.length > 0) {
            $.post("../main/admin/approveInstrumenttocoding.php", {
                ids: ids
            }, function(data) {
                $("#resultidallot").html(data);
                alert(data);

                location.reload();
            });
        } else {
            alert("Please Select an item");
        }
    }
</script>