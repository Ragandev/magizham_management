<style>
  .typcn {
    font-size: 22px; 
  }
</style>
<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
include('header.php');
include('menu.php');
require('db.php');

$counterSql = "SELECT * FROM counter";
$counterData = $pdo->query($counterSql);

$logUser = $_SESSION['user'];
?>
<div class="main-box">
    <div class="d-flex justify-content-end mb-5">
        <a href="counter_create.php">
            <button class="btn btn-success">Create</button>
        </a>
    </div>

    <?php if (!empty($_GET['succ'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>
                <?php echo $_GET['succ'] ?>
            </strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif ?>
    <?php if (!empty($_GET['err'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>
                <?php echo $_GET['err'] ?>
            </strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif ?>

    <h2 class="mb-3">Counter Closing</h2>

    <?php

    if ($counterData) { ?>
        <div class='table-responsive'>
        <table class='table table-hover'>
        <thead> <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Branch</th>
            <th>Shortage</th>
            <th>Excess</th>
            <th>Accounts</th>
            <th>Status</th>
            <th>Action</th>

        </tr> </thead>
        <tbody>
        <?php foreach ($counterData as $row) { ?>
             <tr>
            <td><?php echo $row['id'] ?> </td>
            <td><?php echo $row['date'] ?> </td>
            <td><?php echo $row['branch'] ?> </td>
            <td><?php echo $row['shortage'] ?> </td>
            <td><?php echo $row['excess'] ?> </td>
            <td><?php echo $row['acc_dep'] ?> </td>
            <td><?php echo $row['status'] ?> </td>
            <td>
            <a href='counter_edit.php?id=<?php $row["id"]?> '><i class=' typcn typcn-edit'></i></i></a>
            <a href='counter_delete.php?delete_id=<?php $row["id"]?> ' class='text-danger' onclick='return confirmDelete()'><i class='  typcn typcn-trash'></i></a>
        </td>
        </tr> 
        <?php } ?>
        </tbody>
       </table>
        </div>
    <?php } else {
        echo "Error fetching data";
    }
    ?>

</div>

<?php
include('footer.php');
?>
<script>
function confirmDelete() {
    return confirm("Are you sure you want to delete this order?");
}
</script>