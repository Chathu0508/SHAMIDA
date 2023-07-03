<?php
if (isset($_POST["Ordernumber"]) && $_POST["Ordernumber"] != NULL) {

  $ordernumbers = $_POST["Ordernumber"];
  $Customerid = $_POST["Customernumber"];
  $CustomerName = $_POST["Customername"];
  $Customercon = $_POST["Customercontact"];
  $prodcutname = $_POST["Productnumber"];
  $productcategory=$_POST["Productcategory"];
  $prodcutprice = $_POST["Productprice"];
  $Orderqunetity = $_POST["orderqty"];
  $Totalamountpay = $_POST["totalamount"];
  $date = $_POST["dateofcreate"];
  $paymentmethod = $_POST["paymentmethod"];
  $paymentstatus = $_POST["paymentstatus"];
  $payamount = $_POST["Amountpay"];
  $payblance = $_POST["BalacePayment"];
  $Orderstatus = $_POST["orderstatus"];
  include '../mysqldbconnection.php';
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  } else {
    echo "<script> alert('update 04');</script>";

    $sql = "INSERT INTO printout 
        (ordernumber, customer_id, 	custname, contactnumber, productno, product_category, prodoctprice, qty, total, createdate, paymentmethod, paymentstatus,	amountpay, blancepay, orderstatus) 
        VALUES (
          '" . $ordernumbers . "', 
          '" . $Customerid . "', 
          '" . $CustomerName . "',
          '" . $Customercon . "',
          '" . $prodcutname . "',
          '" . $productcategory . "',
          '" . $prodcutprice . "',
          '" . $Orderqunetity . "',
          '" . $Totalamountpay . "',
          '" . $date . "',
          '" . $paymentmethod . "',
          '" . $paymentstatus . "',
          '" . $payamount . "',
          '" . $payblance . "',
          '" . $Orderstatus . "'
          )";
    if ($conn->query($sql) === TRUE) {
      echo "<script> alert('To print done');</script>";
      $_POST["Ordernumber"] = NULL;
        header("Location: DashboardOrdersandPayments.php");
       exit();

    } else {
      echo "<script> alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
    }
    $conn->close();
  }
}
