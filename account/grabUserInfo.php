<?php
	include('dbconnect.php');
		mysqli_select_db($conn,"vent");

			$emailSearch=$_SESSION['Email'];
			//sql statements
			//checks if account exists in the database
			$sql="SELECT Email,FirstName, LastName, Gender,PhoneNo FROM  user where Email='$emailSearch' ";
			$sqlAcct=mysqli_query($conn,$sql);	
			$row=mysqli_fetch_assoc($sqlAcct);

			//variables for fetching information database
			$fname=$row['FirstName'];
			$lname=$row['LastName'];
			$gender=$row['Gender'];
			$phone=$row['PhoneNo'];

			//session variables for form
			$_SESSION['FirstName']=$fname;
			$_SESSION['LastName']=$lname;
			$_SESSION['Gender']=$gender;
			$_SESSION['PhoneNo']=$phone;


			echo "<table  class=\"table table-responsive\">";
			echo "<tr><td class=\"noborder\">Name</td></tr>";
			echo "<tr>";
			echo	"<td><input  class=\"form-control\" type=\"text\"  value=\" $fname \" disabled> </td>";
			echo	"<td ><input  class=\"form-control\" type=\"text\"   value=\"$lname\" disabled/></td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td>Gender</td>";							
			echo "</tr><td ><input  class=\"form-control\" type=\"text\"  value=\"$gender\" disabled/></td><tr>";
			echo "<td>Phone Number</td>";	
			echo "</tr>";
			echo "<tr>";
			echo "<td><input value=\"$phone\" class=\"form-control\" disabled></td>";		
			echo "</tr></table>";
			mysqli_close($conn);
?>