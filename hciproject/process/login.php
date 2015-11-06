<?php
require_once 'connectdb.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    try{
        $sql= "SELECT * FROM userprofile where userName='".$username."' and passw='".$password."'";
            if($result = mysqli_query($connection,$sql))
            {      
                if($row = mysqli_fetch_assoc($result))
                {
                    $userfullname=$row['name'];
                    $_SESSION['fname']=$userfullname;
                    $_SESSION['login'] = 1;
            
                    header("location: ../home.php");
                }
                else{
                    header("location: ../home.php?redirect:error");
                }
            mysqli_stmt_free_result($stmt);
            mysqli_close($connection);
        }
    }
    catch(Exception $e){
            die(var_dump($e));
    }
}
?>
