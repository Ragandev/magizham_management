<?php 
require('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u1 = "stocks.php?succ=";
    $u2 = "create-stock.php?err=";

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
    $sql = "INSERT INTO `stock` (branchid, date_created) VALUES (:branchid, :date_created)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':branchid', $branch);
    $stmt->bindParam(':date_created', $date);

    if (!$stmt->execute()) {
        header("Location: " . $u2 . urlencode('Something Wrong please try again later'));
        exit();
    }else{
        $stockID = $pdo->lastInsertId();
    }


    // Insert stock item details into the associated table
    for ($i = 0; $i < count($_POST['pro']); $i++) {
        $productID = $_POST['pro'][$i];
        $cuisineID = $_POST['cu'][$i];
        $typeID = $_POST['ty'][$i];
        $categoryID = $_POST['ca'][$i];
        $quantity = $_POST['qt'][$i];

   

        $stockItemSql = "INSERT INTO `stockitem` (stock_id, product_id, cuisine_id, type_id, category_id, qty) VALUES (:stock_id, :product_id, :cuisine_id, :type_id, :category_id, :qty)";
        $stockItemStmt = $pdo->prepare($stockItemSql);
        $stockItemStmt->bindParam(':stock_id', $stockID);
        $stockItemStmt->bindParam(':product_id', $productID);
        $stockItemStmt->bindParam(':cuisine_id', $cuisineID);
        $stockItemStmt->bindParam(':type_id', $typeID);
        $stockItemStmt->bindParam(':category_id', $categoryID);
        $stockItemStmt->bindParam(':qty', $quantity);

        $stockItemStmt->execute();
    }

    header("Location: " . $u1 . urlencode('Stock Successfully Created'));
    exit();
}
?>
