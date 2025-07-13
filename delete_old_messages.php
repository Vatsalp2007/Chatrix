<?php
include('connect.php');

$sql = "DELETE FROM messages WHERE created_at < NOW() - INTERVAL 1 DAY";

if ($conn->query($sql) === TRUE) {
    echo "Old messages deleted successfully.";
} else {
    echo "Error deleting old messages: " . $conn->error;
}

$conn->close();
?>
