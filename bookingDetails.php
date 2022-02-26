<?php
include('includes/config.php');
error_reporting(0);
 if(isset($_REQUEST['form_submit'])) {
      date_default_timezone_set('Asia/Kolkata');
   $hall_id=$_REQUEST['id'];
   $totalDay = $_REQUEST['totalDay'];

   $get_check_in_date=$_REQUEST['arr_date'];
   $time_check_in = strtotime($get_check_in_date);
   $arr_date = date('Y-m-d',$time_check_in);

   $get_check_out_date=$_REQUEST['dep_date'];
   $time_check_out = strtotime($get_check_out_date);
   $dep_date = date('Y-m-d',$time_check_out);

   $datediff = ($time_check_in - $time_check_out);
   $totalDay = abs(round($datediff / (60 * 60 * 24)));


   $currDate = date('Y-m-d');

   if(($arr_date<=$currDate && $dep_date<=$currDate) || ($arr_date>=$currDate && $dep_date<=$currDate) || ($arr_date<=$currDate && $dep_date>=$currDate) || $arr_date>$dep_date){
     // $check_out>$booked_date && $check_in>=$booked_date
     echo '<script type="text/javascript">';
     echo 'alert("Please Check Arrival & Departure Date, Arrival & Departure Date Must Be On Next Day!");';
     echo 'window.location.href = "userBookDate.php?id='.$hall_id.'";';
     echo '</script>';
    }


$sqlh="SELECT * FROM hall WHERE hall_id=$hall_id";
$datah= mysqli_query($conn,$sqlh);
$row= mysqli_fetch_assoc($datah);
$hallPrice = $row['hall_price'] * $totalDay;

  $payment_id = $_POST['payment'];
 $qp = "SELECT * FROM paymentmethod WHERE payment_id='$payment_id'";
 $datap= mysqli_query($conn,$qp);
 $rowp= mysqli_fetch_assoc($datap);


     $sqlc="SELECT * FROM city WHERE city_id='".$row['city_id']."'";
     $datac= mysqli_query($conn,$sqlc);
     $rowc= mysqli_fetch_assoc($datac);

     $sqlcat="SELECT * FROM category WHERE category_id='".$row['category_id']."'";
     $datacat= mysqli_query($conn,$sqlcat);
     $rowcat= mysqli_fetch_assoc($datacat);


     // $sqlr="select * from room where room_id='".$row['room_id']."'";
     // $datar= mysqli_query($conn,$sqlr);
     // $rowr= mysqli_fetch_assoc($datar);

     $imgpath='admin/images/hall/'.$row['hall_image'];
}
else{
      if(isset($_SESSION['blank']) != ""){
      header("location:404_error.php");
      exit;

          }else{
               header("location:404_error.php");
               exit;

              }
     }

 ?>


 <!DOCTYPE html>
 <html>

 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Booking Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta content="text/html; charset=iso-8859-1" http-equiv="Content-Type">
		 <style>
		         .b{
		                padding: 2cm 2cm 2cm 2cm !important;
		                background-image: url('images/bg.jpg');
	             }

             .ghf {
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
 </head>

 <body class="b">
     <div align="center">
       <form action="paymentMethod.php" method="post">
         <input type="hidden" name="hall_id" value="<?php echo $hall_id;?>">
         <input type="hidden" name="arr_date" value="<?php echo $arr_date;?>">
         <input type="hidden" name="dep_date" value="<?php echo $dep_date;?>">
         <input type="hidden" name="hallPrice" value="<?php echo $hallPrice;?>">
          <!-- <input type="hidden" name="payment" value="<?php //echo $payment_id;?>"> -->


         <table width="600" border="1" bordercolor="99CCFF">
             <tbody>
                 <tr>
                     <td colspan="5" bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="center">
                             <p class="style3" style="font-weight:bold"><?php echo $row['hall_name'];?> Details</p>
                         </div>
                     </td>
                 </tr>
                 <tr>
                     <td colspan="5" bordercolor="99CCFF" bgcolor="99CCFF"><img src="<?php echo $imgpath;?>" alt="Hall" width="700" height="250">
                     </td>

                   </tr>
                 <tr>
                     <td colspan="5" bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="left">
                              Thank you for choosing The Hall. We are delighted to confirm the following reservation. Should you require further assistance, please contact our Reservations department via return e-mail or by calling the number listed
                             below.<br>
                         </div>
                     </td>
                 </tr>
                 <tr>
                     <td colspan="5" bordercolor="99CCFF" bgcolor="#FFC977">
                         <div align="left"><strong>Hall Details:</strong></div>
                     </td>

                 </tr>

                 <tr>
                     <td bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="left"><span class="style4" style="font-weight:bold">Hall Name</span></div>
                     </td>
                     <b><td colspan="4" bordercolor="99CCFF" bgcolor="99CCFF" style="font-weight:bold"><?php echo $row['hall_name'] ;?>&nbsp;</td></b>
                 </tr>

                 <tr>
                     <td bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="left"><span class="style4" style="font-weight:bold">Hall Type</span></div>
                     </td>
                     <td colspan="4" bordercolor="99CCFF" bgcolor="99CCFF" style="font-weight:bold"><?php echo $rowcat['category_name'] ;?>&nbsp;</td>
                 </tr>

                 <tr>
                     <td bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="left"><span class="style4" style="font-weight:bold">Place</span></div>
                     </td>
                     <td colspan="4" bordercolor="99CCFF" bgcolor="99CCFF" style="font-weight:bold"><?php echo $row['hall_place'] ;?>&nbsp;</td>
                 </tr>

                 <tr>
                     <td bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="left"><span class="style4">City</span></div>
                     </td>
                     <td colspan="4" bordercolor="99CCFF" bgcolor="99CCFF"><?php echo $rowc['city_name'] ;?>&nbsp;</td>
                 </tr>

                 <tr>
                     <td bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="left"><span class="style4">Your Hall Arrival Date</span></div>
                     </td>
                     <td colspan="4" bordercolor="99CCFF" bgcolor="99CCFF"><?php echo $arr_date; ?>&nbsp;</td>
                 </tr>
                 <tr>
                     <td bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="left"><span class="style4">Your Hall Departure Date</span></div>
                     </td>
                     <td colspan="4" bordercolor="99CCFF" bgcolor="99CCFF"><?php echo $dep_date; ?>&nbsp;</td>
                 </tr>

                 <!-- <tr>
                     <td bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="left"><span class="style4">Payment Method</span></div>
                     </td>
                     <td colspan="4" bordercolor="99CCFF" bgcolor="99CCFF"><?php //echo $rowp['payment_name'];?>&nbsp;</td>
                 </tr> -->
                 <tr>
                     <td bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="left"><span class="style4" style="font-weight:bold">No Of Seat</span></div>
                     </td>
                     <td colspan="4" bordercolor="99CCFF" bgcolor="99CCFF" style="font-weight:bold"><?php echo $row['hall_seat']; ?>&nbsp;</td>
                 </tr>
                 <tr>
                     <td bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="left"><span class="style4" style="font-weight:bold">Hall Price</span></div>
                     </td>
                     <td colspan="4" bordercolor="99CCFF" bgcolor="99CCFF" style="font-weight:bold"><?php echo $row['hall_price']." * ".$totalDay." days = ".$hallPrice; ?>&nbsp;</td>
                 </tr>

                 <tr>
                     <td colspan="5" bordercolor="99CCFF" bgcolor="#FFC977">
                         <div align="left"><strong>Hall Policy:</strong></div>
                     </td>
                 </tr>
                 <tr>
                     <td bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="left" class="style4" style="font-weight:bold">Hall Check-in time</div>
                     </td>
                     <td colspan="4" bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="left"><span class="style5" style="font-weight:bold">10.00 am, Adhar Card must be required in checking time for verification. </span></div>
                     </td>
                 </tr>

                 <tr>
                     <td bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="left"><span class="style4">Cancellation Policy</span></div>
                     </td>
                     <td colspan="4" bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="left"><span class="style5">1.If Adhar Card not brought in Check-in time then the hall will be CANCELLED.
                           <br> 2. More then 24 hours before check-in date: FREE CANCELLATION.
                           <br> 3. If you not come in Check-in time then After 12.00 pm  the hall will be Cancelled.
                         </span></div>
                     </td>
                 </tr>
                 <tr>
                     <td colspan="5" bordercolor="99CCFF" bgcolor="#FFC977">
                         <div align="left"><strong>For Any Query Contact Us:</strong></div>
                     </td>
                 </tr>
                 <tr>
                     <td bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="left" class="style4">Mobile No.</div>
                     </td>
                     <td colspan="4" bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="left"><span class="style5">+919749471818</span></div>
                     </td>
                 </tr>
                 <tr>
                     <td bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="left" class="style4">Email ID</div>
                     </td>
                     <td colspan="4" bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="left"><span class="style5">sknazim4749@gmail.com</span></div>
                     </td>
                 </tr>
             </tbody>
         </table>
     </div>
<div style="text-align:center">
  <a href="../EventManagement/"class="ghf">BACK</a>
   <input type="submit" value="BOOK" name="payment" class="ghf">
<!-- <a href="javascript:void(0)" onclick="printDiv('printableArea')" class="ghf">Print<a> -->
</div>
</form>
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
