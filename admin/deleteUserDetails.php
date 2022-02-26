<?php
include('includes/config.php');
if(!isset($_SESSION["adminLoggedin"])){
     header("location:adminLogin/");
     exit;
 }
$did = $_REQUEST['id'];
$sql="UPDATE `user_registration` SET u_active=0, isActive=0 WHERE u_id='$did'";
if(mysqli_query($conn, $sql)){
    echo "Records delete successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}

$conn->close();
header('location:userDetails.php');
 ?>
