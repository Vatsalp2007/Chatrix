<?php
session_start();
include('connect.php');

$current_uid = $_SESSION['uid'];
$group_id = $_POST['group_id'];

$sql = "SELECT gm.*, u.name FROM group_messages gm JOIN users u ON gm.sender_uid = u.uid WHERE gm.group_id='$group_id' ORDER BY gm.timestamp ASC";
$result = $conn->query($sql);

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $sender_name = $row['name'];
        $message = $row['message'];
        $time = date("H:i", strtotime($row['timestamp']));
        echo "<p><b>$sender_name:</b> $message <span style='font-size:10px;'>($time)</span></p>";
    }
} else {
    echo "<p>No messages yet.</p>";
}

$conn->close();
?>