<?php
include('header.php');
include('menu.php');
require('db.php');
$branchsql = "SELECT * FROM `branch`";
$branchdata = $pdo->query($branchsql);
$typedata = $pdo->query("SELECT * FROM `type`")->fetchAll(PDO::FETCH_ASSOC);
$cuisinedata = $pdo->query("SELECT * FROM `cuisine`")->fetchAll(PDO::FETCH_ASSOC);
$categorydata = $pdo->query("SELECT * FROM `category`")->fetchAll(PDO::FETCH_ASSOC);
$productdata = $pdo->query("SELECT * FROM `product`")->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="main-box">
    <h2 class="mb-3">Create Orders</h2>
    <hr>
    <form class="forms-sample" method="post" action="create-order-post.php">
        <!-- Branch, Order Date, Delivery Date, Priority, Status fields ... -->
        <div class="row">
        
        <div class="col-6">
                <div class="form-group">
                    <label for="exampleInputStatus">Branch</label>
                    <select class="form-control" name="branch" id="exampleInputStatus">
       
                <?php foreach ($branchdata as $row): ?>
                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                    <?php endforeach; ?>
                 
                    </select>
                </div>
            </div>
            <div class="col-6">
    <div class="form-group">
        <label for="exampleInputDate">Order Date</label>
        <input type="date" class="form-control" name="orderDate" id="exampleInputDate">
    </div>
</div>
<div class="col-6">
    <div class="form-group">
        <label for="exampleInputDate">Delivery Date</label>
        <input type="date" class="form-control" name="deliveryDate" id="exampleInputDate">
    </div>
</div>

 
        
         
            <div class="col-6">
                <div class="form-group">
                    <label for="exampleInputStatus">Priority</label>
                    <select class="form-control" name="priority" id="exampleInputStatus">
                        <option value="Created">Created</option>
                        <option value="Accepted">Accepted</option>
                        <option value="Delivered">Delivered</option>
                        <option value="Received">Received</option>
                        <option value="Cancelled">Cancelled</option>
                        <option value="Rejected">Rejected</option>

                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="exampleInputStatus">Status</label>
                    <select class="form-control" name="status" id="exampleInputStatus">
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>
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

        <button type="submit" class="btn btn-primary mr-2">Submit</button>
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

<?php
include('footer.php');
?>
