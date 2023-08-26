<?php

session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
require('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u1 = "stocks.php?succ=";
    $u2 = "edit-stock.php?id=" . $_POST['id'] . "&err=";

    $stockID = $_POST['id'];
    $branch = $_POST['branch'];
    $date = $_POST['date'];

    // Update data in stock table
    $updateSql = "UPDATE `stock` SET branchid = :branchid, date_created = :date_created WHERE id = :id";
    $stmt = $pdo->prepare($updateSql);
    $stmt->bindParam(':id', $stockID);
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

    $deleteDaysQuery = "DELETE FROM stockitem WHERE stock_id = :postID";
    $stmtDelete = $pdo->prepare($deleteDaysQuery);
    $stmtDelete->bindParam(':postID', $oid);
    $stmtDelete->execute();


    for ($i = 0; $i < count($_POST['pro']); $i++) {
        $productID = $_POST['pro'][$i];
        $cuisineID = $_POST['cu'][$i];
        $typeID = $_POST['ty'][$i];
        $categoryID = $_POST['ca'][$i];
        $quantity = $_POST['qt'][$i];
        


        $stockItemSql = "INSERT INTO `stockitem` (stock_id, product_id, cuisine_id, type_id, qty, category_id) VALUES (:stock_id, :product_id, :cuisine_id, :type_id, :qty, :category_id)";
        $stockItemStmt = $pdo->prepare($stockItemSql);
        $stockItemStmt->bindParam(':stock_id', $stockID);
        $stockItemStmt->bindParam(':product_id', $productID);
        $stockItemStmt->bindParam(':cuisine_id', $cuisineID);
        $stockItemStmt->bindParam(':type_id', $typeID);
        $stockItemStmt->bindParam(':category_id', $categoryID);
        $stockItemStmt->bindParam(':qty', $quantity);

        $stockItemStmt->execute();
    }

    header("Location: " . $u1 . urlencode('Stock Successfully Updated'));
    exit();
}
?>
