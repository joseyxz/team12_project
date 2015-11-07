<?php
session_start();
include 'connectdb.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['cost']) && ($_POST['cost']!='0')){
		$passengerID = $_SESSION['userid'];
		$cost = $_POST['cost'];
		$carPlate = $_POST['carplate'];
		
		/* Information of location */
		$origin = $_SESSION['start'];
		$originLng = $_SESSION['originLng'];
		$originLat = $_SESSION['originLat'];
		$destination = $_SESSION['destination'];
		$destLong = $_SESSION['destLng'];
		$destLat = $_SESSION['destLat'];
	
		/* Save to database */
		$sql = "INSERT INTO carrequest (PID, carPlate, pickUpLocation, pickupLong, pickupLat, destinateLocation, destLong, destLat, rideCost, reqStatus) VALUES ("
		.$passengerID.",'".$carPlate."','".$origin."',".$originLng.", ".$originLat.", '".$destination."', ".$destLong.", ".$destLat.", ".$cost.", 'Pending')";

		if(mysqli_query($connection, $sql)){
			header('location: ../response.php');
		}
		else {
			header('location: ../carpoolcars.php');
			$_SESSION['error'] = "An error occured, please try again.";
		}
	}
	else
	{
		header('location: ../carpoolcars.php');
		$_SESSION['error'] = "Please enter a valid cost to offer.";
	}
}
?>