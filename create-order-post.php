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


    // Duplicate product name check
    $checkDuplicateQuery = "SELECT COUNT(*) FROM `order` WHERE status = :status";
    $checkStmt = $pdo->prepare($checkDuplicateQuery);
    $checkStmt->bindParam(':status', $status);
    $checkStmt->execute();
    $duplicateCount = $checkStmt->fetchColumn();

    // if ($duplicateCount > 0) {
    //     header("Location: " . $u2 . urlencode('Order already taken'));         
    //     exit();
    // }

    // Validation
    if (empty($branch) || empty($orderdate) || empty($priority ) || empty($status)) {
        echo "Error: All fields are required.";
        exit();
    }

    // Insert data into product table
    $sql = "INSERT INTO `order` (branchid, orderdate, deliverydate, priority, status ) VALUES (:branchid, :orderdate, :deliverydate,  :priority,  :status )";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':branchid', $branch);
    $stmt->bindParam(':orderdate', $orderdate);
    $stmt->bindParam(':deliverydate', $deliverydate);

    $stmt->bindParam(':priority', $priority);

    $stmt->bindParam(':status', $status);



    if (!$stmt->execute()) {
        header("Location: " . $u2 . urlencode('Something Wrong please try again later'));
    } else {
        header("Location: " . $u1 . urlencode('Order Successfully Created'));
    }
}
?>
