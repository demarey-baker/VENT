<?php
		function make_safe($conn,$variable) {
		//get rid of special characters to prevent sql injections
		$variable = mysqli_real_escape_string($conn,trim($variable)); 
			return $variable;
	}


		$wrong="Wrong credentials\n Please Try again!";
		if(isset($_POST['login'])){
			//user credentials
			
			//database information
			include('dbconnect.php');

			
			
			if(!$conn){
				die('Error establishing connection to the server');
			}
			else{
			//user credentials
			$user=make_safe($conn,$_POST['email']);
			$pwd=make_safe($conn,$_POST['password']);

			$login=false;
			$error=false;
			//sql statements
			//checks if account exists in the database
			$sql="SELECT Email,Password,FirstName,AccountNum FROM user WHERE AcctType='Normal'";
			$sqlAcct=mysqli_query($conn,$sql);
			
			if( mysqli_num_rows($sqlAcct)>0){
				while($row=mysqli_fetch_assoc($sqlAcct))
				{
						if($row['Password']==md5($pwd) && $row['Email']==$user)
						{						
											//session_start();
											if(isset($_SESSION['url'])) 
										   	$url = $_SESSION['url']; // holds url for last page visited.
											else $url = "index.php";
											$_SESSION['Login']=true;
											$_SESSION['AccountNum']=$row['AccountNum'];
											$_SESSION['AccountType']="NOrmal";
											$_SESSION['Name']=$row['FirstName'];
											$_SESSION['Email']=$row['Email'];

											
											//logging
											$userid=$row['AccountNum'];
											$comment="Sucessfully logged in";

											mysqli_query($conn, "INSERT INTO log VALUES('','$userid','$comment',NOW())");
											mysqli_close($conn);
											echo "<script> window.location.href='$url';</script>";	
										
						}
						else
						{
									$error="true";	
						}	
				}
					if($error)//logging
					{
									
									$userid=1;// guest users stored with a value of 1
									$comment="Unsucessful login attempt";
									mysqli_query($conn, "INSERT INTO log VALUES('','$userid','$comment',NOW())");
					}
			}
			else
			{
				echo "This account doesnt exist";	
			}	
	}
}
?>