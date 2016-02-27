<?php
/**
 * Inti Current Theme Supports
 * replaces/compliments WordPress core function current_theme_supports() to 
 * allow for detecting and reading of sub-feature arguments
 *
 * @package Inti
 * @since 1.2.1
 */
if( ! function_exists( 'inti_current_theme_supports' ) ) {
	function inti_current_theme_supports( $feature, $sub ) {
    	global $_wp_theme_features;

		if ( isset( $_wp_theme_features[$feature] ) ) {
			$sub_features = $_wp_theme_features[$feature];
			$sub_features = $sub_features[0];
			//print_r(array_values($sub_features));
			if ( in_array( $sub, $sub_features ) ) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}


?>