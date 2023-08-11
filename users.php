<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
include('header.php');
include('menu.php');
require('db.php');

$userSql = "SELECT * FROM users";
$userData = $pdo->query($userSql);

$logUser = $_SESSION['user'];
?>
<div class="main-box">
    <div class="d-flex justify-content-end mb-5">
        <a href="create-user.php">
            <button class="btn btn-success">Create</button>
        </a>
    </div>
    <h2 class="mb-3">Users</h2>

    <?php

    if ($userData) {
        echo "<div class='table-responsive'>";
        echo "<table class='table table-hover'>";
        echo "<thead> <tr>
            <th>User Id</th>
            <th>Name</th>
            <th>Username</th>
            <th>Branch</th>
            <th>Role</th>
        </tr> </thead>";

        foreach ($userData as $row) {
            echo "<tbody> <tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['branch'] . "</td>";
            echo "<td>" . $row['role'] . "</td>";
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