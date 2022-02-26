
 <?php
 include('includes/config.php');
 error_reporting(0);

  if(!isset($_SESSION["adminLoggedin"])){
       header("location:adminLogin/");
       exit;
   }

   if(isset($_POST['editcity']))
   {
     $eid = $_POST['eid'];
      $cityname = $_POST['cityname'];
      $sql = "UPDATE `city` SET city_name='$cityname' WHERE city_id='$eid'";
      if(mysqli_query($conn, $sql)){
          echo "Records update successfully.";
      } else{
          echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
      }

      $conn->close();
     header('location:city.php');
   }
 ?>

   <html>
       <title>City</title>
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
                                           <li class="breadcrumb-item active">City</li>
                                       </ol>
                                   </div>
                               </div>
                           </div>
                           <!-- /# column -->
                       </div>
                       <!-- /# row -->

                       <section id="main-content">
                            <h2 class="center">Update City</h2>
                            <br>
                            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                            <?php
                            $id = $_REQUEST['id'];
                            $query="SELECT * FROM city WHERE city_id='$id'  AND isActive=1";
                            $data= mysqli_query($conn,$query);
                            while ($row= mysqli_fetch_assoc($data))
                            {
                             ?>

                           <section class="center">
                               <div>
                                   <div>
                                       <div>
                                           <input type="hidden" name="eid" value="<?php echo $row['city_id']?>">
                                           <lable>City Name :</lable>
                                           <input type="text" name="cityname" id="cityname" placeholder="Enter City Name" value="<?php echo $row['city_name']?>" onfocus="this.select();" onkeyup="javascript:capitalize(this.id, this.value);" autofocus>
                                           </tr>
                                         </div>
                                       <br>
                                       <div>
                                           <input type="submit" name="editcity" Value="Submit">
                                         <button>  <a href="city.php" style="text-decoration: none;">Back</a> </button>
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
    // capitalize first name and last name
      function capitalize(textboxid, str) {
          // string with alteast one character
          if (str && str.length >= 1)
          {
              var firstChar = str.charAt(0);
              var remainingStr = str.slice(1);
              str = firstChar.toUpperCase() + remainingStr;
          }
          document.getElementById(textboxid).value = str;
      }
      </script>
