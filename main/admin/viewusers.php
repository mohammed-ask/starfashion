<?php
include "main/session.php";
/* @var $obj db */
ob_start();
if (!in_array(4, $permissions)) {
    header("location:index");
}
?>
<div class="container px-6 mx-auto grid mobile-bottom-margin">

    <div class="flex" style="align-items: center;justify-content:space-between">
        <h3 class="my-6 font-semibold text-gray-700 dark:text-gray-200">Users List</h3>
        <?php if (in_array(1, $permissions)) { ?>
            <button @click="openModal" onclick='dynamicmodal("none", "adduser", "Unlink", "Add New User")' class="my-6 px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                + Add User
            </button>
        <?php } ?>

    </div>


    <div class="w-full overflow-hidden rounded-lg shadow-xs">

        <div class="w-full ">

            <table id="example2" class="table w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-sm font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-3 py-2">S.No.</th>
                        <th class="px-3 py-2">User Name</th>
                        <th class="px-3 py-2">DOB</th>
                        <th class="px-3 py-2">Emp ID</th>
                        <th class="px-3 py-2">Email ID</th>
                        <th class="px-3 py-2">Mob No.</th>
                        <th class="px-3 py-2">PAN No.</th>
                        <th class="px-3 py-2">Addresss</th>
                        <th class="px-3 py-2">Bank Name</th>
                        <th class="px-3 py-2">A/c No.</th>
                        <th class="px-3 py-2">IFSC</th>
                        <th class="px-3 py-2">Aadhar No.</th>
                        <th class="px-3 py-2">Password</th>
                        <th class="px-3 py-2">Cost</th>
                        <th class="px-3 py-2">Value</th>
                        <!-- <th class="px-3 py-2">SMS</th> -->
                        <th class="px-3 py-2">Email</th>
                        <th class="px-3 py-2">Status</th>
                        <th class="px-3 py-2">Fund History</th>
                        <th class="px-3 py-2">View Docs</th>
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
//Assign all Page Specific variables
$pagemaincontent = ob_get_contents();
ob_end_clean();
$pagemeta = "";
$pagetitle = "PMS Equity: Users List";
$contentheader = "";
$pageheader = "";
include "templete.php";
?>
<script>
    $(function() {
        $('#example2').DataTable({
            "ajax": "../main/admin/usersdata.php",
            "processing": true,
            "serverSide": true,
            "pageLength": 15,
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

    $(document).on("click", ".setactive", function() {
        value = $(this).val();
        id = $(this).data("id");
        type = $(this).data("type");
        $.ajax({
            type: "post",
            url: "../main/admin/setactivation.php",
            data: {
                value: value,
                id: id,
                type: type
            },
            success: function(response) {
                if (response == 'Success') {
                    location.reload(true);
                }
            }
        });
        // sendForm('id', [id, decision], 'edit_indent_approve.php', 'resultid', 'indentdec');

    })
    $(document).on('click', '#eye', () => {
        iconname = $("#eye").attr("class");
        if (iconname === 'fa fa-eye') {
            $('#password').attr('type', 'text')
            $("#eye").attr('class', 'fa fa-eye-slash')

        } else {
            $('#password').attr('type', 'password')
            $("#eye").attr('class', 'fa fa-eye')
        }
    })

    function nodelete() {
        alertify.alert('Can\'t delete this user as their stock is in Open Position')
    }

    $(document).on('click', '#switchtype', () => {
        var data = $("#stype").html().trim();
        if (data.substring(0, 6) == '<selec') {
            $("#switchtype").html("<i class='fa-solid fa-caret-left'></i> Return to Default")
            $("#stype").html('<input name="message" id="message" class="block w-full  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Enter Custom Message" />')
        } else {
            $("#switchtype").html("Custom Message")
            $("#stype").html('<select data-bvalidator="required" name="message" class="select2 block w-full  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"><option value="Withdrawal temporarily unavailable due to a technical problem. Our team is working to resolve it promptly. Thank you for your patience.">Withdrawal temporarily unavailable due to a technical problem. Our team is working to resolve it promptly. Thank you for your patience.</option><option value="Withdrawal Restriction: You are currently unable to make a withdrawal for the next 24 hours. Please try again after the specified time has elapsed. Apologies for any inconvenience caused.">Withdrawal Restriction: You are currently unable to make a withdrawal for the next 24 hours. Please try again after the specified time has elapsed. Apologies for any inconvenience caused.</option> temporarily unavailable due to suspicious activity. Please re-verify your account to ensure security. To re-verify send your document(PAN, Aadhar & Bank Details) on mail. It will take 7 working days for verification.">Withdrawal temporarily unavailable due to suspicious activity. Please re-verify your account to ensure security. To re-verify send your document(PAN, Aadhar & Bank Details) on mail. It will take 7 working days for verification.</option><option value="Withdrawal Limit: You can only withdraw once every 7 days. Please wait until the specified time period has passed to initiate a withdrawal.">Withdrawal Limit: You can only withdraw once every 7 days. Please wait until the specified time period has passed to initiate a withdrawal.</option></select>')
            $("select").select2({
                minimumResultsForSearch: -1
            })
        }
    })
</script>