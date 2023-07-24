<?php
include "main/session.php";
/* @var $obj db */
ob_start();
if (in_array(34, $permissions)) {
    $activeclient = $obj->selectfieldwhere("users", "count(id)", "status =1 and activate='Yes' and type=2 and id != 26");
    $pendinguser = $obj->selectfieldwhere("users", "count(id)", "status =0");
    // $totalinv = $obj->selectfieldwhere("users", "sum(investmentamount)", "status =1 and id != 26");
    // $opentradeamt = $obj->selectfieldwhere("stocktransaction", "sum(totalamount)", "status =0 and tradestatus='Open' and userid != 26");
    // $openposition = $obj->selectfieldwhere("stocktransaction", "count(id)", "status =0 and tradestatus='Open' and userid != 26");
?>
    <style>
        #datacards a {
            color: white;
        }
    </style>
    <div class="container px-6 mx-auto grid mobile-bottom-margin">

        <h2 class="my-6 font-semibold text-gray-700 dark:text-gray-200">
            Dashboard
        </h2>

        <!-- Cards -->
        <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
            <!-- Card -->
            <div class="flex items-center p-3 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="mb-2  font-medium text-gray-600 dark:text-gray-400">
                        Active clients
                    </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                        <?= $activeclient ?>
                    </p>
                </div>
            </div>

            <!-- Card -->
            <div class="flex items-center p-3 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div>
                    <p class="mb-2  font-medium text-gray-600 dark:text-gray-400">
                        Total investment
                    </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                        <span>₹</span> <?php //echo round($totalinv + $opentradeamt, 2) ?>
                    </p>
                </div>
            </div>
            <!-- Card -->
            <div class="flex items-center p-3 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                    <i class="fa-solid fa-user-clock w-5 h-5" fill="currentColor" viewBox="0 0 20 20"></i>
                </div>
                <div>
                    <p class="mb-2  font-medium text-gray-600 dark:text-gray-400">
                        Pending approval
                    </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                        <?= $pendinguser ?>
                    </p>
                </div>
            </div>
            <!-- Card -->
            <div class="flex items-center p-3 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
                    <i class="fa-solid fa-handshake-angle w-5 h-5" fill="currentColor" viewBox="0 0 20 20"></i>
                </div>
                <div>
                    <p class="mb-2  font-medium text-gray-600 dark:text-gray-400">
                        Open positions
                    </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                        <?php //echo $openposition ?>
                    </p>
                </div>
            </div>
        </div>
        <h3 class="my-6 text-1xl font-semibold text-gray-700 dark:text-gray-200">
            Open Trade Orders
        </h3>
        <div class="w-full overflow-hidden rounded-lg shadow-xs">

            <div class="w-full ">

                <table id="example1" class="table w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-sm font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-3 py-2">S.No.</th>
                            <th class="px-3 py-2">Stock Name</th>
                            <th class="px-3 py-2">Lot</th>
                            <th class="px-3 py-2">Price</th>
                            <th class="px-3 py-2">Stop Loss</th>
                            <th class="px-3 py-2">Lot/Quantity</th>
                            <th class="px-3 py-2">Total</th>
                            <th class="px-3 py-2">Date & Time</th>
                            <th class="px-3 py-2">User</th>
                            <th class="px-3 py-2">Status</th>
                            <th class="px-3 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- right col -->
    </section>
<?php
}
//Assign all Page Specific variables
$pagemaincontent = ob_get_contents();
ob_end_clean();
$pagemeta = "";
$pagetitle = "PMS Equity: Admin Dashboard";
$contentheader = "";
$pageheader = "";
include "main/admin/templete.php";
?>
<script>
    // var table = $('#example1').DataTable({
    //     "ajax": "../main/admin/opentradedata.php",
    //     "processing": false,
    //     "serverSide": true,
    //     "pageLength": 10,
    //     "paging": true,
    //     "lengthChange": false,
    //     "searching": false,
    //     "ordering": true,
    //     "info": true,
    //     "autoWidth": false,
    //     "responsive": true,
    //     "order": [
    //         [0, "desc"]
    //     ],
    // })
    
</script>