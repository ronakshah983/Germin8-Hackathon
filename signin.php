<?php
include 'dbconnect.php';

if(isset($_POST['siginin']))
{
	$uname=$_POST['usernamesignup'];
	$email=$_POST['emailsignup'];
	$password=$_POST['passwordsignup'];
	$name="";
	$query=mysql_query("Select * from user where email=".$email);
	$count=0;
	while($row=mysql_fetch_array($query,MYSQL_ASSOC))
		$count++;
	if($count==0)
	{
		$query=mysql_query("INSERT into users (email,password,user_name,name) values ('$email','$password','$uname','$name')");
		if($query)
		{
			?><script>alert("Registration Successfull");</script><?php
			header("Location:index.php?fail=false");
		}
	}
	else
	{
		?><script>alert("User Already Exists");</script><?php
		header("Location:index.php?fail=true");		
	}
}
else
{
	header("Location:index.php");
}
?>