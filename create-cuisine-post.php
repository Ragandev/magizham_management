<?php 
    
    require('db.php');
    
    if (isset($_POST)) {
        // User Data 
        $cuisinename = $_POST['cuisinename'];
        $status = $_POST['status'];

    
        // Duplicate username check
        $checkDuplicateQuery = "SELECT COUNT(*) FROM cuisine WHERE cuisinename = :cuisinename";
        $checkStmt = $pdo->prepare($checkDuplicateQuery);
        $checkStmt->bindParam(':cuisinename', $cuisinename);
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
    
        $sql = "INSERT INTO cuisine ( cuisinename, status) VALUES ( :cuisinename, :status)";
        $stmt = $pdo->prepare($sql);
    
        $stmt->bindParam(':cuisinename', $cuisinename,);
        $stmt->bindParam(':status', $status,);

        
        if (!$stmt->execute()) {
            echo "category not created";
        } else {
            echo "category Created successfully.";
        }
    }
?>
