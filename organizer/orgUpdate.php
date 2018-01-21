<?php
	session_start();

	function make_safe($variable,$conn) {
		//get rid of special characters to prevent sql injections
		$variable = mysqli_real_escape_string($conn,trim($variable)); 
			return $variable;
	}

	if(isset($_POST['update'])){
		//connect to datbase
		include('../dbconnect.php');
		
		 if($conn)
		 {
		
		 	//current user
		 	$currUser=$_SESSION['AccountNum'];
		 	$url=$_SESSION['url'];
		 	//variables to be updated
		 	$OrganizerName=$_POST['orgName'];
			$OrganizerDesc=$_POST['orgDesc'];
			$FLink=$_POST['fceBook'];
			$TLink=$_POST['tLInk'];
			$OtherLnk=$_POST['oLink'];

		 	//checking variables for security reasons
		 	$OrganizerName=make_safe($OrganizerName,$conn);
			$OrganizerDesc=make_safe($OrganizerDesc,$conn);
			$FLink=make_safe($FLink,$conn);
			$TLink=make_safe($TLink,$conn);
			$OtherLnk=make_safe($OtherLnk,$conn);
		 	
		 	//sql to update dable values
		 	$sql="UPDATE organizer SET OrganizerName='$OrganizerName', OrganizerDesc='$OrganizerDesc', FLink='$FLink', TLink='$TLink',OtherLnk='$OtherLnk' WHERE OrganizerID='$currUser' ";
		 	$query=mysqli_query($conn,$sql);

		 	if($query){
		 		echo "<script>alert('Update sucessful.'); window.location.href='$url';</script>";
		 		mysqli_close($conn);
		 	}
		 	else
		 	{
		 		echo "<script>alert('Update failed. Please try again'); window.location.href='$url';</script>";
		 		mysqli_close($conn);
		 	}
		 }
		 else
		 {
		 	die('Cannot connect to database');
		 }
	}
?>