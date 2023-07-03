<?Php
include '.././Interface/Sharelayouts/header.php';
include '.././Interface/Navbar.php';
include '.././CSSRes/Res.php';
include '.././CSSRes/css.php';


?>
<style>
  h2 {
    color: #fff;
    /* fallback for old browsers */
    color: #000;
    /* fallback for old browsers */
    color: #fff;
  }

  #Suppliersection {
    padding: auto;
    margin-top: 50px;
    margin-left: 50px;
    margin-right: 50px;
    margin-bottom: 50px;
    background-color: #fff;
  }


  #Rawmaterial {
    padding: auto;
    margin-top: 50px;
    margin-left: 50px;
    margin-right: 50px;
    margin-bottom: 50px;
    background-color: #fff;

  }
</style>
<section id="Rawmaterial">
  <div class="card">
    <div class="card-header">
      <h3>Raw matrial details</h3>
    </div>
    <div class="card-body">
      <!--a class="btn btn-secondary" id="registermore-btn"><i class="bi bi-front"></i> Register for more</a-->
      <a class="btn btn-info" href="Rawmaterials.php"><i class="bi bi-file-earmark-plus"></i> Add New Raw Metiral</a>
      <a class="btn btn-info" href="stockcall.php"><i class="bi bi-bookmark"></i> Stock Inventory Info</a>
      <a class="btn btn-info" href="productioncost.php"><i class="bi bi-bookmark-dash"></i> Production Cost Info</a>
      <a class="btn btn-info" href="dailyleftover.php"><i class="bi bi-bookmark-plus"></i></i> Daily Leftover Info</a>
      <hr>
      <table id="rawdatatable" class="table table-dark table-striped text-center" style="width:100%">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name </th>
            <th>type </th>
            <th>status</th>
          </tr>
        </thead>
        <tbody>

          <?php
          include '../mysqldbconnection.php';
          if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
          } else {

            $sql = "SELECT *  From raw_metiral ";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                $my_id = $row["id"];

                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["type"] . "</td>";
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
</section>

<section id="Rawmaterial">

</section>


<section id="Suppliersection">
  <div class="card">
    <div class="card-header">
      <h3>Supplier details</h3>
    </div>
    <div class="card-body">
      <a class="btn btn-info" href="Suppiler.php"><i class="bi bi-front"></i> Register for more</a>
      <a class="btn btn-info" href="pricelist.php"><i class="bi bi-front"></i> Call For Price range</a>
      <a class="btn btn-info" href="stockfullcost.php"><i class="bi bi-front"></i> Call For Price range</a>
      <hr>
      <table id="rawdatatable01" class="table table-dark table-striped text-center" style="width:100%">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name </th>
            <th>Contact number </th>
            <th>Address</th>
            <th>status</th>
          </tr>
        </thead>
        <tbody>
          <?php
          include '../mysqldbconnection.php';
          if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
          } else {

            $sql = "SELECT *  From supplierdeatils ";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                $my_id = $row["id"];
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["contactnumber"] . "</td>";
                echo "<td>" . $row["address"] . "</td>";
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
</section>



<script type="text/javascript">
  $(document).ready(function() {
    $('#rawdatatable').DataTable();
    $('#rawdatatable01').DataTable();
  });

 
   


</script>
<br>
<?php include './../Interface/Sharelayouts/Footer.php';