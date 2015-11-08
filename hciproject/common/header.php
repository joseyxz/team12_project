<!DOCTYPE html>
<html lang="en" ng-app="mapApp">

<head>

	<?php include 'process/connectdb.php'?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1,minimum-scale=1, maximum-scale=1"">
    <meta name="description" content="">
    <meta name="author" content="">

    <title></title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/agency.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" class="index">

<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <?php
                session_start();
                $currentpage = $_SERVER['REQUEST_URI'];
//                echo $currentpage;
                if ($currentpage == '/team12_project/hciproject/home.php'){
                    echo ' <a class="navbar-brand" href="home.php">Carpool Application</a>';
                }
                if ($currentpage == '/team12_project/hciproject/location.php') {
                echo ' <a class="navbar-brand">';
                    if (isset($_SESSION["role"])) {
                        echo $_SESSION["role"];
                        if ($_SESSION["role"] == "driver") {
                            echo ': set start point</a>';
                        } else {
                            echo ': set pick-up point.</a>';
                        }
                    }            
                }
                if ($currentpage == '/team12_project/hciproject/setdestination.php') {
                echo ' <a class="navbar-brand page-scroll" href="#">';
                    if (isset($_SESSION["role"])) {
                        echo $_SESSION["role"];
                        echo ': set your destination</a>';
                    }
                }
                if ($currentpage == '/team12_project/hciproject/rideinfo.php') {
                echo ' <a class="navbar-brand" href="#">Set Ride Details</a>';
                }
                if ($currentpage == '/team12_project/hciproject/confirmride.php') {
                echo ' <a class="navbar-brand" href="#">Route Summary</a>';
                }
                if ($currentpage == '/team12_project/hciproject/drivernavigation.php') {
                echo ' <a class="navbar-brand" href="#">Displaying Route & Requests </a>';
                }
                if ($currentpage == '/team12_project/hciproject/carpoolcars.php') {
                echo ' <a class="navbar-brand" href="#">Displaying Nearby Carpoolers</a>';
                }
                if ($currentpage == '/team12_project/hciproject/confirmlocation.php') {
                echo ' <a class="navbar-brand" href="#">Request details</a>';
                }
                ?>   
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
            </button>     
            </div>
            
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" >
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a href="home.php">Home</a>
                    </li>
                    <?php
					
					if (!isset($_SESSION['login'])){
					
					}
					else if ($_SESSION['login'] == "1"){
						echo '<li>';
						echo    '<a href="profile.php">Profile</a>';
						echo '</li>';
					}
					?>
                    <li>
                        <a href="help.php#help">Help</a>
                    </li>
					<?php
					if (!isset($_SESSION['login'])){
					
					}
					else if ($_SESSION['login'] == "1"){
						echo '<li>';
						echo    '<a href="process/logout.php">Log Out</a>';
						echo '</li>';
					}
					?>
                </ul>
            </div>
        </div>
        <!-- /.container-fluid -->
    </nav>
    