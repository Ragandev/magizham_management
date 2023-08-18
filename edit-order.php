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
    $orderID = $_GET['id'];

    // Retrieve the order details from the database
    $orderSql = "SELECT * FROM `order` WHERE id = :id";
    $orderStmt = $pdo->prepare($orderSql);
    $orderStmt->bindParam(':id', $orderID);
    $orderStmt->execute();
    $orderData = $orderStmt->fetch(PDO::FETCH_ASSOC);

    $branchSql = "SELECT * FROM branch";
    $branchData = $pdo->query($branchSql);
} else {
    header("Location: orders.php");
    exit();
}
?>

<div class="main-box">
    <h2>Edit Order</h2>
    <hr>
    <form class="forms-sample" method="post" action="update-order.php">
        <input type="hidden" name="orderID" value="<?php echo $orderData['id']; ?>">
        <div class="form-group">
            <label for="branch">Branch</label>
            <select class="form-control" name="branch" id="branch">
                <?php foreach ($branchData as $branch): ?>
                    <option value="<?php echo $branch['id']; ?>" <?php if ($orderData['branchid'] === $branch['id']) echo 'selected'; ?>>
                        <?php echo $branch['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="orderdate">Order Date</label>
            <input type="date" class="form-control" name="orderdate" id="orderdate" value="<?php echo $orderData['orderdate']; ?>">
        </div>
        <div class="form-group">
            <label for="deliverydate">Delivery Date</label>
            <input type="date" class="form-control" name="deliverydate" id="deliverydate" value="<?php echo $orderData['deliverydate']; ?>">
        </div>
        <div class="form-group">
            <label for="priority">Priority</label>
            <input type="text" class="form-control" name="priority" id="priority" value="<?php echo $orderData['priority']; ?>">
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" name="status" id="status">
                <option value="pending" <?php if ($orderData['status'] === 'pending') echo 'selected'; ?>>Pending</option>
                <option value="completed" <?php if ($orderData['status'] === 'completed') echo 'selected'; ?>>Completed</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Order</button>
    </form>
</div>

<?php include('footer.php'); ?>
