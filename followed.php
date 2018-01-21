<!DOCTYPE html>
<html lang="en">
	<head>
			<?php 
			//starts session
			session_start();
			//ensure only logged in users have access to this page
			if(!isset($_SESSION['Login']))  echo "<script> window.location.href='error.php';</script>";
			?>
			<title>VENT|Following</title>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<script type="text/javascript" src="_/js/jquery-2.2.0.js"></script>
			<link href="_/bootstrap/css/bootstrap.css" rel="stylesheet">
			<link href="_/jquery-ui-1.11.4.custom/jquery-ui.min.css" rel="stylesheet">
			<link rel="stylesheet" href="_/css/mainstyle.css" type="text/css" />
			<script type="text/javascript" src="_/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
			<script src="_/bootstrap/js/bootstrap.js"></script>

	<style>
			.nav-pills > li > a{
				       color:#232323;
				    }
				.nav-pills > li.active > a, .nav-pills > li.active > a:hover, .nav-pills > li.active > a:focus {
				    color:##9d9d9d;
				    background-color:#101010;
				    border-right:5px solid #595959;
				    }

	</style>

			


	</head>
	<body>
		<?php include('global/header.php');?>
		<div class="container touchdown">
			<div class="row bottomBorder">
				<div class="col-md-10">
					<h1>Following</h1>
				</div>
			</div>
		
			<div class="row" id="manageEventDiv">
					
						<ul class="nav nav-pills nav-stacked col-md-3">
							  <li class="active"><a href="#following" data-toggle="pill">Followed Events</a></li>
						</ul>
						
						<div class="tab-content col-md-9">
						        <div class="tab-pane active" id="following">
						           
								
						            <?php 
						            //connect to database
						            	include('dbconnect.php');
						            	//if connected
										if($conn){
											//current user
											$currUser=$_SESSION['AccountNum'];

											$Eventsql="SELECT follow.EventID,EventName,DAYNAME(StartDate) as day, MONTHNAME(StartDate) as month,DAY(StartDate) as daynum, StartTime FROM event join follow WHERE event.EventID=follow.EventID AND follow.AccountNum='$currUser'";
								
											if(mysqli_query($conn,$Eventsql))
											{
												$queryResult=mysqli_query($conn,$Eventsql);
												if(mysqli_num_rows($queryResult)>0){

													while($row=mysqli_fetch_assoc($queryResult))
													{
														//display each event that is followed by this specific user
														echo "
														 <div class=\" eachManageEvent borders1\">
														<h3>{$row['EventName']}</h3>
														<h4>{$row['day']}, {$row['month']} {$row['daynum']} {$row['StartTime']}</h4>

														
															<ul>
														<li><a value=\"{$row['EventID']}\"class=\"pointer unfollow-click\" ><span class=\"glyphicon  glyphicon-thumbs-down\" ></span>
															<span style=\"font-size:15px;\">Unfollow</span>
															</a>
														</li>
													</ul>
													 </div>";
													}
													
												}
												else
												{
													echo "You currently aren't following any events.";
												}


											}
											else
											{
												echo "Error retrieving information from database, Please try again!";
											}


											}

						            ?>
						        </div>
						        
						</div><!-- tab content -->





			</div>
		</div>
		<?php include('global/footer.php'); ?>

		<script type="text/javascript" src="_/js/follow.js">
			/*
				 This script handles the ajax request to follow of unfollow an event
			*/
		</script>
	</body>
</html>