<?php
/**
 * Widget Functions
 * Functions and filters for widgets
 *
 * @package Inti
 * @since 1.0.1
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */


/**
 * Inject values we need to turn the menu widget into a Foundation 6 Accordion Menu
 * @since 1.0.1
 */
function inti_widget_nav_menu_args($nav_menu_args){
	$nav_menu_args['menu_class'] = 'menu vertical site-navigation site-navigation-widget';
	$nav_menu_args['menu_id'] = 'widget_nav_menu_' . md5(uniqid(rand(), true));
	$nav_menu_args['items_wrap'] = '<ul id="%1$s" class="%2$s" data-accordion-menu>%3$s</ul>';

	return $nav_menu_args;
}
add_filter( 'widget_nav_menu_args' , 'inti_widget_nav_menu_args');