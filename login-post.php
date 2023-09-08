<?php

    require('db.php');

    if (isset($_POST)) {

        $u1 = "counter.php?succ=";
        $u2 = "counter.php?err=";

        $username = $_POST['username'];
        $pass = $_POST['password'];
        
        $loginQuery = "SELECT * FROM user WHERE username = :username AND password = :password";
        $loginStmt = $pdo->prepare($loginQuery);
        $loginStmt->bindParam(':username', $username);
        $loginStmt->bindParam(':password', $pass);
        $loginStmt->execute();
        
        $user = $loginStmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user) {

            session_start();
            $_SESSION['user'] = $user;

            header("Location: dashboard1.php");
            exit();
        } else {
           header("Location: index.php?err=" . urlencode('Invalid Username or Password'));
        }
    }
?>
