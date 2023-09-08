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
                <input type="text" id="role_id" class="form-control" name="role_name" require><br>
            <thead>
            <tr>
                <th>Role</th>
                <th>Access</th>
                <th>Create</th>
                <th>View</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Food Order</td>
                    <td><select class="form-control" name="fo_access">
                    <option value="0">Disable</option>
                    <option value="1">Enable</option></select></td>
                    <td><input value="1" type="checkbox" name="view_fo"></td>
                    <td><input value="2" type="checkbox" name="edit_fo"></td>
                    <td><input value="3" type="checkbox" name="create_fo"></td>
                    <td><input value="4" type="checkbox" name="delete_fo"></td>
                </tr>
                <tr>
                    <td>Stock Order</td>
                    <td><select class="form-control" name="so_access">
                    <option value="0">Disable</option>
                    <option value="1">Enable</option></select></td>
                    <td><input value="1" type="checkbox" name="view_so"></td>
                    <td><input value="2" type="checkbox" name="edit_so"></td>
                    <td><input value="3" type="checkbox" name="create_so"></td>
                    <td><input value="4" type="checkbox" name="delete_so"></td>
                </tr>
                <tr>
                    <td>Outdoor Order</td>
                    <td><select class="form-control" name="odo_access">
                    <option value="0">Disable</option>
                    <option value="1">Enable</option></select></td>
                    <td><input value="1" type="checkbox" name="view_odo"></td>
                    <td><input value="2" type="checkbox" name="edit_odo"></td>
                    <td><input value="3" type="checkbox" name="create_odo"></td>
                    <td><input value="4" type="checkbox" name="delete_odo"></td>
                </tr>
                <tr>
                    <td>Food Catalog</td>
                    <td><select class="form-control" name="fc_access">
                    <option value="0">Disable</option>
                    <option value="1">Enable</option></select></td>
                    <td><input value="1" type="checkbox" name="view_fc"></td>
                    <td><input value="2" type="checkbox" name="edit_fc"></td>
                    <td><input value="3" type="checkbox" name="create_fc"></td>
                    <td><input value="4" type="checkbox" name="delete_fc"></td>
                </tr>
                <tr>
                    <td>Stock Catalog</td>
                    <td><select class="form-control" name="sc_access">
                    <option value="0">Disable</option>
                    <option value="1">Enable</option></select></td>
                    <td><input value="1" type="checkbox" name="view_sc"></td>
                    <td><input value="2" type="checkbox" name="edit_sc"></td>
                    <td><input value="3" type="checkbox" name="create_sc"></td>
                    <td><input value="4" type="checkbox" name="delete_sc"></td>
                </tr>
                <tr>
                    <td>Closing Stock</td>
                    <td><select class="form-control" name="cs_access">
                    <option value="0">Disable</option>
                    <option value="1">Enable</option></select></td>
                    <td><input value="1" type="checkbox" name="view_cs"></td>
                    <td><input value="2" type="checkbox" name="edit_cs"></td>
                    <td><input value="3" type="checkbox" name="create_cs"></td>
                    <td><input value="4" type="checkbox" name="delete_cs"></td>
                </tr>
                <tr>
                    <td>Wastage</td>
                    <td><select class="form-control" name="w_access">
                    <option value="0">Disable</option>
                    <option value="1">Enable</option></select></td>
                    <td><input value="1" type="checkbox" name="create_waste"></td>
                    <td><input value="2" type="checkbox" name="view_waste"></td>
                    <td><input value="3" type="checkbox" name="edit_waste"></td>
                    <td><input value="4" type="checkbox" name="delete_waste"></td>
                </tr>
                <tr>
                    <td>Counter Closing</td>
                    <td><select class="form-control" name="cc_access">
                    <option value="0">Disable</option>
                    <option value="1">Enable</option></select></td>
                    <td><input value="1" type="checkbox" name="create_cc"></td>
                    <td><input value="2" type="checkbox" name="view_cc"></td>
                    <td><input value="3" type="checkbox" name="edit_cc"></td>
                    <td><input value="4" type="checkbox" name="delete_cc"></td>
                </tr>
                <tr>
                    <td>User</td>
                    <td><select class="form-control" name="user_access">
                    <option value="0">Disable</option>
                    <option value="1">Enable</option></select></td>
                    <td><input type="checkbox" name="create_user"></td>
                    <td><input type="checkbox" name="view_user"></td>
                    <td><input type="checkbox" name="edit_user"></td>
                    <td><input type="checkbox" name="delete_user"></td>
                </tr>
                <tr>
                    <td>Report</td>
                    <td><select class="form-control" name="r_access">
                    <option value="0">Disable</option>
                    <option value="1">Enable</option></select></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Dashboard</td>
                    <td><select class="form-control" name="d_access">
                    <option value="1">Disable</option>
                    <option value="0">Enable</option></select></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table><br>
        <button class="btn btn-primary" type="submit">Save Changes</button>
    </form>
    </div>
</div>

<?php
include('footer.php');
?>


