<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
$logUser = $_SESSION['user'];
$logName = $logUser['name'];
?>

<style>
    .user-icon{
        display: flex;
        justify-content: center;align-items: center;
    }
    .user-icon span{
        font-size: 18px;
    }
    .user-icon p{
        margin-top: 25px;
        font-weight: bold;
    }
    .user-box{
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 5px;
    }
</style>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="" href="index.html"><img src="images/Magizham Logo.png" alt="logo" height="30"/></a>
                <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/Magizham_Logo.svg" alt="logo" /></a>
                <button class="navbar-toggler navbar-toggler align-self-center d-none d-lg-flex" type="button" data-toggle="minimize">
                    <span class="typcn typcn-th-menu"></span>
                </button>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle  pl-0 pr-0" href="#" data-toggle="dropdown" id="profileDropdown">
                            <div class="user-icon">
                            <span class="typcn typcn-user-outline mr-0"></span>
                            <div><p><?php echo $logName ?></p></div>
                            </div>
                        </a>                        
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                            <div class="user-box">
                            <form action="logout.php" method="get">
                                <button class="btn btn-danger" type="submit">Logout</button>
                            </form>
                            </div>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="typcn typcn-th-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->

            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <div class="d-flex sidebar-profile">
                            <div class="sidebar-profile-image">
                                <img src="images/user.jpg" alt="image">
                                <span class="sidebar-status-indicator"></span>
                            </div>
                            <div class="sidebar-profile-name">
                                <p class="sidebar-name">
                                    Admin
                                </p>
                                <p class="sidebar-designation">
                                    Welcome
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard1.php">
                            <i class="typcn typcn-device-desktop menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="orders.php">
                            <i class=" typcn typcn-media-eject-outline menu menu-icon"></i>
                            <span class="menu-title">Orders</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#use" aria-expanded="false" aria-controls="">
                            <i class="  typcn typcn-folder-open menu-icon"></i>
                            <span class="menu-title">Manage Stocks</span>
                            <i class="typcn typcn-chevron-right menu-arrow"></i>
                        </a>
                        <div class="collapse" id="use">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="stocks.php">Stock</a></li>
                                <li class="nav-item"> <a class="nav-link" href="consumptions.php">Consumption</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="wastes.php">
                            <i class=" typcn typcn-th-menu menu-icon"></i>
                            <span class="menu-title">wastes</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#user" aria-expanded="false" aria-controls="">
                            <i class="  typcn typcn-folder-open menu-icon"></i>
                            <span class="menu-title">Manage</span>
                            <i class="typcn typcn-chevron-right menu-arrow"></i>
                        </a>
                        <div class="collapse" id="user">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="types.php">Type</a></li>
                                <li class="nav-item"> <a class="nav-link" href="categories.php">Category</a></li>
                                <li class="nav-item"> <a class="nav-link" href="cuisines.php">Cuisine</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="products.php">
                            <i class=" typcn typcn-upload menu-icon"></i>
                            <span class="menu-title">products</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#user-manane" aria-expanded="false" aria-controls="">
                            <i class="  typcn typcn-user-add menu-icon"></i>
                            <span class="menu-title">User & Roles</span>
                            <i class="typcn typcn-chevron-right menu-arrow"></i>
                        </a>
                        <div class="collapse" id="user-manane">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="users.php">Users</a></li>
                                <li class="nav-item"> <a class="nav-link" href="role.php">Roles</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="branchs.php">
                            <i class=" typcn typcn-home-outline menu-icon"></i>
                            <span class="menu-title">Branch</span>
                        </a>
                    </li>
                     
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#manane" aria-expanded="false" aria-controls="">
                            <i class="  typcn typcn-folder-open menu-icon"></i>
                            <span class="menu-title">Reports</span>
                            <i class="typcn typcn-chevron-right menu-arrow"></i>
                        </a>
                        <div class="collapse" id="manane">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="order-report.php">Order Reports</a></li>
                                <li class="nav-item"> <a class="nav-link" href="stock-report.php">Stock Reports</a></li>
                                <li class="nav-item"> <a class="nav-link" href="waste-report.php">Waste Reports</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-panel">
                <div class="content-wrapper">