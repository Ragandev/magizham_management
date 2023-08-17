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
        <a href="create-product.php">
            <button class="btn btn-success">Create</button>
        </a>
    </div>
    <?php if (!empty($_GET['succ'])): ?>
					  
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong><?php  echo $_GET['succ'] ?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                                        <?php endif ?>
                                        <?php if (!empty($_GET['err'])): ?>
                                          <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><?php  echo $_GET['err'] ?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>  
                                        <?php endif ?>
    <h2 class="mb-3">Branches</h2>

    <?php

    if ($productData) {
        echo "<div class='table-responsive'>";
        echo "<table class='table table-hover'>";
        echo "<thead> <tr>
            <th> ID</th>
            <th>product </th>
            <th>Unit</th>
            <th>Stock_qty</th>

            <th>Price</th>
            <th>Type</th>
            <th>Category</th>
            <th>Cuisine</th>
            <th>Status</th>
            <th>Image</th>

        </tr> </thead>";

        foreach ($productData as $row) {
            $typee = $pdo->query('SELECT name FROM `type` WHERE id="'.$row["typeid"].'"');
            $typee = $typee->fetch(PDO::FETCH_ASSOC);
            $catee = $pdo->query('SELECT name FROM `category` WHERE id="'.$row["categoryid"].'"');
            $catee = $catee->fetch(PDO::FETCH_ASSOC);
            $cusiee = $pdo->query('SELECT name FROM `cuisine` WHERE id="'.$row["cuisineid"].'"');
            $cusiee = $cusiee->fetch(PDO::FETCH_ASSOC);
            echo "<tbody> <tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['unit'] . "</td>";
            echo "<td>" . $row['stock_qty'] . "</td>";

            echo "<td>" . $row['price'] . "</td>";
            echo "<td>" . $typee['name']. "</td>";
            echo "<td>" . $catee['name']. "</td>";
            echo "<td>" . $cusiee['name']. "</td>";
            echo "<td>" . $row['status'] . "</td>";
            echo "<td><a href='view-product.php?id=" . $row['id'] . "'>View</a></td>";


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