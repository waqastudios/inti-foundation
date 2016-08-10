<?php
/**
 * Theme Options
 * Those settings that are not visual go here, others go in the Customizer.
 * @author Tom McFarlin (http://tommcfarlin.com)
 * @author Waqa Studios
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */


/**
 * Add the Javascript we'll need for the options page.
 *
 */
add_action( 'admin_enqueue_scripts', 'inti_options_scripts' );
function inti_options_scripts($hook) {

	if ($hook == "toplevel_page_inti_theme_options"){
	// Javascript to add
		wp_enqueue_media(); 
		wp_enqueue_script('thickbox');     
		wp_register_script( 'inti-options-js', get_template_directory_uri() . '/framework/theme-options/js/inti-options.js', array(), false, true );
		wp_enqueue_script('inti-options-js');

	// CSS to add
		wp_enqueue_style('thickbox');
		wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/library/css/font-awesome-min.css', array(), '' );
		wp_enqueue_style( 'inti-options-css', get_template_directory_uri() . '/framework/theme-options/css/inti-options.css', array(), '' );
	}

}

/**
 * This function introduces the theme options into the 'Appearance' menu and into a top-level 
 * 'Inti Options' menu.
 */
if (!function_exists('inti_options_setup')) {
	add_action( 'admin_menu', 'inti_options_setup' );
	function inti_options_setup() {

		add_theme_page(
			__('Inti Options', 'inti'),                    // The title to be displayed in the browser window for this page.
			__('Inti Options', 'inti'),                    // The text to be displayed for this menu item
			'manage_options',                    // Which type of users can see this menu item
			'inti_theme_options',            // The unique ID - that is, the slug - for this menu item
			'inti_options_interface'             // The name of the function to call when rendering this menu's page
		);
		
		add_menu_page(
			__('Inti Options', 'inti'),                    // The value used to populate the browser's title bar when the menu page is active
			__('Inti Options', 'inti'),                    // The text of the menu in the administrator's sidebar
			'administrator',                    // What roles are able to access the menu
			'inti_theme_options',               // The ID used to bind submenu items to this menu 
			'inti_options_interface'             // The callback function used to render this menu
		);
		
		add_submenu_page(
			'inti_theme_options',               // The ID of the top-level menu page to which this submenu item belongs
			__( 'General Options', 'inti' ),         // The value used to populate the browser's title bar when the menu page is active
			__( 'General Options', 'inti' ),                 // The label of this submenu item displayed in the menu
			'manage_options',                    // What roles are able to access this submenu item
			'inti_theme_options&tab=general_options',    // The ID used to represent this submenu item
			'inti_options_interface'             // The callback function used to render the options for this submenu item
		);
		
		add_submenu_page(
			'inti_theme_options',
			__( 'Header/Navigation', 'inti' ),
			__( 'Header/Navigation', 'inti' ),
			'manage_options',
			'inti_theme_options&tab=headernav_options',
			create_function( null, 'inti_options_interface( "headernav_options" );' )
		);

		add_submenu_page(
			'inti_theme_options',
			__( 'Footer/Analytics', 'inti' ),
			__( 'Footer/Analytics', 'inti' ),
			'manage_options',
			'inti_theme_options&tab=footer_options',
			create_function( null, 'inti_options_interface( "footer_options" );' )
		);

		add_submenu_page(
			'inti_theme_options',
			__( 'Social Media Profiles', 'inti' ),
			__( 'Social Media Profiles', 'inti' ),
			'manage_options',
			'inti_theme_options&tab=social_options',
			create_function( null, 'inti_options_interface( "social_options" );' )
		);
		
		add_submenu_page(
			'inti_theme_options',
			__( 'Commenting', 'inti' ),
			__( 'Commenting', 'inti' ),
			'manage_options',
			'inti_theme_options&tab=commenting_options',
			create_function( null, 'inti_options_interface( "commenting_options" );' )
		);


	} // end inti_options_setup
}

/**
 * Renders a simple page to display for the theme menu defined above.
 */
function inti_options_interface( $active_tab = '' ) {
	$tabs = array(
		'general_options' => __('General', 'inti'),
		'headernav_options' => __('Header/Navigation', 'inti'),
		'footer_options' => __('Footer/Analytics', 'inti'),
		'social_options' => __('Social Media Profiles', 'inti'),
		'commenting_options' => __('Commenting', 'inti')
		);
	$tabs = apply_filters('inti_options_interface_filter_tabs', $tabs);

	// First, set an active tab.
	if( isset( $_GET[ 'tab' ] ) ) {
		$active_tab = $_GET[ 'tab' ];
	} else {
		// foreach ($tabs as $tab => $value) {
		// 	if ( $active_tab == $tab) {
		// 		$active_tab = $tab;
		// 	}
		// }
		reset($tabs);
		$active_tab = key($tabs);
	}
?>
	<div class="wrap">
	
		<div id="icon-themes" class="icon32"></div>
		<h2><?php _e( 'Inti Options', 'inti' ); ?></h2>
		<?php settings_errors(); ?>
		
		<h2 class="nav-tab-wrapper">
		<?php 

			// For each tab, add a link that (an actual visible tab)
			foreach ($tabs as $tab => $value) { ?>
				
				<a href="?page=inti_theme_options&tab=<?php echo $tab; ?>" class="nav-tab <?php echo $active_tab == $tab ? 'nav-tab-active' : ''; ?>"><?php echo $value; ?></a>
		
		<?php	
			}
		?>
		</h2>
			
		
		<form method="post" action="options.php">
			<?php
				
				// For each tab, add the settings fields and sections
				foreach ($tabs as $tab => $value) {
					if ( $active_tab == $tab) {

						// Output nonce and options_page - these names, 'inti_' . '' are used for each settings_section
						settings_fields( 'inti_' . $active_tab );

						// Output everything to the page
						do_settings_sections( 'inti_' . $active_tab );
					}
				}

				submit_button();
			
			?>
		</form>
		
	</div>
<?php
} // end inti_general

/* ------------------------------------------------------------------------ *
 * Setting Registration
 * ------------------------------------------------------------------------ */ 


/**
 * Provides default values for the General Options.
 */
function inti_default_general_options() {
	
	$defaults = array(
		'excerpt_limit'       =>  '45',
		'read_more_text'      =>  'Read more >',
		'blog_interface'       =>  '1',
		'breadcrumbs' 		=> 'top',
		'pagination'      	 =>  'numbered',
		'nextprev_post_links' => 'bottom',
		'frontpage_post_category' => '-1',
		'frontpage_post_number' => '3',
		'frontpage_post_columns' => '1',
		'frontpage_exclude_category'  =>  '1',
		'frontpage_breadcrumbs'  =>  '0',
		'sharing_on_posts'      =>  '1',
		'sharing_on_pages'      =>  '1',
		'page_not_found'       =>   '',
	);
	
	return apply_filters( 'inti_default_general_options', $defaults );
	
} // end inti_default_general_options


/**
 * Provides default values for the Header/Navigation.
 */
function inti_default_headernav_options() {
	
	$defaults = array(
		'nav_social'       =>  '0'
	);
	
	return apply_filters( 'inti_default_headernav_options', $defaults );
	
} // end inti_default_headernav_options


/**
 * Provides default values for the Header/Navigation.
 */
function inti_default_footer_options() {
	
	$defaults = array(
		'footer_social'       =>  '1'
	);
	
	return apply_filters( 'inti_default_footer_options', $defaults );
	
} // end inti_default_footer_options


/**
 * Provides default values for the Social Media Profiles.
 */
function inti_default_social_options() {
	
	$defaults = array(
		'social_fb'    =>  '',
		'social_tw'    =>  '',
		'social_gp'    =>  '',
		'social_li'    =>  '',
		'social_in'    =>  '',
		'social_pi'    =>  '',
		'social_yt'    =>  '',
		'social_vi'    =>  '',
		'social_open_new'    =>  '1',
	);
	
	return apply_filters( 'inti_default_social_options', $defaults );
	
} // end inti_default_social_options

/**
 * Provides default values for the Comments Options.
 */
function inti_default_commenting_options() {
	
	$defaults = array(
		'commenting_system'     =>  'wordpress',
		'comments_on_pages'     =>  '1',
		'comments_show_allowed_tags'     =>  '1',
		'disqus_shortname'  =>  '',
		'fbcomments_apiid'  =>  '',
		'fbcomments_moderators'  =>  '',
		'fbcomments_lang'  =>  get_locale(),
		'fbcomments_colorscheme'  =>  'light',
		'fbcomments_amount'  =>  '10',
		'fbcomments_width'  =>  '640',
		'gpcomments_width'     =>  '640' 
	);
	
	return apply_filters( 'inti_default_commenting_options', $defaults );
	
} // end inti_default_commenting_options


/**
 * Initializes the theme's general options page by registering the Sections,
 * Fields, and Settings.
 *
 * This function is registered with the 'admin_init' hook.
 */ 
if (!function_exists('inti_initialize_general_options')) {
	function inti_initialize_general_options() {

		// If the theme options don't exist, create them.
		if( false == get_option( 'inti_general_options' ) ) {  
			add_option( 'inti_general_options', apply_filters( 'inti_default_general_options', inti_default_general_options() ) );
		} // end if

		// First, we register a section. This is necessary since all future options must belong to a 
		add_settings_section(
			'general_settings_section',         // ID used to identify this section and with which to register options
			__( 'Posts and Pages', 'inti' ),     // Title to be displayed on the administration page
			'inti_posts_and_pages_callback', // Callback used to render the description of the section
			'inti_general_options'     // Page on which to add this section of options
		);
		
			// Next, we'll introduce the fields for toggling the visibility of content elements.
			add_settings_field( 
				'excerpt_limit',                      // ID used to identify the field throughout the theme
				__( 'Excerpt Limit', 'inti' ),                          // The label to the left of the option interface element
				'inti_excerpt_limit_callback',   // The name of the function responsible for rendering the option interface
				'inti_general_options',    // The page on which this option will be displayed
				'general_settings_section',         // The name of the section to which this field belongs
				array(                              // The array of arguments to pass to the callback. In this case, just a description.
					__( 'How many characters do you want to display for excerpts?', 'inti' ),
				)
			);
		
			add_settings_field( 
				'read_more_text',                     
				__( 'Read More text', 'inti' ),             
				'inti_read_more_text_callback',  
				'inti_general_options',                    
				'general_settings_section',         
				array(                              
					__( 'After the excerpt there\'s a button or link with this text to continue reading.', 'inti' ),
				)
			);
		
			add_settings_field( 
				'blog_interface',                      
				__( 'Blog Index Style', 'inti' ),              
				'inti_blog_interface_callback',   
				'inti_general_options',        
				'general_settings_section',         
				array(                              
					__( 'You can display posts in a classic blog style as in option one, or shorts style as in option two.', 'inti' ),
				)
			);
		
			add_settings_field( 
				'breadcrumbs',                      
				__( 'Show Breadcrumbs', 'inti' ),              
				'inti_breadcrumbs_callback',   
				'inti_general_options',
				'general_settings_section',         
				array(                              
					__( 'They can be displayed before and after the content, or not at all.', 'inti' ),
				)
			);
		
			add_settings_field( 
				'pagination',                      
				__( 'Pagination Style', 'inti' ),              
				'inti_pagination_callback',   
				'inti_general_options',
				'general_settings_section',         
				array(                              
					__( 'Move between lists of posts in archives with number or Next/Previous links', 'inti' ),
				)
			);
		
			add_settings_field( 
				'nextprev_post_links',                      
				__( 'Links to Next/Previous posts on single posts', 'inti' ),              
				'inti_nextprev_post_links_callback',   
				'inti_general_options',
				'general_settings_section',         
				array(                              
					__( 'Move from one post to the next or previous post directly with Next/Previous links', 'inti' ),
				)
			);



		add_settings_section(
			'general_settings_section_2',         // ID used to identify this section and with which to register options
			__( 'Front Page', 'inti' ),     // Title to be displayed on the administration page
			'inti_frontpage_callback', // Callback used to render the description of the section
			'inti_general_options'     // Page on which to add this section of options
		);
		
			add_settings_field( 
				'frontpage_post_category',                      // ID used to identify the field throughout the theme
				__( 'Post Category to display', 'inti' ),                          // The label to the left of the option interface element
				'inti_frontpage_post_category_callback',   // The name of the function responsible for rendering the option interface
				'inti_general_options',    // The page on which this option will be displayed
				'general_settings_section_2'
			);
		
			add_settings_field( 
				'frontpage_post_number',                      // ID used to identify the field throughout the theme
				__( 'Number of posts to display', 'inti' ),                          // The label to the left of the option interface element
				'inti_frontpage_post_number_callback',   // The name of the function responsible for rendering the option interface
				'inti_general_options',    // The page on which this option will be displayed
				'general_settings_section_2'
			);

			add_settings_field( 
				'frontpage_post_columns',                      // ID used to identify the field throughout the theme
				__( 'Number of columns', 'inti' ),                          // The label to the left of the option interface element
				'inti_frontpage_post_columns_callback',   // The name of the function responsible for rendering the option interface
				'inti_general_options',    // The page on which this option will be displayed
				'general_settings_section_2'
			);

			add_settings_field( 
				'frontpage_exclude_category',                      // ID used to identify the field throughout the theme
				__( 'Exclude front page category', 'inti' ),                          // The label to the left of the option interface element
				'inti_frontpage_exclude_category_callback',   // The name of the function responsible for rendering the option interface
				'inti_general_options',    // The page on which this option will be displayed
				'general_settings_section_2'
			);

			add_settings_field( 
				'frontpage_breadcrumbs',                      // ID used to identify the field throughout the theme
				__( 'Hide breadcrumbs on front page', 'inti' ),                          // The label to the left of the option interface element
				'inti_frontpage_breadcrumbs_callback',   // The name of the function responsible for rendering the option interface
				'inti_general_options',    // The page on which this option will be displayed
				'general_settings_section_2'
			);



		add_settings_section(
			'general_settings_section_3',         // ID used to identify this section and with which to register options
			__( 'Sharing', 'inti' ),     // Title to be displayed on the administration page
			'inti_sharing_callback', // Callback used to render the description of the section
			'inti_general_options'     // Page on which to add this section of options
		);
		
			add_settings_field( 
				'sharing_on_posts',                      // ID used to identify the field throughout the theme
				__( 'Enable sharing on Posts', 'inti' ),                          // The label to the left of the option interface element
				'inti_sharing_posts_callback',   // The name of the function responsible for rendering the option interface
				'inti_general_options',    // The page on which this option will be displayed
				'general_settings_section_3'
			);
		
			add_settings_field( 
				'sharing_on_pages',                      // ID used to identify the field throughout the theme
				__( 'Enable sharing on Pages', 'inti' ),                          // The label to the left of the option interface element
				'inti_sharing_pages_callback',   // The name of the function responsible for rendering the option interface
				'inti_general_options',    // The page on which this option will be displayed
				'general_settings_section_3'
			);

			add_settings_field( 
				'sharing_platforms',                      // ID used to identify the field throughout the theme
				__( 'Display these sharing platforms', 'inti' ),                          // The label to the left of the option interface element
				'inti_sharing_platforms_callback',   // The name of the function responsible for rendering the option interface
				'inti_general_options',    // The page on which this option will be displayed
				'general_settings_section_3',         // The name of the section to which this field belongs
				array(                 
					'options'   =>  array (
										'twitter'   =>  'Twitter',
										'facebook'   =>  'Facebook',
										'google'   =>  'Google+',
										'linkedin'   =>  'LinkedIn',
										'pinterest'   =>  'Pinterest',
										'tumblr'   =>  'Tumblr',

									)
				)
			);



		add_settings_section(
			'general_settings_section_4',         // ID used to identify this section and with which to register options
			__( '404', 'inti' ),     // Title to be displayed on the administration page
			'inti_404_callback', // Callback used to render the description of the section
			'inti_general_options'     // Page on which to add this section of options
		);
		
			add_settings_field( 
				'page_not_found',                      // ID used to identify the field throughout the theme
				__( 'Message to display when page not found', 'inti' ),                          // The label to the left of the option interface element
				'inti_page_not_found_callback',   // The name of the function responsible for rendering the option interface
				'inti_general_options',    // The page on which this option will be displayed
				'general_settings_section_4',         // The name of the section to which this field belongs
				array(                              // The array of arguments to pass to the callback. In this case, just a description.
					'',
				)
			);
		


		
		// Finally, we register the fields with WordPress
		register_setting(
			'inti_general_options',
			'inti_general_options'
		);

		
	} // end inti_initialize_general_options
	add_action( 'admin_init', 'inti_initialize_general_options' );
}


/**
 * Initializes the theme's Header/Navidation sections by registering the Sections,
 * Fields, and Settings.
 *
 * This function is registered with the 'admin_init' hook.
 */
if (!function_exists('inti_initialize_headernav_options')) {
	function inti_initialize_headernav_options() {

		if( false == get_option( 'inti_headernav_options' ) ) {   
			add_option( 'inti_headernav_options', apply_filters( 'inti_default_headernav_options', inti_default_headernav_options() ) );
		} // end if
		
		add_settings_section(
			'headernav_settings_section',          // ID used to identify this section and with which to register options
			__( 'Header/Navigation', 'inti' ),      // Title to be displayed on the administration page
			'inti_headernav_options_callback',  // Callback used to render the description of the section
			'inti_headernav_options'      // Page on which to add this section of options
		);
		
			add_settings_field( 
				'nav_social',                      
				__('Social media icons on nav bar', 'inti' ),                          
				'inti_nav_social_callback', 
				'inti_headernav_options', 
				'headernav_settings_section'           
			);

			add_settings_field( 
				'head_js',                     
				__('Custom JavaScript in head', 'inti' ),                         
				'inti_head_js_callback',    
				'inti_headernav_options', 
				'headernav_settings_section',   
				array(                              // The array of arguments to pass to the callback. In this case, just a description.
					__( 'Most custom JavaScript should go in the footer.', 'inti' ),
				)        
			);

			add_settings_field( 
				'head_css',                     
				__('Custom CSS in head', 'inti' ),                         
				'inti_head_css_callback',    
				'inti_headernav_options', 
				'headernav_settings_section'   ,   
				array(                              // The array of arguments to pass to the callback. In this case, just a description.
					__( 'Style tags are inserted for you, just add the raw CSS', 'inti' ),
				)      
			);

			add_settings_field( 
				'head_meta',                     
				__('Custom Meta Tags in head', 'inti' ),                         
				'inti_head_meta_callback',    
				'inti_headernav_options', 
				'headernav_settings_section'      
			);

			add_settings_field( 
				'body_inside',                     
				__('Custom Code immediately after body', 'inti' ),                         
				'inti_body_inside_callback',    
				'inti_headernav_options', 
				'headernav_settings_section'      
			);
		
		register_setting(
			'inti_headernav_options',
			'inti_headernav_options'
			//'inti_sanitize_headernav_options'
		);
		
	} // end inti_initialize_headernav_options
	add_action( 'admin_init', 'inti_initialize_headernav_options' );
}

/**
 * Initializes the theme's Footer options by registering the Sections,
 * Fields, and Settings.
 *
 * This function is registered with the 'admin_init' hook.
 */ 
if (!function_exists('inti_initialize_footer_options')) {
	function inti_initialize_footer_options() {

		if( false == get_option( 'inti_footer_options' ) ) {   
			add_option( 'inti_footer_options', apply_filters( 'inti_default_footer_options', inti_default_footer_options() ) );
		} // end if
		
		add_settings_section(
			'footer_settings_section',          // ID used to identify this section and with which to register options
			__( 'Footer/Analytics', 'inti' ),      // Title to be displayed on the administration page
			'inti_footer_options_callback',  // Callback used to render the description of the section
			'inti_footer_options'      // Page on which to add this section of options
		);
		
			add_settings_field( 
				'footer_social',                      
				__('Social media icons in footer', 'inti' ),                          
				'inti_footer_social_callback', 
				'inti_footer_options', 
				'footer_settings_section'           
			);

			add_settings_field( 
				'analytics_id',                     
				__('Google Analytics ID', 'inti' ),                         
				'inti_analytics_id_callback',    
				'inti_footer_options', 
				'footer_settings_section',   
				array(                              // The array of arguments to pass to the callback. In this case, just a description.
					__( 'Enter Your Analytics site ID (e.g. UA-XXXXX-X) here.', 'inti' ),
				)        
			);

			add_settings_field( 
				'footer_js',                     
				__('Custom JavaScript in footer', 'inti' ),                         
				'inti_footer_js_callback',    
				'inti_footer_options', 
				'footer_settings_section',   
				array(                              // The array of arguments to pass to the callback. In this case, just a description.
					__( 'Add custom javascript code to the footer (best place), modify the copyright text and set up other custom footer features.', 'inti' ),
				)       
			);
		
		register_setting(
			'inti_footer_options',
			'inti_footer_options'
		);
		
	} // end inti_initialize_footer_options
	add_action( 'admin_init', 'inti_initialize_footer_options' );
}

/**
 * Initializes the theme's Social options by registering the Sections,
 * Fields, and Settings.
 *
 * This function is registered with the 'admin_init' hook.
 */
if (!function_exists('inti_initialize_social_options')) {
	function inti_initialize_social_options() {

		if( false == get_option( 'inti_social_options' ) ) {   
			add_option( 'inti_social_options', apply_filters( 'inti_default_social_options', inti_default_social_options() ) );
		} // end if
		
		add_settings_section(
			'social_settings_section',          // ID used to identify this section and with which to register options
			__( 'Social Media Profiles', 'inti' ),      // Title to be displayed on the administration page
			'inti_social_options_callback',  // Callback used to render the description of the section
			'inti_social_options'      // Page on which to add this section of options
		);
		

			add_settings_field( 
				'social_fb',                     
				'<i class="fa fa-2x fa-facebook-square"></i> Facebook',                         
				'inti_social_fb_callback',    
				'inti_social_options', 
				'social_settings_section',   
				array(                              // The array of arguments to pass to the callback. In this case, just a description.
					__( 'Complete URL', 'inti' ),
				)        
			);
			
			add_settings_field( 
				'social_tw',                     
				'<i class="fa fa-2x fa-twitter-square"></i> Twitter',                         
				'inti_social_tw_callback',    
				'inti_social_options', 
				'social_settings_section',   
				array(                              // The array of arguments to pass to the callback. In this case, just a description.
					__( 'Complete URL', 'inti' ),
				)        
			);
			
			add_settings_field( 
				'social_gp',                     
				'<i class="fa fa-2x fa-google-plus-square"></i>  Google+',                         
				'inti_social_gp_callback',    
				'inti_social_options', 
				'social_settings_section',   
				array(                              // The array of arguments to pass to the callback. In this case, just a description.
					__( 'Complete URL', 'inti' ),
				)        
			);
			
			add_settings_field( 
				'social_li',                     
				'<i class="fa fa-2x fa-linkedin-square"></i> LinkedIn',                         
				'inti_social_li_callback',    
				'inti_social_options', 
				'social_settings_section',   
				array(                              // The array of arguments to pass to the callback. In this case, just a description.
					__( 'Complete URL', 'inti' ),
				)        
			);
			
			add_settings_field( 
				'social_in',                     
				'<i class="fa fa-2x fa-instagram"></i> Instagram',                         
				'inti_social_in_callback',    
				'inti_social_options', 
				'social_settings_section',   
				array(                              // The array of arguments to pass to the callback. In this case, just a description.
					__( 'Complete URL', 'inti' ),
				)        
			);
			
			add_settings_field( 
				'social_pi',                     
				'<i class="fa fa-2x fa-pinterest-square"></i> Pinterest',                         
				'inti_social_pi_callback',    
				'inti_social_options', 
				'social_settings_section',   
				array(                              // The array of arguments to pass to the callback. In this case, just a description.
					__( 'Complete URL', 'inti' ),
				)        
			);
			
			add_settings_field( 
				'social_yt',                     
				'<i class="fa fa-2x fa-youtube-square"></i> YouTube',                         
				'inti_social_yt_callback',    
				'inti_social_options', 
				'social_settings_section',   
				array(                              // The array of arguments to pass to the callback. In this case, just a description.
					__( 'Complete URL', 'inti' ),
				)        
			);
			
			add_settings_field( 
				'social_vi',                     
				'<i class="fa fa-2x fa-vimeo-square"></i> Vimeo',                         
				'inti_social_vi_callback',    
				'inti_social_options', 
				'social_settings_section',   
				array(                              // The array of arguments to pass to the callback. In this case, just a description.
					__( 'Complete URL', 'inti' ),
				)        
			);

			add_settings_field( 
				'social_open_new',                     
				__('Open links in new tabs', 'inti' ),                         
				'inti_social_open_new_callback',    
				'inti_social_options', 
				'social_settings_section',   
				array(                              // The array of arguments to pass to the callback. In this case, just a description.
					__( 'Open links to social media profiles in new tabs', 'inti' ),
				)        
			);
		
		register_setting(
			'inti_social_options',
			'inti_social_options',
			'inti_sanitize_social_options'
		);
		
	} // end inti_initialize_footer_options
	add_action( 'admin_init', 'inti_initialize_social_options' );
}


/**
 * Initializes the theme's Commenting options by registering the Sections,
 * Fields, and Settings.
 *
 * This function is registered with the 'admin_init' hook.
 */
if (!function_exists('inti_initialize_commenting_options')) {
	function inti_initialize_commenting_options() {

		if( false == get_option( 'inti_commenting_options' ) ) {   
			add_option( 'inti_commenting_options', apply_filters( 'inti_default_commenting_options', inti_default_commenting_options() ) );
		} // end if
		
		add_settings_section(
			'commenting_settings_section',          // ID used to identify this section and with which to register options
			__('Commenting System', 'inti' ),      // Title to be displayed on the administration page
			'inti_commenting_options_callback',  // Callback used to render the description of the section
			'inti_commenting_options'      // Page on which to add this section of options
		);
			add_settings_field( 
				'commenting_system',                     
				__('Commenting System', 'inti' ),                        
				'inti_commenting_system_callback',    
				'inti_commenting_options', 
				'commenting_settings_section',   
				array(                              // The array of arguments to pass to the callback. In this case, just a description.
					'',
				)        
			);
			add_settings_field( 
				'comments_on_pages',                     
				__('Comments on pages', 'inti'),                         
				'inti_comments_on_pages_callback',    
				'inti_commenting_options', 
				'commenting_settings_section',   
				array(                              // The array of arguments to pass to the callback. In this case, just a description.
					__( 'By default comments are shown on pages and posts. Here you can hide them on pages. To turn comments off altogether, see Settings -> Discussion', 'inti' ),
				)        
			);
			add_settings_field( 
				'comments_show_allowed_tags',                     
				__('Allowed tags message', 'inti'),                         
				'inti_comments_show_allowed_tags_callback',    
				'inti_commenting_options', 
				'commenting_settings_section',   
				array(                              // The array of arguments to pass to the callback. In this case, just a description.
					__( 'By default a message is shown under the comments box informing commenters what HTML tags they are allowed to use.', 'inti' ),
				)        
			);
	 
		add_settings_section(
			'commenting_settings_section_disqus',          // ID used to identify this section and with which to register options
			__( 'DISQUS', 'inti' ),      // Title to be displayed on the administration page
			'inti_disqus_options_callback',  // Callback used to render the description of the section
			'inti_commenting_options'      // Page on which to add this section of options
		);
			add_settings_field( 
				'disqus_shortname',                     
				__('Disqus Shortname', 'inti'),                         
				'inti_disqus_shortname_callback',    
				'inti_commenting_options', 
				'commenting_settings_section_disqus',   
				array(                              // The array of arguments to pass to the callback. In this case, just a description.
					__( 'You\'ll get this at the end of the registration process. Please contact your developer if you need assistance.', 'inti' ),
				)        
			);
	 
		add_settings_section(
			'commenting_settings_section_fb',          // ID used to identify this section and with which to register options
			__( 'Facebook Comments', 'inti' ),      // Title to be displayed on the administration page
			'inti_fbcomments_options_callback',  // Callback used to render the description of the section
			'inti_commenting_options'      // Page on which to add this section of options
		);
			add_settings_field( 
				'fbcomments_appid',                     
				'Facebook App API',                         
				'inti_fbcomments_appid_callback',    
				'inti_commenting_options', 
				'commenting_settings_section_fb',   
				array(                              // The array of arguments to pass to the callback. In this case, just a description.
					__( 'You\'ll need to register a Facebook App for your site. Please contact your developer if you need assistance.', 'inti' ),
				)        
			);
			add_settings_field( 
				'fbcomments_moderators',                     
				__('Moderators', 'inti'),                         
				'inti_fbcomments_moderators_callback',    
				'inti_commenting_options', 
				'commenting_settings_section_fb',   
				array(                              // The array of arguments to pass to the callback. In this case, just a description.
					__( 'By default, all users set as admins for the registered app can moderate comments. To add moderators, each Facebook Profile ID should be separated by a comma <strong>without spaces</strong>. To find your Facebook Profile ID', 'inti' )
					. '<a href="https://developers.facebook.com/tools/explorer/?method=GET&path=me" target="blank">' . __('click here', 'inti') . '</a>.',
				)        
			);
			add_settings_field( 
				'fbcomments_lang',                     
				__('Language', 'inti'),                         
				'inti_fbcomments_lang_callback',    
				'inti_commenting_options', 
				'commenting_settings_section_fb',   
				array(                              // The array of arguments to pass to the callback. In this case, just a description.
					__( 'Set this to be the same as your site language and locale.', 'inti' ),
				)        
			);
			add_settings_field( 
				'fbcomments_colorscheme',                     
				__('Color Scheme', 'inti'),                         
				'inti_fbcomments_colorscheme_callback',    
				'inti_commenting_options', 
				'commenting_settings_section_fb',   
				array(                              // The array of arguments to pass to the callback. In this case, just a description.
					__( 'For dark and light background sites.', 'inti' ),
				)        
			);
			add_settings_field( 
				'fbcomments_amount',                     
				__('Show X Comments', 'inti'),                         
				'inti_fbcomments_amount_callback',    
				'inti_commenting_options', 
				'commenting_settings_section_fb',   
				array(                              // The array of arguments to pass to the callback. In this case, just a description.
					__( 'Number of comments to show at a time.', 'inti' ),
				)        
			);
			add_settings_field( 
				'fbcomments_width',                     
				__('Comment Area Width', 'inti'),                         
				'inti_fbcomments_width_callback',    
				'inti_commenting_options', 
				'commenting_settings_section_fb',   
				array(                              // The array of arguments to pass to the callback. In this case, just a description.
					__( 'Give a width for your comment box in pixels.', 'inti' ),
				)        
			);
	 
		add_settings_section(
			'commenting_settings_section_gp',          // ID used to identify this section and with which to register options
			__( 'Google+ Comments', 'inti' ),      // Title to be displayed on the administration page
			'inti_gpcomments_options_callback',  // Callback used to render the description of the section
			'inti_commenting_options'      // Page on which to add this section of options
		);
			add_settings_field( 
				'gpcomments_width',                     
				__('Comment Area Width', 'inti'),                         
				'inti_gpcomments_width_callback',    
				'inti_commenting_options', 
				'commenting_settings_section_gp',   
				array(                              // The array of arguments to pass to the callback. In this case, just a description.
					__( 'Give a width for your comment box in pixels.', 'inti' ),
				)        
			);
			
		  
		
		register_setting(
			'inti_commenting_options',
			'inti_commenting_options'
		);
		
	} // end inti_initialize_footer_options
	add_action( 'admin_init', 'inti_initialize_commenting_options' );
}


/* ------------------------------------------------------------------------ *
 * Section Callbacks
 * ------------------------------------------------------------------------ */ 

/**
 * This function provides a simple description for the General Options page. 
 *
 * It's called from the 'inti_initialize_general_options' function by being passed as a parameter
 * in the add_settings_section function.
 */
function inti_posts_and_pages_callback() {
	echo '<p>' . __( 'Basic settings that give you some control over how your site will look and feel.', 'inti' ) . '</p>';
}
function inti_frontpage_callback() {
	echo '<p>' . __( 'Options for the Front Page if template exists.', 'inti' ) . '</p>';
} 
function inti_sharing_callback() {
	echo '<p>' . __( 'Share posts and pages on social media platforms.', 'inti' ) . '</p>';
} 
function inti_404_callback() {
	echo '<p>' . __( 'What to show when a page is not found.', 'inti' ) . '</p>';
} 
// end inti_general_options_callback

/**
 * This function provides a simple description for the Header/Navigation page. 
 *
 * It's called from the 'inti_initialize_headernav_options' function by being passed as a parameter
 * in the add_settings_section function.
 */
function inti_headernav_options_callback() {
	echo '<p>' . __( 'Provide the URL to the social networks you\'d like to display.', 'inti' ) . '</p>';
} // end inti_general_options_callback

/**
 * This function provides a simple description for the Footer/Analytics page.
 *
 * It's called from the 'inti_initialize_footer_options' function by being passed as a parameter
 * in the add_settings_section function.
 */
function inti_footer_options_callback() {
	echo '<p>' . __( 'Control what appears in your website\'s footer.', 'inti' ) . '</p>';
} // end inti_footer_options_callback

/**
 * This function provides a simple description for the Social Media Profiles page.
 *
 * It's called from the 'inti_initialize_social_options' function by being passed as a parameter
 * in the add_settings_section function.
 */
function inti_social_options_callback() {
	echo '<p>' . __( 'Enter your social media profiles here.', 'inti' ) . '</p>';
} // end inti_footer_options_callback

/**
 * This function provides a simple description for the Commenting page.
 *
 * It's called from the 'inti_initialize_social_options' function by being passed as a parameter
 * in the add_settings_section function.
 */
function inti_commenting_options_callback() {
	echo '<p>' . __( 'You can turn on/off comments in the WordPress settings under \'Discussion\'. Here you can choose which commenting system to use throught your site.', 'inti' ) . '</p>';
} // end inti_footer_options_callback

function inti_disqus_options_callback() {
	echo "<p>" . __( "Please enter your blog's DISQUS 'shortname' below to complete the process.", "inti" ) . "</p>";
} // end inti_disqus_options_callback

function inti_fbcomments_options_callback() {
	echo "<p>" . __( "Facebook requires the following details to be able to activate comments using Facebook.", "inti" ) . "</p>";
} // end inti_fbcomments_options_callback

function inti_gpcomments_options_callback() {
	echo "<p>" . __( "Google comments are easier to work with than FB comments..", "inti" ) . "</p>";
} // end inti_gpcomments_options_callback



/* ------------------------------------------------------------------------ *
 * Field Callbacks
 * ------------------------------------------------------------------------ */ 

function inti_excerpt_limit_callback($args) {
	
	$options = get_option('inti_general_options');
	
	$data = "";
	if( isset( $options['excerpt_limit'] ) ) {
		$data = $options['excerpt_limit'];
	} // end if


	$html = '<input type="text" id="excerpt_limit" name="inti_general_options[excerpt_limit]" value="' . $data . '" />'; 
	
	// Here, we'll take the first argument of the array and add it to a label next to the input
	$html .= '<p><small><label for="excerpt_limit">&nbsp;' . (isset($args[0]) ? $args[0] : '' )  . '</label></small></p>'; 
	
	echo $html;
	
}

function inti_read_more_text_callback($args) {
	
	$options = get_option('inti_general_options');
	
	$data = "";
	if( isset( $options['read_more_text'] ) ) {
		$data = $options['read_more_text'];
	} // end if


	$html = '<input type="text" id="read_more_text" name="inti_general_options[read_more_text]" value="' . $data . '" />'; 
	
	// Here, we'll take the first argument of the array and add it to a label next to the input
	$html .= '<p><small><label for="read_more_text">&nbsp;' . (isset($args[0]) ? $args[0] : '' )  . '</label></small></p>'; 
	
	echo $html;
	
}

function inti_blog_interface_callback($args) {
	
	$options = get_option('inti_general_options');
	

	$html = '<div><img src="' . get_template_directory_uri() . '/framework/theme-options/images/blog_styles.png" alt="' . (isset($args[0]) ? $args[0] : '' )  . '"></div>';
   
	$html .= '<input type="radio" id="blog_interface_one" name="inti_general_options[blog_interface]" value="1"' . checked( 1, $options['blog_interface'], false ) . '/>';
	$html .= '&nbsp;';
	$html .= '<label for="blog_interface_one">' . __('Option One (Standard)', 'inti') . '</label>';
	$html .= '&nbsp;&nbsp;&nbsp;&nbsp;';
	$html .= '<input type="radio" id="blog_interface_two" name="inti_general_options[blog_interface]" value="2"' . checked( 2, $options['blog_interface'], false ) . '/>';
	$html .= '&nbsp;';
	$html .= '<label for="blog_interface_two">' . __('Option Two (Shorts)', 'inti') . '</label>';
	
	// Here, we'll take the first argument of the array and add it to a label next to the input
	$html .= '<p><small><label for="blog_interface">&nbsp;' . (isset($args[0]) ? $args[0] : '' )  . '</label></small></p>'; 
	
	echo $html;
	
}

function inti_breadcrumbs_callback($args) {
	
	$options = get_option('inti_general_options');

	$html = '<p><input type="radio" id="breadcrumbs_none" name="inti_general_options[breadcrumbs]" value="none"' . checked( "none", $options['breadcrumbs'], false ) . '/>';
	$html .= '&nbsp;';
	$html .= '<label for="breadcrumbs_none">' . __('None/Off', 'inti') . '</label></p>';

	$html .= '<p><input type="radio" id="breadcrumbs_top" name="inti_general_options[breadcrumbs]" value="top"' . checked( "top", $options['breadcrumbs'], false ) . '/>';
	$html .= '&nbsp;';
	$html .= '<label for="breadcrumbs_top">' . __('Top Only', 'inti') . '</label></p>';

	$html .= '<p><input type="radio" id="breadcrumbs_bottom" name="inti_general_options[breadcrumbs]" value="bottom"' . checked( "bottom", $options['breadcrumbs'], false ) . '/>';
	$html .= '&nbsp;';
	$html .= '<label for="breadcrumbs_bottom">' . __('Bottom Only', 'inti') . '</label></p>';

	$html .= '<p><input type="radio" id="breadcrumbs_topbottom" name="inti_general_options[breadcrumbs]" value="topbottom"' . checked( "topbottom", $options['breadcrumbs'], false ) . '/>';
	$html .= '&nbsp;';
	$html .= '<label for="breadcrumbs_topbottom">' . __('Top and Bottom', 'inti') . '</label></p>';


	
	// Here, we'll take the first argument of the array and add it to a label next to the input
	$html .= '<p><small><label for="breadcrumbs_none">&nbsp;' . (isset($args[0]) ? $args[0] : '' )  . '</label></small></p><br><br>'; 
	
	echo $html;
	
}

function inti_pagination_callback($args) {
	
	$options = get_option('inti_general_options');

	$html = '<p><input type="radio" id="pagination_numbered" name="inti_general_options[pagination]" value="numbered"' . checked( "numbered", $options['pagination'], false ) . '/>';
	$html .= '&nbsp;';
	$html .= '<label for="numbered">' . __('Page Numbers', 'inti') . '</label></p>';

	$html .= '<p><input type="radio" id="pagination_nextprev" name="inti_general_options[pagination]" value="nextprev"' . checked( "nextprev", $options['pagination'], false ) . '/>';
	$html .= '&nbsp;';
	$html .= '<label for="nextprev">' . __('Next/Previous links', 'inti') . '</label></p>';


	
	// Here, we'll take the first argument of the array and add it to a label next to the input
	$html .= '<p><small><label for="pagination_numbered">&nbsp;' . (isset($args[0]) ? $args[0] : '' )  . '</label></small></p>'; 
	
	echo $html;
	
}

function inti_nextprev_post_links_callback($args) {
	
	$options = get_option('inti_general_options');

	$html = '<p><input type="radio" id="nextprev_post_links_none" name="inti_general_options[nextprev_post_links]" value="none"' . checked( "none", $options['nextprev_post_links'], false ) . '/>';
	$html .= '&nbsp;';
	$html .= '<label for="nextprev_post_links_none">' . __('None/Off', 'inti') . '</label></p>';

	$html .= '<p><input type="radio" id="nextprev_post_links_bottom" name="inti_general_options[nextprev_post_links]" value="bottom"' . checked( "bottom", $options['nextprev_post_links'], false ) . '/>';
	$html .= '&nbsp;';
	$html .= '<label for="nextprev_post_links_bottom">' . __('Bottom Only', 'inti') . 'Bottom Only</label></p>';

	$html .= '<p><input type="radio" id="nextprev_post_links_topbottom" name="inti_general_options[nextprev_post_links]" value="topbottom"' . checked( "topbottom", $options['nextprev_post_links'], false ) . '/>';
	$html .= '&nbsp;';
	$html .= '<label for="nextprev_post_links_topbottom">' . __('Top and Bottom', 'inti') . '</label></p>';


	
	// Here, we'll take the first argument of the array and add it to a label next to the input
	$html .= '<p><small><label for="nextprev_post_links_none">&nbsp;' . (isset($args[0]) ? $args[0] : '' )  . '</label></small></p><br><br>'; 
	
	echo $html;
	
}

function inti_frontpage_post_category_callback($args) {
	
	$options = get_option('inti_general_options');
	
	wp_dropdown_categories(array(
		'show_option_none' => __("All Categories", 'inti'),
		'show_count' => true,
		'taxonomy' => 'category',
		'name' => 'inti_general_options[frontpage_post_category]',
		'id' => 'frontpage_post_category',
		'selected' => $options['frontpage_post_category']
	)); 
}

function inti_frontpage_post_number_callback($args) {
	
	$options = get_option('inti_general_options');
	
	$data = "";
	if( isset( $options['frontpage_post_number'] ) ) {
		$data = $options['frontpage_post_number'];
	} // end if


	$html = '<input type="text" id="frontpage_post_number" name="inti_general_options[frontpage_post_number]" value="' . $data . '" />'; 
	
	
	echo $html;
}

function inti_frontpage_post_columns_callback($args) {
	
	$options = get_option('inti_general_options');

	$html = '<p><input type="radio" id="frontpage-post-columns-1" name="inti_general_options[frontpage_post_columns]" value="1"' . checked( "1", $options['frontpage_post_columns'], false ) . '/>';
	$html .= '&nbsp;';
	$html .= '<label for="frontpage-post-columns-1">1</label>';

	$html .= '&nbsp;&nbsp;&nbsp;&nbsp;';

	$html .= '<input type="radio" id="frontpage-post-columns-2" name="inti_general_options[frontpage_post_columns]" value="2"' . checked( "2", $options['frontpage_post_columns'], false ) . '/>';
	$html .= '&nbsp;';
	$html .= '<label for="frontpage-post-columns-2">2</label>';

	$html .= '&nbsp;&nbsp;&nbsp;&nbsp;';

	$html .= '<input type="radio" id="frontpage-post-columns-3" name="inti_general_options[frontpage_post_columns]" value="3"' . checked( "3", $options['frontpage_post_columns'], false ) . '/>';
	$html .= '&nbsp;';
	$html .= '<label for="frontpage-post-columns-3">3</label>';

	$html .= '&nbsp;&nbsp;&nbsp;&nbsp;';

	$html .= '<input type="radio" id="frontpage-post-columns-4" name="inti_general_options[frontpage_post_columns]" value="4"' . checked( "4", $options['frontpage_post_columns'], false ) . '/>';
	$html .= '&nbsp;';
	$html .= '<label for="frontpage-post-columns-3">4</label></p>';
	
	echo $html;
	
}

function inti_frontpage_exclude_category_callback() {

	$options = get_option( 'inti_general_options' );
	
	$html = '<input type="checkbox" id="frontpage_exclude_category" name="inti_general_options[frontpage_exclude_category]" value="1"' . checked( 1, $options['frontpage_exclude_category'], false ) . '/>';
	$html .= '&nbsp;';
	$html .= '<label for="frontpage_exclude_category">' . __('Exclude the front page post category from the rest of the blog', 'inti') . '</label>';
	
	echo $html;

}

function inti_frontpage_breadcrumbs_callback() {

	$options = get_option( 'inti_general_options' );
	
	$html = '<input type="checkbox" id="frontpage_breadcrumbs" name="inti_general_options[frontpage_breadcrumbs]" value="1"' . checked( 1, $options['frontpage_breadcrumbs'], false ) . '/>';
	$html .= '&nbsp;';
	$html .= '<label for="frontpage_breadcrumbs">' . __('Hide breadcrumbs on front page', 'inti') . '</label><p></p><br><br>';
	
	echo $html;

}

function inti_sharing_posts_callback() {

	$options = get_option( 'inti_general_options' );
	
	$html = '<input type="checkbox" id="sharing_on_posts" name="inti_general_options[sharing_on_posts]" value="1"' . checked( 1, $options['sharing_on_posts'], false ) . '/>';
	$html .= '&nbsp;';
	$html .= '<label for="sharing_on_posts">' . __('Allow sharing buttons on blog posts', 'inti') . '</label>';
	
	echo $html;

}

function inti_sharing_pages_callback() {

	$options = get_option( 'inti_general_options' );
	
	$html = '<input type="checkbox" id="sharing_on_pages" name="inti_general_options[sharing_on_pages]" value="1"' . checked( 1, $options['sharing_on_pages'], false ) . '/>';
	$html .= '&nbsp;';
	$html .= '<label for="sharing_on_pages">' . __('Allow sharing buttons on standard pages', 'inti') . '</label>';
	
	echo $html;

}

function inti_sharing_platforms_callback($args) {
	
	$options = get_option('inti_general_options');
	

	foreach($args['options'] as $val => $platform){
		$checked = in_array($val, $options) ? 'checked="checked"' : '';
		
		printf(
			'<p><input type="checkbox" id="inti_general_options[%1$s]" name="inti_general_options[sharing_platforms_%1$s]" value="%1$s" ' . $checked . ' />&nbsp;<label for="inti_general_options[sharing_platforms_%1$s]">%2$s</label></p>',
			$val,
			$platform
		);
	}
   
}

function inti_page_not_found_callback($args) {
	
	$options = get_option('inti_general_options');
	
	$data = "";
	if( isset( $options['page_not_found'] ) ) {
		$data = html_entity_decode($options['page_not_found']);
	} // end if


	//$html = '<input type="text" id="page_not_found" name="inti_general_options[page_not_found]" value="' . $data . '" />'; 

	wp_editor($data, 'inti_general_options_page_not_found', array( 'textarea_name' => 'inti_general_options[page_not_found]','media_buttons' => true, 'wpautop' => true, 'textarea_rows' => '16' ));
								
	// Here, we'll take the first argument of the array and add it to a label next to the input
	//$html .= '<p><small><label for="page_not_found">&nbsp;' . (isset($args[0]) ? $args[0] : '' )  . '</label></small></p>'; 
	
   // echo $html;
	
}

function inti_nav_social_callback() {

	$options = get_option( 'inti_headernav_options' );
	
	$html = '<input type="checkbox" id="nav_social" name="inti_headernav_options[nav_social]" value="1"' . checked( 1, $options['nav_social'], false ) . '/>';
	$html .= '&nbsp;';
	$html .= '<label for="nav_social">' . __('Show social media profile icons in navigation bar', 'inti') . '</label><br><br><br><br>';
	
	echo $html;

}

function inti_head_js_callback($args) {

	$options = get_option( 'inti_headernav_options' );

	$data = "";
	if( isset( $options['head_js'] ) ) {
		$data = $options['head_js'];
	} // end if

	$html = '<textarea id="head_js" name="inti_headernav_options[head_js]" value="1" rows="5" cols="50" class="widefat" />'.$data.'</textarea>';
	
	$html .= '<p><small><label for="head_js">&nbsp;' . (isset($args[0]) ? $args[0] : '' )  . '</label></small></p>'; 
	
	echo $html;

}

function inti_head_css_callback($args) {

	$options = get_option( 'inti_headernav_options' );

	$data = "";
	if( isset( $options['head_css'] ) ) {
		$data = $options['head_css'];
	} // end if

	$html = '<textarea id="head_css" name="inti_headernav_options[head_css]" value="1" rows="5" cols="50" class="widefat" />'.$data.'</textarea>';
	
	$html .= '<p><small><label for="head_css">&nbsp;' . (isset($args[0]) ? $args[0] : '' ) . '</label></small></p>'; 
	
	echo $html;

}

function inti_head_meta_callback($args) {

	$options = get_option( 'inti_headernav_options' );

	$data = "";
	if( isset( $options['head_meta'] ) ) {
		$data = $options['head_meta'];
	} // end if

	$html = '<textarea id="head_meta" name="inti_headernav_options[head_meta]" value="1" rows="5" cols="50" class="widefat" />'.$data.'</textarea>';
	
	$html .= '<p><small><label for="head_meta">&nbsp;' . (isset($args[0]) ? $args[0] : '' )  . '</label></small></p><br><br>'; 
	
	echo $html;

}

function inti_body_inside_callback($args) {

	$options = get_option( 'inti_headernav_options' );

	$data = "";
	if( isset( $options['body_inside'] ) ) {
		$data = $options['body_inside'];
	} // end if

	$html = '<textarea id="body_inside" name="inti_headernav_options[body_inside]" value="1" rows="5" cols="50" class="widefat" />'.$data.'</textarea>';
	
	$html .= '<p><small><label for="body_inside">&nbsp;' . (isset($args[0]) ? $args[0] : '' )  . '</label></small></p><br><br>'; 
	
	echo $html;

}

function inti_footer_social_callback() {

	$options = get_option( 'inti_footer_options' );
	
	$html = '<input type="checkbox" id="footer_social" name="inti_footer_options[footer_social]" value="1"' . checked( 1, $options['footer_social'], false ) . '/>';
	$html .= '&nbsp;';
	$html .= '<label for="footer_social">' . __('Show social media profile icons in footer area', 'inti') . '</label>';
	
	echo $html;

}

function inti_analytics_id_callback($args) {
	
	// First, we read the social options collection
	$options = get_option( 'inti_footer_options' );
	
	// Next, we need to make sure the element is defined in the options. If not, we'll set an empty string.
	$id = $options['analytics_id'];
	
	// Render the output
	$html = '<input type="text" id="analytics_id" name="inti_footer_options[analytics_id]" value="' . $id . '" />';

	// Here, we'll take the first argument of the array and add it to a label next to the input
	$html .= '<p><small><label for="analytics_id">&nbsp;' . (isset($args[0]) ? $args[0] : '' )  . '</label></small></p>'; 

	echo $html;
	
} // end inti_analytics_id_callback

function inti_footer_js_callback($args) {

	$options = get_option( 'inti_footer_options' );

	$data = "";
	if( isset( $options['footer_js'] ) ) {
		$data = $options['footer_js'];
	} // end if

	$html = '<textarea id="footer_js" name="inti_footer_options[footer_js]" value="1" rows="5" cols="50" class="widefat" />'.$data.'</textarea>';
	
	$html .= '<small><label for="footer_js">&nbsp;' . (isset($args[0]) ? $args[0] : '' )  . '</label></small>'; 
	
	echo $html;

}



function inti_social_fb_callback($args) {
	
	$options = get_option( 'inti_social_options' );
	
	$url = '';
	if( isset( $options['social_fb'] ) ) {
		$url = esc_url( $options['social_fb'] );
	} // end if
	
	// Render the output
	echo '<input type="text" id="social_fb" name="inti_social_options[social_fb]" value="' . $url . '" placeholder="' . (isset($args[0]) ? $args[0] : '' )  . '" />';
	
} // end inti_social_fb_callback

function inti_social_tw_callback($args) {
	
	// First, we read the social options collection
	$options = get_option( 'inti_social_options' );
	
	// Next, we need to make sure the element is defined in the options. If not, we'll set an empty string.
	$url = '';
	if( isset( $options['social_tw'] ) ) {
		$url = esc_url( $options['social_tw'] );
	} // end if
	
	// Render the output
	echo '<input type="text" id="social_tw" name="inti_social_options[social_tw]" value="' . $url . '" placeholder="' . (isset($args[0]) ? $args[0] : '' )  . '" />';
	
} // end inti_social_tw_callback

function inti_social_gp_callback($args) {
	
	$options = get_option( 'inti_social_options' );
	
	$url = '';
	if( isset( $options['social_gp'] ) ) {
		$url = esc_url( $options['social_gp'] );
	} // end if
	
	// Render the output
	echo '<input type="text" id="social_gp" name="inti_social_options[social_gp]" value="' . $url . '" placeholder="' . (isset($args[0]) ? $args[0] : '' )  . '" />';
	
} // end inti_social_gp_callback

function inti_social_li_callback($args) {
	
	$options = get_option( 'inti_social_options' );
	
	$url = '';
	if( isset( $options['social_li'] ) ) {
		$url = esc_url( $options['social_li'] );
	} // end if
	
	// Render the output
	echo '<input type="text" id="social_li" name="inti_social_options[social_li]" value="' . $url . '" placeholder="' . (isset($args[0]) ? $args[0] : '' )  . '" />';
	
} // end inti_social_li_callback

function inti_social_in_callback($args) {
	
	$options = get_option( 'inti_social_options' );
	
	$url = '';
	if( isset( $options['social_in'] ) ) {
		$url = esc_url( $options['social_in'] );
	} // end if
	
	// Render the output
	echo '<input type="text" id="social_in" name="inti_social_options[social_in]" value="' . $url . '" placeholder="' . (isset($args[0]) ? $args[0] : '' )  . '" />';
	
} // end inti_social_in_callback

function inti_social_pi_callback($args) {
	
	$options = get_option( 'inti_social_options' );
	
	$url = '';
	if( isset( $options['social_pi'] ) ) {
		$url = esc_url( $options['social_pi'] );
	} // end if
	
	// Render the output
	echo '<input type="text" id="social_pi" name="inti_social_options[social_pi]" value="' . $url . '" placeholder="' . (isset($args[0]) ? $args[0] : '' )  . '" />';
	
} // end inti_social_pi_callback

function inti_social_yt_callback($args) {
	
	$options = get_option( 'inti_social_options' );
	
	$url = '';
	if( isset( $options['social_yt'] ) ) {
		$url = esc_url( $options['social_yt'] );
	} // end if
	
	// Render the output
	echo '<input type="text" id="social_yt" name="inti_social_options[social_yt]" value="' . $url . '" placeholder="' . (isset($args[0]) ? $args[0] : '' )  . '" />';
	
} // end inti_social_yt_callback

function inti_social_vi_callback($args) {
	
	$options = get_option( 'inti_social_options' );
	
	$url = '';
	if( isset( $options['social_vi'] ) ) {
		$url = esc_url( $options['social_vi'] );
	} // end if
	
	// Render the output
	echo '<input type="text" id="social_vi" name="inti_social_options[social_vi]" value="' . $url . '" placeholder="' . (isset($args[0]) ? $args[0] : '' )  . '" /><p><br><br></p>';
	
} // end inti_social_vi_callback

function inti_social_open_new_callback($args) {
	
	$options = get_option('inti_social_options');

	$html = '<input type="checkbox" id="social_open_new" name="inti_social_options[social_open_new]" value="1"' . checked( 1, $options['social_open_new'], false ) . '/>';
	$html .= '&nbsp;';
	$html .= '<label for="social_open_new">' . __('Open links to social media profiles in new tabs', 'inti') . '</label>';
	
	echo $html;
} // end inti_social_open_new_callback

function inti_commenting_system_callback($args) {
	
	$options = get_option('inti_commenting_options');

	$html = '<p><input type="radio" id="commenting_system_wordpress" name="inti_commenting_options[commenting_system]" value="wordpress"' . checked( 'wordpress', $options['commenting_system'], false ) . '/>';
	$html .= '&nbsp;';
	$html .= '<label for="commenting_system_wordpress"><i class="fa fa-wordpress"></i> WordPress</label></p>';

	$html .= '<p><input type="radio" id="commenting_system_disqus" name="inti_commenting_options[commenting_system]" value="disqus"' . checked( 'disqus', $options['commenting_system'], false ) . '/>';
	$html .= '&nbsp;';
	$html .= '<label for="commenting_system_disqus">Disqus</label></p>';

	$html .= '<p><input type="radio" id="commenting_system_facebook" name="inti_commenting_options[commenting_system]" value="facebook"' . checked( 'facebook', $options['commenting_system'], false ) . '/>';
	$html .= '&nbsp;';
	$html .= '<label for="commenting_system_facebook">Facebook</label></p>';

	$html .= '<p><input type="radio" id="commenting_system_google" name="inti_commenting_options[commenting_system]" value="google"' . checked( 'google', $options['commenting_system'], false ) . '/>';
	$html .= '&nbsp;';
	$html .= '<label for="commenting_system_google"><i class="fa fa-google"></i> Google</label></p>';
	
	// Here, we'll take the first argument of the array and add it to a label next to the input
	$html .= '<p><small><label for="commenting_system">&nbsp;' . (isset($args[0]) ? $args[0] : '' )  . '</label></small></p>'; 
	
	echo $html;

}

function inti_comments_on_pages_callback($args) {
	
	$options = get_option('inti_commenting_options');

	$html = '<input type="checkbox" id="comments_on_pages" name="inti_commenting_options[comments_on_pages]" value="1"' . checked( 1, $options['comments_on_pages'], false ) . '/>';
	$html .= '&nbsp;';
	$html .= '<label for="comments_on_pages">' . __('Show comments on pages', 'inti') . '</label>';
	
	echo $html;
}

function inti_comments_show_allowed_tags_callback($args) {
	
	$options = get_option('inti_commenting_options');

	$html = '<input type="checkbox" id="comments_show_allowed_tags" name="inti_commenting_options[comments_show_allowed_tags]" value="1"' . checked( 1, $options['comments_show_allowed_tags'], false ) . '/>';
	$html .= '&nbsp;';
	$html .= '<label for="comments_show_allowed_tags">' . __('Show allowed HTML tags message under comment box', 'inti') . '</label><p><br><br></p>';
	
	echo $html;
}

function inti_disqus_shortname_callback($args) {
	
	$options = get_option( 'inti_commenting_options' );
	
	// Render the output
	echo '<input type="text" id="disqus_shortname" name="inti_commenting_options[disqus_shortname]" value="' . $options['disqus_shortname'] . '" />';
	// Here, we'll take the first argument of the array and add it to a label next to the input
	echo '<p><small><label for="disqus_shortname">&nbsp;' . (isset($args[0]) ? $args[0] : '' )  . '</label></small></p><br><br>'; 
	
} // end inti_disqus_shortname_callback

function inti_fbcomments_appid_callback($args) {
	
	$options = get_option( 'inti_commenting_options' );
	
	// Render the output
	echo '<input type="text" id="fbcomments_appid" name="inti_commenting_options[fbcomments_appid]" value="' . $options['fbcomments_appid'] . '" />';
	// Here, we'll take the first argument of the array and add it to a label next to the input
	echo '<p><small><label for="fbcomments_appid">&nbsp;' . (isset($args[0]) ? $args[0] : '' )  . '</label></small></p><br><br>'; 
	
} // end inti_fbcomments_appid_callback

function inti_fbcomments_moderators_callback($args) {
	
	$options = get_option( 'inti_commenting_options' );

	// Render the output
	echo '<input type="text" id="fbcomments_moderators" name="inti_commenting_options[fbcomments_moderators]" value="' . $options['fbcomments_moderators'] . '" />';
	// Here, we'll take the first argument of the array and add it to a label next to the input
	echo '<p><small><label for="fbcomments_moderators">&nbsp;' . (isset($args[0]) ? $args[0] : '' )  . '</label></small></p><br><br>'; 
	
} // end inti_fbcomments_moderators_callback

function inti_fbcomments_lang_callback($args) {
	
	$options = get_option( 'inti_commenting_options' );

	// Render the output
	?>
		<select name="inti_commenting_options[fbcomments_lang]">
			<option value="af_ZA" <?php selected( 'af_ZA', $options['fbcomments_lang'] ); ?>>Afrikaans</option>
			<option value="ar_AR" <?php selected( 'ar_AR', $options['fbcomments_lang'] ); ?>>Arabic</option>
			<option value="az_AZ" <?php selected( 'az_AZ', $options['fbcomments_lang'] ); ?>>Azerbaijani</option>
			<option value="be_BY" <?php selected( 'be_BY', $options['fbcomments_lang'] ); ?>>Belarusian</option>
			<option value="bg_BG" <?php selected( 'bg_BG', $options['fbcomments_lang'] ); ?>>Bulgarian</option>
			<option value="bn_IN" <?php selected( 'bn_IN', $options['fbcomments_lang'] ); ?>>Bengali</option>
			<option value="bs_BA" <?php selected( 'bs_BA', $options['fbcomments_lang'] ); ?>>Bosnian</option>
			<option value="ca_ES" <?php selected( 'ca_ES', $options['fbcomments_lang'] ); ?>>Catalan</option>
			<option value="cs_CZ" <?php selected( 'cs_CZ', $options['fbcomments_lang'] ); ?>>Czech</option>
			<option value="cy_GB" <?php selected( 'cy_GB', $options['fbcomments_lang'] ); ?>>Welsh</option>
			<option value="da_DK" <?php selected( 'da_DK', $options['fbcomments_lang'] ); ?>>Danish</option>
			<option value="de_DE" <?php selected( 'de_DE', $options['fbcomments_lang'] ); ?>>German</option>
			<option value="el_GR" <?php selected( 'el_GR', $options['fbcomments_lang'] ); ?>>Greek</option>
			<option value="en_GB" <?php selected( 'en_GB', $options['fbcomments_lang'] ); ?>>English (UK)</option>
			<option value="en_PI" <?php selected( 'en_PI', $options['fbcomments_lang'] ); ?>>English (Pirate)</option>
			<option value="en_UD" <?php selected( 'en_UD', $options['fbcomments_lang'] ); ?>>English (Upside Down)</option>
			<option value="en_US" <?php selected( 'en_US', $options['fbcomments_lang'] ); ?>>English (US)</option>
			<option value="eo_EO" <?php selected( 'eo_EO', $options['fbcomments_lang'] ); ?>>Esperanto</option>
			<option value="es_ES" <?php selected( 'es_ES', $options['fbcomments_lang'] ); ?>>Spanish (Spain)</option>
			<option value="es_LA" <?php selected( 'es_LA', $options['fbcomments_lang'] ); ?>>Spanish</option>
			<option value="et_EE" <?php selected( 'et_EE', $options['fbcomments_lang'] ); ?>>Estonian</option>
			<option value="eu_ES" <?php selected( 'eu_ES', $options['fbcomments_lang'] ); ?>>Basque</option>
			<option value="fa_IR" <?php selected( 'fa_IR', $options['fbcomments_lang'] ); ?>>Persian</option>
			<option value="fb_LT" <?php selected( 'fb_LT', $options['fbcomments_lang'] ); ?>>Leet Speak</option>
			<option value="fi_FI" <?php selected( 'fi_FI', $options['fbcomments_lang'] ); ?>>Finnish</option>
			<option value="fo_FO" <?php selected( 'fo_FO', $options['fbcomments_lang'] ); ?>>Faroese</option>
			<option value="fr_CA" <?php selected( 'fr_CA', $options['fbcomments_lang'] ); ?>>French (Canada)</option>
			<option value="fr_FR" <?php selected( 'fr_FR', $options['fbcomments_lang'] ); ?>>French (France)</option>
			<option value="fy_NL" <?php selected( 'fy_NL', $options['fbcomments_lang'] ); ?>>Frisian</option>
			<option value="ga_IE" <?php selected( 'ga_IE', $options['fbcomments_lang'] ); ?>>Irish</option>
			<option value="gl_ES" <?php selected( 'gl_ES', $options['fbcomments_lang'] ); ?>>Galician</option>
			<option value="he_IL" <?php selected( 'he_IL', $options['fbcomments_lang'] ); ?>>Hebrew</option>
			<option value="hi_IN" <?php selected( 'hi_IN', $options['fbcomments_lang'] ); ?>>Hindi</option>
			<option value="hr_HR" <?php selected( 'hr_HR', $options['fbcomments_lang'] ); ?>>Croatian</option>
			<option value="hu_HU" <?php selected( 'hu_HU', $options['fbcomments_lang'] ); ?>>Hungarian</option>
			<option value="hy_AM" <?php selected( 'hy_AM', $options['fbcomments_lang'] ); ?>>Armenian</option>
			<option value="id_ID" <?php selected( 'id_ID', $options['fbcomments_lang'] ); ?>>Indonesian</option>
			<option value="is_IS" <?php selected( 'is_IS', $options['fbcomments_lang'] ); ?>>Icelandic</option>
			<option value="it_IT" <?php selected( 'it_IT', $options['fbcomments_lang'] ); ?>>Italian</option>
			<option value="ja_JP" <?php selected( 'ja_JP', $options['fbcomments_lang'] ); ?>>Japanese</option>
			<option value="ka_GE" <?php selected( 'ka_GE', $options['fbcomments_lang'] ); ?>>Georgian</option>
			<option value="km_KH" <?php selected( 'km_KH', $options['fbcomments_lang'] ); ?>>Khmer</option>
			<option value="ko_KR" <?php selected( 'ko_KR', $options['fbcomments_lang'] ); ?>>Korean</option>
			<option value="ku_TR" <?php selected( 'ku_TR', $options['fbcomments_lang'] ); ?>>Kurdish</option>
			<option value="la_VA" <?php selected( 'la_VA', $options['fbcomments_lang'] ); ?>>Latin</option>
			<option value="lt_LT" <?php selected( 'lt_LT', $options['fbcomments_lang'] ); ?>>Lithuanian</option>
			<option value="lv_LV" <?php selected( 'lv_LV', $options['fbcomments_lang'] ); ?>>Latvian</option>
			<option value="mk_MK" <?php selected( 'mk_MK', $options['fbcomments_lang'] ); ?>>Macedonian</option>
			<option value="ml_IN" <?php selected( 'ml_IN', $options['fbcomments_lang'] ); ?>>Malayalam</option>
			<option value="ms_MY" <?php selected( 'ms_MY', $options['fbcomments_lang'] ); ?>>Malay</option>
			<option value="nb_NO" <?php selected( 'nb_NO', $options['fbcomments_lang'] ); ?>>Norwegian (bokmal)</option>
			<option value="ne_NP" <?php selected( 'ne_NP', $options['fbcomments_lang'] ); ?>>Nepali</option>
			<option value="nl_NL" <?php selected( 'nl_NL', $options['fbcomments_lang'] ); ?>>Dutch</option>
			<option value="nn_NO" <?php selected( 'nn_NO', $options['fbcomments_lang'] ); ?>>Norwegian (nynorsk)</option>
			<option value="pa_IN" <?php selected( 'pa_IN', $options['fbcomments_lang'] ); ?>>Punjabi</option>
			<option value="pl_PL" <?php selected( 'pl_PL', $options['fbcomments_lang'] ); ?>>Polish</option>
			<option value="ps_AF" <?php selected( 'ps_AF', $options['fbcomments_lang'] ); ?>>Pashto</option>
			<option value="pt_BR" <?php selected( 'pt_BR', $options['fbcomments_lang'] ); ?>>Portuguese (Brazil)</option>
			<option value="pt_PT" <?php selected( 'pt_PT', $options['fbcomments_lang'] ); ?>>Portuguese (Portugal)</option>
			<option value="ro_RO" <?php selected( 'ro_RO', $options['fbcomments_lang'] ); ?>>Romanian</option>
			<option value="ru_RU" <?php selected( 'ru_RU', $options['fbcomments_lang'] ); ?>>Russian</option>
			<option value="sk_SK" <?php selected( 'sk_SK', $options['fbcomments_lang'] ); ?>>Slovak</option>
			<option value="sl_SI" <?php selected( 'sl_SI', $options['fbcomments_lang'] ); ?>>Slovenian</option>
			<option value="sq_AL" <?php selected( 'sq_AL', $options['fbcomments_lang'] ); ?>>Albanian</option>
			<option value="sr_RS" <?php selected( 'sr_RS', $options['fbcomments_lang'] ); ?>>Serbian</option>
			<option value="sv_SE" <?php selected( 'sv_SE', $options['fbcomments_lang'] ); ?>>Swedish</option>
			<option value="sw_KE" <?php selected( 'sw_KE', $options['fbcomments_lang'] ); ?>>Swahili</option>
			<option value="ta_IN" <?php selected( 'ta_IN', $options['fbcomments_lang'] ); ?>>Tamil</option>
			<option value="te_IN" <?php selected( 'te_IN', $options['fbcomments_lang'] ); ?>>Telugu</option>
			<option value="th_TH" <?php selected( 'th_TH', $options['fbcomments_lang'] ); ?>>Thai</option>
			<option value="tl_PH" <?php selected( 'tl_PH', $options['fbcomments_lang'] ); ?>>Filipino</option>
			<option value="tr_TR" <?php selected( 'tr_TR', $options['fbcomments_lang'] ); ?>>Turkish</option>
			<option value="uk_UA" <?php selected( 'uk_UA', $options['fbcomments_lang'] ); ?>>Ukrainian</option>
			<option value="vi_VN" <?php selected( 'vi_VN', $options['fbcomments_lang'] ); ?>>Vietnamese</option>
			<option value="zh_CN" <?php selected( 'zh_CN', $options['fbcomments_lang'] ); ?>>Simplified Chinese (China)</option>
			<option value="zh_HK" <?php selected( 'zh_HK', $options['fbcomments_lang'] ); ?>>Traditional Chinese (Hong Kong)</option>
			<option value="zh_TW" <?php selected( 'zh_TW', $options['fbcomments_lang'] ); ?>>Traditional Chinese (Taiwan)</option>
		</select>
	<?php
	// Here, we'll take the first argument of the array and add it to a label next to the input
	echo '<p><small><label for="fbcomments_lang">&nbsp;' . (isset($args[0]) ? $args[0] : '' )  . '</label></small></p><br><br>'; 
	
} // end inti_fbcomments_lang_callback

function inti_fbcomments_colorscheme_callback($args) {
	
	$options = get_option( 'inti_commenting_options' );

	// Render the output
   
	$html = '<input type="radio" id="fbcomments_colorscheme_light" name="inti_commenting_options[fbcomments_colorscheme]" value="light"' . checked( 'light', $options['fbcomments_colorscheme'], false ) . '/>';
	$html .= '&nbsp;';
	$html .= '<label for="fbcomments_colorscheme_light">' . __('Light', 'inti') . '</label>';
	$html .= '&nbsp;&nbsp;&nbsp;&nbsp;';
	$html .= '<input type="radio" id="fbcomments_colorscheme_dark" name="inti_commenting_options[fbcomments_colorscheme]" value="dark"' . checked( 'dark', $options['fbcomments_colorscheme'], false ) . '/>';
	$html .= '&nbsp;';
	$html .= '<label for="inti_commenting_options[fbcomments_colorscheme]">' . __('Dark', 'inti') . '</label>';

	echo $html;
	// Here, we'll take the first argument of the array and add it to a label next to the input
	echo '<p><small><label for="fbcomments_colorscheme">&nbsp;' . (isset($args[0]) ? $args[0] : '' )  . '</label></small></p><br><br>'; 
	
} // end inti_fbcomments_colorscheme_callback

function inti_fbcomments_amount_callback($args) {
	
	$options = get_option( 'inti_commenting_options' );

	// Render the output
	echo '<input type="number" id="fbcomments_amount" name="inti_commenting_options[fbcomments_amount]" min="1" max="10" value="' . $options['fbcomments_amount'] . '" />';
	// Here, we'll take the first argument of the array and add it to a label next to the input
	echo '<p><small><label for="fbcomments_amount">&nbsp;' . (isset($args[0]) ? $args[0] : '' )  . '</label></small></p><br><br>'; 
	
} // end inti_fbcomments_amount_callback

function inti_fbcomments_width_callback($args) {
	
	$options = get_option( 'inti_commenting_options' );

	// Render the output
	echo '<input type="text" id="fbcomments_width" name="inti_commenting_options[fbcomments_width]" value="' . $options['fbcomments_width'] . '" />';
	// Here, we'll take the first argument of the array and add it to a label next to the input
	echo '<p><small><label for="fbcomments_width">&nbsp;' . (isset($args[0]) ? $args[0] : '' )  . '</label></small></p><br><br>'; 
	
} // end inti_fbcomments_width_callback

function inti_gpcomments_width_callback($args) {
	
	$options = get_option( 'inti_commenting_options' );
	
	// Render the output
	echo '<input type="text" id="gpcomments_width" name="inti_commenting_options[gpcomments_width]" value="' . $options['gpcomments_width'] . '" />';
	// Here, we'll take the first argument of the array and add it to a label next to the input
	echo '<p><small><label for="gpcomments_width">&nbsp;' . (isset($args[0]) ? $args[0] : '' )  . '</label></small></p><br><br>'; 
	
} // end inti_gpcomments_width_callback





/* ------------------------------------------------------------------------ *
 * Setting Callbacks
 * ------------------------------------------------------------------------ */ 
 
/**
 * Sanitization callback for the social options. Since each of the social options are text inputs,
 * this function loops through the incoming option and strips all tags and slashes from the value
 * before serializing it.
 *  
 * @params  $input  The unsanitized collection of options.
 *
 * @returns         The collection of sanitized values.
 */
function inti_sanitize_headernav_options( $input ) {
	
	// Define the array for the updated options
	$output = array();

	// Loop through each of the options sanitizing the data
	foreach( $input as $key => $val ) {
	
		if( isset ( $input[$key] ) ) {
			$output[$key] = esc_url_raw( strip_tags( stripslashes( $input[$key] ) ) );
		} // end if 
	
	} // end foreach
	
	// Return the new collection
	return apply_filters( 'inti_sanitize_headernav_options', $output, $input );

} // end inti_sanitize_headernav_options

function inti_sanitize_social_options( $input ) {
	
	// Define the array for the updated options
	$output = array();

	// Loop through each of the options sanitizing the data
	foreach( $input as $key => $val ) {
	
		// Most of the social_options are URLs to profiles. There's one that's a checkbox, so we don't want its value to be made a URL.
		// If you're going to add options that have string values, you'll have to do this another way
		if ( is_string($input) ) {
			// It's a textbox, so a URL, make sure it's a URL
			if( isset ( $input[$key] ) ) {
				$output[$key] = esc_url_raw( strip_tags( stripslashes( $input[$key] ) ) );
			} // end if 
		} else {
			// The value isn't a string, just add it back
			$output[$key] = $input[$key];
		}
	} // end foreach

	// Return the new collection
	return apply_filters( 'inti_sanitize_social_options', $output, $input );

} // end inti_sanitize_social_options

