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

        <!-- Waste Quantity -->
        <div class="form-group">
            <label for="waste_qty">Waste Quantity</label>
            <input type="number" class="form-control" id="waste_qty" name="waste_qty" value="<?php echo $wasteData['waste_qty']; ?>">
        </div>

        <!-- Waste Amount -->
        <div class="form-group">
            <label for="waste_amount">Waste Amount</label>
            <input type="number" class="form-control" id="waste_amount" name="waste_amount" value="<?php echo $wasteData['waste_amount']; ?>">
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Update Waste</button>
    </form>
</div>

<?php include('footer.php'); ?>
