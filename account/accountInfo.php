<?php
		
function checkPass($x,$y){
		if($x==md5($y)){
			return true;
		}
		else{
			return false;
		}
	}
?>
<div class="col-md-12">
			<h2>Account Information</h2>
			<div class="col-md-6">
					<div id="accountDetails">
					<h3>Your Email Address</h3>
					<p>
					<?php echo $_SESSION['Email'];?>
					</p>
					<button class="btn btn-primary" id="clickChange">Change</button>
							<div id="changeEmail" class="col-md-12 hide">
								<script type="text/javascript" src="_/js/fadeInEvent.js"> </script>
									<form method="post">
											<table class="table">
													<tr><td>New Email</td></tr>
													<tr>
														<td>
														<input class="form-control" name="newEmail" autocomplete="off" type="email" placeholder="a@vent.com" required/>
														</td>
													</tr>
													<tr><td>Current Password</td></tr>
													<tr>
														<td>
														<input class="form-control" type="password"  autocomplete="off" name="password" required/>
														</td>
													</tr>
													<tr>
														<td>
															<button id="cancel" class="btn btn-danger">Cancel</button>
														</td>
														<td><input type="submit"  id="saveEmail" name="saveNewEmail" value="Save" class="btn  noborder btn-success"></td>
													</tr>
											</table>
									</form>
									<?php include ('updateEmail.php');?>
							</div>
					</div>
							<h3>Account Details
									<a id="remove" class="formBtns hide" title="Cancel">
									<span class="glyphicon glyphicon-remove" style="font-size:20px;"></span>
									<span style="font-size:15px">Cancel</span> 
									</a>
									<a id="clickEdit" class="formBtns" title="Edit Account Information">
									<span class="glyphicon glyphicon-edit" ></span>
									<span style="font-size:15px;">Edit</span>
									</a>
							</h3>
							<script type="text/javascript" src="_/js/showHideForm.js"> </script>
							<div id="showForm">
								<?php 
								include('grabUserInfo.php');?>
							</div>
							<div id="editForm" class="hide">
							<form method="post" role="form">
								<table  class="table table-responsive">
									<tr><td class="noborder">Name</td></tr>
									<tr>
										<td><input  class="form-control" type="text"  placeholder="First" name="fname"required value="<?php if(isset($_SESSION['FirstName'])) echo $_SESSION['FirstName'];?>"> </td>
										<td ><input  class="form-control" type="text" placeholder="Last" name="lname" required value="<?php if(isset($_SESSION['LastName'])) echo $_SESSION['LastName'];?>" /></td>
									</tr>
									<tr>
										<td>Gender</td>				
									</tr>
									
									<tr>			
													<td>
														<select  name="gender" class="form-control" required>
													<option value="Male" <?php if(isset($_SESSION['Gender'])&&$_SESSION['Gender']=="Male") echo 'selected="selected"';?> >
														Male
													</option>
													<option value="Female" <?php if(isset($_SESSION['Gender'])&&$_SESSION['Gender']=="Female") echo 'selected="selected"';?> >
														Female
													</option>
													</select>
													</td>
												
									</tr>			
									<tr>
										<td>Phone Number</td>
									</tr>
									
									<tr>
											<td><input type="tel" name="phone" value="<?php if(isset($_SESSION['PhoneNo'])) echo $_SESSION['PhoneNo']; ?>" class="form-control" placeholder="8761234567" pattern="([0-9]{3})(-)?([0-9]{3})(-)?([0-9]{4})" required></td>
									</tr>
									
												<tr>
												<td class="noborder">
												<input type="Submit" value="Save" class="btn btn-success" onclick="return confirm('Are you sure?');" name="editAccount" />
												</td>
												</tr>
												
											
									</table>
								</form>
								<?php include ('updator.php');?>
								</div><!--div for form-->
								
			</div><!--col-md-6-->
			
			<div class="col-md-4" id="profilePic" class="img-responsive">
					<?php
					 include('dbconnect.php');
					 $AccountNum=$_SESSION['AccountNum'];

			if($conn){
					 	
					$sqlAcct=mysqli_query($conn,"SELECT ProfilePicBig FROM user WHERE AccountNum='$AccountNum'");	
					$row=mysqli_fetch_assoc($sqlAcct);

							echo "<img src=\"{$row['ProfilePicBig']}\" id=\"preview\"/>
							<div id=\"showPicOps\">
										<button class=\"btn btn-primary floatLeft \" id=\"changeProfileImgBtn\"> ";
										echo (!empty($row['ProfilePicBig']))?"Change":"Add";
										echo "</button>";
										
								if(!empty($row['ProfilePicBig'])){
										echo "<button class=\"btn btn-danger floatRight\" value=\"{$row['ProfilePicBig']}\" id=\"delAccPic\"> Delete Profile Picture</button>";
									}
								else
								{
									echo "<p class=\"floatLeft\"> a profile picture</p>";
								}
								//if user has a picture already
							$addorchange= (!empty($row['ProfilePicBig']))?"Change":"Add";
							
							echo "</div>
							<form method=\"post\" role=\"form\" enctype=\"multipart/form-data\">
								<div class=\"hidden\" id=\"onclickShowImageFile\" >
								<input type=\"file\"  required id=\"imgFile\" name=\"file_img\">
								<input type=\"Submit\" value=\"{$addorchange} Profile Picture\" class=\"btn btn-success profilePicBtn\" name=\"profilePic\"/>
									<button class=\"btn btn-danger floatRight profilePicBtn\" id=\"cancelProfileImgBtn\"> Cancel</button>
								</div>
							</form>
							";
							include('account/uploadAccountImage.php');
									
			}
			?>
			</div><!--close col-md-4-->
</div><!--close col-md-12-->
<script type="text/javascript" src="_/js/imgPick.js">	</script>
<script type="text/javascript" src="_/js/showImageUpload.js"></script>