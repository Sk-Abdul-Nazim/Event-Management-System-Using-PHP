<?php
include('../includes/config.php');
error_reporting(0);


if(isset($_POST['registration']))
{
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
            header('location:../userRegistration/');
      }
  else{
    $sql = " INSERT INTO user_registration(u_name,u_address,u_phone,u_adhar,u_email,u_password,u_date,u_time) values('$u_name','$u_address','$u_phone','$u_adhar','$u_email','$u_password','$currDate','$cuttTime')";
    $result = $conn->query($sql);
        if($result){
          // mail send
          $_SESSION['u_email'] = $u_email;
          $_SESSION['u_pass'] = $u_password;
          unset($_SESSION['notMatchPassword']);
          echo '<script type="text/javascript">';
          echo 'alert("You are Scuccessfully registered. Now you can login ");';
          echo 'window.location.href = "../userLogin/";';
          echo '</script>';
          $conn.close();
        }
        else{
          echo "Insert Failed";
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
