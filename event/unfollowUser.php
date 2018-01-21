<?php
				session_start();
				include('../dbconnect.php');// database connection
				$AccountNum=$_SESSION['AccountNum'];
				$UserID=$_REQUEST['UserID']; //get the id of the event to unfollow
				$UnfollowSql="DELETE FROM followuser WHERE AccountNum='$AccountNum' AND FollowAccountNum='$UserID'";
				$connect=((mysqli_query($conn,$UnfollowSql))?true:false);


				if($connect)//logging
				{
						//grab user name 2
						$result=mysqli_query($conn,"SELECT FirstName, LastName FROM user WHERE AccountNum='$UserID'");
						$row=mysqli_fetch_assoc($result);

						//grab user name
						$result1=mysqli_query($conn,"SELECT FirstName, LastName FROM user WHERE AccountNum='$AccountNum'");
						$row1=mysqli_fetch_assoc($result1);
					

						$userid=$AccountNum;

						$user_name=$row1['FirstName']." ".$row1['LastName'];
						$user_name2=$row['FirstName']." ".$row['LastName'];

						$comment=$user_name." unfollowed user ".$user_name2;
						mysqli_query($conn, "INSERT INTO log VALUES('','$userid','$comment',NOW())");
				}

?>