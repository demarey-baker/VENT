<!DOCTYPE html>
<html lang="en">
	<head>
			<?php 
			session_start();
			
			//only logged in users can view this page
				if(!isset($_SESSION['Login']))  echo "<script> window.location.href='index.php';</script>";
			?>
			<title>VENT|Manage Event</title>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<script type="text/javascript" src="_/js/jquery-2.2.0.js"></script>
			<link href="_/bootstrap/css/bootstrap.css" rel="stylesheet">
			<link href="_/jquery-ui-1.11.4.custom/jquery-ui.min.css" rel="stylesheet">
			<script type="text/javascript" src="_/js/jquery-2.2.0.js"></script>
			<link rel="stylesheet" href="_/css/mainstyle.css" type="text/css" />
			<link rel="stylesheet" href="_/css/manageEventcss.css" type="text/css" />
			<script type="text/javascript" src="_/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
			<script src="_/bootstrap/js/bootstrap.js"></script>

	

			


	</head>
	<body>
		<?php include('global/header.php');?>
		<div class="container touchdown">
			<div class="row bottomBorder">
				<div class="col-md-8">
					<h1>Manage Events</h1>
				</div>
				<div class="col-md-4">
					 <div id="custom-search-input">
	                            <div class="input-group col-md-12">
	                                <input type="text" class="  search-query form-control" placeholder="Search your events" />
	                                <span class="input-group-btn">
	                                    <button class="btn btn-danger" type="button">
	                                        <span class=" glyphicon glyphicon-search"></span>
	                                    </button>
	                                </span>
	                            </div>
	                        </div>

				</div>
			</div>

			<div class="row" id="manageEventDiv">
					
						<ul class="nav nav-pills nav-stacked col-md-3">
							  <li class="active"><a href="#upcoming" data-toggle="pill">Upcoming Events</a></li>
							  <li><a href="#pastEvents" data-toggle="pill">Past Events</a></li>
							
						</ul>
						
						<div class="tab-content col-md-9">
						        <div class="tab-pane active" id="upcoming">
						    
								     <?php include ('event/manageEachUpcomingEvent.php');?>
						        </div>
						        <div class="tab-pane" id="pastEvents">
						             <?php include ('event/manageEachPastEvent.php');?>

						        </div>
						</div><!-- tab content -->
			</div>

		</div>
		<?php include('global/footer.php'); ?>
  		<script type="text/javascript" src="_/js/deleteEvent.js">
  			/* This function handles the ajax call to delete  a specific event
  			*/
  		</script>		
	</body>
</html>