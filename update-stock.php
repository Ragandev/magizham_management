<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
require('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u1 = "stocks.php?succ=";
    $u2 = "edit-stock.php?id=" . $_POST['id'] . "&err=";

    $stockID = $_POST['id'];
    $branch = $_POST['branch'];
    $date = $_POST['date'];
    $stockQty = $_POST['stock_qty'];

    // Update data in stock table
    $updateSql = "UPDATE `stock` SET branchid = :branchid, date_created = :date_created, stock_qty = :stock_qty WHERE id = :id";
    $stmt = $pdo->prepare($updateSql);
    $stmt->bindParam(':id', $stockID);
    $stmt->bindParam(':branchid', $branch);
    $stmt->bindParam(':date_created', $date);
    $stmt->bindParam(':stock_qty', $stockQty);

    if ($stmt->execute()) {
        header("Location: " . $u1 . urlencode('Stock Successfully Updated'));
    } else {
        header("Location: " . $u2 . urlencode('Something went wrong. Please try again later'));
    }
}
?>
