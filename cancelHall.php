<?php
include('includes/config.php');
error_reporting(0);

  if(!isset($_SESSION["userLoggedin"])){
	$_SESSION['loggedin_search'] = "You Have To Login Before Hall Book!";
		 header("location:userLogin/");
		 exit;
 }

$reserv_id = $_REQUEST['id'];

$sqlf="SELECT hall_id FROM reservationhall WHERE reserv_id='$resr_id'";
$dataf=mysqli_query($conn,$sqlf);
$rowf = mysqli_fetch_assoc($dataf);

$hall_id=$rowf['hall_id'];

$sql="UPDATE `reservationhall` SET isActive=0 WHERE reserv_id='$reserv_id'";

if(mysqli_query($conn, $sql)){

	$sql1="UPDATE hall SET hall_availibility='YES', isActive=1 WHERE hall_id= $hall_id";
	$data1= mysqli_query($conn,$sql1);

  echo '<script type="text/javascript">';
  echo 'alert("Successfully Hall Canceled, Hall booking again...Thank You");';
  echo 'window.location.href = "userMyBooking.php";';
  echo '</script>';

} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}

$conn->close();

 ?>
