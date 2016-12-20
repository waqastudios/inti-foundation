(function($) {

	$('#shortcode-picker').live('change', function() {
		var $currentShortcode = $('#shortcode-picker').val();
		if( $currentShortcode === 'inti-responsive-embed' ) {
			$('#yourshortcode').text('[responsive-embed aspect=""]iframe html[/responsive-embed]');
		}
	});
	$('#shortcode-insert').live('click', function() {
		var $currentShortcode = $('#shortcode-picker').val();
		if( $currentShortcode === 'inti-responsive-embed' ) {
				var flexvideoaspect     = $('#responsive-embed-aspect').val(),
					flexvideohtml    = $('#responsive-embed-html').val();

				var shortcode = '[responsive-embed';

				
				if( flexvideoaspect ) {
					shortcode += ' aspect="' + flexvideoaspect + '"';
				}

				shortcode += ']' + flexvideohtml + '[/responsive-embed]';			// Insert shortcode and remove popup
				tinyMCE.activeEditor.execCommand('mceInsertContent', false, shortcode);
				tb_remove();
		}
	});

})(jQuery);