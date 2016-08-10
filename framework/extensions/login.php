<?php
/**
 * Customize Login
 *
 * @package Inti
 * @author Anthony Wilhelm (@awshout / anthonywilhelm.com)
 * @since 1.0.0
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */


/**
 * Change logo on login page
 *
 * @since 1.0.0
 */
function inti_do_login_logo() {
	if ( get_inti_option('login_logo', 'inti_customizer_options') ) {
		$output  = "\n" . '<style type="text/css">'; 
		$output .= "\n\t" . 'h1 a { background-image: url("' . get_inti_option('login_logo', 'inti_customizer_options') . '") !important;' . "\n\t" . 'background-size: 275px 65px !important; }' . "\n";
		$output .= '</style>' . "\n";
				
		echo $output;
	}
}
add_action('login_head', 'inti_do_login_logo');


/**
 * Custom logo link url
 *
 * @since 1.0.0
 */
function inti_filter_get_login_logo_url() {
	if ( get_inti_option('login_logo_url', 'inti_customizer_options') ) {
		return get_inti_option('login_logo_url', 'inti_customizer_options'); 
	}
}
add_filter('login_headerurl', 'inti_filter_get_login_logo_url');
