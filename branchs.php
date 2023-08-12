<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
include('header.php');
include('menu.php');
require('db.php');
$branchSql = "SELECT * FROM branch";
$branchData = $pdo->query($branchSql);

$logUser = $_SESSION['user'];
?>
<div class="main-box">
    <div class="d-flex justify-content-end mb-5">
        <a href="create-branch.php">
            <button class="btn btn-success">Create</button>
        </a>
    </div>
    <h2 class="mb-3">Branches</h2>

    <?php

    if ($branchData) {
        echo "<div class='table-responsive'>";
        echo "<table class='table table-hover'>";
        echo "<thead> <tr>
            <th>Branch ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>phone</th>
        </tr> </thead>";

        foreach ($branchData as $row) {
            echo "<tbody> <tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['branch'] . "</td>";
            echo "<td>" . $row['address'] . "</td>";
            echo "<td>" . $row['phone'] . "</td>";
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