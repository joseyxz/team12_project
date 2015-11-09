<?php 

$sql = "SELECT r.carPlate, r.pickUpLocation, j.originalLocation FROM carrequest r, driverjourney j WHERE r.carPlate = j.carPlate AND r.PID = ".$_SESSION['userid']." AND r.reqStatus='Approved'";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);
$carplate = $row['carPlate'];
$myLocation = $row['pickUpLocation'];
$driverLocation = $row['originalLocation'];

?>