
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

if(isset($_POST['profilePic']))
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
	
	$filepath = "account/photo/".$filename;
	$filepath_thumb = "account/photo/profile_pictures/"."thumb_".$filename;
	
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
				
				move_uploaded_file($filetmp,$filepath);				
				
				if($filetype == "image/jpeg")
				{
				  $imagecreate = "imagecreatefromjpeg";
				  $imageformat = "imagejpeg";
				}
				if($filetype == "image/png")
				{						 
				  $imagecreate = "imagecreatefrompng";
				  $imageformat = "imagepng";
				}
				if($filetype == "image/gif")
				{						 
				  $imagecreate= "imagecreatefromgif";
				  $imageformat = "imagegif";
				}
				
				$new_width = "20";
				$new_height = "20";
								
				$image_p = imagecreatetruecolor($new_width, $new_height);
				$image = $imagecreate($filepath); //photo folder
						
				imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $filewidth, $fileheight);						
				$imageformat($image_p, $filepath_thumb);//thumb folder

							//insert into database	
							include('dbconnect.php');
							if($conn)
							{
								$AccountNum=$_SESSION['AccountNum'];
								$name=$_SESSION['Name'];
								$addImageUrls="UPDATE user SET ProfilePicBig='$filepath', thumb='$filepath_thumb' WHERE AccountNum='$AccountNum'";
								if(mysqli_query($conn,$addImageUrls))
								{
									echo "<script>alert('$name, your profile picture was updated');window.location.href='myaccount.php';</script>";
									mysqli_close($conn);
								}	
								else
								{	
									echo "<script>alert('$name, Sorry your profile picture could not be updated');</script>";
									mysqli_close($conn);
								}
									

							}
							else
							{
								echo "Error establishing connection to database..";
							}	
					}
				}

				
			}
			
		}

?>

</body>
</html>