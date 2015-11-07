<?php
$prevLocation = basename($_SERVER['HTTP_REFERER']);
session_start();
include 'connectdb.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {	
	/* Information of car */
	$carPlate = $_SESSION['carplate'];
	
	/* Save to database */
        $sql = "DELETE FROM driverjourney WHERE carPlate = '".$carPlate."'";

	if(mysqli_query($connection, $sql)){
		header('location: ../home.php');
	}
	else {
		header('location: ../drivernavigation.php');
		$_SESSION['error'] = "An error occured, please try again.";
	}
}
?>