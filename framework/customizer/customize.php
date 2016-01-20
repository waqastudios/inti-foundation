<?php 
/**
 * Inti Theme Customizer
 * Adds settings to the WP Theme Customizer
 * and generates custom CSS/JS from those settings
 *
 * @package Inti
 * @author Anthony Wilhelm (@awshout / anthonywilhelm.com)
 * @author Samuel Wood (Otto) (@Otto42 / ottopress.com)
 * @link http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
 * @since 1.0.0
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */
 
/**
 * Add Customizer generated CSS to header
 *
 * @since 1.0.0
 */
function inti_customizer_css() {
	do_action('inti_customizer_css');
		
	$output = '';	


	if ( 0 == get_inti_option('show_title', 'inti_customizer_options', 1) ) {
		$output .= "\n" . '.site-banner .title-area { display: none; }';
	}	
	if ( 'none' == get_inti_option('show_nav_logo_title', 'inti_customizer_options', 1) ) {
		$output .= "\n" . '.top-bar .site-logo, .top-bar .site-title { display: none; }';
	} elseif ( 'image' == get_inti_option('show_nav_logo_title', 'inti_customizer_options', 1) ) {
		$output .= "\n" . '.top-bar .site-title { display: none; }';
	} else {
		$output .= "\n" . '.top-bar .site-logo { display: none; }';
	}



	if ( "'Helvetica Neue', Helvetica, Arial, sans-serif" != get_inti_option('title_font', 'inti_customizer_options', "'Helvetica Neue', Helvetica, Arial, sans-serif") ) {
		$output .= "\n" . '.entry-title { font-family: ' . get_inti_option('title_font', 'inti_customizer_options') . '; }';
	}
	if ( get_inti_option('title_color', 'inti_customizer_options') ) {
		$output .= "\n" . '.entry-title { color: ' . get_inti_option('title_color', 'inti_customizer_options') . '; }';
	}
	if ( get_inti_option('link_color', 'inti_customizer_options') ) {
		$output .= "\n" . 'a { color: ' . get_inti_option('link_color', 'inti_customizer_options') . '; }';
	}
	if ( get_inti_option('link_hover_color', 'inti_customizer_options') ) {
		$output .= "\n" . 'a:hover { color: ' . get_inti_option('link_hover_color', 'inti_customizer_options') . '; }';
	}



	if ( "'Open Sans', sans-serif" != get_inti_option('paragraph_font', 'inti_customizer_options', "'Open Sans', sans-serif") ) {
		$output .= "\n" . '.entry-content, .entry-summary { font-family: ' . get_inti_option('paragraph_font', 'inti_customizer_options') . '; }';
	}
	if ( get_inti_option('paragraph_size', 'inti_customizer_options') ) {
		$output .= "\n" . '.entry-content p, .entry-content li, .entry-summary p, .entry-summary li { font-size: ' . get_inti_option('paragraph_size', 'inti_customizer_options') . '; }';
	}
	if ( get_inti_option('paragraph_color', 'inti_customizer_options') ) {
		$output .= "\n" . '.entry-content, .entry-summary { color: ' . get_inti_option('paragraph_color', 'inti_customizer_options') . '; }';
	}
	if ( get_inti_option('content_link_color', 'inti_customizer_options') ) {
		$output .= "\n" . '.entry-content a, .entry-summary a { color: ' . get_inti_option('content_link_color', 'inti_customizer_options') . '; }';
	}
	if ( get_inti_option('content_link_hover_color', 'inti_customizer_options') ) {
		$output .= "\n" . '.entry-content a:hover, .entry-summary a:hover { color: ' . get_inti_option('content_link_hover_color', 'inti_customizer_options') . '; }';
	}

	if ( "'Open Sans', sans-serif" != get_inti_option('h1_font', 'inti_customizer_options', "'Open Sans', sans-serif") ) {
		$output .= "\n" . '.entry-content h1, .entry-summary h1 { font-family: ' . get_inti_option('h1_font', 'inti_customizer_options') . '; }';
	}
	if ( get_inti_option('h1_size', 'inti_customizer_options') ) {
		$output .= "\n" . '.entry-content h1, .entry-summary h1 { font-size: ' . get_inti_option('h1_size', 'inti_customizer_options') . '; }';
	}
	if ( get_inti_option('h1_color', 'inti_customizer_options') ) {
		$output .= "\n" . '.entry-content h1, .entry-summary h1 { color: ' . get_inti_option('h1_color', 'inti_customizer_options') . '; }';
	}
	if ( "'Open Sans', sans-serif" != get_inti_option('h2_font', 'inti_customizer_options', "'Open Sans', sans-serif") ) {
		$output .= "\n" . '.entry-content h2, .entry-summary h2 { font-family: ' . get_inti_option('h2_font', 'inti_customizer_options') . '; }';
	}
	if ( get_inti_option('h2_size', 'inti_customizer_options') ) {
		$output .= "\n" . '.entry-content h2, .entry-summary h2 { font-size: ' . get_inti_option('h2_size', 'inti_customizer_options') . '; }';
	}
	if ( get_inti_option('h2_color', 'inti_customizer_options') ) {
		$output .= "\n" . '.entry-content h2, .entry-summary h2 { color: ' . get_inti_option('h2_color', 'inti_customizer_options') . '; }';
	}
	if ( "'Open Sans', sans-serif" != get_inti_option('h3_font', 'inti_customizer_options', "'Open Sans', sans-serif") ) {
		$output .= "\n" . '.entry-content h3, .entry-summary h3 { font-family: ' . get_inti_option('h3_font', 'inti_customizer_options') . '; }';
	}
	if ( get_inti_option('h3_size', 'inti_customizer_options') ) {
		$output .= "\n" . '.entry-content h3, .entry-summary h3 { font-size: ' . get_inti_option('h3_size', 'inti_customizer_options') . '; }';
	}
	if ( get_inti_option('h3_color', 'inti_customizer_options') ) {
		$output .= "\n" . '.entry-content h3, .entry-summary h3 { color: ' . get_inti_option('h3_color', 'inti_customizer_options') . '; }';
	}
	if ( "'Open Sans', sans-serif" != get_inti_option('h4_font', 'inti_customizer_options', "'Open Sans', sans-serif") ) {
		$output .= "\n" . '.entry-content h4, .entry-summary h4 { font-family: ' . get_inti_option('h4_font', 'inti_customizer_options') . '; }';
	}
	if ( get_inti_option('h4_size', 'inti_customizer_options') ) {
		$output .= "\n" . '.entry-content h4, .entry-summary h4 { font-size: ' . get_inti_option('h4_size', 'inti_customizer_options') . '; }';
	}
	if ( get_inti_option('h4_color', 'inti_customizer_options') ) {
		$output .= "\n" . '.entry-content h4, .entry-summary h4 { color: ' . get_inti_option('h4_color', 'inti_customizer_options') . '; }';
	}
	if ( "'Open Sans', sans-serif" != get_inti_option('h5_font', 'inti_customizer_options', "'Open Sans', sans-serif") ) {
		$output .= "\n" . '.entry-content h5, .entry-summary h5 { font-family: ' . get_inti_option('inti_customizer_options', 'h5_font') . '; }';
	}
	if ( get_inti_option('h5_size', 'inti_customizer_options') ) {
		$output .= "\n" . '.entry-content h5, .entry-summary h5 { font-size: ' . get_inti_option('h5_size', 'inti_customizer_options') . '; }';
	}
	if ( get_inti_option('h5_color', 'inti_customizer_options') ) {
		$output .= "\n" . '.entry-content h5, .entry-summary h5 { color: ' . get_inti_option('h5_color', 'inti_customizer_options') . '; }';
	}
	if ( "'Open Sans', sans-serif" != get_inti_option( 'h6_font', 'inti_customizer_options', "'Open Sans', sans-serif") ) {
		$output .= "\n" . '.entry-content h6, .entry-summary h6 { font-family: ' . get_inti_option('h6_font', 'inti_customizer_options') . '; }';
	}
	if ( get_inti_option('h6_size', 'inti_customizer_options') ) {
		$output .= "\n" . '.entry-content h6, .entry-summary h6 { font-size: ' . get_inti_option('h6_size', 'inti_customizer_options') . '; }';
	}
	if ( get_inti_option('h6_color', 'inti_customizer_options') ) {
		$output .= "\n" . '.entry-content h6, .entry-summary h6 { color: ' . get_inti_option('h6_color', 'inti_customizer_options') . '; }';
	}

	echo ( $output ) ? '<style>' . apply_filters('inti_customizer_css', $output) . "\n" . '</style>' . "\n" : '';
}
add_action('wp_head', 'inti_customizer_css');


/**
 * JavaScript handlers to make Theme Customizer preview reload changes asynchronously.
 * Credit: Twenty Twelve 1.0
 *
 * @since 1.0.0
 */
function inti_customize_preview_js() {
	wp_enqueue_script('inti-customizer', get_template_directory_uri() . '/framework/customizer/js/theme-customizer.js', array('customize-preview'), filemtime(get_template_directory() . '/framework/customizer/js/theme-customizer.js'), true );
}
add_action('customize_preview_init', 'inti_customize_preview_js');


/**
 * Add CSS to the WP Theme Customizer page
 *
 * @since 1.0.0
 */
function inti_customize_preview_css() {
	echo '
	<style type="text/css">
		.customize-control { margin-bottom:16px; }
		.customize-control-radio { padding:0; }
		.customize-control-checkbox label { line-height:20px; }
	</style>';
}
add_action('customize_controls_print_styles', 'inti_customize_preview_css', 99);


/**
 * Register Customizer
 *
 * @author Samuel Wood (Otto) (@Otto42 / ottopress.com)
 * @link http://ottopress.com/2012/theme-customizer-part-deux-getting-rid-of-options-pages/
 * @since 1.0.0
 */
if ( !function_exists('inti_customize_register') ) {
	add_action('customize_register', 'inti_customize_register');

	function inti_customize_register( $wp_customize ) {
		
		do_action('inti_customize_register', $wp_customize);
		
		class WP_Customize_Textarea_Control extends WP_Customize_Control {
		public $type = 'textarea';
	 
			public function render_content() { ?>
				<label><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
				</label>
			<?php
			}
		}
		
		/**
		 * modified dropdown-pages 
		 * from wp-includes/class-wp-customize-control.php
		 *
		 * @since 1.0.0
		 */
		class WP_Customize_Dropdown_Categories_Control extends WP_Customize_Control {
		public $type = 'dropdown-categories';	
		
			public function render_content() {
				$dropdown = wp_dropdown_categories( 
					array( 
						'name'             => '_customize-dropdown-categories-' . $this->id,
						'echo'             => 0,
						'hide_empty'       => false,
						'show_option_none' => '&mdash; ' . __('Select', 'inti') . ' &mdash;',
						'hide_if_empty'    => false,
						'selected'         => $this->value(),
					 )
				 );
	
				$dropdown = str_replace('<select', '<select ' . $this->get_link(), $dropdown );
	
				printf( 
					'<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
					$this->label,
					$dropdown
				 );
			}
		}
		
		/**
		 * modified dropdown-pages 
		 * from wp-includes/class-wp-customize-control.php
		 *
		 * @since 1.0.0
		 */
		class WP_Customize_Dropdown_Slide_Categories_Control extends WP_Customize_Control {
		public $type = 'dropdown-slide-categories';	
		
			public function render_content() {
				$dropdown = wp_dropdown_categories( 
					array( 
						'name'              => '_customize-dropdown-slide-categories-' . $this->id,
						'echo'              => 0,
						'hide_empty'        => false,
						'show_option_none'  => '&mdash; ' . __('Select', 'inti') . ' &mdash;',
						'hide_if_empty'     => false,
						'name'              => 'slide-cat',
						'taxonomy'          => 'slide-category',
						'selected'          => $this->value(),
					 )
				 );
	
				$dropdown = str_replace('<select', '<select ' . $this->get_link(), $dropdown );
	
				printf( 
					'<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
					$this->label,
					$dropdown
				 );
			}
		}
		
		/**
		 * Remove default WP Customize sections
		 *
		 * @since 1.0.0
		 */
		$wp_customize->remove_section('title_tagline');
		$wp_customize->remove_section('colors');
		$wp_customize->remove_section('header_image');
		$wp_customize->remove_section('background_image');
		$wp_customize->remove_section('static_front_page');
		$wp_customize->remove_section('nav');
		
		/**
		 * setup customizer settings
		 *
		 * @since 1.0.0
		 */
		 
		// Header
		$wp_customize->add_section('inti_customizer_general', array( 
			'title'    => __('General', 'inti'),
			'priority' => 5,
		 ) );

			$wp_customize->add_setting('blogname', array( 
				'default'    => get_option('blogname'),
				'type'       => 'option',
				'capability' => 'manage_options',
				'transport'  => 'postMessage',
			 ) );
				$wp_customize->add_control('blogname', array( 
					'label'    => __('Site Title', 'inti'),
					'section'  => 'inti_customizer_general',
					'priority' => 1,
				 ) );

			$wp_customize->add_setting('blogdescription', array( 
				'default'    => get_option('blogdescription'),
				'type'       => 'option',
				'capability' => 'manage_options',
				'transport'  => 'postMessage',
			 ) );
				$wp_customize->add_control('blogdescription', array( 
					'label'    => __('Tagline', 'inti'),
					'section'  => 'inti_customizer_general',
					'priority' => 2,
				 ) );

			$wp_customize->add_setting('inti_customizer_options[show_title]', array( 
				'default'    => 1,
				'type'       => 'option',
				'capability' => 'manage_options',
				'transport'  => 'postMessage',
			 ) );	
				$wp_customize->add_control('inti_customizer_options[show_title]', array( 
					'label'    => __('Show Title & Tagline', 'inti'),
					'section'  => 'inti_customizer_general',
					'type'     => 'checkbox',
					'priority' => 3,
				 ) );

			$wp_customize->add_setting('inti_customizer_options[logo_image]', array( 
				'default'    => '',
				'type'       => 'option',
				'capability' => 'manage_options',
			 ) );
				$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'inti_logo_image', array( 
					'label'    => __('Site Banner/Logo', 'inti'),
					'section'  => 'inti_customizer_general',
					'settings' => 'inti_customizer_options[logo_image]',
					'priority' => 4,
				 ) ) );

			$wp_customize->add_setting('inti_customizer_options[show_site_banner_mobile]', array( 
				'default'    => 1,
				'type'       => 'option',
				'capability' => 'manage_options',
				'transport'  => 'postMessage',
			 ) );	
				$wp_customize->add_control('inti_customizer_options[show_site_banner_mobile]', array( 
					'label'    => __('Show Site Logo/Banner on Mobile', 'inti'),
					'section'  => 'inti_customizer_general',
					'type'     => 'checkbox',
					'priority' => 5,
				 ) );

			$wp_customize->add_setting('inti_customizer_options[nav_logo_image]', array( 
				'default'    => '',
				'type'       => 'option',
				'capability' => 'manage_options',
			 ) );
				$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'inti_nav_logo_image', array( 
					'label'    => __('Site Logo for Mobile Nav', 'inti'),
					'section'  => 'inti_customizer_general',
					'settings' => 'inti_customizer_options[nav_logo_image]',
					'priority' => 6,
				 ) ) );

			$wp_customize->add_setting('inti_customizer_options[show_nav_logo_title]', array( 
				'default'    => 1,
				'type'       => 'option',
				'capability' => 'manage_options',
				'transport'  => 'postMessage',
			 ) );	
				$wp_customize->add_control('inti_customizer_options[show_nav_logo_title]', array( 
					'label'    => __('Show Logo/Title in Mobile Nav', 'inti'),
					'section'  => 'inti_customizer_general',
					'type'     => 'select',
					'choices'  => array(
						'none' => __('Nothing', 'inti'),
						'image' => __('Image/Logo', 'inti'),
						'title' => __('Site Title', 'inti')
								),
					'priority' => 7,
				 ) );

			$wp_customize->add_setting('inti_customizer_options[favicon_image]', array( 
				'default'    => '',
				'type'       => 'option',
				'capability' => 'manage_options',
			 ) );
				$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'inti_favicon_image', array( 
					'label'    => __('Favicon', 'inti'),
					'section'  => 'inti_customizer_general',
					'settings' => 'inti_customizer_options[favicon_image]',
					'priority' => 8,
				 ) ) );

			$wp_customize->add_setting('inti_customizer_options[apple_touch_icon]', array( 
				'default'    => '',
				'type'       => 'option',
				'capability' => 'manage_options',
			 ) );
				$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'inti_apple_touch_icon', array( 
					'label'    => __('Apple Touch Icon', 'inti'),
					'section'  => 'inti_customizer_general',
					'settings' => 'inti_customizer_options[apple_touch_icon]',
					'priority' => 9,
				 ) ) );

			$wp_customize->add_setting('inti_customizer_options[ms_tile_color]', array( 
				'default'    => '',
				'type'       => 'option',
				'capability' => 'manage_options',
			 ) );
				$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inti_ms_tile_color', array( 
					'label'    => __('Windows Tile Color', 'inti'),
					'section'  => 'inti_customizer_general',
					'settings' => 'inti_customizer_options[ms_tile_color]',
					'priority' => 10,
				 ) ) );

			$wp_customize->add_setting('inti_customizer_options[ms_tile_image]', array( 
				'default'    => '',
				'type'       => 'option',
				'capability' => 'manage_options',
			 ) );
				$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'inti_ms_tile_image', array( 
					'label'    => __('Windows Tile Image', 'inti'),
					'section'  => 'inti_customizer_general',
					'settings' => 'inti_customizer_options[ms_tile_image]',
					'priority' => 11,
				 ) ) );

			$wp_customize->add_setting('inti_customizer_options[theme_color]', array( 
				'default'    => '',
				'type'       => 'option',
				'capability' => 'manage_options',
			 ) );
				$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inti_theme_color', array( 
					'label'    => __('Theme Color', 'inti'),
					'section'  => 'inti_customizer_general',
					'settings' => 'inti_customizer_options[theme_color]',
					'priority' => 12,
				 ) ) );
		
		
		// Posts & Pages
		$theme_layouts = inti_get_theme_layouts(false);
		
		$wp_customize->add_section('inti_customizer_posts', array( 
			'title'    => __('Layouts', 'inti'),
			'priority' => 20,
		 ) );

			$wp_customize->add_setting('inti_customizer_options[page_layout]', array( 
				'default'    => '2c-l',
				'type'       => 'option',
				'capability' => 'manage_options',
			 ) );
				$wp_customize->add_control('inti_customizer_options[page_layout]', array( 
					'label'    => __('Default Layout', 'inti'),
					'section'  => 'inti_customizer_posts',
					'type'     => 'select',
					'choices'  => $theme_layouts,
					'priority' => 4,
				 ) );

			$wp_customize->add_setting('inti_customizer_options[page_links]', array( 
				'default'        => 'numbered',
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => 'inti-page-links',
			 ) );
				$wp_customize->add_control('inti_customizer_options[page_links]', array( 
					'label'    => __('Page Link Type', 'inti'),
					'section'  => 'inti_customizer_posts',
					'type'     => 'select',
					'choices'  => array( 
						'numbered'  => __('Numbered', 'inti'),
						'prev_next' => __('Prev / Next', 'inti'),
						 ),
					'priority' => 5,
				 ) );	

			

		// Fonts 
		$font_faces = array_merge(inti_get_typography_os_fonts() , inti_get_typography_google_fonts());
		$font_sizes = inti_get_typography_font_sizes();
		
		$wp_customize->add_section('inti_customizer_main_styles', array( 
			'title'          => __('Main Styles', 'inti'),
			'priority'       => 30,
			'theme_supports' => 'inti-fonts',
		 ) );

			$wp_customize->add_setting('inti_customizer_options[title_font]', array( 
				'default'        => "'Helvetica Neue', Helvetica, Arial, sans-serif",
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => 'inti-fonts',
			 ) );
				$wp_customize->add_control('inti_customizer_options[title_font]', array( 
					'label'    => __('Page & Post Titles Font', 'inti'),
					'section'  => 'inti_customizer_main_styles',
					'type'     => 'select',
					'choices'  => $font_faces,
				 ) );

			$wp_customize->add_setting('inti_customizer_options[title_color]', array( 
				'default'              => '',
				'type'                 => 'option',
				'capability'           => 'manage_options',
				'theme_supports'       => 'inti-fonts',
				'sanitize_callback'    => 'maybe_hash_hex_color',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
			 ) );
				$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inti_title_color', array( 
					'label'    => __('Page & Post Titles Color', 'inti'),
					'section'  => 'inti_customizer_main_styles',
					'settings' => 'inti_customizer_options[title_color]',
				 ) ) );

			$wp_customize->add_setting('inti_customizer_options[link_color]', array( 
				'default'              => '',
				'type'                 => 'option',
				'capability'           => 'manage_options',
				'theme_supports'       => 'inti-fonts',
				'sanitize_callback'    => 'maybe_hash_hex_color',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
			 ) );
				$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inti_link_color', array( 
					'label'    => __('General Link Color', 'inti'),
					'section'  => 'inti_customizer_main_styles',
					'settings' => 'inti_customizer_options[link_color]',
				 ) ) );

			$wp_customize->add_setting('inti_customizer_options[link_hover_color]', array( 
				'default'              => '',
				'type'                 => 'option',
				'capability'           => 'manage_options',
				'theme_supports'       => 'inti-fonts',
				'sanitize_callback'    => 'maybe_hash_hex_color',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
			 ) );
				$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inti_link_hover_color', array( 
					'label'    => __('General Link Hover Color', 'inti'),
					'section'  => 'inti_customizer_main_styles',
					'settings' => 'inti_customizer_options[link_hover_color]',
				 ) ) );




		$wp_customize->add_section('inti_customizer_content_styles', array( 
			'title'          => __('Content Styles', 'inti'),
			'priority'       => 55,
			'theme_supports' => 'inti-fonts',
		 ) );
 

			$wp_customize->add_setting('inti_customizer_options[paragraph_font]', array( 
				'default'        => "'Open Sans', sans-serif",
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => 'inti-fonts',
			 ) );
				$wp_customize->add_control('inti_customizer_options[paragraph_font]', array( 
					'label'    => __('Paragraph Font', 'inti'),
					'section'  => 'inti_customizer_content_styles',
					'type'     => 'select',
					'choices'  => $font_faces,
				 ) );

			$wp_customize->add_setting('inti_customizer_options[paragraph_size]', array( 
				'default'        => "",
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => 'inti-fonts',
			 ) );
				$wp_customize->add_control('inti_customizer_options[paragraph_size]', array( 
					'label'    => __('Paragraph Size', 'inti'),
					'section'  => 'inti_customizer_content_styles',
					'type'     => 'select',
					'choices'  => $font_sizes,
				 ) );

			$wp_customize->add_setting('inti_customizer_options[paragraph_color]', array( 
				'default'              => '',
				'type'                 => 'option',
				'capability'           => 'manage_options',
				'theme_supports'       => 'inti-fonts',
				'sanitize_callback'    => 'maybe_hash_hex_color',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
			 ) );
				$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inti_paragraph_color', array( 
					'label'    => __('Paragraph Color', 'inti'),
					'section'  => 'inti_customizer_content_styles',
					'settings' => 'inti_customizer_options[paragraph_color]',
				 ) ) );

			$wp_customize->add_setting('inti_customizer_options[content_link_color]', array( 
				'default'              => '',
				'type'                 => 'option',
				'capability'           => 'manage_options',
				'theme_supports'       => 'inti-fonts',
				'sanitize_callback'    => 'maybe_hash_hex_color',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
			 ) );
				$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inti_content_link_color', array( 
					'label'    => __('Content Link Color', 'inti'),
					'section'  => 'inti_customizer_content_styles',
					'settings' => 'inti_customizer_options[content_link_color]',
				 ) ) );

			$wp_customize->add_setting('inti_customizer_options[content_link_hover_color]', array( 
				'default'              => '',
				'type'                 => 'option',
				'capability'           => 'manage_options',
				'theme_supports'       => 'inti-fonts',
				'sanitize_callback'    => 'maybe_hash_hex_color',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
			 ) );
				$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inti_content_link_hover_color', array( 
					'label'    => __('Content Link Hover Color', 'inti'),
					'section'  => 'inti_customizer_content_styles',
					'settings' => 'inti_customizer_options[content_link_hover_color]',
				 ) ) );

			//h1
			$wp_customize->add_setting('inti_customizer_options[h1_font]', array( 
				'default'        => "'Open Sans', sans-serif",
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => 'inti-fonts',
			 ) );
				$wp_customize->add_control('inti_customizer_options[h1_font]', array( 
					'label'    => __('H1 Font', 'inti'),
					'section'  => 'inti_customizer_content_styles',
					'type'     => 'select',
					'choices'  => $font_faces,
				 ) );

			$wp_customize->add_setting('inti_customizer_options[h1_size]', array( 
				'default'        => "",
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => 'inti-fonts',
			 ) );
				$wp_customize->add_control('inti_customizer_options[h1_size]', array( 
					'label'    => __('H1 Size', 'inti'),
					'section'  => 'inti_customizer_content_styles',
					'type'     => 'select',
					'choices'  => $font_sizes,
				 ) );

			$wp_customize->add_setting('inti_customizer_options[h1_color]', array( 
				'default'              => '',
				'type'                 => 'option',
				'capability'           => 'manage_options',
				'theme_supports'       => 'inti-fonts',
				'sanitize_callback'    => 'maybe_hash_hex_color',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
			 ) );
				$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inti_h1_color', array( 
					'label'    => __('H1 Color', 'inti'),
					'section'  => 'inti_customizer_content_styles',
					'settings' => 'inti_customizer_options[h1_color]',
				 ) ) );

			//h2
			$wp_customize->add_setting('inti_customizer_options[h2_font]', array( 
				'default'        => "'Open Sans', sans-serif",
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => 'inti-fonts',
			 ) );
				$wp_customize->add_control('inti_customizer_options[h2_font]', array( 
					'label'    => __('H2 Font', 'inti'),
					'section'  => 'inti_customizer_content_styles',
					'type'     => 'select',
					'choices'  => $font_faces,
				 ) );

			$wp_customize->add_setting('inti_customizer_options[h2_size]', array( 
				'default'        => "",
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => 'inti-fonts',
			 ) );
				$wp_customize->add_control('inti_customizer_options[h2_size]', array( 
					'label'    => __('H2 Size', 'inti'),
					'section'  => 'inti_customizer_content_styles',
					'type'     => 'select',
					'choices'  => $font_sizes,
				 ) );

			$wp_customize->add_setting('inti_customizer_options[h2_color]', array( 
				'default'              => '',
				'type'                 => 'option',
				'capability'           => 'manage_options',
				'theme_supports'       => 'inti-fonts',
				'sanitize_callback'    => 'maybe_hash_hex_color',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
			 ) );
				$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inti_h2_color', array( 
					'label'    => __('H2 Color', 'inti'),
					'section'  => 'inti_customizer_content_styles',
					'settings' => 'inti_customizer_options[h2_color]',
				 ) ) );

			//h3
			$wp_customize->add_setting('inti_customizer_options[h3_font]', array( 
				'default'        => "'Open Sans', sans-serif",
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => 'inti-fonts',
			 ) );
				$wp_customize->add_control('inti_customizer_options[h3_font]', array( 
					'label'    => __('H3 Font', 'inti'),
					'section'  => 'inti_customizer_content_styles',
					'type'     => 'select',
					'choices'  => $font_faces,
				 ) );

			$wp_customize->add_setting('inti_customizer_options[h3_size]', array( 
				'default'        => "",
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => 'inti-fonts',
			 ) );
				$wp_customize->add_control('inti_customizer_options[h3_size]', array( 
					'label'    => __('H3 Size', 'inti'),
					'section'  => 'inti_customizer_content_styles',
					'type'     => 'select',
					'choices'  => $font_sizes,
				 ) );

			$wp_customize->add_setting('inti_customizer_options[h3_color]', array( 
				'default'              => '',
				'type'                 => 'option',
				'capability'           => 'manage_options',
				'theme_supports'       => 'inti-fonts',
				'sanitize_callback'    => 'maybe_hash_hex_color',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
			 ) );
				$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inti_h3_color', array( 
					'label'    => __('H3 Color', 'inti'),
					'section'  => 'inti_customizer_content_styles',
					'settings' => 'inti_customizer_options[h3_color]',
				 ) ) );

			//h4
			$wp_customize->add_setting('inti_customizer_options[h4_font]', array( 
				'default'        => "'Open Sans', sans-serif",
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => 'inti-fonts',
			 ) );
				$wp_customize->add_control('inti_customizer_options[h4_font]', array( 
					'label'    => __('H4 Font', 'inti'),
					'section'  => 'inti_customizer_content_styles',
					'type'     => 'select',
					'choices'  => $font_faces,
				 ) );

			$wp_customize->add_setting('inti_customizer_options[h4_size]', array( 
				'default'        => "",
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => 'inti-fonts',
			 ) );
				$wp_customize->add_control('inti_customizer_options[h4_size]', array( 
					'label'    => __('H4 Size', 'inti'),
					'section'  => 'inti_customizer_content_styles',
					'type'     => 'select',
					'choices'  => $font_sizes,
				 ) );

			$wp_customize->add_setting('inti_customizer_options[h4_color]', array( 
				'default'              => '',
				'type'                 => 'option',
				'capability'           => 'manage_options',
				'theme_supports'       => 'inti-fonts',
				'sanitize_callback'    => 'maybe_hash_hex_color',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
			 ) );
				$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inti_h4_color', array( 
					'label'    => __('H4 Color', 'inti'),
					'section'  => 'inti_customizer_content_styles',
					'settings' => 'inti_customizer_options[h4_color]',
				 ) ) );

			//h5
			$wp_customize->add_setting('inti_customizer_options[h5_font]', array( 
				'default'        => "'Open Sans', sans-serif",
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => 'inti-fonts',
			 ) );
				$wp_customize->add_control('inti_customizer_options[h5_font]', array( 
					'label'    => __('H5 Font', 'inti'),
					'section'  => 'inti_customizer_content_styles',
					'type'     => 'select',
					'choices'  => $font_faces,
				 ) );

			$wp_customize->add_setting('inti_customizer_options[h5_size]', array( 
				'default'        => "",
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => 'inti-fonts',
			 ) );
				$wp_customize->add_control('inti_customizer_options[h5_size]', array( 
					'label'    => __('H5 Size', 'inti'),
					'section'  => 'inti_customizer_content_styles',
					'type'     => 'select',
					'choices'  => $font_sizes,
				 ) );

			$wp_customize->add_setting('inti_customizer_options[h5_color]', array( 
				'default'              => '',
				'type'                 => 'option',
				'capability'           => 'manage_options',
				'theme_supports'       => 'inti-fonts',
				'sanitize_callback'    => 'maybe_hash_hex_color',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
			 ) );
				$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inti_h5_color', array( 
					'label'    => __('H5 Color', 'inti'),
					'section'  => 'inti_customizer_content_styles',
					'settings' => 'inti_customizer_options[h5_color]',
				 ) ) );


			//h6
			$wp_customize->add_setting('inti_customizer_options[h6_font]', array( 
				'default'        => "'Open Sans', sans-serif",
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => 'inti-fonts',
			 ) );
				$wp_customize->add_control('inti_customizer_options[h6_font]', array( 
					'label'    => __('H6 Font', 'inti'),
					'section'  => 'inti_customizer_content_styles',
					'type'     => 'select',
					'choices'  => $font_faces,
				 ) );

			$wp_customize->add_setting('inti_customizer_options[h6_size]', array( 
				'default'        => "",
				'type'           => 'option',
				'capability'     => 'manage_options',
				'theme_supports' => 'inti-fonts',
			 ) );
				$wp_customize->add_control('inti_customizer_options[h6_size]', array( 
					'label'    => __('H6 Size', 'inti'),
					'section'  => 'inti_customizer_content_styles',
					'type'     => 'select',
					'choices'  => $font_sizes,
				 ) );

			$wp_customize->add_setting('inti_customizer_options[h6_color]', array( 
				'default'              => '',
				'type'                 => 'option',
				'capability'           => 'manage_options',
				'theme_supports'       => 'inti-fonts',
				'sanitize_callback'    => 'maybe_hash_hex_color',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
			 ) );
				$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inti_h6_color', array( 
					'label'    => __('H6 Color', 'inti'),
					'section'  => 'inti_customizer_content_styles',
					'settings' => 'inti_customizer_options[h4_color]',
				 ) ) );


		// Login
		$wp_customize->add_section('inti_customizer_login', array( 
			'title'          => __('Login', 'inti'),
			'priority'       => 55,
			'theme_supports' => 'inti-custom-login',
		 ) );

			$wp_customize->add_setting('inti_customizer_options[login_logo]', array( 
				'default'        => '',
				'type'           => 'option',
				'capability'     => 'manage_options',
				'transport'		=> 'postMessage',
				'theme_supports' => 'inti-custom-login',
			 ) );
				$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'inti_login_logo', array( 
					'label'    => __('Login Logo', 'inti'),
					'section'  => 'inti_customizer_login',
					'settings' => 'inti_customizer_options[login_logo]',
				 ) ) );
				
			$wp_customize->add_setting('inti_customizer_options[login_logo_url]', array( 
				'default'        => '',
				'type'           => 'option',
				'capability'     => 'manage_options',
				'transport'		=> 'postMessage',
				'theme_supports' => 'inti-custom-login',
			 ) );
				$wp_customize->add_control('inti_customizer_options[login_logo_url]', array( 
					'label'    => __('Logo Link URL', 'inti'),
					'section'  => 'inti_customizer_login',
					'type'     => 'text',
				 ) );

			$wp_customize->add_setting('inti_customizer_options[login_logo_title]', array( 
				'default'        => '',
				'type'           => 'option',
				'capability'     => 'manage_options',
				'transport'		=> 'postMessage',
				'theme_supports' => 'inti-custom-login',
			 ) );
				$wp_customize->add_control('inti_customizer_options[login_logo_title]', array( 
					'label'    => __('Logo Title Attribute', 'inti'),
					'section'  => 'inti_customizer_login',
					'type'     => 'text',
				 ) );
				 
	}
}
?>
