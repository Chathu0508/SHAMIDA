<?php
$ordernumber = "";
$paymentmethod = "";
$paymentstatus = "";
$payamount = "";
$payblance = "";
$statusp = "";

include '../mysqldbconnection.php';

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    $my_id = $_REQUEST['myid'];

    $sql = "SELECT * FROM paymentmethod WHERE  id='$my_id' ";
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            $ordernumber = $row["order_id"];
            $paymentmethod = $row["payment_method"];
            $paymentstatus = $row["payment_status"];
            $payamount = $row["amount_pay"];
            $payblance = $row["blance_pay"];
            $statusp = $row["status"];
        }
    }
}

?>
<div class="modal-body">
    <form action="paymentupdate.php" method="POST" name="staffadd">
        <input style="display: none;" type="text" name="sid" id="sid" value="<?php echo $my_id; ?>" required />

        <label>Order number : </label><br>
        <input class="form-control" type="text" name="ordernumber" id="ordernumber" value="<?php echo $ordernumber; ?>" readonly />
        <br />
        <label>Payment method : </label><br>
        <input class="form-control" type="text" name="paymentmethod" id="paymentmethod" value="<?php echo $paymentmethod; ?>" readonly />
        <br>
        <label>Payment Current Status : </label><br>
        <input class="form-control" type="text" name="paymentstatus" id="paymentstatus" value="<?php echo $paymentstatus; ?>" readonly />
        <br>
        <label>Amount Pay (Rs.):</label><br>
        <input class="form-control" type=" text" name="Amountpay" id="Amountpay" value="<?php echo $payamount; ?>" readonly />
        <br />
        <label>Balacne Amount (Rs.):</label><br>
        <input class="form-control" type=" text" name="BalacePayment" id="BalacePayment" value="<?php echo $payblance; ?>" readonly/>
        <br />

        <label>Payment Current Status : </label><br>
        <input class="form-control" type="text" name="paystatusss" id="paystatusss" value="<?php echo $statusp; ?>" readonly />
        <br>
        
        <label>Amount Pay (Rs.):</label><br>
        <input class="form-control" type=" text" name="amountPayment" id="amountPayment" value="" />
        <br />



        <label>Payment Status : </label><br>
        <select class="form-control" name="PaymentStatusChange" id="PaymentStatusChange" required>
            <option value="">Select the type</option>
            <option value="Due Payments">Due Payments</option>
            <option value="Full Payment">Full Payment</option>
        </select><br>

        <label>Order status : </label><br>
        <select class="form-control" name="orderstatus" id="orderstatus" required>
            <option value="">Select the type</option>
            <option value="Due Payment Complete ">Due Payment Complete</option>
            <option value="Payment not Complete">Payment not Complete</option>
        </select><br>

        <div class="d-grid gap-2">
            <input class="btn btn-secondary" type="submit" value="Submit" />
        </div>
    </form>
</div>