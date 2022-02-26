<?php
include('includes/config.php');
error_reporting(0);
if(isset($_POST['search'])){

    date_default_timezone_set('Asia/Kolkata');

// $dep_date = $_POST['dep_date'];
// $days = $_POST['days'];
// switch($days){
//   case 1: $dep_date =date('Y-m-d', strtotime(' +1 day'));
//   break;
//   case 2: $dep_date =date('Y-m-d', strtotime(' +2 day'));
//   break;
//   case 2: $dep_date =date('Y-m-d', strtotime(' +3 day'));
//   break;
//   default:
//   echo "no date put";
//   break;
// }
// $startTime = $_POST['st_time'];
// $endTime = $_POST['end_time'];
// $totalTime = $_POST['total_time'];


$hall_or_cityname1 = $_POST['sch'];
$hall_or_cityname = trim($hall_or_cityname1);

 $get_check_in_date=$_POST['arr_date'];
 $time_check_in = strtotime($get_check_in_date);
 $arr_date = date('Y-m-d',$time_check_in);

 $get_check_out_date=$_POST['dep_date'];
 $time_check_out = strtotime($get_check_out_date);
 $dep_date = date('Y-m-d',$time_check_out);

 $datediff = ($time_check_in - $time_check_out);
 $totalDay = abs(round($datediff / (60 * 60 * 24)));
 

 $currDate = date('Y-m-d');

 if(($arr_date<=$currDate && $dep_date<$currDate) || ($arr_date>=$currDate && $dep_date<$currDate) || ($arr_date<=$currDate && $dep_date>$currDate) || $arr_date>$dep_date){
   // $check_out>$booked_date && $check_in>=$booked_date
   echo '<script type="text/javascript">';
   echo 'alert("Please Check Arrival & Departure Date, Arrival & Departure Date Must Be On Next Day!<?php echo $arr_date $dep_date;?>");';
   echo 'window.location.href = "../EventManagement/";';
   echo '</script>';
  }

 // Storing Selected Value In Variable
  if(empty($hall_or_cityname))
  {
    echo '<script type="text/javascript">';
    echo 'alert("You did not write any city or hall name!");';
    echo 'window.location.href = "../EventManagement/";';
    echo '</script>';

  }
?>


<!DOCTYPE HTML>
<html>

<head>
	<title>Events Club a Entertainment Category Website Template | Events :: w3layouts</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>

		<link href="css/userDropdown.css" rel="stylesheet" type="text/css" media="all" />
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		<!--    include another html page     --->
		<script type="text/javascript">
			jQuery(function(){
				$("#includedFooter").load("includes/footer/footer_others_page.php");
			});
			</script>
				<!--    include another html page     --->
</head>

<body>

	<div class="header">
		<div class="header_top">
			<div class="wrap">
				<div class="logo">
					<a href="../EventsManagement/">
						<img src="images/logo.png" alt="" />
					</a>
				</div>

				<?php
				    if(!isset($_SESSION['name']) && $_SESSION['name'] ==""){
				?>

				<div class="menu">
					<ul>
						<li>
							<a href="../EventManagement/">HOME</a>
						</li>
						<li>
							<a href="about/">ABOUT</a>
						</li>
						<li>
							<a href="events/">EVENTS HALL</a>
						</li>
						<li>
							<a href="gallery/">GALLERY</a>
						</li>
						<li>
							<a href="blog/">BLOG</a>
						</li>
						<li>
							<a href="contact/">CONTACT</a>
						</li>
						<li>
							<a href="admin/adminLogin/">ADMIN</a>
						</li>
						<li>
							<a href="userLogin/" title="login"><i class="fa fa-sign-in" aria-hidden="true"></i></a>
						</li>
						<li>
							<a href="userRegistration/" title="Register"><i class="fa fa-registered" aria-hidden="true"></i></a>
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
							<a href="../EventManagement/">HOME</a>
						</li>
						<li>
							<a href="about/">ABOUT</a>
						</li>
						<li>
							<a href="events/">EVENTS HALL</a>
						</li>
						<li>
							<a href="gallery/">GALLERY</a>
						</li>
						<li>
							<a href="blog/">BLOG</a>
						</li>
						<li>
							<a href="contact/">CONTACT</a>
						</li>
						<li>
							<a href="admin/adminLogin/">ADMIN</a>
						</li>
						<li class="nav-item dropdown">
									<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><?php echo "Hi,"." ". strtok($_SESSION['name'], " "); ?> </a>
									<div class="dropdown-menu">
											<a href="#" class="user userFont"><i class="fa fa-briefcase"></i> My Booking</a>
											<a href="#" class="user userFont"><i class="fa fa-user"></i> Profile</a>
											<a href="userLogin/logout.php" class="user userFont"><i class="fa fa-sign-out"></i> Logout</a>
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

					<h2>Events Hall</h2>

					<div class="section group">

           <?php

           $qhs = "SELECT * FROM hall WHERE hall_name='$hall_or_cityname' AND isActive=1 ";
           $datahs= mysqli_query($conn,$qhs);
           $totalhs= mysqli_num_rows($datahs);

           $qcs = "SELECT * FROM city WHERE city_name LIKE '%$hall_or_cityname%' AND isActive=1 ";
           $datacs= mysqli_query($conn,$qcs);
           $rowcss = mysqli_fetch_assoc($datacs);
           $totalcs= mysqli_num_rows($datacs);


           if($totalhs > 0)
           {
               $hall_name = $hall_or_cityname;
               $query = "SELECT * FROM hall WHERE hall_name LIKE '%$hall_name%' AND isActive=1 ";
               $data= mysqli_query($conn,$query);
               $total= mysqli_num_rows($data);

              while ($rhs= mysqli_fetch_assoc($datahs))
             {
               $hall_name = $rhs['hall_name'];
               $city_id=$rhs['city_id'];
               $category_id=$rhs['category_id'];
               $hall_price= $rhs['hall_price'];
               $hall_place= $rhs['hall_place'];
               $imgpath='admin/images/hall/'.$rhs['hall_image'];


               $date = date('Y-m-d');
               $next_date = date('Y-m-d', strtotime($date .' +2 day'));
					 ?>

						<div class="grid_1_of_3 events_1_of_3">
							<div class="event-time">
								<h4>
									<span>Hall Name: <?php echo $rhs['hall_name']; ?></span><br>

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
								<h4>place : <?php echo $rhs['hall_place']; ?></h4>
								<h4>city  : <?php echo $rowcn['city_name']; ?></h4>
								<h4>price : <?php echo $rhs['hall_price']; ?><small> / day</small></h4>
							</div>

							<div class="event-img">
								<!-- <a href="../bookingDetails.php?id=<?php //echo $row['hall_id'];?>"> -->
								<a href="bookingDetails.php?id=<?php echo $rhs['hall_id'];?>&arr_date=<?php echo $arr_date; ?>&dep_date=<?php echo $dep_date; ?>&totalDay=<?php echo $totalDay;?>&form_submit=1">
							   	<img src="<?php echo $imgpath;?>" alt="feature_1" width="80px" height="200px" />
									<span>VIEW</span>
								</a>
							</div>
						</div>
<?php }
}
elseif($totalcs > 0) {

      $city_name11 = $hall_or_cityname;
      $query1 = "SELECT * FROM city WHERE (city_name LIKE '%_".$city_name11."_%' OR city_name LIKE '%$city_name11%') AND isActive=1";
      $data5= mysqli_query($conn,$query1);
      $totallll = mysqli_num_rows($data5);
      $rowrd = mysqli_fetch_assoc($data5);
      $city_id1 = $rowrd['city_id'];

      $sqllll = "SELECT * FROM hall WHERE city_id = '$city_id1' AND isActive=1";
      $dataaa = mysqli_query($conn,$sqllll);


      while($rowww = mysqli_fetch_assoc($dataaa))
     {



       $hall_name = $rowww['hall_name'];
       $category_id=$rowww['category_id'];
       $hall_price= $rowww['hall_price'];
       $hall_place= $rowww['hall_place'];
       $imgpath='admin/images/hall/'.$rowww['hall_image'];


   ?>

    <div class="grid_1_of_3 events_1_of_3">
      <div class="event-time">
        <h4>
          <span>Hall Name: <?php echo $rowww['hall_name']; ?></span><br>

          <?php
                $sqlcat1 = "SELECT * FROM category WHERE category_id='$category_id'";
                $datacat1= mysqli_query($conn,$sqlcat1);
                $rowcat1=mysqli_fetch_assoc($datacat1);
           ?>
          <span>Hall Type : <?php echo $rowcat1['category_name']; ?></span><br>
        </h4>

        <h4>place : <?php echo $rowww['hall_place']; ?></h4>
        <h4>city  : <?php echo $rowrd['city_name']; ?></h4>
        <h4>price : <?php echo $rowww['hall_price']; ?><small> / day</small></h4>
      </div>

      <div class="event-img">
        <!-- <a href="../bookingDetails.php?id=<?php //echo $row['hall_id'];?>"> -->
        <a href="bookingDetails.php?id=<?php echo $rowww['hall_id'];?>&arr_date=<?php echo $arr_date; ?>&dep_date=<?php echo $dep_date; ?>&totalDay=<?php echo $totalDay;?>&form_submit=1">
          <img src="<?php echo $imgpath;?>" alt="feature_1" width="80px" height="200px" />
          <span>VIEW</span>
        </a>
      </div>
    </div>
  <?php
}
  }else {
    echo "<p style='color:red;text-align:center; font-size:30px;'>no record found</p>";
  }
    ?>

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
<?php
}else{
      if(isset($_SESSION['blank']) != ""){
      header("location:404_error.php");
      exit;

          }else{
               header("location:404_error.php");
               exit;

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
       window.location.href = "userLogin/sessionExpire.php";
        // window.location.reload();
    }
}
</script>
