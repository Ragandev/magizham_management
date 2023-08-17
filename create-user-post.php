<?php 
    
    require('db.php');
    
    if (isset($_POST)) {
        $u1 =  "users.php?succ=";
        $u2 = "create-user.php?err=";
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
            header("Location: " . $u2 . urlencode('Username already taken'));         
            exit();
        }
    
        // Validation
        if (empty($name) || empty($username) || empty($password) || empty($branch) || empty($role)) {
            header("Location: " . $u2 . urlencode('All fields must be filled'));           
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
            header("Location: " . $u2 . urlencode('Something Wrong please try again later'));
            exit();
        } else {
            header("Location: " . $u1 . urlencode('User Successfully Created'));
            exit();      
          }
    }
?>