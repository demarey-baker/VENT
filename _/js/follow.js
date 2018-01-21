$(document).ready(function(){

$(".follow-click").on("click",function(){
		//grabs value from event to follow
						 var eventid= ($(this).attr("value"));
		 
			 $.ajax({
			 		//check if user is logged in before they can follow an event
				        type: "POST",
				        url: "checkLogin.php",
				        success:function(data) {
				         if(data.status == 'success'){
				         		//if logged in
							         	$.ajax({
								        type: "POST",
								        url: "event/updateFollow.php",
								        data: { EventID: eventid},
								        success:function() {
								         	location.reload();
								        }
								  	  });
				         }
				         else if(data.status == 'error'){
				         	//shows login modal window
				         	$('#loginWindow').modal('show');
				         }
		        }
			});
});

$(".unfollow-click").on("click",function(){
	//fetch value to unfollow
	 var eventid= ($(this).attr("value"));
	 $.ajax({
        type: "POST",
        url: "event/deleteFollow.php",
        data: { EventID: eventid},
        success:function() {
         	location.reload();
        }
    });

});



$("#follow-user").click(function(){

	//which user to follow
		var id= ($(this).attr("value"));
		 
			 $.ajax({
			 		//check if user is logged in before they can follow an event
				        type: "POST",
				        url: "checkLogin.php",
				        success:function(data) {
				         if(data.status == 'success'){
				         		//if logged in
							         	$.ajax({
								        type: "POST",
								        url: "event/followUser.php",
								        data: { UserID:id},
								        success:function() {
								         	location.reload();
								        }
								  	  });
				         }
				         else if(data.status == 'error'){
				         	//shows login modal window
				         	$('#loginWindow').modal('show');
				         }
		        }
			});

});

$("#unfollow-user").click(function(){

	//which user to follow
		var id= ($(this).attr("value"));
		
				         		//if logged in
							         	$.ajax({
								        type: "POST",
								        url: "event/unfollowUser.php",
								        data: { UserID:id},
								        success:function() {
								         	location.reload();
								        }
								  	  });

});




});

