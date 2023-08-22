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
    $wasteID = $_GET['id'];

    // Retrieve the waste details from the database
    $wasteSql = "SELECT * FROM `waste` WHERE id = :id";
    $wasteStmt = $pdo->prepare($wasteSql);
    $wasteStmt->bindParam(':id', $wasteID);
    $wasteStmt->execute();
    $wasteData = $wasteStmt->fetch(PDO::FETCH_ASSOC);

    // Retrieve branch data for dropdown
    $branchSql = "SELECT * FROM branch";
    $branchData = $pdo->query($branchSql);
    $typedata = $pdo->query("SELECT * FROM `type`")->fetchAll(PDO::FETCH_ASSOC);
$cuisinedata = $pdo->query("SELECT * FROM `cuisine`")->fetchAll(PDO::FETCH_ASSOC);
$categorydata = $pdo->query("SELECT * FROM `category`")->fetchAll(PDO::FETCH_ASSOC);
$productdata = $pdo->query("SELECT * FROM `product`")->fetchAll(PDO::FETCH_ASSOC);
} else {
    header("Location: wastes.php");
    exit();
}
?>

<div class="main-box">
    <h2>Edit Waste</h2>
    <hr>
    <form class="forms-sample" method="post" action="update-waste.php">
        <input type="hidden" name="id" value="<?php echo $wasteData['id']; ?>">

        <!-- Branch -->
        <div class="form-group">
            <label for="branch">Branch</label>
            <select class="form-control" id="branch" name="branch">
                <?php foreach ($branchData as $branch) : ?>
                    <option value="<?php echo $branch['id']; ?>" <?php if ($wasteData['branchid'] == $branch['id']) echo 'selected'; ?>>
                        <?php echo $branch['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Date -->
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" class="form-control" id="date" name="date" value="<?php echo $wasteData['date']; ?>">
        </div>

        <!-- Waste Amount -->
        <div class="form-group">
            <label for="waste_amount">Waste Amount</label>
            <input type="number" class="form-control" id="waste_amount" name="waste_amount" value="<?php echo $wasteData['waste_amount']; ?>">
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

            </div>

          </div>
            
    </form>
</div>

<?php include('footer.php'); ?>
