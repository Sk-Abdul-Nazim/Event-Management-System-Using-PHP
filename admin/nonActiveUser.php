
<?php
include('includes/config.php');
error_reporting(0);
 if(!isset($_SESSION["adminLoggedin"])){
      header("location:adminLogin/");
      exit;
  }
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
    .center {
        text-align: center;
}
.right {
  margin-left:1175px;
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

  <?php

  $query = "SELECT * FROM user_registration WHERE isActive=0";
  $data= mysqli_query($conn,$query);
  $total= mysqli_num_rows($data);
  if($total!=0)
  {
    ?>

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
                                        <li class="breadcrumb-item active">Non-Activated User Details</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                        <!-- <div class="dropdown right">
                           <button class="dropbtn">Sort</button>
                           <div class="dropdown-content">
                           <a href="sortingUserName.php?name=sort">By Name</a>
                           <a href="sortingUserDate.php?date=sort">By Reg. Date</a>
                           </div>
                        </div> -->
                        <!-- /# column -->
                    </div>
                    <!-- /# row -->

                    <section id="main-content">
                         <h2 class="center"> Non-Activated User Details</h2>
                         <br>

                        <table>
                          <tr>
                            <th> # </th>
                            <th> User Name </th>
                            <th> User Address </th>
                            <th> User Phone No </th>
                            <th> User Adhar No </th>
                            <th> User Email ID</th>
                            <th> Password</th>
                            <th> User Reg. Date </th>
                            <th> User Reg. Time </th>
                            <th> User Activated </th>
                            <th> Action </th>

                          </tr>
                      <?php
                         $x=1;
                          while ($row= mysqli_fetch_assoc($data))
                          {
                        ?>

                        <tr><td><?php echo $x; ?></td>
                            <td><?php echo $row['u_name'] ?></td>
                            <td><?php echo $row['u_address'] ?></td>
                            <td><?php echo $row['u_phone'] ?></td>
                            <td><?php echo $row['u_adhar'] ?></td>
                            <td><?php echo $row['u_email'] ?></td>
                            <td><?php echo $row['u_password'] ?></td>
                            <td><?php echo $row['u_date'] ?></td>
                            <td><?php echo $row['u_time'] ?></td>

                            <?php if($row['isActive'] == 1){?>
                            <td><span class="dot"></span></td>
                          <?php  }else{?>
                            <td><span class="dotRed"></span></td>
                          <?php }?>
                      <!-- <td><a style="text-decoration:none" href="editUserDetails.php?id=<?php// echo $row['u_id'] ?>">Edit</a> | -->
                            <td>
                            <a style="text-decoration:none" href="javascript:void(0);" onclick="chk('<?php echo $row['u_id'] ?>');">Activate</a>
                            </td>

                        </tr>
                        <?php
                        $x++;
                      }
                      }
                      else{
                        echo "no records";
                        }
                       ?>
                         </table>

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
 var result =confirm("Are u want to activate this user ?");
 if(result){
   location.href="activeUser.php?id="+val;
 }

}
</script>
