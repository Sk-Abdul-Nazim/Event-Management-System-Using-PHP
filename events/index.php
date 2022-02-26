<?php
include('../includes/config.php');
error_reporting(0);
?>


<!DOCTYPE HTML>
<html>

<head>
	<title>Event Management</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="../css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script type="text/javascript" src="../js/jquery-1.9.0.min.js"></script>

		<link href="../css/userDropdown.css" rel="stylesheet" type="text/css" media="all" />
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		<!--    include another html page     --->
		<script type="text/javascript">
			jQuery(function(){
				$("#includedFooter").load("../includes/footer/footer_others_page.php");
			});
			</script>
				<!--    include another html page     --->
</head>

<body>

	<div class="header">
		<div class="header_top">
			<div class="wrap">
				<div class="logo">
					<a href="../">
						<img src="../images/logo.png" alt="" />
					</a>
				</div>

				<?php
				    if(!isset($_SESSION['name']) && $_SESSION['name'] ==""){
				?>

				<div class="menu">
					<ul>
						<li>
							<a href="../">HOME</a>
						</li>
						<li>
							<a href="../about/">ABOUT</a>
						</li>
						<li class="active">
							<a href="../events/">EVENTS HALL</a>
						</li>
						<li>
							<a href="../gallery/">GALLERY</a>
						</li>
						<li>
							<a href="../blog/">BLOG</a>
						</li>
						<li>
							<a href="../contact/">CONTACT</a>
						</li>
						<li>
							<a href="../admin/adminLogin/">ADMIN</a>
						</li>
						<li>
							<a href="../userLogin/" title="login"><i class="fa fa-sign-in" aria-hidden="true"></i></a>
						</li>
						<li>
							<a href="../userRegistration/" title="Register"><i class="fa fa-registered" aria-hidden="true"></i></a>
						</li>
						<li>
							<a href="javascript:;" title="User"><i class="fa fa-user" aria-hidden="true"></i></a>
						</li>

						<div class="clear"></div>
					</ul>
				</div>

			<?php }else{ ?>

				<div class="menu">
					<ul>
						<li>
							<a href="../">HOME</a>
						</li>
						<li>
							<a href="../about/">ABOUT</a>
						</li>
						<li class="active">
							<a href="../events/">EVENTS HALL</a>
						</li>
						<li>
							<a href="../gallery/">GALLERY</a>
						</li>
						<li>
							<a href="../blog/">BLOG</a>
						</li>
						<li>
							<a href="../contact/">CONTACT</a>
						</li>
						<li>
							<a href="../admin/adminLogin/">ADMIN</a>
						</li>
						<li class="nav-item dropdown">
									<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><?php echo "Hi,"." ". strtok($_SESSION['name'], " "); ?> </a>
									<div class="dropdown-menu">
											<a href="../userMyBooking.php" class="user userFont"><i class="fa fa-briefcase"></i> My Booking</a>
											<a href="../userProfile.php" class="user userFont"><i class="fa fa-user"></i> Profile</a>
											<a href="../userLogin/logout.php" class="user userFont"><i class="fa fa-sign-out"></i> Logout</a>
											<div class="dropdown-divider"></div>
											<a href="#"class="userFontBooking userFont"> Booking History</a>
									</div>
							</li>

						<div class="clear"></div>
					</ul>
				</div>
			<?php } ?>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	<div class="main">
		<div class="wrap">
			<div class="content_top">
				<div class="events">

					<h2>Next Day Available Events Hall
					<!-- <select name="cityID" style="width:10%; height: 30px;">

					<option>select</option>
						<?php
							// $sqlcSelect="SELECT * FROM city WHERE isActive=1";
							// $datacSelect= mysqli_query($conn,$sqlcSelect);
							//
							// while ($rowcSelect= mysqli_fetch_assoc($datacSelect))
							// {
						?>
							<option value="<?php //echo $rowcSelect['city_id'] ?>"><?php //echo $rowcSelect['city_name'] ?></option>

						<?php// }?>
					</select> -->

       </h2>


					<div class="section group">

           <?php
                $query = "SELECT * FROM hall WHERE isActive = 1 AND hall_availibility='YES' LIMIT 6";
								$data= mysqli_query($conn,$query);
                    while($row= mysqli_fetch_assoc($data))
                    {
                      $imgpath='../admin/images/hall/'.$row['hall_image'];
                      $category_id=$row['category_id'];
                      $city_id=$row['city_id'];

                      $date = date('Y-m-d');
                      $next_date = date('Y-m-d', strtotime($date .' +2 day'));
					 ?>

						<div class="grid_1_of_3 events_1_of_3">
							<div class="event-time">
								<h4>
									<span>Hall Name: <?php echo $row['hall_name']; ?></span><br>

									<?php
												$sqlcat = "SELECT * FROM category WHERE category_id='$category_id'";
												$datacat= mysqli_query($conn,$sqlcat);
												$rowcat=mysqli_fetch_assoc($datacat);
									 ?>
									<span>Hall Type : <?php echo $rowcat['category_name']; ?></span><br>
								</h4>
								<?php
								      $sqlcn = "SELECT * FROM city WHERE city_id='$city_id'";
											$datacn= mysqli_query($conn,$sqlcn);
											$rowcn=mysqli_fetch_assoc($datacn);
								 ?>
								<h4>place : <?php echo $row['hall_place']; ?></h4>
								<h4>city  : <?php echo $rowcn['city_name']; ?></h4>
								<h4>price : <?php echo $row['hall_price']; ?><small> / day</small></h4>
							</div>

							<div class="event-img">
								<!-- <a href="../bookingDetails.php?id=<?php //echo $row['hall_id'];?>"> -->
								<a href="../userBookDate.php?id=<?php echo $row['hall_id'];?>">
							   	<img src="<?php echo $imgpath;?>" alt="feature_1" width="80px" height="200px" />
									<span>VIEW</span>
								</a>
							</div>
						</div>
<?php } ?>

					</div>

				</div>
			</div>
		</div>
	</div>

	<div class="footer">
		<!-- include footer -->
		<div id="includedFooter"></div>
		<!-- include footer -->
	</div>

</body>
</html>

<script type="text/javascript">
    function getValueOfCitySelect(val) {

	       $.ajax({
	           type: "POST",
	     		  url: "getValueOfCitySelect.php",
	           data:'city_id='+val,
	     			success: function (data) {

	     							$("#cat_list").html(data);
	     			      },
	     			      error: function () {
	     			        Walert("Something is Wrong, Please Try Again...");
	     			      }

	     			    });  // end Ajax

	         }
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
       window.location.href = "../userLogin/sessionExpire.php";
        // window.location.reload();
    }
}
</script>
