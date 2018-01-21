	$(function(){
			$(".createEventBtn").click(function(){
				$.ajax({
				        type: "POST",
				        url: "checkLogin.php",
				        success:function(data) {
				         if(data.status == 'success'){
				         	//redirects to create event page if user is logged in
				         	window.location.href='createEvent.php';
				         }
				         else if(data.status == 'error'){
				         	//shows login modal window because user is not logged in
				         	$('#loginWindow').modal('show');
				         }

		        }

			});

		});
	});