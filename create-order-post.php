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

    // Duplicate status check (adjust the column name if needed)
    $checkDuplicateQuery = "SELECT COUNT(*) FROM `order` WHERE status = :status";
    $checkStmt = $pdo->prepare($checkDuplicateQuery);
    $checkStmt->bindParam(':status', $status);
    $checkStmt->execute();
    $duplicateCount = $checkStmt->fetchColumn();

    // Validation
    if (empty($branch) || empty($orderdate) || empty($priority) || empty($status)) {
        echo "Error: All fields are required.";
        exit();
    }

    // Insert data into the order table
    $orderSql = "INSERT INTO `order` (branchid, orderdate, deliverydate, priority, status) VALUES (:branchid, :orderdate, :deliverydate, :priority, :status)";
    $orderStmt = $pdo->prepare($orderSql);
    $orderStmt->bindParam(':branchid', $branch);
    $orderStmt->bindParam(':orderdate', $orderdate);
    $orderStmt->bindParam(':deliverydate', $deliverydate);
    $orderStmt->bindParam(':priority', $priority);
    $orderStmt->bindParam(':status', $status);

    if (!$orderStmt->execute()) {
        header("Location: " . $u2 . urlencode('Something went wrong. Please try again later.'));
        exit();
    }

    $orderID = $pdo->lastInsertId();

    // Insert order item details into the associated table
    for ($i = 0; $i < count($_POST['pro']); $i++) {
        $productID = $_POST['pro'][$i];
        $cuisineID = $_POST['cu'][$i];
        $typeID = $_POST['ty'][$i];
        $categoryID = $_POST['ca'][$i];
        $quantity = $_POST['qt'][$i];

        $orderItemSql = "INSERT INTO `orderitem` (productid, cuisineid, typeid, categoryid ) VALUES (:productid, :cuisineid, :typeid, :categoryid)";
        $orderItemStmt = $pdo->prepare($orderItemSql);
        $orderItemStmt->bindParam(':productid', $productID);
        $orderItemStmt->bindParam(':cuisineid', $cuisineID);
        $orderItemStmt->bindParam(':typeid', $typeID);
        $orderItemStmt->bindParam(':categoryid', $categoryID);

        $orderItemStmt->execute();
    }

    header("Location: " . $u1 . urlencode('Order Successfully Created'));
    exit();
}
?>
