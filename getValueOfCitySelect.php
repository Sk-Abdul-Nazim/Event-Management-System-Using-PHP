<?php
include('includes/config.php');
$query ="SELECT * FROM city WHERE isActive=1";

  $result = mysqli_query($conn, $query);
?>
<option>select</option>
<?php
$result2 = mysqli_query($conn, $query);
    while($row22=mysqli_fetch_assoc($result2)){

  ?>
            <option value="<?php echo $row22['city_id']; ?>"><?php echo $row22['city_name']; ?>  </option>
 <?php
}?>


<div class="section group">

 <?php

      $query = "SELECT * FROM hall WHERE isActive = 1 AND hall_availibility='YES' LIMIT 3";
      $data= mysqli_query($conn,$query);
          while($row= mysqli_fetch_assoc($data))
          {
            $imgpath='../admin/images/hall/'.$row['hall_image'];
            $category_id=$row['category_id'];
            $city_id=$row['city_id'];

            $date = date('Y-m-d');
            $next_date = date('Y-m-d', strtotime($date .' +1 day'));
 ?>

  <div class="grid_1_of_3 events_1_of_3">
    <div class="event-time">
      <h4>
        <span>Hall Name: <?php echo $row['hall_name']; ?></span><br>

        <?php
              $sqlcat = "SELECT * FROM category WHERE category_id='$category_id'";
              $datacat= mysqli_query($conn,$sqlcat);
              $rowcat=mysqli_fetch_assoc($datacat);
         ?>
        <span>Hall Type : <?php echo $rowcat['category_name']; ?></span><br>
      </h4>
      <?php
            $sqlcn = "SELECT * FROM city WHERE city_id='$city_id'";
            $datacn= mysqli_query($conn,$sqlcn);
            $rowcn=mysqli_fetch_assoc($datacn);
       ?>
      <h4>place : <?php echo $row['hall_place']; ?></h4>
      <h4>city  : <?php echo $rowcn['city_name']; ?></h4>
      <h4>price : <?php echo $row['hall_price']; ?></h4>
    </div>

    <div class="event-img">
      <a href="../bookingDetails.php?id=<?php echo $row['hall_id'];?>">
        <img src="<?php echo $imgpath;?>" alt="feature_1" width="80px" height="200px" />
        <span>BOOK</span>
      </a>
    </div>
  </div>
<?php } ?>

</div>

<div class="section group">
  <?php
      $query1 = "SELECT * FROM hall WHERE isActive = 1 AND hall_availibility='YES' ORDER BY hall_id DESC LIMIT 3";
      $data1= mysqli_query($conn,$query1);

          while($row1= mysqli_fetch_assoc($data1))
          {
            $imgpath1='../admin/images/hall/'.$row1['hall_image'];
            $category_id1=$row1['category_id'];
            $city_id1=$row1['city_id'];

            $date1 = date('Y-m-d');
            $next_date1 = date('Y-m-d', strtotime($date1 .' +1 day'));
 ?>

  <div class="grid_1_of_3 events_1_of_3">
    <div class="event-time">
      <h4>
        <span>Hall Name: <?php echo $row1['hall_name']; ?></span><br>

        <?php
              $sqlcat1 = "SELECT * FROM category WHERE category_id='$category_id1'";
              $datacat1= mysqli_query($conn,$sqlcat1);
              $rowcat1=mysqli_fetch_assoc($datacat1);
         ?>
         <span>Hall Type : <?php echo $rowcat1['category_name']; ?></span><br>
      </h4>

      <?php
            $sqlcn1 = "SELECT * FROM city WHERE city_id='$city_id1'";
            $datacn1= mysqli_query($conn,$sqlcn1);
            $rowcn1=mysqli_fetch_assoc($datacn1);
       ?>

       <h4>place : <?php echo $row1['hall_place']; ?></h4>
      <h4>city  : <?php echo $rowcn1['city_name']; ?></h4>
      <h4>price : <?php echo $row1['hall_price']; ?></h4>
    </div>
    <div class="event-img">
      <a href="../blog/">
        <img src="<?php echo $imgpath1;?>" alt="feature_1" width="80px" height="200px" />
      <span>BOOK</span>
      </a>
    </div>
  </div>
<?php } ?>

</div>
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
