<?php
if (isset($_POST["cname"]) && $_POST["cname"] != NULL) {

    $Categoryname = $_POST["cname"];
    $Categorydescription = $_POST["cdescription"];
    $Categorystatus = $_POST["cstaus"];
    $id=$_POST["sid"];

    include '../mysqldbconnection.php';

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        $sql = "UPDATE category Set 
        name ='$Categoryname',
        description='$Categorydescription',
        status ='$Categorystatus'
        Where id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "<script> alert('category is Successfully Update');</script>";
            $_POST["cname"] = NULL;
              header("Location: category.php");
              

            exit();
        } else {
            echo "<script> alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
        }
        $conn->close();
    }
}
?>