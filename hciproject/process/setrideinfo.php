<?php
$prevLocation = basename($_SERVER['HTTP_REFERER']);
session_start();
include 'connectdb.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {	
	/* Information of car */
	$carPlate = $_SESSION['carplate'];
	$driverID = $_SESSION['userid'];
	
	/* Information of location */
	$origin = $_SESSION['start'];
	$originLng = $_SESSION['originLng'];
	$originLat = $_SESSION['originLat'];
	$destination = $_SESSION['destination'];
	$destLong = $_SESSION['destLng'];
	$destLat = $_SESSION['destLat'];
	
	/* Save to database */
    $sql = "INSERT INTO driverjourney (carPlate, originalLocation, originalLong, originalLat, destinateLocation, destLong, destLat, currentDestination, currentdestLong, currentdestLat) VALUES ('"
		.$carPlate."','".$origin."',".$originLng.", ".$originLat.", '".$destination."', ".$destLong.", ".$destLat.", '".$destination."', ".$destLong.", ".$destLat.")";

	if(mysqli_query($connection, $sql)){
		header('location: ../drivernavigation.php');
	}
	else {
		header('location: ../confirmride.php');
		$_SESSION['error'] = "An error occured, please try again.";
	}
}
?>