<?php
include('includes/config.php');
error_reporting(0);

if(!isset($_SESSION["userLoggedin"])){
$_SESSION['loggedin_search'] = "You Have To Login Before Hall Book!";
   header("location:userLogin/");
   exit;
}
if(isset($_POST['payment'])){
  $id = $_POST['hall_id'];
  $arr_date = $_POST['arr_date'];
    $dep_date = $_POST['dep_date'];
    $hallPrice = $_POST['hallPrice'];

		$qp ="SELECT * FROM paymentmethod WHERE payment_name = 'PhonePe'";
		$dp = mysqli_query($conn,$qp);
		$rp = mysqli_fetch_assoc($dp);

		$qg ="SELECT * FROM paymentmethod WHERE payment_name = 'GooglePay'";
		$dg = mysqli_query($conn,$qg);
		$rg = mysqli_fetch_assoc($dg);

		$qc ="SELECT * FROM paymentmethod WHERE payment_name = 'COD'";
		$dc = mysqli_query($conn,$qc);
		$rc = mysqli_fetch_assoc($dc);

		$qd ="SELECT * FROM paymentmethod WHERE payment_name = 'Debit Card'";
		$dd = mysqli_query($conn,$qd);
		$rd = mysqli_fetch_assoc($dd);
  }
?>
<!DOCTYPE html>
<html>
<head>
<title>Payment Method</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="css/stylePayment.css" rel="stylesheet" type="text/css" media="all" />
<link href='//fonts.googleapis.com/css?family=Fugaz+One' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Alegreya+Sans:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,800,800italic,900,900italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="js/jqueryPayment.min.js"></script>


<script type="text/javascript">
var data = JSON.stringify(false);

var xhr = new XMLHttpRequest();
xhr.withCredentials = true;

xhr.addEventListener("readystatechange", function () {
  if (this.readyState === this.DONE) {
    console.log(this.responseText);
  }
});

xhr.open("POST", "https://mercury-uat.phonepe.com/v3/debit");
xhr.setRequestHeader("content-type", "application/json");
xhr.setRequestHeader("x-verify", "X-VERIFY");

xhr.send(data);
</script>
</head>
<body style="background-image: url('images/bg.jpg');">
	<div class="main">
		<h1>Payment Method</h1>
		<div class="content">

			<script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
					<script type="text/javascript">
						$(document).ready(function () {
							$('#horizontalTab').easyResponsiveTabs({
								type: 'default', //Types: default, vertical, accordion
								width: 'auto', //auto or any width like 600px
								fit: true   // 100% fit in a container
							});
						});

					</script>
						<div class="sap_tabs">
							<div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
								<div class="pay-tabs">
									<h2>Select Payment Method</h2>
									  <ul class="resp-tabs-list">
										  <li class="resp-tab-item" aria-controls="tab_item-0" role="tab" id="<?php echo $rp['payment_id'];?>" ><span><label class="pic1"></label>PhonePe</span></li>
										  <li class="resp-tab-item" aria-controls="tab_item-1" role="tab" id="<?php echo $rg['payment_id'];?>"><span><label class="pic3"></label>GooglePay</span></li>
										  <li class="resp-tab-item" aria-controls="tab_item-2" role="tab" id="<?php echo $rc['payment_id'];?>"><span><label class="pic4"></label>COD</span></li>
										  <li class="resp-tab-item" aria-controls="tab_item-3" role="tab" id="<?php echo $rp['payment_id'];?>"><span><label class="pic2"></label>Debit Card</span></li>
										  <div class="clear"></div>
									  </ul>
								</div>
								<div class="resp-tabs-container">
									<div class="tab-1 resp-tab-content" aria-labelledby="tab_item-0">
										<div class="payment-info">
											<h3>Personal Information</h3>
											<form>
												<div class="tab-for">
													<h5>EMAIL ADDRESS</h5>
														<input type="text" value="">
													<h5>FIRST NAME</h5>
														<input type="text" value="">
												</div>
											</form>
											<h3 class="pay-title">Credit Card Info</h3>
											<form>
												<div class="tab-for">
													<h5>NAME ON CARD</h5>
														<input type="text" value="">
													<h5>CARD NUMBER</h5>
														<input class="pay-logo" type="text" value="0000-0000-0000-0000" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '0000-0000-0000-0000';}" required="">
												</div>
												<div class="transaction">
													<div class="tab-form-left user-form">
														<h5>EXPIRATION</h5>
															<ul>
																<li>
																	<input type="number" class="text_box" type="text" value="6" min="1" />
																</li>
																<li>
																	<input type="number" class="text_box" type="text" value="1988" min="1" />
																</li>

															</ul>
													</div>
													<div class="tab-form-right user-form-rt">
														<h5>CVV NUMBER</h5>
														<input type="text" value="xxxx" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'xxxx';}" required="">
													</div>
													<div class="clear"></div>
												</div>
												<input type="submit" value="SUBMIT">
											</form>
											<div class="single-bottom">
													<ul>
														<li>
															<input type="checkbox"  id="brand" value="">
															<label for="brand"><span></span>By checking this box, I agree to the Terms & Conditions & Privacy Policy.</label>
														</li>
													</ul>
											</div>
										</div>
									</div>
									<div class="tab-1 resp-tab-content" aria-labelledby="tab_item-1">
										<div class="payment-info">
											<h3>Net Banking</h3>
											<div class="radio-btns">
												<div class="swit">
													<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio" checked=""><i></i>Andhra Bank</label> </div></div>
													<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio"><i></i>Allahabad Bank</label> </div></div>
													<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio"><i></i>Bank of Baroda</label> </div></div>
													<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio"><i></i>Canara Bank</label> </div></div>
													<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio"><i></i>IDBI Bank</label> </div></div>
													<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio"><i></i>Icici Bank</label> </div></div>
													<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio"><i></i>Indian Overseas Bank</label> </div></div>
													<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio"><i></i>Punjab National Bank</label> </div></div>
													<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio"><i></i>South Indian Bank</label> </div></div>
													<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio"><i></i>State Bank Of India</label> </div></div>
												</div>
												<div class="swit">
													<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio" checked=""><i></i>City Union Bank</label> </div></div>
													<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio"><i></i>HDFC Bank</label> </div></div>
													<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio"><i></i>IndusInd Bank</label> </div></div>
													<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio"><i></i>Syndicate Bank</label> </div></div>
													<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio"><i></i>Deutsche Bank</label> </div></div>
													<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio"><i></i>Corporation Bank</label> </div></div>
													<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio"><i></i>UCO Bank</label> </div></div>
													<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio"><i></i>Indian Bank</label> </div></div>
													<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio"><i></i>Federal Bank</label> </div></div>
													<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio"><i></i>ING Vysya Bank</label> </div></div>
												</div>
												<div class="clear"></div>
											</div>
											<a href="#">Continue</a>
										</div>
									</div>
									<div class="tab-1 resp-tab-content" aria-labelledby="tab_item-2">
										<div class="payment-info">
											<h3>COD</h3>
											<!-- <h4>Already Have A PayPal Account?</h4> -->
											<div class="login-tab">
												<div class="user-login">
													<h2>Nedded to Ruppes in Check-in Time</h2>

													<form action="hallBooked.php" method="post">
													<input type="hidden" name="hall_id" value="<?php echo $id;?>">
													<input type="hidden" name="arr_date" value="<?php echo $arr_date;?>">
													<input type="hidden" name="dep_date" value="<?php echo $dep_date;?>">
                          <input type="hidden" name="hallPrice" value="<?php echo $hallPrice;?>">
														<input type="hidden" name="payment" value="<?php echo $rc['payment_id'];?>">

															<div class="user-grids">

																<div class="user-right">
																	<input type="submit" name="hallBooked"value="continue">
																</div>
																<div class="clear"></div>
															</div>
													</form>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-1 resp-tab-content" aria-labelledby="tab_item-3">
										<div class="payment-info">

											<h3 class="pay-title">Dedit Card Info</h3>
											<form>
												<div class="tab-for">
													<h5>NAME ON CARD</h5>
														<input type="text" value="">
													<h5>CARD NUMBER</h5>
														<input class="pay-logo" type="text" value="0000-0000-0000-0000" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '0000-0000-0000-0000';}" required="">
												</div>
												<div class="transaction">
													<div class="tab-form-left user-form">
														<h5>EXPIRATION</h5>
															<ul>
																<li>
																	<input type="number" class="text_box" type="text" value="6" min="1" />
																</li>
																<li>
																	<input type="number" class="text_box" type="text" value="1988" min="1" />
																</li>

															</ul>
													</div>
													<div class="tab-form-right user-form-rt">
														<h5>CVV NUMBER</h5>
														<input type="text" value="xxxx" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'xxxx';}" required="">
													</div>
													<div class="clear"></div>
												</div>
												<input type="submit" value="SUBMIT">
											</form>
											<div class="single-bottom">
													<ul>
														<li>
															<input type="checkbox"  id="brand" value="">
															<label for="brand"><span></span>By checking this box, I agree to the Terms & Conditions & Privacy Policy.</label>
														</li>
													</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

		</div>
		<p class="footer">Copyright © 2016 Payment Form Widget. All Rights Reserved | Template by <a href="https://w3layouts.com/" target="_blank">w3layouts</a></p>
	</div>
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
       window.location.href = "userLogin/sessionExpire.php";
        // window.location.reload();
    }
}
</script>
