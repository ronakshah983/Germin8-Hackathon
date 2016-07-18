<?php
include 'dbconnect.php';

$uid=$_SESSION['user_id'];
$pid=$_POST['id'];
$timestamp = date_default_timezone_get();
$comment=$_POST['comment'];
$timestamp= date('Y-m-d H:i:s');

$sql=mysql_query("Select role,user_name from users where id=".$uid);
$result=mysql_fetch_array($sql,MYSQL_ASSOC);
$role=$result['role'];

$query = mysql_query("INSERT into comments (user_id,post_id,timestamp,comment,role_id) values 
		('$uid','$pid','$timestamp','$comment','$role')") or die(mysql_error());
if($query)
{
    echo 
    '<div class="cmt-cnt">
		<div class="thecom">
	        <h5>'.$result['user_name'].' </h5><span  class="com-dt">'.$timestamp.'</span>
	        <br/>
	       	<p>'.$comment.'</p>
	    </div>
	</div>';
}
?>