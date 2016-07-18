
<?php
include 'dbconnect.php';

$sql=mysql_query("Select title,post_id from notification where status='unread' and user_id=".$_SESSION['user_id']);
$checkNotifyStatus=False;
 echo '<ul>';

 if(mysql_num_rows($sql)==0)
 {
 	echo "0 results";
 }
 else
 {
 while($row=mysql_fetch_array($sql,MYSQL_ASSOC))
 	echo '<li><a href="review.php?postid='.$row['post_id'].'">'.$row['title'].'</a></li>';
}
$checkNotifyStatus=True;

echo '</ul>';

if($checkNotifyStatus==True)
{
	$sql=mysql_query("UPDATE notification set status='read' where status='unread' and user_id=".$_SESSION['user_id']) or die(mysql_error());
}
?>