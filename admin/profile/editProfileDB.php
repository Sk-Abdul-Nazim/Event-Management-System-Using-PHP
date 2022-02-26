<?php
include('../includes/config.php');
error_reporting(0);


 $a_id=$_SESSION['admin_id'];
if(isset($_POST['rgn']))
{

  $a_username = $_POST['username'];
  $npassword = $_POST['npassword'];
  $cpassword = $_POST['cpassword'];

    if($npassword != $cpassword){
            $_SESSION['profilePassword']="password doesn't match!";
           header('location:editProfile.php');
          // unset($_SESSION['error']);
      }
  else{

        $sql = "UPDATE admin_login set a_username='$a_username',a_password='$npassword' WHERE a_id='$a_id'";
        $result= mysqli_query($conn,$sql);

        if($result){

          unset($_SESSION['profilePassword']);
          echo '<script type="text/javascript">';
          echo 'alert("Profile Updated");';
          echo 'window.location.href = "../profile/";';
          echo '</script>';
          $conn.close();
        }
        else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
        }
  }

}
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
        window.location.href = "../adminLogin/sessionExpiredAdmin.php";
         // window.location.reload();
     }
 }
 </script>
