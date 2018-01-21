$(function(){
	$("#changeProfileImgBtn").click(function(){
		$("#showPicOps").addClass("hidden");
		$("#onclickShowImageFile").removeClass("hidden");
	});


$("#cancelProfileImgBtn").click(function(){
	$("#onclickShowImageFile").addClass("hidden");
		$("#showPicOps").removeClass("hidden");
		
	});


$("#delAccPic").click(function(){
	//fetch value to delete
		var id= ($(this).attr("value"));
						
				if(!confirm('Are you sure? This cannot be undone!')){
			            e.preventDefault();
			            return false;
       			 }
       			 else
       			 {
       			 	//delete via ajax call
						 $.ajax({
					        type: "POST",
					        url: "account/delAccPic.php",
					        data: { PicID: id},
					        success:function(data) {
					         if(data.status == 'success'){
					         	alert('Your profile picture was sucessfully deleted');
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


