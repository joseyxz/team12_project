<?php

define('DBHOST','localhost');
define('DBNAME','team12_database');
define('DBUSER','root');
define('DBPASS','');

$errorMessage = "";
$num_rows = 0;

$connection = mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);

$error = mysqli_connect_error();
if($error != null){
    $output = "<p>Unable to connect to database </p>".$error;
    //output error message and terminate current script
    exit($output);
}?>