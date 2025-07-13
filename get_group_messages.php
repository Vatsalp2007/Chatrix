<?php
session_start();
include('connect.php');

if (isset($_GET['group_id'])) {
    $group_id = $_GET['group_id'];
    $sql = "SELECT gm.*, u.name 
            FROM group_messages gm 
            JOIN users u ON gm.sender_uid = u.uid 
            WHERE gm.group_id = ? ORDER BY gm.timestamp ASC";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $group_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $messages = [];
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }

    echo json_encode($messages);

    $stmt->close();
}

$conn->close();
?>
