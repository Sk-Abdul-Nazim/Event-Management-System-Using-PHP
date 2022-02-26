<?php
include('includes/config.php');
$query ="SELECT * FROM hall WHERE hall_availibility='YES' AND hall_id ='".$_POST["hall_id"]."'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    $category_id = $row['category_id'];
    $query2 = "SELECT * FROM category WHERE category_id = $category_id";
    $data2 = mysqli_query($conn, $query2);
?>
<!-- <h5>Hotel</h5> -->
<option>select</option>
<?php
$data3 = mysqli_query($conn, $query2);
    while($row2=mysqli_fetch_assoc($data3)){

  ?>
            <option value="<?php echo $row2['category_id']; ?>"><?php echo $row2['category_name']; ?>  </option>
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
