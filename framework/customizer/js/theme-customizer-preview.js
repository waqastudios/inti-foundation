/**
 * Theme Customizer javascript functions.
 *
 * Contains handlers to make the Customizer preview reload any changes asynchronously.
 *
 */

( function( $ ) {
	
	// Header
	wp.customize('blogname', function(value) {
		value.bind(function(to) {
			$('.site-title a').html(to);
		});
	});
	wp.customize('blogdescription', function(value) {
		value.bind(function(to) {
			$('.site-description').html(to);
		});
	});
	wp.customize('inti_customizer_options[show_title]', function(value) {
		value.bind(function(to) {
			if( to == '' ) {
				$('.site-banner .title-area').css('display', 'none');
			}
			else if( to == 1 ) {
				$('.site-banner .title-area').css('display', 'block');
			};
		});
	});
	wp.customize('inti_customizer_options[show_site_banner_mobile]', function(value) {
		value.bind(function(to) {
			if( to == '' ) {
				$('.site-banner').css('display', 'none');
			}
			else if( to == 1 ) {
				$('.site-banner').css('display', 'block');
			};
		});
	});
	wp.customize('inti_customizer_options[show_nav_logo_title]', function(value) {
		value.bind(function(to) {
			if( to == 'none' ) {
				console.log('none');
				$('.top-bar .site-title, .top-bar .site-logo').css('display', 'none');
			}
			else if( to == 'image' ) {
				console.log('image');
				$('.top-bar .site-logo').css('display', 'block');
				$('.top-bar .site-title').css('display', 'none');
			} else {
				console.log('title');
				$('.top-bar .site-logo').css('display', 'none');
				$('.top-bar .site-title').css('display', 'block');
			};
		});
	});
	
	// Main Styles
	wp.customize('inti_customizer_options[title_font]', function(value) {
		value.bind(function(to) {
			console.log(to);
			$('entry-title').css('font-family', to);
		});
	});
	wp.customize('inti_customizer_options[title_color]', function(value) {
		value.bind(function(to) {
			$('entry-title').css('color', to);
		});
	});
	wp.customize('inti_customizer_options[link_color]', function(value) {
		value.bind(function(to) {
			$('a').css('color', to);
		});
	});
	wp.customize('inti_customizer_options[link_hover_color]', function(value) {
		value.bind(function(to) {
			$('a:hover').css('color', to);
		});
	});

	// Content Styles
	wp.customize('inti_customizer_options[paragraph_font]', function(value) {
		value.bind(function(to) {
			$('.entry-content p, .entry-summary p').css('font-family', to);
		});
	});
	wp.customize('inti_customizer_options[paragraph_size]', function(value) {
		value.bind(function(to) {
			$('.entry-content p, .entry-summary p').css('font-size', to);
		});
	});
	wp.customize('inti_customizer_options[paragraph_color]', function(value) {
		value.bind(function(to) {
			$('.entry-content p, .entry-summary p').css('color', to);
		});
	});
	wp.customize('inti_customizer_options[content_link_color]', function(value) {
		value.bind(function(to) {
			$('.entry-content a, .entry-summary a').css('color', to);
		});
	});
	wp.customize('inti_customizer_options[content_link_hover_color]', function(value) {
		value.bind(function(to) {
			$('.entry-content a:hover, .entry-summary a:hover').css('color', to);
		});
	});

	wp.customize('inti_customizer_options[h1_font]', function(value) {
		value.bind(function(to) {
			$('.entry-content h1, .entry-summary h1').css('font-family', to);
		});
	});
	wp.customize('inti_customizer_options[h1_size]', function(value) {
		value.bind(function(to) {
			$('.entry-content h1, .entry-summary h1').css('font-size', to);
		});
	});
	wp.customize('inti_customizer_options[h1_color]', function(value) {
		value.bind(function(to) {
			$('.entry-content h1, .entry-summary h1').css('color', to);
		});
	});

	wp.customize('inti_customizer_options[h2_font]', function(value) {
		value.bind(function(to) {
			$('.entry-content h2, .entry-summary h2').css('font-family', to);
		});
	});
	wp.customize('inti_customizer_options[h2_size]', function(value) {
		value.bind(function(to) {
			$('.entry-content h2, .entry-summary h2').css('font-size', to);
		});
	});
	wp.customize('inti_customizer_options[h2_color]', function(value) {
		value.bind(function(to) {
			$('.entry-content h2, .entry-summary h2').css('color', to);
		});
	});

	wp.customize('inti_customizer_options[h3_font]', function(value) {
		value.bind(function(to) {
			$('.entry-content h3, .entry-summary h3').css('font-family', to);
		});
	});
	wp.customize('inti_customizer_options[h3_size]', function(value) {
		value.bind(function(to) {
			$('.entry-content h3, .entry-summary h3').css('font-size', to);
		});
	});
	wp.customize('inti_customizer_options[h3_color]', function(value) {
		value.bind(function(to) {
			$('.entry-content h3, .entry-summary h3').css('color', to);
		});
	});

	wp.customize('inti_customizer_options[h4_font]', function(value) {
		value.bind(function(to) {
			$('.entry-content h4, .entry-summary h4').css('font-family', to);
		});
	});
	wp.customize('inti_customizer_options[h4_size]', function(value) {
		value.bind(function(to) {
			$('.entry-content h4, .entry-summary h4').css('font-size', to);
		});
	});
	wp.customize('inti_customizer_options[h4_color]', function(value) {
		value.bind(function(to) {
			$('.entry-content h4, .entry-summary h4').css('color', to);
		});
	});

	wp.customize('inti_customizer_options[h5_font]', function(value) {
		value.bind(function(to) {
			$('.entry-content h5, .entry-summary h5').css('font-family', to);
		});
	});
	wp.customize('inti_customizer_options[h5_size]', function(value) {
		value.bind(function(to) {
			$('.entry-content h5, .entry-summary h5').css('font-size', to);
		});
	});
	wp.customize('inti_customizer_options[h5_color]', function(value) {
		value.bind(function(to) {
			$('.entry-content h5, .entry-summary h5').css('color', to);
		});
	});

	wp.customize('inti_customizer_options[h6_font]', function(value) {
		value.bind(function(to) {
			$('.entry-content h6, .entry-summary h6').css('font-family', to);
		});
	});
	wp.customize('inti_customizer_options[h6_size]', function(value) {
		value.bind(function(to) {
			$('.entry-content h6, .entry-summary h6').css('font-size', to);
		});
	});
	wp.customize('inti_customizer_options[h6_color]', function(value) {
		value.bind(function(to) {
			$('.entry-content h6, .entry-summary h6').css('color', to);
		});
	});





} )( jQuery );