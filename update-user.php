<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
require('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userID = $_POST['userID'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $branch = $_POST['branch'];
    $role = $_POST['role'];

    // Update user data in the database
    $updateSql = "UPDATE user SET name = :name, username = :username, branch = :branch, role = :role WHERE id = :id";
    $stmt = $pdo->prepare($updateSql);
    $stmt->bindParam(':id', $userID);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':branch', $branch);
    $stmt->bindParam(':role', $role);

    if ($stmt->execute()) {
        header("Location: users.php?succ=User Successfully Updated");
    } else {
        header("Location: edit-user.php?id=$userID&err=Something went wrong. Please try again later");
    }
}
?>
