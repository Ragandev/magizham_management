<?php
// Start or resume the session
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect the user to a logged-out page or login page
    header("Location: index.php");
    exit();
} else {
    // If the user is not logged in, redirect them to the login page
    header("Location: index.php");
    exit();
}
?>
