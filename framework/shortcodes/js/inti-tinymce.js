(function() {
	tinymce.PluginManager.add('intifoundationshortcodes', function( editor, url ) {
		editor.addButton( 'intifoundationshortcodes', {
			title : 'Insert Shortcode',
				image : url + '/../images/add.png',
				onclick : function() {
					tb_show('Insert Shortcode', url + '/../tinymce-interface.php?width=auto&height=auto');
				}
		});
	});
})();


(function($) {
	$('#shortcode-picker').live('change', function() {
		var $currentShortcode = $('#shortcode-picker').val();
		console.log($currentShortcode);
		$('tr.option').hide();
		$('tr.'+$currentShortcode).slideDown();
	});
})(jQuery);




(function($) {
	$('#inti-pricing-table-go-2').live('click', function() {
		$('tr.option').hide();
		$('tr.inti-pricing-table-2').slideDown();
	});
})(jQuery);
(function($) {
	$('#inti-pricing-table-go-3').live('click', function() {
		$('tr.option').hide();
		$('tr.inti-pricing-table-3').slideDown();
	});
})(jQuery);