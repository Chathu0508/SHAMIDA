<?Php
include '.././Interface/Sharelayouts/header.php';


?>
<div class="box-btn">
    <a class="btn btn-secondary" href="inventorydash.php"><i class="bi bi-backspace-fill"></i> Go Back to Inventory Page</a>
</div>
<h3 style="padding-bottom: 15px;">Production cost raw metiral details</h3>


<div class="container box shadow-lg">
    <form action="productioncost.php" method="POST" name="staffadd">
        <label>Name of the Raw material :</label><br>
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
        </select><br>
        <label>Unit type of the Raw Material :</label><br>
        <input class="form-control" type="text" name="rawtype" id="rawtype" required>
        <br>
        <label>Unit number of the Raw Material :</label><br>
        <input class="form-control" type="number" name="unitnumber" id="unitnumber"><br>
        <label>Unit number of the Raw Material Issue :</label><br>
        <input class="form-control" type="date" name="takedate" id="takedate"><br>

        <br>
        <div class="d-grid gap-2">
            <input class="btn btn-secondary" type="submit" value="Submit" />
        </div>
    </form>
</div>


<div class="container shadow-lg box">
    <a class="d-grid gap-2 btn btn-secondary" href='./productioncost.php'><i class="bi bi-arrow-clockwise"></i></a><br>

    <table id="example" class="table table-dark table-striped  text-center" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name of the Metiral </th>
                <th>Type of the metiral</th>
                <th>Units in the stock</th>
                <th>Issue Date</th>
            </tr>
        </thead>
        <tbody>

            <?php
            include '../mysqldbconnection.php';
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            } else {

                $sql = "SELECT 
                productionstock.id,
                raw_metiral.name as 'rawname',
                raw_metiral.type as 'rawtype',
                productionstock.unittaken,
                productionstock.date
                From productionstock 
                LEFT JOIN raw_metiral on productionstock.rawmetiral_id=raw_metiral.id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $my_id = $row["id"];
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["rawname"] . "</td>";
                        echo "<td>" . $row["rawtype"] . "</td>";
                        echo "<td>" . $row["unittaken"] . "</td>";
                        echo "<td>" . $row["date"] . "</td>";
                        echo "</tr>";
                    }
                }

                $conn->close();
            }
            ?>
        </tbody>
    </table>
</div>



<script type="text/javascript">
    function setRawTypeList() {
        var rawname = $("#rawname").val();
        $.ajax({
            url: 'setDataList.php?rawid=' + rawname,
            type: 'GET',
            success: function(data) {
                $("#rawtype").val(data);
            }
        });
    }
</script>
<?php include './../Interface/Sharelayouts/Footer.php' ?>



<?php
if (isset($_POST["rawname"]) && $_POST["rawname"] != NULL) {

    $Rawname = $_POST["rawname"];
    $Rawtype = $_POST["rawtype"];
    $stoccknum = $_POST["unitnumber"];
    $issueDate = $_POST["takedate"];


    include '../mysqldbconnection.php';
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        $sql = "INSERT INTO productionstock (rawmetiral_id, rawmetiral_type, unittaken , date) VALUES ('" . $Rawname . "', '" . $Rawtype . "', '" . $stoccknum . "' , '" . $issueDate . "')";
        if ($conn->query($sql) === TRUE) {
            echo "<script> alert('production quantity of Raw meterial details added successfully');</script>";
            $_POST["rawname"] = NULL;
            //   header("Location: NewFuelStation.php");

        } else {
            echo "<script> alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
        }
        $conn->close();
    }

    include '../mysqldbconnection.php';
    if (!$conn) {
        
        die("Connection failed: " . mysqli_connect_error());
    } else {
        
        $sql = "Update stockcall SET  unit= (unit - '".$stoccknum ."') where rawmetiral_id='" . $Rawname . "'";
        if ($conn->query($sql) === TRUE) {
            echo "<script> alert('stockall's quantity of Raw meterial Remove successfully');</script>";

            exit();
        } else {
            echo "<script> alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
        }
        $conn->close();
    }


}
?>