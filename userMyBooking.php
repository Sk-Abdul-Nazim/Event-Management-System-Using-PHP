<?php
include('includes/config.php');
error_reporting(0);

      date_default_timezone_set('Asia/Kolkata');
    $u_id=$_SESSION['id'];

  $query = "SELECT * FROM reservationhall WHERE isActive=1 and u_id='$u_id'";
  $data= mysqli_query($conn,$query);
  $total=mysqli_num_rows($data);

 ?>


 <!DOCTYPE html>
 <html>

 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>My Booking</title>
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
	 	<!-- <div id="printableArea"> <!-- Start printableArea -->
    <?php
      if($total > 0){
          while($row= mysqli_fetch_assoc($data)){


     $check_out= $row['departure_date'];
      $dateTimestamp2 = strtotime($check_out);
      $departure_date = date('Y-m-d',$dateTimestamp2);

      $get_date=date("d-m-Y");
      $time = strtotime($get_date);
      $current_date = date('Y-m-d',$time);

           if($departure_date>$current_date){



        $sqlu="SELECT * FROM user_registration WHERE u_id='".$row['u_id']."'";
        $datau= mysqli_query($conn,$sqlu);
        $rowu= mysqli_fetch_assoc($datau);

        $sqlh="SELECT * FROM hall WHERE hall_id='".$row['hall_id']."'";
        $datah= mysqli_query($conn,$sqlh);
        $rowh= mysqli_fetch_assoc($datah);

        $sqlc="SELECT * FROM city WHERE city_id='".$rowh['city_id']."'";
        $datac= mysqli_query($conn,$sqlc);
        $rowc= mysqli_fetch_assoc($datac);

        $sqlcat="SELECT * FROM category WHERE category_id='".$rowh['category_id']."'";
        $datacat= mysqli_query($conn,$sqlcat);
        $rowcat= mysqli_fetch_assoc($datacat);

        $sqlp="SELECT * FROM paymentmethod WHERE payment_id='".$row['payment_id']."'";
        $datap= mysqli_query($conn,$sqlp);
        $rowp= mysqli_fetch_assoc($datap);


        $imgpath='admin/images/hall/'.$rowh['hall_image'];

     ?>
        <div id="<?php echo $row['reserv_id'] ?>">
     <div align="center">
         <table width="600" border="1" bordercolor="99CCFF">
             <tbody>
                 <tr>
                     <td colspan="5" bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="center">
                             <p class="style3"><?php echo $rowh['hall_name'];?> </p>
                         </div>
                     </td>
                 </tr>
                 <tr>
                     <td colspan="5" bordercolor="99CCFF" bgcolor="99CCFF"><img src="<?php echo $imgpath;?>" alt="Hall" width="700" height="250">
                     </td>

                   </tr>
                 <tr>
                     <td colspan="5" bordercolor="99CCFF" bgcolor="99CCFF">
                         <!-- <div align="left">
                              Thank you for choosing The Hall. We are delighted to confirm the following reservation. Should you require further assistance, please contact our Reservations department via return e-mail or by calling the number listed
                             below.<br>
                         </div> -->
                     </td>
                 </tr>
                 <tr>
                     <td colspan="5" bordercolor="99CCFF" bgcolor="#FFC977">
                         <div align="left"><strong>Hall Details:</strong></div>
                     </td>

                 </tr>

                                      <td bordercolor="99CCFF" bgcolor="99CCFF">
                                          <div align="left"><span class="style4">Order ID</span></div>
                                      </td>
                                      <td colspan="4" bordercolor="99CCFF" bgcolor="99CCFF"><?php echo $row['order_no']; ?>&nbsp;</td>
                                  </tr>
                                  <tr>
                                      <td width="121" bordercolor="99CCFF" bgcolor="99CCFF">
                                          <div align="left"><span class="style4">Your's Name</span></div>
                                      </td>
                                      <td width="473" colspan="4" bordercolor="99CCFF" bgcolor="99CCFF"><?php echo $rowu['u_name']; ?>&nbsp;</td>
                                  </tr>
                                  <tr>
                                      <td width="121" bordercolor="99CCFF" bgcolor="99CCFF">
                                          <div align="left"><span class="style4">Your's Adhar no.</span></div>
                                      </td>
                                      <td width="473" colspan="4" bordercolor="99CCFF" bgcolor="99CCFF"><?php echo $rowu['u_adhar']; ?>&nbsp;</td>
                                  </tr>
                 <tr>
                     <td bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="left"><span class="style4">Hall Name</span></div>
                     </td>
                     <td colspan="4" bordercolor="99CCFF" bgcolor="99CCFF"><?php echo $rowh['hall_name'] ;?>&nbsp;</td>
                 </tr>

                 <tr>
                     <td bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="left"><span class="style4">Hall Type</span></div>
                     </td>
                     <td colspan="4" bordercolor="99CCFF" bgcolor="99CCFF"><?php echo $rowcat['category_name'] ;?>&nbsp;</td>
                 </tr>

                 <tr>
                     <td bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="left"><span class="style4">Place</span></div>
                     </td>
                     <td colspan="4" bordercolor="99CCFF" bgcolor="99CCFF"><?php echo $rowh['hall_place'] ;?>&nbsp;</td>
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
                     <td colspan="4" bordercolor="99CCFF" bgcolor="99CCFF"><?php echo $row['arrival_date']; ?>&nbsp;</td>
                 </tr>
                 <tr>
                     <td bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="left"><span class="style4">Your Hall Departure Date</span></div>
                     </td>
                     <td colspan="4" bordercolor="99CCFF" bgcolor="99CCFF"><?php echo $row['departure_date'];; ?>&nbsp;</td>
                 </tr>

                 <tr>
                     <td bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="left"><span class="style4">Payment Method</span></div>
                     </td>
                     <td colspan="4" bordercolor="99CCFF" bgcolor="99CCFF"><?php echo $rowp['payment_name'];?>&nbsp;</td>
                 </tr>
                 <tr>
                     <td bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="left"><span class="style4">No Of Seat</span></div>
                     </td>
                     <td colspan="4" bordercolor="99CCFF" bgcolor="99CCFF"><?php echo $rowh['hall_seat']; ?>&nbsp;</td>
                 </tr>
                 <tr>
                     <td bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="left"><span class="style4">Hall Price</span></div>
                     </td>
                     <td colspan="4" bordercolor="99CCFF" bgcolor="99CCFF"><?php echo $row['price']; ?>&nbsp;</td>
                 </tr>

                 <tr>
                     <td colspan="5" bordercolor="99CCFF" bgcolor="#FFC977">
                         <div align="left"><strong>Hall Policy:</strong></div>
                     </td>
                 </tr>
                 <tr>
                     <td bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="left" class="style4">Hall Check-in time</div>
                     </td>
                     <td colspan="4" bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="left"><span class="style5">10:00 am, Must be Carry on User's Adhar Card for verification. </span></div>
                     </td>
                 </tr>

                 <tr>
                     <td bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="left"><span class="style4">Cancellation Policy</span></div>
                     </td>
                     <td colspan="4" bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="left"><span class="style5">1.If Adhar Card not brought then the hall will be CANCELLED.
                           <br> 2. More then 24 hours before check-in date: FREE CANCELLATION.
                           <br> 3. If you not come in Check-in time then After 12.00 pm  the hall will be Cancelled.
                         </span></div>
                     </td>
                 </tr>
             </tbody>
         </table>
     </div>
	 </div><!-- printable area close-->
<div style="text-align:center">
  <a href="../EventManagement/"class="ghf">BACK</a>
  <a href="javascript:void(0)" onclick="printDiv('<?php echo $row['reserv_id'] ?>')" class="ghf">Print<a>
     <a href="javascript:void(0)"class="ghf" onclick="chk('<?php echo $row['reserv_id'] ?>')">Cancel Hall</a>
<!-- <a href="javascript:void(0)" onclick="printDiv('printableArea')" class="ghf">Print<a> -->
</div>
<p style="color:red;">-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</p>
<?php } //end date check if
}
}else{
  echo "<p style='color:red;text-align:center; font-size:30px;'>You Have No Hall Booked This Time, Please First Booked Hall Then It Will Show Here, Thank You...</p>";
       ?>
         <a href="../EventManagement/" class="ghf">Back</a>
       <?php
}?>
</body>
</html>
<script>
function chk(val){
  var result = confirm("Are you want to Cancel This Hall ?");
  if(result){
     location.href="cancelHall.php?id="+val;
  }
}
</script>
 <script>
 function printDiv(divName) {
      var printContents = document.getElementById(divName).innerHTML;
      var originalContents = document.body.innerHTML;

      document.body.innerHTML = printContents;

      window.print();

      document.body.innerHTML = originalContents;
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
        window.location.href = "userLogin/sessionExpire.php";
         // window.location.reload();
     }
 }
 </script>
