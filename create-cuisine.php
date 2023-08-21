<?php
include('header.php');
include('menu.php');
?>
<div class="main-box">
    <h2 class="mb-3">Create Cuisine</h2>
    <hr>
    <form class="forms-sample" method="post" action="create-cuisine-post.php">
        <div class="row">
        

         <div class="form-group">
         <label for="exampleInputName1">Name</label>
        <input type="text" class="form-control" name="cuisinename" id="exampleInputName1" placeholder="Enter cuisine Name">
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
           
        <button type="submit" class="btn btn-primary mr-2">Submit</button>
    </form>
</div>

<?php
include('footer.php');
?>
