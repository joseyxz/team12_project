<?php 
$sql = "SELECT j.carPlate, j.originalLocation, j.currentDestination FROM driverjourney j, drivercar c WHERE c.carPlate = j.carPlate AND c.driverID = ".$_SESSION['userid'];
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);
$_SESSION['carplate'] = $row['carPlate'];
$_SESSION['origin'] = $row['originalLocation'];
$_SESSION['currentDest'] = $row['currentDestination'];

?>