<?php
include('../includes/config.php');
error_reporting(0);

if(!isset($_SESSION["adminLoggedin"])){
     header("location:../adminLogin/");
     exit;
 }
 $a_id=$_SESSION['admin_id'];
$query="SELECT * FROM admin_login where a_id='$a_id'";
$data=mysqli_query($conn,$query);
$rowa=mysqli_fetch_assoc($data);
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V15</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="../images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../css/utilAdminLogin.css">
	<link rel="stylesheet" type="text/css" href="../css/mainAdminLogin.css">
<!--===============================================================================================-->
<style>
.back{
	margin-left:400px;
		margin-top:-230px;
}
</style>
</head>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(../images/bg-01.jpg);">
					<span class="login100-form-title-1">
						Admin  Profile  update
					</span>
				</div>

				<form class="login100-form validate-form" method="POST" action="editProfileDB.php">
					<?php
				 				if(isset($_SESSION['profilePassword']) && $_SESSION['profilePassword'] !="")
								{
								echo '<span style="color:#F13535;font-family:couriar;">'.$_SESSION['profilePassword'].'</span>';
					 			unset($_SESSION['profilePassword']);
				 				}
					?>
					<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">Username</span>
						<input class="input100" type="text" name="username" placeholder="Enter username" autocomplete="off" value="<?php echo $rowa['a_username'];?>" onfocus="this.select();" autofocus required/>
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Old Password</span>
						<input class="input100" type="password" name="password" placeholder="Enter password" autocomplete="off" value="<?php echo $rowa['a_password'];?>" required>
						<span class="focus-input100"></span>
					</div>


          <div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
            <span class="label-input100">New Password</span>
            <input class="input100" type="password" name="npassword" id="npassword" placeholder="Enter New password" autocomplete="off" required>
            <span class="focus-input100"></span>
          </div>
<span id="password_strength"></span>
          <div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
            <span class="label-input100">Confirm Password</span>
            <input class="input100" type="password" name="cpassword" id="cpassword" placeholder="Enter Confirm password" autocomplete="off" required>
            <span class="focus-input100"></span>

          </div>
            <span id='message' style="margin-left:250px;"></span>

          <div class="flex-sb-m w-full p-b-30">
            <div class="contact100-form-checkbox">
              <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
              <label class="label-checkbox100" for="ckb1" onclick="myFunctionPassword();">
            Show Password
              </label>
            </div>
          </div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit" name="rgn">
							Submit
						</button>
					</div>

				</form>
				<div class="container-login100-form-btn">
					<button class="back">
						<a  href="../profile/" class="login100-form-btn">Back</a>
					</button>
				</div>
			</div>
		</div>
	</div>

<!--===============================================================================================-->
	<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/bootstrap/js/popper.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/daterangepicker/moment.min.js"></script>
	<script src="../vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="../js/mainAdminLogin.js"></script>

</body>
</html>


<script>
function myFunctionPassword() {
var x = document.getElementById("npassword");
  var y = document.getElementById("cpassword");
if (x.type === "password") {
  x.type = "text";
  y.type = "text";
} else {
  x.type = "password";
  y.type = "password";
}
}
</script>

<script>
$('#npassword, #cpassword').on('keyup', function () {
  if ($('#npassword').val() == $('#cpassword').val()) {
    $('#message').html('Matching').css('color', 'green');
  } else
    $('#message').html('Not Matching').css('color', 'red');
});
</script>

<script type="text/javascript">
    $(function () {
        $("#npassword").bind("keyup", function () {
            //TextBox left blank.
            if ($(this).val().length == 0) {
                $("#password_strength").html("");
                return;
            }

            //Regular Expressions.
            var regex = new Array();
            regex.push("[A-Z]"); //Uppercase Alphabet.
            regex.push("[a-z]"); //Lowercase Alphabet.
            regex.push("[0-9]"); //Digit.
            regex.push("[$@$!%*#?&]"); //Special Character.

            var passed = 0;

            //Validate for each Regular Expression.
            for (var i = 0; i < regex.length; i++) {
                if (new RegExp(regex[i]).test($(this).val())) {
                    passed++;
                }
            }


            //Validate for length of Password.
            if (passed > 2 && $(this).val().length > 8) {
                passed++;
            }

            //Display status.
            var color = "";
            var strength = "";
            switch (passed) {
                case 0:
                case 1:
                    strength = "Weak";
                    color = "red";
                    break;
                case 2:
                    strength = "Good";
                    color = "darkorange";
                    break;
                case 3:
                case 4:
                    strength = "Strong";
                    color = "green";
                    break;
                case 5:
                    strength = "Very Strong";
                    color = "darkgreen";
                    break;
            }
            $("#password_strength").html(strength);
            $("#password_strength").css("color", color);
        });
    });
</script>


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
