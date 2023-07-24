<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'main/PHPMailer/src/Exception.php';
require 'main/PHPMailer/src/PHPMailer.php';
require 'main/PHPMailer/src/SMTP.php';

include "main/session.php";
$emailcount = $obj->selectfieldwhere('users', "count(id)", "email='" . $_POST['email'] . "' and status != 99");
$empcode = $obj->selectfieldwhere('users', 'count(id)', 'usercode="' . trim($_POST['employeeref']) . '" and type = 1');
if ($emailcount > 0) {
    echo "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative' role='alert'>Sorry! This Mail Already Exists </div>";
} elseif ($empcode != 1 && !empty($_POST['employeeref'])) {
    echo "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative' role='alert'>Sorry! Employee ID Does Not Match With Our Existing Employees  </div>";
} else {

    $x = array();
    $tb_name = 'users';
    $result4 = $obj->selectextrawhere('codegenerator', "`category` like 'usercode'");
    $num4 = $obj->total_rows($result4);
    $codegeneratorid = 0;
    $codenumber = 0;
    if ($num4) {
        $row4 = $obj->fetch_assoc($result4);
        $codegeneratorid = $row4['id'];
        $codenumber = $row4['number'] + 1;
        $generatedcode = sprintf('%04d', $codenumber);
        // $month = strtoupper(date("M", strtotime($date)));
        $uniqueid = str_replace(array("{prefix}", "{number}"), array($row4['prefix'], $generatedcode), $row4['pattern']);
    } else {
        $cg['prefix'] = "USER";
        $cg['number'] = 0;
        $cg['pattern'] = "{prefix}{number}";
        $cg['category'] = "usercode";
        // $fsed = getfirstandlastday($date);
        $cg['addedon'] = date("Y-m-d H:i:s");
        $cg['addedby'] = $employeeid;
        $cg['status'] = 1;
        $codegeneratorid = $obj->insertnew("codegenerator", $cg);
        $codenumber = 1;
        $generatedcode = sprintf('%04d', $codenumber);
        $uniqueid = str_replace(array("{prefix}", "{number}"), array($cg['prefix'], $generatedcode), $cg['pattern']);
    }
    $n['number'] = $codenumber;
    $obj->update("codegenerator", $n, $codegeneratorid);
    $x['usercode'] = $uniqueid;
    $x['added_on'] = date('Y-m-d H:i:s');
    // $x['added_by'] = $employeeid;
    $x['updated_on'] = date('Y-m-d H:i:s');
    // $x['updated_by'] = $employeeid;
    $x['status'] = 1;
    $x['name'] = ucwords($_POST['username']);
    $x['email'] = $_POST['email'];
    $x['mobile'] = $_POST['mobileno'];
    $x['address'] = $_POST['address'];
    $x['dob'] = changedateformate($_POST['dob']);
    $x['adharno'] = $_POST['adharno'];
    $x['panno'] = $_POST['panno'];
    $x['bankname'] = $_POST['bankname'];
    $x['accountno'] = $_POST['accountno'];
    $x['ifsc'] = $_POST['ifsc'];
    $x['employeeref'] = $_POST['employeeref'];
    $x['password'] = $_POST['password'];
    $x['longholding'] = $_POST['longholding'];
    $x['carryforward'] = $_POST['carryforward'];
    $x['message'] = $_POST['message'];
    // $x['policyread'] = $_POST['policyread'];
    $x['type'] = 2;
    $x['role'] = 2;
    $x['longholding'] = 'No';
    $x['startdatetime'] = changedateformatespecito($_POST['starttime'], "d/m/Y H:i:s", "Y-m-d H:i:s");
    $x['enddatetime'] = changedateformatespecito($_POST['endtime'], "d/m/Y H:i:s", "Y-m-d H:i:s");
    // $x['investmentamount'] = $_POST['investmentamount'];
    $x['limit'] = $_POST['limit'];

    $userid = $obj->insertnew($tb_name, $x);
    $path = "main/uploads/userdocs";
    foreach ($_POST["name"] as $key => $value) {
        $name = 'path' . $key;
        $document[$name]['name'] = $_FILES['path']['name'][$key];
        $document[$name]['type'] = $_FILES['path']['type'][$key];
        $document[$name]['tmp_name'] = $_FILES['path']['tmp_name'][$key];
        $document[$name]['size'] = $_FILES['path']['size'][$key];
        $document[$name]['error'] = $_FILES['path']['error'][$key];
        $y['path'] = $obj->uploadfilenew($path, $document, $name, array("png", "jpg", "jpeg", "pdf", "doc"));
        $y['name'] = $_POST['name'][$key];
        $y['userid'] = $userid;
        $y['added_on'] = date('Y-m-d H:i:s');
        $y['added_by'] = $employeeid;
        $y['updated_on'] = date('Y-m-d H:i:s');
        $y['updated_by'] = $employeeid;
        $y['status'] = 1;
        $postdata = $y;
        $tb_name = "userdocuments";
        $pradin = $obj->insertnew($tb_name, $postdata);
    }
    $defaultstock = array(
        // array(
        //     'Symbol' => 'NIFTY',
        //     'symboltoken' => '999920000',
        // ),
        // array(
        //     'Symbol' => 'SENSEX',
        //     'symboltoken' => '999901',
        // ),
        array(
            'Symbol' => 'RELIANCE',
            'symboltoken' => '2885',
        ),
        array(
            'Symbol' => 'HINDALCO',
            'symboltoken' => '1363',
        ),
        array(
            'Symbol' => 'M&M',
            'symboltoken' => '2031',
        ),
        array(
            'Symbol' => 'INFY',
            'symboltoken' => '1594',
        )
    );
    foreach ($defaultstock as $ds) {
        $jk['Symbol'] = $ds['Symbol'];
        $jk['symboltoken'] = $ds['symboltoken'];
        $jk['ExchType'] = 'C';
        $jk['Expiry'] = '';
        $jk['OptionType'] = '';
        $jk['StrikePrice'] = '0';
        $jk['mktlot'] = '1';
        $jk['added_on'] = date("Y-m-d H:i:s");
        $jk['added_by'] = 0;
        $jk['updated_on'] = date("Y-m-d H:i:s");
        $jk['updated_by'] = 0;
        $jk['status'] = 1;
        $jk['userid'] = $userid;
        $jk['Exch'] = 'N';
        $obj->insertnew('userstocks', $jk);
    }
    $obj->saveactivity("Added Customer by Admin", "", $userid, $employeeid, "Admin", "Added Customer by Admin");
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
    $mail->Subject = "Account has been approved";
    $mail->Subject = 'PMS Equity account has been approved & Login Id & Password is here';
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
            Welcome to PMS Equity- Access Your Account with Your New Login and Password...
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
                                <h1 style="margin: 0; font-size: 20px; font-weight: 700; letter-spacing: -1px; line-height: 30px; word-spacing: 2px;">Welcome to PMS Equity,</h1><br>
                                <h2 style="margin: 0; line-height: 30px; font-size: 17px; font-weight: 700; letter-spacing: -1px; word-spacing: 2px;">Your Account has been approved: Your Login ID & Password is here </h2>
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
                                <p>Congratulations! Your account has been created successfully.</p>
                                <p style="margin: 0;">Welcome to <a href="https://pms-equity.com/">PMS Equity</a> ! We are excited to have you as a new member of our community.</p>
                                <p>Your login information is given below:
                                    <br><br>
                                    <b>Email:</b><?= $x['email'] ?>
                                    <br><b><span style="margin-top: 10px;">Password:</b> <?= $x['password'] ?> </span>
                                </p>
                            </td>
                        </tr>
                        <!-- end copy -->

                        <!-- start button -->
                        <tr>
                            <td align="left" bgcolor="#ffffff">
                                <table border="0" cellpadding="0" cellspacing="0">
                                    <p style="margin-top:0; margin-right: 15px;">Click button to login </p>
                                    <tr>
                                        <td align="center" bgcolor="#1a82e2" style="border-radius: 6px;">
                                            <a href="https://pms-equity.com/login" style="display: block; padding: 7px 10px; font-family: 'Poppins', Helvetica, Arial, sans-serif; font-size: 14px; color: #ffffff; text-decoration: none; border-radius: 6px; font-weight:bold; letter-spacing:2px; margin:0; background-color: #00aaaa;">Login</a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <!-- end button -->

                        <!-- start copy -->
                        <tr>
                            <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: 'Poppins', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                                <p style="margin: 0;">We encourage you to explore our platform and take advantage of all the features we have to offer. If you have any questions or need assistance, our support team is available 24/7 to help at <a href="mailto:info@pmsequity.com">info@pmsequity.com</a>


                                </p>
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
    $mail->Body = $templatedata;
    $mail->send();

    echo "Redirect : User Added Successfully URLusers";
}
