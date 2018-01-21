<!DOCTYPE html>
<html lang="en">
	<head>
			<?php 
			session_start();
			//ensures user is loggged in before they can access this page
			if(!isset($_SESSION['Login']))  echo "<script> window.location.href='index.php';</script>";
			$_SESSION['url'] = $_SERVER['REQUEST_URI']; 

			?>
			<title>VENT|Organizer Profile</title>
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
			<div class="container touchdown">
						<div class="row bottomBorder">
									<h2 class="floatLeft">
									<?php 
										//current user
										$currUser=$_SESSION['AccountNum'];

										//connects to database
										include('dbconnect.php');
											if($conn){
												$result=mysqli_query($conn,"SELECT user.AccountNum,organizer.OrganizerName,user.FirstName FROM organizer join user ON user.AccountNum=organizer.OrganizerID WHERE AccountNum='$currUser'");
												
												//checks if user is an organizer
												if(mysqli_num_rows($result)>0){
														$row=mysqli_fetch_assoc($result);
															echo (empty($row['OrganizerName']))?$row['FirstName']:$row['OrganizerName'];
															echo "'s Profile";
															
															//value to pass to javascript for showing Organizer Section
															$showDivUserExists ='true';
												}
													//not organizer yet
												else
												{
													$nameQuery=mysqli_query($conn,"SELECT FirstName FROM user WHERE AccountNum='$currUser'");
													$fetch=mysqli_fetch_assoc($nameQuery);

													echo $fetch['FirstName'],", you're not yet an organizer";

													//value to pass to javascript for showing Organizer Section
													$showDivUserExists ='false';
												}
													mysqli_close($conn);
												}
												//didnt connect to database
											else
											{
												echo "Organizer";
											}
									?>
									 </h2>
						</div>
						<script type="text/javascript">
								$(function(){
									//check if user is already a organizer
									var val=<?php echo $showDivUserExists?>;
									
								
									
									if(val){
										//if user is an organizer display appropriate fields
										$("#organiserSectionNon").remove();
										$(".loading-div").remove();
										$("#organizerSection").removeClass("hidden");
									}else
									{
										//otherwise show fields for non-organizers
										$("#organizerSection").remove();
										$(".loading-div").remove();
										$("#organiserSectionNon").removeClass("hidden");
									}

								});
						</script>
						
						<div class="row hidden" id="organizerSection">
								<h3 class="btn btn-primary tips">
  								Tip : Click in the input boxes to change information about yourself. If you dont have any information to enter just leave it empty </h3>	
								<?php include('organizer/grabOrganizerInfo.php');?>
								
						</div>
						<div class="loading-div"><img src="event/eventImages/ajax-loader.gif"/></div>
						
						<div class="row hidden" id="organiserSectionNon">
								<div class="col-md-8 col-md-offset-2">
									<a href="createEvent.php" class="btn floatRight onTop createEventBtn btn-success indexcusBtn center">Create Event</a>
									<img class="img-responsive" id="orgBannerImage" src="organizer/organizerImages/Eventplanning.jpg"/>
									<h3>Join the thousands of users that are using Vent to organise, manage and promote their events</h3>
								</div>

						</div>


			</div>
			
			<?php include('global/footer.php') ?>	
			<script type="text/javascript" src="_/js/tips.js"></script>
	</body>
</html>