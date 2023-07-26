<?php
include "main/session.php";
ob_flush();
ob_start();
// if (!in_array(173, $permissions)) {
//     header("location:index.php");
// }
?>
<div class="card">

    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Product Name</th>
                    <th>ID no</th>
                    <!-- <th>Location</th> -->
                    <!-- <th>Critical</th> -->
                    <th>Batch no.</th>
                    <th>Quantity</th>

                </tr>
            </thead>
            <tbody>

            </tbody>

        </table>
    </div>
    <!-- /.card-body -->
    <div class="modal fade" id="editstock" tabindex="-1" role="dialog" aria-labelledby="myModalLab">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add New Size</h4>
                </div>
                <div class="modal-body">
                    <form id="addweight">
                        <input name="name" class="form-control" type="text" data-bvalidator="required" placeholder="Size Name" />
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" onclick="sendForm('', '', 'insertweight.php', 'myModalLabel', 'addweight')" class="btn btn-primary">Add Size</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
//Assign all Page Specific variables
$pagemaincontent = ob_get_contents();
ob_end_clean();
$pagetitle = "Abaxsoft - Making Life Easier";
$pagemeta = "Some Meta Goes Here";
$pagekeywords = "Some keywords Goes here";
$contentheader = "Stock report";
//Apply the template
include("templete.php");
?>
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {

        table = $("#example1").DataTable({
            "responsive": true,
            "ajax": "../main/admin/stockdata.php",
            "processing": true,
            "serverSide": true,
            "pageLength": 25,
            "bJQueryUI": true,
            "order": [
                [1, "desc"]
            ],
            "ordering": true,
            "sPaginationType": "full_numbers",
            dom: '<"top"if>rt<"bottom"lp><"clear">',

        });
        // Apply the search


    });
</script>