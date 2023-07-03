<?php
if (isset($_POST["supname"]) && $_POST["supname"] != NULL) {

    $supliername = $_POST["supname"];
    $Rawname = $_POST["rawname"];
    $Rawtype = $_POST["rawtype"];
    $PriceList = $_POST["price"];
    $id = $_POST["sid"];

    include '../mysqldbconnection.php';

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        $sql = "UPDATE pricetable Set price='$PriceList' Where id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "<script> alert('price details is Successfully changes');</script>";
            $_POST["supname"] = NULL;
            header("Location: pricelist.php");


            exit();
        } else {
            echo "<script> alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
        }
        $conn->close();
    }
}
