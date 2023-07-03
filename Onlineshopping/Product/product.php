<?php
include '.././Interface/Sharelayouts/header.php';
include '.././Interface/Navbar.php';

?>
<div class="box-btn">
    <a class="btn btn-secondary" href="../Interface/prodcutcategory.php"><i class="bi bi-backspace-fill"></i> Go Back to Inventory Page</a>
</div>

<div class="container shadow-lg box">
<h3>New Production Entry </h3>

    <form action="product.php" method="POST" name="staffadd">
        <label>Number of the Product :</label><br>
        <input class="form-control" type=" text" name="pname" id="pname" value="" placeholder="SJ0000" required />
        <br />
        <label>Price of the product (Rs.):</label><br>
        <input class="form-control" type=" text" name="pprice" id="pprice" value="" required />
        <br />
        <label>Category of the product :</label><br>
        <select class="form-control" name="pcategory" id="pcategory" required>
            <option value="">Select the category</option>
            <?php
            include '../mysqldbconnection.php';
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            } else {

                $sql = "SELECT *  From category WHERE status='Active Category'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                    }
                }
            }
            ?>
        </select>
        <br />
        <label>Status of the Product :</label><br>
        <select class="form-control" name="cstaus" id="cstaus" required>
            <option value="">Select the status</option>
            <option value="Avaible Production">Avaible Production</option>
            <option value="Sold out Production">Sold out Production</option>
        </select>
        <br />
        <div class="d-grid gap-2">
            <input class="btn btn-secondary btn-update" type="submit" value="Submit" />
        </div>
    </form>
</div>

<div class=" shadow-lg box">
    <h3 style="padding-bottom: 15px;">Production Deatils</h3>
    <a class="d-grid gap-2 btn btn-secondary" href='./product.php'><i class="bi bi-arrow-clockwise"></i></a>
<br>
    <table id="example" class="table table-dark table-striped text-center" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Price (Rs)</th>
                <th>Product category</th>
                <th>status</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>

            <?php
            include '../mysqldbconnection.php';
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            } else {

                $sql = "SELECT product.id, 
                product.name, 
                product.price,
                category.name as 'catname',
                product.status 
                From product left join category on product.category_id =category.id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $my_id = $row["id"];

                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["price"] . "</td>";
                        echo "<td>" . $row["catname"] . "</td>";
                        echo "<td>" . $row["status"] . "</td>";
                        if ($row["status"] == 'Avaible Production') {
                            echo "<td><button   myid='" . $row['id'] . "' class='myModal btn btn-success' data-toggle='modal' data-target='#exampleModalCenter'><i class='bi bi-pen-fill'></i></button></td>";
                        }else{
                            echo "<td><button   myid='" . $row['id'] . "' class='myModal btn btn-danger' data-toggle='modal' data-target='#exampleModalCenter'><i class='bi bi-pen-fill'></i></button></td>";
                        }
                        echo "</tr>";
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
                <h5 class="modal-title" id="exampleModalLongTitle">Production Details </h5>
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
    $(document).ready(function() {
        $('#example').DataTable();
    });


    $('button.myModal').on('click', function() {

        var bb = $(this).attr("myid");
        $.ajax({
            url: 'productmodal.php?myid=' + bb,
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
<?php include '.././Interface/Sharelayouts/Footer.php'; ?>







<?php
if (isset($_POST["pname"]) && $_POST["pname"] != NULL) {

    $prodname = $_POST["pname"];
    $prodPrice = $_POST["pprice"];
    $prodCategory = $_POST["pcategory"];
    $prodStatus = $_POST["cstaus"];

    include '../mysqldbconnection.php';
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        $sql = "INSERT into product (name,price,category_id,status) 
        VALUES  ('" . $prodname . "', '" . $prodPrice . "','" . $prodCategory . "','" . $prodStatus . "')";
        if ($conn->query($sql) === TRUE) {
            echo "<script> alert('New Production is register in the system');</script>";
            $_POST["pname"] = NULL;
            //   header("Location: NewFuelStation.php");

            exit();
        } else {
            echo "<script> alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
        }
        $conn->close();
    }
}
?>