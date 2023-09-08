<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
require('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u1 = "orders.php?succ=";
    $u2 = "edit-order.php?id=" . $_POST['orderID'] . "&err=";

    $orderID = $_POST['orderID'];
    $branchID = $_POST['branch']; // Updated Branch ID
    $orderDate = $_POST['orderdate']; // Updated Order Date
    $deliveryDate = $_POST['deliverydate']; // Updated Delivery Date
    $priority = $_POST['priority']; // Updated Priority
    $status = $_POST['status']; // Updated Status
    $des = $_POST['des'];
    $orderName = $_POST['orderName'];

    // Update data in the order table
    $updateSql = "UPDATE `order` SET branchid = :branchid, orderdate = :orderdate, deliverydate = :deliverydate, priority = :priority, status = :status, description = :description, status = :status, order_name = :order_name WHERE id = :id";
    $stmt = $pdo->prepare($updateSql);
    $stmt->bindParam(':id', $orderID);
    $stmt->bindParam(':branchid', $branchID);
    $stmt->bindParam(':orderdate', $orderDate);
    $stmt->bindParam(':deliverydate', $deliveryDate);
    $stmt->bindParam(':priority', $priority);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':description', $des);
    $stmt->bindParam(':order_name', $orderName); 
    
    if (!$stmt->execute()) {
        header("Location: " . $u2 . urlencode('Something went wrong. Please try again later'));
        exit();
    }
    $oid = $_POST['oid'];

    $deleteDaysQuery = "DELETE FROM orderitem WHERE order_id = :postID";
    $stmtDelete = $pdo->prepare($deleteDaysQuery);
    $stmtDelete->bindParam(':postID', $oid);
    $stmtDelete->execute();


    for ($i = 0; $i < count($_POST['pro']); $i++) {
        $productID = $_POST['pro'][$i];
        $cuisineID = $_POST['cu'][$i];
        $typeID = $_POST['ty'][$i];
        $categoryID = $_POST['ca'][$i];
        $quantity = $_POST['qt'][$i];
        $priorityy = $_POST['pr'][$i];
        $quantitys = $_POST['deliveryqt'][$i];
        $quantit = $_POST['receivedqt'][$i];


        $orderItemSql = "INSERT INTO `orderitem` (order_id, productid, cuisineid, typeid, order_qty, categoryid, priority, delivery_qty, received_qty) VALUES (:order_id, :productid, :cuisineid, :typeid, :order_qty, :categoryid, :priority, :delivery_qty, :received_qty)";
        $orderItemStmt = $pdo->prepare($orderItemSql);
        $orderItemStmt->bindParam(':order_id', $orderID);
        $orderItemStmt->bindParam(':productid', $productID);
        $orderItemStmt->bindParam(':cuisineid', $cuisineID);
        $orderItemStmt->bindParam(':typeid', $typeID);
        $orderItemStmt->bindParam(':categoryid', $categoryID);
        $orderItemStmt->bindParam(':order_qty', $quantity);
        $orderItemStmt->bindParam(':priority', $priorityy);
        $orderItemStmt->bindParam(':received_qty', $quantit);
        $orderItemStmt->bindParam(':delivery_qty', $quantitys);

        $orderItemStmt->execute();
    }

    header("Location: " . $u1 . urlencode('Order Successfully Updated'));
    exit();
}
?>



