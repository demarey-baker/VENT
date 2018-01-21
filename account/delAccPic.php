<?php
		session_start();
		include('../dbconnect.php');
		
		header('Content-type: application/json');

		$id=$_REQUEST['PicID'];
				//getImagePath
				$result=mysqli_query($conn,"SELECT ProfilePicBig,thumb FROM user WHERE ProfilePicBig='$id'");
				$row=mysqli_fetch_assoc($result);
				
				//big profile picture
				//subStr getRids of account/ 
				$getFileProfilePic=substr($row['ProfilePicBig'],8);

				//thumbnail
				//subStr getRids of account/ 
				$getFileThumb=substr($row['thumb'],8);

				$goOn=false;
				if(file_exists($getFileProfilePic)){
					$pathPro=$getFileProfilePic;
					$goOn=true;
				}
				
				if(file_exists($getFileThumb)){
					$pathThumb=$getFileThumb;
					$goOn=true;
				}

				//file to be deleted were found and deleted
				if($goOn)
				{
						unlink($pathPro);
						unlink($pathThumb);
						$null='';
						$delSql="UPDATE USER SET ProfilePicBig='$null',thumb='$null' WHERE ProfilePicBig='$id'";
						 $response_array['status'] = (mysqli_query($conn,$delSql))?'success':'error';
				}
				else
				{
					$response_array['status'] ='error';	
				}
 	echo json_encode($response_array);	
?>