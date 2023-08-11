<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
include('header.php');
include('menu.php');
require('db.php');

$logUser = $_SESSION['user'];
$logName = $logUser['name'];
?>

<div class="main-box">
    <h1 class="text-center">Welcome <?php echo $logName ?></h1>
</div>

<?php
include('footer.php');
?>