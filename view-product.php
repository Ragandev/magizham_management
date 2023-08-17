<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
include('header.php');
include('menu.php');
require('db.php');

// Get the product ID from the query string
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $productId = $_GET['id'];

   


    // Fetch the product details from the database based on the ID
    $productSql = "SELECT * FROM product WHERE id = :id";
    $productStmt = $pdo->prepare($productSql);
    $productStmt->bindParam(':id', $productId);
    $productStmt->execute();
    $productData = $productStmt->fetch(PDO::FETCH_ASSOC);

    if ($productData) {
        // Display the product details
echo "<h2>Product Details</h2>";
echo "<ul>";
echo "<li>ID: " . $productData['id'] . "</li>";
echo "<li>Name: " . $productData['name'] . "</li>";
echo "<li>Unit: " . $productData['unit'] . "</li>";
echo "<li>Stock Quantity: " . $productData['stock_qty'] . "</li>";
echo "<li>Price: " . $productData['price'] . "</li>";
echo "<li>Type: " . $productData['typeid'] . "</li>";
echo "<li>Category: " . $productData['categoryid'] . "</li>";

echo "<li>Cuisine: " . $productData['cuisineid'] . "</li>";
echo "<li>Status: " . $productData['status'] . "</li>";
// Display the product image
echo "<img src='uploads/" . $productData['img'] . "' alt='Product Image'>";
echo "</ul>";

    } else {
        echo "Product not found.";
    }
} else {
    echo "Invalid product ID.";
}

include('footer.php');
?>
