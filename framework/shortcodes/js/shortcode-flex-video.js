(function($) {

	$('#shortcode-picker').live('change', function() {
		var $currentShortcode = $('#shortcode-picker').val();
		if( $currentShortcode === 'inti-flex-video' ) {
			$('#yourshortcode').text('[flex-video aspect="" source="youtube" id="0000"][/flex-video]');
		}
	});
	$('#shortcode-insert').live('click', function() {
		var $currentShortcode = $('#shortcode-picker').val();
		if( $currentShortcode === 'inti-flex-video' ) {
				var flexvideoaspect     = $('#flex-video-aspect').val(),
					flexvideosource    = $('#flex-video-source').val(),
					flexvideoid    = $('#flex-video-id').val();

				var shortcode = '[flex-video';

				
				if( flexvideoaspect ) {
					shortcode += ' aspect="' + flexvideoaspect + '"';
				}

				if( flexvideosource ) {
					shortcode += ' source="' + flexvideosource + '"';
				}

				if( flexvideoid ) {
					shortcode += ' id="' + flexvideoid + '"';
				}

				shortcode += ']';			// Insert shortcode and remove popup
				tinyMCE.activeEditor.execCommand('mceInsertContent', false, shortcode);
				tb_remove();
		}
	});

})(jQuery);