<?php

include '../Interface/Sharelayouts/header.php';


?>

<div class="box-btn">
    <a class="btn btn-secondary" href="inventorydash.php"><i class="bi bi-backspace-fill"></i> Go Back to Inventory Page</a>
</div>

<div class="container box shadow-lg">
    <h3> New Raw materials Adding</h3>
</div>
<div class="container box shadow-lg">
    <form action="Rawmaterials.php" method="POST" name="staffadd">
        <label>Name of the Raw material :</label><br>
        <input class="form-control" type=" text" name="rawname" id="rawname" value="" required />
        <label>Type of the Raw material:</label><br>
        <input class="form-control" type=" text" name="rawtypw" id="rawtypw" value="" required />
        <label>Avaibale:</label><br>
        <select class="form-control" name="cstaus" id="cstaus" required>
            <option value="">Select the status</option>
            <option value="Avaibale Material">Avaibale Material</option>
            <option value="Unavailable  Material">Unavailable Material</option>
        </select>
        <br>
        <div class="d-grid gap-2">
            <input class="btn btn-success" type="submit" value="Submit" />
        </div>
    </form>
</div>
<div class="container shadow-lg box">
    <h3 style="padding-bottom: 15px;">raw_metiral detail</h3>
    <a class="d-grid gap-2 btn btn-success" href='./Rawmaterials.php'><i class="bi bi-arrow-clockwise"></i></a><br>

    <table id="example" class="table table-striped text-center" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name </th>
                <th>type </th>
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

                $sql = "SELECT *  From raw_metiral ";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $my_id = $row["id"];

                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["type"] . "</td>";
                        echo "<td>" . $row["status"] . "</td>";
                        if ($row["status"] == 'Avaibale Material') {

                        echo "<td> 
                        <button   myid='" . $row['id'] . "' class='myModal btn btn-success' data-toggle='modal' data-target='#exampleModalCenter'><i class='bi bi-pen-fill'></i></button></td>";
                        
                        }else{
                            echo "<td> 
                            <button   myid='" . $row['id'] . "' class='myModal btn btn-danger' data-toggle='modal' data-target='#exampleModalCenter'><i class='bi bi-pen-fill'></i></button></td>";
    
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
                <h5 class="modal-title" id="exampleModalLongTitle">raw_metiral detail Changes </h5>
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
            url: 'Rawmaterialsmodal.php?myid=' + bb,
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
<?php include './../Interface/Sharelayouts/Footer.php';?>


<?php
if (isset($_POST["rawname"]) && $_POST["rawname"] != NULL) {

    $Rawname = $_POST["rawname"];
    $Rawtype = $_POST["rawtypw"];
    $Rawstatus = $_POST["cstaus"];

    include '../mysqldbconnection.php';
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        $sql = "INSERT into raw_metiral (name,type,status) VALUES  ('" . $Rawname . "', '" . $Rawtype . "','" . $Rawstatus . "')";
        if ($conn->query($sql) === TRUE) {
            echo "<script> alert('Raw material details added successfully');</script>";
            $_POST["rawname"] = NULL;
            //   header("Location: NewFuelStation.php");

            // exit();
        } else {
            echo "<script> alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
        }
        $conn->close();
    }
}
?>