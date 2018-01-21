<?php
	session_start();
	include('../dbconnect.php');
	header('Content-type: application/json');
	$currUser=$_SESSION['AccountNum'];


	if($conn){
			//updates user image directory with Profile Picture
			$sql="SELECT ProfilePicBig FROM user WHERE AccountNum='$currUser'";

				if(mysqli_query($conn,$sql)){
					$row=mysqli_fetch_assoc(mysqli_query($conn,$sql));
					$filename=substr($row['ProfilePicBig'],14);
				
					
					$source="../".$row['ProfilePicBig'];
					

					$dest="../organizer/organizerImages/$filename";
					
					//copies file to the organiser folder destination
					if(copy($source, $dest)){
						$dest=substr($dest, 3);
						$copyImageQuery="UPDATE organizer SET OrganizerImage='$dest' WHERE OrganizerID='$currUser'";
						//sucessful on query attempt
						$response_array['status']=mysqli_query($conn,$copyImageQuery)?'success':'error';
					}
					else
					{
						$response_array['status']='error';
					}
					
				}
				else
				{
					$response_array['status']='error';
				}

	}
	else
	{
			$response_array['status']='error';
	}
	echo json_encode($response_array);	
?>