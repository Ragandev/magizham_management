<?php 
    
require('db.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u1 =  "products.php?succ=";
    $u2 = "create-product.php?err=";
    // User Data 
    $productname = $_POST['product'];
    $unit = $_POST['unit'];
    $stock_qty = $_POST['stock_qty'];

    $price = $_POST['price'];
    $typeid = $_POST['type'];
    $categoryid = $_POST['category'];
    $cuisineid = $_POST['cuisine'];
    $status = $_POST['status'];

// image uploads
    $img1 = $_FILES["img1"];
    $img1FileName = $img1["name"];
    $img1TmpName = $img1["tmp_name"];

    $uploadPath = "uploads/";

    // ifmove_uploaded_file($img1TmpName, $uploadPath . $img1FileName);
// Check if an image was uploaded
if (!empty($img1FileName)) {
    // Move the uploaded image to the specified directory
    if (move_uploaded_file($img1TmpName, $uploadPath . $img1FileName)) {
        // Image uploaded successfully
    } else {
        // Handle image upload error
        header("Location: " . $u2 . urlencode('Image upload failed'));
        exit();
    }
} else {
    // Handle case where no image was uploaded
    header("Location: " . $u2 . urlencode('Please upload an image'));
    exit();
}
   

    
        

    // Duplicate product name check
    $checkDuplicateQuery = "SELECT COUNT(*) FROM product WHERE name = :name";
    $checkStmt = $pdo->prepare($checkDuplicateQuery);
    $checkStmt->bindParam(':name', $productname);
    $checkStmt->execute();
    $duplicateCount = $checkStmt->fetchColumn();

    if ($duplicateCount > 0) {
        header("Location: " . $u2 . urlencode('Branch already taken'));         
        exit();
    }

    

    // Insert data into product table
    $sql = "INSERT INTO product (name, unit, stock_qty, price, typeid, categoryid, cuisineid, status,  img ) VALUES (:name, :unit, :stock_qty,  :price, :typeid, :categoryid, :cuisineid, :status, :img )";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':name', $productname);
    $stmt->bindParam(':unit', $unit);
    $stmt->bindParam(':stock_qty', $stock_qty);

    $stmt->bindParam(':price', $price);

    $stmt->bindParam(':typeid', $typeid);

    $stmt->bindParam(':categoryid', $categoryid);
    $stmt->bindParam(':cuisineid', $cuisineid);

    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':img', $img1FileName);

    if (!$stmt->execute()) {
        header("Location: " . $u2 . urlencode('Something Wrong please try again later'));
    } else {
        header("Location: " . $u1 . urlencode('Product Successfully Created'));
    }
}
?>
