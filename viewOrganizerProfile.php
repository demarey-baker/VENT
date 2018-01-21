<!DOCTYPE html>
<html lang="en">
	<head>
			<?php 
			session_start();
			$_SESSION['url'] = $_SERVER['REQUEST_URI'];
		
			//prevent error in case user changes the query string
			if(!isset($_GET['orgID'])){
				echo "<script>window.location.href='error.php'</script>";
			}
			?>
			<title>VENT|View Organizer Profile</title>
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
									<?php
										//connects to database
										include('dbconnect.php');

										if($conn){
										//if sucessful connected
										
										//organizer id
										$getOrg=$_GET['orgID'];

										$sql="SELECT * FROM organizer WHERE OrganizerID ='$getOrg'";
										$result=mysqli_query($conn,$sql);
										$row=mysqli_fetch_assoc($result);
										$OrganizerName=$row['OrganizerName'];
										$OrganizerDesc=$row['OrganizerDesc'];
										$FLink=$row['FLink'];
										$TLink=$row['TLink'];
										echo "<h2 class=\"floatLeft\">{$OrganizerName} 's Profile</h2>";


									}
									else
									{
										die("Error establishing a database connection");
									}
									
									?>
									<ul>
										<?php
											
										//user cannot follow or message themself because its absurd
										 if((!isset($_SESSION['Login']))){
										 	//if not logged in
										 			echo"<ul>
															<a data-toggle=\"modal\" data-target=\"#messageBox\" class=\"fsharebtns1 floatRight cusBtn btn btn-warning btn\">
													          <span class=\"glyphicon glyphicon-envelope\"></span> Message Me
													         </a>
													        
															
													 		<a href=\"\" class=\"btn btn-primary cusBtn floatRight\" id=\"follow-user\"> Follow  Me </a>
											 		</ul>";

										 	}
											else
											{
												$curr=$_SESSION['AccountNum'];
												$check="SELECT OrganizerID FROM user WHERE AccountNum='$curr'";
												$result=mysqli_query($conn,$check);
												$show=mysqli_fetch_assoc($result);
											

												if($show['OrganizerID']!=$row['OrganizerID'])
												{
													echo "<ul><a data-toggle=\"modal\" data-target=\"#messageBox\" class=\"fsharebtns1 floatRight  cusBtn btn btn-warning btn\">  <span class=\"glyphicon glyphicon-envelope\"></span>Message Me</a>";
												
												 		

												 		 $AccountNum=isset($_SESSION['AccountNum'])?$_SESSION['AccountNum']:"";
												      if($conn){
											 		//checks if the event is followed by the user
													 $sql="SELECT * FROM followuser WHERE AccountNum='$AccountNum' AND FollowAccountNum='$getOrg'";
													 $query=mysqli_query($conn,$sql);

														//means the user following this user
													 if (mysqli_num_rows($query)>0){

													 		echo "<a title=\"Your following this user\" id=\"unfollow-user\" value=\"{$getOrg}\" class=\"btn btn-danger cusBtn floatRight btn fsharebtns\">
													          <span class=\"glyphicon glyphicon-log-out\"></span> Unfollow me
													        </a>";
													      
													     }

													  else
													  	//user not following this user
													  {
															echo "  <a title=\"Follow this\" id=\"follow-user\" value=\"{$getOrg}\" class=\"btn btn-info btn cusBtn floatRight fsharebtns\">
													          <span class=\"glyphicon  glyphicon-log-out\"></span> Follow me
													        </a>";
													  }
													}
															 		
													echo "</ul>";




											 	}

											}

												      

											
										 	?>

									</ul>
						</div>
						<!--Modal Section for Messasing-->
						<div class="modal fade" id="messageBox" role="dialog">
					    <div class="modal-dialog modal-lg">
					    
					      <!-- Modal content-->
					      <div class="modal-content" style="height:400px;">
					        <div class="modal-header">
					          <button type="button" class="close" data-dismiss="modal">&times;</button>
					          <h2 class="modal-title">Message <?php echo $row['OrganizerName']; ?></h2>
					        </div>
					       <div class="modal-body">
						       	<form method="post">
									<div class="form-group">
									  <h4 for="message">Message</h4>
									  <textarea class="form-control" name="message" rows="8" id=""><?php 
										  	if(isset($_POST['message'])) 
										  		echo trim($_POST['message']); 
										  ?></textarea>
									</div>
									
									<input type="submit" class="btn btn-primary floatRight" value="Send Message">
								</form>
	
					   	 </div>
					   	 <?php include('message/sendMessage.php');?>
					      </div>
					      
					    </div>
					 </div>

					 
								
						<div id="OrgProPills">
							<div class="col-md-4">
								<div id="OrgProPillsPreview">
										<img src="<?php echo $row['OrganizerImage']; ?>" id="preview"/>
								</div>
							
							<ul class="nav nav-pills nav-stacked ">
							  <li class="active"><a href="#upcoming" data-toggle="pill">Upcoming Events</a></li>
							  <li><a href="#pastEvents" data-toggle="pill">Past Events</a></li>
							  <li><a href="#about" data-toggle="pill">About <?php echo $OrganizerName;?></a></li>
							
							</ul>
							</div>
						
						<div class="tab-content col-md-8">
						        <div class="tab-pane active" id="upcoming">
						    
								     <?php include ('organizer/organizerUpcomingEvent.php');?>


						      

						        </div>
						        <div class="tab-pane" id="pastEvents">
						             <?php include ('organizer/organizerPastEvents.php');?>

						        </div>
						        <div class="tab-pane" id="about">
						        		<div id="OrgDescBox">
						        		<?php
						        			echo "<p>{$OrganizerDesc}</p>";

						        		?>
						        		</div>
						        		<h4>Find out more about me below </h4>
						        		<a target="_blank" href="https:<?php echo $FLink;?>"><img src="organizer/fb-logo.png" class="socialLnksIcons" /></a>
						        		<a target="_blank" href="https:<?php echo $TLink; ?>"><img src="organizer/twitter-logo.png" class="socialLnksIcons" /></a>


						        </div>
						</div><!-- tab content -->
						</div>



			</div>

			<script type="text/javascript" src="_/js/follow.js"></script>

		
		<?php include('global/footer.php'); ?>

	</body>
</html>