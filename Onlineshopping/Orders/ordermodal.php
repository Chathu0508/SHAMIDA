<?php
$Customerid = "";
$CustomerNumber = "";
$Productid = "";
$ProductPrice = "";
$date = "";
$OrderStatus = "";
$oid = "";


include '../mysqldbconnection.php';

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    $my_id = $_REQUEST['myid'];
    $sql = "SELECT 
    ordercreate.ordernumber as 'orderno', 
    customer.cust_no as 'customerNo',
    customer.contactno as 'customernumber', 
    product.name as 'productnumber', 
    product.price as 'prioductprice', 
    ordercreate.createdate as'date', 
    ordercreate.status as 'status'
    FROM ordercreate 
    LEFT JOIN customer on ordercreate.customer_id = customer.id 
    LEFT JOIN product on ordercreate.product_id=product.id 
    WHERE  ordercreate.id='$my_id' ";

    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            $oid = $row["orderno"];
            $Customerid = $row["customerNo"];
            $CustomerNumber = $row["customernumber"];
            $Productid = $row["productnumber"];
            $ProductPrice = $row["prioductprice"];
            $date = $row["date"];
            $OrderStatus = $row["status"];

?>
            <div class="modal-body">
                <form action="orderupdate.php" method="POST" name="staffadd">
                    <input style="display: none;" type="text" name="sid" id="sid" value="<?php echo $my_id; ?>" required />

                    <label>Order number : </label><br>
                    <input class="form-control" type="text" name="orno" id="orno" value="<?php echo $oid; ?>" readonly />
                    <br />
                    <label>Name of the customer</label>
                    <input class="form-control" type="text" name="cusname" id="cusname" value="<?php echo $Customerid; ?>" readonly />
                    <br />
                    <label>contact number</label>
                    <input class="form-control" type="text" name="cusno" id="cusno" value="<?php echo $CustomerNumber; ?>" readonly />
                    <br>
                    <label>Number of the Product :</label><br>
                    <input class="form-control" type="text" name="prono" id="prono" value="<?php echo $Productid; ?>" readonly />
                    <br>
                    <label>Price of the product (Rs.):</label><br>
                    <input class="form-control" type="text" name="proprice" id="proprice" value="<?php echo $ProductPrice; ?>" readonly />
                    <br>
                    <label>Order Create date:</label><br>
                    <input class="form-control" type="text" name="date" id="date" value="<?php echo $date; ?>" readonly />
                    <br>
                    <label>Order Ccurrent Status</label><br>
                    <input class="form-control" type="text" value="<?php echo $OrderStatus; ?>" readonly />
                    <br>

                    <label>Status of the Order :</label><br>
                    <select class="form-control" name="orderstaus" id="orderstaus" required>
                        <option value="">Select the status</option>
                        <option value="Cancel Order">Cancel Order</option>
                    </select><br>
                    <div class="d-grid gap-2">
                        <input class="btn btn-secondary" type="submit" value="Submit" />
                    </div>
                </form>
            </div>
<?php
        }
    }

    $conn->close();
}
?>