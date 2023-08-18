<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
require('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u1 = "orders.php?succ=";
    $u2 = "edit-order.php?id=" . $_POST['orderID'] . "&err=";

    $orderID = $_POST['orderID'];
    $branchID = $_POST['branch']; // Updated Branch ID
    $orderDate = $_POST['orderdate']; // Updated Order Date
    $deliveryDate = $_POST['deliverydate']; // Updated Delivery Date
    $priority = $_POST['priority']; // Updated Priority
    $status = $_POST['status']; // Updated Status

    // Update data in the order table
    $updateSql = "UPDATE `order` SET branchid = :branchid, orderdate = :orderdate, deliverydate = :deliverydate, priority = :priority, status = :status WHERE id = :id";
    $stmt = $pdo->prepare($updateSql);
    $stmt->bindParam(':id', $orderID);
    $stmt->bindParam(':branchid', $branchID);
    $stmt->bindParam(':orderdate', $orderDate);
    $stmt->bindParam(':deliverydate', $deliveryDate);
    $stmt->bindParam(':priority', $priority);
    $stmt->bindParam(':status', $status);

    if ($stmt->execute()) {
        header("Location: " . $u1 . urlencode('Order Successfully Updated'));
    } else {
        header("Location: " . $u2 . urlencode('Something went wrong. Please try again later'));
    }
}
?>
