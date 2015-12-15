(function($) {

	$('#shortcode-picker').live('change', function() {
		var $currentShortcode = $('#shortcode-picker').val();
		if( $currentShortcode === 'inti-dropdown-button' ) {
			$('#yourshortcode').text('[dropdown-button title="button text" type="" style="" align=""][/dropdown-button]');
		}
	});
	$('#shortcode-insert').live('click', function() {
		var $currentShortcode = $('#shortcode-picker').val();
		if( $currentShortcode === 'inti-dropdown-button' ) {
				var buttontitle     = $('#dropdown-button-title').val(),
					buttontype     = $('#dropdown-button-type').val(),
					buttonstyle    = $('#dropdown-button-style').val(),
					buttonalign     = $('#dropdown-button-align').val(),
					buttonhover     = $('#dropdown-button-hover'),
					buttonicon     = $('#dropdown-button-icon'),
					buttoncontent = $('#dropdown-button-content').val();

				var shortcode = '[dropdown-button';

				if( buttontitle ) {
					shortcode += ' title="' + buttontitle + '"';
				} else {
					shortcode += ' title="title"';
				}

				if( buttontype ) {
					shortcode += ' type="' + buttontype + '"';
				}

				if( buttonstyle ) {
					shortcode += ' style="' + buttonstyle + '"';
				}

				if( buttonalign ) {
					shortcode += ' align="' + buttonalign + '"';
				}

				if( buttonhover.is(":checked") ) {
					shortcode += ' hover="' + buttonhover.val() + '"';
				}

				if( buttonicon.is(":checked") ) {
					shortcode += ' icon="' + buttonicon.val() + '"';
				}

				shortcode += ']' + buttoncontent + '[/dropdown-button]';			// Insert shortcode and remove popup
				tinyMCE.activeEditor.execCommand('mceInsertContent', false, shortcode);
				tb_remove();
		}
	});

})(jQuery);