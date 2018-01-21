
<div class="navbar navbar-inverse navbar-fixed-top">
   <div class="container">
      <div class="navbar-header">

         <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         </button>
          <a href="index.php"><img  class="floatLeft logo"  src="logo/vent.png" ></a>
         <a class="navbar-brand"  href="index.php">VENT</a>
        
         <form class="navbar-form pull-left" role="search">
            <div class="input-group">
               <input type="text" class="form-control" placeholder="Search">
               <div class="input-group-btn">
                  <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
               </div>
            </div>
         </form>
         <a id="headCreateEventButton" class="btn btn-default createEventBtn" title="Create New Event">Create Event</a>
      </div>
       <div class="navbar-collapse collapse">
         <ul class="nav navbar-nav navbar-right">
          <?php
              if(isset($_SESSION['Login'])){
                $currUser=$_SESSION['AccountNum'];

                include('dbconnect.php');

                  echo"<li><a href=\"browse.php\">Browse Events</a></li>";
                  
                  //unread messages
                  $unread_message="SELECT id FROM messages WHERE messages.Status='Unread' AND messages.user_to ='$currUser'";
                  $query_Message_count=mysqli_query($conn, $unread_message);
                  $numrows=mysqli_num_rows($query_Message_count);

                  $whichUserQuery=mysqli_query($conn,"SELECT user_from,SendTime FROM messages WHERE messages.Status='Unread' AND user_from !='$currUser' ORDER BY SendTime  DESC LIMIT 1");
                  $whichUser=mysqli_fetch_assoc($whichUserQuery);
               

                  $whichUserID=(!empty($whichUser))?"&id=".$whichUser['user_from']:"";
              
                 $queryString="user=".$_SESSION['AccountNum'].$whichUserID;

                  echo "<li><a href=\"messages.php?{$queryString}\">Messages";
                  if($numrows>0) echo "({$numrows})";
                  echo "</a></li>";
                  echo " <li><div class=\"dropdown movedown\">";
                  echo        "<button class=\"btn btn-default dropdown-toggle\" type=\"button\" id=\"dropdownMenu1\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"true\">";
                  

                 if($conn){
                    
                      $result=mysqli_query($conn,"SELECT FirstName,thumb FROM user WHERE AccountNum='$currUser'");
                      $row=mysqli_fetch_assoc($result);
                     
                         echo (!empty($row['thumb']))? "<img id=\"idpicture\" src=\"{$row['thumb']}\">": "<img id=\"idpicture\" src=\"account/photo/profile_pictures/default.jpg\">";
                          echo  $row['FirstName'];
                      mysqli_close($conn);
                  }
                  else
                  {
                       echo "<img id=\"idpicture\" src=\"account/photo/profile_pictures/default.jpg\">";
                        echo "User";
                  }


                  echo        "<span class=\"caret\"></span></button>";    
                  echo        "<ul class=\"dropdown-menu\" aria-labelledby=\"dropdownMenu1\">";
                  echo          "<li><a href=\"followed.php\">Followed</a></li>";
                  echo          "<li><a href=\"manageEvent.php\">Manage Events</a></li>";
                  echo          "<li><a href=\"myprofile.php\">Organizer's Profile</a></li>";

                  echo          "<li role=\"separator\" class=\"divider\"></li>";
                  echo          "<li><a href=\"myaccount.php\">Account Settings</a></li>";
                  echo          "<li><a href=\"logout.php\">Logout</a></li>";
                  echo        "</ul></div></li>";
              }
              else
              {
              echo"<li><a href=\"browse.php\">Browse Events</a></li>";
              echo "<li><a href=\"\" data-toggle=\"modal\" data-target=\"#loginWindow\">Login</a></li>";
              echo "<li><a href=\"register.php\">Register</a></li>";
            }
          ?>
      
         </ul>
      </div>
      <!--/.navbar-collapse -->
   </div>
</div>




<div class="modal fade" id="loginWindow" role="dialog">
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2 class="modal-title">Login</h2>
          	<h4><a href="register.php">or Sign up</a></h4>
        </div>
       <div class="modal-body">
	       	<form method="post">
				<input type="email" class="form-control" placeholder="vent@vent.com" name="email"  required>
				<input type="password" class="form-control" placeholder="Enter Password" name="password" required>
				<input type="submit" class="btn btn-success floatRight" id="logbtn" value="Login" name="login">
				<a href="forgot.php" class="forgot">Forgot Password?</a>
			</form>
      <?php include('login.php');?>
   	 </div>
      </div>
      
    </div>
 </div>
 <script type="text/javascript" src="_/js/checkLoginCreateEvent.js"></script>

