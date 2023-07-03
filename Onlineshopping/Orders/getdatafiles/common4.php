<?php

include '../../mysqldbconnection.php';

$orid = $_REQUEST['ordid'];

$proResult ="";
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            } else {
                $sql = "SELECT ordercreate.ordernumber as 'OrderNumber' ,
                customer.cusfullname as 'Customername' , 
                customer.contactno as 'customernumber' , 
                product.name as 'Productnumber' ,
                product.price as 'prodprice' ,
                ordercreate.qty as 'Orderqty' ,
                ordercreate.total as 'totalamount' ,
                ordercreate.createdate as 'date' ,
                ordercreate.status  as 'OrderStatus' 
                From ordercreate 
                LEFT JOIN customer on ordercreate.customer_id=customer.id 
                LEFT JOIN product on ordercreate.product_id= product.id
                where ordercreate.id='".$orid."' ";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {                 
                    while ($row = $result->fetch_assoc()) {                      
                        $proResult= $row['Customername']."^".$row['Productnumber']."^".$row['prodprice']."^".$row['Orderqty']."^".$row['totalamount'];                       
                    }
                }
            }
echo $proResult;
?>

