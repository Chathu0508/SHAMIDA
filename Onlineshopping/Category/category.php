<?php
include '.././Interface/Sharelayouts/header.php';
include '.././Interface/Navbar.php';

?>
<div class="box-btn">
    <a class="btn btn-secondary" href="../Interface/prodcutcategory.php"><i class="bi bi-backspace-fill"></i> Go Back to Inventory Page</a>
</div>

<div class="container shadow-lg box">
<h3 style="padding-bottom: 15px;">Category Register</h3>
<hr>
</div>

<div class="container shadow-lg box ">
    <form action="category.php" method="POST" name="staffadd">
        <label>Name of the Category :</label><br>
        <input class="form-control" type=" text" name="cname" id="cname" value="" required />
        <br />
        <label>description of the Category :</label><br>
        <input class="form-control" type=" text" name="cdescription" id="cdescription" value="" required />
        <br />
        <label>status of the Category :</label><br>
        <select class="form-control" name="cstaus" id="cstaus" required>
            <option value="">Select the status</option>
            <option value="Active Category">Active Category</option>
            <option value="Inactive Category">Inactive Category</option>
        </select>
        <br />
        <div class="d-grid gap-2">
            <input class="btn btn-secondary " type="submit" value="Submit" />
        </div>
    </form>
</div>

<div class="container shadow-lg box">
    <h3 style="padding-bottom: 15px;">Category Deatils</h3>
    <a class="btn btn-secondary d-grid gap-2" href='./category.php'><i class="bi bi-arrow-clockwise"></i></a><br>
    <hr>

    <table id="example" class="table table-striped text-center" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name of the Category</th>
                <th>description </th>
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

                $sql = "SELECT *  From category ";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $my_id = $row["id"];

                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["description"] . "</td>";
                        echo "<td>" . $row["status"] . "</td>";
                        echo "<td> 
                        <button   myid='" . $row['id'] . "' class='myModal btn btn-success' data-toggle='modal' data-target='#exampleModalCenter'><i class='bi bi-pen-fill'></i></button>
                        </td>";
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
                <h5 class="modal-title" id="exampleModalLongTitle">Category Details Customiztion</h5>
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
            url: 'categorymodal.php?myid=' + bb,
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
if (isset($_POST["cname"]) && $_POST["cname"] != NULL) {

    $Categoryname = $_POST["cname"];
    $Categorydescription = $_POST["cdescription"];
    $Categorystatus = $_POST["cstaus"];

    include '../mysqldbconnection.php';
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        $sql = "INSERT into category (name,description,status) VALUES  ('" . $Categoryname . "', '" . $Categorydescription . "','" . $Categorystatus . "')";
        if ($conn->query($sql) === TRUE) {
            echo "<script> alert('Category details added successfully');</script>";
            $_POST["cname"] = NULL;
            //   header("Location: NewFuelStation.php");

            exit();
        } else {
            echo "<script> alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
        }
        $conn->close();
    }
}
?>