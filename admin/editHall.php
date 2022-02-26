
<?php
include('includes/config.php');
error_reporting(0);
 if(!isset($_SESSION["adminLoggedin"])){
      header("location:adminLogin/");
      exit;
  }


  if(isset($_POST['editHall']))
  {

         $hid = $_POST['hid'];
         $hallname = $_POST['hallname'];
         $hallplace = $_POST['hallplace'];
         $hallseat = $_POST['hallseat'];
         $hallprice = $_POST['hallprice'];
         $availability = $_POST['avl'];

         $cid = $_POST['city'];
         if(empty($cid))
         {
             echo "You didn't select any City";
             echo "<br>";
         }

         $catid = $_POST['category'];  // Storing Selected Value In Variable
           if(empty($catid))
           {
               echo "You didn't select any Category";
               echo "<br>";
           }

           if(isset($_FILES["image"]))
         {
         	$tname=$_FILES["image"]["tmp_name"];
         	$name=$_FILES["image"]["name"];
         	$fft=explode(".",$_FILES["image"]["name"]);
         	$ft=strtolower(end($fft));
         	$extension=array("jpeg","jpg","png");
         	if(in_array($ft,$extension)===false)
         	{
         		echo"<h1>"."Please Image Save in jpeg or jpg or png Format"."</h1>";
         		exit;
         	}
         	move_uploaded_file($tname,"images/hall/".$name);
         }
         else{
         $name = "images/noHall/no_img.png";
         }

          date_default_timezone_set("Asia/Kolkata");
          $currDate = date("y-m-d");
          $currTime = date("h:i a");

     $sql = "UPDATE `hall` SET hall_name='$hallname', hall_place='$hallplace',hall_seat='$hallseat', hall_date='$currDate', hall_time='$currTime', hall_price='$hallprice', hall_availibility='$availability', hall_image='$name', category_id='$catid', city_id='$cid' WHERE hall_id='$hid'";
     if(mysqli_query($conn, $sql)){
         echo "Records update successfully.";
     } else{
         echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
     }

     $conn->close();
    header('location:hall.php');
  }
 ?>


   <html>
       <title>Hall</title>
   <head>
         <meta charset="utf-8">
         <meta http-equiv="X-UA-Compatible" content="IE=edge">
         <meta name="viewport" content="width=device-width, initial-scale=1">

   	 <?php include './includes/commonStyleIncludes.php';?>
      <style>
       .center {
           margin: auto;
           text-align: center;
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
                           <!-- /# column -->
                       </div>
                       <!-- /# row -->

                       <section id="main-content">
                            <h2 class="center">Update Hall</h2>
                            <br>
                             <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"  enctype="multipart/form-data" > <!--id="frm"-->
                            <?php

                            $hid = $_REQUEST['id'];
                            $query="SELECT * FROM hall WHERE hall_id='$hid' AND isActive=1";
                            $data= mysqli_query($conn,$query);
                            while ($row= mysqli_fetch_assoc($data))
                            {
                             ?>

                           <section class="center">
                               <div>
                                   <div>

                                       <input type="hidden" name="hid" value="<?php echo $row['hall_id']?>">
                                        <section class="center">
                                            <div>
                                              <div>
                                                 <div>
                                                   <lable>Hall Name :</lable>
                                                         <input type="text" autocomplete="off" name="hallname" id="hallname" value="<?php echo $row['hall_name']; ?>" placeholder="Enter Hall Name" onkeyup="javascript:capitalize(this.id, this.value);" onfocus="this.select();" required/>
                                                </div>

                                                <br>
                                                <div>
                                                 <lable>Hall Type</lable>
                                                  <select class="selectpicker" name="category">
                                                    <option>Select</option>
                                                    <?php
                                                      $sqlcat="SELECT * FROM category where isActive=1";
                                                      $datacat= mysqli_query($conn,$sqlcat);

                                                      while ($rowcat= mysqli_fetch_assoc($datacat))
                                                      {
                                                    ?>
                                                      <option value="<?php echo $rowcat['category_id'] ?>"><?php echo $rowcat['category_name'] ?></option>

                                                    <?php  }?>
                                                  </select>
                                                </div>

                                              <br>
                                                <div>
                                                  <lable>Place :</lable>
                                                        <input type="text" autocomplete="off" name="hallplace" id="hallplace" value="<?php echo $row['hall_place']; ?>" placeholder="Enter Hall Place" onkeyup="javascript:capitalize(this.id, this.value);" required/>
                                               </div>

                      <br>

                                               <div>
                                                <lable>City</lable>
                                                 <select class="selectpicker" name="city">
                                                   <option>select</option>
                                                   <?php
                                                     $sqlci="SELECT * FROM city where isActive=1";
                                                     $dataci= mysqli_query($conn,$sqlci);

                                                     while ($rowci= mysqli_fetch_assoc($dataci))
                                                     {
                                                   ?>
                                                     <option value="<?php echo $rowci['city_id'] ?>"><?php echo $rowci['city_name'] ?></option>

                                                   <?php  }?>
                                                 </select>
                                               </div>

        <br>
                                               <div>
                                                  <lable>No Of Seat :</lable>
                                                      <input type="number" autocomplete="off" name="hallseat" id="hallseat" value="<?php echo $row['hall_seat']; ?>" placeholder="Enter Hall Seat"  required/>
                                              </div>
<br>
                                               <div>
                                                 <lable>Price :</lable>
                                                       <input type="number" autocomplete="off" name="hallprice" id="hallprice" value="<?php echo $row['hall_price']; ?>" placeholder="Enter Hall Price"  required/>
                                              </div>
<br>
                                              <div>
                                                 <lable>Hall Availability :</lable>
                                                 <select class="selectpicker" name="avl">
                                                   <option>YES</option>
                                                   <option>NO</option>
                                                 </select>
                                              </div>
      <br>
                                              <div>
                                                  <lable>Hall Image :</lable>
                                                    <input type="file" name="image">
                                              </div>
                                       <br>
                                       <div>
                                           <input type="submit" name="editHall" Value="Submit">
                                         <button>  <a href="hall.php" style="text-decoration: none;">Back</a> </button>
                                       </div>

                                   </div>
                               </div>
                               <?php } ?>
                             </section>
                            </form>


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


   <script type="text/javascript">

   function capitalize(textboxid, input) {
       var CapitalizeWords = input[0].toUpperCase();
       for (var i = 1; i <= input.length - 1; i++) {
           let currentCharacter,
               previousCharacter = input[i - 1];
           if (previousCharacter && previousCharacter == ' ') {
               currentCharacter = input[i].toUpperCase();
           } else {
               currentCharacter = input[i];
           }
           CapitalizeWords = CapitalizeWords + currentCharacter;
       }
         document.getElementById(textboxid).value = CapitalizeWords;
   }
      </script>
