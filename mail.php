<?php
// هذه الكود لارسال رسالة الى البريد الكتروني
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'mailer/autoload.php';

$mail = new PHPMailer();

    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                   
    $mail->isSMTP();                                       
    $mail->Host       = 'smtp.gmail.com';                    
    $mail->SMTPAuth   = true;                                  
    $mail->Username   = 'email@gmail.com';                   
    $mail->Password   = 'password';                               
    $mail->SMTPSecure = 'ssl';           
    $mail->Port       = 465;     

//Content
$mail->isHTML(true);  
$mail->CharSet = 'UTF-8';    