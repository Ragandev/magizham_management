<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
require('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categoryId = $_POST['categoryId'];
    $categoryName = $_POST['category'];
    $status = $_POST['status'];

    // Update data in the category table
    $updateSql = "UPDATE category SET name = :name, status = :status WHERE id = :id";
    $stmt = $pdo->prepare($updateSql);
    $stmt->bindParam(':id', $categoryId);
    $stmt->bindParam(':name', $categoryName);
    $stmt->bindParam(':status', $status);

    if ($stmt->execute()) {
        header("Location: categories.php?succ=" . urlencode('Category Successfully Updated'));
    } else {
        header("Location: edit-category.php?id=" . $categoryId . "&err=" . urlencode('Something went wrong. Please try again later'));
    }
}
?>
