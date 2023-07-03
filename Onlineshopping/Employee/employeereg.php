<?php
include '.././Interface/Sharelayouts/header.php';
include '.././Interface/Navbar.php';
include '.././CSSRes/Res.php';
include '.././CSSRes/css.php';
?>
<style>
    div.scrollmenu {
        overflow: auto;
        white-space: nowrap;
        padding: 50px;
    }

    div.scrollmenu a {
        display: inline-block;
        color: teal;
        text-align: center;
        padding: 14px;
        text-decoration: none;
    }
</style>



<div style="margin: auto; width: auto; padding: 50px; float: left;" form-group row>
    <h3 style="padding-bottom: 15px;">Employee profile create</h3>

    <form action="employeereg.php" method="POST" name="staffadd">

        <label>Name of the Employee : </label><br>
        <input class="form-control" type="text" name="stname" id="stname" value="" required />
        <br />

        <label>National Identity Card Number : </label><br>
        <input class="form-control" type="text" name="stnic" id="stnic" value="" required />
        <br />
        <label>Role of the Employee : </label><br>
        <select class="form-control" name="sttype" id="sttype" required>
            <option value="">Select the type</option>
            <option value="Admin">Admin</option>
            <option value="Owner">Owner</option>
            <option value="User">User</option>
        </select>
        <br />
        <label>Contact Number: </label><br>
        <input class="form-control" type="number" name="sttel" id="sttel" value="" required />
        <br />
        <label>Email Address: </label><br>
        <input class="form-control" type="text" name="stemail" id="stemail" value="" required />
        <br />
        <label>Staff Username: </label><br>
        <input class="form-control" type="text" name="stuname" id="stuname" value="" required />
        <br />
        <label>Staff Password: </label><br>
        <input class="form-control" type="password" name="stpass" id="stpass" value="" required />
        <br />
        <label>Status of the Employees : </label><br>
        <select class="form-control" name="statuss" id="statuss" required>
            <option value="">Select the type</option>
            <option value="Active Employee">Active Employee</option>
            <option value="Inacrive Employee">Inacrive Employee</option>
        </select>
        <br>
        <div class="d-grid gap-2">
            <input class="btn btn-secondary" type="submit" value="Submit" />
        </div>

    </form>

</div>
<!-- view the data in the table -->
<div class="scrollmenu">
    <h3 style="padding-bottom: 15px;">Employee Details</h3>
    <a class="d-grid gap-2 btn btn-secondary" href='./employeereg.php'><i class="bi bi-arrow-clockwise"></i></a><br>
    <table id="example" class="table table-dark table-striped" style="width:100%; text-align: center; ">
        <thead>
            <tr>
                <th>EID</th>
                <th>Name of the Employee</th>
                <th>Role of the Employee</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include '../mysqldbconnection.php';
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            } else {
                $sql = "SELECT *  From employee ";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $my_id = $row["id"];
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["type"] . "</td>";
                        echo "<td>" . $row["status"] . "</td>";
                        echo "<td> <button   myid='" . $row['id'] . "' class='myModal btn btn-secondary' data-toggle='modal' data-target='#exampleModalCenter'><i class='bi bi-pen-fill'></i></button></td>";
                        echo "</tr>";
                    }
                }
                $conn->close();
            }
            ?>
        </tbody>
    </table>
</div>
<br>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 style="padding-bottom: 15px;">Employee profile Changes</h3>
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


<script>
    var prevScrollpos = window.pageYOffset;
    window.onscroll = function() {
        var currentScrollPos = window.pageYOffset;
        if (prevScrollpos > currentScrollPos) {
            document.getElementById("navbar").style.top = "0";
        } else {
            document.getElementById("navbar").style.top = "-50px";
        }
        prevScrollpos = currentScrollPos;
    }

    $('button.myModal').on('click', function() {

        var bb = $(this).attr("myid");
        $.ajax({
            url: 'employeemodal.php?myid=' + bb,
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





<?php
if (isset($_POST["stname"]) && $_POST["stname"] != null) {
    $staffname = $_POST["stname"];
    $staffnic = $_POST["stnic"];
    $stafftype = $_POST["sttype"];
    $stafftel = $_POST["sttel"];
    $staffemail = $_POST["stemail"];
    $staffuname = $_POST["stuname"];
    $staffpassword = $_POST["stpass"];
    $status = $_POST["statuss"];
    $emplid="";

    include '../mysqldbconnection.php';
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        $sql = "SELECT max(id) as 'eid' FROM employee";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $emplid =  $row["eid"];
                $emplid++;
            }
        } else {
            echo "<script> alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
        }
        $conn->close();
    }


    include '../mysqldbconnection.php';
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        $sql = "INSERT INTO employee (name, nic, type, tel, email, username, password, status,employee_no) 
            values ('" . $staffname . "', '" . $staffnic . "', '" . $stafftype . "', '" . $stafftel . "', '" . $staffemail . "', '" . $staffuname . "', '" . $staffpassword . "', '" . $status . "', 'EMP000" . $emplid . "') ";

        if ($conn->query($sql) === TRUE) {
            echo "<script> alert('employee details added successfully');</script>";
            $_POST["Fname"] = NULL;
            //   header("Location: NewFuelStation.php");
            exit();
        } else {
            echo "<script> alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
        }
        $conn->close();
    }
}
?>