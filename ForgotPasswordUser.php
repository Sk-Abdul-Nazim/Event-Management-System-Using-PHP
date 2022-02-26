<?php
include('includes/config.php');
error_reporting(0);

if(isset($_POST['forgot'])){
  $emaill = $_POST['u_email'];
  $email = trim($emaill);
  $sql = "SELECT * FROM user_registration WHERE u_email='$email'";
  $data = mysqli_query($conn,$sql);
  $total = mysqli_num_rows($data);
  if ($total > 0) {
        // mail send
          $row = mysqli_fetch_assoc($data);
      		 $pass=$row['u_password'];
           //$_SESSION['email'] = $row['email'];
		   //$_SESSION['pass1'] = $pass;

           ?>
           <script>
  alert("Password is : <?php echo $pass?>");
  window.location.href ='userLogin/';
 </script>;
 <?php
       $conn.close();
      }
      else{
        echo "Your Email ID has new one, Please first Signup our site...";
      }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/styleLogin.css">
</head>

<body onload='document.signin.u_email.focus()'>

  <div class="main">

      <div class="container">
          <div class="signup-content">
              <form method="POST" id="signin-form" class="signin-form"  action="<?php echo $_SERVER['PHP_SELF']; ?>">
                  <h2>Forgot Password </h2>
                  <?php
                        if(isset($_SESSION['error']) && $_SESSION['error'] !="")
                        {
                        echo '<span style="color:#B43104; font-family:courier;">'.$_SESSION['error'].'</span>';
                        unset($_SESSION['error']);
                        }
                  ?>
                  <div class="form-group">
                      <input type="email" class="form-input" name="u_email" id="u_email" placeholder="Email" title="Please enter your email" onkeyup="ValidateEmail();" required/>
                      <span id="lblError"></span>
                  </div>


                  <div class="form-group">
                      <input type="submit" name="forgot" id="forgot" class="form-submit submit" value="Submit"/>
                          <a href="../" class="submit-link submit">Back</a>
                  </div>
              </form>
          </div>
      </div>

  </div>



    <!-- JS -->
    <script src="vendor/jquery/jqueryLogin.min.js"></script>
    <script src="js/mainLogin.js"></script>
    <script type="text/javascript" src="js/validate.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
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
