<?php
session_start();
include('connect.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = mysqli_real_escape_string($conn, $_POST['email']);
$entered_otp = $_POST['otp_v'];

if($entered_otp != $_SESSION['otp']){
    echo "Invalid OTP. Please try again.";
    exit();
}

$check = "SELECT uid FROM users WHERE email = '$email'";
$result = $conn->query($check);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION['uid'] = $row['uid'];

$_SESSION['login_email'] = $email;

setcookie('login_email', $email, time() + (30 * 24 * 60 * 60), "/");
    echo "success";
}
else {
    echo "No account found with this email.";
}

$conn->close();

?>
