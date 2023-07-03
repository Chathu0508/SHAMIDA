<?php
if (isset($_POST["suppname"]) && $_POST["suppname"] != NULL) {

    $suppname = $_POST["suppname"];
    $suppcont = $_POST["suppcont"];
    $suppadds = $_POST["suppadd"];
    $suppstatus = $_POST["status"];
    $id=$_POST["sid"];

    include '../mysqldbconnection.php';

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        $sql = "UPDATE supplierdeatils Set 
        -- name ='$Categoryname',
        contactnumber='$suppcont',
        address='$suppadds',
        status ='$suppstatus'
        Where id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "<script> alert('category is Successfully Update');</script>";
            $_POST["suppname"] = NULL;
              header("Location: Suppiler.php");
            exit();
        } else {
            echo "<script> alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
        }
        $conn->close();
    }
}
?>