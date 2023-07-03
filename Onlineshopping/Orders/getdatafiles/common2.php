<?php

include '../../mysqldbconnection.php';

$cusid = $_REQUEST['cuid'];

$customernumber ="";
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            } else {
                
                $sql = "SELECT * From customer where id='".$cusid."' ";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {                 
                    while ($row = $result->fetch_assoc()) {   
                        $customernumber= $row['cusfullname']."^".$row['contactno'];                       
                    }
                }
            }
echo $customernumber;
?>

