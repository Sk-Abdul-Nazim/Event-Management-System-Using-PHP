<?php
include('includes/config.php');
$query ="SELECT * FROM hall WHERE isActive=1 AND hall_availibility='YES' AND city_id ='".$_POST["city_id"]."'";

  $result = mysqli_query($conn, $query);
?>
<option>select</option>
<?php
$result2 = mysqli_query($conn, $query);
    while($row22=mysqli_fetch_assoc($result2)){

  ?>
            <option value="<?php echo $row22['hall_id']; ?>"><?php echo $row22['hall_name']; ?>  </option>
 <?php
}?>
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
