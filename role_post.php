<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
include('header.php');
include('menu.php');
require('db.php');

if(isset($_POST)){
    $role_name = $_POST['role_name'];
    $create_order = $_POST['create_order'];
    $view_order = $_POST['view_order'];
    $edit_order = $_POST['edit_order'];
    $delete_order = $_POST['delete_order'];
    // $create_stock = $_POST['create_stock'];
    // $view_stock = $_POST['view_stock'];
    // $edit_stock = $_POST['edit_stock'];
    // $delete_stock = $_POST['delete_stock'];
    // $create_waste = $_POST['create_waste'];
    // $view_waste = $_POST['view_waste'];
    // $edit_waste = $_POST['edit_waste'];
    // $delete_waste = $_POST['delete_waste'];
    // $create_product = $_POST['create_product'];
    // $view_product = $_POST['view_product'];
    // $edit_product = $_POST['edit_product'];
    // $delete_product = $_POST['delete_product'];
    // $create_user = $_POST['create_user'];
    // $view_user = $_POST['view_user'];
    // $edit_user = $_POST['edit_user'];
    // $delete_user = $_POST['delete_user'];
    // $create_report = $_POST['create_report'];
    // $view_report = $_POST['view_report'];
    // $edit_report = $_POST['edit_report'];
    // $delete_report = $_POST['delete_report'];

    if(empty($role_name)){
        echo 'Role Name should be filled';
        exit();
    }

    $roleSql = "INSERT INTO `role` (";

    if(isset($create_order)){
        $roleSql .= "create_order,";
    }

    if(isset($view_order)){
        $roleSql .= "view_order,";
    }

    if(isset($edit_order)){
        $roleSql .= "edit_order,";
    }

    if(isset($delete_order)){
        $roleSql .= "delete_order";
    }

    $roleSql .= ") VALUES (";

    if(isset($create_order)){
        $roleSql .= ":create_order,";
    }

    if(isset($view_order)){
        $roleSql .= ":view_order,";
    }

    if(isset($edit_order)){
        $roleSql .= ":edit_order,";
    }

    if(isset($delete_order)){
        $roleSql .= ":delete_order";
    }

    $roleSql .= ")";

    echo $roleSql;

    $roleStmt = $pdo->prepare($roleSql);
    $roleStmt->bindParam(':branchid', $branch);
    $roleStmt->bindParam(':roledate', $roledate);
    $roleStmt->bindParam(':deliverydate', $deliverydate);
    $roleStmt->bindParam(':priority', $priority);
    $roleStmt->bindParam(':status', $status);
    $roleStmt->bindParam(':description', $des);
}






?>

