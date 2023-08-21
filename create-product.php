<?php
include('header.php');
include('menu.php');
require('db.php');

$typesql = "SELECT * FROM `type`";
$typedata = $pdo->query($typesql);

$categorysql = "SELECT * FROM `category`";
$categorydata = $pdo->query($categorysql);
$cuisinesql = "SELECT * FROM `cuisine`";
$cuisinedata = $pdo->query($cuisinesql);
                
?>
<div class="main-box">
    <h2 class="mb-3">Create Products</h2>
    <hr>
    <form class="forms-sample" method="post" action="create-product-post.php" enctype="multipart/form-data">
        <div class="row">
        
            <div class="col-6">

                <div class="form-group">
                    <label for="exampleInputName1">Product Name</label>
                    <input type="text" class="form-control" name="product" id="exampleInputName1" placeholder="Name">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="exampleInputStatus">Unit</label>
                    <select class="form-control" name="unit" id="exampleInputStatus">
                        <option value="kg">kg</option>
                        <option value="Ltr">Ltr</option>
                    </select>
                </div>
            </div>
            <div class="col-6">
            <div class="form-group">
    <label for="exampleInputName1">Stock_qty</label>
    <input type="text" class="form-control" name="stock_qty" id="exampleInputName1" placeholder="Enter qty">
</div>
</div>
<div class="col-6">
<div class="form-group">
    <label for="exampleInputName1">Price</label>
    <input type="text" class="form-control" name="price" id="exampleInputName1" placeholder="price">
</div>
</div>
            <div class="col-6">
                <div class="form-group">
                    <label for="exampleInputStatus">Type</label>
                    <select class="form-control" name="type" id="exampleInputStatus">
       
                <?php foreach ($typedata as $row): ?>
                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                    <?php endforeach; ?>
                 
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="exampleInputStatus">Category</label>
                    <select class="form-control" name="category" id="exampleInputStatus">

                        <option value=""></option>

                <?php foreach ($categorydata as $row): ?>
                <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                <?php endforeach; ?>
                </select>
                    

                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="exampleInputStatus">Cuisine</label>
                    <select class="form-control" name="cuisine" id="exampleInputStatus">
                        <option value=""></option>
                        
                        <?php foreach ($cuisinedata as $row): ?>
                <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="exampleInputStatus">Status</label>
                    <select class="form-control" name="status" id="exampleInputStatus">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>
            <div class="col-6">

                <div class="form-group">
                    <label for="exampleInputName1">image</label>
                    <input type="file" class="form-control" name="img1" id="exampleInputName1" placeholder="Name">
                </div>
            </div>
            </div>
          

            </div>
            
        <button type="submit" class="btn btn-primary mr-2">Submit</button>
    </form>
</div>

<?php
include('footer.php');
?>
