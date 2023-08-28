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

   $query = "SELECT o.id as stock_id, o.date_created as date_created, 
          b.name as branch_name, t.name as type_name,
          c.name as cuisine_name, cat.name as category_name
          FROM `stock` o
          JOIN `stockitem` oi ON o.id = oi.stock_id
          LEFT JOIN `branch` b ON o.branchid = b.id
          LEFT JOIN `type` t ON oi.type_id = t.id
          LEFT JOIN `cuisine` c ON oi.cuisine_id = c.id
          LEFT JOIN `category` cat ON oi.category_id = cat.id
          WHERE o.date_created BETWEEN :startDate AND :endDate
          AND t.name = 'Raw Material'"; // Filter for raw material type


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
        $query .= " AND oi.type_id = :type";
        $params[':type'] = $selectedType;
    }

    if (!empty($selectedCategory)) {
        $query .= " AND oi.category_id = :category";
        $params[':category'] = $selectedCategory;
    }
    
    // if (!empty($selectedStatus)) {
    //     $query .= " AND o.status = :status";
    //     $params[':status'] = $selectedStatus;
    // }
    $query .= " ORDER BY stock_id DESC";
    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    $reportData = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<div class="main-box">
    <h2>Stock Report</h2>
    <hr>
    <table class="table">
        <thead>
            <tr>
                <th>Stock ID</th>
                <th>Stock Date</th>
                <th>Branch Name</th>
                <th>Type Name</th>
                <th>Cuisine Name</th>
                <th>Category Name</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reportData as $row): ?>
                <tr>
                    <td><?= $row['stock_id'] ?></td>
                    <td><?= $row['date_created'] ?></td>
                    <td><?= $row['branch_name'] ?></td>
                    <td><?= $row['type_name'] ?></td>
                    <td><?= $row['cuisine_name'] ?></td>
                    <td><?= $row['category_name'] ?></td>
                    
                </tr>
            <?php endforeach; ?>
            
        </tbody>
    </table>
    <?php if(count($reportData) <= 0){ echo "<br> <b class='text-danger'>No Orders Found</b>";} ?>
</div>

<?php
include('footer.php');
?>
