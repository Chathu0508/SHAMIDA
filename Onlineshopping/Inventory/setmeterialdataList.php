<?php


$supid = $_REQUEST['supid'];

include '../mysqldbconnection.php';
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {

    $sql = "SELECT raw_metiral.id as 'rid', raw_metiral.name as 'rname'  From raw_metiral left join pricetable on raw_metiral.id=pricetable.rawmetiral_id where pricetable.supplier_id = '".$supid."' ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
     
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['rid'] . '">' . $row['rname'] . '</option>';
        }
    }
}
?>