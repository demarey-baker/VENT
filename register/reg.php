<?php
	//check if the passwords match
	function checkPasswordMatch($x,$y){
		$result=false;
		if($x==$y){
			$result=true;
			return $result;
		}
	}
	
	//function to check against sql injections
	function safe($variable,$conn) {
		$variable = mysqli_real_escape_string($conn,trim($variable)); 
			return $variable;
	}
		$password=null;
		$message="";
		$error=$current_id=null;
		$firstName=$lastName=$email=$gender=$contact=$lname=$dbpassword=$connect=null;
		$emaild=$contactd=null;

		if(isset($_POST['submit'])){

			if(checkPasswordMatch($_POST['password'],$_POST['rpassword'])){

						$password=$_POST['password'];
						##echo "dsddds";
			}
			else{
				$error=true;
				$message.="Passwords must match";
			}
			if($error){
				echo "<script>alert('$message');</script>";	
			}

			//hash password for security
			$dbpassword=md5($password);
			
			include('dbconnect.php');
			
			$conn=mysqli_connect($host,$username);
			mysqli_select_db($conn,"vent");
			
					//grab data values from form fields
					$acctType="Normal";
					$name=$_POST['fname'];
					$lname=$_POST['lname'];
					$emailtemp=$_POST['email'];
					
					
					//check if user is already in the database
					$sql="SELECT Email FROM user WHERE Email='$emailtemp'";

					$result=mysqli_query($conn,$sql);
					
					if(mysqli_num_rows($result)>0)
					{
						$error=true;
						echo "<script>alert('A user is already registered with this email');</script>";
					}
					if($error){
						$message="There is an error.Please try again!";
						echo "<script>alert('$message');</script>";	
					}

					$email=$_POST['email'];
					$gender=$_POST['gender'];
					$contact=$_POST['phone'];
		#make connection with database
		
		if($conn && !$error){
			//sanitization
			$dbname=safe($name,$conn);
			$email=safe($email,$conn);
			$gender=safe($gender,$conn);
			$phoneNo=safe($contact,$conn);
			$lname=safe($lname,$conn);

			mysqli_select_db($conn,"vent");			
					
					$sql="INSERT INTO user(Password,Email,FirstName,LastName, Gender,PhoneNo,AcctType)
							VALUES('$dbpassword','$email','$dbname','$lname','$gender','$phoneNo','$acctType')";
						if(mysqli_query($conn,$sql)){
							$connect=true;
						}
						else{
							$connect=false;
						}
							if($connect &&!$error){
							
							/*//sending verification email
							$confirm_code=md5(uniqid(rand())); 
							$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."activate.php?pass_code=" . $confirm_code;
							$toEmail = (isset($_POST['email']))?$_POST['email']:$_POST['emaild'];
							//$toEmail=$_POST['email'];
							$subject = "User Registration Activation Email";
							$content = "Click this link to activate your account. <a href='" . $actual_link . "'>" . $actual_link . "</a>";
							$mailHeaders = "From: Admin\r\n";
					
							if(mail($toEmail, $subject, $content, $mailHeaders)) {
								echo "<script> alert('<script>You have registered and the activation mail is sent to your email. Click the activation link to activate you account.'); window.location.href='index.php';</script>";	
							}
							*/
				
								echo "<script>alert('Registration Successful'); window.location.href='index.php'; </script>";
							}
						mysqli_close($conn);
			}
		else
		{
			die('Error establishing connection to the server');
		
		}
			
	
	
		}		
?>