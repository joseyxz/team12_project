<?php 
include 'process/connectdb.php';

if(mysqli_connect_errno()) {die(mysqli_connect_errno());}

$sql_statement = "SELECT p.name, r.pickUpLocation, r.destinateLocation, r.rideCost FROM carrequest r, userprofile p WHERE r.PID = p.userId AND reqStatus = 'Pending'";
$result = mysqli_query($connection, $sql_statement);
$row = mysqli_fetch_assoc($result);
if($row > 0)
{
	$data = array( ['riderName'=>$row['name']], 
					['pickupLoc'=>$row['pickUpLocation']], 
					['destination'=>$row['destinateLocation']], 
					['cost'=>$row['rideCost']]);
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