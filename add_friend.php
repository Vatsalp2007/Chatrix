<?php
session_start();

 include('connect.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$current_uid = $_SESSION['uid'];
$friend_uid = mysqli_real_escape_string($conn, $_POST['friend_uid']);

// Prevent adding self as friend
if ($current_uid == $friend_uid) {
    echo "You cannot add yourself.";
    exit();
}

// Generate a unique friendship_id (e.g. FR-uid1uid2-random4digit)
$friendship_id = "FR-" . $current_uid . $friend_uid . "-" . rand(1000,9999);

// Check if already friends (either direction)
$check = "SELECT * FROM friends WHERE (user_uid='$current_uid' AND friend_uid='$friend_uid') OR (user_uid='$friend_uid' AND friend_uid='$current_uid')";
$result = $conn->query($check);

if ($result->num_rows > 0) {
    echo "Already added as friend.";
} else {
    // Insert both directions with same friendship_id
    $sql1 = "INSERT INTO friends (user_uid, friend_uid, friendship_id) VALUES ('$current_uid', '$friend_uid', '$friendship_id')";
    $sql2 = "INSERT INTO friends (user_uid, friend_uid, friendship_id) VALUES ('$friend_uid', '$current_uid', '$friendship_id')";
    
    if ($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE) {
        echo "Friend added successfully with ID: $friendship_id";
    } else {
        echo "Error adding friend: " . $conn->error;
    }
}

// Existing code to fetch all chat users / friends
$sql = "SELECT * FROM users WHERE uid != '$login_uid'";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()){
    $sender_uid = $row['uid'];
    $sender_name = $row['name'];

    // Step 3 code: check for unread messages from this sender
    $unread_check = "SELECT * FROM messages WHERE sender_uid = '$sender_uid' AND receiver_uid = '$login_uid' AND read_status = 0";
    $unread_result = $conn->query($unread_check);

    if($unread_result->num_rows > 0){
        // Show colored dot
        echo "<div class='chat_user'>$sender_name <span class='new_dot'></span></div>";
    } else {
        // Show normally
        echo "<div class='chat_user'>$sender_name</div>";
    }
}


$conn->close();
?>
