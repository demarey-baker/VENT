<div class="row" id="log_display">
  		<table class="table">
  			
  			<tr>
  				<td class="noborder"><h4>User</h4></td>
  				<td class="noborder"><h4>Action</h4></td>
  				<td class="noborder"><h4>Time</h4></td>
  			</tr>
	  			<?php
	  					$host="localhost";
					$username="root";
					$conn=mysqli_connect($host,$username);
					mysqli_select_db($conn,"vent");
					if(!$conn){
						die('Error establishing a connection to the database');
					}
	  				if($conn){
	  					$q="SELECT Comment,Clock,user.AcctType, FirstName, LastName FROM log JOIN user on user.AccountNum=log.AccountNum ORDER BY Clock DESC";

	  					$res=mysqli_query($conn,$q);
	  					//fetch query rows
	  					while($row=mysqli_fetch_assoc($res)){
							$fullname=($row['AcctType']=='Normal')? $row['FirstName']." ".$row['LastName']:"";
							$time=format_date($row['Clock']);
	  						echo "<tr>
	  								<td>{$fullname}</td>
	  								<td>{$row['Comment']}</td>
	  								<td>{$time}</td>
	  								</tr>";
	  					}


	  				}
	  				else
	  				{
	  					die("Could not establish connection");
	  				}


				//convert time to readable format
				 function format_date($str) {
				            $convertDate= date("M j, Y g:ia",strtotime($str));        

				        return $convertDate;
				}

	  			?>

			  		</table>
			  			

			  		</div>