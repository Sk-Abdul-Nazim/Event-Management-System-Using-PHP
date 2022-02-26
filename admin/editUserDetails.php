<?php
include('../includes/config.php');
error_reporting(0);

 if(!isset($_SESSION["adminLoggedin"])){
      header("location:../adminLogin/");
      exit;
  }
 }

$id = $_REQUEST['id'];
$query="SELECT * FROM user_registration WHERE u_id=$id";
$data= mysqli_query($conn,$query);
while ($row= mysqli_fetch_assoc($data))
{
 ?>
 <html>
 <head>
<title>Edit UserDetails</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

 </head>
 <body>
 <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <table>

       <tr>
         <input type="hidden" name="eid" value="<?php echo $row['u_id']?>">
          <td>User Name</td><td>:</td>
          <td><input type="text" name="u_name" placeholder="Enter Your Name" value="<?php echo $row['u_name']?>"></td>
       </tr>

       <tr>
          <td>Address</td><td>:</td>
          <td><input type="text" name="u_address" placeholder="Enter Address" value="<?php echo $row['a_address']?>"></td>
       </tr>

       <tr>
          <td>Phone No.</td><td>:</td>
          <td><input type="text" name="u_phone" placeholder="Enter Phone Number" value="<?php echo $row['u_phone']?>"></td>
       </tr>

       <tr>
          <td>Adhar No.</td><td>:</td>
          <td><input type="text" name="u_adhar" placeholder="Enter Your Adhar No" value="<?php echo $row['last_name']?>"></td>
       </tr>
       <tr>

          <td>Email ID</td><td>:</td>
          <td><input type="text" name="email" placeholder="example@example.com" value="<?php echo $row['email']?>" onfocus="this.select()" autofocus></td>
       </tr>

       <tr>

          <td>Password</td><td>:</td>
          <td><input type="text" name="password" placeholder="Enter Password" value="<?php echo $row['password']?>"></td>
       </tr>
       <tr>
          <td><input type="submit" name="editUser" value="Submit"></td>
       </tr>
    </table>
 </form>
 </body>
 </html>
<?php }
if(isset($_POST['editUser']))
{
  $eid = $_POST['eid'];
   $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
     $email = $_POST['email'];
      $phone = $_POST['phone'];
       $address = $_POST['address'];
        $password = $_POST['password'];
   $sql = "update `registration` set first_name='$fname',last_name='$lname',email='$email',phone='$phone',address='$address',password='$password' where r_id='$eid'";
   if(mysqli_query($conn, $sql)){
       echo "Records update successfully.";
   } else{
       echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
   }

   $conn->close();
  header('location:userDetails.php');
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
        window.location.href = "adminLogin/sessionExpiredAdmin.php";
         // window.location.reload();
     }
 }
 </script>
