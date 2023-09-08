<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
include('header.php');
include('menu.php');
require('db.php');
$consumptionSql = "SELECT * FROM `consumption`";
$consumptionData = $pdo->query($consumptionSql);
$logUser = $_SESSION['user'];

// Branch Data 
$b_sql = "SELECT * FROM `branch` WHERE status = 'Active' ORDER BY id";
$b_data = $pdo->query($b_sql);
?>

<style>
    .amt-box {
        display: grid;
        grid-template-columns: 100px 1fr 1fr;
        gap: 30px;
    }

    .amt-box label {
        display: flex;
        align-items: center;
        font-weight: bold;
    }
</style>

<div class="main-box">

    <?php if (!empty($_GET['succ'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>
                <?php echo $_GET['succ'] ?>
            </strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif ?>
    <?php if (!empty($_GET['err'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>
                <?php echo $_GET['err'] ?>
            </strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif ?>

    <h2 class="mb-3">Counter Closing</h2>
    <br>

    <form class="counter-form" method="post" action="counter_create_post.php">
        <div class="row">

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label>Branch</label>
                    <select name="branch" id="" class="form-control">
                        <?php foreach ($b_data as $row): ?>
                            <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label>Date</label>
                    <input type="date" name="date" class="form-control">
                </div>
            </div>

        </div>
</div>
<br>
<div class="main-box">
    <div class="col-12">
        <div class="form-group amt-box">
            <label for="exampleInputPassword4">500 X</label>
            <input type="number" class="form-control" name="five_h">
            <input type="number" disabled class="form-control" name="five_h_t">
        </div>
    </div>


    <div class="col-12">
        <div class="form-group amt-box">
            <label for="exampleInputPassword4">200 X</label>
            <input type="number" class="form-control" name="two_h">
            <input type="number" disabled class="form-control" name="two_h_t">
        </div>
    </div>


    <div class="col-12">
        <div class="form-group amt-box">
            <label for="exampleInputPassword4">100 X</label>
            <input type="number" class="form-control" name="one_h">
            <input type="number" disabled class="form-control" name="one_h_t">
        </div>
    </div>

    <div class="col-12">
        <div class="form-group amt-box">
            <label for="exampleInputPassword4">50 X</label>
            <input type="number" class="form-control" name="fifty">
            <input type="number" disabled class="form-control" name="fifty_t">
        </div>
    </div>
  

    <div class="col-12">
        <div class="form-group amt-box">
            <label for="exampleInputPassword4">20 X</label>
            <input type="number" class="form-control" name="twenty">
            <input type="number" disabled class="form-control" name="twenty_t">
        </div>
    </div>
   

    <div class="col-12">
        <div class="form-group amt-box">
            <label for="exampleInputPassword4">10 X</label>
            <input type="number" class="form-control" name="ten">
            <input type="number" disabled class="form-control" name="ten_t">
        </div>
    </div>

    <div class="col-12">
        <div class="form-group amt-box">
            <label for="exampleInputPassword4">5 X</label>
            <input type="number" class="form-control" name="five">
            <input type="number" disabled class="form-control" name="five_t">
        </div>
    </div>
                        </div>
                        <br> 

    <div class="main-box">
        <div class="row">
    <div class="col-12 col-md-6 col-lg-4">
        <div class="form-group">
            <label for="exampleInputPassword4">Cash</label>
            <input disabled type="number" class="form-control" value="" name="cash">
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-4">
        <div class="form-group">
            <label>Card</label>
            <input type="number" class="form-control" name="card">
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-4">
        <div class="form-group">
            <label for="exampleInputPassword4">Petty Cash</label>
            <input type="number" class="form-control" name="petty_cash">
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-4">
        <div class="form-group">
            <label>Due Amount</label>
            <input type="number" class="form-control" name="due_amt">
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-4">
        <div class="form-group">
            <label>Due Payment</label>
            <input type="number" class="form-control" name="due_payment">
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-4">
        <div class="form-group">
            <label for="exampleInputPassword4">Net Total</label>
            <input disabled type="number" class="form-control" name="net_total">
        </div>
    </div>

    <div class="col-12  col-md-6 col-lg-4">
        <div class="form-group">
            <label for="exampleInputPassword4">Total Sales</label>
            <input type="number" class="form-control" name="total_sales">
        </div>
    </div>
    <div class="col-12  col-md-6 col-lg-4">
        <div class="form-group">
            <label for="exampleInputPassword4">Online Sales</label>
            <input type="number" class="form-control" name="delivery_sales">
        </div>
    </div>
    <div class="col-12  col-md-6 col-lg-4">
        <div class="form-group">
            <label for="exampleInputPassword4">Expenses</label>
            <input type="number" class="form-control" name="expenses">
        </div>
    </div>
    <div class="col-12  col-md-6 col-lg-4">
        <div class="form-group">
            <label for="exampleInputPassword4">Outdoor Sale</label>
            <input type="number" class="form-control" name="outdoor_sale">
        </div>
    </div>
    <div class="col-12  col-md-6 col-lg-4">
        <div class="form-group">
            <label for="exampleInputPassword4">Next Day Petty Cash</label>
            <input type="number" class="form-control" name="nd_petty_cash">
        </div>
    </div>
    <div class="col-12  col-md-6 col-lg-4">
        <div class="form-group">
            <label for="">Status</label>
            <select class="form-control" name="status" id="">
                <option value="pending" class="text-danger">Pending</option>
                <option value="received" class="text-success">Received</option>
            </select>
        </div>
    </div>
    <div class="col-12  col-md-6 col-lg-4">
        <div class="form-group">
            <label for="exampleInputPassword4">shortage</label>
            <input disabled type="number" class="form-control" name="shortage">
        </div>
    </div>
    <div class="col-12  col-md-6 col-lg-4">
        <div class="form-group">
            <label for="exampleInputPassword4">Excess</label>
            <input disabled type="number" class="form-control" name="excess">
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-4">
        <div class="form-group">
            <label for="exampleInputPassword4">To Accounts Department</label>
            <input disabled type="number" class="form-control" name="acc_dep">
        </div>
    </div>
    </div>
    <button type="submit" class="btn btn-primary mr-2">Submit</button>
</div>
</form>

</div>

<!-- <script>
    let five_h = document.querySelector('input[name=five_h]');
    let five_h_t = document.querySelector('input[name=five_h_t]');
    let two_h = document.querySelector('input[name=two_h]');
    let two_h_t = document.querySelector('input[name=two_h_t]');
    let one_h = document.querySelector('input[name=one_h]');
    let one_h_t = document.querySelector('input[name=one_h_t]');
    let fifty = document.querySelector('input[name=fifty]');
    let fifty_t = document.querySelector('input[name=fifty_t]');
    let twenty = document.querySelector('input[name=twenty]');
    let twenty_t = document.querySelector('input[name=twenty_t]');
    let ten = document.querySelector('input[name=ten]');
    let ten_t = document.querySelector('input[name=ten_t]');
    let five = document.querySelector('input[name=five]');
    let five_t = document.querySelector('input[name=five_t]');

    let cash = document.querySelector('input[name=cash]');
    let card = document.querySelector('input[name=card]');
    let p_cash = document.querySelector('input[name=petty_cash]');
    let due_amt = document.querySelector('input[name=due_amt]');
    let due_pay = document.querySelector('input[name=due_payment]');
    let net = document.querySelector('input[name=net_total]');

    let totalSales = document.querySelector('input[name=total_sales]');
    let deliverySales = document.querySelector('input[name=delivery_sales]');
    let expenses = document.querySelector('input[name=expenses]');
    let outdoorSales = document.querySelector('input[name=outdoor_sale]');
    let nextPetty = document.querySelector('input[name=nd_petty_cash]');
    let shortage = document.querySelector('input[name=shortage]');
    let excess = document.querySelector('input[name=excess]');
    let accDep = document.querySelector('input[name=acc_dep]');



    cash.value = 0; // Initialize the cash input with 0

    function calc(input, amt, total) {
        var inputVal = parseInt(input.value, 10); // Parse input value as an integer
        var sum = inputVal * amt;
        total.value = sum;
        updateCashTotal(); // Update the running total
    }

    function updateCashTotal() {
        let total = 0;

        // Calculate the total based on individual denominations
        total += parseInt(five_h_t.value, 10) || 0;
        total += parseInt(two_h_t.value, 10) || 0;
        total += parseInt(one_h_t.value, 10) || 0;
        total += parseInt(fifty_t.value, 10) || 0;
        total += parseInt(twenty_t.value, 10) || 0;
        total += parseInt(ten_t.value, 10) || 0;
        total += parseInt(five_t.value, 10) || 0;

        // Update the "cash" input with the new total
        cash.value = total;
        net.value = total;
        accDep.value = total;
    }

    five_h.addEventListener('input', () => {
        calc(five_h, 500, five_h_t);
    });

    two_h.addEventListener('input', () => {
        calc(two_h, 200, two_h_t);
    });

    one_h.addEventListener('input', () => {
        calc(one_h, 100, one_h_t);
    });

    fifty.addEventListener('input', () => {
        calc(fifty, 50, fifty_t);
    });

    twenty.addEventListener('input', () => {
        calc(twenty, 20, twenty_t);
    });

    ten.addEventListener('input', () => {
        calc(ten, 10, ten_t);
    });

    five.addEventListener('input', () => {
        calc(five, 5, five_t);
    });

    function updateNetTotal() {
        let total = 0;

        // Calculate the total based on individual denominations
        total += parseInt(cash.value, 10) || 0;
        total += parseInt(card.value, 10) || 0;
        total -= parseInt(p_cash.value, 10) || 0;

        // Update the "cash" input with the new total
        net.value = total;
    }

    card.addEventListener('input', () => {
        updateNetTotal();
    });
    p_cash.addEventListener('input', () => {
        updateNetTotal();
    });

    function updateBalance() {
        let total = 0;

        // Calculate the total based on individual denominations
        total += parseInt(totalSales.value, 10) || 0;
        total -= parseInt(deliverySales.value, 10) || 0;
        total -= parseInt(expenses.value, 10) || 0;
        total -= parseInt(net.value, 10) || 0;
        total -= parseInt(due_amt.value, 10) || 0;
        total += parseInt(due_pay.value, 10) || 0;

        if (total <= 0) {
            excess.value = total;
            shortage.value = 0;
        } else {
            shortage.value = total;
            excess.value = 0;
        }
    }

    function updateAccDep() {
        let total = parseInt(cash.value, 10) || 0;

        total -= parseInt(nextPetty.value, 10) || 0;
        total += parseInt(outdoorSales.value, 10) || 0;
        total += parseInt(due_pay.value, 10) || 0;

        accDep.value = total;
    }



    totalSales.addEventListener('input', () => {
        updateBalance();
    });
    deliverySales.addEventListener('input', () => {
        updateBalance();
    });
    expenses.addEventListener('input', () => {
        updateBalance();
    });
    due_amt.addEventListener('input', () => {
        updateBalance();
    });
    due_pay.addEventListener('input', () => {
        updateBalance();
        updateAccDep();
    });

    nextPetty.addEventListener('input', () => {
        updateAccDep();
    });
    outdoorSales.addEventListener('input', () => {
        updateAccDep();
    });

    // Add an event listener for the form submission
document.querySelector('.counter-form').addEventListener('submit', function (event) {
    // Disable the fields just before form submission
    five_h_t.disabled = false;
    two_h_t.disabled = false;
    one_h_t.disabled = false;
    fifty_t.disabled = false;
    twenty_t.disabled = false;
    ten_t.disabled = false;
    five_t.disabled = false;
    cash.disabled = false;
    net.disabled = false;
    shortage.disabled = false;
    excess.disabled = false;
    accDep.disabled = false;
    
    return true;
});

</script> -->

<script>
    let five_h = document.querySelector('input[name=five_h]');
    let five_h_t = document.querySelector('input[name=five_h_t]');
    let two_h = document.querySelector('input[name=two_h]');
    let two_h_t = document.querySelector('input[name=two_h_t]');
    let one_h = document.querySelector('input[name=one_h]');
    let one_h_t = document.querySelector('input[name=one_h_t]');
    let fifty = document.querySelector('input[name=fifty]');
    let fifty_t = document.querySelector('input[name=fifty_t]');
    let twenty = document.querySelector('input[name=twenty]');
    let twenty_t = document.querySelector('input[name=twenty_t]');
    let ten = document.querySelector('input[name=ten]');
    let ten_t = document.querySelector('input[name=ten_t]');
    let five = document.querySelector('input[name=five]');
    let five_t = document.querySelector('input[name=five_t]');

    let cash = document.querySelector('input[name=cash]');
    let card = document.querySelector('input[name=card]');
    let p_cash = document.querySelector('input[name=petty_cash]');
    let due_amt = document.querySelector('input[name=due_amt]');
    let due_pay = document.querySelector('input[name=due_payment]');
    let net = document.querySelector('input[name=net_total]');

    let totalSales = document.querySelector('input[name=total_sales]');
    let deliverySales = document.querySelector('input[name=delivery_sales]');
    let expenses = document.querySelector('input[name=expenses]');
    let outdoorSales = document.querySelector('input[name=outdoor_sale]');
    let nextPetty = document.querySelector('input[name=nd_petty_cash]');
    let shortage = document.querySelector('input[name=shortage]');
    let excess = document.querySelector('input[name=excess]');
    let accDep = document.querySelector('input[name=acc_dep]');



    // cash.value = 0; // Initialize the cash input with 0

    function calc(input, amt, total) {
        var inputVal = parseInt(input.value, 10); // Parse input value as an integer
        var sum = inputVal * amt;
        total.value = sum;
        updateCashTotal(); // Update the running total
    }

    function updateCashTotal() {
        let total = 0;

        // Calculate the total based on individual denominations
        total += parseInt(five_h_t.value, 10) || 0;
        total += parseInt(two_h_t.value, 10) || 0;
        total += parseInt(one_h_t.value, 10) || 0;
        total += parseInt(fifty_t.value, 10) || 0;
        total += parseInt(twenty_t.value, 10) || 0;
        total += parseInt(ten_t.value, 10) || 0;
        total += parseInt(five_t.value, 10) || 0;

        // Update the "cash" input with the new total
        cash.value = total;
        // net.value = total;
        // accDep.value = total;
    }


    function updateNetTotal() {
        let total = 0;

        // Calculate the total based on individual denominations
        total += parseInt(cash.value, 10) || 0;
        total += parseInt(card.value, 10) || 0;
        total -= parseInt(p_cash.value, 10) || 0;

        // Update the "cash" input with the new total
        net.value = total;
    }

    

    function updateBalance() {
        let total = 0;

        // Calculate the total based on individual denominations
        total += parseInt(totalSales.value, 10) || 0;
        total -= parseInt(deliverySales.value, 10) || 0;
        total -= parseInt(expenses.value, 10) || 0;
        total -= parseInt(net.value, 10) || 0;
        total -= parseInt(due_amt.value, 10) || 0;
        total += parseInt(due_pay.value, 10) || 0;

        if (total <= 0) {
            excess.value = total;
            shortage.value = 0;
        } else {
            shortage.value = total;
            excess.value = 0;
        }
    }

    function updateAccDep() {
        let total = parseInt(cash.value, 10) || 0;

        total -= parseInt(nextPetty.value, 10) || 0;
        total += parseInt(outdoorSales.value, 10) || 0;
        total += parseInt(due_pay.value, 10) || 0;

        accDep.value = total;
    }

    card.addEventListener('input', () => {
        updateNetTotal();
        updateBalance();
        updateAccDep();
    });
    p_cash.addEventListener('input', () => {
        updateNetTotal();
        updateBalance();
        updateAccDep();
    });

    five_h.addEventListener('input', () => {
        calc(five_h, 500, five_h_t);
        updateNetTotal();
        updateBalance();
        updateAccDep();
    });

    two_h.addEventListener('input', () => {
        calc(two_h, 200, two_h_t);
        updateNetTotal();
        updateBalance();
        updateAccDep();
    });

    one_h.addEventListener('input', () => {
        calc(one_h, 100, one_h_t);
        updateNetTotal();
        updateBalance();
        updateAccDep();
    });

    fifty.addEventListener('input', () => {
        calc(fifty, 50, fifty_t);
        updateNetTotal();
        updateBalance();
        updateAccDep();
    });

    twenty.addEventListener('input', () => {
        calc(twenty, 20, twenty_t);
        updateNetTotal();
        updateBalance();
        updateAccDep();
    });

    ten.addEventListener('input', () => {
        calc(ten, 10, ten_t);
        updateNetTotal();
        updateBalance();
        updateAccDep();
    });

    five.addEventListener('input', () => {
        calc(five, 5, five_t);
        updateNetTotal();
        updateBalance();
        updateAccDep();
    });

    totalSales.addEventListener('input', () => {
        updateNetTotal();
        updateBalance();
        updateAccDep();
    });
    deliverySales.addEventListener('input', () => {
        updateNetTotal();
        updateBalance();
        updateAccDep();
    });
    expenses.addEventListener('input', () => {
        updateNetTotal();
        updateBalance();
        updateAccDep();
    });
    due_amt.addEventListener('input', () => {
        updateNetTotal();
        updateBalance();
        updateAccDep();
    });
    due_pay.addEventListener('input', () => {
        updateNetTotal();
        updateBalance();
        updateAccDep();
    });

    nextPetty.addEventListener('input', () => {
        updateNetTotal();
        updateBalance();
        updateAccDep();
    });
    outdoorSales.addEventListener('input', () => {
        updateNetTotal();
        updateBalance();
        updateAccDep();
    });

    // Add an event listener for the form submission
document.querySelector('.counter-form').addEventListener('submit', function (event) {
    // Disable the fields just before form submission
    five_h_t.disabled = false;
    two_h_t.disabled = false;
    one_h_t.disabled = false;
    fifty_t.disabled = false;
    twenty_t.disabled = false;
    ten_t.disabled = false;
    five_t.disabled = false;
    cash.disabled = false;
    net.disabled = false;
    shortage.disabled = false;
    excess.disabled = false;
    accDep.disabled = false;
    
    return true;
});

</script>

<?php
include('footer.php');
?>