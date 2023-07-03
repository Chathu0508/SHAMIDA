<?php
if (isset($_POST["orno"]) && $_POST["orno"] != NULL) {
    $oid = $_POST["orno"];
    $Customerid = $_POST["cusname"];
    $CustomerNumber = $_POST["cusno"];
    $Productid = $_POST["prono"];
    $ProductPrice = $_POST["proprice"];
    $date = $_POST["date"];
    $OrderStatus = $_POST["orderstaus"];
    $id=$_POST["sid"];
    echo "<script> alert('00001');</script>";


    include '../mysqldbconnection.php';

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        $sql = "UPDATE ordercreate SET status='$OrderStatus'WHERE id='$id'";
        echo "<script> alert('00002');</script>";

        if ($conn->query($sql) === TRUE) {
            echo "<script> alert('order changes compelte');</script>";
            $_POST["suppname"] = NULL;
              header("Location: order.php");
            exit();
        } else {
            echo "<script> alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
        }
        $conn->close();
    }
}
?>