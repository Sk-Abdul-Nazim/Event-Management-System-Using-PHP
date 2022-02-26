<?php
include('includes/config.php');
if(!isset($_SESSION["adminLoggedin"])){
     header("location:adminLogin/");
     exit;
 }
 date_default_timezone_set("Asia/Kolkata");
 $currDate = date("y-m-d");
 $currTime = date("h:i a");
$did = $_REQUEST['id'];


$sql="UPDATE `hall` SET hall_date='$currDate', hall_time='$currTime', hall_availibility='YES', isActive=1 WHERE hall_id='$did'";
if(mysqli_query($conn, $sql)){
    echo "Records Activeted successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}

$conn->close();
header('location:nonActiveHall.php');
 ?>
 <script type="text/javascript">
 var idleTime = 0;
 $(document).ready(function () {
     //Increment the idle time counter every minute.
     var idleInterval = setInterval(timerIncrement, 60000); // 1 minute

     //Zero the idle timer on mouse movement.
     $(this).mousemove(function (e) {
         idleTime = 0;
     });
     $(this).keypress(function (e) {
         idleTime = 0;
     });
 });

 function timerIncrement() {
     idleTime = idleTime + 1;
     if (idleTime > 19) { // 20 minutes
        //javascript er popup dite hobe, je abar login korar jonno session expired, because security
        window.location.href = "adminLogin/sessionExpiredAdmin.php";
         // window.location.reload();
     }
 }
 </script>
