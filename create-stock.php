<?php
include('header.php');
include('menu.php');
require('db.php');

$branchsql = "SELECT * FROM `branch`WHERE status = 'Active'";
$branchdata = $pdo->query($branchsql);
$typedata = $pdo->query("SELECT * FROM `type`WHERE status = 'Active'")->fetchAll(PDO::FETCH_ASSOC);
$cuisinedata = $pdo->query("SELECT * FROM `cuisine`WHERE status = 'Active'")->fetchAll(PDO::FETCH_ASSOC);
$categorydata = $pdo->query("SELECT * FROM `category`WHERE status = 'Active'")->fetchAll(PDO::FETCH_ASSOC);
$productdata = $pdo->query("SELECT * FROM `product`WHERE status = 'Active'")->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="main-box">
    <h2 class="mb-3">Create Stock</h2>
    <hr>
    <form class="forms-sample" method="post" action="create-stock-post.php">
        <div class="row">

        <div class="col-12 col-md-6 col-lg-3">
                <div class="form-group">
                    <label for="exampleInputStatus">Branch</label>
                    <select class="form-control" name="branch" id="exampleInputStatus">
       
                <?php foreach ($branchdata as $row): ?>
                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                    <?php endforeach; ?>
                 
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
    <div class="form-group">
        <label for="exampleInputDate">Date</label>
        <input type="date" class="form-control" name="date" id="exampleInputDate">
    </div>
</div>
 
            </div>
              
        <!-- Additional product details rows -->
        <div class="pro-box">
            <div class="row mb-4">
            <div class="col-12 col-md-6 col-lg-2">
                    <div class="form-group">
                        <label for="exampleInputStatus">Type</label>
                        <select class="form-control mb-2" name="ty[]">
                            <?php foreach ($typedata as $row): ?>
                                <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-2">
                    <div class="form-group">
                        <label for="exampleInputStatus">Cuisine</label>
                        <select class="form-control mb-2" name="cu[]">
                            <?php foreach ($cuisinedata as $row): ?>
                                <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-2">
                    <div class="form-group">
                        <label for="exampleInputStatus">Category</label>
                        <select class="form-control mb-2" name="ca[]">
                            <?php foreach ($categorydata as $row): ?>
                                <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-2">
                    <div class="form-group">
                        <label for="exampleInputStatus">Product</label>
                        <select class="form-control mb-2" name="pro[]">
                            <?php foreach ($productdata as $row): ?>
                                <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-2">
                    <label for="">Stock-Qty</label>
                    <input class="form-control mb-2" name="qt[]">
                </div>
             
           
            </div>
        </div>
        <!-- End of additional product details rows -->

        <div>
            <a class="btn add-btn btn-success" id="addRow">+</a>
        </div><br><br><br>
        <button type="submit" class="btn btn-primary mr-2">Submit</button>

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
        
        // Hide labels in the cloned row
        const labels = newRow.querySelectorAll('label');
        labels.forEach(function(label) {
            label.style.display = 'none';
        });


        // Populate the product dropdown in the cloned row
        const productSelect = newRow.querySelector('[name="pro[]"]');
        productSelect.innerHTML = ''; // Clear existing options before populating
        productDataJSON.forEach(function(product) {
            const option = document.createElement('option');
            option.value = product.id;
            option.text = product.name;
            productSelect.appendChild(option);
        });

        // Append the cloned row to the input container
        inputContainer.appendChild(newRow);
    });
});
</script>
<?php
include('footer.php');
?>
