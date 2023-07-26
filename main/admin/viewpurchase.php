<?php
include "main/session.php";
// @var obj db

ob_start();
// if(!in_array(287, $permissions)){
//     header("location:index.php");
// }
?>
<div class="container px-6 mx-auto grid mobile-bottom-margin">

    <div class="flex" style="align-items: center;justify-content:space-between">
        <h3 class="my-6 font-semibold text-gray-700 dark:text-gray-200">Manage Purchase</h3>
        <?php if (in_array(1, $permissions)) { ?>
            <button onclick='window.location.href="addpurchase"' class="my-6 px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                + Add New Purchase
            </button>
        <?php } ?>
    </div>


    <div class="w-full overflow-hidden rounded-lg shadow-xs">

        <div class="w-full ">

            <table id="example2" class="table w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-sm font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-3 py-2">Id</th>
                        <th class="px-3 py-2">Bill No </th>
                        <th class="px-3 py-2">Generated By</th>
                        <th class="px-3 py-2">Vendor Name</th>
                        <th class="px-3 py-2">Added On</th>
                        <th class="px-3 py-2">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                </tbody>
            </table>
        </div>
    </div>

</div>
<?php
$pagemaincontent = ob_get_clean();
ob_clean();
$extracss = "";
$extrajs = '
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
';
$breadcrumbs = '<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">View Purchase Order</li>
</ol>';
$pagemeta = "";
$pagetitle = "View Purchases::.Manage Purchase Order-Quality";
$pageheader = "Manage Purchase Order";
// $breadcrumb = '<ol class="breadcrumb float-sm-right">
//               <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
//               <li class="breadcrumb-item active">Dashboard v1</li>
//             </ol>';
$contentheader = "";
include "templete.php";
?>
<script>
    $(function() {
        $('#example2 thead tr')
            .clone(true)
            .addClass('filters')
            .appendTo('#example2 thead');

        $("#example2").DataTable({
            orderCellsTop: true,
            fixedHeader: true,
            "serverSide": true,
            "ajax": "../main/admin/purchasedata.php",
            "pageLength": 25,
            "autoWidth": false,
            "responsive": true,
            "sPaginationType": "full_numbers",
            dom: '<"top"if>rt<"bottom"lp><"clear">',

            // execute callback when DataTable is completely initialiazed
            "initComplete": function() {
                var api = this.api();
                api
                    .columns(1).eq(0).each(function(colIdx) {
                        // Set the header cell to contain the input element
                        var cell = $('.filters th').eq(
                            $(api.column(colIdx).header()).index()
                        );
                        var title = $(cell).text();
                        $(cell).html('<select class="form-control input-sm"><option value="1">Approved</option><option value="2">Unapproved</option><option value="3">All</option>')

                        // On every keypress in this input
                        $(
                                'select',
                                $('.filters th').eq($(api.column(colIdx).header()).index())
                            )
                            // .appendTo($(cell).empty())
                            .on('change', function(e) {
                                e.stopPropagation();

                                // Get the search value
                                // $(this).attr('title', $(this).val());
                                //   var regexr = '{search}'; //$(this).parents('th').find('select').val();

                                // var cursorPosition = this.selectionStart;
                                // Search the column for that value
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );
                                api
                                    .column(colIdx)
                                    .search(val ? val : '', true, false)
                                    .draw();

                                // $(this)
                                //     .focus()[0]
                                //     .setSelectionRange(cursorPosition, cursorPosition);
                            });
                    });
                api
                    .columns([0, 2, 3, 4, 5, 6, 7]).eq(0).each(function(colIdx) {
                        // Set the header cell to contain the input element
                        var cell = $('.filters th').eq(
                            $(api.column(colIdx).header()).index()
                        );
                        var title = $(cell).text();
                        $(cell).html('<input style="width:100%" type="text" placeholder="' + title + '" />');

                        // On every keypress in this input
                        $(
                                'input',
                                $('.filters th').eq($(api.column(colIdx).header()).index())
                            )
                            .off('keyup change')
                            .on('keyup change', function(e) {
                                e.stopPropagation();

                                // Get the search value
                                $(this).attr('title', $(this).val());
                                var regexr = '{search}'; //$(this).parents('th').find('select').val();

                                var cursorPosition = this.selectionStart;
                                // Search the column for that value
                                api
                                    .column(colIdx)
                                    .search(
                                        this.value != '' ?
                                        regexr.replace('{search}', '' + this.value + '') :
                                        '',
                                        this.value != '',
                                        this.value == ''
                                    )
                                    .draw();

                                $(this)
                                    .focus()[0]
                                    .setSelectionRange(cursorPosition, cursorPosition);
                            });
                    });
            },

        });


        $(document).on("click", "#approve", function() {
            decision = $(this).data("decision");
            id = $(this).data("id");
            // alert(id);
            // return false;
            window.location.href = "edit_Purchase Order_approve.php?hakuna=" + id;
            // sendForm('id', [id, decision], 'edit_Purchase Order_approve.php', 'resultid', 'Purchase Orderdec');

        })
        $(document).on("click", "#reject", function() {
            decision = $(this).data("decision");
            id = $(this).data("id");
            // alert(id);
            // return false;
            // window.location.href = "edit_Purchase Order_approve.php?hakuna=" + id;
            sendForm('id', [id, decision], 'reject_Purchase Order.php', 'resultid', 'Purchase Orderdec');

        })
    });
</script>