<?php
include('includes/config.php');
error_reporting(0);

 if(!isset($_SESSION["adminLoggedin"])){
      header("location:adminLogin/");
      exit;
  }
if(isset($_POST['addCat']))
{
     $catname = $_POST['catname'];

      date_default_timezone_set("Asia/Kolkata");
      $currDate = date("y-m-d");
      $currTime = date("h:i a");

   $sql = "INSERT INTO `category` (category_name,category_date,category_time,isActive) VALUES ('$catname','$currDate','$currTime',1)";
   if(mysqli_query($conn, $sql)){
       echo "Records inserted successfully.";
   } else{
       echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
   }

   $conn->close();
   header('location:category.php');
}
?>



<html>
    <title>Category</title>
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">

   <?php include './includes/commonStyleIncludes.php';?>
   <style>
    .center {
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
                                        <li class="breadcrumb-item active">Category</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <!-- /# column -->
                    </div>
                    <!-- /# row -->

                    <section id="main-content">
                         <h2 class="center">Category</h2>
                          <br>
                               <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > <!--id="frm"-->
                                  <section class="center">
                                      <div>
                                        <div>
                                           <div>
                                             <lable>Category Name :</lable>
                                                   <input type="text" autocomplete="off" name="catname" id="catname" placeholder="Enter Category Name" onkeyup="javascript:capitalize(this.id, this.value);" autofocus required/>
                                          </div>
                                         <br>

                                       <div>
                                             <input type="submit" name="addCat" Value="Submit">
                                            <button>  <a href="category.php" style="text-decoration: none;">Back</a> </button>
                                            </div>
                               </div>
                           </div>
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
