<!DOCTYPE html>
<html lang="en">
	<head>
			<?php 
			session_start();
			$user_id=$_SESSION['AccountNum'];
			
			if(!isset($_SESSION['Login']))  echo "<script> window.location.href='index.php';</script>";
			?>
			<title>VENT|Messages</title>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<script type="text/javascript" src="_/js/jquery-2.2.0.js"></script>
			<link href="_/bootstrap/css/bootstrap.css" rel="stylesheet">
			<link href="_/jquery-ui-1.11.4.custom/jquery-ui.min.css" rel="stylesheet">
			<script type="text/javascript" src="_/js/jquery-2.2.0.js"></script>
			<link rel="stylesheet" href="_/css/mainstyle.css" type="text/css" />
			<script type="text/javascript" src="_/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
			<script src="_/bootstrap/js/bootstrap.js"></script>
			<link rel="stylesheet" href="_/jquery-timepicker-1.3.2/jquery.timepicker.min.css" type="text/css" />
			<link rel="stylesheet" href="_/css/message.css" type="text/css" />			


	</head>
	<body>
		<?php include('global/header.php');?>
		<div class="container touchdown">
			<div class="row bottomBorder">
				<div class="col-md-8">
					<h1>Messages</h1>
				</div>
			</div>
		
			<!--message Div-->
			<div class="row" id="messageDiv">

					<div class="col-md-1 message-left">
						<ul>
							<?php
								include('dbconnect.php');
								if($conn){	
								//show all the users expect me
					
								$q = mysqli_query($conn, "SELECT * FROM `user` WHERE AccountNum!='$user_id' AND AcctType='Normal'");
								//display all the results
							
								while($row = mysqli_fetch_assoc($q)){
									$fullname=$row['FirstName']. " ". $row['LastName'];
									
									if(isset($_GET['id'])){
										$activeConvo=($row['AccountNum']==$_GET['id'])?"activeConvo":"";
									}else{
										$activeConvo="";
									}
									echo "<a class='lodDIvClick' href='messages.php?id={$row['AccountNum']}'>
											<li class='{$activeConvo}'>
												<img src='{$row['ProfilePicBig']}' class='messagePic'> 
												{$fullname}
												</li>
											</a>";
								}

							}	
							else
							{
								echo "Error";
							}
							?>
						</ul>
					</div>

		<!--message right-->
		<div class="message-right col-md-9">
			<!-- display message -->
			<div class="display-message">
			<div class="loading-div"><img src="event/eventImages/ajax-loader.gif"/></div>

			<?php
				//check $_GET['id'] is set
				if(isset($_GET['id'])){
					$user_two = trim(mysqli_real_escape_string($conn, $_GET['id']));
					//check $user_two is valid
					$q = @mysqli_query($conn, "SELECT `AccountNum` FROM `user` WHERE AccountNum='$user_two' AND AccountNum!='$user_id'");
					//valid $user_two
					if(mysqli_num_rows($q) == 1){
						//check $user_id and $user_two has conversation or not if no start one
						$conver = @mysqli_query($conn, "SELECT * FROM `conversation` WHERE (user_one='$user_id' AND user_two='$user_two') OR (user_one='$user_two' AND user_two='$user_id')");

						//they have a conversation
						if(mysqli_num_rows($conver) == 1){
							//fetch the converstaion id
							$fetch = mysqli_fetch_assoc($conver);
							$conversation_id = $fetch['id'];
						}else{ //they do not have a conversation
							//start a new converstaion and fetch its id
							$q = @mysqli_query($conn, "INSERT INTO `conversation` VALUES ('','$user_id','$user_two')");
							$conversation_id = mysqli_insert_id($conn);
						}
					}else{
						die("Invalid ID.");
					}
				}
				else {
					die(" No new mesages click on a existing person to see the conversation");
				}
			?>
			</div>
			<!-- /display message -->

			<!-- send message -->
			<div class="send-message">
				<!-- store conversation_id, user_from, user_to so that we can send send this values to postMessageAjax.php -->
				<input type="hidden" id="conversation_id" value="<?php echo base64_encode($conversation_id); ?>">
				<input type="hidden" id="user_form" value="<?php echo base64_encode($user_id); ?>">
				<input type="hidden" id="user_to" value="<?php echo base64_encode($user_two); ?>">
				<div class="form-group">
					<textarea class="form-control" id="message" placeholder="Enter Your Message"></textarea>
				</div>
				<button class="btn btn-primary" id="reply">Reply</button> 
				<span id="error"></span>
			</div>
			<!-- / send message -->

			
					
						        
			</div>
			<!-- end message right-->
			<script src="_/js/messages.js"></script>


		</div>
		<!--end messageDiv-->

	</body>
</html>