<?php
include "main/session.php";
/* @var $obj db */
ob_start();
?>
<div class="container px-6 mx-auto grid mobile-bottom-margin">

    <div class="flex" style="align-items: center;justify-content:space-between">
        <h3 class="my-6 font-semibold text-gray-700 dark:text-gray-200">Products List</h3>
        <?php if (in_array(1, $permissions)) { ?>
            <button @click='openModal' onclick='dynamicmodal("none", "addproducts", "", "Add New Prduct")' onclick="window.location.href='addproducts'" class="my-6 px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                + Add Products
            </button>
        <?php } ?>
    </div>


    <div class="w-full overflow-hidden rounded-lg shadow-xs">

        <div class="w-full ">

            <table id="example2" class="table w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-sm font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-3 py-2">S.No.</th>
                        <th class="px-3 py-2">Parent Category</th>
                        <th class="px-3 py-2">SubCategory</th>
                        <th class="px-3 py-2">Product Name</th>
                        <th class="px-3 py-2">Product Title</th>
                        <th class="px-3 py-2">Brand</th>
                        <th class="px-3 py-2">Model</th>
                        <th class="px-3 py-2">SKU</th>
                        <th class="px-3 py-2">Description</th>
                        <th class="px-3 py-2">Product Condition</th>
                        <th class="px-3 py-2">Sticker</th>
                        <th class="px-3 py-2">Gender For</th>
                        <th class="px-3 py-2">Age For</th>
                        <th class="px-3 py-2">Occasions</th>
                        <th class="px-3 py-2">Material Used</th>
                        <th class="px-3 py-2">Size</th>
                        <th class="px-3 py-2">Color</th>
                        <th class="px-3 py-2">Width x height x Length</th>
                        <th class="px-3 py-2">Wiight</th>
                        <th class="px-3 py-2">Price</th>
                        <th class="px-3 py-2">Discount</th>
                        <th class="px-3 py-2">Net Price</th>
                        <th class="px-3 py-2">Currency</th>
                        <th class="px-3 py-2">Affiliate Commision</th>
                        <th class="px-3 py-2">File Products</th>
                        <th class="px-3 py-2">Term Conditions</th>
                        <th class="px-3 py-2">Delivery Info</th>
                        <th class="px-3 py-2">Damage Return</th>
                        <th class="px-3 py-2">Product Display Positon</th>
                        <th class="px-3 py-2">Added on</th>
                        <th class="px-3 py-2">Active Status</th>
                        <th class="px-3 py-2">GST Rate</th>
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
$pagemeta = "";
$pagetitle = "View Products::.Manage Products";
$pageheader = "Manage Products";
include "main/admin/templete.php";
?>
<script>
    $(function() {
        $('#example2').DataTable({
            "ajax": "../main/admin/productsdata.php",
            "processing": true,
            "serverSide": true,
            "pageLength": 25,
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "order": [
                [0, "desc"]
            ]
        });
    });

    $(document).on('click', '.cls', function() {
        $(this).parents(".row").remove();
    })

    const addsizes = (productid) => {
        $.post({
            url: "../main/admin/fetchselectsize.php",
            success: function(response) {
                console.log(response)
                $('.sizedata').append(response)
                $(".select2").select2()
                // if (response === 'Success') {
                //     alertify.success('Item Added to Cart');
                // } else if (response === 'Failed') {
                //     alertify.error('Item Already Added to Cart');
                // }
            },
        });
    }
</script>