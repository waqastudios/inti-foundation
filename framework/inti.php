<?php
/**
 * Inti - A WordPress Framework based on Foundation 6 by ZURB
 * This file includes the necessary files for Inti framework to function
 * Some files are included based on theme support
 *
 * @package Inti
 * @author Waqa Studios
 * @since 1.0.0
 * @version 1.0.8
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */

class Inti {

	function __construct() {
		global $inti;

		$inti = new stdClass;
		
		add_action('after_setup_theme', array( &$this, 'options' ), 11);
		add_action('after_setup_theme', array( &$this, 'extensions' ), 12);
		add_action('after_setup_theme', array( &$this, 'functions' ), 13);
		add_action('after_setup_theme', array( &$this, 'content' ), 14);
		
		// Begin 3rd party support for WooCommerce
        remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
    	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
	}
	
	function options() {	
		// function to get options
		require_once locate_template('/framework/extensions/typography.php');
		require_if_theme_supports('inti-theme-options', locate_template('/framework/theme-options/inti-options.php'));
		require_if_theme_supports('inti-customizer', locate_template('/framework/customizer/customize.php'));
	}
		
	function extensions() {	
		// required extensions
		require_once locate_template('/framework/extensions/comments.php');
		require_once locate_template('/framework/extensions/styles.php');
		require_once locate_template('/framework/extensions/scripts.php');
		require_once locate_template('/framework/metaboxes/CMB2/init.php'); // Fetches CMB2
		require_once locate_template('/framework/metaboxes/metaboxes.php'); // Fetches metaboxes
		require_once locate_template('/framework/extensions/socialmedia.php');
		
		// widget functions
		require_once locate_template('/framework/widgets/widget-functions.php');

		// custom widgets
		require_once locate_template('/framework/widgets/image.php');
		require_once locate_template('/framework/widgets/flexvideo.php');
		
		// if theme supports extensions
		require_if_theme_supports('inti-menus', locate_template('/framework/extensions/walkers.php'));
		require_if_theme_supports('inti-menus', locate_template('/framework/extensions/menus.php'));
		require_if_theme_supports('inti-post-types', locate_template('/framework/post-types/post-types.php'));
		require_if_theme_supports('inti-sidebars', locate_template('/framework/extensions/sidebars.php'));
		require_if_theme_supports('inti-shortcodes', locate_template('/framework/shortcodes/shortcodes.php'));
		require_if_theme_supports('inti-shortcodes', locate_template('/framework/shortcodes/tinymce-functions.php'));
		require_if_theme_supports('inti-breadcrumbs', locate_template('/framework/extensions/breadcrumbs.php'));
		require_if_theme_supports('inti-custom-login', locate_template('/framework/extensions/login.php'));
	}
	
	function functions() {	
		// required functions
		require_once locate_template('/framework/functions/get-options.php');
		require_once locate_template('/framework/functions/helpers.php');
		require_once locate_template('/framework/functions/layouts.php');
		require_once locate_template('/framework/functions/post-meta.php');
		require_once locate_template('/framework/functions/srcset-images.php');
		
		// if theme supports functions
		require_if_theme_supports('inti-pagination', locate_template('/framework/functions/pagination.php'));
	}
	
	function content() {
		// hooked content
		require_once locate_template('/framework/extensions/hooks.php');
		require_once locate_template('/framework/content/content-header.php');
		require_once locate_template('/framework/content/content-footer.php');
		require_once locate_template('/framework/content/content-posts-pages.php');
		require_once locate_template('/framework/content/content-archives.php');
		require_once locate_template('/framework/content/content-comments.php');
		require_once locate_template('/framework/content/content-breadcrumbs.php');
	}
	
}