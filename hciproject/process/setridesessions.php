<?php
$prevLocation = basename($_SERVER['HTTP_REFERER']);
session_start();
include 'connectdb.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {	
	/* Information of car */
	$_SESSION['cartype'] = $_POST['cartype'];
	$_SESSION['occupants'] = $_POST['occupants'];
	$_SESSION['carplate'] = $_POST['carplate'];
	
	header('location: ../confirmride.php');
}
?>
