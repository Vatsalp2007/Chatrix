<?php
session_start();
 include('connect.php');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$current_uid = $_SESSION['uid'];
$friendship_id = mysqli_real_escape_string($conn, $_POST['friendship_id']);
$message_text = mysqli_real_escape_string($conn, $_POST['message_text']);


$check_sql = "SELECT * FROM friends WHERE friendship_id='$friendship_id' AND (user_uid='$current_uid' OR friend_uid='$current_uid')";
$check_result = $conn->query($check_sql);

if ($check_result->num_rows > 0) {
    // Insert message
    $sql = "INSERT INTO messages (friendship_id, sender_uid, message_text) VALUES ('$friendship_id', '$current_uid', '$message_text')";

    if ($conn->query($sql) === TRUE) {
        echo "Message sent.";
    } else {
        echo "Error sending message: " . $conn->error;
    }
} else {
    echo "Access denied.";
}

$conn->close();
?>