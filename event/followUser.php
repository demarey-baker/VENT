
<?php
				session_start();
				include('../dbconnect.php');
				$AccountNum=$_SESSION['AccountNum'];
				$UserID=$_REQUEST['UserID'];
				$followSql="INSERT INTO followuser VALUES('$AccountNum','$UserID','')";
				$connect=(mysqli_query($conn,$followSql))?true:false;
				
					
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

						$comment=$user_name." followed Event ".$user_name2;
						mysqli_query($conn, "INSERT INTO log VALUES('','$userid','$comment',NOW())");
				}
				
?>