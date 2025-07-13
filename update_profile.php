<?php
session_start();
include('connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uid = $_SESSION['uid'];

    $new_name = isset($_POST['new_name']) ? trim($_POST['new_name']) : '';
    $mobile   = isset($_POST['mobile']) ? trim($_POST['mobile']) : '';
    $gender   = isset($_POST['gender']) ? trim($_POST['gender']) : '';
    $bio      = isset($_POST['bio']) ? trim($_POST['bio']) : '';

    $stmt = $conn->prepare(
        "UPDATE users SET name = ?, mobile = ?, gender = ?, bio = ? WHERE uid = ?"
    );
    $stmt->bind_param("ssssi", $new_name, $mobile, $gender, $bio, $uid);

    if ($stmt->execute()) {
        echo "Profile updated successfully!";
    } else {
        echo "Failed to update profile.";
    }

    $stmt->close();
    $conn->close();
}
?>
