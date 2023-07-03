<?php
include '.././Interface/Sharelayouts/header.php';

?>
<div class="box-btn">
    <a class="btn btn-secondary" href="DashboardOrdersandPayments.php"><i class="bi bi-backspace-fill"></i> Go Back to Inventory Page</a>
</div>
<div class="container box shadow-lg">
    <h3>Payment Settlement </h3>

    <form action="payment.php" method="POST" name="staffadd">

        <label>Order number : </label><br>
        <select class="form-control" name="orderno" id="orderno" onchange="getorderno();">
            <option value="">Select the order type</option>
            <?php
            include '../mysqldbconnection.php';
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            } else {

                $sql = "SELECT *  From ordercreate where status='Proceed to Payment method'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['id'] . '">' . $row['ordernumber'] . '</option>';
                    }
                }
            }
            ?>
        </select>
        <br />
        <label>Name of the customer</label>
        <input class="form-control" type=" text" name="cusno" id="cusno" value="" required />
        <br>
        <label>Number of the Product :</label><br>
        <input class="form-control" type=" text" name="prodno" id="prodno" value="" required />
        <br>
        <label>Price of the product (Rs.):</label><br>
        <input class="form-control" type=" text" name="prodcutprice" id="prodcutprice" value="" required />
        <br />
        <label>Quentity (Rs.):</label><br>
        <input class="form-control" type=" text" name="orderqty" id="orderqty" value="" required />
        <br />
        <label>Total (Rs.):</label><br>
        <input class="form-control" type=" text" name="ordertotal" id="ordertotal" value="" required />
        <br />

        <label>Payment method : </label><br>
        <select class="form-control" name="payMethos" id="payMethos" required>
            <option value="">Select the type</option>
            <option value="Cash">Cash</option>
            <option value="Bank transfer">Bank transfer</option>
            <option value="Creadit or Debit Card">Creadit or Debit Card</option>
        </select><br>
        <label>Payment Status : </label><br>
        <select class="form-control" name="paystatuss" id="paystatuss" required>
            <option value="">Select the type</option>
            <option value="Full Payment ">Full Payment</option>
            <option value="Advance payment">Advance Payment</option>
            <option value="Pending payment ">Pending Payment</option>
        </select><br>
        <label>Amount Pay (Rs.):</label><br>
        <input class="form-control" type=" text" name="amountpay" id="amountpay" value="" />
        <br />
        <label>Order status : </label><br>
        <select class="form-control" name="orstatuss" id="orstatuss" required>
            <option value="">Select the type</option>
            <option value="Payment Complete ">Payment Complete</option>
            <option value="Payment not Complete">Payment not Complete</option>
        </select><br>
        <div class="d-grid gap-2">
            <input class="btn btn-success" type="submit" value="Submit" />
        </div>
    </form>
</div>

<div class=" shadow-lg box01">
    <div class="container ">
        <a class="d-grid gap-2 btn btn-success" href='./payment.php'><i class="bi bi-arrow-clockwise"></i></a> <br>
    </div>

    <h3 style="padding-bottom: 15px;">Order payments </h3>
    <div class="box05">

        <table id="example" class="table table-striped text-center" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Order id </th>
                    <th>Payments Method </th>
                    <th>Payment Status</th>
                    <th>amount pay</th>
                    <th>Balance Payments</th>
                    <th>Order status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../mysqldbconnection.php';
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                } else {

                    $sql = "SELECT 
                paymentmethod.id ,
                ordercreate.ordernumber as 'orderno', 
                paymentmethod.payment_method as 'paymenttyep', 
                paymentmethod.payment_status as 'paymentStats', 
                paymentmethod.amount_pay as 'amount_pay', 
                paymentmethod.blance_pay as 'blance', 
                paymentmethod.status  
                FROM paymentmethod 
                LEFT JOIN ordercreate on paymentmethod.order_id=ordercreate.id";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $my_id = $row["id"];

                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["orderno"] . "</td>";
                            echo "<td>" . $row["paymenttyep"] . "</td>";
                            echo "<td>" . $row["paymentStats"] . "</td>";
                            echo "<td>" . $row["amount_pay"] . "</td>";
                            echo "<td>" . $row["blance"] . "</td>";
                            // echo "<td>" . $row["status"] . "</td>";
                            if ($row["status"] == 'Payment not Complete') {
                                echo "<td> <span class='badge rounded-pill text-bg-danger'>" . $row['status'] . "</span> </td>";
                            } else {
                                echo "<td> <span class='badge rounded-pill text-bg-success'>" . $row['status'] . "</span> </td>";
                            }

                            if ($row["status"] == 'Payment not Complete') {
                                echo "<td><button   myid='" . $row['id'] . "' class='myModal btn btn-success' data-toggle='modal' data-target='#exampleModalCenter'><i class='bi bi-pen-fill'></i></button></td>";
                            } else {
                                echo "<td> <button   myid='" . $row['id'] . "' class='myModal btn btn-danger' data-toggle='modal'  data-target='#exampleModalCenter' disabled ><i class='bi bi-pen-fill'></button></td>";
                            }
                        }
                    }
                    $conn->close();
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Customer Details </h5>
                <button id="hidem" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div id="modalContent"></div>

            <div class="modal-footer">
                <button type="button" id="bdel" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    });


    $('button.myModal').on('click', function() {

        var bb = $(this).attr("myid");
        $.ajax({
            url: 'paymentmodel.php?myid=' + bb,
            type: 'GET',
            success: function(data) {
                $('#modalContent').html(data);
            }
        });

        $('#exampleModalCenter').modal('show');
    });
    $('#bdel').on('click', function() {
        $('#exampleModalCenter').modal('hide');
    });
    $('#hidem').on('click', function() {
        $('#exampleModalCenter').modal('hide');
    });

    function getorderno() {
        var orid = $('#orderno').val();
        $.ajax({
            url: './getdatafiles/common4.php?ordid=' + orid,
            type: 'GET',
            success: function(data) {
                const myArray = data.split("^");

                $('#cusno').val(myArray[0]);
                $('#prodno').val(myArray[1]);
                $('#prodcutprice').val(myArray[2]);
                $('#orderqty').val(myArray[3]);
                $('#ordertotal').val(myArray[4]);
            }
        });
    }
</script>


<?php include './../Interface/Sharelayouts/Footer.php'; ?>
<?php
if (isset($_POST["orderno"]) && $_POST["orderno"] != NULL) {

    $ordernumbers = $_POST["orderno"];
    $prodcutprice = $_POST["prodcutprice"];
    $total = $_POST["ordertotal"];
    $paymentmethod = $_POST["payMethos"];
    $paymentstatus = $_POST["paystatuss"];
    $payamount = $_POST["amountpay"];
    $payblance = $total - $payamount;
    $Orderstatus = $_POST["orstatuss"];


    include '../mysqldbconnection.php';
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        $sql = "INSERT INTO paymentmethod (order_id, payment_method, payment_status,amount_pay,blance_pay, status) 
        VALUES  ('" . $ordernumbers . "', '" . $paymentmethod . "', '" . $paymentstatus . "','" . $payamount . "','" . $payblance . "','" . $Orderstatus . "')";
        if ($conn->query($sql) === TRUE) {
            $_POST["supname"] = NULL;
            //   header("Location: NewFuelStation.php");
            //  exit();

        } else {
            echo "<script> alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
        }
        $conn->close();
    }


    include '../mysqldbconnection.php';
    if (!$conn) {
        echo "<script> alert('order is Update01 ');</script>";

        die("Connection failed: " . mysqli_connect_error());
    } else {

        $sql = "UPDATE ordercreate SET status='" . $Orderstatus . "' WHERE id='" . $ordernumbers . "'";
        if ($conn->query($sql) === TRUE) {
            echo "<script> alert('Payment is done and order is Update ');</script>";

            exit();
        } else {
            echo "<script> alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
        }
        $conn->close();
    }
}
?>