$(document).ready(function() {
		var id = '#Thanks';	
		//Get the screen height and width
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
		//Set heigth and width to mask to fill up the whole screen
		$('.modal-overlay').css({'width':maskWidth,'height':maskHeight});
		//transition effect		
		$('.modal-overlay').fadeIn(500);	
		$('.modal-overlay').fadeTo("slow",0.5);	
		//transition effect
		$(id).fadeIn(2000); 	
	//if close button is clicked
	$('.modal .modal-close').click(function (e) {
		//Cancel the link behavior
		e.preventDefault();
		$('.modal-overlay').hide();
		$('.modal').hide();
	});
	
	//if mask is clicked
	$('.modal-overlay').click(function () {
		$(this).hide();
		$('.modal').hide();
	});		



 

});