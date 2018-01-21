<!DOCTYPE html>
<html lang="en">
	<head>
			<?php include('register/reg.php');
			session_start();
			if(isset($_SESSION['Login']))  echo "<script> window.location.href='index.php';</script>";
			?>	
			<title>VENT|Register</title>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<script type="text/javascript" src="_/js/jquery-2.2.0.js"></script>
			<link href="_/bootstrap/css/bootstrap.css" rel="stylesheet">
			<script type="text/javascript" src="_/js/jquery-2.2.0.js"></script>
			<link rel="stylesheet" href="_/css/mainstyle.css" type="text/css" />
			<script src="_/bootstrap/js/bootstrap.js"></script>

	</head>
	<body>
		<?php include('global/header.php');?>
		<div class="container touchdown">
				<div class="row">
					<h1 class="col-md-6 col-sm-12" >Register your account</h1>
				</div>
				<div>
				<form method="post"  id="userForm" role="form">
					<table id="signuptable" class="table table-responsive">
					<tr><td>Name</td></tr>
					<tr>
						<td><input  class="form-control" type="text"  placeholder="First" name="fname"required value="<?php if(isset($_POST['fname'])) echo $_POST['fname'];?>"> </td>
						<td ><input  class="form-control" type="text" placeholder="Last" name="lname" required value="<?php if(isset($_POST['fname'])) echo $_POST['lname'];?>" /></td>
					</tr>
					<tr><td>Email</td>
						<td>Gender</td>				
					</tr>
					
					<tr>
									<td><input type="email" name="email" placeholder="Email" class="form-control"  required value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>"></td>
									<td>
										<select  name="gender" class="form-control" required>
									<option value="Male" <?php if(isset($_POST['gender'])&&$_POST['gender']=="Male") echo 'selected="selected"';?> >
										Male
									</option>
									<option value="Female" <?php if(isset($_POST['gender'])&&$_POST['gender']=="Female") echo 'selected="selected"';?> >
										Female
									</option>
									</select>
									</td>
								
					</tr>			
					<tr>
						<td>Phone Number</td>
					</tr>
					
					<tr>
							<td><input type="tel" name="phone" value="<?php if(isset($_POST['phone'])) echo $_POST['phone']; ?>" class="form-control" placeholder="8761234567" pattern="([0-9]{3})(-)?([0-9]{3})(-)?([0-9]{4})" required></td>
					</tr>
					<tr>
						<td>Password</td>
					</tr>
					<tr>
						<td><input type="password" class="form-control" name="password" placeholder="Password" id="password"  required></td>
					</tr>
					<tr>
						<td>Re-enter Password</td>
						
					</tr>
					<tr>
					<td><input type="password"  name="rpassword"  placeholder="Repeat password" id="password1" class="form-control" required></td>
				
					</tr>
					
								<tr>
								<td><input type="Submit" value="Create account" class="btn btn-primary" name="submit" /></td>
								</tr>
				
				</table>
			<label>	By creating an account you are accepting our terms and conditions.</label>	
						
				</form>
			</div>

		</div>
		
		
		<?php include('global/footer.php'); ?>

	</body>
</html>