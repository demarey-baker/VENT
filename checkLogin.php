<?php
	session_start();
	header('Content-type: application/json');
	//which $url to go to when logged in
	$_SESSION['url']="createEvent.php";
	
	if(isset($_SESSION['Login'])){
		$response_array['status'] ='success';
	}
	else
	{
		$response_array['status'] ='error';
	}	
	echo json_encode($response_array);
?>