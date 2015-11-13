<?php 
include 'process/connectdb.php';
session_start();

if(mysqli_connect_errno()) {die(mysqli_connect_errno());}

$sql_statement = "SELECT r.PID, r.carplate, p.name, r.pickUpLocation, r.destinateLocation, r.rideCost FROM carrequest r, userprofile p".
" WHERE r.PID = p.userId AND r.reqStatus = 'Pending' AND r.carPlate ='" . $_SESSION['carplate'] . "' LIMIT 1";
$result = mysqli_query($connection, $sql_statement);
$row = mysqli_fetch_assoc($result);
if($row > 0)
{
	$data = array( ['pid'=>$row['PID'],
					'carplate'=>$row['carplate'],
					'riderName'=>$row['name'], 
					'pickupLoc'=>$row['pickUpLocation'], 
					'destination'=>$row['destinateLocation'], 
					'cost'=>$row['rideCost']]);
	header('Content-type: application/json');
	echo json_encode( $data );
}
else
{
	$data = array();
	header('Content-type: application/json');
	echo json_encode( $data );
}
mysqli_free_result($result);
mysqli_close($connection);
?>