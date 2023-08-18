<?php 
    
require('db.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u1 =  "wastes.php?succ=";
    $u2 = "create-waste.php?err=";
    // User Data 
    $branch = $_POST['branch'];
    $date = $_POST['date'];
    $waste = $_POST['waste'];
    $amount = $_POST['amount'];




    // Duplicate product name check
    $checkDuplicateQuery = "SELECT COUNT(*) FROM `waste` WHERE id = :id";
    $checkStmt = $pdo->prepare($checkDuplicateQuery);
    $checkStmt->bindParam(':id', $id);
    $checkStmt->execute();
    $duplicateCount = $checkStmt->fetchColumn();

    // if ($duplicateCount > 0) {
    //     header("Location: " . $u2 . urlencode('Order already taken'));         
    //     exit();
    // }

    // Validation
    if (empty($branch) || empty( $date ) || empty( $waste) || empty( $amount)) {
        echo "Error: All fields are required.";
        exit();
    }

    // Insert data into product table
    $sql = "INSERT INTO `waste` (branchid, date, waste_qty, waste_amount ) VALUES (:branchid, :date, :waste_qty, :waste_amount)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':branchid', $branch);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':waste_qty', $waste);
    $stmt->bindParam(':waste_amount', $amount);





    if (!$stmt->execute()) {
        header("Location: " . $u2 . urlencode('Something Wrong please try again later'));
    } else {
        header("Location: " . $u1 . urlencode('Stock Successfully Created'));
    }
}
?>
