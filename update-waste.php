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
    $updateSql = "UPDATE `waste` SET branchid = :branchid, date = :date, waste_qty = :waste_qty, waste_amount = :waste_amount WHERE id = :id";
    $stmt = $pdo->prepare($updateSql);
    $stmt->bindParam(':id', $wasteID);
    $stmt->bindParam(':branchid', $branch);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':waste_qty', $wasteQty);
    $stmt->bindParam(':waste_amount', $wasteAmount);

    if ($stmt->execute()) {
        header("Location: " . $u1 . urlencode('Waste Successfully Updated'));
    } else {
        header("Location: " . $u2 . urlencode('Something went wrong. Please try again later'));
    }
      // Update waste item details
      for ($i = 0; $i < count($_POST['pro']); $i++) {
        // Get waste item details from the form
        $wasteItemID = $_POST['item_id'][$i];
        $productID = $_POST['pro'][$i];
        $cuisineID = $_POST['cu'][$i];
        $typeID = $_POST['ty'][$i];
        $categoryID = $_POST['ca'][$i];
        $quantity = $_POST['qt'][$i];

        // Update waste item details in the database
        $updateWasteItemSql = "UPDATE `wasteitem` SET product_id = :product_id, cuisine_id = :cuisine_id, type_id = :type_id, category_id = :category_id, qty = :qty WHERE id = :item_id";
        $updateWasteItemStmt = $pdo->prepare($updateWasteItemSql);
        $updateWasteItemStmt->bindParam(':item_id', $wasteItemID);
        $updateWasteItemStmt->bindParam(':product_id', $productID);
        $updateWasteItemStmt->bindParam(':cuisine_id', $cuisineID);
        $updateWasteItemStmt->bindParam(':type_id', $typeID);
        $updateWasteItemStmt->bindParam(':category_id', $categoryID);
        $updateWasteItemStmt->bindParam(':qty', $quantity);

        $updateWasteItemStmt->execute();
    }

    // Redirect to the "Edit Waste" page with a success message
    header("Location: wastes.php?id=" . $wasteID . "&success=update_successful");
    exit();
}
?>
