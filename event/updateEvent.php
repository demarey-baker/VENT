<?php
		function safe($conn,$str){
		//this function ensure certain characters cannot enter the database so as to 
		//prevent sql injections
		return mysqli_escape_string($conn,$str);
	}

	if(isset($_POST['updateEvent'])){


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

		include('uploadImage.php');

		if($readyForDB){
						include('dbconnect.php');
						if($conn){
							mysqli_select_db($conn,"vent");

							$orgID=$_SESSION['AccountNum'];

								$q=$_GET['event'];

								//deletes previous EventImage
								$fileToDelete=mysqli_query($conn,"SELECT EventImage FROM event WHERE EventID='$q'");
								$row=mysqli_fetch_assoc($fileToDelete);

								$updateSqlEvent="UPDATE event SET EventName='$eventName',EventType='$eventType',EventLocation='$eventLocation', Latitude='$latitude',Longitude='$longitude', StartDate='$startDate', StartTime='$startTime', EndDate='$endDate',EndTime='$endTime', EventImage='$target_file', EventDesc='$eventDesc',EventCost='$eventCost' WHERE EventID='$q'";

								//remember when updating to unlink previous EventImage
								
								$connect=((mysqli_query($conn,$updateSqlEvent))?true:false);

								if($connect){
									//checks if file exist
									if(file_exists($row['EventImage']))
									{
										unlink($row['EventImage']);
									}
									echo "<script> alert('Your event was sucessfully updated!'); window.location.href='manageEvent.php'; </script>";
									mysqli_close($conn);
								}
								else
								{
									unlink($target_file);
;									echo "<script> alert('Error updating $eventName!');</script>";
								}
								

						}
						else
						{
							echo "Failed to connect to database";
						}
						
		}
		

		}
?>