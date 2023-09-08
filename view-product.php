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
        // Fetch type name
        $typeSql = "SELECT name FROM type WHERE id = :typeid";
        $typeStmt = $pdo->prepare($typeSql);
        $typeStmt->bindParam(':typeid', $productData['typeid']);
        $typeStmt->execute();
        $typeData = $typeStmt->fetch(PDO::FETCH_ASSOC);

        // Fetch category name
        $categorySql = "SELECT name FROM category WHERE id = :categoryid";
        $categoryStmt = $pdo->prepare($categorySql);
        $categoryStmt->bindParam(':categoryid', $productData['categoryid']);
        $categoryStmt->execute();
        $categoryData = $categoryStmt->fetch(PDO::FETCH_ASSOC);

        // Fetch cuisine name
        $cuisineSql = "SELECT name FROM cuisine WHERE id = :cuisineid";
        $cuisineStmt = $pdo->prepare($cuisineSql);
        $cuisineStmt->bindParam(':cuisineid', $productData['cuisineid']);
        $cuisineStmt->execute();
        $cuisineData = $cuisineStmt->fetch(PDO::FETCH_ASSOC);

        // Display the product details
        echo "<h2>Product Details</h2>";
        echo "<ul>";
        echo "<li>ID: " . $productData['id'] . "</li>";
        echo "<li>Name: " . $productData['name'] . "</li>";
        echo "<li>Unit: " . $productData['unit'] . "</li>";
        // echo "<li>Stock Quantity: " . $productData['stock_qty'] . "</li>";
        echo "<li>Price: " . $productData['price'] . "</li>";
        echo "<li>Type: " . $typeData['name'] . "</li>";
        echo "<li>Category: " . $categoryData['name'] . "</li>";
        echo "<li>Cuisine: " . $cuisineData['name'] . "</li>";
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
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;      
          }

        h2 {
            margin-top: 0;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }

        img {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
    </style>