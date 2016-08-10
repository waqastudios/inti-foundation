<?php
/**
 * Inti Get Layout
 * with the values of the default setting in Customizer or Theme Options,
 * return the layout name to use on a particular page or post.
 *
 * @package Inti
 * @since 1.0.0
 * @version 1.2.0
 */
if (!function_exists('inti_get_layout')) {
	function inti_get_layout( $meta ) {

		// set a default layout
		$layout = get_inti_option('site_layout', 'inti_customizer_options', '2c-l');

	
		// check to see if $meta was provided, if it wasn't, the page in question will be an archive
		if ($meta == "" ) {
			$meta = "default";
		}


		// this is a single post - compare selected layouts and establish which has priority
		if (is_single()) { 

			// get customizer option for default post layout, if none, use site layout default
			$layout = get_inti_option('post_layout', 'inti_customizer_options', $layout);

			// check if the metabox option has been set to override - if it isn't still on default, it has been changed, use that
			if ($meta != "default") {
				$layout = $meta;
			}
		}


		// this is a static page - compare selected layouts and establish which has priority
		if (is_page()) { 

			// get customizer option for default page layout, if none, use site layout default
			$layout = get_inti_option('page_layout', 'inti_customizer_options', $layout);

			// check if the metabox option has been set to override - if it isn't still on default, it has been changed, use that
			if ($meta != "default") {
				$layout = $meta;
			}


		}


		// this is a archive - compare selected layouts and establish which has priority
		if ( is_archive() || is_home() || is_search() ) {

			// get customizer option for default archive layout, if none, use site layout default
			$layout = get_inti_option('archive_layout', 'inti_customizer_options', $layout);

		}

		// this is the frontpage - use site default or metabox value only
		if (is_front_page()) { 
			if ($meta != "default") {
				$layout = $meta;
			}
		}
		

		// return final layout
		return $layout;
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