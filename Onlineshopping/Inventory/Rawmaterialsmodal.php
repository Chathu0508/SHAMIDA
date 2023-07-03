<?php
$Rawname = "";
$Rawtype = "";
$Rawstatus = "";

include '../mysqldbconnection.php';

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    $my_id = $_REQUEST['myid'];
    $sql = "SELECT * FROM raw_metiral WHERE  id='$my_id' ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            $Rawname = $row['name'];
            $Rawtype = $row['type'];
            $Rawstatus = $row['status'];
?>
            <div class="modal-body">
                <form action="Rawmaterialsupdate.php" method="POST" name="staffadd">
                    <label>Name of the Raw material :</label><br>
                    <input class="form-control" type=" text" name="rawname" id="rawname" value="<?php echo $Rawname; ?> " readonly/>
                    <label>Type of the Raw material:</label><br>
                    <input class="form-control" type=" text" name="rawtypw" id="rawtypw" value="<?php echo $Rawtype; ?>" readonly/>
                    <label>Avaibale:</label><br>
                    <select class="form-control" name="cstaus" id="cstaus" value="<?php echo $Rawstatus; ?>">
                        <option value="Avaibale Material">Avaibale Material</option>
                        <option value="Unavailable  Material">Unavailable Material</option>
                    </select>
                    <input style="display: none;" type="text" name="sid" id="sid" value="<?php echo $my_id; ?>" required />

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