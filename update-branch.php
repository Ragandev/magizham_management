<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
require('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u1 = "branchs.php?succ=";
    $u2 = "edit-branch.php?id=" . $_POST['branchID'] . "&err=";

    $branchID = $_POST['branchID'];
    $branchName = $_POST['name']; // Updated Branch Name
    $branchAddress = $_POST['address']; // Updated Address
    $branchPhone = $_POST['phone']; // Updated Phone Number
    $branchStatus = $_POST['status']; // Updated Status

    // Update data in branch table
    $updateSql = "UPDATE branch SET name = :name, address = :address, phone = :phone, status = :status WHERE id = :id";
    $stmt = $pdo->prepare($updateSql);
    $stmt->bindParam(':id', $branchID);
    $stmt->bindParam(':name', $branchName);
    $stmt->bindParam(':address', $branchAddress);
    $stmt->bindParam(':phone', $branchPhone);
    $stmt->bindParam(':status', $branchStatus);

    if ($stmt->execute()) {
        header("Location: " . $u1 . urlencode('Branch Successfully Updated'));
    } else {
        header("Location: " . $u2 . urlencode('Something went wrong. Please try again later'));
    }
}
?>
