<?php
include('../includes/config.php');

if(!isset($_SESSION["adminLoggedin"])){

  echo '<script type="text/javascript">';
  echo 'alert("Session has been expired for security purpose, Please sign in again...");';
  echo 'window.location.href = "../adminLogin/";';
  echo '</script>';

}
else{

  session_destroy();

  echo '<script type="text/javascript">';
  echo 'alert("Session has been expired for security purpose, Please sign in again...");';
  echo 'window.location.href = "../adminLogin/";';
  echo '</script>';

}

$conn.close();

?>
