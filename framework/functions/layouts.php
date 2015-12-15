<?php
/**
 * Inti Get Layout
 * with the values of the default setting in Customizer or Theme Options,
 * return the layout name to use on a particular page or post.
 *
 * @package Inti
 * @since 1.0.0
 * @param $field_name - name of field we're looking for
 * @param $option_array - name of option array in database the field is in
 * @param $default a default value if option is avialble
 * @param $meta_id post meta id to retrieve meta from database
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
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

?>