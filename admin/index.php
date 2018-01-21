<!DOCTYPE html>
<html>
	<?php
		session_start();
		//ensures only admin can have access to this page
		if(!isset($_SESSION['Login'])||($_SESSION['AccountType']!="Admin")){
			echo '<script> window.location.href="Login.php";</script>';
		}

	?>

	<head>
		<title>VENT|Admin</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="../_/bootstrap/css/bootstrap.css" rel="stylesheet">
		<link href="../_/css/admin.css" rel="stylesheet">
		<script type="text/javascript" src="../_/js/jquery-2.2.0.js"></script>
		<script src="../_/bootstrap/js/bootstrap.js"></script>



		<style>
			.nav-pills > li > a{
				      color:#fff;
				      font-size:15px;
				    }
				.nav-pills > li.active > a, .nav-pills > li.active > a:hover, .nav-pills > li.active > a:focus {
				    //color:#9d9d9d;
				    background-color:#264830;
				    }
				    .nav-pills > li > a{
				    	border-radius: 0px;
				    }
				   .nav-pills > li:hover,.nav-pills > li > a:hover{
				   	  background-color: #152119;
				   	
				   }


	</style>
	</head>
	<body>
			<?php include('global/header.php');?>

			<div class="container-fluid">
					<div class="row touchdown">
			
						<ul class="nav nav-pills col-md-2 nav-stacked" id="nav-section-left">
							<li class="active hashes"><a href="#log_section" data-toggle="pill"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Audit Logs</a></li>
							<li class="hashes"><a href="#user_account" data-toggle="pill"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> User Accounts</a></li>
							<li class="hashes"><a href="#eventM" data-toggle="pill">
							<span class="glyphicon glyphicon-facetime-video" aria-hidden="true"></span> Event Management</a></li>
							<li class="hashes"><a href="#settings" data-toggle="pill"><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span> Settings</a></li>
							<li><a id="logout"> <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Logout</a></li>

						</ul>
						<script type="text/javascript">
							/*
								On page refresh ensures that the selected tab remains

							*/
								$(function(){

										$("#logout").click(function(e){
												e.preventDefault();
												window.location.href="logout.php";
										});
										//replaces curson
										$("#logout").hover(function(){
											$(this).css("cursor","pointer");
										});

										$('#nav-section-left a').click(function(e) {
										  e.preventDefault();
										  $(this).tab('show');
										});

										// store the currently selected tab in the hash value
										$(".hashes > a").on("shown.bs.tab", function(e) {
										  var id = $(e.target).attr("href").substr(1);
										  window.location.hash = id;

										});

										// on load of the page: switch to the currently selected tab
										var hash = window.location.hash;
										$('#nav-section-left a[href="' + hash + '"]').tab('show');
								
								});


						</script>
					<div class="col-md-10 tab-content" id="right_section">
							  
							  <div class="tab-pane fade in active" id="log_section">
							  <div class="loading-div"><img src="images/ajax-loader2.gif" width="300" height="300"/></div>
							  <script type="text/javascript">
							  	//loads the log files every two seconds so the admin can get
							  	//live update of the logs
							  	$(function(){
							  		setInterval(function(){
										$("#log_section").load("log/log.php");
									}, 2000);
							  	})

							  </script>

							  </div>

							  <div class="tab-pane fade in" id="user_account">
							  	<?php include('accounts/account.php');?>
							  	
							  </div>
							  
							  <div class="tab-pane fade in" id="eventM">
							  	
							  </div>
							  <div class="tab-pane fade in" id="settings">
							  	<?php include('settings/settings.php');?>
							  	
							  </div>
					</div>

					




					</div>





			</div>



	</body>
</html>