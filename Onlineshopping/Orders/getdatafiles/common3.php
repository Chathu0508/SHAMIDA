<?php

include '../../mysqldbconnection.php';

$prodid = $_REQUEST['proid'];

$productprice ="";
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            } else {
                
                $sql = "SELECT product.id, 
                product.name, 
                product.price,
                category.name as 'catname',
                product.status 
                From product left join category on product.category_id =category.id 
                where product.id='".$prodid."' ";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {                 
                    while ($row = $result->fetch_assoc()) {   
                        $productprice= $row['price']."^".$row['catname'];                        
                    }
                }
            }
echo $productprice;
?>

