<?php

include '../mysqldbconnection.php';
$rawid = $_REQUEST['rawmid'];

$rawMaterialList ="";
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            } else {
                
                $sql = "SELECT * From raw_metiral where id='".$rawid."' ";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {                 
                    while ($row = $result->fetch_assoc()) {                      
                        $rawMaterialList= $row['type'];                       
                    }
                }
            }
echo $rawMaterialList;










?>



