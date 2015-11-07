<?php 
$connection = mysqli_connect('localhost','psread','P@$$w0rd','team12_database');
if(mysqli_connect_errno()) {die(mysqli_connect_errno());}

$sql_statement = "SELECT * FROM carrequest WHERE reqStatus = 'Pending'";
$result = mysqli_query($connection, $sql_statement);
$row = mysqli_fetch_assoc($result);
if($row > 0)
{
	$data = array( ['pickupLoc'=>$row['pickUpLocation']]);
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