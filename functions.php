<?php
/**
 * Inti Theme Functions
 *
 * @package Inti
 * @author Waqa Studios
 * @since 1.0.1
 * @copyright Copyright (c) 2015, Waqa Studios
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */

require locate_template('framework/inti.php');
new Inti();



/**
 * Theme Setup
 * Adds theme support for standard WordPress and custom functionality. In most cases, declaring theme support
 * will do a require on functionality in a seperate file, as seen in framework/inti.php
 * In child themes you can declare remove_theme_support for certain features, or override this function with 
 * childtheme_override_setup().
 */
if ( function_exists('childtheme_override_setup') ) {
	function inti_setup() {
		childtheme_override_setup();
	}
} else {
	function inti_setup() {

		/**
		 * Inti features
		 */ 
		add_theme_support(
			'inti-menus',
			array('dropdown-menu', 'off-canvas-menu', 'footer-menu')
		);
		
		add_theme_support(
			'inti-sidebars',
			array('primary', 'frontpage', 'footer')
		);
		
		add_theme_support(
			'inti-layouts',
			array('1c', '2c-l', '2c-r', '1c-thin')
		);
		
		add_theme_support(
			'inti-post-types',
			array('slides')
		);
		
		add_theme_support(
			'inti-page-templates',
			array('front-page')
		);

		add_theme_support('inti-customizer');

		add_theme_support('inti-theme-options');

		add_theme_support('inti-backgrounds');
		
		add_theme_support('inti-fonts');

		add_theme_support('inti-breadcrumbs');
		
		add_theme_support('inti-pagination');
		
		add_theme_support('inti-post-header-meta');
		
		add_theme_support('inti-shortcodes');
		
		//add_theme_support('inti-sticky-sidebars');
		
		add_theme_support('inti-custom-login');
		
		
		/**
		 * WordPress features
		 */ 
		add_theme_support('menus');
		
		// different post formats for tumblog style posting
		add_theme_support(
			'post-formats',
			array('aside', 'gallery','link', 'image', 'quote', 'status', 'video', 'audio', 'chat')
		);
		
		/**
		 * 3rd Party Supprt
		 */
		add_theme_support( 'woocommerce' );
		
		add_theme_support('post-thumbnails');
		
		add_image_size('thumb-300', 300, 250, true);
		add_image_size('thumb-200', 200, 150, true);
		
		
		// RSS feed links to header.php for posts and comments.
		add_theme_support('automatic-feed-links');
		
		// editor stylesheet for TinyMCE
		add_editor_style('/library/css/editor.css');

		// load translations
		load_theme_textdomain( 'inti' , get_template_directory() . '/languages');
		
	}
}
add_action('after_setup_theme', 'inti_setup', 10);