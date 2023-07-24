<?php
session_start();
if (isset($_SESSION['userid']) && $_SESSION['type'] == 2) {
    $employeeid = $_SESSION['userid'];
    header("location:dashboard");
}
include './main/function.php';
include './main/conn.php';
?>
<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - PMS Equity</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="main/dist/css/tailwind.output.css" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="main/dist/js/init-alpine.js"></script>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="main/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="main/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="main/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="main/dist/css/bvalidator.css">
    <link rel="stylesheet" href="main/dist/css/select2.min.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />

    <link rel="shortcut icon" href="main/images/logo/favicon.svg">

    <style>
/* --------------------alertify---------------- */

.alertify .ajs-header {
display: none;

}


.alertify .ajs-footer {
  /* padding: 4px; */
  margin-left: 0px !important;
  margin-right: 0px !important;
  min-height: 35px !important;
  background-color: #00aaaa2e !important;
  padding: 0px !important;
}

.alertify .ajs-dialog {
  
  padding: 15px 0px 0 0px !important;
  max-width: 400px !important;
  border-radius: 5px !important;
  top: 25%;
}

.alertify .ajs-footer .ajs-buttons.ajs-primary .ajs-button {
  margin: 0px !important;
}

.alertify .ajs-commands {
  margin:-12px 10px 0 0 !important; 
}

.alertify .ajs-footer .ajs-buttons .ajs-button.ajs-ok {
  color: #fff !important;
    border: 1px dotted #fff;
    border-radius: 5px;
    /* margin-right: 10px !important; */
    margin: 5px 6px 5px 10px !important;
    background-color: #00aaaa;
}

.alertify .ajs-dimmer {
  
  transition-timing-function: ease-in;
  transition-duration: 500ms !important;
}

  .alertify .ajs-modal {
  
    transition-timing-function: ease-out;
    transition-duration: 500ms !important;}




    </style>
</head>

<body>
    <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
        <div class="flex-1 h-full max-w-4l mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800">
            <div class="flex flex-col overflow-y-auto md:flex-row">
                <div class="h-32 md:h-auto md:w-1/2">
                    <img aria-hidden="true" class="object-cover w-full h-full dark:hidden" src="main/dist/img/login-register-side-img.png" alt="Office" />
                    <img aria-hidden="true" class="hidden object-cover w-full h-full dark:block" src="main/dist/img/login-register-side-img.png" alt="Office" />
                </div>
                <div style="padding-left: 2rem; padding-right: 2rem;" class="items-center justify-center p-6 sm:p-12 md:w-1/2">
                    <form method="post" onsubmit="event.preventDefault();sendForm('', '', 'checklogin', 'resultid', 'loginform');return 0;" id="loginform">
                        <div class="w-full">
                            <h4 class="mb-4 text-l font-semibold text-gray-700 dark:text-gray-200">
                                Login to PMS Equity
                            </h4>
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Email</span>
                                <input name="email" data-bvalidator='required' class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Enter your mail ID" />
                            </label>
                            <label class="block mt-4 mb-2 text-sm" style="position:relative">
                                <span class="text-gray-700 dark:text-gray-400">Password</span>
                                <input name="password" data-bvalidator='required' id="pass" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="********" type="password" />
                                <i id="eye" class="fa fa-eye" style="position: absolute; top:38px; right:10px" aria-hidden="true"></i>
                            </label>
                            <label class="block mt-4 mb-2 text-sm" style="position:relative">
                                <span class="text-gray-700 dark:text-gray-400">CAPTCHA</span>
                                <img style="border-radius: 5px; border:1px #e2e8f0 " src="main/generateimage.php" alt="CAPTCHA">
                                <input name="captcha" data-bvalidator='required' class="col-6 block mt-2 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" style="background-color: #e8f0fe !important;" placeholder="Enter Captcha" />
                            </label>
                            <div id="resultid"></div>
                            <!-- You should use a button here, as the anchor is only used for the example  -->
                            <button type="submit" class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                Log in
                            </button>

                            <p class="mt-4">
                                <a class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline" href="./forgotpassword">
                                    Forgot your password?
                                </a>
                            </p>
                            <p class="mt-1">
                                <a class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline" href="register">
                                    Create account
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="main/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="main/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="main/dist/js/adminlte.min.js"></script>
    <script src="main/dist/js/customfunction.js"></script>
    <script src="main/dist/js/jquery.bvalidator-yc.js"></script>
    <script src="main/dist/js/select2.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
</body>

</html>
<script>
    $(function() {

        $("#eye").click(() => {
            iconname = $("#eye").attr("class");
            if (iconname === 'fa fa-eye') {
                $('#pass').attr('type', 'text')
                $("#eye").attr('class', 'fa fa-eye-slash')

            } else {
                $('#pass').attr('type', 'password')
                $("#eye").attr('class', 'fa fa-eye')
            }
        })
    });
</script>