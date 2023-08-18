<?php
include('header.php');
include('menu.php');
require('db.php');

$branchsql = "SELECT * FROM `branch`";
$branchdata = $pdo->query($branchsql);
?>
<div class="main-box">
    <h2 class="mb-3">Create Orders</h2>
    <hr>
    <form class="forms-sample" method="post" action="create-order-post.php">
        <div class="row">
        
        <div class="col-6">
                <div class="form-group">
                    <label for="exampleInputStatus">Branch</label>
                    <select class="form-control" name="branch" id="exampleInputStatus">
       
                <?php foreach ($branchdata as $row): ?>
                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                    <?php endforeach; ?>
                 
                    </select>
                </div>
            </div>
            <div class="col-6">
    <div class="form-group">
        <label for="exampleInputDate">Order Date</label>
        <input type="date" class="form-control" name="orderDate" id="exampleInputDate">
    </div>
</div>
<div class="col-6">
    <div class="form-group">
        <label for="exampleInputDate">Delivery Date</label>
        <input type="date" class="form-control" name="deliveryDate" id="exampleInputDate">
    </div>
</div>

 
        
         
            <div class="col-6">
                <div class="form-group">
                    <label for="exampleInputStatus">Priority</label>
                    <select class="form-control" name="priority" id="exampleInputStatus">
                        <option value="Created">Created</option>
                        <option value="Accepted">Accepted</option>
                        <option value="Delivered">Delivered</option>
                        <option value="Received">Received</option>
                        <option value="Cancelled">Cancelled</option>
                        <option value="Rejected">Rejected</option>

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
         
            </div>
          

            </div>
            
        <button type="submit" class="btn btn-primary mr-2">Submit</button>
    </form>
</div>

<?php
include('footer.php');
?>
