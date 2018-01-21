$(function(){
		$( "#viewEventBanner" ).fadeIn( 2000, function() {
		});

		//not done as yet
		$("#guestlist-add").click(function(){
			 var eventid= ($(this).attr("value")); //fetch value from element 
			 $.ajax({
			 		//check if user is logged in before they can follow an event
				        type: "POST",
				        url: "checkLogin.php",
				        success:function(data) {
				         if(data.status == 'success'){
				         		//if logged in
							         	$.ajax({
								        type: "POST",
								        url: "event/guestlistAdd.php",
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
	$("#guestlist-remove").on("click",function(){
	//fetch value to unfollow
	 var eventid= ($(this).attr("value"));
	 $.ajax({
        type: "POST",
        url: "event/guestlistRemove.php",
        data: { EventID: eventid},
        success:function() {
         	location.reload();
        }
    });

});





});