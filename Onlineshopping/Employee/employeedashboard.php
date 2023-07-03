<?php
include '.././Interface/Sharelayouts/header.php';
include '../Interface/Navbar.php';
?>
<section id="Rawmaterial">
    <div class="card">
        <div class="card-header">
        <h3>Employee Summary</h3>
        </div>
        <div class="card-body">
            <a class="btn btn-secondary" href="employeereg.php"><i class="bi bi-person-plus"></i> Create new emaployee</a>

            <div class=" shadow-lg ">

                <div class="box01">
                    <table id="example" class="table table-dark table-striped  text-center" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID </th>
                                <th>Employee NumberID</th>
                                <th>Emplyee name</th>
                                <th>Email Address </th>
                                <th>User Type</th>
                                <th>Employee Status</th>
                                <th>action </th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            include '../mysqldbconnection.php';
                            if (!$conn) {
                                die("Connection failed: " . mysqli_connect_error());
                            } else {

                                $sql = "SELECT * From employee  ";
                                // $sql = "SELECT * FROM pricetable";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $my_id = $row["id"];
                                        echo "<tr>";
                                        echo "<td>" . $row["id"] . "</td>";
                                        echo "<td>" . $row["employee_no"] . "</td>";
                                        echo "<td>" . $row["name"] . "</td>";
                                        echo "<td>" . $row["email"] . "</td>";
                                        echo "<td>" . $row["type"] . "</td>";
                                        echo "<td>" . $row["status"] . "</td>";
                                        echo "<td> <button   myid='" . $row['id'] . "' class='myModal btn btn-info' data-toggle='modal' data-target='#exampleModalCenter'><i class='bi bi-file-earmark-text'></i></button></td>";
                                        echo "</tr>";
                                    }
                                }
                                $conn->close();
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Customer Details </h5>
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
            url: 'emplyeemodelviews.php?myid=' + bb,
            type: 'GET',
            success: function(data) {
                $('#modalContent').html(data);
            }
        });

        $('#exampleModalCenter').modal('show');
    });
    $('#bdel').on('click', function() {
        $('#exampleModalCenter').modal('close');
    });
    $('#hidem').on('click', function() {
        $('#exampleModalCenter').modal('hide');
    });
</script>
<?php include '.././Interface/Sharelayouts/Footer.php'; ?>
