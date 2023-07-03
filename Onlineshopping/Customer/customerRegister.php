<?php
include '.././Interface/Sharelayouts/header.php';
include '.././Interface/Navbar.php';
include '.././CSSRes/Res.php';
include '.././CSSRes/css.php';
?>
<div class="container box shadow-lg">
    <h3 class="box shadow-lg">Customer Registation </h3>

    <form action="customerRegister.php" method="POST" name="staffadd">


        <label>Name of the customer : </label><br>
        <input class="form-control" type="text" name="cuname" id="cuname" value="" required />
        <br />

        <label>National Identity Card Number : </label><br>
        <input class="form-control" type="text" name="cunic" id="cunic" value="" required />
        <br />

        <label>Contact Number : </label><br>
        <input class="form-control" type="text" name="cunumber" id="cunumber" value="" required />
        <br />

        <label>Customer Mail : </label><br>
        <input class="form-control" type="text" name="cuemail" id="cuemail" value="" required />
        <br />

        <label>Status of the Customer : </label><br>
        <select class="form-control" name="statuss" id="statuss" required>
            <option value="">Select the type</option>
            <option value="Active Customer">Active Customer</option>
            <option value="Inactive Customer">Inactive Customer</option>
        </select>
        <br>
        <div class="d-grid gap-2">
            <input class="btn btn-secondary" type="submit" value="Submit" />
        </div>

    </form>
</div>
<div class=" shadow-lg box01">
    <h3 style="padding-bottom: 15px;">Customer Register Detials </h3>
    <div class="container">
        <a class="d-grid gap-2 btn btn-success" href='./customerRegister.php'><i class="bi bi-arrow-clockwise"></i></a><br>
    </div>

    <div class="box01">
        <table id="example" class="table table-dark table-striped text-center" style="width:100%">
            <thead>
                <tr>
                    <th>ID </th>
                    <th>Customer Number</th>
                    <th>Name of the Customer </th>
                    <th>NIC Number </th>
                    <th>Contact number </th>
                    <th>Email Address </th>
                    <th>CUrrent Status </th>
                    <th>action </th>
                </tr>
            </thead>
            <tbody>

                <?php
                include '../mysqldbconnection.php';
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                } else {

                    $sql = "SELECT * From customer  ";
                    // $sql = "SELECT * FROM pricetable";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $my_id = $row["id"];
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["cust_no"] . "</td>";
                            echo "<td>" . $row["cusfullname"] . "</td>";
                            echo "<td>" . $row["NICno"] . "</td>";
                            echo "<td>" . $row["contactno"] . "</td>";
                            echo "<td>" . $row["email"] . "</td>";
                            echo "<td>" . $row["status"] . "</td>";
                            if($row["status"] == 'Active Customer'){
                                echo "<td><button   myid='" . $row['id'] . "' class='myModal btn btn-success' data-toggle='modal' data-target='#exampleModalCenter'><i class='bi bi-pen-fill'></i></button></td>";
                            }
                            else{
                            echo "<td><button   myid='" . $row['id'] . "' class='myModal btn btn-danger' data-toggle='modal' data-target='#exampleModalCenter'><i class='bi bi-pen-fill'></i></button></td>";
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
            url: 'customerRegmodal.php?myid=' + bb,
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
</script>
<?php include '.././Interface/Sharelayouts/Footer.php'; ?>


<?php
if (isset($_POST["cuname"]) && $_POST["cuname"] != null) {
    $Cusname = $_POST["cuname"];
    $Cusnic = $_POST["cunic"];
    $Cusnunmber = $_POST["cunumber"];
    $Cusemail = $_POST["cuemail"];
    $CusStatus = $_POST["statuss"];

    $cid = "";

    include '../mysqldbconnection.php';
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        $sql = "SELECT max(id) as 'cid' FROM customer";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $cid =  $row["cid"];
                $cid++;
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
        $sql = "INSERT INTO customer (cusfullname, NICno, contactno, email, status, cust_no) 
            VALUES ('" . $Cusname . "', '" . $Cusnic . "', '" . $Cusnunmber . "', '" . $Cusemail . "', '" . $CusStatus . "', 'CCEE000" . $cid . "') ";

        if ($conn->query($sql) === TRUE) {
            echo "<script> alert('Customer Detials successfull Registerd');</script>";
            $_POST["cuname"] = NULL;
            //   header("Location: NewFuelStation.php");
            exit();
        } else {
            echo "<script> alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
        }
        $conn->close();
    }
}





?>