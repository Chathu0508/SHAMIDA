<?php

include '../Interface/Sharelayouts/header.php';


?>
<style>
    body {
        background: #0F2027;
        /* fallback for old browsers */
        background: -webkit-linear-gradient(to right, #2C5364, #203A43, #0F2027);
        /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to right, #2C5364, #203A43, #0F2027);
        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

    }
</style>
<div class="box-btn">
    <a class="btn btn-secondary" href="inventorydash.php"><i class="bi bi-backspace-fill"></i> Go Back to Inventory Page</a>
</div>

<div class="container box shadow-lg">
    <h3> Price calling from the suppliers </h3>
    <form action="pricelist.php" method="POST" name="staffadd">
        <label>Name of the supplier :</label><br>
        <select class="form-control" name="supname" id="supname" required>
            <option value="">Select the Supplier</option>
            <?php
            include '../mysqldbconnection.php';
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            } else {

                $sql = "SELECT *  From supplierdeatils ";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                    }
                }
            }
            ?>
        </select>
        <br>
        <label>Name of the Raw Material :</label><br>
        <select class="form-control" name="rawname" id="rawname" required onchange="setRawTypeList();">
            <option value="">Select the Raw Material</option>
            <?php
            include '../mysqldbconnection.php';
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            } else {

                $sql = "SELECT *  From raw_metiral ";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                    }
                }
            }
            ?>
        </select>
        <br>
        <label>Unit type of the Raw Material :</label><br>
        <input class="form-control" type="text" name="rawtype" id="rawtype" required>
        <br>
        <label>Pirce calling from the supplier (LKR):</label><br>
        <input class="form-control" type=" text" name="price" id="price" value="" required />
        <br>



        <div class="d-grid gap-2">
            <input class="btn btn-secondary" type="submit" value="Submit" />
        </div>
    </form>
</div>





<div class=" shadow-lg box">
<div class="container ">

<a class="d-grid gap-2 btn btn-secondary" href='./pricelist.php'><i class="bi bi-arrow-clockwise"></i></a><br>
</div>

    <h3 style="padding-bottom: 15px;">Supply prices Deatils</h3>

    <table id="example" class="table table-striped text-center" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name pf the sypplier </th>
                <th>Name of the Raw material </th>
                <th>Tyep of the Raw Material</th>
                <th>Price</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>

            <?php
            include '../mysqldbconnection.php';
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            } else {

                $sql = "SELECT 
                                pricetable.id,
                                supplierdeatils.name as 'suppname',
                                raw_metiral.name as 'rawname',
                                raw_metiral.type as 'rawtype',
                                pricetable.price  From pricetable  
                                LEFT JOIN supplierdeatils on pricetable.supplier_id=supplierdeatils.id
                                LEFT JOIN raw_metiral on pricetable.rawmetiral_id=raw_metiral.id
                                
                                ";
                // $sql = "SELECT * FROM pricetable";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $my_id = $row["id"];

                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["suppname"] . "</td>";
                        echo "<td>" . $row["rawname"] . "</td>";
                        echo "<td>" . $row["rawtype"] . "</td>";
                        echo "<td>" . $row["price"] . "</td>";
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
                <h5 class="modal-title" id="exampleModalLongTitle">raw_metiral details changes </h5>
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
            url: 'pricemodal.php?myid=' + bb,
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

    function setRawTypeList() {
        var rawname = $("#rawname").val();
        $.ajax({
            url: 'setDataList.php?rawmid=' + rawname,
            type: 'GET',
            success: function(data) {
                $("#rawtype").val(data);
            }
        });
    }
</script>




















<?php
if (isset($_POST["supname"]) && $_POST["supname"] != NULL) {

    $supliername = $_POST["supname"];
    $Rawname = $_POST["rawname"];
    $Rawtype = $_POST["rawtype"];
    $PriceList = $_POST["price"];

    include '../mysqldbconnection.php';
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        $sql = "INSERT into pricetable (supplier_id,rawmetiral_id,rawmetiral_type,price) VALUES  ('" . $supliername . "', '" . $Rawname . "', '" . $Rawtype . "','" . $PriceList . "')";
        if ($conn->query($sql) === TRUE) {
            echo "<script> alert('price details added successfully');</script>";
            $_POST["rawname"] = NULL;
            //   header("Location: NewFuelStation.php");

            exit();
        } else {
            echo "<script> alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
        }
        $conn->close();
    }
}


?>