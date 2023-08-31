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
    $consumptionID = $_GET['id'];

    // Retrieve the consumption details from the database
    $consumptionSql = "SELECT * FROM `consumption` WHERE id = :id";
    $consumptionStmt = $pdo->prepare($consumptionSql);
    $consumptionStmt->bindParam(':id', $consumptionID);
    $consumptionStmt->execute();
    $consumptionData = $consumptionStmt->fetch(PDO::FETCH_ASSOC);

    $oi = $pdo->query("SELECT * FROM consumptionitem WHERE consumption_id = ".$consumptionID."");
    $consumptionItem =$oi->fetchAll(PDO::FETCH_ASSOC);

    // Retrieve branch data for dropdown
    $branchSql = "SELECT * FROM branch WHERE status = 'Active'";
    $branchData = $pdo->query($branchSql);
    $typedata = $pdo->query("SELECT * FROM `type`WHERE status = 'Active'")->fetchAll(PDO::FETCH_ASSOC);
    $cuisinedata = $pdo->query("SELECT * FROM `cuisine`WHERE status = 'Active'")->fetchAll(PDO::FETCH_ASSOC);
    $categorydata = $pdo->query("SELECT * FROM `category`WHERE status = 'Active'")->fetchAll(PDO::FETCH_ASSOC);
    $productdata = $pdo->query("SELECT * FROM `product`WHERE status = 'Active'")->fetchAll(PDO::FETCH_ASSOC);
} else {
    header("Location: consumptions.php");
    exit();
}
?>

<div class="main-box">
    <h2>Edit consumption</h2>
    <hr>
    <form class="forms-sample" method="post" action="update-consumption.php">
    <div class="row">
        <input type="hidden" name="id" value="<?php echo $consumptionData['id']; ?>">

        <!-- Branch -->
        <div class="col-12 col-md-6 col-lg-3">
        <div class="form-group">
            <label for="branch">Branch</label>
            <select class="form-control" id="branch" name="branch">
                <?php foreach ($branchData as $branch) : ?>
                    <option value="<?php echo $branch['id']; ?>" <?php if ($consumptionData['branchid'] == $branch['id']) echo 'selected'; ?>>
                        <?php echo $branch['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        </div>
        <!-- Date -->       
        <div class="col-12 col-md-6 col-lg-3">
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" class="form-control" id="date" name="date" value="<?php echo $consumptionData['date_created']; ?>">
        </div>
        </div>
        </div>
        <!-- Additional product details rows -->
        <div class="pro-box">
                <?php  foreach($consumptionItem as $od) { ?>
                    <div class="row"> 
                    <div class="col-12 col-md-6 col-lg-2">
                    <div class="form-group">
                        <label for="exampleInputStatus">Type</label>
                        <select class="form-control mb-2" name="ty[]">
                            <?php foreach ($typedata as $row): ?>
                                <option value="<?= $row['id'] ?>" <?php if($row['id']=== $od['type_id']){echo 'selected';} ?>><?= $row['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-2">
                    <div class="form-group">
                        <label for="exampleInputStatus">Cuisine</label>
                        <select class="form-control mb-2" name="cu[]">
                            <?php foreach ($cuisinedata as $row): ?>
                                <option value="<?= $row['id'] ?>"<?php if($row['id']=== $od['cuisine_id']){echo 'selected';} ?>><?= $row['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-2">
                    <div class="form-group">
                        <label for="exampleInputStatus">Category</label>
                        <select class="form-control mb-2" name="ca[]">
                            <?php foreach ($categorydata as $row): ?>
                                <option value="<?= $row['id'] ?>"<?php if($row['id']=== $od['category_id']){echo 'selected';} ?>><?= $row['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-2">
                    <div class="form-group">
                        <label for="exampleInputStatus">Product</label>
                        <select class="form-control mb-2" name="pro[]">
                            <?php foreach ($productdata as $row): ?>
                                <option value="<?= $row['id'] ?>"<?php if($row['id']=== $od['product_id']){echo 'selected';} ?>><?= $row['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-2">
                    <label for="">Used-Qty</label>
                    <input class="form-control mb-2" name="qt[]" value="<?php echo $od['qty']; ?>">
                </div>
             
            </div>
                <?php } ?>
        </div >
       
        <!-- End of additional product details rows -->
        <div class="col-3">
            <a class="btn add-btn btn-success" id="addRow">+</a>
        </div><br><br><br>
        <input type="hidden" name="oid" value="<?php echo $consumptionID ?>">

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Update consumption</button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
        const addInputButton = document.querySelector('#addRow');
        const inputContainer = document.querySelector('.pro-box');
        


        addInputButton.addEventListener('click', function() {
        let inputCount = inputContainer.children.length;
        let inputEle = `<div class="row"> 
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
                    <label for="">Used-Qty</label>
                    <input class="form-control mb-2" name="qt[]">
                </div>
                 
            </div>`;
        const newInput = document.createElement('div');
        newInput.innerHTML = inputEle;
        inputContainer.appendChild(newInput);
        
  });
  
});

</script>

<?php include('footer.php'); ?>
