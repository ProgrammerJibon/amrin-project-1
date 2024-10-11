<?php
require_once "./config.php"; // Include the database connection and session logic

// If the user is logged in, destroy the session
if (isset($user_info['id'])) {
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();
}

// Redirect to the login page
header("Location: login.php");
exit();
