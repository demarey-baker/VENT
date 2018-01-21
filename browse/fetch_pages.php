
<?php
	session_start();
	echo "<script type=\"text/javascript\" src=\"_/js/follow.js\"></script>";
	echo "<script type=\"text/javascript\" src=\"_/js/goToGuestlist.js\"></script>";
//continue only if $_POST is set and it is a Ajax request
if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	
	include("config.inc.php");  //include config file
	//Get page number from Ajax POST
	if(isset($_POST["page"])){
		$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
		if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
	}else{
		$page_number = 1; //if there's no page number, set it to 1
	}
	
	//get total number of records from database for pagination
	$results = $mysqli->query("SELECT COUNT(*) FROM event WHERE StartDate>=CURRENT_DATE()");

	

	$get_total_rows = $results->fetch_row(); //hold total records in variable

	//break records into pages
	$total_pages = ceil($get_total_rows[0]/$item_per_page);
	
	//get starting position to fetch the records
	$page_position = (($page_number-1) * $item_per_page);
	

	//Limit our results within a specified range. 
	$results = $mysqli->prepare("SELECT EventID,EventName,EventLocation,DAYNAME(StartDate) as day, MONTHNAME(StartDate) as month,DAY(StartDate) as daynum, StartTime,EventCost, EventImage FROM event WHERE StartDate>=CURRENT_DATE() ORDER BY StartDate ASC LIMIT $page_position, $item_per_page");
	$results->execute(); //Execute prepared Query
	$results->bind_result($EventID,$EventName,$EventLocation,$day,$month,$daynum,$StartTime,$EventCost,$EventImage); //bind variables to prepared statement
	
	//Display records fetched from database.

	while($results->fetch()){ //fetch values

		echo "<div class=\"row\">
						<div class=\"col-md-12 eachEventbanner\">";
	
						echo "<a href=\"viewEvent.php?event={$EventID}\">
								<div class=\"eventHeader\">";


							echo "<div class=\"col-md-4\" id=\"browseImgDiv\">
									<img src=\"{$EventImage}\" id=\"browseImage\" class=\"img-responsive\">
								</div>";
								
						echo "<div class=\"col-md-8\" id=\"browseDetails\">";
						echo "<label value=\"$EventID\" title=\"Click to see the guestlist\" class=\"guestlist btn btn-link btn fsharebtns floatRight\">
					          <span class=\"glyphicon  glyphicon-play-circle\"></span> See who's going
					        </label>";

							echo "<h4>{$day}, {$month} {$daynum} {$StartTime}</h4>";

							
							echo "<b><h2 id=\"browseEventName\">{$EventName}</h2></b>";
							echo "<p>{$EventLocation}</p>";
							
							
	
						echo "</div></div></a>";
			
					echo "<div class=\"eventfooter\">";
					echo "<div class=\"col-md-4\">";
					if(strtoupper($EventCost)=="FREE"||$EventCost==0)
					{
						echo "<p class=\"costLbl\">FREE <a href=\"comments.php?event={$EventID}\" class=\" floatRight\">Reviews/Comments</a></p>";
					}
					else 
					{
						echo "<p class=\"costLbl\">&#36;{$EventCost} <a href=\"comments.php?event={$EventID}\" class=\" floatRight\">Reviews/Comments</a></p>";
					}
						
					echo "</div>";
					
					echo "<div class=\"col-md-8\">
							
							<a href=\"#\" class=\" fsharebtns btn btn-primary btn floatRight\">
					          <span class=\"glyphicon glyphicon-share\"></span> Share
					        </a>";

					     //values for query
					      include('../dbconnect.php');
					       $eventid=$EventID;
					       $AccountNum=isset($_SESSION['AccountNum'])?$_SESSION['AccountNum']:"";

					 //checks if the event is followed by the user
					 $sql="SELECT * FROM follow WHERE AccountNum='$AccountNum' AND EventID='$eventid'";
					 $query=mysqli_query($conn,$sql);

						//means the user like this 
					 if (mysqli_num_rows($query)>0){
					 		echo " <span class=\"followText\">You're following this</span> <a title=\"Your following this\" value=\"{$eventid}\" class=\"btn btn-danger btn unfollow-click fsharebtns floatRight\">
					          <span class=\"glyphicon glyphicon-log-out\"></span> Unfollow
					        </a>";
					      
					     }

					  else
					  	//user doesnt like it yet
					  {
							echo "  <a title=\"Follow this\" value=\"{$eventid}\" class=\"btn btn-primary follow-click btn fsharebtns floatRight\">
					          <span class=\"glyphicon  glyphicon-log-out\"></span> Follow
					        </a>";
					  }
					
					  
					echo "

					        </div>
					     </div></div>
					</div>";
	}


	echo '<div class="row" id="pagination-links" align="center">';

	/* Generate pagination links */
	echo paginate_function($item_per_page, $page_number, $get_total_rows[0], $total_pages);
	echo '</div>';
	
	exit;
}
################ pagination function #########################################
function paginate_function($item_per_page, $current_page, $total_records, $total_pages)
{
    $pagination = '';
    if($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages){ //verify total pages and current page number
        $pagination .= '<ul class="pagination1">';
        
        $right_links    = $current_page + 3; 
        $previous       = $current_page - 1; //previous link 
        $next           = $current_page + 1; //next link
        $first_link     = true; //boolean var to decide first link
        
        if($current_page > 1){
			$previous_link = ($previous==0)? 1: $previous;
            $pagination .= '<a href="#" data-page="1" title="First"><li class="first">&laquo;</li></a>'; //first link
            $pagination .= '<a href="#" data-page="'.$previous_link.'" title="Previous"><li>&lt;</li></a>'; //previous link
                for($i = ($current_page-2); $i < $current_page; $i++){ //Create left-hand side links
                    if($i > 0){
                        $pagination .= '<a href="#" data-page="'.$i.'" title="Page'.$i.'"><li>'.$i.'</li></a>';
                    }
                }   
            $first_link = false; //set first link to false
        }
        
        if($first_link){ //if current active page is first link
            $pagination .= '<li class="first active">'.$current_page.'</li>';
        }elseif($current_page == $total_pages){ //if it's the last active link
            $pagination .= '<li class="last active">'.$current_page.'</li>';
        }else{ //regular current link
            $pagination .= '<li class="active">'.$current_page.'</li>';
        }
                
        for($i = $current_page+1; $i < $right_links ; $i++){ //create right-hand side links
            if($i<=$total_pages){
                $pagination .= '<a href="#" data-page="'.$i.'" title="Page '.$i.'"><li>'.$i.'</li></a>';
            }
        }
        if($current_page < $total_pages){ 
				$next_link = ($i > $total_pages) ? $total_pages : $i;
                $pagination .= '<a href="#" data-page="'.$next_link.'" title="Next"><li>&gt;</li></a>'; //next link
                $pagination .= '<a href="#" data-page="'.$total_pages.'" title="Last"><li class="last">&raquo;</li></a>'; //last link
        }
        
        $pagination .= '</ul>'; 
    }
    return $pagination; //return pagination links
}

?>


