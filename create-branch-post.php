<?php 
    
    require('db.php');
    
    if (isset($_POST)) {
        // User Data 
        $branch = $_POST['branch'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
    
        // Duplicate username check
        $checkDuplicateQuery = "SELECT COUNT(*) FROM branch WHERE branch = :branch";
        $checkStmt = $pdo->prepare($checkDuplicateQuery);
        $checkStmt->bindParam(':branch', $branch);
        $checkStmt->execute();
        $duplicateCount = $checkStmt->fetchColumn();
    
        if ($duplicateCount > 0) {
            echo "Error: Branch ID already exists.";
            exit();
        }
    
        // Validation
        if ( empty($branch)  || empty($address) || empty($phone)) {
            echo "Error: All fields are required.";
            exit();
        }
    
        $sql = "INSERT INTO branch (branch, address, phone) VALUES ( :branch, :address, :phone)";
        $stmt = $pdo->prepare($sql);
    
        $stmt->bindParam(':branch', $branch);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':phone', $phone);
        
        if (!$stmt->execute()) {
            echo "branch not created";
        } else {
            echo "branch Created successfully.";
        }
    }
?>
