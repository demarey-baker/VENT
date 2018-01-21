
<?php
				session_start();
				include('../dbconnect.php');// database connection
				$AccountNum=$_SESSION['AccountNum'];
				$EventID=$_REQUEST['EventID']; //get the id of the event to unfollow
				$UnfollowSql="DELETE FROM guestlist WHERE AccountNum='$AccountNum' AND EventID='$EventID'";
				$connect=((mysqli_query($conn,$UnfollowSql))?true:false);

?>