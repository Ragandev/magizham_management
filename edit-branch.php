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
    $branchID = $_GET['id'];

    // Retrieve the branch details from the database
    $branchSql = "SELECT * FROM branch WHERE id = :id";
    $branchStmt = $pdo->prepare($branchSql);
    $branchStmt->bindParam(':id', $branchID);
    $branchStmt->execute();
    $branchData = $branchStmt->fetch(PDO::FETCH_ASSOC);
} else {
    header("Location: branches.php");
    exit();
}
?>

<div class="main-box">
    <h2>Edit Branch</h2>
    <hr>
            <div class="row">

    <form class="forms-sample" method="post" action="update-branch.php">
    <div class="row">

    <div class="col-6">

        <div class="form-group">
            <input type="hidden" name="branchID" value="<?php echo $branchData['id']; ?>">
            <label for="exampleInputName">Branch Name</label>
            <input type="text" class="form-control" name="name" id="exampleInputName" value="<?php echo $branchData['name']; ?>">
        </div>
        </div>
        <div class="col-6">
        <div class="form-group">
            <label for="exampleInputAddress">Address</label>
            <input type="text" class="form-control" name="address" id="exampleInputAddress" value="<?php echo $branchData['address']; ?>">
        </div>
        </div>
        <div class="col-6">
        <div class="form-group">
            <label for="exampleInputPhone">Phone</label>
            <input type="text" class="form-control" name="phone" id="exampleInputPhone" value="<?php echo $branchData['phone']; ?>">
        </div>
        </div>     
           <div class="col-6">
        <div class="form-group">
            <label for="exampleInputStatus">Status</label>
            <select class="form-control" name="status" id="exampleInputStatus">
                <option value="active" <?php if ($branchData['status'] === 'active') echo 'selected'; ?>>Active</option>
                <option value="inactive" <?php if ($branchData['status'] === 'inactive') echo 'selected'; ?>>Inactive</option>
            </select>
        </div>
        </div>     
        <button type="submit" class="btn btn-primary mr-2">Update</button>
        </div>
    </form>
</div>

<?php include('footer.php'); ?>
