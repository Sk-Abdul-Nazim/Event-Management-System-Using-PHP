<?php
include('includes/config.php');
error_reporting(0);
  $id = $_REQUEST['id'];
?>
<html>
<head>
  <style>
  .b{
         padding: 5cm 2cm 2cm 16cm !important;
         background-image: url('images/bg.jpg');
         color:white;
    }
</style>
</head>
<body class="b">
<form action="bookingDetails.php" method="get">
<input type="hidden" name="id" value="<?php echo $id;?>">
<div>
<div>
<lable>Arrival date :</lable>
<input type="date" name="arr_date">
</div>
<br>
<div>
  <lable>
Departure date :</lable>
<input type="date" name="dep_date">
</div>
<br>
<div>
  <input type="hidden" name="form_submit" value="1">
<input type="submit" value="Submit">
</div>
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
