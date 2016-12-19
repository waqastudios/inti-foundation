<?php
/**
 * Register Menus
 * register menus in WordPress
 * return menus used in theme
 *
 * @package Inti
 * @since 1.0.0
 * @link http://codex.wordpress.org/Function_Reference/wp_nav_menu
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */


/**
 * Register navigation menus for a theme.
 *
 * @since 1.0.0
 * @param array $locations Associative array of menu location identifiers (like a slug) and descriptive text.
 */
function inti_register_menus() {

	$menus = get_theme_support( 'inti-menus' );
	
	if ( !is_array( $menus[0] ) ) {
		return;
	}
	
	// This is the main menu visibile on larger screens
	if ( in_array( 'dropdown-menu', $menus[0] ) ) {
		register_nav_menu('dropdown-menu', __( 'Main Desktop Menu', 'inti'));
	}    

	// This is the off-canvas menu that comes in from the side on small screens
	if ( in_array( 'off-canvas-menu', $menus[0] ) ) {
		register_nav_menu('off-canvas-menu', __( 'Main Mobile Menu', 'inti'));
	}
	
	// This is the menu that sits in the site footer
	if ( in_array( 'footer-menu', $menus[0] ) ) {
		register_nav_menu('footer-menu', __( 'Footer Menu', 'inti'));
	}
	
}
add_action('init', 'inti_register_menus'); 
		

/**
 * Macro menu
 *
 * @since 1.0.0
 * @see wp_nav_menu
 */
// The Top Menu
function inti_get_dropdown_menu() {
	 $defaults = wp_nav_menu(array(
		'container' => false,
		'echo' => false,                           // Remove nav container
		'menu_class' => 'dropdown menu site-navigation site-navigation-top-bar',       // Adding custom nav class
		'items_wrap' => '<ul id="%1$s" class="%2$s" data-dropdown-menu data-options="{disableHover:true}">%3$s</ul>',
		'theme_location' => 'dropdown-menu',                 // Where it's located in the theme
		'depth' => 5,                                   // Limit the depth of the nav
		'fallback_cb' => false,                         // Fallback function (see below)
		'walker' => new Dropdown_Menu_Walker()
	));
	return apply_filters('inti_filter_dropdown_menu', $defaults);
} /* End Top Menu */

// The Off Canvas Menu
function inti_get_accordion_menu() {
	 $defaults = wp_nav_menu(array(
		'container' => false,
		'echo' => false,                           // Remove nav container
		'menu_class' => 'vertical menu site-navigation site-navigation-accordion',       // Adding custom nav class
		'items_wrap' => '<ul id="%1$s" class="%2$s" data-accordion-menu>%3$s</ul>',
		'theme_location' => 'off-canvas-menu',                 // Where it's located in the theme
		'depth' => 5,                                   // Limit the depth of the nav
		'fallback_cb' => false,                         // Fallback function (see below)
		'walker' => new Accordion_Menu_Walker()
	));
	return apply_filters('inti_filter_accordion_menu', $defaults);
} /* End Off Canvas Menu */

// The Off Canvas Menu
function inti_get_drilldown_menu() {
	 $defaults = wp_nav_menu(array(
		'container' => false,
		'echo' => false,                           // Remove nav container
		'menu_class' => 'vertical menu site-navigation site-navigation-drilldown',       // Adding custom nav class
		'items_wrap' => '<ul id="%1$s" class="%2$s" data-drilldown>%3$s</ul>',
		'theme_location' => 'off-canvas-menu',                 // Where it's located in the theme
		'depth' => 5,                                   // Limit the depth of the nav
		'fallback_cb' => false,                         // Fallback function (see below)
		'walker' => new Drilldown_Menu_Walker()
	));
	return apply_filters('inti_filter_drilldown_menu', $defaults);
} /* End Off Canvas Menu */

// The Footer Menu
function inti_get_footer_menu() {
	$defaults = wp_nav_menu(array(
		'container' => false,
		'echo' => false,                           // Remove nav container
		'menu_class' => 'menu site-navigation site-navigation-footer',       // Adding custom nav class
		'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'theme_location' => 'footer-menu',                 // Where it's located in the theme
		'depth' => 1,                                   // Limit the depth of the nav
		'fallback_cb' => false,                         // Fallback function (see below)
	));
	return apply_filters('inti_filter_footer_menu', $defaults);
} /* End Footer Menu */

// Header Fallback Menu
function inti_get_main_nav_fallback() {
	wp_page_menu( array(
		'echo' => false,
		'show_home' => true,
		'menu_class' => '',      // Adding custom nav class
		'include'     => '',
		'exclude'     => '',
		'echo'        => true,
		'link_before' => '',                            // Before each link
		'link_after' => ''                             // After each link
	) );
}