<?php
session_start();
include 'connectdb.php';

if ($_GET["role"] == "driver"){
	$_SESSION['role'] = "driver";
	$sql = "SELECT j.carPlate, j.originalLocation, j.currentDestination FROM driverjourney j, drivercar c WHERE c.carPlate = j.carPlate AND c.driverID = ".$_SESSION['userid'];
	$result = mysqli_query($connection, $sql);
	$row = mysqli_fetch_assoc($result);
	if ($row != ""){
		$_SESSION['carplate'] = $row['carPlate'];
		$_SESSION['start'] = $row['originalLocation'];
		$_SESSION['destination'] = $row['currentDestination'];
		header("location: ../drivernavigation.php");
	}
	else {
		header("location: ../location.php");
	}
}
else
{
	$_SESSION['role'] = "rider";
	$sql = "SELECT pickUpLocation, destinateLocation from carrequest WHERE PID = ".$_SESSION['userid'];
	$result = mysqli_query($connection, $sql);
	$row = mysqli_fetch_assoc($result);
	if ($row != ""){
		$_SESSION['start'] = $row['pickUpLocation'];
		$_SESSION['destination'] = $row['destinateLocation'];
		header("location: ../response.php");
	}
	else {
		header("location: ../location.php");
	}
}
?>