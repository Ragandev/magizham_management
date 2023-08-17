<?php 
    
    require('db.php');
    
    if (isset($_POST)) {
        $u1 =  "types.php?succ=";
        $u2 = "create-type.php?err=";
        // User Data 
        $typename = $_POST['typename'];
        $status = $_POST['status'];

    
        // Duplicate username check
        $checkDuplicateQuery = "SELECT COUNT(*) FROM type WHERE name = :name";
        $checkStmt = $pdo->prepare($checkDuplicateQuery);
        $checkStmt->bindParam(':name', $typename);
        $checkStmt->execute();
        $duplicateCount = $checkStmt->fetchColumn();
    
        if ($duplicateCount > 0) {
            header("Location: " . $u2 . urlencode('Branch already taken'));         
            exit();
        }
    
        // Validation
        if ( empty($status) || empty($typename) ) {
            header("Location: " . $u2 . urlencode('All fields must be filled'));           
            exit();
        }
    
        $sql = "INSERT INTO type ( name, status) VALUES ( :name, :status)";
        $stmt = $pdo->prepare($sql);
    
        $stmt->bindParam(':name', $typename,);
        $stmt->bindParam(':status', $status,);

        
        if (!$stmt->execute()) {
            header("Location: " . $u2 . urlencode('Something Wrong please try again later'));
        } else {
            header("Location: " . $u1 . urlencode('Type Successfully Created'));
        }
    }
?>
