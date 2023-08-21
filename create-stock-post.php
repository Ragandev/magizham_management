<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
require('db.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u1 =  "stocks.php?succ=";
    $u2 = "create-stock.php?err=";
    // User Data 
    $branch = $_POST['branch'];
    $date = $_POST['date'];
    $type = $_POST['type'];


    
    



    // Duplicate product name check
    $checkDuplicateQuery = "SELECT COUNT(*) FROM `stock` WHERE id = :id";
    $checkStmt = $pdo->prepare($checkDuplicateQuery);
    $checkStmt->bindParam(':id', $id);
    $checkStmt->execute();
    $duplicateCount = $checkStmt->fetchColumn();

    // if ($duplicateCount > 0) {
    //     header("Location: " . $u2 . urlencode('Order already taken'));         
    //     exit();
    // }

    // Validation
    if (empty($branch) || empty( $date )) {
        echo "Error: All fields are required.";
        exit();
    }

    // Insert data into product table
    $sql = "INSERT INTO `stock` (branchid, date_created) VALUES (:branchid, :date_created)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':branchid', $branch);
    $stmt->bindParam(':date_created', $date);

    // $stmt->bindParam(':cuisineid', $cuisine);






    if (!$stmt->execute()) {
        header("Location: " . $u2 . urlencode('Something Wrong please try again later'));
    } else {
        header("Location: " . $u1 . urlencode('Stock Successfully Created'));
    }
}
?>
