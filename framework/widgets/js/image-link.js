jQuery(document).ready( function(){

	function media_upload( button_class) {
		var _custom_media = true,
		_orig_send_attachment = wp.media.editor.send.attachment;

		jQuery('body').on('click',button_class, function(e) {
			var button_id ='#'+jQuery(this).attr('id');
			/* console.log(button_id); */
			var send_attachment_bkp = wp.media.editor.send.attachment;
			var button = jQuery(button_id);
			var id = button.attr('id').replace('_button', '');
			_custom_media = true;
			wp.media.editor.send.attachment = function(props, attachment){
				if ( _custom_media  ) {
				   //jQuery('.custom_media_id').val(attachment.id); 
				   jQuery('#' + id).val(attachment.url);
				   //jQuery('.custom_media_image').attr('src',attachment.url).css('display','block');   
				} else {
					return _orig_send_attachment.apply( button_id, [props, attachment] );
				}
			}
			wp.media.editor.open(button);
			return false;
		});

	}
	media_upload( '.uploadbutton');
	
});