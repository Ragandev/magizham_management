<?php

session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
require('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u1 = "consumptions.php?succ=";
    $u2 = "edit-consumption.php?id=" . $_POST['id'] . "&err=";

    $consumptionID = $_POST['id'];
    $branch = $_POST['branch'];
    $date = $_POST['date'];

    // Update data in consumption table
    $updateSql = "UPDATE `consumption` SET branchid = :branchid, date_created = :date_created WHERE id = :id";
    $stmt = $pdo->prepare($updateSql);
    $stmt->bindParam(':id', $consumptionID);
    $stmt->bindParam(':branchid', $branch);
    $stmt->bindParam(':date_created', $date);

    if ($stmt === false) {
        // Error handling for preparing the statement
        die("Error preparing statement: " . $pdo->errorInfo()[2]);
    }
    
    if ($stmt->execute()) {
        // The execution was successful, handle it accordingly
    } else {
        // Execution failed, handle the error
        header("Location: " . $u2 . urlencode('Something went wrong. Please try again later'));
        exit();
    }
    $oid = $_POST['oid'];

    $deleteDaysQuery = "DELETE FROM consumptionitem WHERE consumption_id = :postID";
    $stmtDelete = $pdo->prepare($deleteDaysQuery);
    $stmtDelete->bindParam(':postID', $oid);
    $stmtDelete->execute();


    for ($i = 0; $i < count($_POST['pro']); $i++) {
        $productID = $_POST['pro'][$i];
        $cuisineID = $_POST['cu'][$i];
        $typeID = $_POST['ty'][$i];
        $categoryID = $_POST['ca'][$i];
        $quantity = $_POST['qt'][$i];
        


        $consumptionItemSql = "INSERT INTO `consumptionitem` (consumption_id, product_id, cuisine_id, type_id, qty, category_id) VALUES (:consumption_id, :product_id, :cuisine_id, :type_id, :qty, :category_id)";
        $consumptionItemStmt = $pdo->prepare($consumptionItemSql);
        $consumptionItemStmt->bindParam(':consumption_id', $consumptionID);
        $consumptionItemStmt->bindParam(':product_id', $productID);
        $consumptionItemStmt->bindParam(':cuisine_id', $cuisineID);
        $consumptionItemStmt->bindParam(':type_id', $typeID);
        $consumptionItemStmt->bindParam(':category_id', $categoryID);
        $consumptionItemStmt->bindParam(':qty', $quantity);

        $consumptionItemStmt->execute();
    }

    header("Location: " . $u1 . urlencode('consumption Successfully Updated'));
    exit();
}
?>
