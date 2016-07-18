<?php
include 'dbconnect.php';

if(!isset($_SESSION['user_id']))
{
   header("Location: index.php");
}
else if(isset($_POST['upload']))
{

	$userid=$_SESSION['user_id'];
	$caption=$_POST['caption'];
	$privacy=$_POST['restrict'];
	$timezone = date_default_timezone_get();	
	
	$query = mysql_query("SELECT * from posts ORDER BY post_id DESC");
	$result = mysql_fetch_array($query);
	$curCount = $result['post_id'];
	$curCount++;

	$_FILES["userFile"]["name"] = $curCount.".jpg";
	$target_Path = "posts/";
	$target_Path = $target_Path.basename( $_FILES['userFile']['name'] );
	move_uploaded_file( $_FILES['userFile']['tmp_name'], $target_Path );

	$final_path = $target_Path;

	$timezone = date('Y-m-d H:i:s');
	$query = "INSERT into posts (user_id,image_url,caption,privacy,timestamp) values('$userid','$final_path','$caption','$privacy','$timezone')" or die(mysql_error());
	if(mysql_query($query))
	{
		preg_match_all('/(#\w+)/', $caption, $matches);

		foreach ($matches as $i)
		{
			foreach($i as $j)
			{
				$query=mysql_query("Select * from trending where tag_name='$j'") or die(mysql_error());
				$count=0;
				while($row=mysql_fetch_array($query,MYSQL_ASSOC))
					$count++;
				if($count==0)
				{
					$query=mysql_query("INSERT into trending (tag_name) values ('$j')");
				}				
				else
				{
					$query=mysql_query("UPDATE trending set tag_count=tag_count+1 where tag_name='$j'");					
				}
			}
			break;
		}

		
		$query = mysql_query("Select * from posts ORDER BY timestamp");
		$row = mysql_fetch_array($query,MYSQL_ASSOC);


		$ans=$_POST['restrict'];
		if($ans=="0")
		{
			$tagid=$_POST['tags'];
			$queryinsert=mysql_query("INSERT into notification (user_id,post_id,title) values ('$tagid','$curCount','$caption')") or die(mysql_error());
		}
		header("Location:feed.php");
	}
	else
	{
		echo mysql_error();
	}
}
?>