<?php
session_start();

 include('connect.php');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$current_uid = $_SESSION['uid'];
$friendship_id = mysqli_real_escape_string($conn, $_GET['friendship_id']);

$check_sql = "SELECT * FROM friends WHERE friendship_id='$friendship_id' AND (user_uid='$current_uid' OR friend_uid='$current_uid')";
$check_result = $conn->query($check_sql);

if ($check_result->num_rows > 0) {
    // Fetch messages
    $sql = "SELECT * FROM messages WHERE friendship_id='$friendship_id' ORDER BY timestamp ASC";
    $result = $conn->query($sql);

    $messages = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $messages[] = $row;
        }
    }

    echo json_encode($messages);
} else {
    echo json_encode(["error" => "Access denied"]);
}

$conn->close();
?>
