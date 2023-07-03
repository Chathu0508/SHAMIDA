<?php
$suppname = "";
$suppcont = "";
$suppadds = "";
$suppstatus = "";

include '../mysqldbconnection.php';

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    $my_id = $_REQUEST['myid'];
    $sql = "SELECT * FROM supplierdeatils WHERE  id='$my_id' ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $suppname = $row["name"];
            $suppcont = $row["contactnumber"];
            $suppadds = $row["address"];
            $suppstatus = $row["status"];
?>

            <div class="modal-body">
                <form action="Suppilerupdate.php" method="POST" name="staffadd">
                    <input style="display: none;" type="text" name="sid" id="sid" value="<?php echo $my_id; ?>" required />

                    <label>Name of Supplier :</label><br>
                    <input class="form-control" type=" text" name="suppname" id="suppname" value="<?php echo $suppname; ?>" readonly />
                    <br>
                    <label>Contact Number:</label><br>
                    <input class="form-control" type=" text" name="suppcont" id="suppcont" value="<?php echo $suppcont; ?>" required />
                    <br>
                    <label>Contact Address:</label><br>
                    <input class="form-control" type=" text" name="suppadd" id="suppadd" value="<?php echo $suppadds; ?>" required />
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
                </form>
            </div>



<?php
        }
    }
    $conn->close();
}
?>