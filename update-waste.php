<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
require('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u1 = "wastes.php?succ=";
    $u2 = "edit-waste.php?id=" . $_POST['id'] . "&err=";

    $wasteID = $_POST['id'];
    $branch = $_POST['branch'];
    $date = $_POST['date'];
    $wasteQty = $_POST['waste_qty'];
    $wasteAmount = $_POST['waste_amount'];

    // Update data in waste table
    $updateSql = "UPDATE `waste` SET branchid = :branchid, date = :date, waste_qty = :waste_qty, waste_amount = :waste_amount WHERE id = :id";
    $stmt = $pdo->prepare($updateSql);
    $stmt->bindParam(':id', $wasteID);
    $stmt->bindParam(':branchid', $branch);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':waste_qty', $wasteQty);
    $stmt->bindParam(':waste_amount', $wasteAmount);

    if ($stmt->execute()) {
        header("Location: " . $u1 . urlencode('Waste Successfully Updated'));
    } else {
        header("Location: " . $u2 . urlencode('Something went wrong. Please try again later'));
    }
}
?>
