<?php 
    
    require('db.php');
    
    if (isset($_POST)) {
        // User Data 
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $branch = $_POST['branch'];
        $role = $_POST['role'];
    
        // Duplicate username check
        $checkDuplicateQuery = "SELECT COUNT(*) FROM user WHERE username = :username";
        $checkStmt = $pdo->prepare($checkDuplicateQuery);
        $checkStmt->bindParam(':username', $username);
        $checkStmt->execute();
        $duplicateCount = $checkStmt->fetchColumn();
    
        if ($duplicateCount > 0) {
            echo "Error: Username already exists.";
            exit();
        }
    
        // Validation
        if (empty($name) || empty($username) || empty($password) || empty($branch) || empty($role)) {
            echo "Error: All fields are required.";
            exit();
        }
    
        $sql = "INSERT INTO user (name, username, password, branch, role) VALUES (:name, :username, :password, :branch, :role)";
        $stmt = $pdo->prepare($sql);
    
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':branch', $branch);
        $stmt->bindParam(':role', $role);
        
        if (!$stmt->execute()) {
            echo "User not created";
        } else {
            echo "User Created successfully.";
        }
    }
?>