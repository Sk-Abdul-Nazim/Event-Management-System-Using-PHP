<?php
 include('includes/config.php');
 error_reporting(0);
  if(!isset($_SESSION["adminLoggedin"])){
       header("location:adminLogin/");
       exit;
   }
   ?>

 <html>
     <title>Hall Details</title>
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
    .center {
          margin: auto;
          width: 8%;
          border: 3px solid #73AD21;
          padding: 10px;
}

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
                                         <li class="breadcrumb-item active">Hall</li>
                                     </ol>
                                 </div>

                             </div>
                         </div>

                         <div class="dropdown right">
                            <button class="dropbtn">Sort</button>
                            <div class="dropdown-content">
                              <a href="sortingHallName.php?shname=sort">By Name</a>
                              <a href="sortingHallName.php?shplace=sortPlace">By Place Name</a>
                              <a href="sortingHallName.php?shcity=sortCity">By City Name</a>
                            </div>
                         </div>
                         <!-- /# column -->
                     </div>
                     <!-- /# row -->

                     <section id="main-content">
                       <h2 style="text-align:center">Hall</h2>
                       <br>
                         <table>
                    <?php
                    if(isset($_GET['shname'])){
                    $query = "SELECT * FROM hall WHERE hall_availibility='YES' AND isActive=1 ORDER BY hall_name";
                    $data= mysqli_query($conn,$query);
                    $total= mysqli_num_rows($data);
                    if($total!=0)
                    {
                          ?>


                            <tr>
                              <th> # </th>
                              <th> Hall Name </th>
                              <th> Hall Type </th>
                              <th> Place </th>
                              <th> City </th>
                              <th> No. of Seat</th>
                              <th> Price </th>
                              <th> Date </th>
                              <th> Time </th>
                              <th> Availability </th>
                              <th> Image </th>
                              <th> Action </th>

                            </tr>
                          <?php
                           $x=1;
                            while ($row= mysqli_fetch_assoc($data))
                            {
                          ?>

                          <tr>
                            <td><?php echo $x; ?></td>
                            <td><?php echo $row['hall_name'] ?></td>

                      <?php  $sql3="SELECT category_name FROM category WHERE category_id='".$row['category_id']."'";
                             $data3= mysqli_query($conn,$sql3);
                             $row3= mysqli_fetch_assoc($data3);
                      ?>

                            <td><?php echo $row3['category_name'] ?></td>
                            <td><?php echo $row['hall_place'] ?></td>


                      <?php  $sql2="SELECT city_name FROM city WHERE city_id='".$row['city_id']."'";
                             $data2= mysqli_query($conn,$sql2);
                             $row2= mysqli_fetch_assoc($data2);
                      ?>
                            <td><?php echo $row2['city_name'] ?></td>
                            <td><?php echo $row['hall_seat'] ?></td>
                            <td><?php echo $row['hall_price'] ?></td>
                            <td><?php echo $row['hall_date'] ?></td>
                            <td><?php echo $row['hall_time'] ?></td>
                            <td><?php echo $row['hall_availibility'] ?></td>


                            <?php $imgpath='images/hall/'.$row['hall_image'];?>
                           <td><a href="<?php echo $imgpath ?>" target="_blank"><img src="<?php echo $imgpath;?>" alt="HTML5 Icon" style="width:128px;height:100px"></a></td>


                            <td><a style="text-decoration:none" href="editHall.php?id=<?php echo $row['hall_id'] ?>">Edit </a> |
                            <a style="text-decoration:none" href="javascript:void(0);" onclick="chk('<?php echo $row['hall_id'] ?>');">Delete</a>

                              </td>
                          </tr>
                          <?php
                          $x++;
                          }
                          }
                          else{?>
                            <tr>
                          <td><?php echo "no records";?></td></tr>
                          <?php
                          }
                          }







                          if(isset($_GET['shcity'])){
                          $query = "SELECT * FROM hall WHERE hall_availibility='YES' AND isActive=1 ORDER BY city_id";
                          $data= mysqli_query($conn,$query);
                          $total= mysqli_num_rows($data);
                          if($total!=0)
                          {
                                ?>


                                  <tr>
                                    <th> # </th>
                                    <th> Hall Name </th>
                                    <th> Hall Type </th>
                                    <th> Place </th>
                                    <th> City </th>
                                    <th> No. of Seat</th>
                                    <th> Price </th>
                                    <th> Date </th>
                                    <th> Time </th>
                                    <th> Availability </th>
                                    <th> Image </th>
                                    <th> Action </th>

                                  </tr>
                                <?php
                                 $x=1;
                                  while ($row= mysqli_fetch_assoc($data))
                                  {
                                ?>

                                <tr>
                                  <td><?php echo $x; ?></td>
                                  <td><?php echo $row['hall_name'] ?></td>

                            <?php  $sql3="SELECT category_name FROM category WHERE category_id='".$row['category_id']."'";
                                   $data3= mysqli_query($conn,$sql3);
                                   $row3= mysqli_fetch_assoc($data3);
                            ?>

                                  <td><?php echo $row3['category_name'] ?></td>
                                  <td><?php echo $row['hall_place'] ?></td>


                            <?php  $sql2="SELECT city_name FROM city WHERE city_id='".$row['city_id']."'";
                                   $data2= mysqli_query($conn,$sql2);
                                   $row2= mysqli_fetch_assoc($data2);
                            ?>
                                  <td><?php echo $row2['city_name'] ?></td>
                                  <td><?php echo $row['hall_seat'] ?></td>
                                  <td><?php echo $row['hall_price'] ?></td>
                                  <td><?php echo $row['hall_date'] ?></td>
                                  <td><?php echo $row['hall_time'] ?></td>
                                  <td><?php echo $row['hall_availibility'] ?></td>


                                  <?php $imgpath='images/hall/'.$row['hall_image'];?>
                                 <td><a href="<?php echo $imgpath ?>" target="_blank"><img src="<?php echo $imgpath;?>" alt="HTML5 Icon" style="width:128px;height:100px"></a></td>


                                  <td><a style="text-decoration:none" href="editHall.php?id=<?php echo $row['hall_id'] ?>">Edit </a> |
                                  <a style="text-decoration:none" href="javascript:void(0);" onclick="chk('<?php echo $row['hall_id'] ?>');">Delete</a>

                                    </td>
                                </tr>
                                <?php
                                $x++;
                                }
                                }
                                else{?>
                                  <tr>
                                <td><?php echo "no records";?></td></tr>
                                <?php
                                }
                                }


                                if(isset($_GET['shplace'])){
                                $query = "SELECT * FROM hall WHERE hall_availibility='YES' AND isActive=1 ORDER BY hall_place";
                                $data= mysqli_query($conn,$query);
                                $total= mysqli_num_rows($data);
                                if($total!=0)
                                {
                                      ?>


                                        <tr>
                                          <th> # </th>
                                          <th> Hall Name </th>
                                          <th> Hall Type </th>
                                          <th> Place </th>
                                          <th> City </th>
                                          <th> No. of Seat</th>
                                          <th> Price </th>
                                          <th> Date </th>
                                          <th> Time </th>
                                          <th> Availability </th>
                                          <th> Image </th>
                                          <th> Action </th>

                                        </tr>
                                      <?php
                                       $x=1;
                                        while ($row= mysqli_fetch_assoc($data))
                                        {
                                      ?>

                                      <tr>
                                        <td><?php echo $x; ?></td>
                                        <td><?php echo $row['hall_name'] ?></td>

                                  <?php  $sql3="SELECT category_name FROM category WHERE category_id='".$row['category_id']."'";
                                         $data3= mysqli_query($conn,$sql3);
                                         $row3= mysqli_fetch_assoc($data3);
                                  ?>

                                        <td><?php echo $row3['category_name'] ?></td>
                                        <td><?php echo $row['hall_place'] ?></td>


                                  <?php  $sql2="SELECT city_name FROM city WHERE city_id='".$row['city_id']."'";
                                         $data2= mysqli_query($conn,$sql2);
                                         $row2= mysqli_fetch_assoc($data2);
                                  ?>
                                        <td><?php echo $row2['city_name'] ?></td>
                                        <td><?php echo $row['hall_seat'] ?></td>
                                        <td><?php echo $row['hall_price'] ?></td>
                                        <td><?php echo $row['hall_date'] ?></td>
                                        <td><?php echo $row['hall_time'] ?></td>
                                        <td><?php echo $row['hall_availibility'] ?></td>


                                        <?php $imgpath='images/hall/'.$row['hall_image'];?>
                                       <td><a href="<?php echo $imgpath ?>" target="_blank"><img src="<?php echo $imgpath;?>" alt="HTML5 Icon" style="width:128px;height:100px"></a></td>


                                        <td><a style="text-decoration:none" href="editHall.php?id=<?php echo $row['hall_id'] ?>">Edit </a> |
                                        <a style="text-decoration:none" href="javascript:void(0);" onclick="chk('<?php echo $row['hall_id'] ?>');">Delete</a>

                                          </td>
                                      </tr>
                                      <?php
                                      $x++;
                                      }
                                      }
                                      else{?>
                                        <tr>
                                      <td><?php echo "no records";?></td></tr>
                                      <?php
                                      }
                                      }
                                      ?>
                          </table>

                          <?php

                          $conn->close();

                          ?>

                          <br>
                          <div class="center">
                          <a href="addHall.php" style="padding-left:8px;">Add Hall</a>
                        </div>



 					              	 <?php include './includes/footer.php';?>

                     </section>
                 </div>
             </div>
         </div>


 		 <?php include './includes/commonheaderJsIncludes.php';?>

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
