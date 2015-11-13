<?php 
include 'process/connectdb.php';
session_start();

if(mysqli_connect_errno()) {die(mysqli_connect_errno());}

$sql_statement1 = "SELECT pid FROM carRequest WHERE PID = " . $_GET['pid'] . " AND carPlate = '" . $_GET['carplate'] . "'";
$result = mysqli_query($connection, $sql_statement1);
$row = mysqli_fetch_assoc($result);
if($row>0)
{
	$sql_statement2 = "DELETE FROM carRequest WHERE PID = " . $_GET['pid'] . " AND carPlate = '" . $_GET['carplate'] . "'";
	mysqli_query($connection, $sql_statement2);
	$data = array( ['error'=>0]);
	header('Content-type: application/json');
	echo json_encode( $data );
}
else
{
	$data = array(['error'=>1]);
	header('Content-type: application/json');
	echo json_encode( $data );
}
mysqli_close($connection);
?>