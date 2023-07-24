<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
header( "Access-Control-Allow-Origin:*");
 header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');
 header('Content-type: text/plain'); 
require 'main/vendor/autoload.php';
//Create a new PHPMailer instance
$mail = new PHPMailer(true);
 //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug outputDEBUG_SERVER
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'mail.alldept.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = "$sendmailfrom";                     //SMTP username
    $mail->Password   = "$sendemailpassword";                               //SMTP password
    $mail->SMTPSecure = 'ssl';   
//    $mail->SMTPSecure = 'ssl';//Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
$mail->CharSet = 'UTF-8';
$mail->Encoding = 'base64';

$mail->Mailer = "smtp";

$rowcheck['signature'] = "";
if (isset($employeeid)) {
    $resultcheck = $obj->fixedselect('emailsetting', 'userid', $employeeid);
    $numcheck = $obj->total_rows($resultcheck);
    if (($numcheck != 0) && (!empty($employeeid))) {
        $rowcheck = $obj->fetch_assoc($resultcheck);
//Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = $rowcheck['email'];
//Password to use for SMTP authentication
        $mail->Password = $rowcheck['password'];
        $mail->setFrom($rowcheck['email'], $rowcheck['displayname']);
//Set an alternative reply-to address
        $mail->addReplyTo($rowcheck['email'], $rowcheck['displayname']);
    } else {
        $mail->Username = "$sendmailfrom";
//Password to use for SMTP authentication
        $mail->Password = "$sendemailpassword";
        $mail->setFrom("$sendmailfrom", "$companyname");
//Set an alternative reply-to address
        $mail->addReplyTo("$sendmailfrom", "$companyname");
    }
} else {
    $mail->Username = "$sendmailfrom";
//Password to use for SMTP authentication
    $mail->Password = "$sendemailpassword";
    $mail->setFrom("$sendmailfrom", "$companyname");
//Set an alternative reply-to address
    $mail->addReplyTo("$sendmailfrom", "$companyname");
}
//Set who the message is to be sent from
$mail->isHTML(true);
//Set who the message is to be sent to
?>