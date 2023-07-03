<?php
include '.././Interface/Sharelayouts/header.php';
include '.././Interface/Navbar.php';

?>
<style>
    .fontsize {
        font-size: 50px;
    }

    .fontsize2 {
        font-family: 'Sedgwick Ave Display', cursive;
        font-size: 30px;
    }
</style>
<div class="card">
    <div class="card-header shadow-lg">
    <h3>Production Deatils</h3>
    </div>
    <div class="card-body">
        <a class="btn btn-info" href="../Category/category.php"><i class="bi bi-file-earmark-plus"></i> Category Info</a>
        <a class="btn btn-info" href="../Product/product.php"><i class="bi bi-bookmark"></i> Production Info</a>
        <hr>
        <div class=" shadow-lg box">
            <h3>Product codes</h3>
            <div class="container-fluid px-4">
                <div class="row">
                    <div class="col-xl-3 col-md-6" id="left">
                        <div class="card box-shawdow bg-secondary text-white mb-4">
                            <div class="card-body fontsize2">Neckless</div>
                            <div class=' row mx-0 d-flex jusitify-content-center'>
                                <div class='col-md-12 d-flex justify-content-center'>
                                    <label class="text-center fontsize" id="size">"SJL000"</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6" id="left">
                        <div class="card box-shawdow bg-secondary text-white mb-4">
                            <div class="card-body fontsize2">Finger Rings</div>
                            <div class=' row mx-0 d-flex jusitify-content-center'>
                                <div class='col-md-12 d-flex justify-content-center'>
                                    <label class="text-center fontsize" id="size">"SJR000"</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6" id="left">
                        <div class="card box-shawdow bg-secondary text-white mb-4">
                            <div class="card-body fontsize2">Ear Ring</div>
                            <div class=' row mx-0 d-flex jusitify-content-center'>
                                <div class='col-md-12 d-flex justify-content-center'>
                                    <label class="text-center fontsize" id="size">"SJE000"</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6" id="left">
                        <div class="card box-shawdow bg-secondary text-white mb-4">
                            <div class="card-body fontsize2">Bangles</div>
                            <div class=' row mx-0 d-flex jusitify-content-center'>
                                <div class='col-md-12 d-flex justify-content-center'>
                                    <label class="text-center fontsize" id="size">"SJB000"</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <table id="example" class="table table-dark table-striped text-center" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Price (Rs)</th>
                                <th>Product category</th>
                                <th>status</th>
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
</div>
<?php include './../Interface/Sharelayouts/Footer.php';