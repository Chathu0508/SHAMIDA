<?php
include '.././Interface/Sharelayouts/header.php';

?>
<style type="text/css">
    body {
        background: #ADA996;
        /* fallback for old browsers */
        background: -webkit-linear-gradient(to right, #EAEAEA, #DBDBDB, #F2F2F2, #ADA996);
        /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to right, #EAEAEA, #DBDBDB, #F2F2F2, #ADA996);
        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */


    }

    h1 {
        /* padding-bottom: 10px; */
        font-family: 'Dancing Script', cursive;
        font-size: 60px;
        text-align: center;
    }

    hr {
        background-color: #000000;
    }

    h3 {
        font-family: 'Castoro Titling', cursive;
        font-size: 20px;
        text-align: left;
    }

    h6 {
        font-size: 10px;
        font-family: 'Castoro Titling', cursive;

    }

    .slogun {
        font-family: 'Castoro Titling', cursive;
        text-align: center;
        font-size: 15px;

    }

    .reheader {
        padding-top: 10px;
        padding-left: 20px;
        margin-left: 20px;

    }

    .roco {
        font-size: 25px;
        padding-left: 50px;


    }

    .sp {
        text-align: left;
        font-size: 18px;
        font-weight: 10%;

    }

    .layble01 {
        padding-top: 10px;
    }
</style>
<?php
$ordernumbers = "";
$Customerid = "";
$CustomerName = "";
$Customercon = "";
$prodcutname = "";
$prodcategory = "";
$prodcutprice = "";
$Orderqunetity = "";
$Totalamountpay = "";
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
    $sql = "SELECT * FROM printout WHERE  id='$my_id' ";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $ordernumbers = $row["ordernumber"];
            $Customerid = $row["customer_id"];
            $CustomerName = $row["custname"];
            $Customercon = $row["contactnumber"];
            $prodcutname = $row["productno"];
            $prodcategory = $row["product_category"];
            $prodcutprice = $row["prodoctprice"];
            $Orderqunetity = $row["qty"];
            $Totalamountpay = $row["total"];
            $date = $row["createdate"];
            $paymentmethod = $row["paymentmethod"];
            $paymentstatus = $row["paymentstatus"];
            $payamount = $row["amountpay"];
            $payblance = $row["blancepay"];
            $Orderstatus = $row["orderstatus"];
?>
            <div class="container-fluid">
                <div class="layble01">
                    <div class="text-center">
                        <h1 class="text-center">Shaminda Jewelers (PVT)Ltd. </h1>
                        <p class="slogun">From the finest Craftmen to the beautiful woman and handsome gentleman</p>
                        <h6><i class="bi bi-house"></i> B479, Yakkala, Gampaha , Srilanka </h6>
                    </div>
                </div>
                <hr>
            </div>
            <div class="box05">
                <div class="card">
                    <div class="reheader box04">
                        <p class="sp"><i class="bi bi-receipt"></i> Receipt No: <?php echo $ordernumbers ?></p>
                        <p class="sp">Date: <?php echo $date ?></p>
                        <hr>
                    </div>
                    <div class="roco">Customer Deatials</div>

                    <table class="reheader box04">
                        <th width="20"></th>
                        <th width="10"></th>
                        <th width="350"></th>
                        <tr>
                            <td>Customer Id No.</td>
                            <td>:</td>
                            <td><?php echo $Customerid ?> </td>
                        </tr>
                        <tr>
                            <td>Customer name</td>
                            <td>:</td>
                            <td><?php echo $CustomerName ?> </td>

                        </tr>
                        <tr>
                            <td>ontact number</td>
                            <td>:</td>
                            <td><?php echo $Customercon ?> </td>

                        </tr>
                    </table>

                    <table class="table table-striped fonts">
                        <tr>
                            <th width="100">Product No.</th>
                            <th width="200">Product Category</th>
                            <th width="50">Qty</th>
                            <th width="130">product Price</th>
                            <th width="130" class="text-end">Amount</th>
                        </tr>


                        <?php $x = 0 ?>
                        <!--?php foreach ($obj['data'] as $row) : $x++ ?-->
                        <tr>
                            <td><?php echo $prodcutname ?></td>
                            <td><?php echo $prodcategory ?></td>
                            <td><?php echo $Orderqunetity ?></td>
                            <td><?php echo number_format($prodcutprice, 2) ?></td>
                            <td class="text-end"><?php echo number_format($Totalamountpay, 2) ?></td>
                        </tr>

                        <br>

                        <!--?php endforeach; ?-->
                        <tr>
                            <td colspan="3"></td>
                            <td class="fs-5 fw-bold">Total Amount</td>
                            <td class="fs-5 fw-bold text-end ">Rs.<?php echo number_format($Totalamountpay, 2) ?></td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td class="fs-6">Paid Amount (<?php echo $paymentmethod ?>)</td>
                            <td class="fs-6 text-end">Rs.<?php echo number_format($payamount, 2) ?></td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td class="fs-5">Due Amount <br>(<?php echo $paymentstatus ?> only)</td>
                            <td class="fs-5 text-end">Rs.<?php echo number_format($payblance, 2) ?></td>
                        </tr>
                    </table>
                    <br><br>
                </div>
    <?php
        }
    }

    $conn->close();
}
    ?>
    <br>
    <div class="text-center">
        <p>Thanks for Choosing Shaminda Jewelers (PVT)</p>
    </div>