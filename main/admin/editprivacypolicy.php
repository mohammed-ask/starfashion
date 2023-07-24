<?php
include "main/session.php";
$id = $_GET['hakuna'];
$result = $obj->selectextrawhere("about", "id=$id");
$row = $obj->fetch_assoc($result);
?>
<div class="row">
    <div class="col-12 mobile-bottom-margin">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Edit Privacy policy</h3>
            </div>
            <form style="overflow-x: hidden;" id="adduser" onsubmit="event.preventDefault();sendForm('id', '<?= $row['id'] ?>', 'updateprivacypolicy', 'resultid', 'adduser');return 0;">
                <div class="card-body">
                    <label class="block text-sm" style="margin-bottom: 5px;">
                        <span class="text-gray-700 dark:text-gray-400">Content</span>
                        <textarea style="height: 300px;" name="content" id="summernote" class="block w-full  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder=""><?= $row['content'] ?></textarea>
                    </label>

                    <div>
                        <button type="submit" class="flex items-center justify-between px-3 py-2 bg-blue text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray">
                            Submit
                        </button>
                    </div>
                    <div id="resultid"></div>
                </div>
            </form>
        </div>
    </div>
    <!-- /.col -->
</div>
<?php
$pagemaincontent = ob_get_clean();
ob_clean();
$extracss = "";
$extrajs = '
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
';
$pagemeta = "";
$pagetitle = "Edit Privacy Policy::.Manage Privacy Policy-Admin";
$pageheader = "Manage Privacy Policy";
$breadcrumb = '<ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>';
include "templete.php";
?>
<script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
</script>