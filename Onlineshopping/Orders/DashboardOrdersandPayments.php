<?php
include '.././Interface/Sharelayouts/header.php';
include '.././Interface/Navbar.php';

?>


<section id="Rawmaterial">
  <div class=" shadow-lg card">
    <div class="card-header">
      <h3>Order Detials summary</h3>
    </div>
    <div class="card-body">
      <a class="btn btn-info" href="order.php"><i class="bi bi-front"></i> Create a new order</a>
      <a class="btn btn-info" href="payment.php"><i class="bi bi-front"></i> Payment Process</a>
    </div>
  </div>
</section>
<br>
<section>
  <div class=" shadow-lg box05 ">
    <table id="example" class="table  table-dark table-striped text-center" style="width:100%">
      <thead>
        <tr>
          <th>ID</th>
          <th>Order id </th>
          <th>Customer Code</th>
          <th>Product Name </th>
          <th>Product Category </th>
          <th>Product Price </th>
          <th>Order Qty </th>
          <th>Total Amount</th>
          <th>Payments Method </th>
          <th>Payment Status</th>
          <th>Order status</th>
          <th>Print Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        include '../mysqldbconnection.php';

        if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
        } else {
          $sql = "SELECT 
                ordercreate.id,
                ordercreate.ordernumber as 'Ordernumber', 
                customer.cust_no as 'CustomerNumber', 
                customer.cusfullname as 'CustomerName',
                customer.	contactno as 'customerContact',
                product.name as 'productionname' ,
                category.name as 'productCategory', 
                product.price as 'productionprice' ,
                ordercreate.qty as 'orderqty' ,
                ordercreate.total as 'TotalAmount' ,
                ordercreate.createdate as 'OrderCreatedate', 
                paymentmethod.payment_method as 'paymenttype', 
                paymentmethod.payment_status as 'paymentstatus', 
                paymentmethod.amount_pay as 'PaymentAmount', 
                paymentmethod.blance_pay as 'Balancepayment', 
                ordercreate.status as 'OrderStatus' 
                FROM ordercreate 
                LEFT JOIN customer on ordercreate.customer_id = customer.id 
                LEFT JOIN product on ordercreate.product_id = product.id  
                LEFT JOIN category on product.category_id =category.id  
                INNER JOIN paymentmethod on paymentmethod.order_id = ordercreate.id
                ";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              $my_id = $row["id"];
              echo "<tr>";
              echo "<td>" . $row["id"] . "</td>";
              echo "<td>" . $row["Ordernumber"] . "</td>";
              echo "<td>" . $row["CustomerNumber"] . "</td>";
              echo "<td>" . $row["productionname"] . "</td>";
              echo "<td>" . $row["productionprice"] . "</td>";
              echo "<td>" . $row["productCategory"] . "</td>";
              echo "<td>" . $row["orderqty"] . "</td>";
              echo "<td>" . $row["TotalAmount"] . "</td>";
              echo "<td>" . $row["paymenttype"] . "</td>";
              echo "<td>" . $row["paymentstatus"] . "</td>";
              echo "<td>" . $row["OrderStatus"] . "</td>";
              echo "<td><button   myid='" . $row['id'] . "' class='myModal btn btn-success' data-toggle='modal' data-target='#exampleModalCenter'><i class='bi bi-pen-fill'></i></button></td>";
              echo "</tr>";
            }
          }
          $conn->close();
        }
        ?>
      </tbody>
    </table>
  </div>
</section>
<section>
  <div class=" shadow-lg box">
    <h3>Order payment Detials</h3>
    <div class="box05">
      <table id="example2" class="table box05 table-dark table-striped text-center" style="width:100%">
        <thead>
          <tr>
            <th>ID</th>
            <th>Order id </th>
            <th>Customer Code</th>
            <th>Customer Number</th>
            <th>Customer contact number</th>
            <th>Product Name </th>
            <th>Product Price </th>
            <th>Order Create adate</th>
            <th>Payments Method </th>
            <th>Payment Status</th>
            <th>amount pay</th>
            <th>Balance Payments</th>
            <th>Order status</th>
            <th>Print Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          include '../mysqldbconnection.php';

          if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
          } else {
            $sql = "SELECT * FROM printout ";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                $my_id = $row["id"];
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["ordernumber"] . "</td>";
                echo "<td>" . $row["customer_id"] . "</td>";
                echo "<td>" . $row["custname"] . "</td>";
                echo "<td>" . $row["contactnumber"] . "</td>";
                echo "<td>" . $row["productno"] . "</td>";
                echo "<td>" . $row["prodoctprice"] . "</td>";
                echo "<td>" . $row["createdate"] . "</td>";
                echo "<td>" . $row["paymentmethod"] . "</td>";
                echo "<td>" . $row["paymentstatus"] . "</td>";
                echo "<td>" . $row["amountpay"] . "</td>";
                echo "<td>" . $row["blancepay"] . "</td>";
                echo "<td>" . $row["orderstatus"] . "</td>";
                //echo "<td><button   myid='" . $row['id'] . "' class='myModal btn btn-success' data-toggle='modal' data-target='#exampleprintmodel'><i class='bi bi-pen-fill'></i></button></td>";
                echo "<td><a class='btn btn-dark' href='print_recite.php?myid=".$row["id"]."' target='_blank'>Print</a></td>";
               
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

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
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

<div class="modal fade" id="exampleprintmodel" tabindex="-1" role="dialog" aria-labelledby="exampleprintmodelTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button id="hidem" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div id="modalContent02"></div>

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
      url: 'Printmodal.php?myid=' + bb,
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

  $(document).ready(function() {
    $('#example2').DataTable();
  });

  $('button.myModal').on('click', function() {

    var bb = $(this).attr("myid");
    $.ajax({
      url: '[Printmodal].php?myid=' + bb,
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

<?php include './../Interface/Sharelayouts/Footer.php';