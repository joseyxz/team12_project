<?php
$prevLocation = basename($_SERVER['HTTP_REFERER']);
session_start();
include 'connectdb.php';

unset($_SESSION['error']);

/* Information of car */
$passengerID = $_SESSION['userid'];
	
/* Save to database */
$sql = "DELETE FROM carrequest WHERE PID = '".$passengerID."'";

if(mysqli_query($connection, $sql)){
	header('location: ../carpoolcars.php');
}
else {
	header('location: ../response.php');
	$_SESSION['error'] = "An error occured, please try again.";
}
?>