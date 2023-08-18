<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
require('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $typeID = $_POST['typeID'];
    $typeName = $_POST['type'];
    $status = $_POST['status']; // Updated Status

    // Update data in type table
    $updateSql = "UPDATE type SET name = :name, status = :status WHERE id = :id";
    $stmt = $pdo->prepare($updateSql);
    $stmt->bindParam(':id', $typeID);
    $stmt->bindParam(':name', $typeName);
    $stmt->bindParam(':status', $status);

    if ($stmt->execute()) {
        header("Location: types.php?succ=" . urlencode('Type Successfully Updated'));
    } else {
        header("Location: edit-type.php?id=" . $typeID . "&err=" . urlencode('Something went wrong. Please try again later'));
    }
}
?>
