<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
session_start();

$email_to = $_POST['email'];
$_SESSION['login_email'] = $email_to;

include('connect.php');

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$email_to = $_POST['email'];

$check = "SELECT * FROM users WHERE email = '$email_to'";
$result = $conn->query($check);

if ($result->num_rows == 0) {
    echo "This email is not registered. Please sign up first.";
    $conn->close();
    exit();
}

$otp = rand(100000,999999);
$_SESSION['otp'] = $otp;

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'chatrix2007@gmail.com';
    $mail->Password   = 'ftpk ytty xtap phqm';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    $mail->setFrom('chatrix2007@gmail.com', 'Chatrix OTP System');
    $mail->addAddress($email_to);

    $mail->isHTML(true);
    $mail->Subject = 'Your Chatrix OTP Code';
    $mail->Body    = "Your OTP code is <b>$otp</b>. It is valid for 5 minutes.";

    $mail->send();

    echo "OTP sent successfully to $email_to";
} catch (Exception $e) {
    echo "OTP Sending Failed. Please try again later.";
}

$conn->close();
?>
