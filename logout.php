<?php
include 'dbconnect.php';

  if(!isset($_SESSION['user_id']))
  {
 	  header("Location: index.php");  
  }
  else if(isset($_SESSION['user_id'])!="")
  {
    unset($_SESSION['user_id']);
  //  unset($_SESSION['user']);
    session_destroy();
    header("Location: index.php#tologin");
  }

?>