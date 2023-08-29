<?php
include('header.php');
include('menu.php');
require('db.php');

$typesql = "SELECT * FROM `type`";
$typedata = $pdo->query($typesql);
?>
<div class="main-box">
    <h2 class="mb-3">Create Category</h2>
    <hr>
    <form class="forms-sample" method="post" action="create-category-post.php">
        <div class="row">
        
        <div class="col-12 col-md-6 col-lg-3">

         <div class="form-group">
         <label for="exampleInputName1">Name</label>
        <input type="text" class="form-control" name="categoryname" id="exampleInputName1" placeholder="Enter category Name">
        </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
                <div class="form-group">
                    <label for="exampleInputStatus">Type</label>
                    <select class="form-control" name="type" id="exampleInputStatus">
       
                <?php foreach ($typedata as $row): ?>
                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                    <?php endforeach; ?>
                 
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="form-group">
                    <label for="exampleInputStatus">Status</label>
                    <select class="form-control" name="status" id="exampleInputStatus">
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>
            </div>
        

</div>
<button type="submit" class="btn btn-primary mr-2">Submit</button>

    </form>
</div>

<?php
include('footer.php');
?>
