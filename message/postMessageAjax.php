<?php
	include("../dbconnect.php");
	//post message
	if(isset($_POST['message'])){
		$message = mysqli_real_escape_string($conn, $_POST['message']);
		$conversation_id = mysqli_real_escape_string($conn, $_POST['conversation_id']);
		$user_form = mysqli_real_escape_string($conn, $_POST['user_form']);
		$user_to = mysqli_real_escape_string($conn, $_POST['user_to']);

		//decrypt the conversation_id,user_from,user_to
		$conversation_id = base64_decode($conversation_id);
		$user_form = base64_decode($user_form);
		$user_to = base64_decode($user_to);

		//insert into `messages`
		$q = mysqli_query($conn, "INSERT INTO `messages` VALUES ('','$conversation_id','$user_form','$user_to','$message',NOW(),'Unread')");
		if($q){
			echo "Message sent";

				//logging
				$userid=$user_form;
				$res=mysqli_query($conn,"SELECT FirstName,LastName FROM user WHERE AccountNum='$user_to'");
				$fetch=mysqli_fetch_assoc($res);
				$comment=" sent a message to ".$fetch['FirstName']. " ". $fetch['LastName'];
				mysqli_query($conn, "INSERT INTO log VALUES('','$userid','$comment',NOW())");

		}else{
			echo "Error sending message";
		}
	}
?>