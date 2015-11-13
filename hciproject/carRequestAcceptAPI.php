<?php 
include 'process/connectdb.php';
session_start();

if(mysqli_connect_errno()) {die(mysqli_connect_errno());}

$sql_statement1 = "SELECT * FROM carRequest WHERE PID = " . $_GET['pid'] . " AND carPlate = '" . $_GET['carplate'] . "' AND reqStatus = 'Pending'";
$result = mysqli_query($connection, $sql_statement1);
$row = mysqli_fetch_assoc($result);
if($row>0)
{
	$sql_statement2 = "UPDATE carRequest SET reqStatus = 'Approved' WHERE PID = " . $_GET['pid'] . " AND carPlate = '" . $_GET['carplate'] . "'";
	mysqli_query($connection, $sql_statement2);
	$data = array( ['error'=>0,
					'pid'=>$row['PID'],
					'carplate'=>$row['carPlate'],
					'pickUpLocation'=>$row['pickUpLocation'],
					'pickupLat'=>$row['pickupLat'],
					'pickupLong'=>$row['pickupLong'],
					'destinateLocation'=>$row['destinateLocation'],
					'destLat'=>$row['destLat'],
					'destLong'=>$row['destLong'],
					'rideCost'=>$row['rideCost'],
					'reqStatus'=>'Approved',
					]);
	header('Content-type: application/json');
	echo json_encode( $data );
	mysqli_free_result($result);
}
else
{
	$data = array(['error'=>1]);
	header('Content-type: application/json');
	echo json_encode( $data );
}
mysqli_close($connection);
?>