<?php
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';

$host = $_GET["host"];
$logine = $_GET["login"];
$passee = $_GET["pass"];
$port = $_GET["port"];
$id = $_GET["id"];
$testmail = $_GET["testmail"];

$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->Host = "$host";
$mail->Port = $port;
$mail->SMTPAuth = true;
$mail->Username = "$logine";
$mail->Password = "$passee";
$mail->setFrom("$logine", "J e r u x");
$mail->addAddress("$testmail");
$mail->Subject = "SMTP $id test";
$mail->Body = "SMTP $id IS WORKING!";
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message sent!';
}
?>