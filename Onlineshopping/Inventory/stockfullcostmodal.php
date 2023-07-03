<?php
$supliername = "";
$Rawname = "";
$PriceList = "";
$Unitnum = "";
$total = "";
$statusp = "";

include '../mysqldbconnection.php';
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    $my_id = $_REQUEST['myid'];
    $sql = "SELECT cost.id, supplierdeatils.name as 'suppname', raw_metiral.name as 'rawname', cost.price, cost.units, cost.fullprice, cost.status 
    from cost 
    LEFT JOIN raw_metiral on cost.rawmetiral_id=raw_metiral.id 
    left join supplierdeatils on cost.supplier_id = supplierdeatils.id where cost.id = '$my_id';
    ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $supliername = $row['suppname'];
            $Rawname = $row['rawname'];
            $PriceList = $row['price'];
            $Unitnum = $row['units'];
            $total = $row['fullprice'];
            $statusp = $row['status'];
?>
            <div class="modal-body">
                <form action="stockfullcostupdate.php" method="POST" name="staffadd">
                <label>Name of the supplier :</label><br>
                    <input class="form-control" type="text" name="supname" id="supname" value="<?php echo $supliername; ?>" readonly>
                    <br>
                    <label>Name of the Raw Material :</label><br>
                    <input class="form-control" type="text" name="rawtype" id="rawtype" value="<?php echo $Rawname; ?>" readonly>
                    <br>
                    <label>Pirce calling from the supplier:</label><br>
                    <input class="form-control" type=" text" name="price" id="price" value="<?php echo $PriceList; ?>" readonly />
                    <br>
                    <label>Request Qty:</label><br>
                    <input class="form-control" type="number" name="unit" id="unit" value="<?php echo $Unitnum; ?>" readonly />
                    <br>
                    <br>
                    <label>Total cost for the supplier:</label><br>
                    <input class="form-control" type="number" name="total" id="total" value="<?php echo $total; ?>" readonly />
                    <br>
                    <label>Status of the Payment :</label><br>
                    <select class="form-control" name="cstaus" id="cstaus" value="<?php echo $statusp; ?>" required>
                        <option value="Payment Pending">Payment Pending</option>
                        <option value="Payment Complete">Payment Complete</option>
                    </select>
                    <input style="display: none;" type="text" name="sid" id="sid" value="<?php echo $my_id; ?>" required />
                    <br />
                    <div class="d-grid gap-2">
                        <input class="btn btn-secondary" type="submit" value="Submit" />
                    </div>
                </form>
            </div>
<?php
        }
    }
    $conn->close();
}
?>
