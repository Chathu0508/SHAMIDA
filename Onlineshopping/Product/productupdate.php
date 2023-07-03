<?php
if (isset($_POST["pname"]) && $_POST["pname"] != NULL) {

    $productname = $_POST["pname"];
    $productdescription = $_POST["pdescription"];
    $productprice = $_POST["pprice"];
    $procategory_id = $_POST["pcategory"];
    $productstatus = $_POST["cstaus"];
    $id=$_POST["sid"];


    include '../mysqldbconnection.php';
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        $sql = "UPDATE product Set 
        price='$productprice',
        status='$productstatus'
        Where id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "<script> alert('category is Successfully Update');</script>";
            $_POST["cname"] = NULL;
              header("Location: product.php");
              

            exit();
        } else {
            echo "<script> alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
        }
        $conn->close();
    }
}
?>