<?php 
    
require('db.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // User Data 
    $productname = $_POST['product'];
    $unit = $_POST['unit'];
    $status = $_POST['status'];
    $categoryId = $_POST['category']; // Assuming 'category' is the name of your select input

    // Duplicate product name check
    $checkDuplicateQuery = "SELECT COUNT(*) FROM product WHERE name = :name";
    $checkStmt = $pdo->prepare($checkDuplicateQuery);
    $checkStmt->bindParam(':name', $productname);
    $checkStmt->execute();
    $duplicateCount = $checkStmt->fetchColumn();

    if ($duplicateCount > 0) {
        echo "Error: Product name already exists.";
        exit();
    }

    // Validation
    // if (empty($status) || empty($productname) || empty($unit) || empty($categoryId)) {
    //     echo "Error: All fields are required.";
    //     exit();
    // }

    // Insert data into product table
    $sql = "INSERT INTO product (name, unit, status, categoryid) VALUES (:name, :unit, :status, :categoryid)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':name', $productname);
    $stmt->bindParam(':unit', $unit);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':categoryid', $categoryId);

    if (!$stmt->execute()) {
        echo "Product not created";
    } else {
        echo "Product Created successfully.";
    }
}
?>
