<?php
include '../CSSRes/Res.php';
include '../CSSRes/css.php';
?>



<?php
$staffname = "";
$staffnic = "";
$stafftype = "";
$stafftel = "";
$staffemail = "";
$staffuname = "";
$staffpassword = "";
$status = "";
$emplid = "";


include '../mysqldbconnection.php';

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    $my_id = $_REQUEST['myid'];
    $sql = "SELECT * FROM employee WHERE  id='$my_id' ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            $emplid = $row["employee_no"];
            $staffname = $row["name"];
            $staffnic = $row["nic"];
            $stafftype = $row["type"];
            $stafftel = $row["tel"];
            $staffemail = $row["email"];
            $staffuname = $row["username"];
            $staffpassword = $row["password"];
            $status = $row["status"];

?>
            <div class="modal-body">

            <div class="profile">
                <img src="./../Images/user_male.jpg" class="logo img-fluid">
            </div>
                    <label>Name of the Employee : </label> <label><?php echo $emplid; ?></label>
                    <br>
                    <label>Name of the Employee : </label> <label><?php echo $staffname; ?></label>
                    <br />
                    <label>National Identity Card Number : </label> <label><?php echo $staffnic; ?></label>
                    <br />
                    <label>Role of the Employee : </label> <label><?php echo $stafftype; ?></label>
                    <br />
                    <label>Contact Number: </label> <label><?php echo $stafftel; ?></label>
                    <br />
                    <label>Email Address: </label> <label><?php echo $staffemail; ?></label>
                    <br>
                    <label>Employee Username: </label> <label><?php echo $staffuname; ?></label>
                    <br>
                    <label>Employee Password: </label> <label><?php echo $staffpassword; ?></label>
                    <br>
                    <label>Status of the Employees : </label> <label><?php echo $status; ?></label>
            </div>
<?php
        }
    }
    $conn->close();
}
?>