<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
require('db.php');

if (isset($_GET['delete_id'])) {
    $userID = $_GET['delete_id'];

    // Delete the user from the database
    $deleteSql = "DELETE FROM user WHERE id = :id";
    $stmt = $pdo->prepare($deleteSql);
    $stmt->bindParam(':id', $userID);

    if ($stmt->execute()) {
        header("Location: users.php?succ=" . urlencode('User Successfully Deleted'));
    } else {
        header("Location: users.php?err=" . urlencode('Something went wrong. Please try again later'));
    }
} else {
    header("Location: users.php");
    exit();
}
?>
