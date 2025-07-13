<?php
session_start();
include('connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and sanitize inputs
    if (isset($_POST['group_id'], $_POST['message']) && !empty($_POST['group_id']) && !empty(trim($_POST['message']))) {
        $group_id = (int) $_POST['group_id'];  // cast to int
        $message = trim($_POST['message']);
        $sender_uid = (int) $_SESSION['uid']; // cast to int

        $stmt = $conn->prepare("INSERT INTO group_messages (group_id, sender_uid, message) VALUES (?, ?, ?)");
        if ($stmt === false) {
            echo "Prepare failed: " . $conn->error;
            exit;
        }

        $stmt->bind_param("iis", $group_id, $sender_uid, $message);
        if ($stmt->execute()) {
            echo "success";
        } else {
            echo "Execute failed: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Missing group_id or message";
    }
} else {
    echo "Invalid request method";
}

$conn->close();
?>
