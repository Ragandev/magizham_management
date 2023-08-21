<?php 
require('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u1 =  "orders.php?succ=";
    $u2 = "create-order.php?err=";
    
    // User Data 
    $branch = $_POST['branch'];
    $orderdate = $_POST['orderDate'];
    $deliverydate = $_POST['deliveryDate'];
    $priority = $_POST['priority'];
    $status = $_POST['status'];
    $des = $_POST['des'];


 

    // Validation
    if (empty($branch) || empty($orderdate) || empty($priority) || empty($status) || empty($des)) {
        echo "Error: All fields are required.";
        exit();
    }

    // Insert data into the order table
    $orderSql = "INSERT INTO `order` (branchid, orderdate, deliverydate, priority, status, description) VALUES (:branchid, :orderdate, :deliverydate, :priority, :status, :description)";
    $orderStmt = $pdo->prepare($orderSql);
    $orderStmt->bindParam(':branchid', $branch);
    $orderStmt->bindParam(':orderdate', $orderdate);
    $orderStmt->bindParam(':deliverydate', $deliverydate);
    $orderStmt->bindParam(':priority', $priority);
    $orderStmt->bindParam(':status', $status);
    $orderStmt->bindParam(':description', $des);


    if (!$orderStmt->execute()) {
        header("Location: " . $u2 . urlencode('Something went wrong. Please try again later.'));
        exit();
    }else{
        $orderID = $pdo->lastInsertId();
    }
    

    // Insert order item details into the associated table
    for ($i = 0; $i < count($_POST['pro']); $i++) {
        $productID = $_POST['pro'][$i];
        $cuisineID = $_POST['cu'][$i];
        $typeID = $_POST['ty'][$i];
        $categoryID = $_POST['ca'][$i];
        $quantity = $_POST['qt'][$i];
        $priorityy = $_POST['pr'][$i];


        $orderItemSql = "INSERT INTO `orderitem` (order_id, productid, cuisineid, typeid, order_qty, categoryid, priority) VALUES (:order_id, :productid, :cuisineid, :typeid, :order_qty, :categoryid, :priority)";
        $orderItemStmt = $pdo->prepare($orderItemSql);
        $orderItemStmt->bindParam(':order_id', $orderID);
        $orderItemStmt->bindParam(':productid', $productID);
        $orderItemStmt->bindParam(':cuisineid', $cuisineID);
        $orderItemStmt->bindParam(':typeid', $typeID);
        $orderItemStmt->bindParam(':categoryid', $categoryID);
        $orderItemStmt->bindParam(':order_qty', $quantity);
        $orderItemStmt->bindParam(':priority', $priorityy);

        $orderItemStmt->execute();
    }

    header("Location: " . $u1 . urlencode('Order Successfully Created'));
    exit();
}
?>
