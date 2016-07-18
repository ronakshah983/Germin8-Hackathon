<?php
include 'dbconnect.php';

$query = mysql_query("Select like_info,likes,dislikes,dislike_info from posts where post_id=".$_POST['id']) or die(mysql_error());
$row = mysql_fetch_array($query,MYSQL_ASSOC);

$likes=$row['likes']+1;
$dislike=$row['dislikes']+1;
$likeinfo=$row['like_info'];
$dislikeinfo=$row['dislike_info'];
$uid=$_SESSION['user_id'];

if($_POST['type']==1)
{
	$query="UPDATE posts set likes='$likes' where post_id=".$_POST['id'];
	$query=mysql_query($query);

	$query="UPDATE posts set like_info='".$row['like_info'].",".$uid."' where post_id=".$_POST['id'];
	$query=mysql_query($query);
	echo $likes;
}
else
{
	$query="UPDATE posts set dislikes='$dislike' where post_id=".$_POST['id'];
	$query=mysql_query($query);
	$query="UPDATE posts set dislike_info='".$row['dislike_info'].",".$uid."' where post_id=".$_POST['id'];
	$query=mysql_query($query);
	echo $dislike;
}
?>