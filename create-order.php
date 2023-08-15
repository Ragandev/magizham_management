<?php
include('header.php');
include('menu.php');
?>
<div class="main-box">
    <h2 class="mb-3">Create Orders</h2>
    <hr>
    <form class="forms-sample" method="post" action="create-order-post.php">
        <div class="row">
        
          
            <div class="col-6">

<div class="form-group">
    <label for="exampleInputName1">Product Name  </label>
    <input type="text" class="form-control" name="product" id="exampleInputName1" placeholder="Name">
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
        <input type="date" class="form-control" name="orderDate" id="exampleInputDate">
    </div>
</div>

 
        
         
            <div class="col-6">
                <div class="form-group">
                    <label for="exampleInputStatus">Priority</label>
                    <select class="form-control" name="status" id="exampleInputStatus">
                        <option value="Active">Created</option>
                        <option value="Inactive">Accepted</option>
                        <option value="Inactive">Delivered</option>
                        <option value="Inactive">Received</option>
                        <option value="Inactive">Cancelled</option>
                        <option value="Inactive">Rejected</option>

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
