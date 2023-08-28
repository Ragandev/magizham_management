<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
include('header.php');
include('menu.php');
require('db.php');

// Get the stock ID from the query string
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $stockID = $_GET['id'];

    // Fetch the stock details from the database based on the ID
    $stockSql = "SELECT * FROM `stock` WHERE id = :id";
    $stockStmt = $pdo->prepare($stockSql);
    $stockStmt->bindParam(':id', $stockID);
    $stockStmt->execute();
    $stockData = $stockStmt->fetch(PDO::FETCH_ASSOC);

    if ($stockData) {
        // Display the stock details
        echo "<h2 Class>Stock Details</h2>";
        echo "<ul>";
        echo "<li>ID: " . $stockData['id'] . "</li>";
        echo "<li>DATE: " . $stockData['date_created'] . "</li>";

        // Add other stock details here...
        echo "</ul>";

        // Fetch and display the stock item details associated with the stock
        echo "<h3>Stock Items</h3>";
        echo "<table>";
        echo "<tr><th>Type</th><th>Cuisine</th><th>Category</th><th>Product</th><th>Quantity</th></tr>";

        $stockItemSql = "SELECT * FROM `stockitem` WHERE stock_id = :stock_id";
        $stockItemStmt = $pdo->prepare($stockItemSql);
        if ($stockItemStmt) {
            $stockItemStmt->bindParam(':stock_id', $stockID);
            $stockItemStmt->execute();
            $stockItemData = $stockItemStmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($stockItemData as $item) {
                // Fetch category, type, cuisine, and product names
                  // Fetch category name
                $categorySql = "SELECT name FROM `category` WHERE id = :category_id";
                $categoryStmt = $pdo->prepare($categorySql);
                $categoryStmt->bindParam(':category_id', $item['category_id']);
                $categoryStmt->execute();
                $categoryData = $categoryStmt->fetch(PDO::FETCH_ASSOC);
        
                // Fetch type name
                $typeSql = "SELECT name FROM `type` WHERE id = :type_id";
                $typeStmt = $pdo->prepare($typeSql);
                $typeStmt->bindParam(':type_id', $item['type_id']);
                $typeStmt->execute();
                $typeData = $typeStmt->fetch(PDO::FETCH_ASSOC);
        
                // Fetch cuisine name
                $cuisineSql = "SELECT name FROM `cuisine` WHERE id = :cuisine_id";
                $cuisineStmt = $pdo->prepare($cuisineSql);
                $cuisineStmt->bindParam(':cuisine_id', $item['cuisine_id']);
                $cuisineStmt->execute();
                $cuisineData = $cuisineStmt->fetch(PDO::FETCH_ASSOC);
        
                // Fetch product name
                $productSql = "SELECT name FROM `product` WHERE id = :product_id";
                $productStmt = $pdo->prepare($productSql);
                $productStmt->bindParam(':product_id', $item['product_id']);
                $productStmt->execute();
                $productData = $productStmt->fetch(PDO::FETCH_ASSOC);
                // Similar to how you did in the previous code
                
                echo "<tr>";
                echo "<td><div>{$typeData['name']}</div></td>";
                echo "<td><div>{$cuisineData['name']}</div></td>";
                echo "<td><div>{$categoryData['name']}</div></td>";
                echo "<td><div>{$productData['name']}</div></td>";
                echo "<td><div>{$item['qty']}</div></td>";
                echo "</tr>";
            }

            echo "</table>";

            // Add a Print button
            echo '<button id="printButton" class="btn btn-primary">Print</button>';
        } else {
            echo "Failed to prepare the stock item query.";
        }
    } else {
        echo "Stock not found.";
    }
} else {
    echo "Invalid stock ID.";
}

include('footer.php');
?>
<script>
// JavaScript code for printing
document.getElementById("printButton").addEventListener("click", function() {
    window.print();
});
</script>
<style>
table {
    border-collapse: collapse;
    width: 100%;
    margin-bottom: 20px;
}

table th, table td {
    padding: 10px;
    text-align: left;
}

table th {
    background-color: #f2f2f2;
}

.orderdetails {
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Style for the Print button */

</style>
