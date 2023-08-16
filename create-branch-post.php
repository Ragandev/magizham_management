<?php 
    
    require('db.php');
    
    if (isset($_POST)) {
        // User Data 
        $branch = $_POST['branch'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $status = $_POST['status'];

    
        // Duplicate username check
        $checkDuplicateQuery = "SELECT COUNT(*) FROM branch WHERE name = :name";
        $checkStmt = $pdo->prepare($checkDuplicateQuery);
        $checkStmt->bindParam(':name', $branch);
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
    
        $sql = "INSERT INTO branch (name, address, phone, status) VALUES ( :name, :address, :phone, :status)";
        $stmt = $pdo->prepare($sql);
    
        $stmt->bindParam(':name', $branch);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':status', $status);

        
        if (!$stmt->execute()) {
            echo "branch not created";
        } else {
            echo "branch Created successfully.";
        }
    }
?>
