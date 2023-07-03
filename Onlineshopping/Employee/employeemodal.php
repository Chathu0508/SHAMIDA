<?php
$staffname = "";
$staffnic = "";
$stafftype = "";
$stafftel = "";
$staffemail = "";
$staffuname = "";
$staffpassword = "";

include '../mysqldbconnection.php';

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    $my_id = $_REQUEST['myid'];
    $sql = "SELECT * FROM employee WHERE  id='$my_id' ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {


            $staffname = $row["name"];
            $staffnic = $row["nic"];
            $stafftype = $row["type"];
            $stafftel = $row["tel"];
            $staffemail = $row["email"];
?>
            <div class="modal-body">

                <form action="employeeupdate.php" method="POST" name="staffadd">

                    <label>Name of the Employee : </label><br>
                    <input class="form-control" type="text" name="stname" id="stname" value="<?php echo $staffname; ?>" readonly />
                    <br />
                    <label>National Identity Card Number : </label><br>
                    <input class="form-control" type="text" name="stnic" id="stnic" value="<?php echo $staffnic; ?>" readonly />
                    <br />
                    <label>Role of the Employee : </label><br>
                    <input class="form-control" type="text" name="sttype" id="sttype" value="<?php echo $stafftype; ?>" readonly />
                    <br />
                    <label>Contact Number: </label><br>
                    <input class="form-control" type="number" name="sttel" id="sttel" value="<?php echo $stafftel; ?>"  />
                    <br />
                    <label>Email Address: </label><br>
                    <input class="form-control" type="text" name="stemail" id="stemail" value="<?php echo $staffemail; ?>"  />
                    <br />
                    <label>Status of the Employees : </label><br>
                    <select class="form-control" name="statuss" id="statuss" required>
                        <option value="">Select the type</option>
                        <option value="Active Employee">Active Employee</option>
                        <option value="Inacrive Employee">Inacrive Employee</option>
                    </select>
                    <br>
                    <input class="form-control" style="display: none;" type="text" name="sid" id="sid" value="<?php echo $my_id; ?>" required />
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