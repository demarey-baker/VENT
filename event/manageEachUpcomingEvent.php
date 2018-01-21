 <?php 
            	include('dbconnect.php'); //database connection
				$currUser=$_SESSION['AccountNum']; //current user
				if($conn){
					$Eventsql="SELECT EventID,EventName,DAYNAME(StartDate) as day, MONTHNAME(StartDate) as month,DAY(StartDate) as daynum, StartTime FROM event WHERE OrganizerID='$currUser' AND StartDate>=CURRENT_DATE()";
		
					if(mysqli_query($conn,$Eventsql))
					{
						$queryResult=mysqli_query($conn,$Eventsql);
						if(mysqli_num_rows($queryResult)>0){//if there are events

							while($row=mysqli_fetch_assoc($queryResult))
							{
								echo "
								 <div class=\"borders1 eachManageEvent\">
								 	<button type=\"button\" title=\"Remove this event\" class=\"floatRight delEvent deleteEventBtn btn btn-default btn-sm \"  value=\"{$row['EventID']}\">
								 	 <span class=\"glyphicon glyphicon-trash\" aria-hidden=\"true\"></span>
											</button>
										<h3>{$row['EventName']}</h3>
										<h4>{$row['day']}, {$row['month']} {$row['daynum']} {$row['StartTime']}</h4>

										
											<ul>
												<li><a href=\"viewEvent.php?event={$row['EventID']}\"><span class=\"glyphicon glyphicon-modal-window\" ></span>
													<span class=\"viewEventbtns\">View</span></a>
												</li>
												<li><a href=\"editEvent.php?event={$row['EventID']}\">
													<span class=\"glyphicon glyphicon-edit\" ></span>
												<span class=\"viewEventbtns\">Edit</span></a>
												</li>
												
											</ul>

											<div class=\"floatRight\">
													<a href=\"guestlist.php?event={$row['EventID']}\" title=\"Click to see the guestlist\">
						          					<span class=\"glyphicon glyphicon-play-circle\"></span> <span class=\"viewEventbtns\">See who's going
						        						</span>
						        					</a>
											</div>
							 </div>";
							}
							
						}
						else
						{
							//no events
							echo "<p>You currently don't have any upcoming events.</p>";
						}


					}
					else
					{
						//error connecting to databse
						echo "Error retrieving information from database, Please try again!";
					}


					}
 ?>
										 
											
											