
<?php
	/*
 		This file processes the message entered from viewEvent.php page when
 		the user sends the orgraniser a message.
	*/
if(isset($_POST['message']))
{
	include('dbconnect.php');
	if($conn){
		$sender=$_SESSION['AccountNum']; //user one
		$receiver=$_SESSION['orgID']; //user two
		$message=$_POST['message'];
		
		//check if receiver is valid
			$q = mysqli_query($conn, "SELECT `AccountNum` FROM `user` WHERE AccountNum='$receiver' AND AccountNum!='$sender'");
		
			//valid $receiver
			if(mysqli_num_rows($q) == 1)
			{
				//check $user_id and $user_two has conversation or not if no start one
				$conver = mysqli_query($conn, "SELECT * FROM `conversation` WHERE (user_one='$sender' AND user_two='$receiver') OR (user_one='$receiver' AND user_two='$sender')");

				//they have a conversation
				if(mysqli_num_rows($conver) == 1)
				{
					//fetch the converstaion id
					$fetch = mysqli_fetch_assoc($conver);
					$conversation_id = $fetch['id'];

				}else{ //they do not have a conversation
					//start a new converstaion and fetch its id
					$q = mysqli_query($conn, "INSERT INTO `conversation` VALUES ('','$sender','$receiver')");
					$conversation_id = mysqli_insert_id($conn);
				}
			}

			$sentMessage= mysqli_query($conn, "INSERT INTO `messages` VALUES ('','$conversation_id','$sender','$receiver','$message',NOW(),'Unread')");
			if($sentMessage){
				//message is sent
				$url=$_SESSION['url'];
				$_SESSION['orgID']="";

				//logging
				$userid=$_SESSION['AccountNum'];
				$res=mysqli_query($conn,"SELECT FirstName,LastName FROM user WHERE AccountNum='$userid'");
				$fetch=mysqli_fetch_assoc($res);
				$comment=" sent a message to ".$fetch['FirstName']. " ". $fetch['LastName'];
				mysqli_query($conn, "INSERT INTO log VALUES('','$userid','$comment',NOW())");


				echo "<script>window.location.href='$url';</script>";
			}else{
				echo "Error sending message";
			}


	}
}
			
					
				
			














?>