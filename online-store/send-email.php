<?php


$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$email = $_POST["email"];
$street = $_POST["street"];
$house_no = $_POST["house_no"];
$flat_no = $_POST["flat_no"];
$zip_code = $_POST["zip_code"];
$city = $_POST["city"];

$subject = "Twoje zamówienie";

$message = "";
// $message = .;

$message .= 
    "Zamówienie zostanie wysłane na adres: ".$street." ";



$message .= $street;
$message .= $house_no;
$message .= $flat_no;
$message .= $zip_code;
$message .= $city;

require "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;


// my own values
$mail->Username = "example@gmail.com";
$mail->Password = "example";

$mail->setFrom("example@gmail.com", "Art Store");
$mail->addAddress($email);

$mail->Subject = $subject;
$mail->Body = $message;

$mail->send();

header("Location: sent.html");

