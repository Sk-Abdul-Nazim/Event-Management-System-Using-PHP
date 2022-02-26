<?php
 include('includes/config.php');
 error_reporting(0);
  if(!isset($_SESSION["adminLoggedin"])){
       header("location:adminLogin/");
       exit;
   }
   $query = "SELECT * FROM reservationhall WHERE isActive=1";
   $data= mysqli_query($conn,$query);
   $total= mysqli_num_rows($data);

  ?>

 <html>
     <title>User Details</title>
 <head>
       <meta charset="utf-8">
       <meta http-equiv="X-UA-Compatible" content="IE=edge">
       <meta name="viewport" content="width=device-width, initial-scale=1">

 	 <?php include './includes/commonStyleIncludes.php';?>
    <style>
 .dropbtn {
   background-color: grey;
   color: white;
   padding: 6px;
   font-size: 16px;
   border: none;
 }

 .dropdown {
   position: relative;
   display: inline-block;
 }

 .dropdown-content {
   display: none;
   position: absolute;
   background-color: white;
   min-width: 160px;
   box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
   z-index: 1;
 }

 .dropdown-content a {
   color: grey;
   padding: 12px 16px;
   text-decoration: none;
   display: block;
 }

 .dropdown-content a:hover {background-color: grey;color:white}

 .dropdown:hover .dropdown-content {display: block;}

 .dropdown:hover .dropbtn {background-color: grey;}
 </style>
    <style>


 .right {
   margin-left:1143px;
 }
 .dot {
   height: 12px;
   width: 12px;
   background-color: green;
   border-radius: 50%;
   display: inline-block;
 }
 .dotRed {
   height: 12px;
   width: 12px;
   background-color: red;
   border-radius: 50%;
   display: inline-block;
 }
    </style>

  <style>
     table, th, td {
        border: 1px solid black;
        margin-right:auto;
        margin-left:auto;
      }
      th, td {
            padding: 10px;
       }

  </style>

 </head>

     <body>

 	<?php include './includes/left_nav.php';?>

 	<?php include './includes/heading.php';?>


 	<div class="content-wrap">
             <div class="main">
                 <div class="container-fluid">
                     <div class="row">
                         <div class="col-lg-8 p-r-0 title-margin-right">
                             <div class="page-header">
                                 <div class="page-title">
                                     <h1>Hello, <span>Welcome Here</span></h1>
                                 </div>
                             </div>
                         </div>
                         <!-- /# column -->
                         <div class="col-lg-4 p-l-0 title-margin-left">
                             <div class="page-header">
                                 <div class="page-title">
                                     <ol class="breadcrumb">
                                         <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                         <li class="breadcrumb-item active">Reservation</li>
                                     </ol>
                                 </div>

                             </div>
                         </div>
                         <!-- <div class="dropdown right">
                            <button class="dropbtn">Sort</button>
                            <div class="dropdown-content">
                              <a href="sortingUserName.php?name=sort">By Name</a>
                              <a href="sortingUserName.php?date=sort">By Reg. Date</a>
                            </div>
                         </div> -->
                         <!-- /# column -->
                     </div>
                     <!-- /# row -->

                     <section id="main-content">
                          <h2 style="text-align:center">Reservation</h2>

<br>

      <table id="tblCustomers">
        <tr>
          <th> # </th>
          <th>  Order ID </th>
            <th>  User Name </th>
              <!-- <th>  User Last Name </th> -->
              <th>  User Email ID </th>
              <th>  User Phone No. </th>
              <th>  User Adhar No. </th>
              <th>  User Address </th>
          <th> Hall Name </th>
          <th> Hall Type </th>
          <th> Hall Place </th>
          <th> City </th>

          <th> Hall Arrival Date </th>
          <th> Hall Departure Date </th>
          <th>  Hall Seat </th>
          <th>  Hall Price </th>
          <th>  Payment Method </th>
          <th>  Book Date </th>
          <th>  Book Time </th>
          <th>  Action </th>

        </tr>
    <?php
    if($total!=0)
    {
        date_default_timezone_set('Asia/Kolkata');
       $x=1;
        while ($row= mysqli_fetch_assoc($data))
        {

          $check_out= $row['departure_date'];
          $dateTimestamp2 = strtotime($check_out);
          $check_out_date1 = date('Y-m-d',$dateTimestamp2);

          $get_date=date("d-m-Y");
          $time = strtotime($get_date);
          $current_date = date('Y-m-d',$time);
               if($check_out_date1<$current_date){


               $sqlout="UPDATE reservationhall SET isActive=0 WHERE reserv_id='".$row['reserv_id']."'";

               if(mysqli_query($conn,$sqlout))
               {
                 $sqlrr="UPDATE hall SET hall_availibility='YES' AND isActive=1 WHERE hall_id= '".$row['hall_id']."'";
                 $datarr= mysqli_query($conn,$sqlrr);
                 echo '<script type="text/javascript">';
                 echo 'alert("All Back Dated Check Out deleted from now");';
                 echo 'window.location.href = "reservation.php";';
                 echo '</script>';

               }
             }

             else{



            $sqlh="SELECT * FROM hall WHERE hall_id='".$row['hall_id']."'";
            $datah= mysqli_query($conn,$sqlh);
            $rowh= mysqli_fetch_assoc($datah);

            $sqlu="SELECT * FROM user_registration WHERE u_id='".$row['u_id']."'";
            $datau= mysqli_query($conn,$sqlu);
            $rowu= mysqli_fetch_assoc($datau);

            $sqlc="SELECT * FROM city WHERE city_id='".$rowh['city_id']."'";
            $datac= mysqli_query($conn,$sqlc);
            $rowc= mysqli_fetch_assoc($datac);

            $sqlcat="SELECT * FROM category WHERE category_id='".$rowh['category_id']."'";
            $datacat= mysqli_query($conn,$sqlcat);
            $rowcat= mysqli_fetch_assoc($datacat);

            $sqlp="SELECT * FROM paymentmethod WHERE payment_id='".$row['payment_id']."'";
            $datap= mysqli_query($conn,$sqlp);
            $rowp= mysqli_fetch_assoc($datap);


      ?>

      <tr><td><?php echo $x; ?></td>

        <td><?php echo $row['order_no'] ?> </td>

        <td><?php echo $rowu['u_name'] ?> </td>
        <td><?php echo $rowu['u_email'] ?></td>
        <td><?php echo $rowu['u_phone'] ?></td>
        <td><?php echo $rowu['u_adhar'] ?></td>
        <td><?php echo $rowu['u_address'] ?></td>

          <td><?php echo $rowh['hall_name'] ?></td>
          <td><?php echo $rowcat['category_name'] ?></td>
          <td><?php echo $rowh['hall_place'] ?></td>
          <td><?php echo $rowc['city_name'] ?></td>
          <td><?php echo $row['arrival_date'] ?></td>
          <td><?php echo $row['departure_date'] ?></td>
          <td><?php echo $rowh['hall_seat'] ?></td>
              <td><?php echo $rowh['hall_price'] ?></td>
              <td><?php echo $rowp['payment_name'] ?></td>
              <td><?php echo $row['booked_date'] ?></td>
              <td><?php echo $row['booked_time'] ?></td>

          <td><a style="text-decoration:none" href="javascript:void(0);" onclick="chk('<?php echo $row['reserv_id']; ?>');">Clean</a></td>

      </tr>
      <?php
      $x++;
    }//end else of my
    }
    }
    else{
      echo "no records";
      }
     ?>

    </table>
    <br>
    <div>
    <button id="btnExport" style="text-align:center; padding-left:4px;">Export to Excel</button>
  </div>

                             <?php
                             $conn->close();

                             ?>

                             <br>

 					              	 <?php include './includes/footer.php';?>

                     </section>
                 </div>
             </div>
         </div>


 		 <?php include './includes/commonheaderJsIncludes.php';?>

     <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
     <script src="https://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>


       <script type="text/javascript">
         $(function () {
             $("#btnExport").click(function () {
                 $("#tblCustomers").table2excel({
                     filename: "Reservation Table.xls"
                 });
             });
         });
     </script>
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
        window.location.href = "adminLogin/sessionExpiredAdmin.php";
         // window.location.reload();
     }
 }
 </script>
 <script>
 function chk(val){
  var result =confirm("Are u want to delete ?");
  if(result){
    location.href="deleteReservation.php?id="+val;
  }

 }
 </script>
