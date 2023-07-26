<?php
include "main/session.php";
ob_flush();
ob_start();
// if (!in_array(187, $permissions)) {
//     header("location:index.php");
// }
?>
<div class="container px-6 mx-auto grid mobile-bottom-margin">

    <div class="flex" style="align-items: center;justify-content:space-between">
        <h3 class="my-6 font-semibold text-gray-700 dark:text-gray-200">Suppliers List</h3>
        <?php if (in_array(1, $permissions)) { ?>
            <button onclick='window.location.href="addsupplier"' class="my-6 px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                + Add New Supplier
            </button>
        <?php } ?>
    </div>


    <div class="w-full overflow-hidden rounded-lg shadow-xs">

        <div class="w-full ">

            <table id="example2" class="table w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-sm font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-3 py-2">ID</th>
                        <th class="px-3 py-2">Name</th>
                        <th class="px-3 py-2">Company</th>
                        <th class="px-3 py-2">City</th>
                        <th class="px-3 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    <?php

                    $tbname = "suppliers";
                    $result = $obj->selecttable($tbname);
                    while ($row = $obj->fetch_assoc($result)) {

                    ?> <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['company']; ?></td>
                            <td><?php echo $row['city']; ?></td>
                            <td>
                                <button class='flex items-center justify-between px-3 py-2 bg-blue text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray' onclick='window.location.href="editsupplier?hakuna=<?= $row["id"] ?>"' aria-label=' Go'>
                                    <span>Edit</span>
                                    <button class='flex items-center justify-between px-3 py-2 bg-red text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray' onclick="del(<?php echo $row['id']; ?>, 'deletesupplier.php','catid', 'Processing Delete Request')" aria-label=' Go'>
                                        <span>Delete</span>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<?php
//Assign all Page Specific variables
$pagemaincontent = ob_get_contents();
ob_end_clean();
$pagetitle = "Suppliers";
$pagemeta = "Some Meta Goes Here";
$pagekeywords = "Some keywords Goes here";
$contentheader = "Manage Suppliers";
//Apply the template
include("templete.php");
?>
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
    $(function() {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>