<?php
$productname = "";
$productdescription = "";
$productPrice = "";
$procategory_id = "";
$productstatus = "";


include '../mysqldbconnection.php';
if (!$conn) {
    die("Connection failed" . mysqli_connect_error());
} else {
    $my_id = $_REQUEST['myid'];
    // $sql = "SELECT * FROM product";
    $sql="SELECT 
    product.id, 
    product.name, 
    product.price,category.name as 'catname',
    product.status 
    From product 
    left join category on product.category_id =category.id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $productname = $row['name'];
            $productprice = $row['price'];
            $procategory_id = $row['catname'];
            $productstatus = $row['status'];
        }
    }
}
?>
<div class="container shadow-lg box">
    <form action="productupdate.php" method="POST" name="staffadd">
        <label>Name of the Product :</label><br>
        <input class="form-control" type=" text" name="pname" id="pname" value="<?php echo $productname; ?>" readonly />
        <br />
        <label>Price of the product (Rs.):</label><br>
        <input class="form-control" type=" text" name="pprice" id="pprice" value="<?php echo $productprice; ?>" required />
        <br />
        <label>Category of the product :</label><br>
        <input class="form-control" type=" text" name="pcategory" id="pcategory" value="<?php echo $procategory_id; ?>" readonly />
        <br />
        <label>Status of the Product :</label><br>
        <select class="form-control" name="cstaus" id="cstaus" required>
            <option value="Avaible Production">Avaible Production</option>
            <option value="Sold out Production">Sold out Production</option>
        </select>
        <br />
        <div class="d-grid gap-2">
            <input class="btn btn-secondary btn-update" type="submit" value="Submit" />
        </div>
        <input style="display: none;" type="text" name="sid" id="sid" value="<?php echo $my_id; ?>" required />

    </form>
</div>
