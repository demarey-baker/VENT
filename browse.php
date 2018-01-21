<!DOCTYPE html>
<html lang="en">
	<head>
			<?php 
				session_start(); // starts the session
				$_SESSION['url'] = $_SERVER['REQUEST_URI']; 
			?>
			<title>VENT|Browse</title>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<script type="text/javascript" src="_/js/jquery-2.2.0.js"></script>
			<link href="_/bootstrap/css/bootstrap.css" rel="stylesheet">
			<script type="text/javascript" src="_/js/jquery-2.2.0.js"></script>
			<link rel="stylesheet" href="_/css/mainstyle.css" type="text/css" />
			<script src="_/bootstrap/js/bootstrap.js"></script>'
			<link rel="stylesheet" href="_/css/pagination.css" type="text/css" />
			
	</head>
	<body>
			<?php include('global/header.php'); ?>
			<div class="container touchdown">
				<div class="row">
					
						<section id="browse_content" class="col-md-8">

							<div class="row">
								<div class="col-md-12">
								<h1>Upcoming Events</h1>
								<hr/>
								</div>
								
							</div>
							<div class="row">
								<div class="col-md-12">
								
						       	<!--future implementation
						       	 <button  disabled type="button"  class="floatLeft btn btn-default btn-lg">
						          <span class="glyphicon glyphicon-sort-by-attributes-alt"></span> Sort
						        </button>
						     		
								 <ul class="nav nav-tabs floatRight">
									    <li class="active"><a data-toggle="tab" class="sort">Top Events</a></li>
									    <li><a data-toggle="tab" class="sort">Date</a></li>
									     <li><a data-toggle="tab" class="sort">Type</a></li>
									     <li><a data-toggle="tab" class="sort">Price</a></li>
									   
								</ul>
								-->

								</div>
							</div>
							
							<script type="text/javascript" src="_/js/follow.js"></script>
							<script type="text/javascript" src="_/js/checkLoginCreateEvent.js"></script>
							<!-- section for events-->
							<script type="text/javascript" src="_/js/fetch_browsePages.js"></script>

							
							<div class="row">
							<div class="loading-div"><img src="event/eventImages/ajax-loader.gif"/></div>
								<div class="col-md-12" id="results"><!--All events will display here--></div>
							</div>
						

						</section>
						
						<section id="browseSide" class="col-md-3 affix">
							<div class="row" id="browseSideinside">
								<div class="col-md-12">
									<div class="row eachOptionBrowse">
										<label class="col-md-10">Notifs</label>
										<span class="col-md-2 glyphicon glyphicon-chevron-down"></span>

									</div>
									<div class="row eachOptionBrowse">
										<label class="col-md-10">Reminders</label>
										<span class="col-md-2 glyphicon glyphicon-chevron-down"></span>

									</div>
									<div class="row eachOptionBrowse">
										<label class="col-md-10">My upcoming events</label>
										<span class="col-md-2 glyphicon glyphicon-chevron-down"></span>

									</div>
									
										
									</div>
								
							</div>
							
								
							</div>


							

						</section>

					

				</div>
				
			</div>
			<?php include('global/footer.php'); ?>

			
	</body>
</html>