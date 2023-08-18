<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
require('db.php');

if (isset($_GET['delete_id'])) {
    $orderID = $_GET['delete_id'];

    // Delete the order from the database
    $deleteSql = "DELETE FROM `order` WHERE id = :id";
    $stmt = $pdo->prepare($deleteSql);
    $stmt->bindParam(':id', $orderID);

    if ($stmt->execute()) {
        header("Location: orders.php?succ=" . urlencode('Order Successfully Deleted'));
        exit();
    } else {
        header("Location: orders.php?err=" . urlencode('Something went wrong. Please try again later'));
        exit();
    }
} else {
    header("Location: orders.php");
    exit();
}
?>
