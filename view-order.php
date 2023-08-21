<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
include('header.php');
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
        echo "<h2>Order Details</h2>";
        echo "<ul>";
        echo "<li>ID: " . $orderData['id'] . "</li>";
        echo "<li>Branch: " . $orderData['branchid'] . "</li>";
        echo "<li>Order Date: " . $orderData['orderdate'] . "</li>";
        echo "<li>Delivery Date: " . $orderData['deliverydate'] . "</li>";
        echo "<li>Priority: " . $orderData['priority'] . "</li>";
        echo "<li>Status: " . $orderData['status'] . "</li>";
        echo "</ul>";
// Fetch and display the order items associated with the order


        echo "</table>";
        
        
// Add a Print button
echo '<button id="printButton" class="btn btn-primary">Print</button>';


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