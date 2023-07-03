<?Php
include '.././Interface/Sharelayouts/header.php';
?>
<div class="box-btn">
    <a class="btn btn-secondary" href="inventorydash.php"><i class="bi bi-backspace-fill"></i> Go Back to Inventory Page</a>
</div>
<div class="container box shadow-lg">
    <h3>Stock purchasing quantity and Value</h3>
    <form action="stockfullcost.php" method="POST" name="staffadd">
        <label>Name of the supplier :</label><br>
        <select class="form-control" name="supname" id="supname" onchange="setMeterialsList();">
            <option value="">Select the Supplier</option>
            <?php
            include '../mysqldbconnection.php';
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            } else {

                $sql = "SELECT *  From supplierdeatils WHERE status='Active Supplier'";
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
        </select>
        <br>
        <label>Type of the Raw Material :</label><br>
        <input class="form-control" type="text" name="rawtype" id="rawtype" required>
        <br>
        <label>Pirce calling from the supplier:</label><br>
        <input class="form-control" type=" text" name="price" id="price" required />
        <br>
        <label>Request Qty:</label><br>
        <input class="form-control" type="number" name="unit" id="unit" required />
        <br>
        <label>Status of the Payment :</label><br>
        <select class="form-control" name="cstaus" id="cstaus" required>
            <option value="">Select the Payment status</option>
            <option value="Payment Pending">Payment Pending</option>
            <option value="Payment Complete">Payment Complete</option>
        </select>
        <br />
        <div class="d-grid gap-2">
            <input class="btn btn-secondary" type="submit" value="Submit" />
        </div>
    </form>
</div>
<div class=" shadow-lg box">
    <div class="container ">
        <a class="d-grid gap-2 btn btn-secondary" href='./stockfullcost.php'><i class="bi bi-arrow-clockwise"></i></a> <br>
    </div>
   <h3 style="padding-bottom: 15px;">Stock Purchesing From the Supplier </h3>
    <table id="example" class="table table-dark table-striped text-center" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Suppiler Name </th>
                <th>Request raw material </th>
                <th>Type of the raw material</th>
                <th>Price for unit</th>
                <th>Request qty</th>
                <th>Full cost for the supplier</th>
                <th>Status of the payments</th>
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
                cost.id as 'id', 
                supplierdeatils.name as 'Suppiler Name',
                raw_metiral.name as 'Request raw material',
                raw_metiral.type as 'Type of the raw material',
                cost.price as 'Price for  unit', 
                cost.units as 'Request qty', 
                cost.fullprice as 'Full cost for the supplier',
                cost.status as 'Status of the payments'
                from cost 
                LEFT JOIN raw_metiral on cost.rawmetiral_id=raw_metiral.id 
                left join supplierdeatils on cost.supplier_id = supplierdeatils.id
                ";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $my_id = $row["id"];

                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["Suppiler Name"] . "</td>";
                        echo "<td>" . $row["Request raw material"] . "</td>";
                        echo "<td>" . $row["Type of the raw material"] . "</td>";
                        echo "<td>" . $row["Price for  unit"] . "</td>";
                        echo "<td>" . $row["Request qty"] . "</td>";
                        echo "<td>" . $row["Full cost for the supplier"] . "</td>";
                        echo "<td>" . $row["Status of the payments"] . "</td>";
                        if ($row["Status of the payments"] == 'Payment Pending') {
                            echo "<td><button   myid='" . $row['id'] . "' class='myModal btn btn-danger' data-toggle='modal' data-target='#exampleModalCenter'><i class='bi bi-pen-fill'></i></button></td>";
                        } else {
                            echo "<td> <button   myid='" . $row['id'] . "' class='myModal btn btn-success' data-toggle='modal'  data-target='#exampleModalCenter' disabled ><i class='bi bi-pen-fill'></i></button></td>";
                        }
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
                <h5 class="modal-title" id="exampleModalLongTitle">raw_metiral details Completion </h5>
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
    function setMeterialsList() {

        var pricename = $("#supname").val();

        $.ajax({
            url: 'setmeterialdataList.php?supid=' + pricename,
            type: 'GET',
            success: function(data) {

                $("#rawname").html(data);
            }
        });
    }
    function setprice() {
        var pricename = $("#supname").val();
        var rawname = $("#rawname").val();
        $.ajax({
            url: 'setpriceList.php?supid=' + pricename + "&rawname=" + rawname,
            type: 'GET',
            success: function(data) {

                $("#price").val(data);
            }
        });
    }
    function setRawTypeList() {
        var rawname = $("#rawname").val();
        $.ajax({
            url: 'setDataList.php?rawmid=' + rawname,
            type: 'GET',
            success: function(data) {
                $("#rawtype").val(data);
            }
        });
        setprice();
    }
    $(document).ready(function() {
        $('#example').DataTable();
    });
    $('button.myModal').on('click', function() {

        var bb = $(this).attr("myid");
        $.ajax({
            url: 'stockfullcostmodal.php?myid=' + bb,
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
<br>
<?php include './../Interface/Sharelayouts/Footer.php'; ?>
<?php
if (isset($_POST["supname"]) && $_POST["supname"] != NULL) {

    $supliername = $_POST["supname"];
    $Rawname = $_POST["rawname"];
    $PriceList = $_POST["price"];
    $Unitnum = $_POST["unit"];
    $total = $PriceList * $Unitnum;
    $statusp = $_POST["cstaus"];
    include '../mysqldbconnection.php';
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        $sql = "INSERT INTO cost (supplier_id, rawmetiral_id, price, units,  fullprice, status) 
        VALUES  ('" . $supliername . "', '" . $Rawname . "', '" . $PriceList . "','" . $Unitnum . "','" . $total . "','" . $statusp . "')";
        if ($conn->query($sql) === TRUE) {
            echo "<script> alert('purchasing is Ok');</script>";
            $_POST["supname"] = NULL;
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

        $sql = "Update stockcall SET  unit= (unit + '" . $Unitnum . "') where rawmetiral_id='" . $Rawname . "'";
        if ($conn->query($sql) === TRUE) {
            echo "<script> alert('Stocking quantity successfully added ');</script>";

            exit();
        } else {
            echo "<script> alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
        }
        $conn->close();
    }
}
?>