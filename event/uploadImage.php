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

$readyForDB=false;
$target_dir = "event/eventImages/";

$imgtype=$_FILES['uploadedImage']['type'];
$ext= GetImageExtension($imgtype);

$target_file = $target_dir .$eventName.time().$ext;
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["saveEvent"])||isset($_POST["updateEvent"])) 
{
		   $check = getimagesize($_FILES["uploadedImage"]["tmp_name"]);
		    if($check !== false) {
		        //echo "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } 
		    else {
		       // echo "File is not an image.";
		        $uploadOk = 0;
		    }
		}
		if (file_exists($target_file)) {
		   // echo "Sorry, file already exists.";
		    $uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		    echo "<script> alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.''); </script>";
		    $uploadOk = 0;
		}

		if ($uploadOk == 0) {
		    echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} 
		else {
			//echo "File moved";
		    if (move_uploaded_file($_FILES["uploadedImage"]["tmp_name"], $target_file)) 
		    {
		        $readyForDB=true;
		    } else
		    {
		      echo "Sorry, there was an error uploading your file.";
		    }
		}


?>