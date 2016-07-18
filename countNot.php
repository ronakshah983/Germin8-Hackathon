<?php
include 'dbconnect.php';

$query=mysql_query("Select count(title) from notification where status='unread' and user_id=".$_SESSION['user_id']);
$result=mysql_fetch_array($query,MYSQL_NUM);
if(mysql_num_rows($query)==0)
	echo "0 results";
else
	echo $result[0];

?>