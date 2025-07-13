            <?php
            session_start();
            $conn = new mysqli('chatrix');
            if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

            $current_uid = $_SESSION['uid'];
            $response = ["has_notifications" => false];

            // Example: Check if any unread messages exist for the current user
            // This assumes you have a way to mark messages as read/unread
            $sql = "SELECT COUNT(*) AS unread_count FROM messages WHERE recipient_uid = '$current_uid' AND is_read = 0";
            $result = $conn->query($sql);
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if ($row['unread_count'] > 0) {
                    $response["has_notifications"] = true;
                    // Optionally fetch a preview of the latest message
                    $latest_msg_sql = "SELECT message_text FROM messages WHERE recipient_uid = '$current_uid' ORDER BY timestamp DESC LIMIT 1";
                    $latest_msg_result = $conn->query($latest_msg_sql);
                    if ($latest_msg_result && $latest_msg_result->num_rows > 0) {
                        $response["message_preview"] = $latest_msg_result->fetch_assoc()['message_text'];
                    }
                }
            }
            echo json_encode($response);
            $conn->close();
            ?>
            
