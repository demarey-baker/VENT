<?php
	//this file connects to the database
	$host="localhost";
	$username="root";
	$Password="";
	$database="vent";
	$conn=mysqli_connect($host,$username,$Password,$database);
	mysqli_select_db($conn,"vent");
	if(!$conn){
		die('Error establishing a connection to the database');
	}

?>
