<!DOCTYPE html>
<html lang="en">
	<head>
			<?php 
			session_start();
			$_SESSION['url'] = $_SERVER['REQUEST_URI'];
			
			if(!isset($_GET['event'])){
				echo "<script>window.location.href='error.php'</script>";
			}else if(isset($_GET['event']))
			{
				include('dbconnect.php');
				if($conn){
					$q=$_GET['event'];
					$result=mysqli_query($conn," SELECT EventID FROM event WHERE EventID='$q'");
					if(mysqli_num_rows($result)<=0){
						echo "<script>window.location.href='error.php'</script>";
					}
				}
			}
			

			?>
			<title>VENT| GuestList\</title>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<script type="text/javascript" src="_/js/jquery-2.2.0.js"></script>
			<link href="_/bootstrap/css/bootstrap.css" rel="stylesheet">
			<script type="text/javascript" src="_/js/jquery-2.2.0.js"></script>
			<link rel="stylesheet" href="_/css/mainstyle.css" type="text/css" />
			<script src="_/bootstrap/js/bootstrap.js"></script>

	</head>
	<body>
		<?php include('global/header.php');?>
		<div class="container">
				
				<?php include('dbconnect.php');
					$eventid=$_GET['event'];
					
					if($conn){
						$result=mysqli_query($conn,"SELECT DISTINCT user.ProfilePicBig,user.FirstName, user.LastName  FROM guestlist join user ON user.AccountNum=guestlist.AccountNum WHERE EventID='$eventid'");
						if(mysqli_num_rows($result)>0){
							echo '<div class="row">
									<div class="col-md-12">
									<h1>Guestlist</h1>
									<hr/>
									</div>
								</div>
								<div class="row" id="guestlist_section">';
				
								while($row=mysqli_fetch_assoc($result)){
										
												echo "<div class=\"col-md-2 eachGuest\" >
													<img id=\"guestID\" src=\"{$row['ProfilePicBig']}\" />
														<p>{$row['FirstName']}
														{$row['LastName']}</p>
													
													</div>";
												
								}
								echo '</div>';
						}
						else
						{
							echo '<div class="row"><h1>Guestlist</h1><hr/></div><div class="row" id="guestlist_section" style="background:url(\'logo/noguests.png\') center center no-repeat;">
								
								<h3> No guests as yet :( </h3>
							</div>';
						}
					}
					else
					{
						die('Cannot connect to database');
					}
				?>
				

					
		
			</div>

	
		
		<?php include('global/footer.php'); ?>

	</body>
</html>