$(document).ready(function(){
	$("#reply").on("click", function(){
		var message = $.trim($("#message").val()),
			conversation_id = $.trim($("#conversation_id").val()),
			user_form = $.trim($("#user_form").val()),
			user_to = $.trim($("#user_to").val()),
			error = $("#error");

		if((message != "") && (conversation_id != "") && (user_form != "") && (user_to != "")){
			error.text("Sending...");
			$.post("message/postMessageAjax.php",{message:message,conversation_id:conversation_id,user_form:user_form,user_to:user_to}, function(data){
				error.text(data);
				//clear the message box
				$("#message").val("");
			});
		}
	});


	//get message
	c_id = $("#conversation_id").val();
	//get new message every 1.5 second
	setInterval(function(){
		$(".display-message").load("message/getMessageAjax.php?c_id="+c_id);
	}, 1500);

	$(".display-message").scrollTop($(".display-message")[0].scrollHeight);


});