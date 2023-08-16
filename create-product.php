<?php
include('header.php');
include('menu.php');
require('db.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);



?>
<div class="main-box">
    <h2 class="mb-3">Create Products</h2>
    <hr>
    <form class="forms-sample" method="post" action="create-product-post.php">
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
    <label for="exampleInputName1">Price</label>
    <input type="text" class="form-control" name="price" id="exampleInputName1" placeholder="Name">
</div>
</div>
            <div class="col-6">
                <div class="form-group">
                    <label for="exampleInputStatus">Type</label>
                    <select class="form-control" name="type" id="exampleInputStatus">
                        <option value=""></option>
                        
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="exampleInputStatus">Category</label>
                    <select class="form-control" name="category" id="exampleInputStatus">
                        <option value=""></option>
                        <?php foreach ($category as $category): ?>
                            <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    

                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="exampleInputStatus">Cuisine</label>
                    <select class="form-control" name="cuisine" id="exampleInputStatus">
                        <option value=""></option>
                        
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="exampleInputStatus">Status</label>
                    <select class="form-control" name="status" id="exampleInputStatus">
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>
            </div>
            <div class="col-6">

                <div class="form-group">
                    <label for="exampleInputName1">image</label>
                    <input type="file" class="form-control" name="image" id="exampleInputName1" placeholder="Name">
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
