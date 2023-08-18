<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
require('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u1 = "products.php?succ=";
    $u2 = "edit-product.php?id=" . $_POST['productID'] . "&err=";

    $productID = $_POST['productID'];
    $productName = $_POST['product'];
    $unit = $_POST['unit']; // Updated Unit
    $stockQty = $_POST['stock_qty']; // Updated Stock Quantity
    $price = $_POST['price']; // Updated Price
    $typeID = $_POST['type']; // Updated Type ID
    $categoryID = $_POST['category']; // Updated Category ID
    $cuisineID = $_POST['cuisine']; // Updated Cuisine ID
    $status = $_POST['status']; // Updated Status

    // Handle image upload
    $img1FileName = $_POST['existing_img']; // Default to existing image
    if (!empty($_FILES["img1"]["name"])) {
        $img1 = $_FILES["img1"];
        $img1FileName = $img1["name"];
        $img1TmpName = $img1["tmp_name"];
        $uploadPath = "uploads/";

        if (!move_uploaded_file($img1TmpName, $uploadPath . $img1FileName)) {
            header("Location: " . $u2 . urlencode('Image upload failed'));
            exit();
        }
    }

    // Update data in product table
    $updateSql = "UPDATE product SET name = :name, unit = :unit, stock_qty = :stock_qty, price = :price, typeid = :typeid, categoryid = :categoryid, cuisineid = :cuisineid, status = :status, img = :img WHERE id = :id";
    $stmt = $pdo->prepare($updateSql);
    $stmt->bindParam(':id', $productID);
    $stmt->bindParam(':name', $productName);
    $stmt->bindParam(':unit', $unit);
    $stmt->bindParam(':stock_qty', $stockQty);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':typeid', $typeID);
    $stmt->bindParam(':categoryid', $categoryID);
    $stmt->bindParam(':cuisineid', $cuisineID);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':img', $img1FileName);

    if ($stmt->execute()) {
        header("Location: " . $u1 . urlencode('Product Successfully Updated'));
    } else {
        header("Location: " . $u2 . urlencode('Something went wrong. Please try again later'));
    }
}
?>
