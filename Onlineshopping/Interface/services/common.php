<?php
function getDataCount($con,$type){
$query = "SELECT SUM(units) as 'count' FROM `cost` WHERE address='$type' LIMIT 1";

$rejectResult = mysqli_fetch_assoc(mysqli_query($con, $query));
return $rejectResult['count'];

}
function getcustomerdatacount($con,$status){
    $query2 = "SELECT SUM(units) as 'count2' FROM `ordercreate' WHERE address='$status' LIMIT 1";
    
    $rejectResult2 = mysqli_fetch_assoc(mysqli_query($con, $query2));
    return $rejectResult2['count2'];
}

function getcustomerordercount($con,$paystatus){
    $query2 = "SELECT SUM(units) as 'count3' FROM `paymentmethod' WHERE address='$paystatus' LIMIT 1";
    
    $rejectResult2 = mysqli_fetch_assoc(mysqli_query($con, $query2));
    return $rejectResult2['count3'];
}
function getcustomeroaymentmethod($con,$paymethstatus){
    $query2 = "SELECT SUM(units) as 'count4' FROM `paymentmethod' WHERE address='$paymethstatus' LIMIT 1";
    
    $rejectResult2 = mysqli_fetch_assoc(mysqli_query($con, $query2));
    return $rejectResult2['count4'];
}
?>