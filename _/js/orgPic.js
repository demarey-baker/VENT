$(function(){


		$("#addImgFromProfile").click(function(e){	
					 var id='';
					 $.ajax({
				        type: "POST",
				        url: "organizer/savePicFromAccount.php",
				        data: { PictureID: id},
				        success:function(data) {
				         if(data.status == 'success'){
				         	location.reload();
				         }
				         else if(data.status == 'error'){
				         		
				         }

				        }
				    });	

			});




$("#delOrgPic").click(function(e){
		var id= ($(this).attr("value"));
				if(!confirm('Are you sure? This cannot be undone!')){
			            e.preventDefault();
			            return false;
       			 }
       			 else
       			 {
						 $.ajax({
					        type: "POST",
					        url: "organizer/delOrgPic.php",
					        data: { PicID: id},
					        success:function(data) {
					         if(data.status == 'success'){
					         	alert('Your organizer picture was sucessfully deleted');
					         	location.reload();
					         }
					         else if(data.status == 'error'){
					         		alert('Error deleting');
					         }

					        }
					    });

				 }
	});
});