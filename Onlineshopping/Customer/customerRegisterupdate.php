<?php
if (isset($_POST["cuname"]) && $_POST["cuname"] != null) {
    $Cusname = $_POST["cuname"];
    $Cusnic = $_POST["cunic"];
    $Cusnunmber = $_POST["cunumber"];
    $Cusemail = $_POST["cuemail"];
    $CusStatus = $_POST["statuss"];
    $id=$_POST["sid"];


    include '../mysqldbconnection.php';
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        $sql = "UPDATE customer Set status='$CusStatus' Where id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "<script> alert('Customer is Successfully Update');</script>";
            $_POST["cuname"] = NULL;
              header("Location: customerRegister.php");
              

            exit();
        } else {
            echo "<script> alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
        }
        $conn->close();
    }
}
?>