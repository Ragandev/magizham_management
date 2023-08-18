<?php
include('header.php');
include('menu.php');
require('db.php');

$branchsql = "SELECT * FROM `branch`";
$branchdata = $pdo->query($branchsql);
?>
<div class="main-box">
    <h2 class="mb-3">Create Stock</h2>
    <hr>
    <form class="forms-sample" method="post" action="create-waste-post.php">
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
        <label for="exampleInputDate">Date</label>
        <input type="date" class="form-control" name="date" id="exampleInputDate">
    </div>
</div>

<div class="col-6">

<div class="form-group">
    <label for="exampleInputName1">Waste Qty</label>
    <input type="text" class="form-control" name="waste" id="exampleInputName1" placeholder="Enter Qty">
</div>
</div>
<div class="col-6">

<div class="form-group">
    <label for="exampleInputName1">Waste Amount</label>
    <input type="text" class="form-control" name="amount" id="exampleInputName1" placeholder="Enter amount">
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
