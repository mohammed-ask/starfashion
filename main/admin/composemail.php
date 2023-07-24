<?php
include "main/session.php";
/* @var $obj db */
ob_start();
$sid = "";
if (isset($_POST['hakuna'])) {
    $sid = $_POST['hakuna'];
}
// $email = $obj->selectfieldwhere("users", 'email', "id=$employeeid");

?>
<div class="container px-6 mx-auto grid mobile-bottom-margin">
    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-2">
        <!-- Card -->

        <h3 class="my-6 font-semibold text-gray-700 dark:text-gray-200">
            Compose Mail
        </h3>
        <div>


        </div>

    </div>

    <div class="row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Email From :- <?= $sendmailfrom ?></h3>
                    <!-- <div class="card-tools">
                        <a href="viewrole" class="px-4 py-2  text-sm  bg-white  rounded-lg border border-gray" data-card-widget="">
                            << Back </a>
                                <button type="button" class="btn btn-tool" data-card-widget="">
                                    <i class="fas fa-times"></i>
                                </button>
                    </div> -->
                </div>
                <form id="addtax" enctype="multipart/form-data">
                    <div class="card-body">
                        <label class="block text-md" style="margin-bottom: 5px;">
                            <span class="text-gray-700 dark:text-gray-400">Send To</span>
                            <select data-bvalidator="required" class="form-control select2" name="userid" id="userid">
                                <option value="">Select User</option>
                                <?php
                                $cust = $obj->selectextrawhereupdate("users", "id,name", "status != 99 and id != $employeeid and id != 26 and type = 2");
                                $custname = mysqli_fetch_all($cust);
                                foreach ($custname as list($id, $name)) { ?>
                                    <?php if (!empty($sid) && $sid == $id) { ?>
                                        <option selected value="<?php echo $id; ?>"> <?php echo $name; ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $id; ?>"> <?php echo $name; ?></option>
                                <?php }
                                } ?>
                            </select>
                        </label><br>
                        <label class="block text-md" style="margin-bottom: 5px;">
                            <span class="text-gray-700 dark:text-gray-400">Subject</span>
                            <input name="subject" data-bvalidator="required" class="block w-full  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Subject" />
                        </label><br>
                        <label class="block text-md" style="margin-bottom: 5px;">
                            <span class="text-gray-700 dark:text-gray-400">Message</span>
                            <textarea data-bvalidator="" id="content" style="width: 100%;font-family:Century Gothic;font-size: 12px;" rows="10" name="message" class="block w-full  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Message"></textarea>
                        </label><br>
                        <label class="block text-md" style="margin-bottom: 5px;">
                            <span class="text-gray-700 dark:text-gray-400">Attach File</span>
                            <input type="file" multiple name="files[]" data-bvalidator="extension[jpg:jpeg:png:pdf:word]" data-bvalidator-msg-extension="This File Format Not Allowed" class="block w-full  text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Subject" />
                        </label><br>
                    </div>
                </form>
                <div class="card-footer">
                    <button class="px-4 py-2  text-sm  bg-theme-color  rounded-lg border border-gray" onclick="sendForm('', '', 'insertmail', 'resultid', 'addtax')">Send Mail</button>
                    <div class="col-md-12" id="resultid"></div>

                </div>
            </div>
        </div>
        <!-- /.col -->
    </div>

</div>
<?php
//Assign all Page Specific variables
$pagemaincontent = ob_get_contents();
ob_end_clean();
$pagemeta = "";
$pagetitle = "PMS Equity:";
$contentheader = "";
$pageheader = "";
$extrajs = '
<script src="main/tinymce/js/tinymce/tinymce.js"></script>'
    . '<script type="text/javascript" src="dist/js/jquery-json-form-binding.js"></script>
';
include "templete.php";
?>
<script>
    $(function() {

        tinymce.init({
            selector: "textarea#content",
            theme: "modern",
            setup: function(editor) {
                editor.on("change", function() {
                    tinymce.triggerSave();
                });
                editor.on("init", function(ed) {
                    ed.target.editorCommands.execCommand("fontName", false, "Century Gothic");
                    ed.target.editorCommands.execCommand("fontSize", false, "16px");

                });

            },
            height: 300,

            relative_urls: false,
            browser_spellcheck: true,
            external_filemanager_path: "filemanager/filemanager/",
            filemanager_title: "Filemanager",
            external_plugins: {
                "filemanager": "plugins/responsivefilemanager/plugin.min.js"
            },
            codemirror: {
                indentOnInit: true, // Whether or not to indent code on init. 
                path: "plugins/codemirror/plugin.min.js"
            },
            image_advtab: true,
            fontsize_formats: "8px 9px 10px 11px 12px 13px 14px 15px 16px 18px 20px 22px 24px 28px 30px 34px 36px 40px 44px 48px 50px",
            toolbar1: "undo redo | bold italic underline | strikethrough superscript subscript | alignleft aligncenter alignright alignjustify | bullist numlist  | hr pagebreak | forecolor backcolor fontsize fontsizeselect  sizeselect",



            font_formats: "Andale Mono=andale mono,times;" +
                "Arial=arial,helvetica,sans-serif;" +
                "Arial Black=arial black,avant garde;" +
                "Baskerville=baskerville,palatino linotype,palatino,century schoolbook l,times new roman,serif;" +
                "Book Antiqua=book antiqua,palatino;" +
                "Cambria=cambria,hoefler text,liberation serif,times,times new roman,serif;" +
                "Century Gothic=Century Gothic;" +
                "Comic Sans MS=comic sans ms,sans-serif;" +
                "Constantia=constantia,lucida bright,dejaVu serif,georgia,serif;" +
                "Consolas=consolas,andale mono,lucida console,lucida aans typewriter,monaco,courier new,monospace;" +
                "Courier New=courier new,courier;" +
                "Georgia=georgia,palatino;" +
                "Gotham=gotham,helvetica neue,helvetica,arial,sans-serif;" +
                "Gill Sans=gill sans,gill sans mt,myriad pro,dejaVu sans condensed,helvetica,arial,sans-serif;" +
                "Helvetica=helvetica;" +
                "Impact=impact,haettenschweiler,franklin gothic bold,arial black,sans-serif;" +
                "Lucida=lucida grande,lucida sans unicode,lucida sans,dejaVu sans,verdana,sans-serif;" +
                "Segoe=segoe,segoe ui,dejavu sans,trebuchet ms,verdana,sans-serif;" +
                "Symbol=symbol;" +
                "Tahoma=tahoma,arial,helvetica,sans-serif;" +
                "Terminal=terminal,monaco;" +
                "Times New Roman=times new roman,times;" +
                "Trebuchet MS=trebuchet ms,geneva;" +
                "Verdana=verdana,geneva;" +
                "Webdings=webdings;" +
                "Wingdings=wingdings,zapf dingbats",
        });
    })
</script>