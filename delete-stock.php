<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
require('db.php');

if (isset($_GET['delete_id'])) {
    $stockID = $_GET['delete_id'];

    // Delete the stock from the database
    $deleteSql = "DELETE FROM `stock` WHERE id = :id";
    $stmt = $pdo->prepare($deleteSql);
    $stmt->bindParam(':id', $stockID);

    if ($stmt->execute()) {
        header("Location: stocks.php?succ=" . urlencode('Stock Successfully Deleted'));
    } else {
        header("Location: stocks.php?err=" . urlencode('Something went wrong. Please try again later'));
    }
} else {
    header("Location: stocks.php");
    exit();
}
?>
