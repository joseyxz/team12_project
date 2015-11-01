<?php
session_start();
if ($_GET["role"] == "driver"){
	$_SESSION['role'] = "driver";
}
else
{
	$_SESSION['role'] = "rider";
}
header("location: ../location.php#location");
?>