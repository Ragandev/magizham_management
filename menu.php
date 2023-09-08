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
                            <a class="dropdown-item">
                                <span class="typcn typcn-cog text-primary"></span>
                                Settings
                            </a>
                            <a class="dropdown-item">
                                <i class="typcn typcn-power text-primary"></i>
                                Logout
                            </a>
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
                        <a class="nav-link" data-toggle="collapse" href="#us" aria-expanded="false" aria-controls="">
                            <i class=" typcn typcn-media-eject-outline menu menu-icon"></i>
                            <span class="menu-title">Orders</span>
                            <i class="typcn typcn-chevron-right menu-arrow"></i>
                        </a>
                        <div class="collapse" id="us">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="orders.php">Food Order</a></li>
                                <li class="nav-item"> <a class="nav-link" href="stockorders.php">Stock Order</a></li>
                                <li class="nav-item"> <a class="nav-link" href="outdoororders.php">Outdoor Order</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="foodcatalog.php">
                            <i class="typcn typcn-device-desktop menu-icon"></i>
                            <span class="menu-title">Food Catalog</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#use" aria-expanded="false" aria-controls="">
                            <i class="  typcn typcn-folder-open menu-icon"></i>
                            <span class="menu-title">Stock Management</span>
                            <i class="typcn typcn-chevron-right menu-arrow"></i>
                        </a>
                        <div class="collapse" id="use">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="stocks.php">Stock Catalog</a></li>
                                <li class="nav-item"> <a class="nav-link" href="consumptions.php">Closing stock</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="wastes.php">
                            <i class=" typcn typcn-th-menu menu-icon"></i>
                            <span class="menu-title">wastage</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="counter.php">
                            <i class="typcn typcn-device-desktop menu-icon"></i>
                            <span class="menu-title">Counter Closing</span>
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
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#user-manane" aria-expanded="false" aria-controls="">
                            <i class="  typcn typcn-user-add menu-icon"></i>
                            <span class="menu-title">User Management</span>
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
                        <a class="nav-link" data-toggle="collapse" href="#user" aria-expanded="false" aria-controls="">
                            <i class="  typcn typcn-upload menu-icon"></i>
                            <span class="menu-title">products Configuration</span>
                            <i class="typcn typcn-chevron-right menu-arrow"></i>
                        </a>
                        <div class="collapse" id="user">
                            <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="products.php">products</a></li>
                                <li class="nav-item"> <a class="nav-link" href="types.php">Food Type</a></li>
                                <li class="nav-item"> <a class="nav-link" href="categories.php">Food Category</a></li>
                                <li class="nav-item"> <a class="nav-link" href="cuisines.php">Cuisine</a></li>
                            </ul>
                        </div>
                    </li>
                   
                    
                    <li class="nav-item">
                        <a class="nav-link" href="branchs.php">
                            <i class=" typcn typcn-home-outline menu-icon"></i>
                            <span class="menu-title">Branch</span>
                        </a>
                    </li>
                     
                 
                </ul>
            </nav>
            <div class="main-panel">
                <div class="content-wrapper">