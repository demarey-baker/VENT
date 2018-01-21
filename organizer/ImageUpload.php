
<?php
function GetImageExtension($imagetype)
    {
       if(empty($imagetype)) return false;
       switch($imagetype)
       {
           case 'image/bmp': return '.bmp';
           case 'image/gif': return '.gif';
           case 'image/jpeg': return '.jpg';
           case 'image/png': return '.png';
           default: return false;
       }
    }
if(isset($_POST['org_Img']))
{
	$filetmp = $_FILES["file_img"]["tmp_name"];
	//$filename = $_FILES["file_img"]["name"];
	
	$filetype = $_FILES["file_img"]["type"];
	$filesize = $_FILES["file_img"]["size"];
	$fileinfo = getimagesize($_FILES["file_img"]["tmp_name"]);
	$ext= GetImageExtension($filetype);

	$filename=$_SESSION['Email'].time().$ext;

	$filewidth = $fileinfo[0];
	$fileheight = $fileinfo[1];
	
	$filepath = "organizer/organizerImages/".$filename;
	
	if($filetmp == "")
	{
		echo "please select a photo";
	}
	else
	{
		
		if($filesize > 2097152)
		{
			echo "photo > 2mb";
		}
		else
		{
			
			if($filetype != "image/jpeg" && $filetype != "image/png" && $filetype != "image/gif")
			{
				echo "Please upload jpg / png / gif";
			}
			else
			{
				
						if(move_uploaded_file($filetmp,$filepath))
						{
							//insert into database	
									include('dbconnect.php');
									if($conn)
									{
										$AccountNum=$_SESSION['AccountNum'];
							
										$addImageUrls="UPDATE organizer SET OrganizerImage='$filepath' WHERE OrganizerID='$AccountNum'";
										if(mysqli_query($conn,$addImageUrls))
										{
											echo "<script>alert('Your picture was updated');window.location.href='myprofile.php';</script>";
											mysqli_close($conn);
										}	
										else
										{	
											echo "<script>alert('Sorry your picture could not be updated');</script>";
											mysqli_close($conn);
										}
											

									}
									else
									{
										echo "Error establishing connection to database..";
									}	

						}		
						else{
							echo "There was an error";
						}		
				
					
					}
				}

				
			}
			
		}

?>

</body>
</html>