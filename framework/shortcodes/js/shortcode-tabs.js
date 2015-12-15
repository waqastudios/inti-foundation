(function($) {

	$('#shortcode-picker').live('change', function() {
		var $currentShortcode = $('#shortcode-picker').val();
		if( $currentShortcode === 'inti-tabs' ) {
			$('#yourshortcode').text('[tabs][tabs-item title=""]content[/tabs-item][/tabs]');
		}
	});
	$('#shortcode-insert').live('click', function() {
		var $currentShortcode = $('#shortcode-picker').val();
		if( $currentShortcode === 'inti-tabs' ) {
				var taborientation     = $('#tabs-orientation').val();

				var tabitem1title     = $('#tabs-item-1-title').val(),
					tabitem1content = $('#tabs-item-1-content').val();

				var shortcode = '[tabs';

				if ( taborientation == "vertical") {
					shortcode += ' orientation="vertical"';
				}

				shortcode += ']';

				shortcode += '[tabs-item title="' + tabitem1title + '"]' + tabitem1content + '[/tabs-item]';

				shortcode += '[/tabs]';			// Insert shortcode and remove popup
				tinyMCE.activeEditor.execCommand('mceInsertContent', false, shortcode);
				tb_remove();
		}
	});

})(jQuery);