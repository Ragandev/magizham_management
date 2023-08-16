<?php 
    
    require('db.php');
    
    if (isset($_POST)) {
        // User Data 
        $cuisinename = $_POST['cuisinename'];
        $status = $_POST['status'];

    
        // Duplicate username check
        $checkDuplicateQuery = "SELECT COUNT(*) FROM cuisine WHERE name = :name";
        $checkStmt = $pdo->prepare($checkDuplicateQuery);
        $checkStmt->bindParam(':name', $cuisinename);
        $checkStmt->execute();
        $duplicateCount = $checkStmt->fetchColumn();
    
        if ($duplicateCount > 0) {
            echo "Error: cuisine ID already exists.";
            exit();
        }
    
        // Validation
        if ( empty($status) || empty($cuisinename) ) {
            echo "Error: All fields are required.";
            exit();
        }
    
        $sql = "INSERT INTO cuisine ( name, status) VALUES ( :name, :status)";
        $stmt = $pdo->prepare($sql);
    
        $stmt->bindParam(':name', $cuisinename,);
        $stmt->bindParam(':status', $status,);

        
        if (!$stmt->execute()) {
            echo "cuisine not created";
        } else {
            echo "cuisine Created successfully.";
        }
    }
?>
