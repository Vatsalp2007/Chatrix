<?php
session_start();

// Remove session variables
session_unset();

// Destroy the session
session_destroy();

// Delete the cookie
setcookie('login_email', '', time() - 3600, "/"); 

// Redirect to login page
header('Location: index.php');
exit();
?>
