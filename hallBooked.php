<?php
include('includes/config.php');
error_reporting(0);

  if(!isset($_SESSION["userLoggedin"])){
	$_SESSION['loggedin_search'] = "You Have To Login Before Hall Book!";
		 header("location:userLogin/");
		 exit;
 }

if(isset($_POST["hallBooked"])){

  $u_id=$_SESSION['id'];
  $hall_id = $_POST['hall_id'];
  $arr_date = $_POST['arr_date'];
  $dep_date = $_POST['dep_date'];
  $price = $_POST['hallPrice'];
  $payment_id = $_POST['payment'];

  date_default_timezone_set("Asia/Kolkata");
  $currDate = date("y-m-d");
  $currTime = date("h:i a");
$orderID = substr(md5(microtime()), 0, 8);

               $sql = "INSERT INTO `reservationhall` (order_no, arrival_date, departure_date, booked_date, booked_time, price, u_id, hall_id, payment_id, `isActive`) VALUES ('$orderID','$arr_date','$dep_date','$currDate','$currTime','$price','$u_id','$hall_id','$payment_id',1)";

              if(mysqli_query($conn, $sql)){
 	                  $sql1="UPDATE hall SET hall_availibility='NO', isActive=0 WHERE hall_id= $hall_id";
 	                  $data1= mysqli_query($conn,$sql1);
                 	//$rowr= mysqli_fetch_assoc($datar);
                  	echo '<script type="text/javascript">';
                  	echo 'alert("Reservation Successfull, You can see Booked Hall details in profile->My Booking");';
                    echo 'window.location.href = "../EventManagement/";';
                   	echo '</script>';
                } else{

                         echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
 		                     //header('location:index.php');
                       }

} else{
      if(isset($_SESSION['blank']) != ""){
      header("location:../404_error.php");
      exit;

          }else{

               header("location:../404_error.php");
               exit;

              }
     }
 $conn->close();
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
         window.location.href = "userLogin/sessionExpire.php";
          // window.location.reload();
      }
  }
  </script>
