<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
require('db.php');

if (isset($_GET['delete_id'])) {
    $consumptionID = $_GET['delete_id'];

    // Delete the consumption from the database
    $deleteSql = "DELETE FROM `consumption` WHERE id = :id";
    $stmt = $pdo->prepare($deleteSql);
    $stmt->bindParam(':id', $consumptionID);

    if ($stmt->execute()) {
        header("Location: consumptions.php?succ=" . urlencode('consumptionSuccessfully Deleted'));
    } else {
        header("Location: consumptions.php?err=" . urlencode('Something went wrong. Please try again later'));
    }
} else {
    header("Location: consumptions.php");
    exit();
}
?>
