$(function(){
		$(".guestlist").click(function(e){
			e.preventDefault();
			var q=($(this).attr("value"));
			window.location.href='guestlist.php?event='+q;
		});
	});