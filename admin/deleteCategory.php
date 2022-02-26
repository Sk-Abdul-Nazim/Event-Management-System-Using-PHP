<?php
include('includes/config.php');
error_reporting(0);
 if(!isset($_SESSION["adminLoggedin"])){
      header("location:adminLogin/");
      exit;
  }

$did = $_REQUEST['id'];
$sql="UPDATE `category` SET isActive=0 WHERE category_id='$did'";
if(mysqli_query($conn, $sql)){
    echo "Records delete successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}

$conn->close();
header('location:category.php');
 ?>
