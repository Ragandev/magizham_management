<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
include('header.php');
include('menu.php');

require('db.php');


// Get the order ID from the query string
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $orderId = $_GET['id'];

    // Fetch the order details from the database based on the ID
    $orderSql = "SELECT * FROM `order` WHERE id = :id";
    $orderStmt = $pdo->prepare($orderSql);
    $orderStmt->bindParam(':id', $orderId);
    $orderStmt->execute();
    $orderData = $orderStmt->fetch(PDO::FETCH_ASSOC);

    if ($orderData) {
        // Display the order details
        echo "<h2 class='orderdetails'>Order Details</h2>";
        echo "<ul>";
        echo "<li class='orderdetails'>ID: " . $orderData['id'] . "</li>";
        echo "<li class='orderdetails'>Branch: " . $orderData['branchid'] . "</li>";
        echo "<li class='orderdetails'>Order Date: " . $orderData['orderdate'] . "</li>";
        echo "<li class='orderdetails'>Delivery Date: " . $orderData['deliverydate'] . "</li>";
        echo "<li class='orderdetails'>Priority: " . $orderData['priority'] . "</li>";
        echo "<li class='orderdetails'>Status: " . $orderData['status'] . "</li>";
        echo "</ul>";

        // Fetch and display the order items associated with the order
        echo "<h3>Ordered Products</h3>";
        echo "<table>";
        echo "<tr><th>Type</th><th>Cuisine</th><th>Category</th><th>Product</th><th>Quantity</th></tr>";

        $orderItemSql = "SELECT * FROM `orderitem` WHERE order_id = :order_id";
        $orderItemstmt = $pdo->prepare($orderItemSql);
        if ($orderItemstmt) {
            $orderItemstmt->bindParam(':order_id', $orderId);
            $orderItemstmt->execute();
            $orderItemData = $orderItemstmt->fetchAll(PDO::FETCH_ASSOC);
        
            foreach ($orderItemData as $item) {
                // Fetch category name
                $categorySql = "SELECT name FROM `category` WHERE id = :categoryid";
                $categoryStmt = $pdo->prepare($categorySql);
                $categoryStmt->bindParam(':categoryid', $item['categoryid']);
                $categoryStmt->execute();
                $categoryData = $categoryStmt->fetch(PDO::FETCH_ASSOC);
        
                // Fetch type name
                $typeSql = "SELECT name FROM `type` WHERE id = :typeid";
                $typeStmt = $pdo->prepare($typeSql);
                $typeStmt->bindParam(':typeid', $item['typeid']);
                $typeStmt->execute();
                $typeData = $typeStmt->fetch(PDO::FETCH_ASSOC);
        
                // Fetch cuisine name
                $cuisineSql = "SELECT name FROM `cuisine` WHERE id = :cuisineid";
                $cuisineStmt = $pdo->prepare($cuisineSql);
                $cuisineStmt->bindParam(':cuisineid', $item['cuisineid']);
                $cuisineStmt->execute();
                $cuisineData = $cuisineStmt->fetch(PDO::FETCH_ASSOC);
        
                // Fetch product name
                $productSql = "SELECT name FROM `product` WHERE id = :productid";
                $productStmt = $pdo->prepare($productSql);
                $productStmt->bindParam(':productid', $item['productid']);
                $productStmt->execute();
                $productData = $productStmt->fetch(PDO::FETCH_ASSOC);
        
                echo "<tr>";
                echo "<td><div>{$typeData['name']}</div></td>";
                echo "<td><div>{$cuisineData['name']}</div></td>";
                echo "<td><div>{$categoryData['name']}</div></td>";
                echo "<td><div>{$productData['name']}</div></td>";
                echo "<td><div>{$item['order_qty']}</td>";
                echo "</tr>";
            }

            echo "</table>";

            // Add a Print button
            echo '<button id="printButton" class="btn btn-primary">Print</button>';
        } else {
            echo "Failed to prepare the order item query.";
        }
    } else {
        echo "Order not found.";
    }
} else {
    echo "Invalid order ID.";
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
#printButton {
    margin-top: 20px;
}
    </style>
