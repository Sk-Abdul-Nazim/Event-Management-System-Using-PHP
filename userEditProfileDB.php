<?php
include('includes/config.php');
error_reporting(0);


if(isset($_POST['editProfile']))
{
  $u_id = $_POST['id'];
  $u_name = $_POST['u_name'];
  $u_address = $_POST['u_address'];
  $u_phone = $_POST['u_phone'];
  $u_adhar = $_POST['u_adhar'];
  $u_email = $_POST['u_email'];
  $u_password = $_POST['password'];
  $u_cpassword = $_POST['confirmpassword'];

  date_default_timezone_set("Asia/Kolkata");
  $currDate = date("y-m-d");
  $cuttTime = date("h:i a");

 if($u_password != $u_cpassword){
            $_SESSION['notMatchPassword']="password doesn't match!";
            header('location:userEditProfile.php');
      }
  else{

    $sql = " UPDATE user_registration set u_name='$u_name', u_address='$u_address', u_phone='$u_phone', u_adhar='$u_adhar', u_email='$u_email', u_password='$u_password', u_date='$currDate', u_time='$cuttTime', isActive=1 WHERE u_id='$u_id'";
    $result = $conn->query($sql);
        if($result){
          echo '<script type="text/javascript">';
          echo 'alert("You are Scuccessfully Updated Profile.");';
          echo 'window.location.href = "userProfile.php";';
          echo '</script>';
          $conn.close();
        }
        else{
          echo "Update Failed";
        }
    }

}




if(!empty($_POST["u_emailid"])) {
	$u_email= $_POST["u_emailid"];

  if (filter_var($u_email, FILTER_VALIDATE_EMAIL)===false) {

    echo "<span style='color:red'>Please enter a valid email.</span>";
     echo "<script>$('#registration').prop('disabled',true);</script>";
	}
	else {

  $sql1 = " SELECT * FROM user_registration WHERE u_email = '$u_email' AND isActive=1";
  $result1 = $conn->query($sql1);
  if ($result1->num_rows > 0) {

  echo "<span style='color:red'> Email already exists .</span>";
   echo "<script>$('#registration').prop('disabled',true);</script>";
  }
else{
  echo "<span style='color:green'> Email Valid for Registration .</span>";
 echo "<script>$('#registration').prop('disabled',false);</script>";

}
}

}
else{
    if(isset($_SESSION['blank']) != ""){
     header("location:../404_error.php");
     exit;
      }
    else{
        header("location:../404_error.php");
        exit;

 }
}
 ?>
