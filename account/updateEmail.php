<?php
	if(isset($_POST['saveNewEmail']))
	{	
		include('dbconnect.php');
		
		 //checks database connection
		 if($conn){
			 	//connected
			 	//checks if password is correct
			 	$oldEmail=$_SESSION['Email'];
			 	$sql="SELECT Password,user.AccountNum,Email FROM user join user_account WHERE Email='$oldEmail' ";
			 	$result=mysqli_query($conn,$sql);
			 	$row=mysqli_fetch_assoc($result);

			 	$dbPassword=$row['Password'];
			 	$formPassword=$_POST['password'];
			 	$dbAccountNum=$row['AccountNum'];
	
			 	if(checkPass($dbPassword,$formPassword)){
			 			$newEmail=$_POST['newEmail'];
		 				$sql="UPDATE user SET Email='$newEmail' WHERE '$dbAccountNum'=user.AccountNum";
		 				$updated=mysqli_query($conn,$sql);
		 				if($updated){
		 					echo "<script>alert('Your account was updated. Please re-login.');</script>";
		 					include('logout.php');
		 					echo "<script>window.location.href='index.php';</script>";  
		 				}
		 				else{
		 					echo"Something went wrong. Thats all we know";
		 				}
			 	}
			 	else
			 	{
			 		echo "<script>alert('The password entered is incorrect.')</script>";
			 	}

		 }
		 else
		 {
		 	die('Error connecting to server. Please try again');
		 }


	}
	

?>