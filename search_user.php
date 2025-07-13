<?php
include('connect.php');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$uid = mysqli_real_escape_string($conn, $_POST['uid']);
$query = "SELECT name FROM users WHERE uid = '$uid'";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<style>
            @media (max-width: 800px) {
                .add-friend-btn i {
                    font-size: 4vw !important;
                }
            }
          </style>";
    echo "<table border=1 cellspacing=0 style='width:90%;margin-left:5%;margin-bottom:5%;'>";
    echo "<tr style='color:#eee;height:5vh;border-bottom:2px solid #eee;'><th>UID<th>Name<th>ADD";
    echo "<tr style='color:#eee;height:5vh;border-bottom:2px solid #eee;'><th>".$uid. "</th>";
    echo "<th>".$row['name']. "</th>";
    echo "  <th>
            <button class='add-friend-btn' onclick=\"addFriend('$uid')\" style='border:none;background-color:transparent;cursor:pointer;'>
                <i style='color:#fff;font-size:1.2vw;' class='fa fa-user-plus' aria-hidden='true'></i>
            </button>
        </th>";
} else {
    echo "No user found with this UID.";
}
$conn->close();
?>
