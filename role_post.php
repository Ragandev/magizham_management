<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

// Include your database connection code here
require('db.php'); // Replace with your database connection code

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve data from the form
    $role_name = $_POST['role_name'];
    $fo_access = $_POST['fo_access'];
    $view_fo = isset($_POST['view_fo']) ? 1 : 0;
    $edit_fo = isset($_POST['edit_fo']) ? 1 : 0;
    $create_fo = isset($_POST['create_fo']) ? 1 : 0;
    $delete_fo = isset($_POST['delete_fo']) ? 1 : 0;
    $so_access = $_POST['so_access'];
    $view_so = isset($_POST['view_so']) ? 1 : 0;
    $edit_so = isset($_POST['edit_so']) ? 1 : 0;
    $create_so = isset($_POST['create_so']) ? 1 : 0;
    $delete_so = isset($_POST['delete_so']) ? 1 : 0;
    $odo_access = $_POST['odo_access'];
    $view_odo = isset($_POST['view_odo']) ? 1 : 0;
    $edit_odo = isset($_POST['edit_odo']) ? 1 : 0;
    $create_odo = isset($_POST['create_odo']) ? 1 : 0;
    $delete_odo = isset($_POST['delete_odo']) ? 1 : 0;
    $fc_access = $_POST['fc_access'];
    $view_fc = isset($_POST['view_fc']) ? 1 : 0;
    $edit_fc = isset($_POST['edit_fc']) ? 1 : 0;
    $create_fc = isset($_POST['create_fc']) ? 1 : 0;
    $delete_fc = isset($_POST['delete_fc']) ? 1 : 0;
    $sc_access = $_POST['sc_access'];
    $view_sc = isset($_POST['view_sc']) ? 1 : 0;
    $edit_sc = isset($_POST['edit_sc']) ? 1 : 0;
    $create_sc = isset($_POST['create_sc']) ? 1 : 0;
    $delete_sc = isset($_POST['delete_sc']) ? 1 : 0;
    $cs_access = $_POST['cs_access'];
    $view_cs = isset($_POST['view_cs']) ? 1 : 0;
    $edit_cs = isset($_POST['edit_cs']) ? 1 : 0;
    $create_cs = isset($_POST['create_cs']) ? 1 : 0;
    $delete_cs = isset($_POST['delete_cs']) ? 1 : 0;
    $w_access = $_POST['w_access'];
    $create_waste = isset($_POST['create_waste']) ? 1 : 0;
    $view_waste = isset($_POST['view_waste']) ? 1 : 0;
    $edit_waste = isset($_POST['edit_waste']) ? 1 : 0;
    $delete_waste = isset($_POST['delete_waste']) ? 1 : 0;
    $cc_access = $_POST['cc_access'];
    $create_cc = isset($_POST['create_cc']) ? 1 : 0;
    $view_cc = isset($_POST['view_cc']) ? 1 : 0;
    $edit_cc = isset($_POST['edit_cc']) ? 1 : 0;
    $delete_cc = isset($_POST['delete_cc']) ? 1 : 0;
    $user_access = $_POST['user_access'];
    $create_user = isset($_POST['create_user']) ? 1 : 0;
    $view_user = isset($_POST['view_user']) ? 1 : 0;
    $edit_user = isset($_POST['edit_user']) ? 1 : 0;
    $delete_user = isset($_POST['delete_user']) ? 1 : 0;
    $r_access = $_POST['r_access'];
    $d_access = $_POST['d_access'];
    // ... (all other form fields)

    // Create a prepared statement to insert the data
    $sql = "INSERT INTO role (role_name, fo_access, view_fo, edit_fo, create_fo, delete_fo, so_access, view_so, edit_so, create_so, delete_so, odo_access, view_odo, edit_odo, create_odo, delete_odo, 
     fc_access, view_fc, edit_fc, create_fc, delete_fc, sc_access, view_sc, edit_sc, create_sc, delete_sc, cs_access, view_cs, edit_cs, create_cs, delete_cs,
     w_access, create_waste, view_waste, edit_waste, delete_waste, cc_access, create_cc, view_cc, edit_cc, delete_cc, user_access,
     create_user, view_user, edit_user, delete_user, r_access, d_access)
     VALUES (:role_name, :fo_access, :view_fo, :edit_fo, :create_fo, :delete_fo, :so_access, :view_so, :edit_so, :create_so, :delete_so, :odo_access, :view_odo, :edit_odo, :create_odo, :delete_odo,
     :fc_access, :view_fc, :edit_fc, :create_fc, :delete_fc, :sc_access, :view_sc, :edit_sc, :create_sc, :delete_sc, :cs_access, :view_cs, :edit_cs, :create_cs, :delete_cs,
     :w_access, :create_waste, :view_waste, :edit_waste, :delete_waste, :cc_access, :create_cc, :view_cc, :edit_cc, :delete_cc, :user_access,
     :create_user, :view_user, :edit_user, :delete_user, :r_access, :d_access)";

    $stmt = $pdo->prepare($sql);

    if ($stmt) {
        // Continue binding other form fields to the prepared statement
$stmt->bindParam(':role_name', $role_name);
$stmt->bindParam(':fo_access', $fo_access);
$stmt->bindParam(':view_fo', $view_fo);
$stmt->bindParam(':edit_fo', $edit_fo);
$stmt->bindParam(':create_fo', $create_fo);
$stmt->bindParam(':delete_fo', $delete_fo);
$stmt->bindParam(':so_access', $so_access);
$stmt->bindParam(':view_so', $view_so);
$stmt->bindParam(':edit_so', $edit_so);
$stmt->bindParam(':create_so', $create_so);
$stmt->bindParam(':delete_so', $delete_so);
$stmt->bindParam(':odo_access', $odo_access);
$stmt->bindParam(':view_odo', $view_odo);
$stmt->bindParam(':edit_odo', $edit_odo);
$stmt->bindParam(':create_odo', $create_odo);
$stmt->bindParam(':delete_odo', $delete_odo);
$stmt->bindParam(':fc_access', $fc_access);
$stmt->bindParam(':view_fc', $view_fc);
$stmt->bindParam(':edit_fc', $edit_fc);
$stmt->bindParam(':create_fc', $create_fc);
$stmt->bindParam(':delete_fc', $delete_fc);
$stmt->bindParam(':sc_access', $sc_access);
$stmt->bindParam(':view_sc', $view_sc);
$stmt->bindParam(':edit_sc', $edit_sc);
$stmt->bindParam(':create_sc', $create_sc);
$stmt->bindParam(':delete_sc', $delete_sc);
$stmt->bindParam(':cs_access', $cs_access);
$stmt->bindParam(':view_cs', $view_cs);
$stmt->bindParam(':edit_cs', $edit_cs);
$stmt->bindParam(':create_cs', $create_cs);
$stmt->bindParam(':delete_cs', $delete_cs);
$stmt->bindParam(':w_access', $w_access);
$stmt->bindParam(':create_waste', $create_waste);
$stmt->bindParam(':view_waste', $view_waste);
$stmt->bindParam(':edit_waste', $edit_waste);
$stmt->bindParam(':delete_waste', $delete_waste);
$stmt->bindParam(':cc_access', $cc_access);
$stmt->bindParam(':create_cc', $create_cc);
$stmt->bindParam(':view_cc', $view_cc);
$stmt->bindParam(':edit_cc', $edit_cc);
$stmt->bindParam(':delete_cc', $delete_cc);
$stmt->bindParam(':user_access', $user_access);
$stmt->bindParam(':create_user', $create_user);
$stmt->bindParam(':view_user', $view_user);
$stmt->bindParam(':d_access', $d_access);
$stmt->bindParam(':edit_user', $edit_user);
$stmt->bindParam(':delete_user', $delete_user);
$stmt->bindParam(':r_access', $r_access);


        if ($stmt->execute()) {
            // Data has been successfully inserted
            header("Location: role.php"); // Redirect to a page showing all roles
            exit();
        } else {
            // Handle the error (e.g., display an error message)
            echo "Error: " . $stmt->errorInfo()[2];
        }
    } else {
        // Handle the statement preparation error
        echo "Error: " . $pdo->errorInfo()[2];
    }
}
?>
