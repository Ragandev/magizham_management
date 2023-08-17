<?php 
    
    require('db.php');
    
    if (isset($_POST)) {
        $u1 =  "branchs.php?succ=";
        $u2 = "create-branch.php?err=";
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
            header("Location: " . $u2 . urlencode('Branch already taken'));         
            exit();
        }
    
        // Validation
        if ( empty($branch)  || empty($address) || empty($phone)) {
            header("Location: " . $u2 . urlencode('All fields must be filled'));           

            exit();
        }
    
        $sql = "INSERT INTO branch (name, address, phone, status) VALUES ( :name, :address, :phone, :status)";
        $stmt = $pdo->prepare($sql);
    
        $stmt->bindParam(':name', $branch);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':status', $status);

        
         
        if (!$stmt->execute()) {
            header("Location: " . $u2 . urlencode('Something Wrong please try again later'));
            exit();
        } else {
            header("Location: " . $u1 . urlencode('Branch Successfully Created'));
            exit();      
          }
    }
?>
