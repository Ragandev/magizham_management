<?php
require('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // User Data
    $orderID = $_POST['order_id'];
    $orderItems = $_POST['order_items']; // This should be an array of order items

    // Loop through order items and deduct quantities from stock
    foreach ($orderItems as $orderItem) {
        $productID = $orderItem['product_id'];
        $quantity = $orderItem['quantity'];

        // Fetch the current stock quantity for the product
        $checkStockSql = "SELECT qty FROM stockitem WHERE product_id = :product_id";
        $checkStockStmt = $pdo->prepare($checkStockSql);
        $checkStockStmt->bindParam(':product_id', $productID);
        $checkStockStmt->execute();
        $currentStock = $checkStockStmt->fetchColumn();

        // Calculate the new stock quantity after deducting the ordered quantity
        $newStockQuantity = $currentStock - $quantity;

        if ($newStockQuantity < 0) {
            // Handle insufficient stock error
            // You can redirect to an error page or display an error message
            header("Location: orders.php?err=" . urlencode('Insufficient stock for product: ' . $productID));
            exit();
        }

        // Update the stockitem table with the new quantity
        $updateStockSql = "UPDATE stockitem SET qty = :new_qty WHERE product_id = :product_id";
        $updateStockStmt = $pdo->prepare($updateStockSql);
        $updateStockStmt->bindParam(':new_qty', $newStockQuantity);
        $updateStockStmt->bindParam(':product_id', $productID);
        $updateStockStmt->execute();
    }

    // You can add additional success handling here
    // ...

    // Redirect to a suitable page after processing the order
    header("Location: orders.php?succ=" . urlencode('Order Successfully Processed'));
    exit();
}
?>
