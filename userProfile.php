<?php
include('includes/config.php');
error_reporting(0);
if(!isset($_SESSION["userLoggedin"])){
   header("location:userLogin/");
   exit;
}

$u_id=$_SESSION['id'];
$query="SELECT * FROM user_registration where u_id='$u_id'";
$data=mysqli_query($conn,$query);
$total=mysqli_num_rows($data);
if($total!=0)
{

 ?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/styleRegistration.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <style>
                  .link {
                      background-color: white;
                      border: 1px solid black;
                      color: black;
                      padding: 2px 10px;
                      text-align: center;
                      display: inline-block;
                      font-size: 15px;
                      margin: 5px 20px;
                      cursor: pointer;
                      text-decoration:none;

                      padding-top: 10px;
                      padding-right: 10px;
                       padding-bottom:10px;
                      padding-left: 10px;
                  }

          </style>
   <style>

   .aa{
     padding-top: 50px;
     text-align:center;
     font-weight: bold;
     background-image: url("images/bg.jpg");
   }
   </style>
        <style>
           table, th, td {

              margin-right:auto;
              margin-left:auto;
            }
            th, td {
                  padding: 10px;
             }

        </style>
</head>


<body class="aa">
<h2><img src="images/user.png" width="100" height="70" alt="profile"></h2>
   <table>
 <?php
    $row= mysqli_fetch_assoc($data);
   ?>
       <tr style="font-size: 20px;text-lign:center; color:white;"><td>Name</td><td>:</td>
       <td><?php echo $row['u_name'] ?></td></tr>
       <tr style="font-size: 20px;color:white;"><td>Address</td><td>:</td>
       <td><?php echo $row['u_address'] ?></td></tr>
       <tr style="font-size: 20px;color:white;"><td>Phone No.</td><td>:</td>
       <td><?php echo $row['u_phone'] ?></td></tr>
       <tr style="font-size: 20px;color:white;"><td>Adhar No.</td><td>:</td>
       <td><?php echo $row['u_adhar'] ?></td></tr>
       <tr style="font-size: 20px;color:white;"><td>Email ID</td><td>:</td>
       <td><?php echo $row['u_email'] ?></td></tr>
       <tr style="font-size: 20px;color:white;"><td>Password</td><td>:</td>
       <td><?php echo $row['u_password'] ?></td></tr>
   <?php
 }
 else{
   echo "<p style='color:red;text-align:center; font-size:30px;'>Please first sign in then show your details, Thank You...</p>";
   }
  ?>

 </table>

 <?php
  $conn->close();

?>
<br>
<a href="../EventManagement/" class="link">Back</a>
<a href="editUserProfile.php" class="link">Edit Profile</a>
</body>
</html>





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
       window.location.href = "../userLogin/sessionExpire.php";
        // window.location.reload();
    }
}
</script>
