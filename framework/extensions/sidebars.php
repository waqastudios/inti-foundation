<?php
/**
 * Register Sidebar Widget Areas
 *
 * @package Inti
 * @author Anthony Wilhelm (@awshout / anthonywilhelm.com)
 * @since 1.0.0
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 * @see register_sidebar
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */


function inti_register_sidebars() {

	$sidebars = get_theme_support( 'inti-sidebars' );
	
	if ( !is_array( $sidebars[0] ) ) {
		return;
	}
	
	if ( in_array( 'primary', $sidebars[0] ) ) {
		register_sidebar( array( 
			'name'          => __('Primary Sidebar', 'inti'),
			'id'            => 'sidebar',
			'description'   => __('Main sidebar for archives, posts and pages with a 2 column layout', 'inti'),
			'class'         => 'sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );
	}

	if ( in_array( 'frontpage', $sidebars[0] ) ) {
		register_sidebar( array(
			'name'          => __('Front Page', 'inti'),
			'id'            => 'sidebar-frontpage',
			'description'   => __('Main sidebar for the front page template', 'inti'),
			'class'         => 'sidebar',
			'before_widget' => '<div id="%1$s" class="widget frontpage-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );
	}

	if ( in_array( 'footer', $sidebars[0] ) ) {
		$footer  = '<div id="%1$s" class="widget top-bar-widget ';
		$footer .= 'large-' . inti_get_horizontal_sidebar_widget_columns('sidebar-footer');
		$footer .= ' columns %2$s">';
		register_sidebar( array(
			'name'          => __('Footer', 'inti'),
			'id'            => 'sidebar-footer',
			'description'   => __('Footer widget area', 'inti'),
			'class'         => '',
			'before_widget' => $footer,
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );
	}
	
}
add_action('widgets_init', 'inti_register_sidebars'); 


/**
 * Count Horizontal Widgets
 * Count the number of widgets in a horizontal sidebar to calculate columns
 *
 * @param string $sidebar_id id of sidebar
 * @since 1.0.0
 */
if ( !function_exists( 'inti_get_horizontal_sidebar_widget_columns' ) ) {
	function inti_get_horizontal_sidebar_widget_columns( $sidebar_id ) {
		// Default number of columns in Foundation grid is 12
		$columns = apply_filters( 'inti_filter_get_horizontal_sidebar_widget_columns', 12 );
		
		// get the sidebar widgets
		$the_sidebars = wp_get_sidebars_widgets();
		
		// if sidebar doesn't exist return error
		if ( !isset( $the_sidebars[$sidebar_id] ) ) {
			return __('Invalid sidebar ID', 'inti');
		}
		
		/* count number of widgets in the sidebar
		and do some simple math to calculate the columns */
		$num = count( $the_sidebars[$sidebar_id] );
		switch( $num ) {
			case 1 : $num = $columns; break;
			case 2 : $num = $columns / 2; break;
			case 3 : $num = $columns / 3; break;
			case 4 : $num = $columns / 4; break;
			case 5 : $num = $columns / 5; break;
			case 6 : $num = $columns / 6; break;
			case 7 : $num = $columns / 7; break;
			case 8 : $num = $columns / 8; break;
		}
		$num = floor( $num );
		return $num;
	}
}