<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
require('db.php');

if (isset($_GET['delete_id'])) {
    $categoryId = $_GET['delete_id'];

    // Delete the category from the database
    $deleteSql = "DELETE FROM category WHERE id = :id";
    $stmt = $pdo->prepare($deleteSql);
    $stmt->bindParam(':id', $categoryId);

    if ($stmt->execute()) {
        header("Location: categories.php?succ=" . urlencode('Category Successfully Deleted'));
    } else {
        header("Location: categories.php?err=" . urlencode('Something went wrong. Please try again later'));
    }
} else {
    header("Location: categories.php");
    exit();
}
?>
