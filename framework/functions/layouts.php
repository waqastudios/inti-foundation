<?php
/**
 * Inti Get Layout
 * with the values of the default setting in Customizer or Theme Options,
 * return the layout name to use on a particular page or post.
 *
 * @package Inti
 * @since 1.0.0
 */
if (!function_exists('inti_get_layout')) {
	function inti_get_layout( $option, $meta ) {
	
		if ($meta == "default" || $meta == "" ) {
			return $option;
		}
		// return default if nothing else
		return $meta;
	}
}


/**
 * Inti Get Theme Layout
 * retrieves theme support options for page templates for distribution through the theme
 * if a flag is set, adds extra option for use in places like the metabox subsystem so that "same as customizer"
 * can be added as an override setting
 * @package Inti
 * @since 1.0.6
 */
if (!function_exists('inti_get_theme_layouts')) {
	function inti_get_theme_layouts($with_customizer_option) {
		$layouts = get_theme_support('inti-layouts');
		$theme_layouts = array();
		
		if ( !is_array( $layouts[0] ) ) {
			$layouts[0] = array();
		}

		if ($with_customizer_option) {
			$theme_layouts['default']   = __('As Set In Customize', 'inti');
		}

		if ( in_array( '1c', $layouts[0] ) ) {   $theme_layouts['1c']   = __('One Column', 'inti'); }
		if ( in_array( '2c-l', $layouts[0] ) ) { $theme_layouts['2c-l'] = __('Two Columns, Left', 'inti'); }
		if ( in_array( '2c-r', $layouts[0] ) ) { $theme_layouts['2c-r'] = __('Two Columns, Right', 'inti'); }
		if ( in_array( '1c-thin', $layouts[0] ) ) { $theme_layouts['1c-thin'] = __('One Column, Thin', 'inti'); }

		return $theme_layouts;
	}
}


?>