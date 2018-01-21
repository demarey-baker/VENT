 <?php 
            	include('dbconnect.php');
				$getOrg=$_GET['orgID'];
				if($conn){
					$Eventsql="SELECT EventID,EventName,DAYNAME(StartDate) as day, MONTHNAME(StartDate) as month,DAY(StartDate) as daynum, StartTime FROM event WHERE OrganizerID='$getOrg' AND StartDate<CURRENT_DATE()";
		
					if(mysqli_query($conn,$Eventsql))
					{
						$queryResult=mysqli_query($conn,$Eventsql);
						if(mysqli_num_rows($queryResult)>0){

							while($row=mysqli_fetch_assoc($queryResult))
							{
								echo "
								 <div class=\"borders1 eachManageEvent\">
										<h3>{$row['EventName']}</h3>
										<h4>{$row['day']}, {$row['month']} {$row['daynum']} {$row['StartTime']}</h4>
											<ul>
												<li><a href=\"viewEvent.php?event={$row['EventID']}\"><span class=\"glyphicon glyphicon-modal-window\" ></span>
													<span style=\"font-size:15px;\">View</span></a>
												</li>
											</ul>
							 </div>";
							}
							
						}
						else
						{
							echo " No past events.";
						}


					}
					else
					{
						echo "Error retrieving information from database, Please try again!";
					}


					}
 ?>				
				 
											
											