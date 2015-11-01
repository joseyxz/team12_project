<?php 
/*
include 'connectdb.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uname = $_POST['username'];
    $pword = $_POST['password'];

    $uname = htmlspecialchars($uname);
    $pword = htmlspecialchars($pword);

    $SQL = 'SELECT * FROM login WHERE username = "'.mysql_real_escape_string($uname).'" AND password = "'.mysql_real_escape_string($pword).'"';
    $result = mysqli_query($connection, $SQL);
    $num_rows = mysqli_affected_rows($connection);                        
    
    if($num_rows){
        session_start();
        $_SESSION['login'] = "1";
        $_SESSION['userlogin'] = $uname;
        
        $sql = 'select name from login where username = "'.mysql_real_escape_string($uname).'" limit 1';
        $result2 = mysqli_query($connection, $sql);
        $row = mysqli_fetch_assoc($result2);
        $_SESSION['fname'] = $row['name'];
        
        header("location: main.php");
    }
    else{
        session_start();
        $_SESSION['login'] = "";
        $_SESSION['error'] = "1";
        header("location: signin.php");
    }
	}*/
    session_start();
	$_SESSION['login'] = "1";
	header("location: ../home.php");

