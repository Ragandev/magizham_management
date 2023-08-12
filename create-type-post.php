<?php 
    
    require('db.php');
    
    if (isset($_POST)) {
        // User Data 
        $typename = $_POST['typename'];
        $status = $_POST['status'];

    
        // Duplicate username check
        $checkDuplicateQuery = "SELECT COUNT(*) FROM type WHERE typename = :typename";
        $checkStmt = $pdo->prepare($checkDuplicateQuery);
        $checkStmt->bindParam(':typename', $typename);
        $checkStmt->execute();
        $duplicateCount = $checkStmt->fetchColumn();
    
        if ($duplicateCount > 0) {
            echo "Error: Type ID already exists.";
            exit();
        }
    
        // Validation
        if ( empty($status) || empty($typename) ) {
            echo "Error: All fields are required.";
            exit();
        }
    
        $sql = "INSERT INTO type ( typename, status) VALUES ( :typename, :status)";
        $stmt = $pdo->prepare($sql);
    
        $stmt->bindParam(':typename', $typename,);
        $stmt->bindParam(':status', $status,);

        
        if (!$stmt->execute()) {
            echo "type not created";
        } else {
            echo "type Created successfully.";
        }
    }
?>