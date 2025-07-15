<?php
session_start();
include('connect.php');

if ($conn->connect_error) {
    echo "Connection failed:" . "$conn->connect_error";
}

$email = mysqli_real_escape_string($conn, $_POST['email']);
$name = mysqli_real_escape_string($conn, $_POST['name']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$entered_otp = $_POST['otp'];

if($entered_otp != $_SESSION['signup_otp']){
    echo "Invalid OTP. Please try again.";
    exit();
}

$check = "SELECT * FROM users WHERE email = '$email'";
$result = $conn->query($check);

if ($result->num_rows > 0) {
    echo "This email is already registered.";
}

else {
    $uid = mt_rand(100000,999999);

    $insert = "INSERT INTO users(name, email, password, uid) VALUES ('$name', '$email', '$password', '$uid')";
    if ($conn->query($insert) === TRUE) {
        echo "Signup successful!";
    } else {
        echo "Database error. Please try again.";
    }
}

$conn->close();
?>
