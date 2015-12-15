(function($) {

	$('#shortcode-picker').live('change', function() {
		var $currentShortcode = $('#shortcode-picker').val();
		if( $currentShortcode === 'inti-tooltip' ) {
			$('#yourshortcode').text('[tooltip title="" type="" direction=""]content wrapped in tooltip[/tooltip]');
		}
	});
	$('#shortcode-insert').live('click', function() {
		var $currentShortcode = $('#shortcode-picker').val();
		if( $currentShortcode === 'inti-tooltip' ) {
				var tooltiptitle     	= $('#tooltip-title').val(),
					tooltiptype    = $('#tooltip-type').val(),
					tooltipdirection    = $('#tooltip-direction').val(),
					tooltipcontent    = $('#tooltip-content').val();

				var shortcode = '[tooltip';


				if( tooltiptitle ) {
					shortcode += ' title="' + tooltiptitle + '"';
				}

				if( tooltiptype ) {
					shortcode += ' type="' + tooltiptype + '"';
				}

				if( tooltipdirection ) {
					shortcode += ' direction="' + tooltipdirection + '"';
				}

				shortcode += ']' + tooltipcontent + '[/tooltip]';			// Insert shortcode and remove popup
				tinyMCE.activeEditor.execCommand('mceInsertContent', false, shortcode);
				tb_remove();
		}
	});

})(jQuery);