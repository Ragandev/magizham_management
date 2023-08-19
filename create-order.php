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
          

            
                        <div class="row mb-4">
                            <div class="col">
                                <label for="">Type</label>
                                <input class="form-control mb-2" name="ty[]">
                            </div>
                            <div class="col">
                                <label for="">Cuisine</label>
                                <input class="form-control mb-2" name="cu[]">
                            </div>
                            <div class="col">
                                <label for="">Category</label>
                                <input class="form-control mb-2" name="ca[]">
                            </div>
                            <div class="col">
                                <label for="">Product</label>
                                <input class="form-control mb-2" name="pro[]">
                            </div>
                            <div class="col">
                                <label for="">Qty</label>
                                <input class="form-control mb-2" name="qt[]">
                            </div>
                          </div>
            
                        <div class="pro-box"></div>
                        <div>
                             <a class="btn add-btn btn-success">+</a>
                         </div><br><br><br>
            
                        
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                </form>
            </div>
</div>

<script>
        document.addEventListener('DOMContentLoaded', function() {
        const addInputButton = document.querySelector('.add-btn');
        const inputContainer = document.querySelector('.pro-box');
        

        // let inputCount = 1;

        addInputButton.addEventListener('click', function() {
        let inputEle = `<div class="row mb-4">
                <div class="col">
                    <label for="">Type</label>
                    <input class="form-control mb-2" name="ty[]">
                </div>
                <div class="col">
                    <label for="">Cuisine</label>
                    <input class="form-control mb-2" name="cu[]">
                </div>
                <div class="col">
                    <label for="">Category</label>
                    <input class="form-control mb-2" name="ca[]">
                </div>
                <div class="col">
                    <label for="">Product</label>
                    <input class="form-control mb-2" name="pro[]">
                </div>
                <div class="col">
                    <label for="">Qty</label>
                    <input class="form-control mb-2" name="qt[]">
                </div>
              </div>`;
        const newInput = document.createElement('div');
        newInput.innerHTML = inputEle;
        inputContainer.appendChild(newInput);
        // inputCount++;
        
  });
  
});
    </script>

<?php
include('footer.php');
?>
