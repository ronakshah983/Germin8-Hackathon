<?php
include 'dbconnect.php';

if(isset($_SESSION['user'])!="")
{
   header("Location: feed.php");
}

if(isset($_POST['login']))
{
    $email = mysql_real_escape_string($_POST['username']);
    $upass = mysql_real_escape_string($_POST['password']);
    $res=mysql_query("SELECT * FROM users WHERE email='$email'");
    $row=mysql_fetch_array($res);
    if($row['password']==$upass)
    {
        $_SESSION['user_id'] = $row['id'];
        $query = "Select roll_id from posts where id=".$row['id'];
        $result = mysql_query($query);     
        $row=mysql_fetch_array($res);
        if($row['roll_id']==0)
          $_SESSION['privacy'] = 0;
        else
          $_SESSION['privacy'] = 1;
        header("Location: feed.php"); 
    }
    else
    {
        header("Location:index.php");
     }
  }  
  else
  {
    header("Location:index.php");
  }
?>
