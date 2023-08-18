<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
require('db.php');

if (isset($_GET['delete_id'])) {
    $branchID = $_GET['delete_id'];

    // Delete the branch from the database
    $deleteSql = "DELETE FROM branch WHERE id = :id";
    $stmt = $pdo->prepare($deleteSql);
    $stmt->bindParam(':id', $branchID);

    if ($stmt->execute()) {
        header("Location: branchs.php?succ=" . urlencode('Branch Successfully Deleted'));
    } else {
        header("Location: branchs.php?err=" . urlencode('Something went wrong. Please try again later'));
    }
} else {
    header("Location: branchs.php");
    exit();
}
?>
