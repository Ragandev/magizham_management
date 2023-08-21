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
    $typedata = $pdo->query("SELECT * FROM `type`")->fetchAll(PDO::FETCH_ASSOC);
    $cuisinedata = $pdo->query("SELECT * FROM `cuisine`")->fetchAll(PDO::FETCH_ASSOC);
    $categorydata = $pdo->query("SELECT * FROM `category`")->fetchAll(PDO::FETCH_ASSOC);
    $productdata = $pdo->query("SELECT * FROM `product`")->fetchAll(PDO::FETCH_ASSOC);
} else {
    header("Location: orders.php");
    exit();
}
?>

<div class="main-box">
    <h2>Edit Order</h2>
    <hr>
    <form class="forms-sample" method="post" action="update-order.php">
    <div class="row">

        <input type="hidden" name="orderID" value="<?php echo $orderData['id']; ?>">
        <div class="col-6">

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
        </div>
        <div class="col-6">
        <div class="form-group">
            <label for="orderdate">Order Date</label>
            <input type="date" class="form-control" name="orderdate" id="orderdate" value="<?php echo $orderData['orderdate']; ?>">
        </div>
        </div>
        <div class="col-6">
        <div class="form-group">
            <label for="deliverydate">Delivery Date</label>
            <input type="date" class="form-control" name="deliverydate" id="deliverydate" value="<?php echo $orderData['deliverydate']; ?>">
        </div>
        </div>
        <div class="col-6">
        <div class="form-group">
            <label for="priority">Priority</label>
            <input type="text" class="form-control" name="priority" id="priority" value="<?php echo $orderData['priority']; ?>">
        </div>
        </div>
        <div class="col-6">
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" name="status" id="status">
                <option value="pending" <?php if ($orderData['status'] === 'pending') echo 'selected'; ?>>Pending</option>
                <option value="completed" <?php if ($orderData['status'] === 'completed') echo 'selected'; ?>>Completed</option>
            </select>
        </div>
        </div>

  
         
        <!-- Additional product details rows -->
        <div class="pro-box">
            <div class="row mb-4">
                <div class="col">
                    <div class="form-group">
                        <label for="exampleInputStatus">Type</label>
                        <select class="form-control mb-2" name="ty[]">
                            <?php foreach ($typedata as $row): ?>
                                <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="exampleInputStatus">Cuisine</label>
                        <select class="form-control mb-2" name="cu[]">
                            <?php foreach ($cuisinedata as $row): ?>
                                <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="exampleInputStatus">Category</label>
                        <select class="form-control mb-2" name="ca[]">
                            <?php foreach ($categorydata as $row): ?>
                                <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="exampleInputStatus">Product</label>
                        <select class="form-control mb-2" name="pro[]">
                            <?php foreach ($productdata as $row): ?>
                                <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <label for="">Qty</label>
                    <input class="form-control mb-2" name="qt[]">
                </div>
            </div>
        </div>
        <!-- End of additional product details rows -->
        <div>
            <a class="btn add-btn btn-success" id="addRow">+</a>
        </div><br><br><br>

        <button type="submit" class="btn btn-primary">Update Order</button>
        </div>
  </form>
    </div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const addInputButton = document.getElementById('addRow');
    const inputContainer = document.querySelector('.pro-box');

    // Initial product data
    const productDataJSON = <?php echo json_encode($productdata); ?>;

    addInputButton.addEventListener('click', function() {
        const newRow = inputContainer.querySelector('.row').cloneNode(true);

        // Clear the product dropdown and quantity input in the cloned row
        newRow.querySelector('[name="pro[]"]').value = "";
        newRow.querySelector('[name="qt[]"]').value = "";

        // Append the cloned row to the input container
        inputContainer.appendChild(newRow);

        // Populate the product dropdown in the cloned row
        const productSelect = newRow.querySelector('[name="pro[]"]');
        productDataJSON.forEach(function(product) {
            const option = document.createElement('option');
            option.value = product.id;
            option.text = product.name;
            productSelect.appendChild(option);
        });
    });
});
</script>

<?php include('footer.php'); ?>
