<?php 
    
require('db.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // User Data 
    $productname = $_POST['product'];
    $unit = $_POST['unit'];
    $stock_qty = $_POST['stock_qty'];

    $price = $_POST['price'];
    $typeid = $_POST['type'];
    $categoryid = $_POST['category'];
    $cuisineid = $_POST['cuisine'];
    $status = $_POST['status'];


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
    $sql = "INSERT INTO product (name, unit, stock_qty, price, typeid, categoryid, cuisineid, status ) VALUES (:name, :unit, :stock_qty,  :price, :typeid, :categoryid, :cuisineid, :status )";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':name', $productname);
    $stmt->bindParam(':unit', $unit);
    $stmt->bindParam(':stock_qty', $stock_qty);

    $stmt->bindParam(':price', $price);

    $stmt->bindParam(':typeid', $typeid);

    $stmt->bindParam(':categoryid', $categoryid);
    $stmt->bindParam(':cuisineid', $cuisineid);

    $stmt->bindParam(':status', $status);

    if (!$stmt->execute()) {
        echo "Product not created";
    } else {
        echo "Product Created successfully.";
    }
}
?>
