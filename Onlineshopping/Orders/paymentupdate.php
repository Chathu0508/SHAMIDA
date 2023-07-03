<?php
if (isset($_POST["ordernumber"]) && $_POST["ordernumber"] != NULL) {

    $ordernumber = $_POST["ordernumber"];

    $paymentmethod = $_POST["paymentmethod"];

    $paymentstatus = $_POST["PaymentStatusChange"];

    $firstpayment = $_POST["Amountpay"];

    $firstblance = $_POST["BalacePayment"] ;

    $amountPay = $_POST["amountPayment"];

    $payamount =$firstpayment + $amountPay;

    $balance = $firstblance-$amountPay;


    $Orderstatus = $_POST["orderstatus"];
    echo "<script> alert('cPayment changes completed01 ');</script>";

    $id=$_POST["sid"];
    $order_id="";
    include '../mysqldbconnection.php';

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        $sql = "UPDATE paymentmethod Set 
        payment_status='$paymentstatus' ,	
        amount_pay='$payamount' , 
        blance_pay='$balance', 
        status='$Orderstatus' 
        Where id='$id'";

        if ($conn->query($sql) === TRUE) {
            $_POST["suppname"] = NULL;
        } else {
            echo "<script> alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
        }
        $conn->close();
    }



    // include '../mysqldbconnection.php';
    // if (!$conn) {
    //     die("Connection failed: " . mysqli_connect_error());
    // } else {
    //     $sql = "SELECT * From paymentmethod where id='".$id."'";
    //     $result = $conn->query($sql);

    //     if ($result->num_rows > 0) {
    //         while ($row = $result->fetch_assoc()) {
    //             $order_id = $row["order_id"];
    //         }
    //     }


    // }






    include '../mysqldbconnection.php';
    if (!$conn) {

        die("Connection failed: " . mysqli_connect_error());
    } else {

        $sql = "UPDATE ordercreate SET status='" . $Orderstatus . "' Where id='".$order_id."'";
        if ($conn->query($sql) === TRUE) {
            echo "<script> alert('order is Update ');</script>";
           
            header("Location: payment.php");
        } else {
            echo "<script> alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
        }
        $conn->close();
    }

}
?>