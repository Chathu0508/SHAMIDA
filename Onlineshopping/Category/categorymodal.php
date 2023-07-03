<?php
$categoryname = "";
$categorydescription = "";
$categorystatus = "";

include '../mysqldbconnection.php';

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    $my_id = $_REQUEST['myid'];
    $sql = "SELECT * FROM category WHERE  id='$my_id' ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $categoryname = $row['name'];
            $categorydescription = $row['description'];
            $categorystatus = $row['status'];
?>

            <div class="modal-body">
                <form action="categoryupdate.php" method="Post">
                    <label>Name of the Category :</label><br>
                    <input class="form-control" type=" text" name="cname" id="cname" value="<?php echo $categoryname; ?>" />
                    <br />
                    <label>description of the Category :</label><br>
                    <input class="form-control" type=" text" name="cdescription" id="cdescription" value="<?php echo $categorydescription; ?>" />
                    <br />
                    <label>status of the Category :</label><br>
                    <select class="form-control" name="cstaus" id="cstaus" required>
                        <option value="">Select the status</option>
                        <option value="Active Production">Active Production</option>
                        <option value="Inactive Production">Inactive Production</option>
                    </select>
                    <br />
                    <div class="d-grid gap-2">
                        <input class="btn btn-secondary" type="submit" value="Save changes" />
                    </div>
                    <input style="display: none;" type="text" name="sid" id="sid" value="<?php echo $my_id; ?>" required />

                </form>
            </div>



<?php
        }
    }
    $conn->close();
}
?>