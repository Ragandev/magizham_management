<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
include('header.php');
include('menu.php');
require('db.php');

if (isset($_GET['id'])) {
    $stockID = $_GET['id'];

    // Retrieve the stock details from the database
    $stockSql = "SELECT * FROM `stock` WHERE id = :id";
    $stockStmt = $pdo->prepare($stockSql);
    $stockStmt->bindParam(':id', $stockID);
    $stockStmt->execute();
    $stockData = $stockStmt->fetch(PDO::FETCH_ASSOC);

    // Retrieve branch data for dropdown
    $branchSql = "SELECT * FROM branch";
    $branchData = $pdo->query($branchSql);
} else {
    header("Location: stocks.php");
    exit();
}
?>

<div class="main-box">
    <h2>Edit Stock</h2>
    <hr>
    <form class="forms-sample" method="post" action="update-stock.php">
        <input type="hidden" name="id" value="<?php echo $stockData['id']; ?>">

        <!-- Branch -->
        <div class="form-group">
            <label for="branch">Branch</label>
            <select class="form-control" id="branch" name="branch">
                <?php foreach ($branchData as $branch) : ?>
                    <option value="<?php echo $branch['id']; ?>" <?php if ($stockData['branchid'] == $branch['id']) echo 'selected'; ?>>
                        <?php echo $branch['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Date -->
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" class="form-control" id="date" name="date" value="<?php echo $stockData['date_created']; ?>">
        </div>

        <!-- Stock Quantity -->
        <div class="form-group">
            <label for="stock_qty">Stock Quantity</label>
            <input type="number" class="form-control" id="stock_qty" name="stock_qty" value="<?php echo $stockData['stock_qty']; ?>">
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Update Stock</button>
    </form>
</div>

<?php include('footer.php'); ?>
