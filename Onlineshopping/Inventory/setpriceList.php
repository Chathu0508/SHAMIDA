<?php 
include '../mysqldbconnection.php';

$supid = $_REQUEST['supid'];
$rawname = $_REQUEST['rawname'];

$pricecall="";

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            } else {
                
                $sql = "SELECT pricetable.price From pricetable left join supplierdeatils on pricetable.supplier_id = supplierdeatils.id 
                where supplierdeatils.id='".$supid."' and  pricetable.rawmetiral_id='".$rawname."'";
// $sql ="SELECT * FROM pricetabel"
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {                 
                    while ($row = $result->fetch_assoc()) {   
                        $pricecall= $row['price'];                       
                    }
                }
            }
echo $pricecall;
