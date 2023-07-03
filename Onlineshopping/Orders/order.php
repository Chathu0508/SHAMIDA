<?php
include '.././Interface/Sharelayouts/header.php';

?>
<div class="box-btn">
    <a class="btn btn-secondary" href="DashboardOrdersandPayments.php"><i class="bi bi-backspace-fill"></i> Go Back to Inventory Page</a>
</div>
<div class="container shadow-lg box">
    <h3>New order Entry </h3>

    <form action="order.php" method="POST" name="staffadd">
        <label>Customer Id</label>
        <select class="form-control" name="cusname" id="cusname" onchange="getcustno();" required>
            <option>Select Customer ID</option>
            <?php
            include '../mysqldbconnection.php';
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            } else {

                $sql = "SELECT *  From customer where status='Active Customer'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['id'] . '">' . $row['cust_no'] . '</option>';
                    }
                }
            }
            ?>
        </select>
        <br>

        <label>NAme of the Customer</label>
        <input class="form-control" type=" text" name="custname" id="custname" value="" required />
        <br>

        <label>contact number</label>
        <input class="form-control" type=" text" name="cusno" id="cusno" value="" required />
        <br>

        <label>Number of the Product :</label><br>
        <select class="form-control" name="pname" id="pname" onchange="Getprodution();" required>
            <option value="">Select the protect Number</option>
            <?php
            include '../mysqldbconnection.php';
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            } else {

                $sql = "SELECT *  From product WHERE status = 'Avaible Production'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                    }
                }
            }
            echo "hi01"
            ?>

        </select>
        <br />
        <label>Price of the product (Rs.):</label><br>
        <input class="form-control" type=" text" name="pprice" id="pprice" value="" required />
        <br />
        <label>Category of the product (Rs.):</label><br>
        <input class="form-control" type=" text" name="pcate" id="pcate" value="" required />
        <br />
        <label>Prursching Qty:</label><br>
        <input class="form-control" type="number" name="pqty" id="pqty" value="" required />
        <br />
        <label>Order Create date:</label><br>
        <input class="form-control" type="date" name="takedate" id="takedate"><br>
        <br />
        <div class="d-grid gap-2">
            <input class="btn btn-success btn-update" type="submit" value="Submit" />
        </div>
    </form>
</div>
<div class=" shadow-lg box01">
    <div class="container ">
        <a class="d-grid gap-2 btn btn-success" href='./order.php'><i class="bi bi-arrow-clockwise"></i></a> <br>
    </div>
    <h3 style="padding-bottom: 15px;">Order Creating</h3>
    <div class="box05">
        <table id="example" class="table table-dark table-striped text-center" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Order id </th>
                    <th>Customer Code</th>
                    <th>Product Number</th>
                    <th>Product price</th>
                    <th>Quntity</th>
                    <th>Total </th>
                    <th>Create Date</th>
                    <th>Order status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../mysqldbconnection.php';
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                } else {

                    $sql = "SELECT 
                ordercreate.id,
                ordercreate.ordernumber as 'OrderNumber' ,
                customer.cust_no as 'Customerno' , 
                product.name as 'Productnumber' ,
                product.price as 'prodprice' ,
                ordercreate.qty as 'orderqty' ,
                ordercreate.total as 'Totalprice' ,
                ordercreate.createdate as 'date' ,
                ordercreate.status  as 'OrderStatus' 
                From ordercreate 
                LEFT JOIN customer on ordercreate.customer_id=customer.id 
                LEFT JOIN product on ordercreate.product_id= product.id
";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $my_id = $row["id"];

                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["OrderNumber"] . "</td>";
                            echo "<td>" . $row["Customerno"] . "</td>";
                            echo "<td>" . $row["Productnumber"] . "</td>";
                            echo "<td>" . $row["prodprice"] . "</td>";
                            echo "<td>" . $row["orderqty"] . "</td>";
                            echo "<td>" . $row["Totalprice"] . "</td>";
                            echo "<td>" . $row["date"] . "</td>";
                            echo "<td> <span class='badge rounded-pill text-bg-primary'>" . $row['OrderStatus'] . "</span> </td>";
                            if ($row["OrderStatus"] == 'Proceed to Payment method') {
                                echo "<td><button   myid='" . $row['id'] . "' class='myModal btn btn-success' data-toggle='modal' data-target='#exampleModalCenter'><i class='bi bi-pen-fill'></i></button></td>";
                            } else {
                                echo "<td> <button   myid='" . $row['id'] . "' class='myModal btn btn-danger' data-toggle='modal'  data-target='#exampleModalCenter' disabled ><i class='bi bi-pen-fill'></button></td>";
                            }
                            echo "</tr>";
                        }
                    }
                    $conn->close();
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Customer Details </h5>
                    <button id="hidem" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div id="modalContent"></div>

                <div class="modal-footer">
                    <button type="button" id="bdel" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable();
        });
        $('button.myModal').on('click', function() {

            var bb = $(this).attr("myid");
            $.ajax({
                url: 'ordermodal.php?myid=' + bb,
                type: 'GET',
                success: function(data) {
                    $('#modalContent').html(data);
                }
            });

            $('#exampleModalCenter').modal('show');
        });
        $('#bdel').on('click', function() {
            $('#exampleModalCenter').modal('hide');
        });
        $('#hidem').on('click', function() {
            $('#exampleModalCenter').modal('hide');
        });

        //get the data for the textboxs
        function getcustno() {
            var cusId = $('#cusname').val();
            $.ajax({
                url: './getdatafiles/common2.php?cuid=' + cusId,
                type: 'GET',
                success: function(data) {
                    const myArray = data.split("^");

                    $('#custname').val(myArray[0]);
                    $('#cusno').val(myArray[1]);

                }
            });
        }

        function Getprodution() {
            var prodid = $('#pname').val();
            $.ajax({
                url: './getdatafiles/common3.php?proid=' + prodid,
                type: 'GET',
                success: function(data) {
                    const myArray = data.split("^");

                    $('#pprice').val(myArray[0]);
                    $('#pcate').val(myArray[1]);
                }
            });
        }
    </script>
    <?php include './../Interface/Sharelayouts/Footer.php'; ?>

    <?php
    if (isset($_POST["cusname"]) && $_POST["cusname"] != NULL) {
        $Customerid = $_POST["cusname"];
        $Productid = $_POST["pname"];
        $ProductPrice = $_POST["pprice"];
        $Quentity = $_POST["pqty"];
        $totalprice = $ProductPrice * $Quentity;
        $date = $_POST["takedate"];
        $oid = "";
        //order number auto create when inserting the data 
        include '../mysqldbconnection.php';
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        } else {
            $sql = "SELECT max(id) as 'orid' FROM ordercreate";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $oid =  $row["orid"];
                    $oid++;
                }
            } else {
                echo "<script> alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
            }
            $conn->close();
        }
        include '../mysqldbconnection.php';
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        } else {
            $sql = "INSERT INTO ordercreate (customer_id, product_id, price, qty, total, createdate, status ,ordernumber) 
        VALUES ('" . $Customerid . "','" . $Productid . "','" . $ProductPrice . "','" . $Quentity . "','" . $totalprice . "','" . $date . "','Proceed to Payment method','ORD000" . $oid . "' )";
            if ($conn->query($sql) === TRUE) {
                echo "<script> alert('Order is Create and Proceed to Payment');</script>";
                $_POST["cusname"] = NULL;
                //   header("Location: NewFuelStation.php");
                exit();
            } else {
                echo "<script> alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
            }
            $conn->close();
        }
    }
    ?>