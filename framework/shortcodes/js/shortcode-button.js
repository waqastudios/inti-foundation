(function($) {

	$('body').on('change', '#shortcode-picker', function() {
		var $currentShortcode = $('#shortcode-picker').val();
		if( $currentShortcode === 'inti-button' ) {
			$('#yourshortcode').text('[button url="" target="_blank" type="" style=""][/button]');
		}
	});
	$('body').on('click', '#shortcode-insert', function() {
		var $currentShortcode = $('#shortcode-picker').val();
		if( $currentShortcode === 'inti-button' ) {
				var buttonurl     = $('#button-url').val(),
					buttontarget     = $('#button-target'),
					buttontype     = $('#button-type').val(),
					buttonstyle    = $('#button-style').val(),
					buttoncontent = $('#button-content').val();

				var shortcode = '[button';

				
				shortcode += ' url="' + buttonurl + '"';

				if( buttontarget.is(':checked') ) {
					shortcode += ' target="' + buttontarget.val() + '"';
				}

				if( buttontype ) {
					shortcode += ' type="' + buttontype + '"';
				}

				if( buttonstyle ) {
					shortcode += ' style="' + buttonstyle + '"';
				}

				shortcode += ']' + buttoncontent + '[/button]';			// Insert shortcode and remove popup
				tinyMCE.activeEditor.execCommand('mceInsertContent', false, shortcode);
				tb_remove();
		}
	});

})(jQuery);