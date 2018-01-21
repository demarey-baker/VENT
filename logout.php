<?php
	session_start();
	include('dbconnect.php');
			//logs
			$userid=$_SESSION['AccountNum'];
			$comment="Sucessfully logged out";
			mysqli_query($conn, "INSERT INTO log VALUES('','$userid','$comment',NOW())");
			
			mysqli_close($conn);// close conneection
			session_destroy();
			echo "<script>window.location.href='index.php'</script>";//redirects to index page
?>