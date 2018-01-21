<!DOCTYPE html>
<html lang="en">
	<head>
			<?php 
			session_start();
			if(!isset($_SESSION['Login']))  echo "<script> window.location.href='index.php';</script>";
			?>
			<title>My Account</title>
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
		<div class="container touchdown">
			<div class="row">
				<div class="col-md-8">
				<h2>Account Settings</h2>
				</div>
			</div>
			<!--Tabs section-->
			<div class="row">
				<div class="col-md-12">
					<ul class="nav nav-tabs" id="nav-section-left">
						  <li class="active"><a data-toggle="tab" href="#accountInfo">Account Information</a></li>
						  <li><a data-toggle="tab" href="#password">Password</a></li>
						  <li><a data-toggle="tab" href="#otherSettings">Other Settings</a></li>
						  <li><a data-toggle="tab" href="#delAccount">Delete Account</a></li>
					</ul>

					<div class="tab-content">
						<!--Account Information-->
						  <div id="accountInfo" class="tab-pane fade in active">
							   	 <div class="row">
										<?php 
										include('account/accountInfo.php');?>
								</div>
							</div>

						  <!--Password section-->
						  <div id="password" class="tab-pane fade">
							     <div class="row">
									<?php include('account/changePassword.php');?>
									
							  	</div>
						  </div>
						  <!--Other Settings-->
						  <div id="otherSettings" class="tab-pane fade">
							   <div class="row">
									<?php include('account/otherSettings.php');?>
							  	</div>
						  </div>
						  <!--Delete Account-->
						  <div id="delAccount" class="tab-pane fade">
							   <div class="row">
									<div class="col-md-12">
										<?php include('account/deleteAccount.php');?>
									</div>
									
							  	</div>
						  </div>
						  <script type="text/javascript">
								$(function(){
											/*
										On page refresh ensures that the selected tab remains

									*/

										$('#nav-section-left a').click(function(e) {
										  e.preventDefault();
										  	 $('html, body').animate({ scrollTop: 0 }, 'slow');
										  $(this).tab('show');
										});

										// store the currently selected tab in the hash value
										$("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
										  var id = $(e.target).attr("href").substr(1);
										  window.location.hash = id;

										});

										// on load of the page: switch to the currently selected tab
										var hash = window.location.hash;
										$('#nav-section-left a[href="' + hash + '"]').tab('show');
								
								});



						</script>
					</div>

				</div>
			</div>
		</div>
			
		</div>
		<?php include('global/footer.php'); ?>

	</body>
</html>