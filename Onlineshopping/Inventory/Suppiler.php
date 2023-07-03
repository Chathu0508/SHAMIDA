<?php
include '../Interface/Sharelayouts/header.php';

?>



<div class="box-btn">
    <a class="btn btn-secondary" href="inventorydash.php"><i class="bi bi-backspace-fill"></i> Go Back to Inventory Page</a>
</div>

<div class="container box shadow-lg">
    <h3> Register new supplier Deatils </h3>
    <form action="Suppiler.php" method="POST" name="staffadd">
        <label>Name of Supplier :</label><br>
        <input class="form-control" type=" text" name="suppname" id="suppname" value="" required />
        <br>
        <label>Contact Number:</label><br>
        <input class="form-control" type=" text" name="suppcont" id="suppcont" value="" required />
        <br>
        <label>Contact Address:</label><br>
        <input class="form-control" type=" text" name="suppadd" id="suppadd" value="" required />
        <br>
        <label>Supplier Condition:</label><br>
        <select class="form-control" name="status" id="status" required>
            <option value="">Select the status</option>
            <option value="Active Supplier">Active Supplier</option>
            <option value="Deactive Supplier">Deactive Supplier</option>
        </select>
        <br>


        <div class="d-grid gap-2">
            <input class="btn btn-secondary" type="submit" value="Submit" />
        </div>
    </form>
</div>

<div class="container shadow-lg box">
    <h3 style="padding-bottom: 15px;">Supplier Deatils</h3>
    <a class="d-grid gap-2 btn btn-secondary" href='./Suppiler.php'><i class="bi bi-arrow-clockwise"></i></a> <br>

    <table id="example" class="table table-dark table-striped text-center" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name </th>
                <th>Contact number </th>
                <th>Address</th>
                <th>status</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>

            <?php
            include '../mysqldbconnection.php';
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            } else {

                $sql = "SELECT *  From supplierdeatils ";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $my_id = $row["id"];

                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["contactnumber"] . "</td>";
                        echo "<td>" . $row["address"] . "</td>";
                        echo "<td>" . $row["status"] . "</td>";
                        echo "<td> 
                        <button   myid='" . $row['id'] . "' class='myModal btn btn-secondary' data-toggle='modal' data-target='#exampleModalCenter'><i class='bi bi-pen-fill'></i></button></td>";
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
                <h5 class="modal-title" id="exampleModalLongTitle">Supplier Details Customiztion</h5>
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

    $('#bdel').on('click', function() {
        $('#exampleModalCenter').modal('hide');
    });
    $('#hidem').on('click', function() {
        $('#exampleModalCenter').modal('hide');
    });

    $('button.myModal').on('click', function() {

        var bb = $(this).attr("myid");
        $.ajax({
            url: 'Suppilermodal.php?myid=' + bb,
            type: 'GET',
            success: function(data) {
                $('#modalContent').html(data);
            }
        });

        $('#exampleModalCenter').modal('show');
    });
</script>


<?php include '../Interface/Sharelayouts/Footer.php'; ?>


<?php
if (isset($_POST["suppname"]) && $_POST["suppname"] != NULL) {

    $suppname = $_POST["suppname"];
    $suppcont = $_POST["suppcont"];
    $suppadds = $_POST["suppadd"];
    $suppstatus = $_POST["status"];

    include '../mysqldbconnection.php';
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        $sql = "INSERT into supplierdeatils (name,contactnumber,address,status) VALUES  ('" . $suppname . "', '" . $suppcont . "', '" . $suppadds . "','" . $suppstatus . "')";
        if ($conn->query($sql) === TRUE) {
            echo "<script> alert('Supplier details Register Successfully');</script>";
            $_POST["suppname"] = NULL;
            //   header("Location: NewFuelStation.php");

            exit();
        } else {
            echo "<script> alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
        }
        $conn->close();
    }
}
?>