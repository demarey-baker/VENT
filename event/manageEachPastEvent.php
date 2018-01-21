 <?php 
            	include('dbconnect.php'); //database connection
				$currUser=$_SESSION['AccountNum']; //current user
				if($conn){
					$Eventsql="SELECT EventID,EventName,DAYNAME(StartDate) as day, MONTHNAME(StartDate) as month,DAY(StartDate) as daynum, StartTime FROM event WHERE OrganizerID='$currUser' AND StartDate<CURRENT_DATE()";
		
					if(mysqli_query($conn,$Eventsql))
					{
						$queryResult=mysqli_query($conn,$Eventsql);
						if(mysqli_num_rows($queryResult)>0){
							while($row=mysqli_fetch_assoc($queryResult))
							{
								//displays events queried
								echo "
								 <div class=\"borders1 eachManageEvent\">
								 	<button type=\"button\" title=\"Remove this event\" class=\"floatRight delEvent deleteEventBtn btn btn-default btn-sm\" value=\"{$row['EventID']}\">
								 	 <span class=\"glyphicon glyphicon-trash\" aria-hidden=\"true\"></span>
											</button>
										<h3>{$row['EventName']}</h3>
										<h4>{$row['day']}, {$row['month']} {$row['daynum']} {$row['StartTime']}</h4>
							 </div>";
							}
							
						}
						else
						{
							//if there are not events
							echo "You dont have any past events.";
						}


					}
					else
					{
						echo "Error retrieving information from database, Please try again!";
					}


					}
 ?>				
				 
											
											