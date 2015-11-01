<?php
$prevLocation = basename($_SERVER['HTTP_REFERER']);
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$_SESSION['drivername'] = $_POST['drivername'];
	$_SESSION['cartype'] = $_POST['cartype'];
	$_SESSION['occupants'] = $_POST['occupants'];
	$_SESSION['carplate'] = $_POST['carplate'];
	
	header('location: ../confirmride.php');
}
?>