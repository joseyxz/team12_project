<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['cost'])){
		/* Save request to database */
	}
	header('location:../response.php');
}
?>