	$(function(){
			$(".orgMessage").click(function(){
				$.ajax({
				        type: "POST",
				        url: "checkLogin.php",
				        success:function(data) {
				         if(data.status == 'success'){
				         	//shows message box if user is logged in
				         	$("#loginWindow").modal('hide');
				         	$('#messageBox').modal('show');

				         }
				         else if(data.status == 'error'){
				         	//shows login modal window
				         	$("#loginWindow").modal('show')
				         	$('#messageBox').modal('hide');
				         	;
				         }

		        }

			});

		});
	});