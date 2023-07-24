<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './main/PHPMailer/src/Exception.php';
require './main/PHPMailer/src/PHPMailer.php';
require './main/PHPMailer/src/SMTP.php';

include './main/function.php';
include './main/conn.php';
$id = $obj->selectfieldwhere("users", "id", "email = '" . $_POST['email'] . "'");
if (empty($id)) {
    echo "<div  class='bg-red-100 border-t-4 border-red-500 rounded-b text-red-900 px-4 py-3 shadow-md' role='alert'>Email Not Registered!</div>";
    die;
}
$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host = $host;
$mail->SMTPAuth = $smtpauth;
$mail->Username = "$sendmailfrom";
$mail->Password = "$sendemailpassword";
$mail->isSendmail();

$mail->SMTPSecure = 'ssl';
$mail->Port = $port;
$mail->setFrom("$sendmailfrom", 'PMS Equity Team');;
$mail->addAddress($_POST['email']);
$mail->isHTML(true);
$mail->Subject = "Password Reset";
// $mail->AddEmbeddedImage('main/images/indstock.png', 'logo', 'main/images/indstock.png ');
// $mail->AddEmbeddedImage('main/images/envelope.png', 'envelope', 'main/images/envelope.png ');
ob_start();
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Account Confirmation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        /**
   * Google webfonts. Recommended to include the .woff version for cross-client compatibility.
   */
        @media screen {
            @font-face {
                font-family: 'Source Sans Pro';
                font-style: normal;
                font-weight: 400;
                src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format('woff');
            }

            @font-face {
                font-family: 'Poppins', sans-serif;
                font-style: normal;
                font-weight: 700;
                src: local('Poppins Bold'), local('Poppins-Bold'), url(https://fonts.gstatic.com/s/poppins/v15/pxiByp8kv8JHgFVrLCz7Z11lFQ.woff2) format('woff2');
            }
        }

        /**
   * Avoid browser level font resizing.
   * 1. Windows Mobile
   * 2. iOS / OSX
   */
        body,
        table,
        td,
        a {
            -ms-text-size-adjust: 100%;
            /* 1 */
            -webkit-text-size-adjust: 100%;
            /* 2 */
        }

        /**
   * Remove extra space added to tables and cells in Outlook.
   */
        /* table,  td {
            mso-table-rspace: 0pt;
            mso-table-lspace: 0pt;
        } */

        /**
   * Better fluid images in Internet Explorer.
   */
        img {
            -ms-interpolation-mode: bicubic;
        }

        /**
   * Remove blue links for iOS devices.
   */
        a[x-apple-data-detectors] {
            font-family: inherit !important;
            font-size: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
            color: inherit !important;
            text-decoration: none !important;
        }

        /**
   * Fix centering issues in Android 4.4.
   */
        div[style*="margin: 16px 0;"] {
            margin: 0 !important;
        }

        body {
            width: 100% !important;
            height: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        /**
   * Collapse table borders to avoid space between cells.
   */
        table {
            border-collapse: collapse !important;
        }

        a {
            color: #ff6100;
            font-weight: 600;
        }

        img {
            height: auto;
            line-height: 100%;
            text-decoration: none;
            border: 0;
            outline: none;
        }

        p {
            font-family: 'Poppins', sans-serif;
            font-size: 14px !important;
        }
    </style>

</head>

<body style="background-color: #e9ecef;">

    <!-- start preheader -->
    <div class="preheader" style="display: none; max-width: 0; max-height: 0; overflow: hidden; font-size: 1px; line-height: 1px; color: #fff; opacity: 0;">
        Please confirm your Account with PMS Equity, your Account Confirmation Code is...
    </div>
    <!-- end preheader -->

    <!-- start body -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top: 5%; margin-bottom: 5%;">


        <!-- start hero -->
        <tr>
            <td align="center" bgcolor="#e9ecef">
                <!--[if (gte mso 9)|(IE)]>
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
        <tr>
        <td align="center" valign="top" width="600">
        <![endif]-->
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td align="left" bgcolor="#ffffff" style="padding: 36px 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border-top: 3px solid #d4dadf;">
                            <h1 style="margin: 0; font-size: 22px; font-weight: 700; letter-spacing: -1px; line-height: 34px; word-spacing: 2px;">Reset Your Account Password- PMS Equity Account</h1>
                        </td>
                    </tr>
                </table>
                <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
            </td>
        </tr>
        <!-- end hero -->

        <!-- start copy block -->
        <tr>
            <td align="center" bgcolor="#e9ecef">
                <!--[if (gte mso 9)|(IE)]>
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
        <tr>
        <td align="center" valign="top" width="600">
        <![endif]-->
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">

                    <!-- start copy -->
                    <tr>
                        <td align="left" bgcolor="#ffffff" style="padding: 24px 24px 5px 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                            <p style="margin: 0;">We have received a request to reset the password for your PMS Equity account. </p>
                            <p>
                                To reset your password, click on the button below</p>
                        </td>
                    </tr>
                    <!-- end copy -->

                    <!-- start button -->
                    <tr>
                        <td align="left" bgcolor="#ffffff">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td align="center" bgcolor="#ffffff" style="padding: 12px;">
                                        <table border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td align="center" bgcolor="#1a82e2" style="border-radius: 6px;">
                                                    <a href='<?= $redirecturl ?>/resetpassword?hakuna=<?= $id ?>' style="display: inline-block; padding: 10px 15px; font-family: 'Poppins', sans-serif; font-size: 16px; color: #ffffff; text-decoration: none; border-radius: 6px; font-weight:bold; letter-spacing:2px; margin:0; background-color: #00aaaa;">Reset Password</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- end button -->

                    <!-- start copy -->
                    <tr>

                        <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: 'Poppins', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; margin:0;">
                            <p>
                                Or click on the link: <a href='<?= $redirecturl ?>/resetpassword?hakuna=<?= $id ?>'>https://www.pmsequity.com/resetpassword</a></p>
                            <p style="margin: 0;">
                                If you did not initiate this request, please contact our support team immediately to investigate.
                            </p>
                            <p>
                                If you have any questions or concerns, please do not hesitate to contact us at <a href="mailto:info@pmsequity.com" target="_blank">info@pmsequity.com</a>.
                            </p>
                        </td>
                    </tr>
                    <!-- end copy -->

                    <!-- start copy -->
                    <tr>
                        <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; border-bottom: 3px solid #d4dadf">
                            <p style="margin: 0;">Best regards,<br>PMS Equity Team</p><img width="145px" style=" margin-top: 20px;" src="https://pms-equity.com/main/images/pmslogo.png">
                        </td>
                    </tr>
                    <!-- end copy -->

                </table>
                <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
            </td>
        </tr>
        <!-- end copy block -->

</body>

</html>
<?php
$templatedata = ob_get_contents();
ob_end_clean();
$mail->Body = $templatedata;
// $mail->Body = "<div style='text-align:center'><img alt='PHPMailer' style='height:80px;width:150px' src='cid:logo'> </div>
//     <div style='border:1px solid darkblue;width:90%;margin:auto'></div><br>
//     <div style='text-align:center;margin: auto;width:100%'>
//         <img src='cid:envelope' style='height:130px;width:130px' alt='logo'>
//         <h3>Hii! 'Mohammed' </h3>
//         <div style='font-weight: 600;'>Click below to reset your password. </div>
//         <div style='font-weight: 600;'><a href='$redirecturl/resetpassword?hakuna=$id'>Password Reset</a></div>
//     </div>";
$mail->send();
echo "Redirect : Mail sent successfully, Please check you inbox  URLindex";
