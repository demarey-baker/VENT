<?php
	function safe($conn,$str){
		//this function ensure certain characters cannot enter the database so as to 
		//prevent sql injections
		return mysqli_escape_string($conn,$str);
	}

	if(isset($_POST['saveEvent'])){
		

		include('uploadImage.php');
		//ready For DB is a bool value found in uploadImage.php...it returns true if the Images where moved to
		// their correct location so now we can store its path in the database
		if($readyForDB){
						include('dbconnect.php');
						if($conn){
							mysqli_select_db($conn,"vent");
							$eventName=safe($conn,$_POST['eventName']);
							$eventType=safe($conn,$_POST['eventType']);

							$eventLocation=safe($conn,$_POST['eventLocation']);
							$latitude=safe($conn,$_POST['lat']);
							$longitude=safe($conn,$_POST['long']);

							$startDate=safe($conn,$_POST['startDate']);
							$startTime=safe($conn,$_POST['startTime']);

							$endDate=safe($conn,$_POST['endDate']);
							$endTime=safe($conn,$_POST['endTime']);
						
							$eventCost=safe($conn,$_POST['eventCost']);
							$eventDesc=safe($conn,$_POST['eventDesc']);
							$orgID=safe($conn,$_SESSION['AccountNum']);
											
							
								//check is user is already an organizer
								$checkOrganizer=mysqli_query($conn,"SELECT OrganizerID FROM organizer WHERE OrganizerID='$orgID'");
								if(mysqli_num_rows($checkOrganizer)<=0)
								{
									///if organizer doesnt exist
									$insertSqlOrganizer="INSERT INTO organizer(OrganizerID) VALUES('$orgID')";
									mysqli_query($conn,$insertSqlOrganizer);
								}

							$insertSqlEvent="INSERT INTO `vent`.`event` (`EventID`, `EventName`, `EventType`, `EventLocation`,`Latitude`,`Longitude`,`StartDate`, `StartTime`, `EndDate`, `EndTime`, `EventImage`, `EventDesc`, `EventCost`, `OrganizerID`) VALUES (NULL,'$eventName','$eventType','$eventLocation','$latitude','$longitude','$startDate','$startTime','$endDate','$endTime','$target_file','$eventDesc', '$eventCost', '$orgID');
							UPDATE user SET OrganizerID='$orgID' WHERE AccountNum='$orgID'; ";
							
								

								$sucess=(mysqli_multi_query($conn,$insertSqlEvent))?true:false;

								if($sucess){
									
									echo "<script> alert('Your event $eventName was added sucessfully!'); window.location.href='browse.php'; </script>";
									mysqli_close($conn);
								}
								else
								{
									//deletes uploaded image if data didnt makes it way to the database
									unlink($target_file);
									echo "<script> alert('Error adding your event!');</script>";
								}
								

						}
						else
						{
							//database connection error
							echo "Failed to connect to database";
						}
						
		}
		

		}
?>