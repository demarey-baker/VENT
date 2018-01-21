<?php
		session_start();
		include('../dbconnect.php');
		
		header('Content-type: application/json');

		$eventid=$_REQUEST['EventID'];
				//getImagePath
				$result=mysqli_query($conn,"SELECT EventImage FROM event WHERE EventId='$eventid'");
				$row=mysqli_fetch_assoc($result);

				//substr get rids of event/
				$getFile=substr($row['EventImage'], 6);
				
			
				//deletes EventImage
				//if EventImage was found and deleted
						if(!empty($getFile)||file_exists($getFile))
						{
								unlink($getFile);
						}

						$delSql="DELETE FROM event WHERE EventID='$eventid'";
						$response_array['status'] = (mysqli_query($conn,$delSql))?'success':'error';
						//mysqli_close($conn);
 	echo json_encode($response_array);  
	?>