<!DOCTYPE html>
<html>	
	
			<title>VENT|Admin Login</title>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<script type="text/javascript" src="../_/js/jquery-2.2.0.js"></script>
			<link href="../_/bootstrap/css/bootstrap.css" rel="stylesheet">
			<link href="../_/css/admin.css" rel="stylesheet">
			<script type="text/javascript" src="../_/js/jquery-2.2.0.js"></script>
			<script src="../_/bootstrap/js/bootstrap.js"></script>
			
			<body>
				<div class="container">
					<div id="loginBox">

							<div id="formlog" class="center">
								<div class="center" id="adminPic">
									<img src="images/admin.png"/>
								</div>
								<form method="post"> 
		
						                <input type="email" id="inputEmail" name="email" class="form-control" placeholder="User Name" required autofocus>
						                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
						                <div id="remember" class="checkbox">
						                    <label class="floatRight">
						                        <input type="checkbox" value="remember-me">Remember Me
						                    </label>
						                </div>
						                <button class="btn btn-lg btn-primary btn-block btn-signin" name="login" type="submit">Admin Login</button>
						         </form><!-- /form -->
						            <a href="#" class="forgot-password">
						                Forgot your password?
						            </a>
						          <?php
											session_start();

											if(isset($_POST['login'])){
									
											
												//connects to database
												include('../dbconnect.php');
												
												if(!$conn){
													die('Error establishing connection to the server');
												}
												else{
												mysqli_select_db($conn,"vent");
									

												$user=mysqli_real_escape_string($conn,$_POST['email']);
												$pwd=mysqli_real_escape_string($conn,$_POST['password']);

												//checks if account exists in the database
												$sql="SELECT Email,Password,AccountNum FROM user WHERE AcctType='Admin'";
												$sqlAcct=mysqli_query($conn,$sql);
												
												if( mysqli_num_rows($sqlAcct)>0){
													while($row=mysqli_fetch_assoc($sqlAcct))
													{
															if($row['Password']==md5($pwd) && $row['Email']==$user)
															{						
																				//session_start();

																				if(isset($_SESSION['AccountType']) && ($_SESSION['AccountType']=="Normal"))
																				{
																					session_destroy();
																				}

																		
																				$url = "index.php";
																				$_SESSION['Login']=true;
																				$_SESSION['AccountNum']=$row['AccountNum'];
																				$_SESSION['AccountType']="Admin";
																				$_SESSION['Email']=$row['Email'];

																				$userid=$_SESSION['AccountNum'];
																				$comment="Admin logged in";
																				mysqli_query($conn, "INSERT INTO log VALUES('','$userid','$comment',NOW())");


																				mysqli_close($conn);
																				echo "<script> window.location.href='$url';</script>";	
																			
															}
															else
															{
																		 echo '<label style="color:red;">Wrong username or password<label>';
																			
															}	
													}
												}
												else
												{
													echo '<label style="color:red;">Sorry, that account doesn\'t exist!</label>';
												}	
										}
									}
									?>



					           </div>




					</div>
				</div>



			</body>

</html>

