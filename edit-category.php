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
    $categoryId = $_GET['id'];

    // Retrieve the category details from the database
    $categorySql = "SELECT * FROM category WHERE id = :id";
    $categoryStmt = $pdo->prepare($categorySql);
    $categoryStmt->bindParam(':id', $categoryId);
    $categoryStmt->execute();
    $categoryData = $categoryStmt->fetch(PDO::FETCH_ASSOC);
} else {
    header("Location: categories.php");
    exit();
}
?>

<div class="main-box">
    <h2>Edit Category</h2>
    <hr>
    <form class="forms-sample" method="post" action="update-category.php">
    <div class="row">
    <div class="col-12 col-md-6 col-lg-3">
        <div class="form-group">
            <input type="hidden" name="categoryId" value="<?php echo $categoryData['id']; ?>">
            <label for="exampleInputName1">Category Name</label>
            <input type="text" class="form-control" name="category" id="exampleInputName1" value="<?php echo $categoryData['name']; ?>">
        </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
        <div class="form-group">
            <label for="exampleInputStatus">Status</label>
            <select class="form-control" name="status" id="exampleInputStatus">
                <option value="active" <?php if ($categoryData['status'] === 'active') echo 'selected'; ?>>Active</option>
                <option value="inactive" <?php if ($categoryData['status'] === 'inactive') echo 'selected'; ?>>Inactive</option>
            </select>
        </div>
        </div>
        </div>
        <button type="submit" class="btn btn-primary mr-2">Update</button>

    </form>
</div>

<?php include('footer.php'); ?>
