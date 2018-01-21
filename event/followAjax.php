<?php include('../dbconnect.php');
       $eventid=$_GET['event'];
       $AccountNum=$_GET['AccountNum'];
      if($conn){
		//checks if the event is followed by the user
	 $sql="SELECT * FROM follow WHERE AccountNum='$AccountNum' AND EventID='$eventid'";
	 $query=mysqli_query($conn,$sql);

		//means the user like this 
	 if (mysqli_num_rows($query)>0){

	 		echo "<a title=\"Your following this\" value=\"{$eventid}\" class=\"btn btn-danger btn unfollow-click fsharebtns\">
	          <span class=\"glyphicon glyphicon-log-out\"></span> Unfollow
	        </a>";
	      
	     }

	  else
	  	//user doesnt like it yet
	  {
			echo "  <a title=\"Follow this\" value=\"{$eventid}\" class=\"btn btn-info follow-click btn fsharebtns\">
	          <span class=\"glyphicon  glyphicon-log-out\"></span> Follow
	        </a>";
	  }
	}
	else
	{
		die("Error establishing connection");
	}

?>