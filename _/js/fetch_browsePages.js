$(document).ready(function() {
	$("#results" ).load( "browse/fetch_pages.php"); //load initial records
	
	//executes code below when user click on pagination1 links
	$("#results").on( "click", ".pagination1 a", function (e){
		e.preventDefault();
		$(".loading-div").show(); //show loading element
		var page = $(this).attr("data-page"); //get page number from link
		$("#results").load("browse/fetch_pages.php",{"page":page}, function(){ //get content from PHP page
			$(".loading-div").hide(); //once done, hide loading element
			$('html, body').animate({ scrollTop: 0 }, 'slow');//sends back scroll to the top of page
		});
		
	});
});