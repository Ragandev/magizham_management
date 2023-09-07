<?php
require('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u1 = "counter.php?succ=";
    $u2 = "counter.php?err=";

    // Check if the keys exist in $_POST and assign default values if not set
    $branch = isset($_POST['branch']) ? $_POST['branch'] : null;
    $date = isset($_POST['date']) ? $_POST['date'] : null;
    $five_h = isset($_POST['five_h']) ? $_POST['five_h'] : null;
    $five_h_t = isset($_POST['five_h_t']) ? $_POST['five_h_t'] : null;
    $two_h = isset($_POST['two_h']) ? $_POST['two_h'] : null;
    $two_h_t = isset($_POST['two_h_t']) ? $_POST['two_h_t'] : null;
    $one_h = isset($_POST['one_h']) ? $_POST['one_h'] : null;
    $one_h_t = isset($_POST['one_h_t']) ? $_POST['one_h_t'] : null;
    $fifty = isset($_POST['fifty']) ? $_POST['fifty'] : null;
    $fifty_t = isset($_POST['fifty_t']) ? $_POST['fifty_t'] : null;
    $twenty = isset($_POST['twenty']) ? $_POST['twenty'] : null;
    $twenty_t = isset($_POST['twenty_t']) ? $_POST['twenty_t'] : null;
    $ten = isset($_POST['ten']) ? $_POST['ten'] : null;
    $ten_t = isset($_POST['ten_t']) ? $_POST['ten_t'] : null;
    $five = isset($_POST['five']) ? $_POST['five'] : null;
    $five_t = isset($_POST['five_t']) ? $_POST['five_t'] : null;
    $cash = isset($_POST['cash']) ? $_POST['cash'] : null;
    $card = isset($_POST['card']) ? $_POST['card'] : null;
    $p_cash = isset($_POST['petty_cash']) ? $_POST['petty_cash'] : null;
    $due_amt = isset($_POST['due_amt']) ? $_POST['due_amt'] : null;
    $due_pay = isset($_POST['due_payment']) ? $_POST['due_payment'] : null;
    $net = isset($_POST['net_total']) ? $_POST['net_total'] : null;
    $totalSales = isset($_POST['total_sales']) ? $_POST['total_sales'] : null;
    $deliverySales = isset($_POST['delivery_sales']) ? $_POST['delivery_sales'] : null;
    $expenses = isset($_POST['expenses']) ? $_POST['expenses'] : null;
    $outdoorSales = isset($_POST['outdoor_sale']) ? $_POST['outdoor_sale'] : null;
    $nextPetty = isset($_POST['nd_petty_cash']) ? $_POST['nd_petty_cash'] : null;
    $shortage = isset($_POST['shortage']) ? $_POST['shortage'] : null;
    $excess = isset($_POST['excess']) ? $_POST['excess'] : null;
    $accDep = isset($_POST['acc_dep']) ? $_POST['acc_dep'] : null;
    $status = isset($_POST['status']) ? $_POST['status'] : null;

    
    var_dump($five_h_t);
    var_dump($two_h_t);

    $sql = "INSERT INTO counter (date, branch, five_h, five_h_t, two_h, two_h_t, one_h, one_h_t, fifty, fifty_t, twenty, twenty_t, ten, ten_t, five, five_t, cash_t, card, petty_cash, due_amt, due_payment, net_total, total_sales, delivery_sales, expenses, outdoor_sales, nd_petty_cash, shortage, excess, acc_dep, status) 
        VALUES (:date, :branch, :five_h, :five_h_t, :two_h, :two_h_t, :one_h, :one_h_t, :fifty, :fifty_t, :twenty, :twenty_t, :ten, :ten_t, :five, :five_t, :cash, :card, :p_cash, :due_amt, :due_pay, :net, :totalSales, :deliverySales, :expenses, :outdoorSales, :nextPetty, :shortage, :excess, :accDep, :status)";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':branch', $branch);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':five_h', $five_h);
    $stmt->bindParam(':five_h_t', $five_h_t);
    $stmt->bindParam(':two_h', $two_h);
    $stmt->bindParam(':two_h_t', $two_h_t);
    $stmt->bindParam(':one_h', $one_h);
    $stmt->bindParam(':one_h_t', $one_h_t);
    $stmt->bindParam(':fifty', $fifty);
    $stmt->bindParam(':fifty_t', $fifty_t);
    $stmt->bindParam(':twenty', $twenty);
    $stmt->bindParam(':twenty_t', $twenty_t);
    $stmt->bindParam(':ten', $ten);
    $stmt->bindParam(':ten_t', $ten_t);
    $stmt->bindParam(':five', $five);
    $stmt->bindParam(':five_t', $five_t);
    $stmt->bindParam(':cash', $cash);
    $stmt->bindParam(':card', $card);
    $stmt->bindParam(':p_cash', $p_cash);
    $stmt->bindParam(':due_amt', $due_amt);
    $stmt->bindParam(':due_pay', $due_pay);
    $stmt->bindParam(':net', $net);
    $stmt->bindParam(':totalSales', $totalSales);
    $stmt->bindParam(':deliverySales', $deliverySales);
    $stmt->bindParam(':expenses', $expenses);
    $stmt->bindParam(':outdoorSales', $outdoorSales);
    $stmt->bindParam(':nextPetty', $nextPetty);
    $stmt->bindParam(':shortage', $shortage);
    $stmt->bindParam(':excess', $excess);
    $stmt->bindParam(':accDep', $accDep);
    $stmt->bindParam(':status', $status);

    if (!$stmt->execute()) {
        header("Location: " . $u2 . urlencode('Something Wrong please try again later'));
    } else {
        header("Location: " . $u1 . urlencode('Record Created Successfully'));
    }
}
?>
