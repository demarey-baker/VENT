$(function() {
			$(".delEvent").click(function(e){
				//grabs eventid value
				 var eventid= ($(this).attr("value"));
				if(!confirm('Are you sure? This cannot be undone!')){
			            e.preventDefault();
			            return false;
       			 }
       			 else{
						 $.ajax({
					        type: "POST",
					        url: "event/deleteEvent.php",
					        data: { EventID: eventid},
					        success:function(data) {
					         if(data.status == 'success'){
					         	alert('Event deleted');
					         	location.reload();
					         }

					         else if(data.status == 'error'){
					         		alert('Error deleting this event');
					         }

					        }
					    });

					 }


			});	
	});