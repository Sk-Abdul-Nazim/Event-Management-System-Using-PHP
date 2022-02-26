<?php
include('../includes/config.php');
error_reporting(0);

if (isset($_POST['login'])) {

  $u_email = $_POST['u_email'];
  $u_password = $_POST['password'];

  $sql = " SELECT * from user_registration WHERE u_email = '$u_email' AND u_password = '$u_password'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if($row['isActive'] == 1){

      $_SESSION['userLoggedin'] = false;
      $_SESSION['id']=$row['u_id'];
     $_SESSION['name']=$row['u_name'];

     $userID = $_SESSION['id'];
     $query12 = "UPDATE user_registration SET u_active=1 WHERE u_id=$userID";
     $data12= mysqli_query($conn,$query12);

     // $_SESSION['login_time'] = time();
     header('location:../');
    } else {
            $_SESSION['error']="Account has been deleted, please create an account!";

            header('location:../userLogin/');
    }
  }else{

    $_SESSION['userLoggedin'] = true;
    $_SESSION['error']="invalid email id or password !";
    $_SESSION['mustHaveAnAccount'] = "You Have To Login Before Room Booked";
    header('location:../userLogin/');
    // header("Location: http://indianhotel2019.000webhostapp.com/login.php");
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
