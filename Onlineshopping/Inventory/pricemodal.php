<?php
$supliername = "";
$Rawname = "";;
$Rawtype = "";;
$PriceList = "";;


include '../mysqldbconnection.php';

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    $my_id = $_REQUEST['myid'];
    $sql = $sql = "SELECT 
    pricetable.id,
    supplierdeatils.name as 'suppname',
    raw_metiral.name as 'rawname',
    raw_metiral.type as 'rawtype',
    pricetable.price  
    From pricetable  
    LEFT JOIN supplierdeatils on pricetable.supplier_id=supplierdeatils.id
    LEFT JOIN raw_metiral on pricetable.rawmetiral_id=raw_metiral.id
    WHERE  pricetable.id='$my_id' ";



    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            $supliername = $row["suppname"];
            $Rawname = $row["rawname"];
            $Rawtype = $row["rawtype"];
            $PriceList = $row["price"];
?>
            <div class="modal-body">
                <form action="priceupdate.php" method="POST" name="staffadd">
                <label>Name of the supplier :</label><br>
                    <input class="form-control" type=" text" name="supname" id="supname" value="<?php echo $supliername; ?> " readonly />
                    <label>Name of the Raw Material :</label><br>
                    <input class="form-control" type=" text" name="rawname" id="rawname" value="<?php echo $Rawname; ?>" readonly />
                    <label>Type of the Raw material:</label><br>
                    <input class="form-control" type=" text" name="rawtype" id="rawtype" value="<?php echo $Rawtype; ?>" readonly />
                    <label>Pirce calling from the supplier:</label><br>
                    <input class="form-control" type=" text" name="price" id="price" value="<?php echo $PriceList; ?>"  />
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