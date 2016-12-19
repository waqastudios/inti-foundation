(function($) {

	/* Initialize Foundation Scripts */
	$(document).foundation();

})(jQuery);	


// Basic Interface
(function($) {

	// Hamburger Menu active state
	$('.off-canvas').on( "opened.zf.offcanvas", function(){
		$('.hamburger').addClass('is-active');
	});
	$('.off-canvas').on( "closed.zf.offcanvas", function(){
		$('.hamburger').removeClass('is-active');
	});
	
	
})(jQuery);	