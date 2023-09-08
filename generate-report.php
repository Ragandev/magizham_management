<?php
include('header.php');
include('menu.php');
require('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $selectedBranch = $_POST['selectedBranch'];
    $selectedType = $_POST['selectedType'];
    $selectedCategory = $_POST['selectedCategory'];
    $selectedStatus = $_POST['selectedStatus'];

    $query = "SELECT o.id as order_id, o.orderdate as order_date, 
          b.name as branch_name, t.name as type_name,
          c.name as cuisine_name, cat.name as category_name,
          o.status as order_status
          FROM `order` o
          JOIN `orderitem` oi ON o.id = oi.order_id
          LEFT JOIN `branch` b ON o.branchid = b.id
          LEFT JOIN `type` t ON oi.typeid = t.id
          LEFT JOIN `cuisine` c ON oi.cuisineid = c.id
          LEFT JOIN `category` cat ON oi.categoryid = cat.id
          WHERE o.orderdate BETWEEN :startDate AND :endDate";

    $params = [':startDate' => $startDate, ':endDate' => $endDate];

    if (!empty($selectedBranch)) {
        $query .= " AND o.branchid = :branch";
        $params[':branch'] = $selectedBranch;
    }

    if (!empty($selectedBranch)) {
        $query .= " AND o.branchid = :branch";
        $params[':branch'] = $selectedBranch;
    }

    if (!empty($selectedType)) {
        $query .= " AND oi.typeid = :type";
        $params[':type'] = $selectedType;
    }

    if (!empty($selectedCategory)) {
        $query .= " AND oi.categoryid = :category";
        $params[':category'] = $selectedCategory;
    }
    
    if (!empty($selectedStatus)) {
        $query .= " AND o.status = :status";
        $params[':status'] = $selectedStatus;
    }
    $query .= " ORDER BY order_id DESC";
    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    $reportData = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<div class="main-box">
    <h2>Order Report</h2>
    <hr>
    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Order Date</th>
                <th>Branch Name</th>
                <th>Type Name</th>
                <th>Cuisine Name</th>
                <th>Category Name</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reportData as $row): ?>
                <tr>
                    <td><?= $row['order_id'] ?></td>
                    <td><?= $row['order_date'] ?></td>
                    <td><?= $row['branch_name'] ?></td>
                    <td><?= $row['type_name'] ?></td>
                    <td><?= $row['cuisine_name'] ?></td>
                    <td><?= $row['category_name'] ?></td>
                    <td><?= $row['order_status'] ?></td>
                    
                </tr>
            <?php endforeach; ?>
            
        </tbody>
    </table>
    <?php if(count($reportData) <= 0){ echo "<br> <b class='text-danger'>No Orders Found</b>";} ?>
</div>

<?php
include('footer.php');
?>
