<div class="col-md-12">
			<h2>Delete Account</h2>
			<div class="col-md-8">
				
					<h3>Your Email Address</h3>
					<p>
					<?php echo $_SESSION['Email'];?>
					</p>




		<form method="post" id="delForm">
				<h4>Thank you for using Vent. In case there is anything we can do please feel free to <a href="contactus.php">contact us</a>
					</h4>Please let us know why you are leaving
						<!--CheckBoxes-->
						<div class="checkbox">
						  <label><input type="checkbox" name="hardToUse" value="<?php if(isset($_POST['hardToUse'])) echo 'checked="checked"'; ?>">Vent is very hard to use</label>
						</div>
						<div class="checkbox">
						  <label><input type="checkbox" name="boring" value="<?php if(isset($_POST['boring'])) echo 'checked="checked"'; ?>">Vent is boring</label>
						</div>
						<div class="checkbox">
						  <label><input type="checkbox" name="rem" value="<?php if(isset($_POST['rem'])) echo 'checked="checked"'; ?>"> I dont remember signing up for this website</label>
						</div>
						<!--Custom Comments for leaving website-->
						<div class="form-group">
  							<label for="comment">Comment:</label>
  							<textarea class="form-control" rows="5" name="comments" value="<?php  if(isset($_POST['comments'])) echo $_POST['comments']; ?>" id="comment"></textarea>
						</div>
				<table class="table table-responsive">


					<tr><td>Enter Your Password</td></tr>
					<tr>
						<td>
						<input class="form-control" name="curPassword" type="password" placeholder="Current Password" required/>
						</td>
					</tr>
					
					<tr>
						<td>
							<input type="submit" value="Delete" name="delAccount" onclick="return confirm('Upon successful deletion, it will be impossible to recover your account. Are you sure? ');" class="btn btn-danger">
						</td>
					</tr>
			</table>
		</form>
			</div>
</div>

<?php

	if(isset($_POST['delAccount']))
	{
		include('dbconnect.php');
		//checks connection to database
		$currUser=$_SESSION['AccountNum'];
		if($conn)
		{
			$sql="SELECT Password,Email FROM user WHERE AccountNum='$currUser' ";
			$query=mysqli_query($conn,$sql);
			$row=mysqli_fetch_assoc($query);

			//fetch password from database
			$dbPassword=$row['Password'];

			//fetch password presented on form
			$formPassword=$_POST['curPassword'];

			if(checkPass($dbPassword,$formPassword)){

				//values from form to be sent to the database
				$hard=(isset($_POST['hardToUse']))?1:0;
				$bored=(isset($_POST['boring']))?1:0;
				$rem=(isset($_POST['rem']))?1:0;
				$comments=$_POST['comments'];


				//inserts into reason table
				$reasonQuery="INSERT INTO reason(AccountNum,HardToUse,Boring,DontRememberSigning,OtherComments) VALUES('$AccountNum','$hard','$bored','$rem','$comments')";
				$query=mysqli_query($conn,$reasonQuery);

				$deleteQuery="DELETE FROM user WHERE AccountNum='$AccountNum'; DELETE FROM organizer WHERE OrganizerID='$AccountNum';";

				$query=mysqli_multi_query($conn,$deleteQuery);
				
				//if account was deleted
				if($query){
						echo "<script>alert('Account has sucessfully be removed.');</script>";
						include('logout.php');
				}

				else{
					echo "<script>alert('Failed! Account cannot be removed.');</script>";
				}

			}
			else
			{
				echo "<script>alert('Password is incorrect. Account cannot be removed. Please enter the correct password');</script>";
			}

		}
		else
		{
			die("Error connecting to database...");
		}


	}
?>