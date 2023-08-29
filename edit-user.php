<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
include('header.php');
include('menu.php');
require('db.php');

if (isset($_GET['id'])) {
    $userID = $_GET['id'];

    // Retrieve the user details from the database
    $userSql = "SELECT * FROM user WHERE id = :id";
    $userStmt = $pdo->prepare($userSql);
    $userStmt->bindParam(':id', $userID);
    $userStmt->execute();
    $userData = $userStmt->fetch(PDO::FETCH_ASSOC);
} else {
    header("Location: users.php");
    exit();
}
$branchsql = "SELECT * FROM `branch`";
$branchdata = $pdo->query($branchsql);
?>

<div class="main-box">
    <h2>Edit User</h2>
    <hr>
    <form class="forms-sample" method="post" action="update-user.php">
        <div class="row">
            <input type="hidden" name="userID" value="<?php echo $userData['id']; ?>">
            <div class="col-12 col-md-6 col-lg-3">
                <div class="form-group">
                    <label for="exampleInputName">Name</label>
                    <input type="text" class="form-control" name="name" id="exampleInputName" value="<?php echo $userData['name']; ?>">
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="form-group">
                    <label for="exampleInputUsername">Username</label>
                    <input type="text" class="form-control" name="username" id="exampleInputUsername" value="<?php echo $userData['username']; ?>">
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
            <div class="form-group">
                    <label for="exampleSelectGender">Branch</label>
                    <select class="form-control" id="exampleSelectGender" name="branch">
                        
                <?php foreach ($branchdata as $row): ?>
                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="form-group">
                    <label for="exampleInputRole">Role</label>
                    <input type="text" class="form-control" name="role" id="exampleInputRole" value="<?php echo $userData['role']; ?>">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mr-2">Update</button>
    </form>
</div>

<?php include('footer.php'); ?>
