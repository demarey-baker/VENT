<!DOCTYPE html>
<html lang="en">
	<head>
			<?php 
			session_start();
			if(!isset($_SESSION['Login']))  echo "<script> window.location.href='index.php';</script>";
			$_SESSION['url'] = $_SERVER['REQUEST_URI']; 
			?>
			<title>VENT|Create Event</title>
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
			

			<script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>
    		<script src="_/jquery-locationpicker-plugin-master/dist/locationpicker.jquery.js"></script>
			


	</head>
	<body>
		<?php include('global/header.php');?>
		<div class="container touchdown">
			<div class="row">
				<div class="col-md-12">
					<h1>Create New Event</h1>
				</div>

			</div>
			<div class="row">
				
				<div class="col-md-12">
					<h2 id="evtDetails">Event Details</h2>
					<div class="col-md-7 centered">
						<form method="post" role="form" enctype="multipart/form-data">
							<div class="form-group">
						        <h4 for="eventTitle">Event Name</h4>
						        <input type="text" class="form-control" required name="eventName"  value="<?php if(isset($_POST['eventName'])) echo $_POST['eventName']; ?>" id="eventTitle" placeholder="Keep it Simple">
						    </div>
						    <div class="form-group">
						        <h4 for="EventType">Event Type</h4>
						       <select id="EventType" name="eventType" class="form-control">
						       		<option value="1"  <?php if(isset($_POST['eventType'])&&$_POST['eventType']=="1") echo 'selected="selected"';?> >Camp, Trip or Retreat</option>
						       		<option value="2" <?php if(isset($_POST['eventType'])&&$_POST['eventType']=="2") echo 'selected="selected"';?>>Social Gathering</option>
						       		<option value="3" <?php if(isset($_POST['eventType'])&&$_POST['eventType']=="3") echo 'selected="selected"';?> >Dance or Party</option>
						       		<option value="4" <?php if(isset($_POST['eventType'])&&$_POST['eventType']=="4") echo 'selected="selected"';?> >Fair or Festival</option>
						       		<option value="5" <?php if(isset($_POST['eventType'])&&$_POST['eventType']=="5") echo 'selected="selected"';?> >Dinner or Gala</option>
						       		<option value="6" <?php if(isset($_POST['eventType'])&&$_POST['eventType']=="6") echo 'selected="selected"';?> >Seminar</option>
						       		<option value="7" <?php if(isset($_POST['eventType'])&&$_POST['eventType']=="7") echo 'selected="selected"';?> >Trade show or Exposition</option>
						       		<option value="8" <?php if(isset($_POST['eventType'])&&$_POST['eventType']=="8") echo 'selected="selected"';?> >Concert or Performance</option>
						       </select>
						    </div>
	
		                    <div>
				                    <div class="form-group">
				                        <h4 for="Location" class="control-label">Location</h4>

				                            <input type="text" name="eventLocation"  value="<?php if(isset($_POST['eventLocation'])) echo $_POST['eventLocation']; ?>" required class="form-control" id="us2-address" />
				                       
				                    </div>
		                 
				                    <div id="us2" style="width: 100%; height: 400px;"></div>
				                    <div class="clearfix">&nbsp;</div>
				                    <div class="m-t-small">
				               
				                        <div class="col-sm-1">
				                            <input type="hidden" name="lat" value="<?php if(isset($_POST['lat'])) echo $_POST['lat']; ?>"class="form-control" id="us2-lat" />
				                        </div>
				   

				                        <div class="col-sm-1">
				                            <input type="hidden" value="<?php if(isset($_POST['long'])) echo $_POST['long']; ?>" name="long" class="form-control" id="us2-lon" />
				                        </div>
				                    </div>
				                    <div class="clearfix"></div>
                			</div>
                
                <script>
                	//call google maps Api to map the initial location
                    $('#us2').locationpicker({
                        location: {
                             latitude: 18.029910357524102,
                            longitude: -77.50461009999998
                        },

                        inputBinding: {
                            latitudeInput: $('#us2-lat'),
                            longitudeInput: $('#us2-lon'),
                            radiusInput: $('#us2-radius'),
                            locationNameInput: $('#us2-address')
                        },
                        enableAutocomplete: true,
                        scrollwheel: false
                    });
                </script>


				<script language="javascript" type="text/javascript">
				//limits event description form field
					function limitText(limitField, limitCount, limitNum) {
						if (limitField.value.length > limitNum) {
							limitField.value = limitField.value.substring(0, limitNum);
						} else {
							limitCount.value = limitNum - limitField.value.length;
						}
					}
				</script>		 
						    




























						    <div class="row">

							    <div class="control-group col-md-5">
							        <h4 for="date-picker-2" class="control-label">Starting Date</h4>
							        <div class="controls">
							            <div class="input-group">
							                <input id="date-picker-2" required value="<?php if(isset($_POST['startDate'])) echo $_POST['startDate']; ?>" type="text" name="startDate" class="date-picker form-control" />
							                <label for="date-picker-2" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span>

							                </label>
							            </div>
							            
							        </div>
							    </div>

							    <script type="text/javascript" src="_/js/datepicker.js"></script>
							     <script type="text/javascript" src="_/js/timepicker.js">
							     	
							     </script>


							    <div class="col-md-5 col-md-offset-1">
								    <h4 for="time">Starts</h4>
								        <input type="text" required value="<?php if(isset($_POST['startTime'])) echo $_POST['startTime']; ?>" name="startTime" id="timepicker1" class="timepicker form-control" id="time" placeholder="From">
								          
								    	
							    </div>
							   <div>
							   		<div class="control-group col-md-5">
							        <h4 for="date-picker-3" class="control-label">Ending Date</h4>
							        <div class="controls">
							            <div class="input-group">
							                <input id="date-picker-3" required value="<?php if(isset($_POST['endDate'])) echo $_POST['endDate']; ?>" name="endDate" type="text" class="date-picker form-control" />
							                <label for="date-picker-3" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span>

							                </label>
							            </div>
							            
							        </div>
							    </div>


							    <div class="col-md-5 col-md-offset-1">
								    <h4 for="time">Ends</h4>
								        <input type="text" id="timepicker2" required value="<?php if(isset($_POST['endTime'])) echo $_POST['endTime']; ?>" name="endTime" class="form-control" id="time" placeholder="From">
								          
								    	
							    </div>
							   </div>



						    </div>
						    <div class="row">
						   		 <div class="col-md-8 form-group">
							    	 <h4 for="eventPic">Event Image</h4>
						

							    	 <div id="EventPic">
							    	 	<img src="" id="preview"/>
										<input type="file"  required id="imgFile" name="uploadedImage"/>

							    	 </div>
							    	 <script type="text/javascript" src="_/js/imgPick.js">	</script>
							    	 
						    	</div>
						    </div>
						    
						    <div class="form-group">
									  <h4 for="evtDesc"> Event Description </h4>
									  <textarea class="form-control" name="eventDesc" rows="8" id="evtDesc"><?php 
									  	if(isset($_POST['eventDesc'])) 
									  		echo trim($_POST['eventDesc']); 
									  ?></textarea>
							</div>
							<div>
								    <h4 for="costEvent">Cost</h4>
								        <input data-toggle="tooltip"  type="text" class="form-control" id="costEvent" value="<?php if(isset($_POST['eventCost'])) echo $_POST['eventCost']; ?>" name="eventCost" title="If the event is free insert $0.00" placeholder="Cost of Event"> 
								        <script>
										$(document).ready(function(){
										    $('[data-toggle="tooltip"]').tooltip(); 
										});
										</script>
								        	
							</div>
							<div class="checkbox" >
							  <label><input type="checkbox" id="showLinks" value="">Include links to other social media</label>
							</div>
									<div class="hidden" id="sociaLinks">
										 <div class="form-group">
								        <h4 for="Twitter">Twitter</h4>
								        <input type="text" name="tLInk" class="form-control" id="Twitter" placeholder="Paste link here">
								    	</div>
								    	<div class="form-group">
								        <h4 for="fceBook">Facebook</h4>
								        <input type="text" name="tLink" class="form-control" id="fceBook" placeholder="Paste link here">
								        </div>
								        <div class="form-group">
								        <h4 for="otherLink">Other Link</h4>
								        <input type="text" name="oLink" class="form-control" id="otherLink" placeholder="Paste link here">
								    	</div>
								    </div>
						    		<script type="text/javascript" src="_/js/showLinks.js"></script>
							
						    <div class="checkbox" >
							  	<label><input type="checkbox" name="guestList" value="">Allow individuals to see the Guest List</label>
							</div>
							<div class="row bottomTouchDown topTouchDown" >
								<div class="col-md-3">
									<input type="Submit" value="Save This Event" class="btn btn-success" name="saveEvent"/>
								</div>
							</div>
						 
						</form>
						<?php include('event/saveEvent.php');?>
					</div>
				</div>

				
			</div>
		</div>
		<?php include('global/footer.php'); ?>





	</body>
</html>