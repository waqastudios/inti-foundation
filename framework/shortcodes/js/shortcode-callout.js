(function($) {

	$('#shortcode-picker').live('change', function() {
		var $currentShortcode = $('#shortcode-picker').val();
		if( $currentShortcode === 'inti-callout' ) {
			$('#yourshortcode').text('[callout type="" style=""][/callout]');
		}
	});
	$('#shortcode-insert').live('click', function() {
		var $currentShortcode = $('#shortcode-picker').val();
		if( $currentShortcode === 'inti-callout' ) {
				var callouttype     = $('#callout-type').val(),
					calloutstyle     = $('#callout-style').val(),
					calloutclose     = $('#callout-close'),
					calloutcontent = $('#callout-content').val();

				var shortcode = '[callout';

				if( callouttype ) {
					shortcode += ' type="' + callouttype + '"';
				}
				if( calloutstyle ) {
					shortcode += ' style="' + calloutstyle + '"';
				}
				if( calloutclose.is(':checked') ) {
					shortcode += ' closeable="' + calloutclose.val() + '"';
				}

				shortcode += ']' + calloutcontent + '[/callout]';			// Insert shortcode and remove popup
				tinyMCE.activeEditor.execCommand('mceInsertContent', false, shortcode);
				tb_remove();
		}
	});

})(jQuery);