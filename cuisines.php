<style>
  .typcn {
    font-size: 22px; 
  }
</style>
<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
include('header.php');
include('menu.php');
require('db.php');
$cuisineSql = "SELECT * FROM cuisine";
$cuisineData = $pdo->query($cuisineSql);

$logUser = $_SESSION['user'];
?>
<div class="main-box">
    <div class="d-flex justify-content-end mb-5">
        <a href="create-cuisine.php">
            <button class="btn btn-success">Create</button>
        </a>
    </div>
    <h2 class="mb-3">cuisines</h2>

    <?php

    if ($cuisineData) {
        echo "<div class='table-responsive'>";
        echo "<table class='table table-hover'>";
        echo "<thead> <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Status</th>
            <th>Action</th>

        </tr> </thead>";

        foreach ($cuisineData as $row) {
            echo "<tbody> <tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['status'] . "</td>";
            echo "<td>
            <a href='edit-cuisine.php?id=" . $row['id'] . "'><i class=' typcn typcn-edit'></i></i></a> |
            <a href='delete-cuisine.php?delete_id=" . $row['id'] . "' class='text-danger' onclick='return confirmDelete()'><i class='  typcn typcn-trash'></i></a>
        </td>";
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
<script>
function confirmDelete() {
    return confirm("Are you sure you want to delete this order?");
}
</script>