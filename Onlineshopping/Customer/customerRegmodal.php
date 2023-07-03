<?php
$Cusname = "";
$Cusnic = "";
$Cusnunmber = "";
$Cusemail = "";
$CusStatus = "";


include '../mysqldbconnection.php';

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    $my_id = $_REQUEST['myid'];
    $sql = "SELECT * FROM customer WHERE  id='$my_id' ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $Cusname = $row['cusfullname'];
            $Cusnic = $row['NICno'];
            $Cusnunmber = $row['contactno'];
            $Cusemail = $row['email'];
            $CusStatus = $row['status'];
?>

            <div class="modal-body">
                <form action="customerRegisterupdate.php" method="POST" name="staffadd">
                    <input style="display: none;" type="text" name="sid" id="sid" value="<?php echo $my_id; ?>" required />

                    <label>Name of the customer : </label><br>
                    <input class="form-control" type="text" name="cuname" id="cuname" value="<?php echo $Cusname; ?>" readonly />
                    <br />

                    <label>National Identity Card Number : </label><br>
                    <input class="form-control" type="text" name="cunic" id="cunic" value="<?php echo $Cusnic; ?>" readonly />
                    <br />

                    <label>Contact Number : </label><br>
                    <input class="form-control" type="text" name="cunumber" id="cunumber" value="<?php echo $Cusnunmber; ?>" readonly />
                    <br />

                    <label>Customer Mail : </label><br>
                    <input class="form-control" type="text" name="cuemail" id="cuemail" value="<?php echo $Cusemail; ?>" readonly />
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
<?php
        }
    }
    $conn->close();
}
?>