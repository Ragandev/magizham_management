<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
require('db.php');

if (isset($_GET['delete_id'])) {
    $cuisineID = $_GET['delete_id'];

    // Delete the cuisine from the database
    $deleteSql = "DELETE FROM cuisine WHERE id = :id";
    $stmt = $pdo->prepare($deleteSql);
    $stmt->bindParam(':id', $cuisineID);

    if ($stmt->execute()) {
        header("Location: cuisines.php?succ=" . urlencode('Cuisine Successfully Deleted'));
    } else {
        header("Location: cuisines.php?err=" . urlencode('Something went wrong. Please try again later'));
    }
} else {
    header("Location: cuisines.php");
    exit();
}
?>
