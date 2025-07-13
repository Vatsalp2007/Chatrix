<?php
session_start();
include('connect.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$current_uid = $_SESSION['uid'];
$group_name = mysqli_real_escape_string($conn, $_POST['group_name']);
$member_ids = $_POST['members']; // array of member uids

if (empty($group_name) || empty($member_ids)) {
    echo "Group name and members are required.";
    exit();
}

// Generate unique group_id e.g. GR-uid-random4digits
$group_id = "GR-" . $current_uid . "-" . rand(1000,9999);

// Insert creator as member first
$sql = "INSERT INTO group_members (group_id, group_name, creator_uid, member_uid) VALUES ('$group_id', '$group_name', '$current_uid', '$current_uid')";
$conn->query($sql);

// Insert selected members
foreach($member_ids as $member_uid) {
    $member_uid = mysqli_real_escape_string($conn, $member_uid);
    $sql = "INSERT INTO group_members (group_id, group_name, creator_uid, member_uid) VALUES ('$group_id', '$group_name', '$current_uid', '$member_uid')";
    $conn->query($sql);
}

echo "Group created successfully with ID: $group_id";

$conn->close();
?>
