<?php
if (isset($_POST["supname"]) && $_POST["supname"] != NULL) {

    $supliername = $_POST["supname"];
    $Rawname = $_POST["rawname"];
    $PriceList = $_POST["price"];
    $Unitnum = $_POST["unit"];
    $total = $_Post["total"];
    $statusp = $_POST["cstaus"];
    $id = $_POST["sid"];

    include '../mysqldbconnection.php';

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        $sql = "UPDATE cost Set status='$statusp' Where id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "<script> alert('category is Successfully Update');</script>";
            $_POST["supname"] = NULL;
            header("Location: stockfullcost.php");


            exit();
        } else {
            echo "<script> alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
        }
        $conn->close();
    }
}
