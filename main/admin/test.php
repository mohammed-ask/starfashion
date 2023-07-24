<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'mohammedhusain559@gmail.com';
$mail->Password = 'grznigwfoititsbm';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
$mail->setFrom('mohammedhusain559@gmail.com');
$mail->addAddress('mohammedmaheswer12@gmail.com');
$mail->isHTML(true);
$mail->Subject = "Registration Successfull";
$mail->AddEmbeddedImage('main/images/indstock.png', 'logo', 'main/images/indstock.png ');
$mail->AddEmbeddedImage('main/images/envelope.png', 'envelope', 'main/images/envelope.png ');
$mail->Body = "<div style='text-align:center'><img alt='PHPMailer' style='height:80px;width:150px' src='cid:logo'> </div>
<div style='border:1px solid darkblue;width:90%;margin:auto'></div><br>
<div style='text-align:center;margin: auto;width:100%'>
    <img src='cid:envelope' style='height:130px;width:130px' alt='logo'>
    <h3>Hii! 'Mohammed' </h3>
    <div style='font-weight: 600;'>Thanks For Registering on India Stock. </div>
    <div style='font-weight: 600;'>We will notify you about your Approval status shortly.</div>
</div>";
$mail->send();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div style='font-family:cursive'>Registration Successfull</div>
    <div style="text-align:center"><img src='main/images/indstock.png' style='height:80px;width:150px' alt='logo'></div>
    <div style='border:1px solid darkblue;width:90%;margin:auto'></div><br>
    <div style="text-align:center;margin: auto;width:100%">
        <img src='main/images/envelope.png' style='height:130px;width:130px' alt='logo'>
        <h3>Hii! "Mohammed" </h3>
        <div style="font-weight: 600;">Thanks For Registering on India Stock. </div>
        <div style="font-weight: 600;">We will notify you about your Approval status shortly</div>
    </div>
</body>

</html>