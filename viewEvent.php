<!DOCTYPE html>
<html lang="en">
	<head>
			<?php 
			session_start();
			$_SESSION['url'] = $_SERVER['REQUEST_URI'];
			
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
			<title>VENT| View Event</title>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<script type="text/javascript" src="_/js/jquery-2.2.0.js"></script>
			<link href="_/bootstrap/css/bootstrap.css" rel="stylesheet">
			<script type="text/javascript" src="_/js/jquery-2.2.0.js"></script>
			<link rel="stylesheet" href="_/css/mainstyle.css" type="text/css" />
			<script src="_/bootstrap/js/bootstrap.js"></script>

			<meta property="og:type"          content="website" />
			<meta property="og:title"         content="VENT" />
			<meta property="og:description"   content="All about this event" />



	</head>
	<body>
		<?php include('global/header.php');?>
			<div class="container-fluid viewEventContainer">
				<div class="row">
					<div class="col-md-12" id="viewEventImage">
							<?php
							 $q=$_GET['event'];
								include('dbconnect.php');
								if($conn){
								$sql="SELECT EventID,EventName,EventLocation,DAYNAME(StartDate) as day, MONTHNAME(StartDate) as month,DAY(StartDate) as daynum, StartTime,EventCost, EventImage, EventDesc FROM event WHERE EventID ='$q'";
								
								if(mysqli_query($conn,$sql)){
										$sqlResult=mysqli_query($conn,$sql);
										if(mysqli_num_rows($sqlResult)>0)
										{
											//acquires results for layout
											$row=mysqli_fetch_assoc($sqlResult);
											$pic=$row['EventImage'];
											echo "<div style=\"background:url('$pic') center center fixed no-repeat; \" id=\"viewEventImagePic\"></div>

											<div id=\"viewEventBanner\" class=\"container\">
												<h1>{$row['EventName']}</h1>
												<h4>{$row['day']}, {$row['month']} {$row['daynum']} {$row['StartTime']} </h4>
												<h3> {$row['EventLocation']}</h3>
											</div>";
										}
										mysqli_close($conn);

								}
							}

							?>
						
					</div>
					
				</div>
			</div>
			<div class="container">
					<div class="row" id="eventDetailsTop">
						<div class="col-md-6">
								<ul id="vievEventBtns">
									<li><a href="#" class=" fsharebtns btn btn-info btn">
						          <span class="glyphicon glyphicon-share"></span> Share
						        </a>

							        <!--leave this share section first
							        <div class="fb-share-button" data-href="viewEvent.php?event=<?php //echo $row['EventID'];?>" data-layout="button" data-mobile-iframe="true"></div>
							        <div id="fb-root"></div>
									<script>(function(d, s, id) {
									  var js, fjs = d.getElementsByTagName(s)[0];
									  if (d.getElementById(id)) return;
									  js = d.createElement(s); js.id = id;
									  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6";
									  fjs.parentNode.insertBefore(js, fjs);
									}(document, 'script', 'facebook-jssdk'));</script>-->
						     	</li>
						       <li>
						    <?php include('dbconnect.php');
						       $eventid=$_GET['event'];
						       $AccountNum=isset($_SESSION['AccountNum'])?$_SESSION['AccountNum']:"";
						      if($conn){
					 		//checks if the event is followed by the user
							 $sql="SELECT * FROM follow WHERE AccountNum='$AccountNum' AND EventID='$eventid'";
							 $query=mysqli_query($conn,$sql);

								//means the user like this 
							 if (mysqli_num_rows($query)>0){

							 		echo "<a title=\"Your following this\" value=\"{$eventid}\" class=\"btn btn-danger btn unfollow-click fsharebtns\">
							          <span class=\"glyphicon glyphicon-log-out\"></span> Unfollow
							        </a>";
							      
							     }

							  else
							  	//user doesnt like it yet
							  {
									echo "  <a title=\"Follow this\" value=\"{$eventid}\" class=\"btn btn-info follow-click btn fsharebtns\">
							          <span class=\"glyphicon  glyphicon-log-out\"></span> Follow
							        </a>";
							  }
							}
							else
							{
								die("Error establishing connection");
							}

					  
						?>
						</li>
						</ul>
					    </div>
					    <div class="col-md-6">
					    <ul id="viewEventBtnsRight">
					    <?php
							 $sql="SELECT * FROM guestlist WHERE EventID='$eventid' AND AccountNum='$AccountNum'";
							 $query=mysqli_query($conn,$sql);
							 if (mysqli_num_rows($query)<=0)
							 {
								 	echo "<li>
											<a  value=\"{$eventid}\" id=\"guestlist-add\" class =\"fsharebtns btn btn-info btn\">
									          <span class=\"glyphicon glyphicon-ok\"></span> I'm Going
									        </a>
											</li>";
							 }
							else{
									echo "<li>
								<a  value=\"{$eventid}\" id=\"guestlist-remove\" class =\"fsharebtns btn btn-danger btn\">
						          <span class=\"glyphicon glyphicon-remove\"></span>Cancel my Attendance
						        </a>
								</li>";
								}
							?>
						
						        <li>
						        <!-- Add Calendar Module date and time missing-->
								<?php
									$base="http://www.google.com/calendar/event?action=TEMPLATE&";
									$eventname="text=".$row['EventName']."&";
									$calendarLink=$base.$eventname."&dates=20131124T010000Z/20131124T020000Z&details={$row['EventDesc']}&location={$row['EventLocation']}";

								?>

						        <a target="_blank" href="<?php echo $calendarLink?>" class="fsharebtns btn btn-info btn">
						          <span class="glyphicon glyphicon-calender"></span> Add to my Calendar
						        </a>
						  
						        </li>


						        </ul>
						        


						</div>
						

					</div>
					<div class="row borders" id="eventDetailsSection">
							<div class="col-md-8 col-md-offset-2">
								<?php 
									$q=$_GET['event'];
								include('dbconnect.php');
								if($conn){
								$sql="SELECT EventID,EventName, EventLocation,DAYNAME(StartDate) as day, MONTHNAME(StartDate) as month,YEAR(StartDate) as year, DAY(StartDate) as daynum, StartTime,EventCost,EventDesc,event.OrganizerID,OrganizerName,Latitude,Longitude FROM event join organizer ON organizer.OrganizerID=event.OrganizerID WHERE EventID ='$q'";
								
								if(mysqli_query($conn,$sql)){
										$sqlResult=mysqli_query($conn,$sql);
										if(mysqli_num_rows($sqlResult)>0)
										{
											//acquires results for layout
											$row=mysqli_fetch_assoc($sqlResult);
											
											
												echo "<h3><b>Event Description</b></h3><p id=\"eventDescrip\"><br>{$row['EventDesc']}</p>

												<p> When<br>{$row['day']}, {$row['month']} {$row['daynum']} {$row['StartTime']}</p>
												<p>Where<br>{$row['EventLocation']} - <a href=\"#map\">View on Map</a></p>";
										}
										mysqli_close($conn);

								}
							}
								
					echo '</div>
					</div>
					<div class="row borders" id="organisorSection">
						<div class="col-md-8 col-md-offset-2">';
					echo "<h2> Organizer of Event : {$row['OrganizerName']}</h2>
								<ul>			
								<li>
									<a data-toggle=\"modal\"  class=\"fsharebtns1 orgMessage btn btn-info btn\">
						          <span class=\"glyphicon glyphicon-envelope\"></span> Message Organizer
						        </a>
						        <li>";
						        $orgID=$row['OrganizerID'];
						        $_SESSION['orgID']=$row['OrganizerID'];
						    
						  echo "<li>
						  			<a href=\"viewOrganizerProfile.php?orgID={$orgID}\" class=\" fsharebtns1 btn btn-info btn\">";
						    echo "<span class=\"glyphicon glyphicon-user\"></span> View Organizer's Profile
						        </a>
						        </li>
						        </ul>  
							</div>
					</div>";
					?>
					<script type="text/javascript" src="_/js/checkLoginOrgMessage.js">
						
					</script>
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
								<?php include('message/sendMessage.php');?>
	
					   	 </div>
					      </div>
					      
					    </div>
					 </div>





					<div class="row borders" id="bottomSection">
						<div id="map">
							

						</div>


						<div class="centered" style="padding:10px;">
							<h3 class="floatLeft"><?php echo $row['EventLocation']?></h3>
							<?php
								$lat=$row['Latitude'];
								$long=$row['Longitude'];
							?>
							<a class="btn floatRight btn-lg btn-primary" href="https://maps.google.com/?saddr=Current+Location&daddr=<?php echo $lat;?>,<?php echo $long;?>" target="_blank"> Navigate me there</a>

						</div>

					</div>
				
			</div>

			<script type="text/javascript" src="_/js/viewEvent.js"></script>
			<script type="text/javascript" src="_/js/follow.js"></script>
		
         	<script src="https://maps.googleapis.com/maps/api/js?callback=initMap"
        	async defer>
        	</script>
         	<script type="text/javascript">
         	
  					function initMap() {
  						//insert 
  						var LatLng={lat:<?php echo $lat;?>, lng: <?php echo $long;?>};

  						var mapDiv = document.getElementById('map');
  						var map = new google.maps.Map(mapDiv, {
						      center: LatLng,
						      zoom: 15,
						      scrollwheel: false,

						    });

					//marker
  						var marker = new google.maps.Marker({
					    position: LatLng,
					    map: map,
					  });
  					marker.setTitle('<?php echo $row['EventName']; ?>');

  					}


         	</script>

         	<script type="text/javascript" src="_/js/addToCalendar.js"></script>
		
		<?php include('global/footer.php'); ?>

	</body>
</html>