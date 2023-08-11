<?php

    require('db.php');

    if (isset($_POST)) {
        $username = $_POST['username'];
        $pass = $_POST['password'];
        
        $loginQuery = "SELECT * FROM users WHERE username = :username AND password = :password";
        $loginStmt = $pdo->prepare($loginQuery);
        $loginStmt->bindParam(':username', $username);
        $loginStmt->bindParam(':password', $pass);
        $loginStmt->execute();
        
        $user = $loginStmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user) {

            session_start();
            $_SESSION['user'] = $user;

            header("Location: users.php");
            exit();
        } else {
            echo "Login failed. Invalid username or password.";
        }
    }
?>
