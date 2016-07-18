<?php
include 'dbconnect.php';
if(isset($_GET['postid']))
{
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Review </title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- for fontawesome icon css file -->
    <link href="css/font-awesome.min.css" rel="stylesheet">

    <!-- for content animate css file -->
    <link rel="stylesheet" href="css/animate.css"> 
    <link href='http://fonts.googleapis.com/css?family=Varela' rel='stylesheet' type='text/css'>
    <!-- main site css file -->
    <link href="structure.css" rel="stylesheet">
	<link href="http://www.cssscript.com/wp-includes/css/sticky.css" rel="stylesheet" type="text/css">
 	<link type="text/css" rel="stylesheet" href="css/style.css">
    <link type="text/css" rel="stylesheet" href="css/example.css">
  	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function()
	{
		$.get("countNot.php",
			function(count){
				$('#notification_count').html(count);
		});
	});
	function removeNumberNotification()
	{
		document.getElementById("notification_count").style.display="none";
		$.get(
			"setRead.php",
			function(data){
				$('#dropdown').html(data)
			});
	}
  function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result).width(150).height(200);
        };
      reader.readAsDataURL(input.files[0]);
      }
  }
  		$(function(){ 
        	$('.new-com-bt').click(function(event){    
            	$(this).hide();
            	$('.new-com-cnt').show();
            	$('#name-com').focus();
        	});

	        /* when start writing the comment activate the "add" button */
	        $('.the-new-com').bind('input propertychange', function() {
	           $(".bt-add-com").css({opacity:0.6});
	           var checklength = $(this).val().length;
	           if(checklength){ $(".bt-add-com").css({opacity:1}); }
	        });

	        /* on clic  on the cancel button */
	        $('.bt-cancel-com').click(function(){
	            $('.the-new-com').val('');
	            $('.new-com-cnt').fadeOut('fast', function(){
	                $('.new-com-bt').fadeIn('fast');
	            });
	        });

	        // on post comment click 
	        $('.bt-add-com').click(function()
	        {
	            var theCom = $('.the-new-com');

	            if( !theCom.val()){ 
	                alert('You need to write a comment!'); 
	            }else{ 
	                $.ajax({
	                    type: "POST",
	                    url: "addcomment.php",
	                    data: 'id='+60+'&comment='+theCom.val(),
	                    success: function(html){
	                        $('.new-com-cnt').hide('fast', function(){
	                            $('.new-com-bt').show('fast');
	                            $('.new-com-bt').before(html);  
	                        })
	                    }  
	                });
	            }
	        });
    	});
function cwRating(id,type,target){
	$.ajax({
		type:'POST',
		url:'updates.php',
		data:'id='+id+'&type='+type,
		success:function(msg)
        {
			if(msg == 'err')
            {
				alert('Some problem occured, please try again.');
			}
			else
			{
				$('#'+target).html(msg);
			}
		}
	});
	if(type==1)
		document.getElementById("like_button"+id).disabled = true;
	else
		document.getElementById("dislike_button"+id).disabled = true;
}
</script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<style> 
inputs:-webkit-input-placeholder {
    color: #b5b5b5;
}

inputs-moz-placeholder {
    color: #b5b5b5;
}

.inputs {
    width: 88%;
    padding: 15px 25px;
    font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
    font-weight: 400;
    font-size: 14px;
    color: #9D9E9E;
    text-shadow: 1px 1px 0 rgba(256, 256, 256, 1.0);
    background: #FFF;
    border: 1px solid #FFF;
    border-radius: 5px;
    box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.50);
    -moz-box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.50);
    -webkit-box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.50);
}

.inputs:focus {
    background: #DFE9EC;
    color: #414848;
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.25);
    -moz-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.25);
    -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.25);
    outline: 0;
}

.inputs:hover {
    background: #DFE9EC;
    color: #414848;
}
</style>
<script>

function addInput(divName) 
{
	alert("hello");
	var newDiv = document.createElement('div');
    var selectHTML = "";
    selectHTML="<select name='tags'>";
<?php
	$sql=mysql_query("Select * from users where role=1");
    while($result=mysql_fetch_array($sql,MYSQL_ASSOC))
    {
	   	?> 
	   	selectHTML +="<option value=\"<?php echo $result['id']; ?>\"><?php echo $result['user_name']; ?>";
	    selectHTML +="</options>";
	    <?php
    }
    ?>

    selectHTML += "</select>";
    alert(selectHTML);
    newDiv.innerHTML = selectHTML;
    document.getElementById(divName).appendChild(newDiv);

}
</script>

</head>
<body>
	<a class="one_star" href="javascript: submitRating(1, 5)">
	<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
	<div class="container-fluid">
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.html"><span>Fashion</span>Confession</a>
				</div>
				<div class="collapse navbar-collapse" id="myNavbar">
					<ul class="nav navbar-nav navbar-right">
						<li class="upload">
							<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content login-modal">
										<div class="modal-header login-modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title text-center" id="loginModalLabel">Upload image</h4>
										</div>
										<h4>Select files from your computer</h4>
<form action="upload.php" method="post" role="form" enctype="multipart/form-data" id="js-upload-form"  >
	<div class="form-inline">
		<div class="form-group">
              <input type="file" name="userFile" id="js-upload-files" onchange="readURL(this);"><br>
              <img id="blah" src="Images/lap.jpg"/><br><br>
		</div>
	</div>
	<textarea rows="1" name="caption"> Enter Caption...</textarea>
	<input type="radio" name="restrict" id="rad1" onclick="addInput('dynamicInput');" value="0">Private</input>
	<input type="radio" name="restrict" id="rad2" value="1">Public</input>
	
	 <br>
	  <div id="dynamicInput"></div>
	<input name="upload" type="submit" class="post"></input>
</form>

									</div>
								</div>            
							</div>
							<button class="btn btn-launch" data-toggle="modal" data-target="#loginModal">Upload</button>
						</li>
						<li class="dropdown">
							<span id="notification_count"></span>
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">
								<button type="button" id ="abc" class="btn btn-default btn-sm">
									<span class="glyphicon glyphicon-globe" id="displaynotification" onclick="removeNumberNotification()"></span>
								</button>
							</a>
							<ul id="dropdown" class="dropdown-menu">
								<li><a href="#"></a></li>
							</ul>
						</li>
						<li>
							<form id="searchForm" method="get" action="feed.php">
								<input type="text" name="tag" placeholder="Search...">
								<input type="submit" name="search" value="">
							</form>
						</li>
						<li>
							<button type="button" id="logout" class="btn1 btn-default btn-sm">
          <a href="logout.php"><span class="glyphicon glyphicon-off"></span></a>
        </button>

        				</li>
					</ul>
				</div>
			</div>
		</nav>
	</div>
<!-- ==================End header=============== -->

<!-- ==================start content body section=============== -->
<section id="contentbody">
	<div class="container">
		<div class="row">
			<div class=" col-sm-12 col-md-8 col-lg-8">
				<div class="row">
					<div class="leftbar_content">
						<h2>Recent Posts</h2>
<?php
$query = mysql_query("Select * from posts where post_id=".$_GET['postid']) or die(mysql_error());
if(isset($_GET['search']))
{
	while($row = mysql_fetch_array($query,MYSQL_ASSOC))
	{
		preg_match_all('/(#\w+)/', $row['caption'], $matches);
		foreach ($matches as $i)
		{
			foreach($i as $j)
			{
				if($_GET['tag']==$j)
				{
	echo '
	<div class="single_stuff wow fadeInDown">
		<div class="single_stuff_img"><a href="#"><img src='.$row['image_url'].' alt="img" width="100%" ></a></div>
			<div class="single_stuff_article">
				<div class="stuff_article_inner"><p>'.$row['caption'].'</p></div>
			</div>
		<p>
			<button type="button" id="like_button'.$row['post_id'].'" class="btn btn-default btn-sm" onclick="cwRating('.$row["post_id"].',1,\'like_count'.$row['post_id'].'\')"';
			$likeinfo = explode(',',$row['like_info']);
			for($i=0; $i<count($likeinfo);$i++)
				if($likeinfo[$i]==$_SESSION['user_id'])
					break;	
			if(count($likeinfo)!=$i)
				echo ' disabled ';	
			echo '
			>
				<span id="like_count'.$row['post_id'].'" class="glyphicon glyphicon-thumbs-up">'.$row['likes'].'</span> 
			</button>
			<button type="button" id="dislike_button'.$row['post_id'].'" class="btn btn-default btn-sm" onclick="cwRating('.$row["post_id"].',0,\'dislike_count'.$row['post_id'].'\')"';
			$dislikeinfo = explode(',',$row['dislike_info']);
			for($i=0; $i<count($dislikeinfo);$i++)
				if($dislikeinfo[$i]==$_SESSION['user_id'])
					break;	
			if(count($dislikeinfo)!=$i)
				echo ' disabled ';
			echo '>
				<span id="dislike_count'.$row['post_id'].'" class="glyphicon glyphicon-thumbs-down">'.$row['dislikes'].'</span> 
			</button>
		</p>
		<div class="stars">
			<form action="">
				<input class="star star-5" id="star-5-2" type="radio" name="star"/>
				<label class="star star-5" for="star-5-2"></label>
				<input class="star star-4" id="star-4-2" type="radio" name="star"/>
				<label class="star star-4" for="star-4-2"></label>
				<input class="star star-3" id="star-3-2" type="radio" name="star"/>
				<label class="star star-3" for="star-3-2"></label>
				<input class="star star-2" id="star-2-2" type="radio" name="star"/>
				<label class="star star-2" for="star-2-2"></label>
				<input class="star star-1" id="star-1-2" type="radio" name="star"/>
				<label class="star star-1" for="star-1-2"></label>
			</form>
		</div>
		<div class="comment_box">';
		$query1=mysql_query("Select * from comments where post_id=".$_GET['postid']." ORDER BY timestamp") or die(mysql_error());
		while($row1=mysql_fetch_array($query1,MYSQL_ASSOC))
		{
			$result=mysql_query("Select user_name from users where id=".$_SESSION['user_id']);
			$row2=mysql_fetch_array($result,MYSQL_ASSOC);
  			echo 
    		'<div class="cmt-cnt">
				<div class="thecom">
	        		<h5>'.$row2['user_name'].' 
					</h5><span  class="com-dt">'.$row1['timestamp'].'</span>
	        		<br/>
	       			<p>'.$row1['comment'].'</p>
	    		</div>
			</div>';
		}
		
	    echo '
	    	<div class="new-com-bt">
    		    <span>Write a Review ...</span>
    		</div>
			<div class="new-com-cnt">
			    <textarea id="'.$row['post_id'].'" class="the-new-com"></textarea>
			    <div class="bt-add-com">Post comment</div>
			    <div class="bt-cancel-com">Cancel</div>
			</div>
			<div class="clear"></div>
    		</div>
	</div>';					
				}
			}
			break;
		}
	}
	
}
else
{
while($row = mysql_fetch_array($query,MYSQL_ASSOC))
{
	$sql = mysql_query("Select user_name from users where id=".$row['user_id']) or die(mysql_error());	
	$res = mysql_fetch_array($sql,MYSQL_ASSOC) ;

	echo '
	<div class="single_stuff wow fadeInDown">
		<div class="single_stuff_img"><a href="#"><img src='.$row['image_url'].' alt="img" width="100%" ></a></div>
			<div class="single_stuff_article">
				<h2><a href="single_page.html">'.$res['user_name'].'</a></h2>
				<div class="stuff_article_inner"><p>'.$row['caption'].'</p></div>
			</div>
		<p>
			<button type="button" id="like_button'.$row['post_id'].'" class="btn btn-default btn-sm" onclick="cwRating('.$row["post_id"].',1,\'like_count'.$row['post_id'].'\')"';
			$likeinfo = explode(',',$row['like_info']);
			for($i=0; $i<count($likeinfo);$i++)
				if($likeinfo[$i]==$_SESSION['user_id'])
					break;	
			if(count($likeinfo)!=$i)
				echo ' disabled ';	
			echo '
			>
				<span id="like_count'.$row['post_id'].'" class="glyphicon glyphicon-thumbs-up">'.$row['likes'].'</span> 
			</button>
			<button type="button" id="dislike_button'.$row['post_id'].'" class="btn btn-default btn-sm" onclick="cwRating('.$row["post_id"].',0,\'dislike_count'.$row['post_id'].'\')"';
			$dislikeinfo = explode(',',$row['dislike_info']);
			for($i=0; $i<count($dislikeinfo);$i++)
				if($dislikeinfo[$i]==$_SESSION['user_id'])
					break;	
			if(count($dislikeinfo)!=$i)
				echo ' disabled ';
			echo '>
				<span id="dislike_count'.$row['post_id'].'" class="glyphicon glyphicon-thumbs-down">'.$row['dislikes'].'</span> 
			</button>
		</p>
		<div class="stars">
			<form action="">
				<input class="star star-5" id="star-5-2" type="radio" name="star"/>
				<label class="star star-5" for="star-5-2"></label>
				<input class="star star-4" id="star-4-2" type="radio" name="star"/>
				<label class="star star-4" for="star-4-2"></label>
				<input class="star star-3" id="star-3-2" type="radio" name="star"/>
				<label class="star star-3" for="star-3-2"></label>
				<input class="star star-2" id="star-2-2" type="radio" name="star"/>
				<label class="star star-2" for="star-2-2"></label>
				<input class="star star-1" id="star-1-2" type="radio" name="star"/>
				<label class="star star-1" for="star-1-2"></label>
			</form>
		</div>
		<div class="comment_box">';
		$query1=mysql_query("Select * from comments where post_id=".$_GET['postid']." ORDER BY timestamp") or die(mysql_error());
		while($row1=mysql_fetch_array($query1,MYSQL_ASSOC))
		{
			$result=mysql_query("Select user_name from users where id=".$_SESSION['user_id']);
			$row2=mysql_fetch_array($result,MYSQL_ASSOC);
  			echo 
    		'<div class="cmt-cnt">
				<div class="thecom">
	        		<h5>'.$row2['user_name'].' 
					</h5><span  class="com-dt">'.$row1['timestamp'].'</span>
	        		<br/>
	       			<p>'.$row1['comment'].'</p>
	    		</div>
			</div>';
		}
		
	    echo '
	    	<div class="new-com-bt">
    		    <span>Write a Review ...</span>
    		</div>
			<div class="new-com-cnt">
			    <textarea id="'.$row['post_id'].'" class="the-new-com"></textarea>
			    <div class="bt-add-com">Post comment</div>
			    <div class="bt-cancel-com">Cancel</div>
			</div>
			<div class="clear"></div>
    		</div>
	</div>';
}
}
?>
					</div>
				</div>  
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4">
				<div class="row">
					<div class="rightbar_content">
						

						<div class="single_blog_sidebar wow fadeInUp">
							<h2>Popular Tags</h2>  
							<ul class="poplr_tagnav">
							<?php
								$i=0;
								$s=mysql_query("Select * from trending ORDER BY tag_count DESC") or die(mysql_error());
								while($row=mysql_fetch_array($s,MYSQL_ASSOC))
								{
									echo '<li><a href="feed.php?tag=%23'.substr($row['tag_name'], 1).'&search=">'.$row['tag_name'].'</a></li>';									
									$i++;
									if($i==7)
										break;
								}

							?>
							</ul>
						</div>
						<!--Start experts-->
                
                <div class="single_blog_sidebar wow fadeInUp">
                <h2>Our Experts...</h2>  
                <ul class="middlebar_nav wow">
                  <li>
                    <a href="https://en.wikipedia.org/wiki/Tom_Ford" class="mbar_thubnail"><img alt="img" src="img/expert1.jpg"></a>
                    <a href="https://en.wikipedia.org/wiki/Tom_Ford" class="mbar_title">Tom Ford</a>
                  </li>
                   <li>
                    <a href="https://en.wikipedia.org/wiki/Stella_McCartney" class="mbar_thubnail"><img alt="img" src="img/expert2.jpg"></a>
                    <a href="https://en.wikipedia.org/wiki/Stella_McCartney" class="mbar_title">Stella</a>
                  </li>
                   <li>
                    <a href="https://en.wikipedia.org/wiki/Manish_Malhotra" class="mbar_thubnail"><img alt="img" src="img/expert3.jpg"></a>
                    <a href="https://en.wikipedia.org/wiki/Manish_Malhotra" class="mbar_title">Manish Malhotra</a>
                  </li>
                   <li>
                    <a href="https://en.wikipedia.org/wiki/Donatella_Versace" class="mbar_thubnail"><img alt="img" src="img/expert4.jpg"></a>
                    <a href="https://en.wikipedia.org/wiki/Donatella_Versace" class="mbar_title">Donatella Versace</a>
                  </li>
                </ul>
                </div>

					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<footer id="footer">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="footer_inner">
					<p class="pull-left">All Rights Reserved <a href="#"></a></p>
					<p class="pull-right">Developed By <a href="http://www.wpfreeware.com" rel="nofollow">Deadpool</a></p>
				</div>
			</div>
		</div>
	</div>
</footer>
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script> 
<!-- For content animatin  -->
<script src="js/wow.min.js"></script>
<!-- custom js file include -->
 <script src="js/custom.js"></script>
  </body>
</html>
<?php
}
else if(isset($_SESSION['user_id']))
{
	header("Location:feed.php");
}
else
{
	header("Location:index.php");	
}
?>