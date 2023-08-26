<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
require('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u1 = "wastes.php?succ=";
    $u2 = "edit-waste.php?id=" . $_POST['id'] . "&err=";

    $wasteID = $_POST['id'];
    $branch = $_POST['branch'];
    $date = $_POST['date'];
    $wasteAmount = $_POST['waste_amount'];

    

    // Update data in waste table
    $updateSql = "UPDATE `waste` SET branchid = :branchid, date = :date,  waste_amount = :waste_amount WHERE id = :id";
    $stmt = $pdo->prepare($updateSql);
    $stmt->bindParam(':id', $wasteID);
    $stmt->bindParam(':branchid', $branch);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':waste_amount', $wasteAmount);

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
    
    $deleteDaysQuery = "DELETE FROM wasteitem WHERE waste_id = :postID";
    $stmtDelete = $pdo->prepare($deleteDaysQuery);
    $stmtDelete->bindParam(':postID', $oid);
    $stmtDelete->execute();

    for ($i = 0; $i < count($_POST['pro']); $i++) {
        $productID = $_POST['pro'][$i];
        $cuisineID = $_POST['cu'][$i];
        $typeID = $_POST['ty'][$i];
        $categoryID = $_POST['ca'][$i];
        $quantity = $_POST['qt'][$i];
        


        $wasteItemSql = "INSERT INTO `wasteitem` (waste_id, product_id, cuisine_id, type_id, qty, category_id) VALUES (:waste_id, :product_id, :cuisine_id, :type_id, :qty, :category_id)";
        $wasteItemStmt = $pdo->prepare($wasteItemSql);
        $wasteItemStmt->bindParam(':waste_id', $wasteID);
        $wasteItemStmt->bindParam(':product_id', $productID);
        $wasteItemStmt->bindParam(':cuisine_id', $cuisineID);
        $wasteItemStmt->bindParam(':type_id', $typeID);
        $wasteItemStmt->bindParam(':category_id', $categoryID);
        $wasteItemStmt->bindParam(':qty', $quantity);

        $wasteItemStmt->execute();
    }

    header("Location: " . $u1 . urlencode('Waste Successfully Updated'));
    exit();
}
?>
