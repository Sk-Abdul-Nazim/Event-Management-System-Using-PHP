<?php
include('../includes/config.php');

if(!isset($_SESSION["userLoggedin"])){
     header("location:../userLogin/");
     exit;
 }

$userID = $_SESSION['id'];
 $query12 = "UPDATE user_registration SET u_active=0 WHERE u_id='$userID'";
 $data12= mysqli_query($conn,$query12);

session_destroy();
header('location:../');
?>
