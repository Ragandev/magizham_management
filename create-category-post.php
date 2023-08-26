<?php 
    
    require('db.php');
    
    if (isset($_POST)) {
        $u1 =  "categories.php?succ=";
        $u2 = "create-category.php?err=";
        // User Data 
        $categoryname = $_POST['categoryname'];
        $typeid = $_POST['type'];

        $status = $_POST['status'];

    
        // Duplicate username check
        $checkDuplicateQuery = "SELECT COUNT(*) FROM category WHERE name = :name";
        $checkStmt = $pdo->prepare($checkDuplicateQuery);
        $checkStmt->bindParam(':name', $categoryname);
        $checkStmt->execute();
        $duplicateCount = $checkStmt->fetchColumn();
    
        if ($duplicateCount > 0) {
            header("Location: " . $u2 . urlencode('Branch already taken'));         
            exit();
        }
    
        // Validation
        if ( empty($status) || empty($categoryname) ) {
            header("Location: " . $u2 . urlencode('All fields must be filled'));           
            exit();
        }
    
        $sql = "INSERT INTO category ( name, typeid, status) VALUES ( :name, :typeid, :status)";
        $stmt = $pdo->prepare($sql);
    
        $stmt->bindParam(':name', $categoryname,);
        $stmt->bindParam(':typeid', $typeid);
        $stmt->bindParam(':status', $status,);

        
        if (!$stmt->execute()) {
            header("Location: " . $u2 . urlencode('Something Wrong please try again later'));
        } else {
            header("Location: " . $u1 . urlencode('Category Successfully Created'));
        }
    }
?>
