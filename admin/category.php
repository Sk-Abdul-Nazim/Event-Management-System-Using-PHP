
<?php
include('includes/config.php');
error_reporting(0);
 if(!isset($_SESSION["adminLoggedin"])){
      header("location:adminLogin/");
      exit;
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
          margin: auto;
          width: 10%;
          border: 3px solid #73AD21;
          padding: 10px;
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
                                        <li class="breadcrumb-item active">Category</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <!-- /# column -->
                    </div>
                    <!-- /# row -->

                    <section id="main-content">
                         <h2 style="text-align:center">Category</h2>
                         <br>
                           <table>
                      <?php
                      $query = "SELECT * FROM category WHERE isActive=1 ORDER BY category_name";
                      $data= mysqli_query($conn,$query);
                      $total= mysqli_num_rows($data);
                      if($total!=0)
                      {
                            ?>


                              <tr>
                                <th> # </th>
                                <th> Category Name </th>
                                <th> Date </th>
                                <th> Time </th>
                                <th> Action </th>

                              </tr>
                            <?php
                             $x=1;
                              while ($row= mysqli_fetch_assoc($data))
                              {
                            ?>

                            <tr>
                              <td><?php echo $x; ?></td>
                              <td><?php echo $row['category_name'] ?></td>
                              <td><?php echo $row['category_date'] ?></td>
                              <td><?php echo $row['category_time'] ?></td>
                              <td><a style="text-decoration:none" href="editCategory.php?id=<?php echo $row['category_id'] ?>">Edit </a> |
                              <a style="text-decoration:none" href="javascript:void(0);" onclick="chk('<?php echo $row['category_id'] ?>');">Delete</a>

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
                            ?>

                            </table>

                            <?php
                            $conn->close();

                            ?>

                            <br>
                            <div class="center">
                            <a href="addCategory.php" style="padding-left:8px;">Add Category</a>
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
<script>
function chk(val){
 var result =confirm("Are u want to delete ?");
 if(result){
   location.href="deleteCategory.php?id="+val;
 }

}
</script>
