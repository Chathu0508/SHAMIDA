<?php 
/*supplier payments statsu*/
$pendingQuery = "SELECT Count(*) as PendingCount FROM cost WHERE status= 'Payment Pending'";
$pendingResult = mysqli_fetch_assoc(mysqli_query($con, $pendingQuery));

$pendingCount = $pendingResult['PendingCount'];

$approvalQuery = "SELECT Count(*) as approvalQuery FROM cost WHERE status= 'Payment Complete'";
$approvalResult = mysqli_fetch_assoc(mysqli_query($con, $approvalQuery));

$approvalCount = $approvalResult['approvalQuery'];

/*active customer*/ 
$inactivecusQuery = "SELECT Count(*) as PendingCount FROM cost WHERE status= 'Payment Pending'";
$inactivecusResult = mysqli_fetch_assoc(mysqli_query($con, $inactivecusQuery));

$pendingCount = $inactivecusResult['PendingCount'];

$acticecusQuery = "SELECT Count(*) as approvalQuery FROM cost WHERE status= 'Payment Complete'";
$activecusResult = mysqli_fetch_assoc(mysqli_query($con, $acticecusQuery));

$approvalCount = $activecusResult['approvalQuery'];


/*Customer order processed */
$pendingorder = "SELECT COUNT(*) as pendingorder FROM ordercreate WHERE status= 'Proceed to Payment method'";
$pendingResult = mysqli_fetch_assoc(mysqli_query($con, $pendingorder));

$ProcessedPaymentsCount = $pendingResult['pendingorder'];

$cancelorder = "SELECT Count(*) as cancelorder FROM ordercreate WHERE status= 'Cancel Order'";
$cancelResult = mysqli_fetch_assoc(mysqli_query($con, $cancelorder));

$cancelCount = $cancelResult['cancelorder'];


$pendingpayments = "SELECT COUNT(*) AS pendingpayments FROM paymentmethod WHERE status= 'Payment not Complete'";
$pendingpayResult = mysqli_fetch_assoc(mysqli_query($con, $pendingpayments));

$pendingPaymentsCount = $pendingpayResult['pendingpayments'];

$compeltepayments = "SELECT COUNT(*) AS compeltepayments FROM paymentmethod WHERE status= 'Payment Complete'";
$completepayResult = mysqli_fetch_assoc(mysqli_query($con, $compeltepayments));

$completePaymentsCount = $completepayResult['compeltepayments'];

$fullpayments = "SELECT COUNT(*) AS fullpayments FROM paymentmethod WHERE payment_status = 'Full Payment'";
$FullpayResult = mysqli_fetch_assoc(mysqli_query($con, $fullpayments));

$FullPaymentsCount = $FullpayResult['fullpayments'];


$advacnepayments = "SELECT COUNT(*) AS advacnepayments FROM paymentmethod WHERE payment_status = 'Advance Payment'";
$advcepayResult = mysqli_fetch_assoc(mysqli_query($con, $advacnepayments));

$advacnePaymentsCount = $advcepayResult['advacnepayments'];



?>