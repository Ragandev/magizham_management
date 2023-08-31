<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
include('header.php');
include('menu.php');
require('db.php');

// Get the consumption ID from the query string
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $consumptionID = $_GET['id'];

    // Fetch the consumption details from the database based on the ID
    $consumptionSql = "SELECT * FROM `consumption` WHERE id = :id";
    $consumptionStmt = $pdo->prepare($consumptionSql);
    $consumptionStmt->bindParam(':id', $consumptionID);
    $consumptionStmt->execute();
    $consumptionData = $consumptionStmt->fetch(PDO::FETCH_ASSOC);

    if ($consumptionData) {
        // Display the consumption details
        echo "<h2 Class>consumption Details</h2>";
        echo "<ul>";
        echo "<li>ID: " . $consumptionData['id'] . "</li>";
        echo "<li>DATE: " . $consumptionData['date_created'] . "</li>";

        // Add other stock details here...
        echo "</ul>";

        // Fetch and display the stock item details associated with the stock
        echo "<h3>consumption Items</h3>";
        echo "<table>";
        echo "<tr><th>Type</th><th>Cuisine</th><th>Category</th><th>Product</th><th>Quantity</th></tr>";

        $consumptionItemSql = "SELECT * FROM `consumptionitem` WHERE consumption_id = :consumption_id";
        $consumptionItemStmt = $pdo->prepare($consumptionItemSql);
        if ($consumptionItemStmt) {
            $consumptionItemStmt->bindParam(':consumption_id', $consumptionID);
            $consumptionItemStmt->execute();
            $consumptionItemData = $consumptionItemStmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($consumptionItemData as $item) {
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
            echo "Failed to prepare the consumption item query.";
        }
    } else {
        echo "consumption not found.";
    }
} else {
    echo "Invalid consumption ID.";
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
