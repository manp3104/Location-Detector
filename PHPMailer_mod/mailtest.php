




<?php

// auto amte as per client signup details.

require 'PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();           //not necessary                           // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'kendotechnologies@gmail.com';                 // SMTP username
$mail->Password = 'devendra990';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587; // 586 is used if some problem occurs ; 476 port for ssl.                                   // TCP port to connect to

$mail->setFrom('kendotechnologies@gmail.com', 'Kendo_ Group');
$mail->addAddress('azumuthaldev@gmail.com', 'gmail_user');     // Add a recipient
$mail->addAddress('azumuthaldev@gmail.com');               // Name is optional
$mail->addReplyTo('kendotechnologies@gmail.com', 'Kendo');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'test for mail';
$mail->Body    = '<b>in bold!</b><img src="http://thesis.tcdhalls.com/images/thesis-statement-informative-speech.jpg">image shown';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}