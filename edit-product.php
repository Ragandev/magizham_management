<?php
include('header.php');
include('menu.php');
require('db.php');

if (isset($_GET['id'])) {
    $productID = $_GET['id'];

    // Retrieve the product details from the database
    $productSql = "SELECT * FROM product WHERE id = :id";
    $productStmt = $pdo->prepare($productSql);
    $productStmt->bindParam(':id', $productID);
    $productStmt->execute();
    $productData = $productStmt->fetch(PDO::FETCH_ASSOC);

    $typesql = "SELECT * FROM `type`";
    $typedata = $pdo->query($typesql);
    $categorysql = "SELECT * FROM `category`";
    $categorydata = $pdo->query($categorysql);
    $cuisinesql = "SELECT * FROM `cuisine`";
    $cuisinedata = $pdo->query($cuisinesql);
} else {
    header("Location: products.php");
    exit();
}
?>

<div class="main-box">
    <h2>Edit Product</h2>
    <hr>
    <form class="forms-sample" method="post" action="update-product.php" enctype="multipart/form-data">
        <div class="row">
            <input type="hidden" name="productID" value="<?php echo $productData['id']; ?>">
            <div class="col-12 col-md-6 col-lg-3">
                <div class="form-group">
                    <label for="exampleInputName1">Product Name</label>
                    <input type="text" class="form-control" name="product" id="exampleInputName1" value="<?php echo $productData['name']; ?>">
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="form-group">
                    <label for="exampleInputStatus">Unit</label>
                    <select class="form-control" name="unit" id="exampleInputStatus">
                        <option value="kg" <?php if ($productData['unit'] === 'kg') echo 'selected'; ?>>kg</option>
                        <option value="Ltr" <?php if ($productData['unit'] === 'Ltr') echo 'selected'; ?>>Ltr</option>
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="form-group">
                    <label for="exampleInputStockQty">Stock Qty</label>
                    <input type="text" class="form-control" name="stock_qty" id="exampleInputStockQty" value="<?php echo $productData['stock_qty']; ?>">
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="form-group">
                    <label for="exampleInputPrice">Price</label>
                    <input type="text" class="form-control" name="price" id="exampleInputPrice" value="<?php echo $productData['price']; ?>">
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="form-group">
                    <label for="exampleInputType">Type</label>
                    <select class="form-control" name="type" id="exampleInputType">
                        <?php foreach ($typedata as $row): ?>
                            <option value="<?= $row['id'] ?>" <?php if ($productData['typeid'] === $row['id']) echo 'selected'; ?>><?= $row['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
            <div class="form-group">
                    <label for="exampleInputCategory">Category</label>
                    <select class="form-control" name="category" id="exampleInputCategory">
                        <?php foreach ($categorydata as $row): ?>
                            <option value="<?= $row['id'] ?>" <?php if ($productData['categoryid'] === $row['id']) echo 'selected'; ?>><?= $row['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>            </div>
                <div class="col-12 col-md-6 col-lg-3">
                <div class="form-group">
                    <label for="exampleInputCuisine">Cuisine</label>
                    <select class="form-control" name="cuisine" id="exampleInputCuisine">
                        <?php foreach ($cuisinedata as $row): ?>
                            <option value="<?= $row['id'] ?>" <?php if ($productData['cuisineid'] === $row['id']) echo 'selected'; ?>><?= $row['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div> 
            <div class="col-12 col-md-6 col-lg-3">
                <div class="form-group">
                    <label for="exampleInputStatus">Status</label>
                    <select class="form-control" name="status" id="exampleInputStatus">
                        <option value="active" <?php if ($productData['status'] === 'active') echo 'selected'; ?>>Active</option>
                        <option value="inactive" <?php if ($productData['status'] === 'inactive') echo 'selected'; ?>>Inactive</option>
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="form-group">
                    <label for="exampleInputImage">Image</label>
                    <label for="exampleInputImage">Image</label>
                    <input type="file" class="form-control" name="img1" id="exampleInputImage">
                    <input type="hidden" name="existing_img" value="<?php echo $productData['img']; ?>">
                </div>
            </div>
        </div>
            <!-- Continue with other form fields using the same structure -->
        </div>
        <button type="submit" class="btn btn-primary mr-2">Update</button>
    </form>
</div>

<?php include('footer.php'); ?>
