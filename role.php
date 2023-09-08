<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
include('header.php');
include('menu.php');
require('db.php');

?>


<div class="container">
    <h3>Roles & Permission</h3><br>
    <div class="main-box">
        <table class="table table-bordered table-responsive-lg table-striped">
            <form action="role_post.php" method="POST">
                <label for="role_id">Role Name</label>
                <input type="text" id="role_id" class="form-control" name="role_name"><br>
                
            <thead>
            <tr>
                <th>Role</th>
                <th>Create</th>
                <th>View</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Order</td>
                    <td><input value="1" type="checkbox" name="view_order"></td>
                    <td><input value="1" type="checkbox" name="edit_order"></td>
                    <td><input value="1" type="checkbox" name="create_order"></td>
                    <td><input value="1" type="checkbox" name="delete_order"></td>
                </tr>
                <tr>
                    <td>Stock</td>
                    <td><input type="checkbox" name="create_stock"></td>
                    <td><input type="checkbox" name="view_stock"></td>
                    <td><input type="checkbox" name="edit_stock"></td>
                    <td><input type="checkbox" name="delete_stock"></td>
                </tr>
                <tr>
                    <td>Waste</td>
                    <td><input type="checkbox" name="create_waste"></td>
                    <td><input type="checkbox" name="view_waste"></td>
                    <td><input type="checkbox" name="edit_waste"></td>
                    <td><input type="checkbox" name="delete_waste"></td>
                </tr>
                <tr>
                    <td>Products</td>
                    <td><input type="checkbox" name="create_product"></td>
                    <td><input type="checkbox" name="view_product"></td>
                    <td><input type="checkbox" name="edit_product"></td>
                    <td><input type="checkbox" name="delete_product"></td>
                </tr>
                <tr>
                    <td>User</td>
                    <td><input type="checkbox" name="create_user"></td>
                    <td><input type="checkbox" name="view_user"></td>
                    <td><input type="checkbox" name="edit_user"></td>
                    <td><input type="checkbox" name="delete_user"></td>
                </tr>
                <tr>
                    <td>Report</td>
                    <td><input type="checkbox" name="create_report"></td>
                    <td><input type="checkbox" name="view_report"></td>
                    <td><input type="checkbox" name="edit_report"></td>
                    <td><input type="checkbox" name="delete_report"></td>
                </tr>
            </tbody>
        </table><br>
        <button type="submit">Submit</button>
    </form>
    </div>
</div>

<?php
include('footer.php');
?>


