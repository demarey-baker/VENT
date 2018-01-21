<?php
	if(isset($_POST['editAccount'])){
		//connect to datbase
		include('dbconnect.php');
		 if($conn)
		 {
		
		 	$currUser=$_SESSION['AccountNum']; //current user
		
		 	//make variables safe
		 	$fname=make_safe($conn,$_POST['fname']);
		 	$lname=make_safe($conn,$_POST['lname']);
		 	$gender=make_safe($conn,$_POST['gender']);
		 	$phone=make_safe($conn,$_POST['phone']);

		 	$sql="UPDATE user SET FirstName='$fname', LastName='$lname', Gender='$gender', PhoneNo='$phone' WHERE AccountNum='$currUser' ";
		 	$query=mysqli_query($conn,$sql);

		 	if($query){
		 		// if query ran sucessfully
		 		echo "<script>alert('Your account was sucessfully updated.'); window.location.href='myaccount.php';</script>";
		 		mysqli_close($conn);
		 	}
		 }
		 else
		 {
		 	//no connection
		 	die('Cannot connect to database');
		 }


	

	}
?>