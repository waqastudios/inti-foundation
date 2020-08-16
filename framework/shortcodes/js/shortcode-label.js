(function($) {

	$('body').on('change', '#shortcode-picker', function() {
		var $currentShortcode = $('#shortcode-picker').val();
		if( $currentShortcode === 'inti-label' ) {
			$('#yourshortcode').text('[label type=""]label text[/label]');
		}
	});
	$('body').on('click', '#shortcode-insert', function() {
		var $currentShortcode = $('#shortcode-picker').val();
		if( $currentShortcode === 'inti-label' ) {
				var labeltitle     	= $('#label-title').val(),
					labeltype    = $('#label-type').val(),
					labelicon    = $('#label-icon').val();

				var shortcode = '[label';



				if( labeltype ) {
					shortcode += ' type="' + labeltype + '"';
				}
				if( labelicon ) {
					shortcode += ' icon="' + labelicon + '"';
				}

				shortcode += ']' + labeltitle + '[/label]';			// Insert shortcode and remove popup
				tinyMCE.activeEditor.execCommand('mceInsertContent', false, shortcode);
				tb_remove();
		}
	});

})(jQuery);