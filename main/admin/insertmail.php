<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'main/PHPMailer/src/Exception.php';
require 'main/PHPMailer/src/PHPMailer.php';
require 'main/PHPMailer/src/SMTP.php';

include "main/session.php";

// $adminemail = $obj->selectfieldwhere('users', "email", "id=" . $employeeid . "");
$receivermail = $obj->selectfieldwhere('users', "email", "id=" . $_POST['userid'] . "");
$path = "main/mailfiles";
$vy['added_on'] = date('Y-m-d H:i:s');
$vy['added_by'] = $employeeid;
$vy['updated_on'] = date('Y-m-d H:i:s');
$vy['updated_by'] = $employeeid;
$vy['status'] = 1;
$vy['senderid'] = $employeeid;
$vy['receiverid'] = $_POST['userid'];
$vy['subject'] = $_POST['subject'];
$vy['message'] = $_POST['message'];
$mailid = $obj->insertnew('mail', $vy);
$obj->saveactivity("Send Mail to User", "", $mailid, $_POST['userid'], "User", "Send Mail to User");
if (!empty($_FILES['files']['name'][0])) {
    foreach ($_FILES['files']["name"] as $key => $value) {
        $name = 'path' . $key;
        $document[$name]['name'] = $_FILES['files']['name'][$key];
        $document[$name]['type'] = $_FILES['files']['type'][$key];
        $document[$name]['tmp_name'] = $_FILES['files']['tmp_name'][$key];
        $document[$name]['size'] = $_FILES['files']['size'][$key];
        $document[$name]['error'] = $_FILES['files']['error'][$key];
        $y['path'] = $obj->uploadfilenew($path, $document, $name, array("png", "jpg", "jpeg", "pdf", "word", "webp"));
        $y['senderid'] = $employeeid;
        $y['receiverid'] = $_POST['userid'];
        $y['mailid'] = $mailid;
        $y['added_on'] = date('Y-m-d H:i:s');
        $y['added_by'] = $employeeid;
        $y['updated_on'] = date('Y-m-d H:i:s');
        $y['updated_by'] = $employeeid;
        $y['status'] = 1;
        $postdata = $y;
        $tb_name = "maildocuments";
        $pradin = $obj->insertnew($tb_name, $postdata);
    }
}
// if ($adminemail == $sendmailfrom) {
$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host = $host;
$mail->SMTPAuth = true;
$mail->Username = "$sendmailfrom";
$mail->Password = "$sendemailpassword";
$mail->isSendmail();
$mail->SMTPSecure = 'ssl';
$mail->Port = $port;
$mail->setFrom("$sendmailfrom", 'PMS Equity Team');
$mail->addAddress($receivermail);
$mail->isHTML(true);
$mail->addReplyTo("$sendmailfrom", 'PMS Equity Team');
$mail->Subject = $_POST['subject'];
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Email Confirmation</title>
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
        table,
        td {
            mso-table-rspace: 0pt;
            mso-table-lspace: 0pt;
        }

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
        }
    </style>

</head>

<body style="background-color: #e9ecef;">

    <!-- start preheader -->
    <div class="preheader" style="display: none; max-width: 0; max-height: 0; overflow: hidden; font-size: 1px; line-height: 1px; color: #fff; opacity: 0;">
        Important nortification from PMS Equity, View message...
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
                            <h1 style="margin: 0; font-size: 16px;font-weight: 700; letter-spacing: -1px; line-height: 10px; word-spacing: 2px;">Dear Valued Customer,</h1>
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
                        <td align="left" bgcolor="#ffffff" style="padding: 5px 24px 5px 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                            <p><?= $_POST['message'] ?></p>
                        </td>
                    </tr>
                    <!-- end copy -->



                    <!-- start copy -->
                    <tr>
                        <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: 'Poppins', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                            <p style="margin: 0;margin-top: 15px;">If you have any questions or need assistance, our support team is available 24/7 to help at <a href="mailto:info@pmsequity.com">info@pmsequity.com</a></p>
                            <p>
                                Thank you for choosing PMS Equity. We look forward to helping you achieve your investment goals.
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
$attachfile = $obj->selectextrawhere('maildocuments', "mailid=$mailid");
while ($rowfile = $obj->fetch_assoc($attachfile)) {
    $path = $obj->selectfieldwhere('uploadfile', "path", "id=" . $rowfile['path'] . "");
    $orgname = $obj->selectfieldwhere('uploadfile', "orgname", "id=" . $rowfile['path'] . "");
    $mail->addAttachment($path, $orgname);
}
$mail->Body = $templatedata;
$mail->send();
echo "Redirect :  Mail Sent! URLcomposemail";
// }
