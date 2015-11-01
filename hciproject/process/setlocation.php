<?php
$prevLocation = basename($_SERVER['HTTP_REFERER']);
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['location']) && !empty($_POST["location"])){
		if (!isset($_SESSION['start'])){
			$_SESSION['start'] = $_POST['location'];
			header("location: ../setdestination.php");
		}
		else if ($prevLocation == 'location.php'){
			header("location: ../setdestination.php");
		}
		else {
			$_SESSION['destination'] = $_POST['location'];
			header("location: ../confirmlocation.php");
		}
	}
	unset($_POST['location']);
}
?>