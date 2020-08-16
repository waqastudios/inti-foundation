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
	$('body').on('change', '#shortcode-picker', function() {
		var $currentShortcode = $('#shortcode-picker').val();
		console.log($currentShortcode);
		$('tr.option').hide();
		$('tr.'+$currentShortcode).slideDown();
	});
})(jQuery);




(function($) {
	$('body').on('click', '#inti-pricing-table-go-2', function() {
		$('tr.option').hide();
		$('tr.inti-pricing-table-2').slideDown();
	});
})(jQuery);
(function($) {
	$('body').on('click', '#inti-pricing-table-go-3', function() {
		$('tr.option').hide();
		$('tr.inti-pricing-table-3').slideDown();
	});
})(jQuery);