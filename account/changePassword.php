<div class="col-md-6">
		<h2>My Password</h2>
		<form method="post">
			<table class="table table-responsive">
					<tr><td class="noborder">Current Password</td></tr>
					<tr>
						<td class="noborder">
						<input class="form-control" name="curPassword" type="password" placeholder="Current Password" required/>
						</td>
					</tr>
					<tr><td class="noborder">New Password</td></tr>
					<tr>
						<td class="noborder">
						<input class="form-control" type="password" placeholder="New Password" name="newPassword" required/>
						</td>
					</tr>
					<tr>
					<tr><td class="noborder">Repeat Password</td></tr>
					<tr>
						<td class="noborder">
						<input class="form-control" type="password" placeholder="Repeat Password" name="repPassword" required/>
						</td>
					</tr>
					<tr>
						<td class="noborder">
							<a href="myaccount.php" id="cancel" class="btn btn-danger">Cancel</a>
							<input type="submit" id="saveEmail"  onclick="return confirm('Are you sure?');" name="savePassword" value="Save" class="btn btn-success">
						</td>
					</tr>
			</table>
	</form>
	</div>

	<?php

		if(isset($_POST['savePassword']))
	{	
		include('dbconnect.php');
		
		 //checks database connection
		 if($conn)
		 {
			 	//connected
			 	//checks if password is correct
			 	$curUser=$_SESSION['AccountNum'];
			 	$curPassword=$_POST['curPassword'];
			 	$newPassword=$_POST['newPassword'];
			 	$repPassword=$_POST['repPassword'];

			 	//checks if current password is the actual password
			 	$sql="SELECT Password,Email FROM user WHERE AccountNum='$curUser' ";
				$query=mysqli_query($conn,$sql);
				$row=mysqli_fetch_assoc($query);

				//fetch password from database
				$dbPassword=$row['Password'];

			 	if(md5($curPassword)!=$dbPassword)
			 	{
			 		echo "<script>alert('Password entered is incorrect. Please enter your actual password.')</script>";
			 			echo"<script src=\"_/js/active.js\"></script>";
			 		
			 	}

			 	else
			 	{
					 	if($newPassword!=$repPassword){
					 			echo "<script>alert('Old password and new password must match!');</script>";

					 	}
					 	else
					 	{


						 	$sql="SELECT Password,user.Email,user.AccountNum FROM user WHERE AccountNum='$curUser' ";
						 	$result=mysqli_query($conn,$sql);
						 	$row=mysqli_fetch_assoc($result);
						 	$dbPassword=$row['Password'];
						 	//hashing
						 	$newPassword=md5($newPassword);
						 	echo $newPassword;
						 	$userAccountNum=$row['AccountNum'];

						 			$sql="UPDATE user SET Password='$newPassword' WHERE user.AccountNum='$userAccountNum'  ";
					 				$updated=mysqli_query($conn,$sql);
					 				if($updated)
					 				{
					 					echo "<script>alert('Password was updated. Please re-login.');</script>";
					 					include('logout.php');
					 					echo "<script>window.location.href='index.php';</script>";  
					 				}
					 				else
					 				{
					 					echo "something went wrong. Thats all we know";
					 				}
						 	
						 	
						 	

					 				
						 }
				}
				
		 }
		 else
		 {
		 	die('Error connecting to server. Please try again');
		 }


	}

	?>