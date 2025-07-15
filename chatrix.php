<?php 
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// If session email not set but cookie exists, restore session from cookie
if (!isset($_SESSION['login_email']) && isset($_COOKIE['login_email'])) {
    $_SESSION['login_email'] = $_COOKIE['login_email'];
}

if (!isset($_SESSION['login_email'])) {
    // Redirect to login page if neither session nor cookie exists
    header('Location: index.php');
    exit();
}

include('connect.php');
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$email_to = $_SESSION['login_email'];

$sql = "SELECT uid FROM users WHERE email='$email_to'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $uid = $row['uid'];
    $_SESSION['uid'] = $uid;
} else {
    $uid = "UID not found";
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Chatrix</title>
  <link rel="stylesheet" href="chatrix.css?v=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="icon" type="image/png" href="logo_small.png">
</head>
<body>
  <nav>
    <h2>Chatrix </h2>
  </nav>

  <div class="main_container">
    <!-- ---------------------------members part ---------------------------- -->
    <div class="members">

      <div class="top_div">
        <button class="profile_btn2">Profile <i class="fa fa-user" aria-hidden="true"></i></button>
        <br><h2>Chats</h2>
        <button class="search_a"><i class="fa fa-user-plus" aria-hidden="true"></i></button><br>
      </div>

      <div class="mid_div">

  <p><?php echo "Your UID: $uid"; ?></p><br>
  <hr>

  <!-- ✅ Friends -->
  <?php 
    include('connect.php');
    $current_uid = $_SESSION['uid'];

    $sql = "SELECT friends.friendship_id, users.name 
            FROM friends 
            JOIN users ON friends.friend_uid = users.uid 
            WHERE friends.user_uid = '$current_uid'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h3 style='color:white;'>Friends</h3>";
        while($row = $result->fetch_assoc()) {
          $friendship_id = $row['friendship_id'];
          $friend_name = $row['name'];
          echo "<style>
                      @media (max-width: 800px) {
                        tr {
                          font-size: 4.5vw !important;
                          height:5vh;
                          margin-bottom:2%;
                        }
                      }
                      </style>";
          echo "<table border=0 class='table_sty'>
                  <tr class='member_tr' onclick=\"showChatBox('$friendship_id','$friend_name')\">
                    <th>$friend_name</th>
                  </tr>
                </table>";  
        }
    } else {
        echo "<p> </p>";
    } 
  ?>

<?php 
  include('connect.php');
  $current_uid = $_SESSION['uid'];

  // Fetch groups where current user is a member
  $sql = "SELECT DISTINCT group_id, group_name 
          FROM group_members 
          WHERE member_uid = '$current_uid'";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      echo "<h3 style='color:white;'>Groups</h3>";
      while($row = $result->fetch_assoc()) {
        $group_id = $row['group_id'];
        $group_name = $row['group_name'];

        echo "<style>
              @media (max-width: 800px) {
                tr {
                  font-size: 4.5vw !important;
                  height:5vh;
                }
              }
              </style>";

        echo "<table border=0 class='table_sty'>";
        echo "<tr class='member_tr' onclick=\"showGroupChatBox('$group_id','$group_name')\"><th>".$group_name."</th></tr></table>";  
      }
  } else {
      echo "<p> </p>";
  }

  $conn->close();
?>

</div>

      <div class="bottom_div">
        <button class="profile_btn">Profile <i class="fa fa-user" aria-hidden="true"></i></button>
      </div>
      
    </div>

    <!-- ---------------------chat part ------------------------ -->
    <div class="chat">
      <h1 id="welcome_text">Welcome to Chatrix - connect with anyone, anytime.</h1>

      <?php 
        // Render empty chat boxes for each friend
        include('connect.php');
        $current_uid = $_SESSION['uid'];

        $sql = "SELECT friends.friendship_id, users.name 
                FROM friends 
                JOIN users ON friends.friend_uid = users.uid 
                WHERE friends.user_uid = '$current_uid'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              $friendship_id = $row['friendship_id'];
              $friend_name = $row['name'];
              echo "<div class='chat_box' id='chat_box_$friendship_id' style='display:none;'>
        <div class='chat_header'>
          <h2 class='friend_name'>$friend_name</h2>
          <button class='chat_back_btn' onclick='hideChatBox()' title='Back' style='float:left; margin-top:2.5%;margin-left:3%; font-size: 1.5rem; background: transparent; border: none; color: white; cursor: pointer;'>
            <i class='fa fa-arrow-left'></i>
          </button>
        </div>
        <hr style='margin-top:5vh;'>
        <div class='messages' id='messages_$friendship_id'></div>
        <textarea class='input_msg' id='input_$friendship_id' placeholder='Type your message...' rows='2' style='width:70%; resize:none;'></textarea>
        <button class='send_msg' onclick='sendMessage(\"$friendship_id\")'><i class='fa fa-paper-plane' aria-hidden='true'></i></button>
      </div>";

        }
        }

        $conn->close();
      ?>

      <?php 
include('connect.php');
$current_uid = $_SESSION['uid'];

// Fetch groups where current user is a member
$sql = "SELECT DISTINCT group_id, group_name 
        FROM group_members 
        WHERE member_uid = '$current_uid'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $group_id = $row['group_id'];
      $group_name = $row['group_name'];

      echo "<div class='chat_box group_chat_box' id='group_chat_box_$group_id' style='display:none;'>
  <div class='chat_header'>
    <h2 class='friend_name'>$group_name</h2>
    <button class='chat_back_btn3' onclick='hideChatBox()' title='Back' style='float:left; margin-top:2.5%;margin-left:3%; font-size: 1.5rem; background: transparent; border: none; color: white; cursor: pointer;'>
      <i class='fa fa-arrow-left'></i>
    </button>
  </div>
  <hr style='margin-top:5vh;'>
  <div class='messages' id='group_messages_$group_id'></div>
  <textarea class='input_msg' id='group_input_$group_id' placeholder='Type your message...' rows='2' style='width:70%; resize:none;'></textarea>
  <button class='send_msg' onclick='sendGroupMessage(\"$group_id\")'><i class='fa fa-paper-plane' aria-hidden='true'></i></button>
</div>";
    }
}
$conn->close();
?>

    </div>

    <div class="search_main">
      <button class="back1"><i class="fa fa-arrow-left" aria-hidden="true"></i></button>
      <input type="text" placeholder="Search UID" class="search_box" id="search_box">
      <button class="search_btn" id="search_btn"><i class="fa fa-search" aria-hidden="true"></i></button>
      <hr>
      <button onclick="showCreateGroup()" class="group_btn">Create Group</button>
        <center>
                <!-- Create Group Modal -->
<div id="create_group_modal" class="create_group_modal">
  <h3>Create New Group</h3>
  <hr style="width:50%;">
  <input type="text" id="group_name" placeholder="Group Name" class="group_name_in">
  <p>Select Members:</p>
  <div id="member_list">
    <?php
      include('connect.php');
      $current_uid = $_SESSION['uid'];

      $sql = "
        SELECT u.uid, u.name 
        FROM friends f
        JOIN users u ON f.friend_uid = u.uid
        WHERE f.user_uid = '$current_uid'
        
        UNION

        SELECT u.uid, u.name
        FROM friends f
        JOIN users u ON f.user_uid = u.uid
        WHERE f.friend_uid = '$current_uid'
      ";

      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          echo "<p style='width:80%;background-color:#252525;border-radius:5px;'><input type='checkbox' value='".$row['uid']."'> ".$row['name']."<br></p>";
        }
      } else {
        echo "<p>No friends found to add.</p>";
      }

      $conn->close();
    ?>
  </div>
  <button onclick="createGroup()" class="create_gp">Create</button>
  <button onclick="hideCreateGroup()" class="create_gp">Cancel</button>
</div>

        </center>
      <div id="search_result" style="color:white; margin-left:10px; margin-top:10px;"></div>
    </div>



    <!-- ===========================Profile Section======================== -->

<div class="profile">
  <button class="back2"><i class="fa fa-arrow-left" aria-hidden="true"></i></button>
  <center>
    <div class="profile_dp"></div><br>
    <?php
include('connect.php');

$email_to = $_SESSION['login_email'];

$sql = "SELECT name, mobile, gender, bio, theme FROM users WHERE email='$email_to'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_name = !empty($row['name']) ? $row['name'] : "";
    $mobile = !empty($row['mobile']) ? $row['mobile'] : "";
    $gender = !empty($row['gender']) ? $row['gender'] : "";
    $bio = !empty($row['bio']) ? $row['bio'] : "";
    $theme = !empty($row['theme']) ? trim($row['theme']) : "default";
} else {
    $user_name = $mobile = $gender = $bio = "";
    $theme = "default";
}

$conn->close();
?>

    <p style="color:#eee;">Your UID: <?php echo $uid; ?></p><br>
  <hr style="width:50% ;">
    <!-- Name -->
    <input type="text" id="username_input" value="<?php echo htmlspecialchars($user_name); ?>" placeholder="Name" style="padding:10px; font-size:1rem;"><br><br>

    <!-- Mobile -->
    <input type="text" id="mobile_input" value="<?php echo htmlspecialchars($mobile); ?>" placeholder="Mobile Number" style="padding:10px; font-size:1rem;"><br><br>

    <!-- Gender -->
    <select id="gender_input" style="padding:10px; font-size:1rem;">
      <option id="op_gender" value="">Select Gender</option>
      <option id="op_gender" value="Male" <?php if($gender=="Male") echo "selected"; ?>>Male</option>
      <option id="op_gender" value="Female" <?php if($gender=="Female") echo "selected"; ?>>Female</option>
      <option id="op_gender" value="Other" <?php if($gender=="Other") echo "selected"; ?>>Other</option>
    </select><br><br>

    <!-- Bio -->
    <textarea id="bio_input" placeholder="Bio" style="padding:10px; font-size:1re m;"><?php echo htmlspecialchars($bio); ?></textarea><br><br>

    <!-- Theme -->
    <p style="color:#eee;">Theme: <br>
      <input type="radio" name="theme" value="default"> Default 
      <input type="radio" name="theme" value="dark"> Dark
      <input type="radio" name="theme" value="extra-dark"> Extra Dark
    </p>


    <br><br>
    
    <!-- Update button -->
    
    <button id="update_profile_btn" style="padding:10px 20px; font-size:1rem;">Update Profile</button>
    <p id="update_status" style="color:lightgreen;"></p>
    
    <a href="logout.php" ><button class="log_out_btn2">Log Out <i class="fa fa-sign-out" aria-hidden="true"></i></button></a> <br><br>
    
  </center>
</div>

  </div>
  <script>
  const savedTheme = "<?php echo isset($theme) ? $theme : 'default'; ?>";
</script>
<script src='script.js'></script>
<script>
const current_user_uid = "<?php echo $_SESSION['uid']; ?>";
</script>

</body>
</html>
