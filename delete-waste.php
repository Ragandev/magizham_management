<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
require('db.php');

if (isset($_GET['delete_id'])) {
    $wasteID = $_GET['delete_id'];

    // Delete the waste entry from the database
    $deleteSql = "DELETE FROM `waste` WHERE id = :id";
    $stmt = $pdo->prepare($deleteSql);
    $stmt->bindParam(':id', $wasteID);

    if ($stmt->execute()) {
        header("Location: wastes.php?succ=" . urlencode('Waste Successfully Deleted'));
    } else {
        header("Location: wastes.php?err=" . urlencode('Something went wrong. Please try again later'));
    }
} else {
    header("Location: wastes.php");
    exit();
}
?>
