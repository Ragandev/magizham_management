<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
require('db.php');

if (isset($_GET['delete_id'])) {
    $typeID = $_GET['delete_id'];

    // Delete the type from the database
    $deleteSql = "DELETE FROM type WHERE id = :id";
    $stmt = $pdo->prepare($deleteSql);
    $stmt->bindParam(':id', $typeID);

    if ($stmt->execute()) {
        header("Location: types.php?succ=" . urlencode('Type Successfully Deleted'));
    } else {
        header("Location: types.php?err=" . urlencode('Something went wrong. Please try again later'));
    }
} else {
    header("Location: types.php");
    exit();
}
?>
