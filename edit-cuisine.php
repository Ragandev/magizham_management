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
    $cuisineID = $_GET['id'];

    // Retrieve the cuisine details from the database
    $cuisineSql = "SELECT * FROM cuisine WHERE id = :id";
    $cuisineStmt = $pdo->prepare($cuisineSql);
    $cuisineStmt->bindParam(':id', $cuisineID);
    $cuisineStmt->execute();
    $cuisineData = $cuisineStmt->fetch(PDO::FETCH_ASSOC);
} else {
    header("Location: cuisines.php");
    exit();
}
?>

<div class="main-box">
    <h2>Edit Cuisine</h2>
    <hr>
    <form class="forms-sample" method="post" action="update-cuisine.php">
    <div class="row">
    <div class="col-12 col-md-6 col-lg-3">
        <div class="form-group">
            <input type="hidden" name="cuisineID" value="<?php echo $cuisineData['id']; ?>">
            <label for="cuisineName">Cuisine Name</label>
            <input type="text" class="form-control" id="cuisineName" name="cuisine_name" value="<?php echo $cuisineData['name']; ?>">
        </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status">
                <option value="active" <?php if ($cuisineData['status'] === 'active') echo 'selected'; ?>>Active</option>
                <option value="inactive" <?php if ($cuisineData['status'] === 'inactive') echo 'selected'; ?>>Inactive</option>
            </select>
        </div>
        </div>
        </div>
        <button type="submit" class="btn btn-primary">Update Cuisine</button>
    </form>
</div>

<?php include('footer.php'); ?>
