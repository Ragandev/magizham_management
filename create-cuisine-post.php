<?php 
    
    require('db.php');
    
    if (isset($_POST)) {
        $u1 =  "cuisines.php?succ=";
        $u2 = "create-cuisine.php?err=";
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
            header("Location: " . $u2 . urlencode('Branch already taken'));         
            exit();
        }
    
        // Validation
        if ( empty($status) || empty($cuisinename) ) {
            header("Location: " . $u2 . urlencode('All fields must be filled'));           
            exit();
        }
    
        $sql = "INSERT INTO cuisine ( name, status) VALUES ( :name, :status)";
        $stmt = $pdo->prepare($sql);
    
        $stmt->bindParam(':name', $cuisinename,);
        $stmt->bindParam(':status', $status,);

        
        if (!$stmt->execute()) {
            header("Location: " . $u2 . urlencode('Something Wrong please try again later'));
        } else {
            header("Location: " . $u1 . urlencode('cuisine Successfully Created'));
        }
    }
?>
