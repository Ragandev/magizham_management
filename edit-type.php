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
    $typeID = $_GET['id'];

    // Retrieve the type details from the database
    $typeSql = "SELECT * FROM type WHERE id = :id";
    $typeStmt = $pdo->prepare($typeSql);
    $typeStmt->bindParam(':id', $typeID);
    $typeStmt->execute();
    $typeData = $typeStmt->fetch(PDO::FETCH_ASSOC);
} else {
    header("Location: types.php");
    exit();
}
?>

<div class="main-box">
    <h2>Edit Type</h2>
    <hr>
    <form class="forms-sample" method="post" action="update-type.php">
        <div class="row">
            <input type="hidden" name="typeID" value="<?php echo $typeData['id']; ?>">
            <div class="col-12 col-md-6 col-lg-3">
                <div class="form-group">
                    <label for="exampleInputName1">Type Name</label>
                    <input type="text" class="form-control" name="type" id="exampleInputName1" value="<?php echo $typeData['name']; ?>">
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="form-group">
                    <label for="exampleInputStatus">Status</label>
                    <select class="form-control" name="status" id="exampleInputStatus">
                        <option value="active" <?php if ($typeData['status'] === 'active') echo 'selected'; ?>>Active</option>
                        <option value="inactive" <?php if ($typeData['status'] === 'inactive') echo 'selected'; ?>>Inactive</option>
                    </select>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mr-2">Update</button>
    </form>
</div>

<?php include('footer.php'); ?>
