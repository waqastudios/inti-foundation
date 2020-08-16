(function($) {

	$('body').on('change', '#shortcode-picker', function() {
		var $currentShortcode = $('#shortcode-picker').val();
		if( $currentShortcode === 'inti-accordion' ) {
			$('#yourshortcode').text('[accordion][accordion-item title=""]content[/accordion-item][/accordion]');
		}
	});
	$('body').on('click', '#shortcode-insert', function() {
		var $currentShortcode = $('#shortcode-picker').val();
		if( $currentShortcode === 'inti-accordion' ) {
			var accordionmultiexpand = $('#inti-accordion-multiexpand'),
				accordionallclosed = $('#inti-accordion-allclosed');

			var accordionitem1title     = $('#accordion-item-1-title').val(),
				accordionitem1content = $('#accordion-item-1-content').val();

			var shortcode = '[accordion';

			if ( accordionmultiexpand.is(':checked') ) {
				shortcode += ' allowmultiexpand="true"';
			}			
			if ( accordionallclosed.is(':checked') ) {
				shortcode += ' allowallclosed="true"';
			}
			shortcode += ']';

			shortcode += '[accordion-item title="' + accordionitem1title + '"]' + accordionitem1content + '[/accordion-item]';

			shortcode += '[/accordion]';			// Insert shortcode and remove popup
			tinyMCE.activeEditor.execCommand('mceInsertContent', false, shortcode);
			tb_remove();
		}
	});

})(jQuery);