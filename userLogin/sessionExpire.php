<?php
include('../includes/config.php');

if(!isset($_SESSION["userLoggedin"])){
  echo '<script type="text/javascript">';
  echo 'window.location.href = "../";';
  echo '</script>';

}
else{
  
  session_destroy();

  echo '<script type="text/javascript">';
  echo 'alert("Session has been expired for security purpose, Please sign in again...");';
  echo 'window.location.href = "../userLogin/";';
  echo '</script>';

}

$conn.close();

?>
