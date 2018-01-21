$("#clickEdit").click(function(){
	$("#showForm").addClass("hide");
	$("#editForm").removeClass("hide");
	$(this).addClass("hide");
	$("#remove").removeClass("hide");
});

$("#remove").click(function(){
	$("#editForm").addClass("hide");
	$("#showForm").removeClass("hide");
	$(this).addClass("hide");
	$("#clickEdit").removeClass("hide");
});



