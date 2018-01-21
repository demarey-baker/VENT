<!DOCTYPE html>
<html lang="en">
	<head>
			<?php 
			session_start();
			require_once('initialise.php');
			?>
			<title>VENT|Home</title>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<script type="text/javascript" src="_/js/jquery-2.2.0.js"></script>
			<link href="_/bootstrap/css/bootstrap.c
			ss" rel="stylesheet">
			<script type="text/javascript" src="_/js/jquery-2.2.0.js"></script>
			<link rel="stylesheet" href="_/css/mainstyle.css" type="text/css" />
			<link rel="stylesheet" href="_/css/full-slider.css" type="text/css" />
			<script src="_/bootstrap/js/bootstrap.js"></script>

	</head>
	<body>
			<?php include('global/header.php');
				  include('global/floatingVent.php');
			?>
			 <!-- Full Page Image Background Carousel Header -->
    <header id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>

        </ol>

        <!-- Wrapper for Slides -->
        <div class="carousel-inner">
            <div class="item active">
                <!-- Set the first background image using inline CSS below. -->
                <div class="fill" style="background-image:url('_/images/1.jpg');"></div>
                <div class="carousel-caption">
                    <div id="slogan_wrapper" class="center">
								<h1>Find Your Next<br> Event <a href="browse.php">Here</a></h1>
								<h3>Find, organise, promote and manage your event all in one place.</h3>
								<div class="col-md-3 col-md-offset-4">
								<a class="btn createEventBtn btn-success indexcusBtn center">Create Event</a>
								</div>
						</div>
					
                </div>
            </div>
            <div class="item">
                <!-- Set the second background image using inline CSS below. -->
                <div class="fill" style="background-image:url('_/images/2.jpg');"></div>
                <div class="carousel-caption">
                     <div id="slogan_wrapper"  class="center">
								<h1 style="color:white; text-align:left;">
								Join the professionals who are using Vent as their 
								premier choice for event management.
								</h1>
								
								
						</div>
                </div>
            </div>
            <div class="item">
                <!-- Set the third background image using inline CSS below. -->
                <div class="fill" style="background-image:url('_/images/4.jpg');"></div>
                <div class="carousel-caption">
                   <div id="slogan_wrapper" class="center">
								<h1 style="color:white;">Find Your Next<br> Event <a href="browse.php">Here</a></h1>
								<h3 style="color">Find, organise, promote and manage your event all in one place.</h3>
								<div class="col-md-3 col-md-offset-4">
								<a class="btn createEventBtn btn-success indexcusBtn center">Create Event</a>
								</div>
						</div>
					<script type="text/javascript" src="_/js/checkLoginCreateEvent.js"></script>
                </div>
            </div>
        </div>

    </header>
		    <script>
		    $('.carousel').carousel({
		        interval: 9000 //changes the speed
		    })
		    </script>

		<div class="container" id="mid_section">
			<div class="row">
				<h2 class="col-md-12">Top Events</h2>
			</div>
			<section class="row" id="topCat">
				<?php //always get the top 3 followed events and put them here
					include('dbconnect.php');
					if($conn){
						$result=mysqli_query($conn,"SELECT `EventID` FROM `follow` GROUP BY `EventID` ORDER BY COUNT(*) DESC
												    LIMIT    3;");
						while($row=mysqli_fetch_assoc($result)){
								$eid=$row['EventID'];
								$result1=mysqli_query($conn,"SELECT EventName, EventImage FROM event WHERE EventID='$eid'");
								$fetch=mysqli_fetch_assoc($result1);

								echo "<a class='cat_hov' href='viewEvent.php?event={$eid}'><div class='col-md-3 topEvent'>
									<img class='cat_images img-responsive' src='{$fetch['EventImage']}'/>
									<h2 class='cat_text'>{$fetch['EventName']}</h2>
								</div></a>";

						}
					}
				?>
				
			</section>
			<div class="row">
				<h2 class="col-md-12">Categories</h2>
			</div>

			<section class="row" id="topCat">

			<!--caterory for concert-->
				<a href="browse.php?category=8" class="cat_hov">
				<div class="col-md-3 topEvent">
						<img class="cat_images img-responsive" src="_/images/category/concert.jpg"/>
						<h2 class="cat_text">Concert</h2>
				</div>
				</a>

				<!--caterory for danceParty -->
				<a href="browse.php?category=3" class="cat_hov">
				<div class="col-md-3 topEvent">
						<img class="cat_images img-responsive" src="_/images/category/danceParty.png"/>
						<h2 class="cat_text">Dance or Party</h2>
						
				</div>
				</a>

				<a href="browse.php?category=4" class="cat_hov">
				<div class="col-md-3 topEvent">
					<img class="cat_images img-responsive" src="_/images/category/festival.jpg"/>
					<h2 class="cat_text">Fair or Festival</h2>
							
				</div>
				</a>

			</section>

			<section class="row" id="topCat">
				<a href="browse.php?category=7" class="cat_hov">
					<div class="col-md-3 topEvent">
						<img class="cat_images img-responsive" src="_/images/category/exhibition.jpg"/>	
						<h2 class="cat_text">Exhibition or Trade Show</h2>
					</div>
				</a>
				<a href="browse.php?category=2" class="cat_hov">
				<div class="col-md-3 topEvent">
						<img class="cat_images img-responsive" src="_/images/category/social.jpg"/>
						<h2 class="cat_text">Social Gathering</h2>
						
				</div>
				</a>
				<a href="browse.php?category=5" class="cat_hov">
				<div class="col-md-3 topEvent">
						<img class="cat_images img-responsive" src="_/images/category/dinner.jpg"/>	
						<h2 class="cat_text">Dinner or Gala</h2>
				</div>
				</a>
			</section>

			<section class="row" id="topCat">
				<a href="browse.php?category=1" class="cat_hov">
				<div class="col-md-3 topEvent">
					<img class="cat_images img-responsive" src="_/images/category/camp.jpg"/>
					<h2 class="cat_text">Camp or Retreat</h2>
						
				</div>
				</a>
				<a href="browse.php?category=6" class="cat_hov">
				<div class="col-md-3 topEvent">
					<img class="cat_images img-responsive" src="_/images/category/seminar.jpg"/>
					<h2 class="cat_text">Seminar</h2>
						
				</div>
				</a>
		
			</section>

			<script type="text/javascript">
				$(function(){
					$(".cat_hov").hover(function(){
						$(this).find( "img" ).css("opacity","1");
					},function(){
						$(this).find( "img" ).css("opacity","0.8");
					} );

				});


			</script>

		</div>

		
		<?php include('global/footer.php'); ?>

	</body>
</html>