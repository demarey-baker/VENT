<form enctype="multipart/form-data" role="form" action="organizer/orgUpdate.php" method="post">
					<div class="col-md-6">
						
						<?php

							include('dbconnect.php');
								$orgID=$_SESSION['AccountNum'];
							if($conn)
							{
									$result=mysqli_query($conn,"SELECT OrganizerName, OrganizerDesc, OrganizerImage,FLink,TLink,OtherLnk FROM organizer WHERE OrganizerID='$orgID'");
									$row=mysqli_fetch_assoc($result);
									$OrganizerName=$row['OrganizerName'];
									$OrganizerDesc=$row['OrganizerDesc'];
									$OrganizerImage=(!empty($row['OrganizerImage']))?$row['OrganizerImage']:"";
									$FLink=$row['FLink'];
									$TLink=$row['TLink'];
									$OtherLnk=$row['OtherLnk'];

							}
							else
							{


							}
						?>

						<div class="form-group">
					        <h4 for="orgTitle">Organizer Name</h4>
					        <input type="text" class="form-control" required name="orgName"  value="<?php 					 
					        echo isset($_POST['orgName'])? $_POST['orgName']: $OrganizerName; 
					        ?>" id="orgTitle">
					    </div>


					    <div class="form-group">
							  <h4 for="orgDesc">About the Organizer</h4>
							  <textarea class="form-control" name="orgDesc" rows="8" id="orgDesc"><?php 
							  	echo isset($_POST['orgDesc'])? trim($_POST['orgDesc']): $OrganizerDesc;?></textarea>
						</div>
						<h2 class="bottomBorder">Social Media Links</h2>
						<div id="sociaLinks">
							 <div class="form-group">
					        <h4 for="Twitter">Twitter</h4>
					        <input type="text" name="tLInk" class="form-control" id="Twitter" placeholder="Paste link here" value="<?php 					 
					        echo isset($_POST['tLInk'])? $_POST['tLInk']: $TLink; 
					        ?>" >
					    	</div>
					    	<div class="form-group">
					        <h4 for="fceBook">Facebook</h4>
					        <input type="text" name="fceBook" class="form-control" id="fceBook" placeholder="Paste link here" value="<?php 					 
					        echo isset($_POST['fceBook'])? $_POST['fceBook']: $FLink; 
					        ?>" >
					        </div>
					        <div class="form-group">
					        <h4 for="otherLink">Other Link</h4>
					        <input type="text" name="oLink" class="form-control" id="otherLink" placeholder="Paste link here" value="<?php 					 
					        echo isset($_POST['oLink'])? $_POST['oLink']: $OtherLnk; 
					        ?>" >
					    	</div>
					    </div>

					    <div>
					    <input type="Submit" value="Update" class="btn btn-primary btn-lg" name="update"/>	
					    </div>


</div>
</form>

<div class="col-md-4">
	<div id="ImageOrgPreview">
		<?php 
			//if empty not file doesnt exist
			if(empty($OrganizerImage)&&!file_exists($OrganizerImage))
			{
				
				//no Image
				echo "<img src=\"{$OrganizerImage}\" id=\"preview\"/>";
				echo	'<div id="hideOrgDiv">
	  				<button class="btn btn-warning" id="addImgFromProfile" value="">Use same picture from your profile</button>
					<h4>OR</h4>
					<button class="btn btn-primary addOrgPhoto">Add an Organizer Image</button></div>';
				echo '<div id="showDivOrg" class="hidden"> 
						<form method="post" role="form" enctype="multipart/form-data">
						<input type="file" id="imgFile" required name="file_img"/>
					<input type="submit" class="btn btn-success floatRight" name="org_Img" value="Save Photo">
					<button class="btn btn-danger" id="cancelOrgPic">Cancel</button></form>
					</div>';



			}
			else
			{
				//User has an Umage
					echo "<img src=\"$OrganizerImage\" id=\"preview\"/>";
					echo '<div id="pushDownLnks">
					<button class="btn btn-success" id="upLoadDifferent">Upload a different photo</button>';
					echo "<button class=\"btn btn-danger floatRight\" id=\"delOrgPic\" value=\"$OrganizerImage\">Delete photo</button></div>";
					echo '<div id="showDivOrg" class="hidden">
						<form method="post" role="form" enctype="multipart/form-data"> 
						<input required type="file" id="imgFile" name="file_img"/>
						<input type="submit" class="btn btn-success floatRight" name="org_Img" value="Save Photo">
						<button class="btn btn-danger" id="cancelOrgPic2">Cancel</button></form>
						</div>';
			}

			include('ImageUpload.php');

		?>
		<script type="text/javascript">
			$(function(){
				$(".addOrgPhoto").click(function(){
					$("#hideOrgDiv").addClass("hidden");
					$("#showDivOrg").removeClass("hidden");
				});
				$("#cancelOrgPic").click(function(){
					$("#hideOrgDiv").removeClass("hidden");
					$("#showDivOrg").addClass("hidden");
				});
				$("#upLoadDifferent").click(function(){
					$("#showDivOrg").removeClass("hidden");
					$("#pushDownLnks").addClass("hidden");

				});
				$("#cancelOrgPic2").click(function(){
					$("#pushDownLnks").removeClass("hidden");
					$("#showDivOrg").addClass("hidden");
				});


			});


		</script>
		<script type="text/javascript" src="_/js/orgPic.js"></script>
		<script type="text/javascript" src="_/js/imgPick.js">	</script>
		
		
	</div>
	 
</div>