<?php 
    
    require('db.php');
    
    if (isset($_POST)) {
        // User Data 
        $categoryname = $_POST['categoryname'];
        $status = $_POST['status'];

    
        // Duplicate username check
        $checkDuplicateQuery = "SELECT COUNT(*) FROM category WHERE categoryname = :categoryname";
        $checkStmt = $pdo->prepare($checkDuplicateQuery);
        $checkStmt->bindParam(':categoryname', $categoryname);
        $checkStmt->execute();
        $duplicateCount = $checkStmt->fetchColumn();
    
        if ($duplicateCount > 0) {
            echo "Error: Category ID already exists.";
            exit();
        }
    
        // Validation
        if ( empty($status) || empty($categoryname) ) {
            echo "Error: All fields are required.";
            exit();
        }
    
        $sql = "INSERT INTO category ( categoryname, status) VALUES ( :categoryname, :status)";
        $stmt = $pdo->prepare($sql);
    
        $stmt->bindParam(':categoryname', $categoryname,);
        $stmt->bindParam(':status', $status,);

        
        if (!$stmt->execute()) {
            echo "category not created";
        } else {
            echo "category Created successfully.";
        }
    }
?>
