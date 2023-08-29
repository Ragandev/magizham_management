<style>


    .dashboard-item {
        width: 100%;
        padding: 20px;
        box-sizing: border-box;
        border-radius: 30px;
        box-shadow: 5px 5px 10px rgba(0,0,0,0.3);
        font-size: 1em;
    }

    .box {
        padding: 10px;
        width: 80%;
        height: 100px;
    }

    .box p {
        font-size: 100px;
    }

    .icon {
        color: #000000;
    }

    .fas {
        color: black;
    }

    .fa-solid {
        color: black;
    }
    .violet{
        background-color: skyblue;
    }
    .pink{
        background-color: #fdb44b;
    }
    .red{
        background-color: #f76b8a; 
    }
    .green{
        background-color: #66bfbf;   
    }
    .blue{
        background-color: #edb1f1;   
    }
    .orange{
        background-color: #9cd3d3;       
    }
    .black{
        background-color: #dde0ab;       
    }
    .yellow{
        background-color: #c4c1e0;       
    }
    .inner{
        display: flex;
        gap: 1px;
    }
    .fa-shopping-cart{
        size: 100px;
    }
    .dashboard-item .icon i {
    font-size: 5em; 
}
.dashboard-item .inner {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.dashboard-item .inner h3 {
    margin-bottom: 10px; 
}

.dashboard-item .icon {
    margin-left: 10px; 
}
</style>
<?php

require('db.php'); // Include your database connection file

// Calculate total orders
$totalOrdersQuery = "SELECT COUNT(*) as totalOrders FROM `order`";
$totalOrdersResult = $pdo->query($totalOrdersQuery)->fetch(PDO::FETCH_ASSOC);
$totalOrders = $totalOrdersResult['totalOrders'];

// Calculate total stocks
$totalStocksQuery = "SELECT COUNT(*) as totalStocks FROM `stock`";
$totalStocksResult = $pdo->query($totalStocksQuery)->fetch(PDO::FETCH_ASSOC);
$totalStocks = $totalStocksResult['totalStocks'];

// Calculate total wastes
$totalWastesQuery = "SELECT COUNT(*) as totalWastes FROM `waste`";
$totalWastesResult = $pdo->query($totalWastesQuery)->fetch(PDO::FETCH_ASSOC);
$totalWastes = $totalWastesResult['totalWastes'];

// Calculate total orders for today
$today = date('Y-m-d');
$todayOrdersQuery = "SELECT COUNT(*) as todayTotalOrders FROM `order` WHERE orderdate = :today";
$todayOrdersResult = $pdo->prepare($todayOrdersQuery);
$todayOrdersResult->execute(['today' => $today]);
$todayTotalOrders = $todayOrdersResult->fetch(PDO::FETCH_ASSOC)['todayTotalOrders'];

// Calculate total complete orders for today
$todayCompletedOrdersQuery = "SELECT COUNT(*) as todayCompletedOrders FROM `order` WHERE DATE(orderdate) = :today AND status = 'Received'";
$todayCompletedOrdersResult = $pdo->prepare($todayCompletedOrdersQuery);
$todayCompletedOrdersResult->execute(['today' => $today]);
$todayCompletedOrders = $todayCompletedOrdersResult->fetch(PDO::FETCH_ASSOC)['todayCompletedOrders'];

// Calculate total pending orders for today
$todayPendingOrdersQuery = "SELECT COUNT(*) as todayPendingOrders FROM `order` WHERE DATE(orderdate) = :today AND (status = 'Created' OR status = 'Accepted' OR status = 'Delivered')";
$todayPendingOrdersResult = $pdo->prepare($todayPendingOrdersQuery);
$todayPendingOrdersResult->execute(['today' => $today]);
$todayPendingOrders = $todayPendingOrdersResult->fetch(PDO::FETCH_ASSOC)['todayPendingOrders'];

// Calculate total stocks for today
$todayStocksQuery = "SELECT COUNT(*) as todayTotalStocks FROM `stock` WHERE DATE(date_created) = :today";
$todayStocksResult = $pdo->prepare($todayStocksQuery);
$todayStocksResult->execute(['today' => $today]);
$todayTotalStocks = $todayStocksResult->fetch(PDO::FETCH_ASSOC)['todayTotalStocks'];

// Calculate total wastes for today
$todayWastesQuery = "SELECT COUNT(*) as todayTotalWastes FROM `waste` WHERE DATE(date) = :today";
$todayWastesResult = $pdo->prepare($todayWastesQuery);
$todayWastesResult->execute(['today' => $today]);
$todayTotalWastes = $todayWastesResult->fetch(PDO::FETCH_ASSOC)['todayTotalWastes'];

include('header.php'); // Include your header file
include('menu.php'); // Include your menu file
?>
<div class="main-box">
    <h2 class="mb-3">Dashboard</h2>

    <hr>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <div class="dashboard-container1">
    <h3>Total's</h3><br>
        <div class="row">
              
            <div class="col-md-4">
                <div class="dashboard-item violet">
                    <div class="inner">
                        <div>
                        <h3> Total Orders</h3>
                        <p>
                            <?= $totalOrders ?>
                        </p>
                        </div>
                        <div>
                        <span class="icon">
                            <a href="orders.php">
                                <i class="fas fa-shopping-cart"></i>
                            </a>
                        </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="dashboard-item pink">
                    <div class="inner">
                        <div><h3> Total Stocks</h3>
                        <p>
                            <?= $totalStocks ?>
                        </p></div>
                        <div><span class="icon">
                            <a href="stocks.php">
                            <i class="fa-solid fa-box-open"></i> </a>
                        </span></div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="dashboard-item red">
                    <div class="inner">
                        <div><h3> Total Wastes</h3>
                        <p>
                            <?= $totalWastes ?>
                        </p></div>
                       <div> <span class="icon">
                            <a href="wastes.php">
                            <i class="fa-solid fa-dumpster"></i>   </a>
                        </span></div>
                    </div>
                </div>
            </div>

        </div>
        <br><br>
        <h3>Today's</h3><br>
        <div class="row">
            <!-- <div class="col-1"></div> -->
            <div class="col-md-4">
                <div class="dashboard-item green ">
                    <div class="inner">
                        <div>
                                    <h3> Orders</h3>
                                    <p>
                                     <?= $todayTotalOrders ?>
                                    </p>
                                    </div>
                        <div>
                        <span class="icon">
                            <a href="orders.php">
                                <i class="fas fa-shopping-cart"></i>
                            </a>
                        </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="dashboard-item blue">
                    <div class="inner">
                        <div>
                                    <h3>Completed Orders</h3>
                                    <p>
                                        <?= $todayCompletedOrders ?>
                                    </p>
                                    </div>
                        <div>
                        <span class="icon">
                            <a href="orders.php">
                            <i class="fa-solid fa-calendar-check"></i>                            </a>
                        </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="dashboard-item orange">
                    <div class="inner">
                        <div>
                                    <h3>Pending  Orders</h3>
                                    <p>
                                    <?= $todayPendingOrders ?></p>
                                    </div>
                        <div>
                        <span class="icon">
                            <a href="orders.php">
                            <i class="fa-solid fa-file-excel"></i>                            </a>
                        </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="dashboard-item yellow">
                    <div class="inner">
                        <div>
                                    <h3>Stock</h3>
                                    <p>
                                    <?= $todayTotalStocks ?>
                                 </div>
                        <div>
                        <span class="icon">
                            <a href="stocks.php">
                            <i class="fa-solid fa-boxes-packing"></i>                            </a>
                        </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="dashboard-item black">
                    <div class="inner">
                        <div>
                                    <h3>Waste</h3>
                                    <p>
                                    <?= $todayTotalWastes ?>
                                 </div>
                        <div>
                        <span class="icon">
                            <a href="wastes.php">
                            <i class="fa-solid fa-dumpster-fire"></i>                            </a>
                        </span>
                        </div>
                    </div>
                </div>
            </div>
          
            <div class="col-1"></div>
</div>
            <br><br>
            <div class="dashboard-container">

                <div class="row">
                    <div class="col-md-6">
                        <div class="chart-container">
                            <canvas id="totalOrdersPieChart" width="250" height="250"></canvas>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="chart-container">
                            <canvas id="todayOrdersPieChart" width="250" height="250"></canvas>
                        </div>
                    </div>
                    <div class="col-md-12">

                        <div class="chart-container">
                            <canvas id="todayDetailsBarChart" width="250" height="250"></canvas>
                        </div>
                    </div>


                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        var totalOrdersPieChart = new Chart(document.getElementById('totalOrdersPieChart'), {
                            type: 'pie',
                            data: {
                                labels: ['Total Orders', 'Total Stocks', 'Total Wastes'],
                                datasets: [{
                                    data: [<?= $totalOrders ?>, <?= $totalStocks ?>, <?= $totalWastes ?>],
                                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false
                            }
                        });

                        var todayOrdersPieChart = new Chart(document.getElementById('todayOrdersPieChart'), {
                            type: 'pie',
                            data: {
                                labels: ['Today\'s Completed Orders', 'Today\'s Pending Orders'],
                                datasets: [{
                                    data: [<?= $todayCompletedOrders ?>, <?= $todayPendingOrders ?>],
                                    backgroundColor: ['#36A2EB', '#FFCE56']
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false
                            }
                        });
                        // Create a bar chart for today's details
                        var todayDetailsBarChart = new Chart(document.getElementById('todayDetailsBarChart'), {
                            type: 'bar',
                            data: {
                                labels: ['Today\'s Orders', 'Today\'s Stocks', 'Today\'s Wastes'],
                                datasets: [{
                                    label: 'Today\'s Details',
                                    data: [<?= $todayTotalOrders ?>, <?= $todayTotalStocks ?>, <?= $todayTotalWastes ?>, 0],
                                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        suggestedMax: 10
                                    }
                                }
                            }
                        });
                    });


                </script>
            </div>

            <?php
            include('footer.php'); // Include your footer file
            ?>