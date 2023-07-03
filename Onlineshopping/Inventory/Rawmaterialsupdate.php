<?php
if (isset($_POST["rawname"]) && $_POST["rawname"] != NULL) {

    $Rawname = $_POST["rawname"];
    $Rawtype = $_POST["rawtypw"];
    $Rawstatus = $_POST["cstaus"];
    $id=$_POST["sid"];

    include '../mysqldbconnection.php';

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        $sql = "UPDATE raw_metiral Set 
        name ='$Rawname',
        type='$Rawtype',
        status ='$Rawstatus'
        Where id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "<script> alert('Raw material details is successfully update');</script>";
            $_POST["rawname"] = NULL;
              header("Location: Rawmaterials.php");
              

            exit();
        } else {
            echo "<script> alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
        }
        $conn->close();
    }
}
?>