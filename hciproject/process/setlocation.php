<?php
$prevLocation = basename($_SERVER['HTTP_REFERER']);
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['location']) && !empty($_POST["location"])){
		if (!isset($_SESSION['start']) || (isset($_SESSION['start']) && $prevLocation == 'location.php')){
			$_SESSION['start'] = $_POST['location'];
			$_SESSION['originLat'] = $_POST['originLat'];
			$_SESSION['originLng'] = $_POST['originLng'];
			header("location: ../setdestination.php");
		}
		else if ($prevLocation == 'location.php'){
			header("location: ../setdestination.php");
		}
		else {
			$_SESSION['destination'] = $_POST['location'];
			$_SESSION['destLng'] = $_POST['destLng'];
			$_SESSION['destLat'] = $_POST['destLat'];
			if ($_SESSION['role'] == 'driver'){
				header("location: ../rideinfo.php");
			} else {
				header("location: ../confirmlocation.php");
			}
		}
	}
	unset($_POST['location']);
}
?>