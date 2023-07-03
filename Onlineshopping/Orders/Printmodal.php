<?php
$ordernumbers = "";
$Customerid = "";
$CustomerName = "";
$Customercon = "";
$prodcutname = "";
$prodcutprice = "";
$productcategory="";
$date = "";
$paymentmethod = "";
$paymentstatus = "";
$payamount = "";
$payblance = "";
$Orderstatus = "";

include '../mysqldbconnection.php';

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    $my_id = $_REQUEST['myid'];

    $sql = "SELECT                
                ordercreate.id,
                ordercreate.ordernumber as 'Ordernumber', 
                customer.cust_no as 'CustomerNumber', 
                customer.cusfullname as 'CustomerName',
                customer.	contactno as 'customerContact',
                product.name as 'productionname' ,
                category.name as 'productCategory', 
                product.price as 'productionprice' ,
                ordercreate.qty as 'orderqty' ,
                ordercreate.total as 'TotalAmount' ,
                ordercreate.createdate as 'OrderCreatedate', 
                paymentmethod.payment_method as 'paymenttype', 
                paymentmethod.payment_status as 'paymentstatus', 
                paymentmethod.amount_pay as 'PaymentAmount', 
                paymentmethod.blance_pay as 'Balancepayment', 
                ordercreate.status as 'OrderStatus' 
                FROM ordercreate 
                LEFT JOIN customer on ordercreate.customer_id = customer.id 
                LEFT JOIN product on ordercreate.product_id = product.id  
                LEFT JOIN category on product.category_id =category.id  
                INNER JOIN paymentmethod on paymentmethod.order_id = ordercreate.id
                WHERE  ordercreate.id='$my_id' ";
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $ordernumbers = $row["Ordernumber"];
            $Customerid = $row["CustomerNumber"];
            $CustomerName = $row["CustomerName"];
            $Customercon = $row["customerContact"];
            $prodcutname = $row["productionname"];
            $productcategory = $row["productCategory"];
            $prodcutprice = $row["productionprice"];
            $Orderqunetity = $row["orderqty"];
            $Totalamountpay = $row["TotalAmount"];
            $date = $row["OrderCreatedate"];
            $paymentmethod = $row["paymenttype"];
            $paymentstatus = $row["paymentstatus"];
            $payamount = $row["PaymentAmount"];
            $payblance = $row["Balancepayment"];
            $Orderstatus = $row["OrderStatus"];

?>
            <div class="modal-body">
                <form action="PrintmodalInsert.php" method="POST" name="staffadd">
                    <input style="display: none;" type="text" name="sid" id="sid" value="<?php echo $my_id; ?>" required />

                    <label>Order number : </label><br>
                    <input class="form-control" type="text" name="Ordernumber" id="Ordernumber" value="<?php echo $ordernumbers; ?>" readonly />
                    <br />
                    <label>Customer number : </label><br>
                    <input class="form-control" type="text" name="Customernumber" id="Customernumber" value="<?php echo $Customerid; ?>" readonly />
                    <br />
                    <label>Customer name : </label><br>
                    <input class="form-control" type="text" name="Customername" id="Customername" value="<?php echo $CustomerName; ?>" readonly />
                    <br />
                    <label>Customer name : </label><br>
                    <input class="form-control" type="text" name="Customercontact" id="Customercontact" value="<?php echo $Customercon; ?>" readonly />
                    <br />
                    <label>Product Number : </label><br>
                    <input class="form-control" type="text" name="Productnumber" id="Productnumber" value="<?php echo $prodcutname; ?>" readonly />
                    <br />
                    <label>Product Number : </label><br>
                    <input class="form-control" type="text" name="Productcategory" id="Productcategory" value="<?php echo $productcategory; ?>" readonly />
                    <br />
                    <label>Product price : </label><br>
                    <input class="form-control" type="text" name="Productprice" id="Productprice" value="<?php echo $prodcutprice; ?>" readonly />
                    <br />
                    <label>Order Quentity : </label><br>
                    <input class="form-control" type="text" name="orderqty" id="orderqty" value="<?php echo $Orderqunetity; ?>" readonly />
                    <br />
                    <label>Product price : </label><br>
                    <input class="form-control" type="text" name="totalamount" id="totalamount" value="<?php echo $Totalamountpay; ?>" readonly />
                    <br />
                    <label>Order Create date : </label><br>
                    <input class="form-control" type="text" name="dateofcreate" id="dateofcreate" value="<?php echo $date; ?>" readonly />
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
                    <input class="form-control" type=" text" name="BalacePayment" id="BalacePayment" value="<?php echo $payblance; ?>" readonly />
                    <br />

                    <label>Order Status : </label><br>
                    <input class="form-control" type="text" name="orderstatus" id="orderstatus" value="<?php echo $Orderstatus; ?>" readonly />
                    <br>


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