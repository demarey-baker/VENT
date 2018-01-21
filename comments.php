<!DOCTYPE html>
<html lang="en">
	<head>
			<?php 

				//convert time to readable format
				 function format_date($str) {
				            $convertDate= date("M j, Y g:ia",strtotime($str));        

				        return $convertDate;
				} 
				//function to check against sql injections
				function safe($variable,$conn) {
					$variable = mysqli_real_escape_string($conn,trim($variable)); 
						return $variable;
				}

			session_start();
			$_SESSION['url'] = $_SERVER['REQUEST_URI'];
			$url=$_SESSION['url'];
			
			if(!isset($_GET['event'])){
				echo "<script>window.location.href='error.php'</script>";
			}else if(isset($_GET['event']))
			{
				include('dbconnect.php');
				if($conn){
					$q=$_GET['event'];
					$result=mysqli_query($conn," SELECT EventID FROM event WHERE EventID='$q'");
					if(mysqli_num_rows($result)<=0){
						echo "<script>window.location.href='error.php'</script>";
					}
				}
			}
			

			?>
			<title>VENT|Comments\</title>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<script type="text/javascript" src="_/js/jquery-2.2.0.js"></script>
			<link href="_/bootstrap/css/bootstrap.css" rel="stylesheet">
			<script type="text/javascript" src="_/js/jquery-2.2.0.js"></script>
			<link rel="stylesheet" href="_/css/mainstyle.css" type="text/css" />
			<script src="_/bootstrap/js/bootstrap.js"></script>

	</head>
	<body>
		<?php include('global/header.php');?>
		<div class="container-fluid">
				<?php
					include('dbconnect.php');
					$eventid=$_GET['event'];
					$result=mysqli_query($conn,"SELECT EventName, EventImage from event WHERE EventID='$eventid'");
					$fetch=mysqli_fetch_assoc($result);
				?>
				<div class="row" id="commentPic" style="background:url(<?php echo $fetch['EventImage']?>) center center fixed no-repeat;">

				</div>
				
				
			</div>
			

			<div class="container" id="comment_section" >
				<?php 
					if($conn){
						$result=mysqli_query($conn,"SELECT DISTINCT user.ProfilePicBig,user.FirstName, user.LastName,comment.Comment, comment.CommentTime FROM comment join user ON user.AccountNum=comment.AccountNum WHERE EventID='$eventid'");
							
						}

				?>
				<div class="row">
					<h2>Comments</h2><hr/>
						<div class="col-md-7">
							
							<div id="comment_area">
								<?php 
								
								if(mysqli_num_rows($result)>0){

								while($row=mysqli_fetch_assoc($result)){
										$fullname=$row['FirstName']. " ". $row['LastName'];
										$time=format_date($row['CommentTime']);
											echo "<div class='eachComment'>
												<div class='img_part'>
														<img src='{$row['ProfilePicBig']}'/>
												</div>
												<div class='text-part'>
													<label>{$fullname}</label>
													<span class='floatRight'>{$time}</span>
													<p>{$row['Comment']}</p>
												</div>
											</div>";
										}
								}
								else{
									echo "<p>No commments</p>";
								}
								?>
								<?php if(isset($_SESSION['Login'])){?>
								<form method="post">
									<div class="text-part">
										<div class="form-group">
											<textarea class="form-control" name="Comment" placeholder="Post a comment"></textarea>
										</div>
										<button class="floatRight btn btn-primary" type="submit" name="commentBtn">Post Comment</button> 
										</div>

								</form>
								<?php }?>
								<?php
											


									if(isset($_POST['commentBtn']))
									{
											include('dbconnect.php');
												if($conn){
													$AccountNum=$_SESSION['AccountNum'];
													$comment=safe($_POST['Comment'],$conn);
						
													$query=mysqli_query($conn,"INSERT INTO `vent`.`comment` (`CommentID`, `EventID`, `AccountNum`, `Comment`, `CommentTime`) VALUES (NULL, '$eventid', '$AccountNum', '$comment', NOW());");

													if($query)
													{
														echo "<script>alert('Posted'); window.location.href='$url';</script>";
													}
													else
													{
														echo "Error your comment cannot be posted at this time";
													}


												}
												else
												{

												}
									}
								?>

							</div>
						</div>
					
				</div>
				
			</div>
		
		<?php include('global/footer.php'); ?>

	</body>
</html>