<?php
include('includes/config.php');
error_reporting(0);
 if(!isset($_SESSION["adminLoggedin"])){
      header("location:adminLogin/");
      exit;
  }

 $reserv_id = $_REQUEST['id'];
$sql = "SELECT * FROM reservationhall WHERE reserv_id='$reserv_id'";
$data = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($data);

$hall_id = $row['hall_id'];


 $sql1 = "UPDATE reservationhall SET isActive=0 WHERE reserv_id='$reserv_id'";
 if(mysqli_query($conn,$sql1))
 {
   $sql1="UPDATE hall SET hall_availibility='YES', isActive=1 WHERE hall_id= $hall_id";
   $data1= mysqli_query($conn,$sql1);
   header('location:reservation.php');
 }
 else {
        echo "ERROR: could not able to execute $sql1. " .mysqli_error($conn);
 }

 ?>
