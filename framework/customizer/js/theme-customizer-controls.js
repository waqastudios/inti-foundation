/**
 * Theme Customizer javascript functions.
 *
 * Contains handlers to make the Customizer preview reload any changes asynchronously.
 *
 */

( function( $ ) {

	wp.customizerCtrlEditor = {

		init: function() {

			$(window).load(function(){

				$('textarea.wp-editor-area').each(function(){
					var tArea = $(this),
						id = tArea.attr('id'),
						name = tArea.attr('name'),
						input = $('input[data-customize-setting-link="'+ name +'"]'),
						editor = tinyMCE.get(id),
						setChange,
						content;

					if(editor){console.log(id);
						editor.onChange.add(function (ed, e) {
							ed.save();console.log('OK2');
							content = editor.getContent();
							clearTimeout(setChange);
							setChange = setTimeout(function(){
								input.val(content).trigger('change');
							},500);
						});
					}

					tArea.css({
						visibility: 'visible'
					}).on('keyup', function(){
						content = tArea.val();
						clearTimeout(setChange);
						setChange = setTimeout(function(){
							input.val(content).trigger('change');
						},500);
					});
				});
			});
		}

	};

	wp.customizerCtrlEditor.init();




} )( jQuery );