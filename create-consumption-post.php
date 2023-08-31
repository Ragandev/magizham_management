<?php 
require('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u1 = "consumptions.php?succ=";
    $u2 = "create-consumption.php?err=";

    // User Data 
    $branch = $_POST['branch'];
    $date = $_POST['date'];

    // Duplicate product name check
    // ...

    // Validation
    if (empty($branch) || empty($date)) {
        echo "Error: All fields are required.";
        exit();
    }

    // Insert data into stock table
    $sql = "INSERT INTO `consumption` (branchid, date_created) VALUES (:branchid, :date_created)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':branchid', $branch);
    $stmt->bindParam(':date_created', $date);

    if (!$stmt->execute()) {
        header("Location: " . $u2 . urlencode('Something Wrong please try again later'));
        exit();
    }else{
        $consumptionID = $pdo->lastInsertId();
    }


    // Insert stock item details into the associated table
    for ($i = 0; $i < count($_POST['pro']); $i++) {
        $productID = $_POST['pro'][$i];
        $cuisineID = $_POST['cu'][$i];
        $typeID = $_POST['ty'][$i];
        $categoryID = $_POST['ca'][$i];
        $quantity = $_POST['qt'][$i];

   

        $consumptionItemSql = "INSERT INTO `consumptionitem` (consumption_id, product_id, cuisine_id, type_id, category_id, qty) VALUES (:consumption_id, :product_id, :cuisine_id, :type_id, :category_id, :qty)";
        $consumptionItemStmt = $pdo->prepare($consumptionItemSql);
        $consumptionItemStmt->bindParam(':consumption_id', $consumptionID);
        $consumptionItemStmt->bindParam(':product_id', $productID);
        $consumptionItemStmt->bindParam(':cuisine_id', $cuisineID);
        $consumptionItemStmt->bindParam(':type_id', $typeID);
        $consumptionItemStmt->bindParam(':category_id', $categoryID);
        $consumptionItemStmt->bindParam(':qty', $quantity);

        $consumptionItemStmt->execute();
    }

    header("Location: " . $u1 . urlencode('Consumption Successfully Created'));
    exit();
}
?>
