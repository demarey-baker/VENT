<!DOCTYPE html>
<html lang="en">
	<head>
			<?php 
			//start session
			session_start();
			
			//handles error in case user changes the query string
			if(!isset($_GET['event'])){
				echo "<script>window.location.href='error.php'</script>";
			}
			?>
			<title>VENT|Edit Event</title>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<script type="text/javascript" src="_/js/jquery-2.2.0.js"></script>
			<link href="_/bootstrap/css/bootstrap.css" rel="stylesheet">
			<link href="_/jquery-ui-1.11.4.custom/jquery-ui.min.css" rel="stylesheet">
			<script type="text/javascript" src="_/js/jquery-2.2.0.js"></script>
			<link rel="stylesheet" href="_/css/mainstyle.css" type="text/css" />
			<script type="text/javascript" src="_/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
			<script src="_/bootstrap/js/bootstrap.js"></script>
			<link rel="stylesheet" href="_/jquery-timepicker-1.3.2/jquery.timepicker.min.css" type="text/css" />
			<script type="text/javascript" src="_/jquery-timepicker-1.3.2/jquery.timepicker.min.js "></script>

			<!--Google Maps API and location picker-->
			<script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>
    		<script src="_/jquery-locationpicker-plugin-master/dist/locationpicker.jquery.js"></script>
			
			


	</head>
	<body>
		<?php include('global/header.php');?>
		<div class="container touchdown">
				<div class="row">
					<div class="col-md-12">
						<h1>Edit Event</h1>
					</div>

				</div>
			<div class="row">
				
				<div class="col-md-12">
					<h2 id="evtDetails">Event Details</h2>
					<div class="col-md-7">
						<h2 class="btn btn-primary tips" style="width:100%;">
  								Note : You must submit a new image if your updating the event.. 
  						</h2>
						<form method="post" role="form" enctype="multipart/form-data">
							<div class="form-group">
						        <?php 
						        	//connection to database
						        	include('dbconnect.php');
						        	//if sucessful
						        	if($conn)
						        	{
						        			if(isset($_GET['event']))
						        			{
						        				//populate edit fields 

										        				$eventid=$_GET['event'];
										        				$query="SELECT * FROM event WHERE EventID='$eventid'";

										        				$result=mysqli_query($conn,$query);
										        				
										        				$row=mysqli_fetch_assoc($result);

										        				$eventNameValue=(isset($_POST['eventName']))?$_POST['eventName']:$row['EventName'];
										        				
										        				echo "<h4 for=\"eventTitle\">Event Name</h4>
										       					 	<input type=\"text\" class=\"form-control\" required name=\"eventName\"  value=\"{$eventNameValue}\" id=\"eventTitle\" placeholder=\"Keep it Simple\">";


										       					$eventTypeValue=(isset($_POST['eventType']))?$_POST['eventType']:$row['EventType'];
								


										       					echo "<div class=\"form-group\">
														        <h4 for=\"EventType\">Event Type</h4>
														       <select id=\"EventType\" name=\"eventType\" class=\"form-control\">";
														       		 //options
														       echo "<option value=\"1\"";
														       		  if($eventTypeValue==1) echo "selected =\"selected\"";
														       echo ">Camp, Trip or Retreat
														       		  </option>";

														       echo "<option value=\"2\"";
														       		  if($eventTypeValue==2) echo "selected =\"selected\"";
														       echo ">Social Gathering
														       		  </option>";

														       echo "<option value=\"3\"";
														       		  if($eventTypeValue==3) echo "selected =\"selected\"";
														       echo ">Dance or Party
														       		  </option>";

														       echo "<option value=\"4\" ";
														       		  if($eventTypeValue==4) echo "selected =\"selected\" ";
														       echo ">Fair or Festival
														       		  </option>";

														       	echo "<option value=\"5\"";
														       		  if($eventTypeValue==5) echo "selected =\"selected\"";
														       echo ">Dinner or Gala
														       		  </option>";
														       echo "<option value=\"6\"";
														       		  if($eventTypeValue==6) echo "selected =\"selected\"";
														       echo ">Seminar
														       		  </option>";

														       echo "<option value=\"7\"";
														       		  if($eventTypeValue==7) echo "selected =\"selected\"";
														       echo ">Trade show or Exposition
														       		  </option>";

														       	echo "<option value=\"8\"";
														       		  if($eventTypeValue==8) echo "selected =\"selected\"";
														       echo ">Concert or Performance
														       		  </option>
														       </select>
														       </div>";


													$eventLocationValue=(isset($_POST['eventLocation']))?$_POST['eventLocation']:$row['EventLocation'];
													$latValue=(isset($_POST['lat']))?$_POST['lat']:$row['Latitude'];
													$longValue=(isset($_POST['long']))?$_POST['long']:$row['Longitude'];


													  echo "<div>
											                    <div class=\"form-group\">
											                        <h4 for=\"Location\" class=\"control-label\">Location</h4>

											                            <input type=\"text\" name=\"eventLocation\"   value=\"{$eventLocationValue}\" required class=\"form-control\" id=\"us2-address\"/>";
											                       
											                    echo '</div>
									                 
											                    <div id="us2" style="width: 100%; height: 400px;"></div>
											                    <div class="clearfix">&nbsp;</div>
											                    <div class="m-t-small">
											               
											                        <div class="col-sm-1">
											                            <input type="hidden" name="lat" value="{$latValue}"class="form-control" id="us2-lat" />
											                        </div>
											   

											                        <div class="col-sm-1">
											                            <input type="hidden" value="$longValue" name="long" class="form-control" id="us2-lon" />
											                        </div>
											                    </div>
											                    <div class="clearfix"></div>
					            						</div>';


												$eventStartDateValue=isset($_POST['startDate'])?$_POST['startDate']:$row['StartDate'];

												echo " <div class=\"row\">

											    <div class=\"control-group col-md-5\">
											        <h4 for=\"date-picker-2\" class=\"control-label\">Starting Date</h4>
											        <div class=\"controls\">
											            <div class=\"input-group\">
											                <input id=\"date-picker-2\" required value=\"{$eventStartDateValue}\" type=\"text\" name=\"startDate\" class=\"date-picker form-control\" />
											                <label for=\"date-picker-2\" class=\"input-group-addon btn\"><span class=\"glyphicon glyphicon-calendar\"></span>
											                </label>
											            </div> 
											        </div>
											    </div>";

											    $eventStartTimeValue=isset($_POST['startTime'])?$_POST['startTime']:$row['StartTime'];

											     echo "<div class=\"col-md-5 col-md-offset-1\">
												    <h4 for=\"time\">Starts</h4>
												        <input type=\"text\" required value=\"{$eventStartTimeValue}\" name=\"startTime\" id=\"timepicker1\" class=\"timepicker form-control\" id=\"time\" placeholder=\"From\">  	
											    </div>";

											    $eventEndDateValue=isset($_POST['endDate'])?$_POST['endDate']:$row['EndDate'];

											    echo "<div>
											   		<div class=\"control-group col-md-5\">
											        <h4 for=\"date-picker-3\" class=\"control-label\">Ending Date</h4>
											        <div class=\"controls\">
											            <div class=\"input-group\">
											                <input id=\"date-picker-3\" required value=\"{$eventEndDateValue}\" name=\"endDate\" type=\"text\" class=\"date-picker form-control\" />
											                <label for=\"date-picker-3\" class=\"input-group-addon btn\"><span class=\"glyphicon glyphicon-calendar\"></span>
											                </label>
											            </div>
											            
											        </div>
											    </div>";

											    $eventEndTimeValue=isset($_POST['startTime'])?$_POST['endTime']:$row['EndTime'];

											    echo "<div class=\"col-md-5 col-md-offset-1\">
												    <h4 for=\"time\">Ends</h4>
												        <input type=\"text\" id=\"timepicker2\" required value=\"${eventEndTimeValue}\" name=\"endTime\" class=\"form-control\" id=\"time\" placeholder=\"From\">
													    </div>
													   </div>
													   </div>";




											    echo "<div class=\"row\">
											   		 <div class=\"col-md-8 form-group\">
												    	 <h4 for=\"eventPic\">Event Image</h4>
												    	  	 <div id=\"EventPic\">
												    	 	<img src=\"{$row['EventImage']}\" id=\"preview\"/>
															<input type=\"file\"  required id=\"imgFile\" name=\"uploadedImage\">

												    	 </div>
												    	</div>
											    	</div>";

													$eventDescValue=isset($_POST['eventDesc'])?$_POST['eventDesc']:$row['EventDesc'];
													echo " <div class=\"form-group\">
																  <h4 for=\"evtDesc\">Event Description</h4>
																  <textarea class=\"form-control\" name=\"eventDesc\" rows=\"8\" id=\"evtDesc\">{$eventDescValue}</textarea>
														</div>";

													$eventCostValue=isset($_POST['eventCost'])?$_POST['eventCost']:$row['EventCost'];						

													echo "<div>
															    <h4 for=\"costEvent\">Cost</h4>
															        <input data-toggle=\"tooltip\"  type=\"text\" class=\"form-control\" id=\"costEvent\" value=\"{$eventCostValue}\" name=\"eventCost\" title=\"If the event is free insert $0.00\" placeholder=\"Cost of Event\"> 
															      
																</div>";
																
											
													echo "<div class=\"checkbox\" >
													  <label><input type=\"checkbox\" id=\"showLinks\" value=\"\">Include links to other social media</label>
														</div>
															<div class=\"hidden\" id=\"sociaLinks\">
																 <div class=\"form-group\">
														        <h4 for=\"Twitter\">Twitter</h4>
														        <input type=\"text\" name=\"tLInk\" class=\"form-control\" id=\"Twitter\" placeholder=\"Paste link here\">
														    	</div>
														    	<div class=\"form-group\">
														        <h4 for=\"fceBook\">Facebook</h4>
														        <input type=\"text\" name=\"tLink\" class=\"form-control\" id=\"fceBook\" placeholder=\"Paste link here\">
														        </div>
														        <div class=\"form-group\">
														        <h4 for=\"otherLink\">Other Link</h4>
														        <input type=\"text\" name=\"oLink\" class=\"form-control\" id=\"otherLink\" placeholder=\"Paste link here\">
														    	</div>
														    </div>
										    		
											
													    <div class=\"checkbox\" >
														  	<label><input type=\"checkbox\" name=\"guestList\" value=\"\">Allow individuals to see the Guest List</label>
														</div>
														<div class=\"row bottomTouchDown topTouchDown\" >
															<div class=\"col-md-3\">
																<input type=\"Submit\" value=\"Update Event\" class=\"btn btn-success\" name=\"updateEvent\"/>
																</div>
															</div>
													  </div>
													</form>";
													
													//php file that handle the update Event Service
													include('event/updateEvent.php');

						        			}
						        			else
						        			{
						        					echo "You dont have access to this page";
						        			}
						        			

						        	}
						        	else
						        	{
						        		echo "Error connecting to database.";
						        	}
        
						        ?>
						   
					</div>
				</div>

				
			</div>
		</div>
		<?php include('global/footer.php'); ?>


	   	 <script type="text/javascript" src="_/js/datepicker.js"></script>
	     <script type="text/javascript" src="_/js/timepicker.js"> </script>
	     <script type="text/javascript" src="_/js/imgPick.js">	</script>
	     <script type="text/javascript" src="_/js/showLinks.js"></script>
	     <script>
				$(document).ready(function(){
				    $('[data-toggle="tooltip"]').tooltip(); 
				});
		</script>
		
		 <script>
	            $('#us2').locationpicker({
	                location: {
	                     latitude: <?php echo $latValue;?>,
	                    longitude: <?php echo $longValue;?>
	                },

	                inputBinding: {
	                    latitudeInput: $('#us2-lat'),
	                    longitudeInput: $('#us2-lon'),
	                    locationNameInput: $('#us2-address')
	                },
	                enableAutocomplete: true,
	                scrollwheel: false
	            });
	        </script>
	        <script type="text/javascript" src="_/js/tips.js"></script>

	</body>
</html>