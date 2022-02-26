<?php
include('includes/config.php');
error_reporting(0);
 if(!isset($_SESSION["adminLoggedin"])){
      header("location:adminLogin/");
      exit;
  }

$hid = $_REQUEST['id'];
$sql="UPDATE `hall` SET hall_availibility='NO', isActive=0 WHERE hall_id='$hid'";
if(mysqli_query($conn, $sql)){
    echo "Records delete successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}

$conn->close();
header('location:hall.php');
 ?>
