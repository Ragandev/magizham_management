<?php
include('header.php');
include('menu.php');
?>
<div class="main-box">
    <h2 class="mb-3">Create User</h2>
    <hr>
    <form class="forms-sample" method="post" action="create-branch-post.php">
        <div class="row">
        
            <div class="col-6">

                <div class="form-group">
                    <label for="exampleInputName1">Branch Name</label>
                    <input type="text" class="form-control" name="branch" id="exampleInputName1" placeholder="Name">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="exampleInputEmail3">Address</label>
                    <input type="text" class="form-control" name="address" id="exampleInputEmail3" placeholder="Address">
                </div>

            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="exampleInputPassword4">phone</label>
                    <input type="password" class="form-control" name="phone" id="exampleInputPassword4" placeholder="Phone">
                </div>

            </div>
          

            </div>
            
        <button type="submit" class="btn btn-primary mr-2">Submit</button>
    </form>
</div>

<?php
include('footer.php');
?>