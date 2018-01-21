<?php
		session_start();
		include('../dbconnect.php');
		
		header('Content-type: application/json');

		$id=$_REQUEST['PicID'];
				//getImagePath
				$result=mysqli_query($conn,"SELECT OrganizerImage FROM organizer WHERE OrganizerImage='$id'");
				$row=mysqli_fetch_assoc($result);
				
				//big profile picture
				//subStr getRids of organizer/ 
				$getFileProfilePic=substr($row['OrganizerImage'],10);
				//subStr getRids of account/ 

				$goOn=false;
				if(file_exists($getFileProfilePic)){
					$pathPro=$getFileProfilePic;
					$goOn=true;
				}
				

				//file to be deleted were found and deleted
				if($goOn)
				{
						unlink($pathPro);
						$null='';
						$delSql="UPDATE organizer SET OrganizerImage='$null' WHERE OrganizerImage='$id'";
						 $response_array['status'] = (mysqli_query($conn,$delSql))?'success':'error';
				}
				else
				{
					$response_array['status'] ='error';	
				}
 	echo json_encode($response_array);	
?>