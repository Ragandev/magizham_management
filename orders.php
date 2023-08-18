<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
include('header.php');
include('menu.php');
require('db.php');
$productSql = "SELECT * FROM product";
$productData = $pdo->query($productSql);

$logUser = $_SESSION['user'];
?>
<div class="main-box">
    <div class="d-flex justify-content-end mb-5">
        <a href="create-order.php">
            <button class="btn btn-success">Create</button>
        </a>
    </div>
    <h2 class="mb-3">Orders</h2>

    <?php

    if ($productData) {
        echo "<div class='table-responsive'>";
        echo "<table class='table table-hover'>";
        echo "<thead> <tr>
            <th> ID</th>
            <th> Product Name</th>
            <th> Order Date</th>
            <th> Delivery Date</th>
            <th>Status</th>
            <th>priority</th>
            <th>Status</th>
        </tr> </thead>";

        foreach ($productData as $row) {
            echo "<tbody> <tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['orderdate'] . "</td>";
            echo "<td>" . $row['unit'] . "</td>";
            echo "<td>" . $row['price'] . "</td>";
            echo "<td>" . $row['type'] . "</td>";
            echo "<td>" . $row['category'] . "</td>";
            echo "<td>" . $row['cuisine'] . "</td>";
            echo "<td>" . $row['status'] . "</td>";



            echo "</tr> </tbody>";
        }

        echo "</table>";
        echo "</div>";
    } else {
        echo "Error fetching data";
    }
    ?>

</div>

<?php
include('footer.php');
?>