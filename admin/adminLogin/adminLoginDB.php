<?php
include('../includes/config.php');


if(isset($_POST['submit'])){

  $a_username = $_POST['username'];
  $a_password = $_POST['password'];

  $sql = " SELECT * from admin_login WHERE a_username = '$a_username' AND a_password = '$a_password'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
         $row = $result->fetch_assoc();

         $_SESSION['adminLoggedin'] = false;
         $_SESSION['admin_id'] = $row['a_id'];

         if($row['isActive'] == 1){

                $_SESSION['a_username'] = $a_username;
                header('location:../');

          } else {

                $_SESSION['error']="Account not activated";
                header('location:../adminLogin/');

                 }
       }
  else{

    $_SESSION['adminLoggedin'] = true;
    $_SESSION['error']="invalid admin id or password !";
    header('location:../adminLogin/');
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
